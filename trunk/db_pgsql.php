<?php

//DB PostgreSQL Class @0-C881546C
/*
 * Database Management for PHP
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 *
 * Modified by Vitaliy Radchuk  <vitaliy.radchuk@yessoftware.com>
 *
 * db_pgsql.php
 *
 */ 

class DB_PostgreSQL {
  var $DBHost     = "";
  var $DBPort     = "";
  var $DBDatabase = "";
  var $DBUser     = "";
  var $DBPassword = "";
  var $Persistent = false;

  var $Link_ID  = 0;
  var $Query_ID = 0;
  var $Record   = array();
  var $Row      = 0;

  var $Seq_Table     = "db_sequence";

  var $Errno    = 0;
  var $Error    = "";

  var $Auto_Free = 1; # Set this to 1 for automatic pg_freeresult on 
                      # last record.
  var $Connected = false;

  var $Encoding = "";

  function ifadd($add, $me) {
    if("" != $add) return " ".$me.$add;
  }
  
  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  function try_connect() {
    $cstr = "dbname='". str_replace(array("\\", "'"), array("\\\\", "\\'"), $this->DBDatabase) . "'" .
    $this->ifadd($this->DBHost, "host=").
    $this->ifadd($this->DBPort, "port=").
    $this->ifadd($this->DBUser, "user=").
    $this->ifadd($this->DBPassword, "password=");
    $this->Query_ID  = 0;
    if ($this->Persistent)
      $this->Link_ID = @pg_pconnect($cstr);
    else
      $this->Link_ID = @pg_connect($cstr);
    $this->Connected = $this->Link_ID ? true : false;
    return $this->Connected;
  }

  function connect() {
    if (!$this->Connected) {
      $this->Query_ID  = 0;
      $cstr = "dbname='". str_replace(array("\\", "'"), array("\\\\", "\\'"), $this->DBDatabase) . "'" .
      $this->ifadd($this->DBHost, "host=").
      $this->ifadd($this->DBPort, "port=").
      $this->ifadd($this->DBUser, "user=").
      $this->ifadd($this->DBPassword, "password=");

                  if ($this->Persistent)
                    $this->Link_ID=pg_pconnect($cstr);
                  else
                    $this->Link_ID=pg_connect($cstr);

      if (!$this->Link_ID) {
        $this->Halt("Cannot connect to database: " . pg_errormessage());
        return false;
      }
      if ($this->Encoding)
        @pg_set_client_encoding($this->Link_ID, $this->Encoding);
      $this->Connected = true;
    }
  }

  function query($Query_String) {
    /* No empty queries, please, since PHP4 chokes on them. */
    if ($Query_String == "")
      /* The empty query string is passed on from the constructor,
       * when calling the class without a query, e.g. in situations
       * like these: '$db = new DB_Sql_Subclass;'
       */
      return 0;

    $this->connect();

#   printf("<br>Debug: query = %s<br>\n", $Query_String);

    $this->Query_ID = pg_Exec($this->Link_ID, $Query_String);
    $this->Row   = 0;

    $this->Error = pg_ErrorMessage($this->Link_ID);
    $this->Errno = ($this->Error == "") ? 0 : 1;
    if (!$this->Query_ID) {
      $this->Errors->addError("Database error: " . pg_errormessage());
    }

    return $this->Query_ID;
  }
  
  function next_record() {
    if (!$this->Query_ID) 
      return 0;

    $this->Record = @pg_fetch_array($this->Query_ID, $this->Row++);
    
    $this->Error = pg_ErrorMessage($this->Link_ID);
    $this->Errno = ($this->Error == "")?0:1;

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_Free) {
      pg_freeresult($this->Query_ID);
      $this->Query_ID = 0;
    }
    return $stat;
  }

  function seek($pos) {
    $this->Row = $pos;
    return true;
  }

  function lock($table, $mode = "write") {
    if ($mode == "write") {
      $result = pg_Exec($this->Link_ID, "lock table $table");
    } else {
      $result = 1;
    }
    return $result;
  }
  
  function unlock() {
    return pg_Exec($this->Link_ID, "commit");
  }


  /* public: sequence numbers */
  function nextid($seq_name) {
    $this->connect();

    if ($this->lock($this->Seq_Table)) {
      /* get sequence number (locked) and increment */
      $q  = sprintf("select nextid from %s where seq_name = '%s' LIMIT 1",
                $this->Seq_Table,
                $seq_name);
      $id  = @pg_Exec($this->Link_ID, $q);
      $res = @pg_Fetch_Array($id, 0);
      
      /* No current value, make one */
      if (!is_array($res)) {
        $currentid = 0;
        $q = sprintf("insert into %s values('%s', %s)",
                 $this->Seq_Table,
                 $seq_name,
                 $currentid);
        $id = @pg_Exec($this->Link_ID, $q);
      } else {
        $currentid = $res["nextid"];
      }
      $nextid = $currentid + 1;
      $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'",
               $this->Seq_Table,
               $nextid,
               $seq_name);
      $id = @pg_Exec($this->Link_ID, $q);
      $this->unlock();
    } else {
      $this->Errors->addError("Database error: Cannot lock ".$this->Seq_Table." - has it been created?");
      return 0;
    }
    return $nextid;
  }



  function metadata($table) {
    $count = 0;
    $id    = 0;
    $res   = array();

    $this->connect();
    $id = pg_exec($this->Link_ID, "select * from $table LIMIT 1");
    if ($id < 0) {
      $this->Error = pg_ErrorMessage($id);
      $this->Errno = 1;
      $this->Errors->addError("Metadata query failed: " . $this->Error);
      return 0;
    }
    $count = pg_NumFields($id);
    
    for ($i=0; $i<$count; $i++) {
      $res[$i]["table"] = $table;
      $res[$i]["name"]  = pg_FieldName  ($id, $i); 
      $res[$i]["type"]  = pg_FieldType  ($id, $i);
      $res[$i]["len"]   = pg_FieldSize  ($id, $i);
      $res[$i]["flags"] = "";
    }
    
    pg_FreeResult($id);
    return $res;
  }

  function affected_rows() {
    return pg_cmdtuples($this->Query_ID);
  }

  function num_rows() {
    return pg_numrows($this->Query_ID);
  }

  function num_fields() {
    return pg_numfields($this->Query_ID);
  }

  function nf() {
    return $this->num_rows();
  }

  function np() {
    print $this->num_rows();
  }

  function f($Name) {
    return $this->Record && array_key_exists($Name, $this->Record) ? $this->Record[$Name] : "";
  }

  function p($Name) {
    print $this->Record[$Name];
  }

  function free_result() {
    @pg_freeresult($this->Query_ID);
    $this->Query_ID = 0;
  }

  function close()
  {
    if ($this->Query_ID) {
      $this->free_result();
    }
    /*
    For better perfomance, now php(by docs) must close connection when script finished
    if ($this->Connected && !$this->Persistent) {
      pg_close($this->Link_ID);
      $this->Connected = true;
    }
    */
  }  

  
  function halt($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>PostgreSQL Error</b><br>\n");
    die("Session halted.");
  }

  function table_names() {
    $this->query("select relname from pg_class where relkind = 'r' and not relname like 'pg_%'");
    $i=0;
    while ($this->next_record())
     {
      $return[$i]["table_name"]= $this->f(0);
      $return[$i]["tablespace_name"]=$this->DBDatabase;
      $return[$i]["database"]=$this->DBDatabase;
      $i++;
     }
    return $return;
  }
  
  function esc($value) {
    return pg_escape_string($value);
  }
}

//End DB PostgreSQL Class


?>

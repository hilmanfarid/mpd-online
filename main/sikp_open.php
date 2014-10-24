<?php
define("RelativePath", "..");
include(RelativePath . "/Common.php");

  $param_string = CCGetQueryString("QueryString",Array("NAMAPHP","ccsForm"));
  $menu_id = CCGetFromGet("P_APP_MENU_ID", "") ;
  $nama_php = CCGetFromGet("NAMAPHP", "") ;
  $myCRUD = "0";
  
  if ($nama_php=="") {
  	 $file_name = "sikp_main.php";
  } else {
  	/*
    $DBConn = new clsDBConn();
    $DBConn->clsDBConn(); 
    $mySQL = "SELECT SECURE.ROLE_CRUD(" . CCGetUserID() . "," . $menu_id . ") CRUD FROM DUAL";
    $DBConn->query($mySQL);
    $DBConn->next_record();
    $myCRUD = $DBConn->f("CRUD");
    $DBConn->Close();
	
	$sql = "SELECT "
		. " CODE FROM "
		. " P_APP_MENU "
		. " WHERE "
		. " P_APP_MENU_ID = :phpId";
		
	$DBConn->bind("phpId", $menu_id, 100);
	$DBConn->query($sql);
	$DBConn->next_record();
	
	$codeName = $DBConn->f("CODE");
	
	if(!empty($codeName)){
		
		$sql = "SELECT "
			. " TOSDB.F_INSERT_USER_ACTIVITY("
			. ":userName, "
			. ":menuName, "
			. ":logDesc"
			. ") TEST "
			. " FROM "
			. " DUAL ";
			
		$DBConn->bind("userName",CCGetUserLogin(),100);
		$DBConn->bind("menuName",$codeName,100);
		$DBConn->bind("logDesc","",100);
		
		$DBConn->query($sql);
		$DBConn->next_record();
		
	}
  	*/
    if ($menu_id == 168 || $menu_id == 169||$menu_id == 170)
	{
		$file_name = "../".$nama_php;
	}else{ 
		$file_name = "../".$nama_php . "?" . $param_string;
	}
	
  }

  CCSetSession("CRUD", $myCRUD);

  header("Location: " . $file_name);
  exit;

?>

<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-0C69D658
function BindEvents()
{
    global $t_cust_acc_dtl_transGrid;
    global $t_cust_acc_dtl_transForm;
    global $t_cust_acc_dtl_transSearch;
    global $uploadForm;
    global $CCSEvents;
    $t_cust_acc_dtl_transGrid->CCSEvents["BeforeSelect"] = "t_cust_acc_dtl_transGrid_BeforeSelect";
    $t_cust_acc_dtl_transGrid->CCSEvents["BeforeShowRow"] = "t_cust_acc_dtl_transGrid_BeforeShowRow";
    $t_cust_acc_dtl_transForm->CCSEvents["BeforeSelect"] = "t_cust_acc_dtl_transForm_BeforeSelect";
    $t_cust_acc_dtl_transSearch->CCSEvents["BeforeShow"] = "t_cust_acc_dtl_transSearch_BeforeShow";
    $uploadForm->Button_xl->CCSEvents["OnClick"] = "uploadForm_Button_xl_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_cust_acc_dtl_transGrid_BeforeSelect @2-29BB8904
function t_cust_acc_dtl_transGrid_BeforeSelect(& $sender)
{
    $t_cust_acc_dtl_transGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_transGrid; //Compatibility
//End t_cust_acc_dtl_transGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_cust_acc_dtl_transGrid_BeforeSelect @2-7D7C985A
    return $t_cust_acc_dtl_transGrid_BeforeSelect;
}
//End Close t_cust_acc_dtl_transGrid_BeforeSelect

//t_cust_acc_dtl_transGrid_BeforeShowRow @2-43A864FF
function t_cust_acc_dtl_transGrid_BeforeShowRow(& $sender)
{
    $t_cust_acc_dtl_transGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_transGrid; //Compatibility
//End t_cust_acc_dtl_transGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Start Bdr
    global $t_cust_acc_dtl_transForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_cust_acc_dtl_trans_id->GetValue();
        $t_cust_acc_dtl_transForm->DataSource->Parameters["urlt_cust_acc_dtl_trans_id"] = $selected_id;
        $t_cust_acc_dtl_transForm->DataSource->Prepare();
        $t_cust_acc_dtl_transForm->EditMode = $t_cust_acc_dtl_transForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->t_cust_acc_dtl_trans_id->GetValue()== $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;
        }	
    // End Bdr  
      if (count($styles)) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	 $Component->DLink->SetValue($img_radio); // Bdr

//Close t_cust_acc_dtl_transGrid_BeforeShowRow @2-577C572D
    return $t_cust_acc_dtl_transGrid_BeforeShowRow;
}
//End Close t_cust_acc_dtl_transGrid_BeforeShowRow

//t_cust_acc_dtl_transForm_BeforeSelect @23-73B4ACF7
function t_cust_acc_dtl_transForm_BeforeSelect(& $sender)
{
    $t_cust_acc_dtl_transForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_transForm; //Compatibility
//End t_cust_acc_dtl_transForm_BeforeSelect

//Custom Code @256-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn1 = new clsDBConnSIKP();
	$user1 = CCGetUserLogin();
	$sql1 ="select * from f_get_npwd_by_username('".$user1."') AS tbl (ty_lov_npwd) where rownum < 2 ";
	$dbConn1->query($sql1);

	while($dbConn1->next_record()){
		$q = $dbConn1->f("npwd");
		$s = $dbConn1->f("ty_lov_npwd");
	}
	$nilai = $t_cust_acc_dtl_transForm->t_cust_acc_dtl_trans_id->GetValue();
	$cusId = CCGetFromGet("t_cust_account_id","");
	if(($nilai == 0) && empty($cusId)){
		$t_cust_acc_dtl_transForm->t_cust_account_id->SetValue($s);
	}
// -------------------------
//End Custom Code

//Close t_cust_acc_dtl_transForm_BeforeSelect @23-08360848
    return $t_cust_acc_dtl_transForm_BeforeSelect;
}
//End Close t_cust_acc_dtl_transForm_BeforeSelect

//t_cust_acc_dtl_transSearch_BeforeShow @3-757AF78F
function t_cust_acc_dtl_transSearch_BeforeShow(& $sender)
{
    $t_cust_acc_dtl_transSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_transSearch; //Compatibility
//End t_cust_acc_dtl_transSearch_BeforeShow

//Custom Code @217-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();
	$user = CCGetUserLogin();
	$sql ="select * from f_get_npwd_by_username('".$user."') where rownum < 2 ";
	$dbConn->query($sql);

	while($dbConn->next_record()){
		$q = $dbConn->f("npwd");
		$s = $dbConn->f("t_cust_account_id");
	}
	$t_cust_acc_dtl_transSearch->npwd->SetValue($q);
	$t_cust_acc_dtl_transSearch->t_cust_account_id->SetValue($s);
// -------------------------
//End Custom Code

//Close t_cust_acc_dtl_transSearch_BeforeShow @3-8259C0BA
    return $t_cust_acc_dtl_transSearch_BeforeShow;
}
//End Close t_cust_acc_dtl_transSearch_BeforeShow

//uploadForm_Button_xl_OnClick @95-631F5944
function uploadForm_Button_xl_OnClick(& $sender)
{
    $uploadForm_Button_xl_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $uploadForm; //Compatibility
//End uploadForm_Button_xl_OnClick

//Custom Code @314-2A29BDB7
// -------------------------
    // Write your own code here.
	global $_FILES;
	global $t_cust_acc_dtl_transSearch;
	try {
        //'excel_file' adalah nama field di form
        if(empty($_FILES['excel_file']['name'])){
            throw new Exception('File tidak boleh kosong');
        }
    }catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

	$file_name = $_FILES['excel_file']['name']; // <-- File Name
    $file_location = '../files/excel/'.$file_name; // <-- LOKASI Upload File

	//upload file ke lokasi tertentu
    try {
        if (!move_uploaded_file($_FILES['excel_file']['tmp_name'], $file_location)){
            throw new Exception("Upload file gagal");
        }
    }catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }
	
	include('../excelreader/reader.php');
    $xl_reader = new Spreadsheet_Excel_Reader();
	$res = $xl_reader->_ole->read($file_location);

    if($res === false) {
    	if($xl_reader->_ole->error == 1) {
    		echo "File Harus Format Excel";
            exit;
    	}
    }
	
	
	try{
	     $xl_reader->read($file_location);
         $firstColumn = $xl_reader->sheets[0]['cells'][1][1];

         		 
		 $DBConnect = new clsDBConnSIKP();  		
		 	
		 $sqll = "select * from f_get_npwd_by_username('".$user1."') AS tbl (ty_lov_npwd) where rownum < 2 ";
		 $DBConnect->query($sqll);
		 while ($DBConnect->next_record()){
			$value = $DBConnect->f("ty_lov_npwd");		 
		 }
		 		
		 $i_t_cust_id = CCGetFromGet("t_cust_account_id","");
		 $i_t_cust_account_id = empty($i_t_cust_id) ? $value : $i_t_cust_id;

		 $i_trans = CCGetFromGet("trans_date","");
		 //$i_tgl_trans = empty($i_trans) ? date('Y-m-d') : $i_trans;
		 $uname = CCGetUserLogin(); //harap diubah

		 $uploadForm->t_cust_account_id->SetValue($i_t_cust_account_id);
		 $uploadForm->trans_date->SetValue($i_tgl_trans);
		 	
         for($i = 2; $i <= $xl_reader->sheets[0]['numRows']; $i++) {
			   $i_tgl_trans =  $xl_reader->sheets[0]['cells'][$i][1]; 	
               $i_bill_no =  $xl_reader->sheets[0]['cells'][$i][2];
               $i_serve_desc =  $xl_reader->sheets[0]['cells'][$i][3];
               $i_serve_charge =  $xl_reader->sheets[0]['cells'][$i][4];
               //$i_vat_charge = $xl_reader->sheets[0]['cells'][$i][4];
			   $i_vat_charge = "null";
               $i_desc = $xl_reader->sheets[0]['cells'][$i][5];
                                                   
	
               if(empty($i_bill_no)) break;
				
               $query = "select o_result_code, o_result_msg from f_ins_cust_acc_dtl_trans(".$i_t_cust_account_id.",
                                '".$i_tgl_trans."',
                                '".$i_bill_no."',
                                '".$i_serve_desc."',
                                ".$i_serve_charge.",
                                ".$i_vat_charge.",
                                '".$i_desc."',
                                '".$uname."'
                               )";
         	  //die($query);	
			  $DBConnect->query($query);
			  while($DBConnect->next_record()){
			  	$msg = $DBConnect->f(o_result_msg);
			  }

			  if (trim($msg) != 'OK'){
			  	  throw new Exception('Terdapat Kesalahan Pada File Excel');			
			  }
		
         }
		 

    } catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }
	
// -------------------------
//End Custom Code

//Close uploadForm_Button_xl_OnClick @95-E8380BB0
    return $uploadForm_Button_xl_OnClick;
}
//End Close uploadForm_Button_xl_OnClick

//Page_OnInitializeView @1-983A10BF
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_trans; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("t_cust_acc_dtl_trans_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-E9F752BF
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_trans; //Compatibility
//End Page_BeforeShow

//Custom Code @344-2A29BDB7
// -------------------------
    // Write your own code here.
	global $t_cust_acc_dtl_transSearch;
	global $t_cust_acc_dtl_transGrid;
	global $t_cust_acc_dtl_transForm;
	global $uploadForm;

	$ada = CCGetFromGet("t_cust_account_id","");

	if (empty($ada)){
		$t_cust_acc_dtl_transSearch->Visible = true;
		$t_cust_acc_dtl_transGrid->Visible = false;
		$t_cust_acc_dtl_transForm->Visible = false;
		$uploadForm->Visible = false;
	}else{
		$t_cust_acc_dtl_transSearch->Visible = true;
		$t_cust_acc_dtl_transGrid->Visible = true;
		$t_cust_acc_dtl_transForm->Visible = true;
		$uploadForm->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-31B48034
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $t_vat_setllementForm;
    global $t_vat_setllementSearch;
    global $CCSEvents;
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementForm->CCSEvents["BeforeShow"] = "t_vat_setllementForm_BeforeShow";
    $t_vat_setllementSearch->button_submit->CCSEvents["OnClick"] = "t_vat_setllementSearch_button_submit_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

// Start Bdr
    global $t_vat_setllementForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_id->GetValue();
        $t_vat_setllementForm->DataSource->Parameters["urlt_vat_setllement_id"] = $selected_id;
        $t_vat_setllementForm->DataSource->Prepare();
        $t_vat_setllementForm->EditMode = $t_vat_setllementForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->t_vat_setllement_id->GetValue()== $selected_id) {
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

//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//t_vat_setllementForm_BeforeShow @23-FE2321F2
function t_vat_setllementForm_BeforeShow(& $sender)
{
    $t_vat_setllementForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeShow

  // -------------------------
      // Write your own code here.
  	$idVat = $t_vat_setllementForm->t_vat_setllement_id->GetValue();
  	
  	if(!empty($idVat)){
  		$t_vat_setllementForm->Button1->Visible = true;
  		$dbConn = new clsDBConnSIKP();
  		$test = "select count(*)as ada from t_vat_penalty where t_vat_setllement_id = ".$idVat;
  		$dbConn->query($test);
  
  			while($dbConn->next_record()){
  				$ada = $dbConn->f("ada");
  			}
  
  			if ($ada > 0){
  				$t_vat_setllementForm->Button2->Visible = true;
  			}else{
  				$t_vat_setllementForm->Button2->Visible = false;
  			}
  	}else{
  		$t_vat_setllementForm->Button1->Visible = false;
  		$t_vat_setllementForm->Button2->Visible = false;
  	}
  // -------------------------


//Close t_vat_setllementForm_BeforeShow @23-08204CD1
    return $t_vat_setllementForm_BeforeShow;
}
//End Close t_vat_setllementForm_BeforeShow

//t_vat_setllementSearch_button_submit_OnClick @174-50DA784C
function t_vat_setllementSearch_button_submit_OnClick(& $sender)
{
    $t_vat_setllementSearch_button_submit_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementSearch; //Compatibility
//End t_vat_setllementSearch_button_submit_OnClick

  // -------------------------
      // Write your own code here.
  	$dbConn = new clsDBConnSIKP();
  	$cusAccId = $t_vat_setllementSearch->t_cust_account_id->GetValue();
  	$Period = $t_vat_setllementSearch->p_finance_period_id->GetValue();
  	//$ReqId = $t_vat_setllementSearch->p_rqst_type_id->GetValue();
  	$npwd = $t_vat_setllementSearch->npwd->GetValue(); 	
  	$User = CCGetUserLogin();
  		 
  	$sql = "select * from f_vat_settlement(".$cusAccId.","											
  											."null,"
  											.$Period.",'"
  											.$npwd."','"
  											.$User."')";
  	$dbConn->query($sql);
  	$dbConn->next_record();
  	$vatId = $dbConn->f("o_vat_setllement_id");
  	$mess = $dbConn->f("o_mess");
  	$dbConn->close();
  
  	echo '<script language="javascript">';
  	echo 'alert("'.$mess.'");';
  	echo '</script>';
  	
  	$PeriodCode = $t_vat_setllementSearch->finance_period_code->GetValue();
  	$typeCode = $t_vat_setllementSearch->year_code->GetValue(); 
  	$YearId = $t_vat_setllementSearch->p_year_period_id->GetValue();
  	$param = "t_vat_setllement.php?t_cust_account_id=".$cusAccId
  			."&p_finance_period_id=".$Period
  			."&finance_period_code=".$PeriodCode
  			."&year_code=".$typeCode
  			."&p_year_period_id=".$YearId
  			."&npwd=".$npwd;
  
  	echo "<meta http-equiv='refresh' content='0;URL=".$param."' >";
  		return;
  // -------------------------


//Close t_vat_setllementSearch_button_submit_OnClick @174-36FC9291
    return $t_vat_setllementSearch_button_submit_OnClick;
}
//End Close t_vat_setllementSearch_button_submit_OnClick

//Page_OnInitializeView @1-712FDAA5
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-FAD0433E
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement; //Compatibility
//End Page_BeforeShow

  // -------------------------
      // Write your own code here.
  	global $t_vat_setllementSearch;
  	global $t_vat_setllementGrid;
  	global $t_vat_setllementForm;
  
  	$npwd = $t_vat_setllementSearch->npwd->GetValue();
  
  	if($npwd == ""){
  		$t_vat_setllementForm->Visible = false;
  		$t_vat_setllementGrid->Visible = false;
  		$t_vat_setllementSearch->Visible = true;
  	}else{
  		$t_vat_setllementForm->Visible = true;
  		$t_vat_setllementGrid->Visible = true;
  		$t_vat_setllementSearch->Visible = true;
  	}
  
  
  // -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

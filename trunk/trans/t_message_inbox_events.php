<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-1FCE1C06
function BindEvents()
{
    global $t_message_inboxGrid;
    global $t_message_inboxForm;
    global $t_vat_setllementSearch;
    global $CCSEvents;
    $t_message_inboxGrid->CCSEvents["BeforeSelect"] = "t_message_inboxGrid_BeforeSelect";
    $t_message_inboxGrid->CCSEvents["BeforeShowRow"] = "t_message_inboxGrid_BeforeShowRow";
    $t_message_inboxGrid->CCSEvents["BeforeShow"] = "t_message_inboxGrid_BeforeShow";
    $t_message_inboxForm->CCSEvents["BeforeShow"] = "t_message_inboxForm_BeforeShow";
    $t_message_inboxForm->ds->CCSEvents["AfterExecuteSelect"] = "t_message_inboxForm_ds_AfterExecuteSelect";
    $t_vat_setllementSearch->button_submit->CCSEvents["OnClick"] = "t_vat_setllementSearch_button_submit_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_message_inboxGrid_BeforeSelect @2-F443F7B2
function t_message_inboxGrid_BeforeSelect(& $sender)
{
    $t_message_inboxGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inboxGrid; //Compatibility
//End t_message_inboxGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Custom Code @289-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
$t_message_inbox_id = CCGetFromGet('t_message_inbox_id');
	if(!empty($t_message_inbox_id)){
		$dbConn1 = new clsDBConnSIKP();
	  	$cari = "select message_status from t_message_inbox where t_message_inbox_id = ".$t_message_inbox_id;
	  	$dbConn1->query($cari);
	  	while($dbConn1->next_record()){
	  		$message_status = $dbConn1->f("message_status");
	  	}
		if($message_status == 'U'){
			$query = "update t_message_inbox set message_status = 'V' where t_message_inbox_id = ".$t_message_inbox_id;
		  	$dbConn1->query($query);
		}
	}

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_message_inboxGrid_BeforeSelect @2-E3E1E9CD
    return $t_message_inboxGrid_BeforeSelect;
}
//End Close t_message_inboxGrid_BeforeSelect

//t_message_inboxGrid_BeforeShowRow @2-2FC46393
function t_message_inboxGrid_BeforeShowRow(& $sender)
{
    $t_message_inboxGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inboxGrid; //Compatibility
//End t_message_inboxGrid_BeforeShowRow
	global $selected_id;
//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
      $status_arr = array();
      $status_arr['V']='Sudah Terbaca';
      $status_arr['U']='Belum Terbaca';
	  $styles = array("Row", "AltRow","AltRowNew");
	  $arr_view = $t_message_inboxGrid->message_status->GetValue();
	  $t_message_inboxGrid->status_view->SetValue($status_arr[$arr_view]);
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        if ($Component->DataSource->t_message_inbox_id->GetValue()== $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[2];
            $is_show_form=1;
        }
		if ($Component->DataSource->message_status->GetValue() == 'U') {
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

//Close t_message_inboxGrid_BeforeShowRow @2-3989CCBB
    return $t_message_inboxGrid_BeforeShowRow;
}
//End Close t_message_inboxGrid_BeforeShowRow

//t_message_inboxGrid_BeforeShow @2-CEA17B88
function t_message_inboxGrid_BeforeShow(& $sender)
{
    $t_message_inboxGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inboxGrid; //Compatibility
//End t_message_inboxGrid_BeforeShow

//Custom Code @288-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_message_inboxGrid_BeforeShow @2-71F125BB
    return $t_message_inboxGrid_BeforeShow;
}
//End Close t_message_inboxGrid_BeforeShow

//t_message_inboxForm_BeforeShow @23-67D80E56
function t_message_inboxForm_BeforeShow(& $sender)
{
    $t_message_inboxForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inboxForm; //Compatibility
//End t_message_inboxForm_BeforeShow

//Custom Code @275-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
	$t_message_inbox_id = $t_message_inboxForm->t_message_inbox_id->GetValue();
	if(empty($t_message_inbox_id)){
		$t_message_inboxForm->Visible=false;
	}else{
		$t_message_inboxForm->Visible=true;
	}
  // -------------------------

//Close t_message_inboxForm_BeforeShow @23-2DFA54CE
    return $t_message_inboxForm_BeforeShow;
}
//End Close t_message_inboxForm_BeforeShow

//t_message_inboxForm_ds_AfterExecuteSelect @23-91782AE8
function t_message_inboxForm_ds_AfterExecuteSelect(& $sender)
{
    $t_message_inboxForm_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inboxForm; //Compatibility
//End t_message_inboxForm_ds_AfterExecuteSelect

//Custom Code @287-2A29BDB7
// -------------------------
    // Write your own code here.
	/*$t_message_inbox_id = $t_message_inboxForm->t_message_inbox_id->GetValue();
	if(!empty($t_message_inbox_id)){
		$dbConn1 = new clsDBConnSIKP();
	  	$cari = "select message_status from t_message_inbox where t_message_inbox_id = ".$t_message_inbox_id;
	  	$dbConn1->query($cari);
	  	while($dbConn1->next_record()){
	  		$message_status = $dbConn1->f("message_status");
	  	}
		if($message_status == 'S'){
			$query = "update t_message_inbox set message_status = 'R' where t_message_inbox_id = ".$t_message_inbox_id;
		  	$dbConn1->query($query);
		}
	}*/
// -------------------------
//End Custom Code

//Close t_message_inboxForm_ds_AfterExecuteSelect @23-223A15D2
    return $t_message_inboxForm_ds_AfterExecuteSelect;
}
//End Close t_message_inboxForm_ds_AfterExecuteSelect

//t_vat_setllementSearch_button_submit_OnClick @174-50DA784C
function t_vat_setllementSearch_button_submit_OnClick(& $sender)
{
    $t_vat_setllementSearch_button_submit_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementSearch; //Compatibility
//End t_vat_setllementSearch_button_submit_OnClick

//Custom Code @177-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
  // Write your own code here.
  // -------------------------


//Close t_vat_setllementSearch_button_submit_OnClick @174-36FC9291
    return $t_vat_setllementSearch_button_submit_OnClick;
}
//End Close t_vat_setllementSearch_button_submit_OnClick

//Page_OnInitializeView @1-BCC4298E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inbox; //Compatibility
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
        $selected_id=CCGetFromGet("t_message_inbox_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-FDE558D4
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_inbox; //Compatibility
//End Page_BeforeShow

//Custom Code @260-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Custom Code @260-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

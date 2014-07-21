<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-E712C00E
function BindEvents()
{
    global $t_message_outboxGrid;
    global $t_message_outboxForm;
    global $t_vat_setllementSearch;
    global $CCSEvents;
    $t_message_outboxGrid->CCSEvents["BeforeSelect"] = "t_message_outboxGrid_BeforeSelect";
    $t_message_outboxGrid->CCSEvents["BeforeShowRow"] = "t_message_outboxGrid_BeforeShowRow";
    $t_message_outboxGrid->CCSEvents["BeforeShow"] = "t_message_outboxGrid_BeforeShow";
    $t_message_outboxForm->CCSEvents["BeforeShow"] = "t_message_outboxForm_BeforeShow";
    $t_message_outboxForm->ds->CCSEvents["AfterExecuteSelect"] = "t_message_outboxForm_ds_AfterExecuteSelect";
    $t_vat_setllementSearch->button_submit->CCSEvents["OnClick"] = "t_vat_setllementSearch_button_submit_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_message_outboxGrid_BeforeSelect @2-22702CBE
function t_message_outboxGrid_BeforeSelect(& $sender)
{
    $t_message_outboxGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outboxGrid; //Compatibility
//End t_message_outboxGrid_BeforeSelect

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
$t_message_outbox_id = CCGetFromGet('t_message_outbox_id');
	if(!empty($t_message_outbox_id)){
		$dbConn1 = new clsDBConnSIKP();
	  	$cari = "select message_status from t_message_outbox where t_message_outbox_id = ".$t_message_outbox_id;
	  	$dbConn1->query($cari);
	  	while($dbConn1->next_record()){
	  		$message_status = $dbConn1->f("message_status");
	  	}
		if($message_status == 'U'){
			$query = "update t_message_outbox set message_status = 'V' where t_message_outbox_id = ".$t_message_outbox_id;
		  	$dbConn1->query($query);
		}
	}

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_message_outboxGrid_BeforeSelect @2-FF71162E
    return $t_message_outboxGrid_BeforeSelect;
}
//End Close t_message_outboxGrid_BeforeSelect

//t_message_outboxGrid_BeforeShowRow @2-BE70389F
function t_message_outboxGrid_BeforeShowRow(& $sender)
{
    $t_message_outboxGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outboxGrid; //Compatibility
//End t_message_outboxGrid_BeforeShowRow	global $selected_id;
//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
      $styles = array("Row", "AltRow","AltRowNew");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        if ($Component->DataSource->t_message_outbox_id->GetValue()== $selected_id) {
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

//Close t_message_outboxGrid_BeforeShowRow @2-0096EF86
    return $t_message_outboxGrid_BeforeShowRow;
}
//End Close t_message_outboxGrid_BeforeShowRow

//t_message_outboxGrid_BeforeShow @2-FC367459
function t_message_outboxGrid_BeforeShow(& $sender)
{
    $t_message_outboxGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outboxGrid; //Compatibility
//End t_message_outboxGrid_BeforeShow

//Custom Code @288-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_message_outboxGrid_BeforeShow @2-56F808E0
    return $t_message_outboxGrid_BeforeShow;
}
//End Close t_message_outboxGrid_BeforeShow

//t_message_outboxForm_BeforeShow @23-25ECA20F
function t_message_outboxForm_BeforeShow(& $sender)
{
    $t_message_outboxForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outboxForm; //Compatibility
//End t_message_outboxForm_BeforeShow

//Custom Code @275-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
	$t_message_outbox_id = $t_message_outboxForm->t_message_outbox_id->GetValue();
	if(empty($t_message_outbox_id)){
		$t_message_outboxForm->Visible=false;
	}else{
		$t_message_outboxForm->Visible=true;
	}
  // -------------------------

//Close t_message_outboxForm_BeforeShow @23-0AF37995
    return $t_message_outboxForm_BeforeShow;
}
//End Close t_message_outboxForm_BeforeShow

//t_message_outboxForm_ds_AfterExecuteSelect @23-A35AC721
function t_message_outboxForm_ds_AfterExecuteSelect(& $sender)
{
    $t_message_outboxForm_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outboxForm; //Compatibility
//End t_message_outboxForm_ds_AfterExecuteSelect

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

//Close t_message_outboxForm_ds_AfterExecuteSelect @23-9C161AC6
    return $t_message_outboxForm_ds_AfterExecuteSelect;
}
//End Close t_message_outboxForm_ds_AfterExecuteSelect

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

//Page_OnInitializeView @1-CB90B7F4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outbox_bphtb; //Compatibility
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
        $selected_id=CCGetFromGet("t_message_outbox_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-5342E685
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_message_outbox_bphtb; //Compatibility
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

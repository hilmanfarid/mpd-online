<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-B4EF050D
function BindEvents()
{
    global $p_w_daemon_procGrid;
    global $p_w_daemon_procForm;
    global $CCSEvents;
    $p_w_daemon_procGrid->CCSEvents["BeforeShowRow"] = "p_w_daemon_procGrid_BeforeShowRow";
    $p_w_daemon_procGrid->CCSEvents["BeforeShow"] = "p_w_daemon_procGrid_BeforeShow";
    $p_w_daemon_procGrid->CCSEvents["BeforeSelect"] = "p_w_daemon_procGrid_BeforeSelect";
    $p_w_daemon_procForm->CCSEvents["BeforeShow"] = "p_w_daemon_procForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_w_daemon_procGrid_BeforeShowRow @2-0D99B79B
function p_w_daemon_procGrid_BeforeShowRow(& $sender)
{
    $p_w_daemon_procGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_w_daemon_procGrid; //Compatibility
//End p_w_daemon_procGrid_BeforeShowRow

// Start Bdr
    global $p_w_daemon_procForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_w_daemon_proc_id->GetValue();
        $p_w_daemon_procForm->DataSource->Parameters["urlp_w_daemon_proc_id"] = $selected_id;
        $p_w_daemon_procForm->DataSource->Prepare();
        $p_w_daemon_procForm->EditMode = $p_w_daemon_procForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_w_daemon_proc_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
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
//End Set Row Style
$Component->DLink->SetValue($img_radio);  // Bdr

//Close p_w_daemon_procGrid_BeforeShowRow @2-556F8D7C
    return $p_w_daemon_procGrid_BeforeShowRow;
}
//End Close p_w_daemon_procGrid_BeforeShowRow

//p_w_daemon_procGrid_BeforeShow @2-70A674E8
function p_w_daemon_procGrid_BeforeShow(& $sender)
{
    $p_w_daemon_procGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_w_daemon_procGrid; //Compatibility
//End p_w_daemon_procGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_w_daemon_procGrid_BeforeShow @2-69CA29FA
    return $p_w_daemon_procGrid_BeforeShow;
}
//End Close p_w_daemon_procGrid_BeforeShow

//p_w_daemon_procGrid_BeforeSelect @2-5C533DD6
function p_w_daemon_procGrid_BeforeSelect(& $sender)
{
    $p_w_daemon_procGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_w_daemon_procGrid; //Compatibility
//End p_w_daemon_procGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_w_daemon_procGrid_BeforeSelect @2-0335C399
    return $p_w_daemon_procGrid_BeforeSelect;
}
//End Close p_w_daemon_procGrid_BeforeSelect

//p_w_daemon_procForm_BeforeShow @23-D9DF0136
function p_w_daemon_procForm_BeforeShow(& $sender)
{
    $p_w_daemon_procForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_w_daemon_procForm; //Compatibility
//End p_w_daemon_procForm_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_w_daemon_procForm_BeforeShow @23-35C1588F
    return $p_w_daemon_procForm_BeforeShow;
}
//End Close p_w_daemon_procForm_BeforeShow

//Page_OnInitializeView @1-308F1F59
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_w_daemon_proc; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_w_daemon_proc_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

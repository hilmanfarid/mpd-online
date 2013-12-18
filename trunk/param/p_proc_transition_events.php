<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-610556D3
function BindEvents()
{
    global $p_proc_transitionGrid;
    global $p_proc_transitionForm;
    global $CCSEvents;
    $p_proc_transitionGrid->CCSEvents["BeforeShowRow"] = "p_proc_transitionGrid_BeforeShowRow";
    $p_proc_transitionGrid->CCSEvents["BeforeShow"] = "p_proc_transitionGrid_BeforeShow";
    $p_proc_transitionGrid->CCSEvents["BeforeSelect"] = "p_proc_transitionGrid_BeforeSelect";
    $p_proc_transitionForm->CCSEvents["BeforeShow"] = "p_proc_transitionForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_proc_transitionGrid_BeforeShowRow @2-4FAAC992
function p_proc_transitionGrid_BeforeShowRow(& $sender)
{
    $p_proc_transitionGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transitionGrid; //Compatibility
//End p_proc_transitionGrid_BeforeShowRow

// Start Bdr
    global $p_proc_transitionForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_proc_transition_id->GetValue();
        $p_proc_transitionForm->DataSource->Parameters["urlp_proc_transition_id"] = $selected_id;
        $p_proc_transitionForm->DataSource->Prepare();
        $p_proc_transitionForm->EditMode = $p_proc_transitionForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_proc_transition_id->GetValue()== $selected_id) {
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

//Close p_proc_transitionGrid_BeforeShowRow @2-4EF4FCFD
    return $p_proc_transitionGrid_BeforeShowRow;
}
//End Close p_proc_transitionGrid_BeforeShowRow

//p_proc_transitionGrid_BeforeShow @2-CC7E128A
function p_proc_transitionGrid_BeforeShow(& $sender)
{
    $p_proc_transitionGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transitionGrid; //Compatibility
//End p_proc_transitionGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_proc_transitionGrid_BeforeShow @2-4B785CAA
    return $p_proc_transitionGrid_BeforeShow;
}
//End Close p_proc_transitionGrid_BeforeShow

//p_proc_transitionGrid_BeforeSelect @2-497EA035
function p_proc_transitionGrid_BeforeSelect(& $sender)
{
    $p_proc_transitionGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transitionGrid; //Compatibility
//End p_proc_transitionGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_proc_transitionGrid_BeforeSelect @2-99E139CC
    return $p_proc_transitionGrid_BeforeSelect;
}
//End Close p_proc_transitionGrid_BeforeSelect

//p_proc_transitionForm_BeforeShow @23-9F5FC9EE
function p_proc_transitionForm_BeforeShow(& $sender)
{
    $p_proc_transitionForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transitionForm; //Compatibility
//End p_proc_transitionForm_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_proc_transitionForm_BeforeShow @23-17732DDF
    return $p_proc_transitionForm_BeforeShow;
}
//End Close p_proc_transitionForm_BeforeShow

//Page_OnInitializeView @1-7166B0DA
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transition; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_proc_transition_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

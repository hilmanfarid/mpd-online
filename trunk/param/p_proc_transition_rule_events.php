<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-63AD3F3C
function BindEvents()
{
    global $p_proc_transition_ruleGrid;
    global $CCSEvents;
    $p_proc_transition_ruleGrid->CCSEvents["BeforeShowRow"] = "p_proc_transition_ruleGrid_BeforeShowRow";
    $p_proc_transition_ruleGrid->CCSEvents["BeforeSelect"] = "p_proc_transition_ruleGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_proc_transition_ruleGrid_BeforeShowRow @2-897576C4
function p_proc_transition_ruleGrid_BeforeShowRow(& $sender)
{
    $p_proc_transition_ruleGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transition_ruleGrid; //Compatibility
//End p_proc_transition_ruleGrid_BeforeShowRow

// Start Bdr
    global $p_proc_transition_ruleForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_proc_transition_rule_id->GetValue();
        $p_proc_transition_ruleForm->DataSource->Parameters["urlp_proc_transition_rule_id"] = $selected_id;
        $p_proc_transition_ruleForm->DataSource->Prepare();
        $p_proc_transition_ruleForm->EditMode = $p_proc_transition_ruleForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_proc_transition_rule_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    

    if (count($styles)) {
//        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
    $Component->DLink->SetValue($img_radio); // Bdr

//Close p_proc_transition_ruleGrid_BeforeShowRow @2-A05A4D5A
    return $p_proc_transition_ruleGrid_BeforeShowRow;
}
//End Close p_proc_transition_ruleGrid_BeforeShowRow

//p_proc_transition_ruleGrid_BeforeSelect @2-1C47D690
function p_proc_transition_ruleGrid_BeforeSelect(& $sender)
{
    $p_proc_transition_ruleGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transition_ruleGrid; //Compatibility
//End p_proc_transition_ruleGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_proc_transition_ruleGrid_BeforeSelect @2-3931B2CE
    return $p_proc_transition_ruleGrid_BeforeSelect;
}
//End Close p_proc_transition_ruleGrid_BeforeSelect

//Page_OnInitializeView @1-65A66F95
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_proc_transition_rule; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_proc_transition_rule_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

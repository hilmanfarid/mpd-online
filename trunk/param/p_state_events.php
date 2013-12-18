<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-F949EA8D
function BindEvents()
{
    global $p_stateGrid;
    global $CCSEvents;
    $p_stateGrid->CCSEvents["BeforeShowRow"] = "p_stateGrid_BeforeShowRow";
    $p_stateGrid->CCSEvents["BeforeShow"] = "p_stateGrid_BeforeShow";
    $p_stateGrid->CCSEvents["BeforeSelect"] = "p_stateGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_stateGrid_BeforeShowRow @2-AD20AC40
function p_stateGrid_BeforeShowRow(& $sender)
{
    $p_stateGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_stateGrid; //Compatibility
//End p_stateGrid_BeforeShowRow	

	global $p_stateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_state_id->GetValue();
        $p_stateForm->DataSource->Parameters["urlp_state_id"] = $selected_id;
        $p_stateForm->DataSource->Prepare();
        $p_stateForm->EditMode = $p_stateForm->DataSource->AllParametersSet;
        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_state_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr   
    if (count($styles)) {
 //       $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	$Component->DLink->SetValue($img_radio);

//Close p_stateGrid_BeforeShowRow @2-0B762405
    return $p_stateGrid_BeforeShowRow;
}
//End Close p_stateGrid_BeforeShowRow

//p_stateGrid_BeforeShow @2-94D1C23D
function p_stateGrid_BeforeShow(& $sender)
{
    $p_stateGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_stateGrid; //Compatibility
//End p_stateGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_stateGrid_BeforeShow @2-BEA5806B
    return $p_stateGrid_BeforeShow;
}
//End Close p_stateGrid_BeforeShow

//p_stateGrid_BeforeSelect @2-5C009531
function p_stateGrid_BeforeSelect(& $sender)
{
    $p_stateGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_stateGrid; //Compatibility
//End p_stateGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_stateGrid_BeforeSelect @2-C465B4E1
    return $p_stateGrid_BeforeSelect;
}
//End Close p_stateGrid_BeforeSelect

//Page_OnInitializeView @1-C2AC93A7
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_state; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_state_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

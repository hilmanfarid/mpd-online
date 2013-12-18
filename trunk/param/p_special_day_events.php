<?php
// Start Bdr    
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-740C4714
function BindEvents()
{
    global $p_special_dayGrid;
    global $p_special_dayForm;
    global $CCSEvents;
    $p_special_dayGrid->CCSEvents["BeforeShowRow"] = "p_special_dayGrid_BeforeShowRow";
    $p_special_dayGrid->CCSEvents["BeforeSelect"] = "p_special_dayGrid_BeforeSelect";
    $p_special_dayForm->CCSEvents["BeforeShow"] = "p_special_dayForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_special_dayGrid_BeforeShowRow @2-E935CEAA
function p_special_dayGrid_BeforeShowRow(& $sender)
{
    $p_special_dayGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_special_dayGrid; //Compatibility
//End p_special_dayGrid_BeforeShowRow

// Start Bdr
    global $p_special_dayForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_special_day_id->GetValue();
        $p_special_dayForm->DataSource->Parameters["urlp_special_day_id"] = $selected_id;
        $p_special_dayForm->DataSource->Prepare();
        $p_special_dayForm->EditMode = $p_special_dayForm->DataSource->AllParametersSet;
        
   }
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_special_day_id->GetValue()== $selected_id) {
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
    $Component->DLink->SetValue($img_radio);  // Bdr

//Close p_special_dayGrid_BeforeShowRow @2-3C6B11DD
    return $p_special_dayGrid_BeforeShowRow;
}
//End Close p_special_dayGrid_BeforeShowRow

//p_special_dayGrid_BeforeSelect @2-9738653E
function p_special_dayGrid_BeforeSelect(& $sender)
{
    $p_special_dayGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_special_dayGrid; //Compatibility
//End p_special_dayGrid_BeforeSelect

//Custom Code @134-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_special_dayGrid_BeforeSelect @2-016B9C0A
    return $p_special_dayGrid_BeforeSelect;
}
//End Close p_special_dayGrid_BeforeSelect

//p_special_dayForm_BeforeShow @23-B796646D
function p_special_dayForm_BeforeShow(& $sender)
{
    $p_special_dayForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_special_dayForm; //Compatibility
//End p_special_dayForm_BeforeShow

//Custom Code @104-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_special_dayForm_BeforeShow @23-FA457EE2
    return $p_special_dayForm_BeforeShow;
}
//End Close p_special_dayForm_BeforeShow

//Page_OnInitializeView @1-74B23417
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_special_day; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Custom Code @105-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_special_day_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

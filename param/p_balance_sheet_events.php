<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-C4F74A51
function BindEvents()
{
    global $p_balance_sheetGrid;
    global $CCSEvents;
    $p_balance_sheetGrid->CCSEvents["BeforeShowRow"] = "p_balance_sheetGrid_BeforeShowRow";
    $p_balance_sheetGrid->CCSEvents["BeforeSelect"] = "p_balance_sheetGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_balance_sheetGrid_BeforeShowRow @2-86D6F128
function p_balance_sheetGrid_BeforeShowRow(& $sender)
{
    $p_balance_sheetGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_balance_sheetGrid; //Compatibility
//End p_balance_sheetGrid_BeforeShowRow

// Start Bdr
    global $p_balance_sheetForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_balance_sheet_id->GetValue();
        $p_balance_sheetForm->DataSource->Parameters["urlp_balance_sheet_id"] = $selected_id;
        $p_balance_sheetForm->DataSource->Prepare();
        $p_balance_sheetForm->EditMode = $p_balance_sheetForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_balance_sheet_id->GetValue()== $selected_id) {
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

//Close p_balance_sheetGrid_BeforeShowRow @2-4DF1DFD2
    return $p_balance_sheetGrid_BeforeShowRow;
}
//End Close p_balance_sheetGrid_BeforeShowRow

//p_balance_sheetGrid_BeforeSelect @2-9100EE09
function p_balance_sheetGrid_BeforeSelect(& $sender)
{
    $p_balance_sheetGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_balance_sheetGrid; //Compatibility
//End p_balance_sheetGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_balance_sheetGrid_BeforeSelect @2-2A201A4E
    return $p_balance_sheetGrid_BeforeSelect;
}
//End Close p_balance_sheetGrid_BeforeSelect

//Page_OnInitializeView @1-6402C908
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_balance_sheet; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_balance_sheet_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

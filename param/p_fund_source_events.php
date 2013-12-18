<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-A0D40034
function BindEvents()
{
    global $p_fund_sourceGrid;
    global $CCSEvents;
    $p_fund_sourceGrid->CCSEvents["BeforeShowRow"] = "p_fund_sourceGrid_BeforeShowRow";
    $p_fund_sourceGrid->CCSEvents["BeforeSelect"] = "p_fund_sourceGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_fund_sourceGrid_BeforeShowRow @2-9AD46D91
function p_fund_sourceGrid_BeforeShowRow(& $sender)
{
    $p_fund_sourceGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_fund_sourceGrid; //Compatibility
//End p_fund_sourceGrid_BeforeShowRow

// Start Bdr
    global $p_fund_sourceForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_fund_source_id->GetValue();
        $p_fund_sourceForm->DataSource->Parameters["urlp_fund_source_id"] = $selected_id;
        $p_fund_sourceForm->DataSource->Prepare();
        $p_fund_sourceForm->EditMode = $p_fund_sourceForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_fund_source_id->GetValue()== $selected_id) {
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

//Close p_fund_sourceGrid_BeforeShowRow @2-BA85CFCD
    return $p_fund_sourceGrid_BeforeShowRow;
}
//End Close p_fund_sourceGrid_BeforeShowRow

//p_fund_sourceGrid_BeforeSelect @2-A4C81565
function p_fund_sourceGrid_BeforeSelect(& $sender)
{
    $p_fund_sourceGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_fund_sourceGrid; //Compatibility
//End p_fund_sourceGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_fund_sourceGrid_BeforeSelect @2-3C6758DA
    return $p_fund_sourceGrid_BeforeSelect;
}
//End Close p_fund_sourceGrid_BeforeSelect

//Page_OnInitializeView @1-96726E93
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_fund_source; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_fund_source_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

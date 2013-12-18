<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-B54423C6
function BindEvents()
{
    global $p_bsheet_sourceGrid;
    global $p_bsheet_sourceForm;
    global $CCSEvents;
    $p_bsheet_sourceGrid->CCSEvents["BeforeShowRow"] = "p_bsheet_sourceGrid_BeforeShowRow";
    $p_bsheet_sourceGrid->CCSEvents["BeforeShow"] = "p_bsheet_sourceGrid_BeforeShow";
    $p_bsheet_sourceGrid->CCSEvents["BeforeSelect"] = "p_bsheet_sourceGrid_BeforeSelect";
    $p_bsheet_sourceForm->CCSEvents["BeforeShow"] = "p_bsheet_sourceForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_bsheet_sourceGrid_BeforeShowRow @2-E7F177BE
function p_bsheet_sourceGrid_BeforeShowRow(& $sender)
{
    $p_bsheet_sourceGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_sourceGrid; //Compatibility
//End p_bsheet_sourceGrid_BeforeShowRow

// Start Bdr
    global $p_bsheet_sourceForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_bsheet_source_id->GetValue();
        $p_bsheet_sourceForm->DataSource->Parameters["urlp_bsheet_source_id"] = $selected_id;
        $p_bsheet_sourceForm->DataSource->Prepare();
        $p_bsheet_sourceForm->EditMode = $p_bsheet_sourceForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_bsheet_source_id->GetValue()== $selected_id) {
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

//Close p_bsheet_sourceGrid_BeforeShowRow @2-A07C9AEA
    return $p_bsheet_sourceGrid_BeforeShowRow;
}
//End Close p_bsheet_sourceGrid_BeforeShowRow

//p_bsheet_sourceGrid_BeforeShow @2-345B6BB5
function p_bsheet_sourceGrid_BeforeShow(& $sender)
{
    $p_bsheet_sourceGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_sourceGrid; //Compatibility
//End p_bsheet_sourceGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_bsheet_sourceGrid_BeforeShow @2-199E6EC9
    return $p_bsheet_sourceGrid_BeforeShow;
}
//End Close p_bsheet_sourceGrid_BeforeShow

//p_bsheet_sourceGrid_BeforeSelect @2-AE145B0D
function p_bsheet_sourceGrid_BeforeSelect(& $sender)
{
    $p_bsheet_sourceGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_sourceGrid; //Compatibility
//End p_bsheet_sourceGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_bsheet_sourceGrid_BeforeSelect @2-1FE602CE
    return $p_bsheet_sourceGrid_BeforeSelect;
}
//End Close p_bsheet_sourceGrid_BeforeSelect

//p_bsheet_sourceForm_BeforeShow @23-9D221E6B
function p_bsheet_sourceForm_BeforeShow(& $sender)
{
    $p_bsheet_sourceForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_sourceForm; //Compatibility
//End p_bsheet_sourceForm_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_bsheet_sourceForm_BeforeShow @23-45951FBC
    return $p_bsheet_sourceForm_BeforeShow;
}
//End Close p_bsheet_sourceForm_BeforeShow

//Page_OnInitializeView @1-0E3CA35C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_source; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_bsheet_source_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

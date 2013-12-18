<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-EAECE97D
function BindEvents()
{
    global $p_region_levelGrid;
    global $CCSEvents;
    $p_region_levelGrid->CCSEvents["BeforeShowRow"] = "p_region_levelGrid_BeforeShowRow";
    $p_region_levelGrid->CCSEvents["BeforeSelect"] = "p_region_levelGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_region_levelGrid_BeforeShowRow @2-7D73B14F
function p_region_levelGrid_BeforeShowRow(& $sender)
{
    $p_region_levelGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_region_levelGrid; //Compatibility
//End p_region_levelGrid_BeforeShowRow

// Start Bdr
    global $p_region_levelForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_region_level_id->GetValue();
        $p_region_levelForm->DataSource->Parameters["urlp_region_level_id"] = $selected_id;
        $p_region_levelForm->DataSource->Prepare();
        $p_region_levelForm->EditMode = $p_region_levelForm->DataSource->AllParametersSet;
        
   }
// End Bdr
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_region_level_id->GetValue()== $selected_id) {
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

//Close p_region_levelGrid_BeforeShowRow @2-8444E094
    return $p_region_levelGrid_BeforeShowRow;
}
//End Close p_region_levelGrid_BeforeShowRow

//p_region_levelGrid_BeforeSelect @2-9DC12276
function p_region_levelGrid_BeforeSelect(& $sender)
{
    $p_region_levelGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_region_levelGrid; //Compatibility
//End p_region_levelGrid_BeforeSelect

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_region_levelGrid_BeforeSelect @2-933FDA3D
    return $p_region_levelGrid_BeforeSelect;
}
//End Close p_region_levelGrid_BeforeSelect

//Page_OnInitializeView @1-57047B72
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_region_level; //Compatibility
//End Page_OnInitializeView

//Custom Code @36-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_region_level_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

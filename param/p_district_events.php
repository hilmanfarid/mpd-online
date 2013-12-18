<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-3415BE3B
function BindEvents()
{
    global $p_districtGrid;
    global $CCSEvents;
    $p_districtGrid->CCSEvents["BeforeShowRow"] = "p_districtGrid_BeforeShowRow";
    $p_districtGrid->CCSEvents["BeforeShow"] = "p_districtGrid_BeforeShow";
    $p_districtGrid->CCSEvents["BeforeSelect"] = "p_districtGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_districtGrid_BeforeShowRow @2-2B0AC441
function p_districtGrid_BeforeShowRow(& $sender)
{
    $p_districtGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_districtGrid; //Compatibility
//End p_districtGrid_BeforeShowRow	

	global $p_districtForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_district_id->GetValue();
        $p_districtForm->DataSource->Parameters["urlp_district_id"] = $selected_id;
        $p_districtForm->DataSource->Prepare();
        $p_districtForm->EditMode = $p_districtForm->DataSource->AllParametersSet;
        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_district_id->GetValue()== $selected_id) {
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

//Close p_districtGrid_BeforeShowRow @2-B76C2DC5
    return $p_districtGrid_BeforeShowRow;
}
//End Close p_districtGrid_BeforeShowRow

//p_districtGrid_BeforeShow @2-31312E89
function p_districtGrid_BeforeShow(& $sender)
{
    $p_districtGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_districtGrid; //Compatibility
//End p_districtGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_districtGrid_BeforeShow @2-38676D5E
    return $p_districtGrid_BeforeShow;
}
//End Close p_districtGrid_BeforeShow

//p_districtGrid_BeforeSelect @2-68B101C2
function p_districtGrid_BeforeSelect(& $sender)
{
    $p_districtGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_districtGrid; //Compatibility
//End p_districtGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_districtGrid_BeforeSelect @2-B8EF6E50
    return $p_districtGrid_BeforeSelect;
}
//End Close p_districtGrid_BeforeSelect

//Page_OnInitializeView @1-20F30CF1
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_district; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_district_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

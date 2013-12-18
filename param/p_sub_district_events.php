<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-948693B8
function BindEvents()
{
    global $p_sub_districtGrid;
    global $CCSEvents;
    $p_sub_districtGrid->CCSEvents["BeforeShowRow"] = "p_sub_districtGrid_BeforeShowRow";
    $p_sub_districtGrid->CCSEvents["BeforeShow"] = "p_sub_districtGrid_BeforeShow";
    $p_sub_districtGrid->CCSEvents["BeforeSelect"] = "p_sub_districtGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_sub_districtGrid_BeforeShowRow @2-35F84841
function p_sub_districtGrid_BeforeShowRow(& $sender)
{
    $p_sub_districtGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_sub_districtGrid; //Compatibility
//End p_sub_districtGrid_BeforeShowRow	

	global $p_sub_districtForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_sub_district_id->GetValue();
        $p_sub_districtForm->DataSource->Parameters["urlp_sub_district_id"] = $selected_id;
        $p_sub_districtForm->DataSource->Prepare();
        $p_sub_districtForm->EditMode = $p_sub_districtForm->DataSource->AllParametersSet;
        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_sub_district_id->GetValue()== $selected_id) {
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

//Close p_sub_districtGrid_BeforeShowRow @2-EB7C0406
    return $p_sub_districtGrid_BeforeShowRow;
}
//End Close p_sub_districtGrid_BeforeShowRow

//p_sub_districtGrid_BeforeShow @2-39F2CCF3
function p_sub_districtGrid_BeforeShow(& $sender)
{
    $p_sub_districtGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_sub_districtGrid; //Compatibility
//End p_sub_districtGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_sub_districtGrid_BeforeShow @2-F0C27F87
    return $p_sub_districtGrid_BeforeShow;
}
//End Close p_sub_districtGrid_BeforeShow

//p_sub_districtGrid_BeforeSelect @2-26750FC9
function p_sub_districtGrid_BeforeSelect(& $sender)
{
    $p_sub_districtGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_sub_districtGrid; //Compatibility
//End p_sub_districtGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_sub_districtGrid_BeforeSelect @2-1BACA9EB
    return $p_sub_districtGrid_BeforeSelect;
}
//End Close p_sub_districtGrid_BeforeSelect

//Page_OnInitializeView @1-170DE312
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_sub_district; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_sub_district_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

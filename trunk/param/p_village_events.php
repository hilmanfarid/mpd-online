<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-B677943E
function BindEvents()
{
    global $p_villageGrid;
    global $CCSEvents;
    $p_villageGrid->CCSEvents["BeforeShowRow"] = "p_villageGrid_BeforeShowRow";
    $p_villageGrid->CCSEvents["BeforeShow"] = "p_villageGrid_BeforeShow";
    $p_villageGrid->CCSEvents["BeforeSelect"] = "p_villageGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_villageGrid_BeforeShowRow @2-4B4780FE
function p_villageGrid_BeforeShowRow(& $sender)
{
    $p_villageGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_villageGrid; //Compatibility
//End p_villageGrid_BeforeShowRow	

	global $p_villageForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_village_id->GetValue();
        $p_villageForm->DataSource->Parameters["urlp_village_id"] = $selected_id;
        $p_villageForm->DataSource->Prepare();
        $p_villageForm->EditMode = $p_villageForm->DataSource->AllParametersSet;
        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_village_id->GetValue()== $selected_id) {
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

//Close p_villageGrid_BeforeShowRow @2-D1ADEE73
    return $p_villageGrid_BeforeShowRow;
}
//End Close p_villageGrid_BeforeShowRow

//p_villageGrid_BeforeShow @2-6F6741D5
function p_villageGrid_BeforeShow(& $sender)
{
    $p_villageGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_villageGrid; //Compatibility
//End p_villageGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_villageGrid_BeforeShow @2-83759162
    return $p_villageGrid_BeforeShow;
}
//End Close p_villageGrid_BeforeShow

//p_villageGrid_BeforeSelect @2-667C3D45
function p_villageGrid_BeforeSelect(& $sender)
{
    $p_villageGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_villageGrid; //Compatibility
//End p_villageGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_villageGrid_BeforeSelect @2-7F17128A
    return $p_villageGrid_BeforeSelect;
}
//End Close p_villageGrid_BeforeSelect

//Page_OnInitializeView @1-4214C588
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_village; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_village_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

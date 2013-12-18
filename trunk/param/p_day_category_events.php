<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-BF63C51E
function BindEvents()
{
    global $p_day_categoryGrid;
    global $CCSEvents;
    $p_day_categoryGrid->CCSEvents["BeforeShowRow"] = "p_day_categoryGrid_BeforeShowRow";
    $p_day_categoryGrid->CCSEvents["BeforeShow"] = "p_day_categoryGrid_BeforeShow";
    $p_day_categoryGrid->CCSEvents["BeforeSelect"] = "p_day_categoryGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_day_categoryGrid_BeforeShowRow @2-F8FD5DE4
function p_day_categoryGrid_BeforeShowRow(& $sender)
{
    $p_day_categoryGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_day_categoryGrid; //Compatibility
//End p_day_categoryGrid_BeforeShowRow	global $p_day_categoryForm;
    global $p_day_categoryForm;
	global $selected_id;
    global $add_flag;
    global $is_show_form;

   if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_day_category_id->GetValue();
        $p_day_categoryForm->DataSource->Parameters["urlp_day_category_id"] = $selected_id;
        $p_day_categoryForm->DataSource->Prepare();
        $p_day_categoryForm->EditMode = $p_day_categoryForm->DataSource->AllParametersSet;        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_day_category_id->GetValue()== $selected_id) {
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

//Close p_day_categoryGrid_BeforeShowRow @2-1832EE47
    return $p_day_categoryGrid_BeforeShowRow;
}
//End Close p_day_categoryGrid_BeforeShowRow

//p_day_categoryGrid_BeforeShow @2-E7DDAE46
function p_day_categoryGrid_BeforeShow(& $sender)
{
    $p_day_categoryGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_day_categoryGrid; //Compatibility
//End p_day_categoryGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_day_categoryGrid_BeforeShow @2-1752841B
    return $p_day_categoryGrid_BeforeShow;
}
//End Close p_day_categoryGrid_BeforeShow

//p_day_categoryGrid_BeforeSelect @2-D347074A
function p_day_categoryGrid_BeforeSelect(& $sender)
{
    $p_day_categoryGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_day_categoryGrid; //Compatibility
//End p_day_categoryGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_day_categoryGrid_BeforeSelect @2-EC37A0F9
    return $p_day_categoryGrid_BeforeSelect;
}
//End Close p_day_categoryGrid_BeforeSelect

//Page_OnInitializeView @1-3FDB781C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_day_category; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_day_category_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

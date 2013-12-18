<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-6109F36A
function BindEvents()
{
    global $p_zip_codeGrid;
    global $CCSEvents;
    $p_zip_codeGrid->CCSEvents["BeforeShowRow"] = "p_zip_codeGrid_BeforeShowRow";
    $p_zip_codeGrid->CCSEvents["BeforeShow"] = "p_zip_codeGrid_BeforeShow";
    $p_zip_codeGrid->CCSEvents["BeforeSelect"] = "p_zip_codeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_zip_codeGrid_BeforeShowRow @2-87415C46
function p_zip_codeGrid_BeforeShowRow(& $sender)
{
    $p_zip_codeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_zip_codeGrid; //Compatibility
//End p_zip_codeGrid_BeforeShowRow	

	global $p_zip_codeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_zip_code->GetValue();
        $p_zip_codeForm->DataSource->Parameters["urlp_zip_code"] = $selected_id;
        $p_zip_codeForm->DataSource->Prepare();
        $p_zip_codeForm->EditMode = $p_zip_codeForm->DataSource->AllParametersSet;
        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_zip_code->GetValue()== $selected_id) {
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

//Close p_zip_codeGrid_BeforeShowRow @2-5DDC5B21
    return $p_zip_codeGrid_BeforeShowRow;
}
//End Close p_zip_codeGrid_BeforeShowRow

//p_zip_codeGrid_BeforeShow @2-0FC67900
function p_zip_codeGrid_BeforeShow(& $sender)
{
    $p_zip_codeGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_zip_codeGrid; //Compatibility
//End p_zip_codeGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_zip_codeGrid_BeforeShow @2-8233F88A
    return $p_zip_codeGrid_BeforeShow;
}
//End Close p_zip_codeGrid_BeforeShow

//p_zip_codeGrid_BeforeSelect @2-55E0FF6F
function p_zip_codeGrid_BeforeSelect(& $sender)
{
    $p_zip_codeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_zip_codeGrid; //Compatibility
//End p_zip_codeGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_zip_codeGrid_BeforeSelect @2-DDDEB3D4
    return $p_zip_codeGrid_BeforeSelect;
}
//End Close p_zip_codeGrid_BeforeSelect

//Page_OnInitializeView @1-A450DD05
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_zip_code; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_zip_code", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

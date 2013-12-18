<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-0F9B3C7A
function BindEvents()
{
    global $p_applicationGrid;
    global $CCSEvents;
    $p_applicationGrid->CCSEvents["BeforeShowRow"] = "p_applicationGrid_BeforeShowRow";
    $p_applicationGrid->CCSEvents["BeforeSelect"] = "p_applicationGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_applicationGrid_BeforeShowRow @2-8CACD896
function p_applicationGrid_BeforeShowRow(& $sender)
{
    $p_applicationGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_applicationGrid; //Compatibility
//End p_applicationGrid_BeforeShowRow

// Start Bdr
    global $p_applicationForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_application_id->GetValue();
        $p_applicationForm->DataSource->Parameters["urlp_application_id"] = $selected_id;
        $p_applicationForm->DataSource->Prepare();
        $p_applicationForm->EditMode = $p_applicationForm->DataSource->AllParametersSet;
        
   }
// End Bdr
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_application_id->GetValue()== $selected_id) {
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

//Close p_applicationGrid_BeforeShowRow @2-1548E9B0
    return $p_applicationGrid_BeforeShowRow;
}
//End Close p_applicationGrid_BeforeShowRow

//p_applicationGrid_BeforeSelect @2-BC6D8A66
function p_applicationGrid_BeforeSelect(& $sender)
{
    $p_applicationGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_applicationGrid; //Compatibility
//End p_applicationGrid_BeforeSelect

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_applicationGrid_BeforeSelect @2-FB5A6973
    return $p_applicationGrid_BeforeSelect;
}
//End Close p_applicationGrid_BeforeSelect

//Page_OnInitializeView @1-A520B4B2
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_application; //Compatibility
//End Page_OnInitializeView

//Custom Code @36-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_application_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

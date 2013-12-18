<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-5EDAFF91
function BindEvents()
{
    global $p_bsheet_exceptionGrid;
    global $p_bsheet_exceptionForm;
    global $CCSEvents;
    $p_bsheet_exceptionGrid->CCSEvents["BeforeShowRow"] = "p_bsheet_exceptionGrid_BeforeShowRow";
    $p_bsheet_exceptionGrid->CCSEvents["BeforeShow"] = "p_bsheet_exceptionGrid_BeforeShow";
    $p_bsheet_exceptionGrid->CCSEvents["BeforeSelect"] = "p_bsheet_exceptionGrid_BeforeSelect";
    $p_bsheet_exceptionForm->CCSEvents["BeforeShow"] = "p_bsheet_exceptionForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_bsheet_exceptionGrid_BeforeShowRow @2-480C3047
function p_bsheet_exceptionGrid_BeforeShowRow(& $sender)
{
    $p_bsheet_exceptionGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_exceptionGrid; //Compatibility
//End p_bsheet_exceptionGrid_BeforeShowRow

// Start Bdr
    global $p_bsheet_exceptionForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_bsheet_exception_id->GetValue();
        $p_bsheet_exceptionForm->DataSource->Parameters["urlp_bsheet_exception_id"] = $selected_id;
        $p_bsheet_exceptionForm->DataSource->Prepare();
        $p_bsheet_exceptionForm->EditMode = $p_bsheet_exceptionForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_bsheet_exception_id->GetValue()== $selected_id) {
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

//Close p_bsheet_exceptionGrid_BeforeShowRow @2-96802ACD
    return $p_bsheet_exceptionGrid_BeforeShowRow;
}
//End Close p_bsheet_exceptionGrid_BeforeShowRow

//p_bsheet_exceptionGrid_BeforeShow @2-1AA1A0F8
function p_bsheet_exceptionGrid_BeforeShow(& $sender)
{
    $p_bsheet_exceptionGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_exceptionGrid; //Compatibility
//End p_bsheet_exceptionGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_bsheet_exceptionGrid_BeforeShow @2-AD80E09E
    return $p_bsheet_exceptionGrid_BeforeShow;
}
//End Close p_bsheet_exceptionGrid_BeforeShow

//p_bsheet_exceptionGrid_BeforeSelect @2-26AEE091
function p_bsheet_exceptionGrid_BeforeSelect(& $sender)
{
    $p_bsheet_exceptionGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_exceptionGrid; //Compatibility
//End p_bsheet_exceptionGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_bsheet_exceptionGrid_BeforeSelect @2-E01CD364
    return $p_bsheet_exceptionGrid_BeforeSelect;
}
//End Close p_bsheet_exceptionGrid_BeforeSelect

//p_bsheet_exceptionForm_BeforeShow @23-37CF2416
function p_bsheet_exceptionForm_BeforeShow(& $sender)
{
    $p_bsheet_exceptionForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_exceptionForm; //Compatibility
//End p_bsheet_exceptionForm_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_bsheet_exceptionForm_BeforeShow @23-F18B91EB
    return $p_bsheet_exceptionForm_BeforeShow;
}
//End Close p_bsheet_exceptionForm_BeforeShow

//Page_OnInitializeView @1-356FC15C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bsheet_exception; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_bsheet_exception_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

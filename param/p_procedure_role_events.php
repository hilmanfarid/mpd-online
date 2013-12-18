<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-CFA173DF
function BindEvents()
{
    global $p_procedure_roleGrid;
    global $p_procedure_roleForm;
    global $CCSEvents;
    $p_procedure_roleGrid->CCSEvents["BeforeShowRow"] = "p_procedure_roleGrid_BeforeShowRow";
    $p_procedure_roleGrid->CCSEvents["BeforeShow"] = "p_procedure_roleGrid_BeforeShow";
    $p_procedure_roleGrid->CCSEvents["BeforeSelect"] = "p_procedure_roleGrid_BeforeSelect";
    $p_procedure_roleForm->CCSEvents["BeforeShow"] = "p_procedure_roleForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_procedure_roleGrid_BeforeShowRow @2-F64BF8B5
function p_procedure_roleGrid_BeforeShowRow(& $sender)
{
    $p_procedure_roleGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_roleGrid; //Compatibility
//End p_procedure_roleGrid_BeforeShowRow

// Start Bdr
    global $p_procedure_roleForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_procedure_role_id->GetValue();
        $p_procedure_roleForm->DataSource->Parameters["urlp_procedure_role_id"] = $selected_id;
        $p_procedure_roleForm->DataSource->Prepare();
        $p_procedure_roleForm->EditMode = $p_procedure_roleForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_procedure_role_id->GetValue()== $selected_id) {
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

//Close p_procedure_roleGrid_BeforeShowRow @2-EF8338D2
    return $p_procedure_roleGrid_BeforeShowRow;
}
//End Close p_procedure_roleGrid_BeforeShowRow

//p_procedure_roleGrid_BeforeShow @2-DB7C0159
function p_procedure_roleGrid_BeforeShow(& $sender)
{
    $p_procedure_roleGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_roleGrid; //Compatibility
//End p_procedure_roleGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_procedure_roleGrid_BeforeShow @2-4388C66F
    return $p_procedure_roleGrid_BeforeShow;
}
//End Close p_procedure_roleGrid_BeforeShow

//p_procedure_roleGrid_BeforeSelect @2-BDF00126
function p_procedure_roleGrid_BeforeSelect(& $sender)
{
    $p_procedure_roleGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_roleGrid; //Compatibility
//End p_procedure_roleGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_procedure_roleGrid_BeforeSelect @2-3FB6686D
    return $p_procedure_roleGrid_BeforeSelect;
}
//End Close p_procedure_roleGrid_BeforeSelect

//p_procedure_roleForm_BeforeShow @23-02A6D70F
function p_procedure_roleForm_BeforeShow(& $sender)
{
    $p_procedure_roleForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_roleForm; //Compatibility
//End p_procedure_roleForm_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_procedure_roleForm_BeforeShow @23-1F83B71A
    return $p_procedure_roleForm_BeforeShow;
}
//End Close p_procedure_roleForm_BeforeShow

//Page_OnInitializeView @1-656A523B
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_role; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_procedure_role_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

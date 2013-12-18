<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-1855C0C9
function BindEvents()
{
    global $t_vat_setllement_dtlGrid;
    global $CCSEvents;
    $t_vat_setllement_dtlGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllement_dtlGrid_BeforeShowRow";
    $t_vat_setllement_dtlGrid->CCSEvents["BeforeShow"] = "t_vat_setllement_dtlGrid_BeforeShow";
    $t_vat_setllement_dtlGrid->CCSEvents["BeforeSelect"] = "t_vat_setllement_dtlGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_setllement_dtlGrid_BeforeShowRow @2-BE4DD7DF
function t_vat_setllement_dtlGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllement_dtlGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtlGrid; //Compatibility
//End t_vat_setllement_dtlGrid_BeforeShowRow

// Start Bdr
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_dtl_id->GetValue();
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->t_vat_setllement_dtl_id->GetValue()== $selected_id) {
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

//Close t_vat_setllement_dtlGrid_BeforeShowRow @2-1442371A
    return $t_vat_setllement_dtlGrid_BeforeShowRow;
}
//End Close t_vat_setllement_dtlGrid_BeforeShowRow

//t_vat_setllement_dtlGrid_BeforeShow @2-38B720AD
function t_vat_setllement_dtlGrid_BeforeShow(& $sender)
{
    $t_vat_setllement_dtlGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtlGrid; //Compatibility
//End t_vat_setllement_dtlGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllement_dtlGrid_BeforeShow @2-CACF216C
    return $t_vat_setllement_dtlGrid_BeforeShow;
}
//End Close t_vat_setllement_dtlGrid_BeforeShow

//t_vat_setllement_dtlGrid_BeforeSelect @2-A6437597
function t_vat_setllement_dtlGrid_BeforeSelect(& $sender)
{
    $t_vat_setllement_dtlGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtlGrid; //Compatibility
//End t_vat_setllement_dtlGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_setllement_dtlGrid_BeforeSelect @2-2AF5C532
    return $t_vat_setllement_dtlGrid_BeforeSelect;
}
//End Close t_vat_setllement_dtlGrid_BeforeSelect

//Page_OnInitializeView @1-2E0A5AF0
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtl; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_vat_setllement_dtl_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

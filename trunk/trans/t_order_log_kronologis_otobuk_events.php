<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-1A1D54E0
function BindEvents()
{
    global $t_order_log_kronologisGrid;
    global $CCSEvents;
    $t_order_log_kronologisGrid->CCSEvents["BeforeShowRow"] = "t_order_log_kronologisGrid_BeforeShowRow";
    $t_order_log_kronologisGrid->CCSEvents["BeforeSelect"] = "t_order_log_kronologisGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_order_log_kronologisGrid_BeforeShowRow @2-9F18A8DD
function t_order_log_kronologisGrid_BeforeShowRow(& $sender)
{
    $t_order_log_kronologisGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_order_log_kronologisGrid; //Compatibility
//End t_order_log_kronologisGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close t_order_log_kronologisGrid_BeforeShowRow @2-0C84651B
    return $t_order_log_kronologisGrid_BeforeShowRow;
}
//End Close t_order_log_kronologisGrid_BeforeShowRow

//t_order_log_kronologisGrid_BeforeSelect @2-0095461A
function t_order_log_kronologisGrid_BeforeSelect(& $sender)
{
    $t_order_log_kronologisGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_order_log_kronologisGrid; //Compatibility
//End t_order_log_kronologisGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_order_log_kronologisGrid_BeforeSelect @2-5BE0B3E5
    return $t_order_log_kronologisGrid_BeforeSelect;
}
//End Close t_order_log_kronologisGrid_BeforeSelect

//Page_OnInitializeView @1-86D182EC
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_order_log_kronologis_otobuk; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-80DD6753
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_order_log_kronologis_otobuk; //Compatibility
//End Page_BeforeShow

//Custom Code @193-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-01145346
function BindEvents()
{
    global $HistoryGrid;
    global $CCSEvents;
    $HistoryGrid->CCSEvents["BeforeShowRow"] = "HistoryGrid_BeforeShowRow";
    $HistoryGrid->CCSEvents["BeforeSelect"] = "HistoryGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//HistoryGrid_BeforeShowRow @2-85406CB0
function HistoryGrid_BeforeShowRow(& $sender)
{
    $HistoryGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close HistoryGrid_BeforeShowRow @2-D25D4DF5
    return $HistoryGrid_BeforeShowRow;
}
//End Close HistoryGrid_BeforeShowRow

//HistoryGrid_BeforeSelect @2-63E3CC27
function HistoryGrid_BeforeSelect(& $sender)
{
    $HistoryGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeSelect

//Custom Code @121-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close HistoryGrid_BeforeSelect @2-39569808
    return $HistoryGrid_BeforeSelect;
}
//End Close HistoryGrid_BeforeSelect

//Page_OnInitializeView @1-3FFC46DC
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_trans_histories; //Compatibility
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


?>

<?php
//BindEvents Method @1-3161CB68
function BindEvents()
{
    global $t_penerimaan_skpd_viewGrid;
    global $CCSEvents;
    $t_penerimaan_skpd_viewGrid->CCSEvents["BeforeShowRow"] = "t_penerimaan_skpd_viewGrid_BeforeShowRow";
    $t_penerimaan_skpd_viewGrid->CCSEvents["BeforeShow"] = "t_penerimaan_skpd_viewGrid_BeforeShow";
    $t_penerimaan_skpd_viewGrid->CCSEvents["BeforeSelect"] = "t_penerimaan_skpd_viewGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_penerimaan_skpd_viewGrid_BeforeShowRow @2-452F3386
function t_penerimaan_skpd_viewGrid_BeforeShowRow(& $sender)
{
    $t_penerimaan_skpd_viewGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_viewGrid; //Compatibility
//End t_penerimaan_skpd_viewGrid_BeforeShowRow

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close t_penerimaan_skpd_viewGrid_BeforeShowRow @2-2BD69E2A
    return $t_penerimaan_skpd_viewGrid_BeforeShowRow;
}
//End Close t_penerimaan_skpd_viewGrid_BeforeShowRow

//t_penerimaan_skpd_viewGrid_BeforeShow @2-2C0E94EA
function t_penerimaan_skpd_viewGrid_BeforeShow(& $sender)
{
    $t_penerimaan_skpd_viewGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_viewGrid; //Compatibility
//End t_penerimaan_skpd_viewGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_penerimaan_skpd_viewGrid_BeforeShow @2-D2796E39
    return $t_penerimaan_skpd_viewGrid_BeforeShow;
}
//End Close t_penerimaan_skpd_viewGrid_BeforeShow

//t_penerimaan_skpd_viewGrid_BeforeSelect @2-CD1030F3
function t_penerimaan_skpd_viewGrid_BeforeSelect(& $sender)
{
    $t_penerimaan_skpd_viewGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_viewGrid; //Compatibility
//End t_penerimaan_skpd_viewGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_penerimaan_skpd_viewGrid_BeforeSelect @2-0B5A2894
    return $t_penerimaan_skpd_viewGrid_BeforeSelect;
}
//End Close t_penerimaan_skpd_viewGrid_BeforeSelect

//Page_OnInitializeView @1-19B9069A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_view; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

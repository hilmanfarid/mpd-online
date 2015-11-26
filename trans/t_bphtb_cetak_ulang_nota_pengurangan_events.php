<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-3195EBFD
function BindEvents()
{
    global $t_bphtb_registrationGrid;
    global $CCSEvents;
    $t_bphtb_registrationGrid->CCSEvents["BeforeShowRow"] = "t_bphtb_registrationGrid_BeforeShowRow";
    $t_bphtb_registrationGrid->CCSEvents["BeforeSelect"] = "t_bphtb_registrationGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_bphtb_registrationGrid_BeforeShowRow @2-9518B921
function t_bphtb_registrationGrid_BeforeShowRow(& $sender)
{
    $t_bphtb_registrationGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationGrid; //Compatibility
//End t_bphtb_registrationGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close t_bphtb_registrationGrid_BeforeShowRow @2-B99418D2
    return $t_bphtb_registrationGrid_BeforeShowRow;
}
//End Close t_bphtb_registrationGrid_BeforeShowRow

//t_bphtb_registrationGrid_BeforeSelect @2-0ABB8790
function t_bphtb_registrationGrid_BeforeSelect(& $sender)
{
    $t_bphtb_registrationGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationGrid; //Compatibility
//End t_bphtb_registrationGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_bphtb_registrationGrid_BeforeSelect @2-9B524B58
    return $t_bphtb_registrationGrid_BeforeSelect;
}
//End Close t_bphtb_registrationGrid_BeforeSelect

//Page_OnInitializeView @1-384169F4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_cetak_ulang_nota_pengurangan; //Compatibility
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

//Page_BeforeShow @1-486E6E51
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_cetak_ulang_nota_pengurangan; //Compatibility
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

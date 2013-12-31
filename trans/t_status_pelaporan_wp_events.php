<?php
//BindEvents Method @1-20E2B222
function BindEvents()
{
    global $t_laporan_status_wp;
    global $CCSEvents;
    $t_laporan_status_wp->CCSEvents["BeforeSelect"] = "t_laporan_status_wp_BeforeSelect";
    $t_laporan_status_wp->CCSEvents["BeforeShowRow"] = "t_laporan_status_wp_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_laporan_status_wp_BeforeSelect @2-5F5C3ABE
function t_laporan_status_wp_BeforeSelect(& $sender)
{
    $t_laporan_status_wp_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_status_wp; //Compatibility
//End t_laporan_status_wp_BeforeSelect

//Custom Code @77-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_laporan_status_wp_BeforeSelect @2-04D88477
    return $t_laporan_status_wp_BeforeSelect;
}
//End Close t_laporan_status_wp_BeforeSelect

//t_laporan_status_wp_BeforeShowRow @2-301553C8
function t_laporan_status_wp_BeforeShowRow(& $sender)
{
    $t_laporan_status_wp_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_status_wp; //Compatibility
//End t_laporan_status_wp_BeforeShowRow

//Custom Code @78-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_laporan_status_wp_BeforeShowRow @2-12DAAF44
    return $t_laporan_status_wp_BeforeShowRow;
}
//End Close t_laporan_status_wp_BeforeShowRow

//Page_OnInitializeView @1-37258A3D
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_wp; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

	global $selected_id;
	$selected_id = -1;
	$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

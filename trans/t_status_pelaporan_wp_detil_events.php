<?php
//BindEvents Method @1-45FA19DE
function BindEvents()
{
    global $t_laporan_status_wp_detil;
    global $CCSEvents;
    $t_laporan_status_wp_detil->CCSEvents["BeforeSelect"] = "t_laporan_status_wp_detil_BeforeSelect";
    $t_laporan_status_wp_detil->CCSEvents["BeforeShowRow"] = "t_laporan_status_wp_detil_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_laporan_status_wp_detil_BeforeSelect @2-741F9772
function t_laporan_status_wp_detil_BeforeSelect(& $sender)
{
    $t_laporan_status_wp_detil_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_status_wp_detil; //Compatibility
//End t_laporan_status_wp_detil_BeforeSelect

//Custom Code @77-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_laporan_status_wp_detil_BeforeSelect @2-E9BF1FE5
    return $t_laporan_status_wp_detil_BeforeSelect;
}
//End Close t_laporan_status_wp_detil_BeforeSelect

//t_laporan_status_wp_detil_BeforeShowRow @2-549708A9
function t_laporan_status_wp_detil_BeforeShowRow(& $sender)
{
    $t_laporan_status_wp_detil_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_status_wp_detil; //Compatibility
//End t_laporan_status_wp_detil_BeforeShowRow

//Custom Code @78-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_laporan_status_wp_detil_BeforeShowRow @2-0C363AB7
    return $t_laporan_status_wp_detil_BeforeShowRow;
}
//End Close t_laporan_status_wp_detil_BeforeShowRow

//Page_OnInitializeView @1-9CB5DC02
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_wp_detil; //Compatibility
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

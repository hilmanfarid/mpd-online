<?php
//BindEvents Method @1-7D79D14A
function BindEvents()
{
    global $t_target_realisasi_jenis_bulanForm;
    global $t_target_realisasiGrid;
    $t_target_realisasi_jenis_bulanForm->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenis_bulanForm_BeforeSelect";
    $t_target_realisasiGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid_BeforeShowRow";
    $t_target_realisasiGrid->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid_BeforeSelect";
}
//End BindEvents Method

//t_target_realisasi_jenis_bulanForm_BeforeSelect @726-FC201116
function t_target_realisasi_jenis_bulanForm_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenis_bulanForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulanForm; //Compatibility
//End t_target_realisasi_jenis_bulanForm_BeforeSelect

//Custom Code @890-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$t_target_realisasi_jenis_bulanForm->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_target_revenue_id", NULL);
//Close t_target_realisasi_jenis_bulanForm_BeforeSelect @726-D1C09105
    return $t_target_realisasi_jenis_bulanForm_BeforeSelect;
}
//End Close t_target_realisasi_jenis_bulanForm_BeforeSelect

//t_target_realisasiGrid_BeforeShowRow @2-52730172
function t_target_realisasiGrid_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeShowRow

//Custom Code @725-2A29BDB7
// -------------------------
    // Write your own code here.
	 $target = $Component->DataSource->target_amount->GetValue();
	 $realisasi = $Component->DataSource->realisasi_amt->GetValue();
	 $penalty = $Component->DataSource->penalty_amt->GetValue();
	 $debt = $Component->DataSource->debt_amt->GetValue();
	 if(!empty($target)) {
	 	$percent = number_format(($realisasi+$penalty+$debt) / $target * 100, 2, ".", ",");
	 }else {
		$percent = 0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $Component->total_amt->SetValue($realisasi+$penalty+$debt);
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid_BeforeShowRow @2-DFE61ABB
    return $t_target_realisasiGrid_BeforeShowRow;
}
//End Close t_target_realisasiGrid_BeforeShowRow

//t_target_realisasiGrid_BeforeSelect @2-EC247A5A
function t_target_realisasiGrid_BeforeSelect(& $sender)
{
    $t_target_realisasiGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeSelect

//Custom Code @735-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid_BeforeSelect @2-EF6BE882
    return $t_target_realisasiGrid_BeforeSelect;
}
//End Close t_target_realisasiGrid_BeforeSelect


?>

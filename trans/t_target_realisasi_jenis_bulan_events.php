<?php
//BindEvents Method @1-B9724E6F
function BindEvents()
{
    global $t_target_realisasi_jenis_bulanForm;
    $t_target_realisasi_jenis_bulanForm->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenis_bulanForm_BeforeSelect";
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
	$t_target_realisasi_jenis_bulanForm->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_target_revenue_id", NULL);
//Close t_target_realisasi_jenis_bulanForm_BeforeSelect @726-D1C09105
    return $t_target_realisasi_jenis_bulanForm_BeforeSelect;
}
//End Close t_target_realisasi_jenis_bulanForm_BeforeSelect


?>

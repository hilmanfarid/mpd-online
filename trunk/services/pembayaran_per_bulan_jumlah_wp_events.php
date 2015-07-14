<?php
//BindEvents Method @1-CEA43884
function BindEvents()
{
    global $SELECT_target_amt_realisa;
    $SELECT_target_amt_realisa->ds->CCSEvents["AfterExecuteSelect"] = "SELECT_target_amt_realisa_ds_AfterExecuteSelect";
}
//End BindEvents Method

//SELECT_target_amt_realisa_ds_AfterExecuteSelect @2-8CC59EF0
function SELECT_target_amt_realisa_ds_AfterExecuteSelect(& $sender)
{
    $SELECT_target_amt_realisa_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SELECT_target_amt_realisa; //Compatibility
//End SELECT_target_amt_realisa_ds_AfterExecuteSelect

//Custom Code @760-2A29BDB7
// -------------------------
    // Write your own code here.
	$data = array();
	while($SELECT_target_amt_realisa->DataSource->next_record()){
		$data[] = $SELECT_target_amt_realisa->DataSource->Record;
		/*$thiskey = $SELECT_target_amt_realisa->DataSource->Record['p_finance_period_id'];
		$data[$thiskey]['arr_data'][]=$arr_items;
		$data[$thiskey]['tanggal'][]=(float)$arr_items['tanggal'];
		$data[$thiskey]['realisasi']=$arr_items['realisasi'];*/
	}
	echo json_encode($data);exit;

// -------------------------
//End Custom Code

//Close SELECT_target_amt_realisa_ds_AfterExecuteSelect @2-986B12EC
    return $SELECT_target_amt_realisa_ds_AfterExecuteSelect;
}
//End Close SELECT_target_amt_realisa_ds_AfterExecuteSelect


?>

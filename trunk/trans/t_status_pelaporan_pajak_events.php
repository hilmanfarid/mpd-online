<?php
//BindEvents Method @1-02575EF9
function BindEvents()
{
    global $t_status_pelaporan_pajakGrid;
    global $CCSEvents;
    $t_status_pelaporan_pajakGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_pajakGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_pajakGrid_BeforeShowRow @2-C7E70F22
function t_status_pelaporan_pajakGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_pajakGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajakGrid; //Compatibility
//End t_status_pelaporan_pajakGrid_BeforeShowRow

//Close t_status_pelaporan_pajakGrid_BeforeShowRow @2-E5A5F85A
    return $t_status_pelaporan_pajakGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_pajakGrid_BeforeShowRow

//Page_OnInitializeView @1-16B6BA17
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak; //Compatibility
//End Page_OnInitializeView

	global $selected_id;
	global $t_status_pelaporan_pajakGrid;

	$selected_id = -1;
	$selected_id = CCGetFromGet("p_finance_period_id", $selected_id);
	if($selected_id == -1) $t_status_pelaporan_pajakGrid->Visible= false;

	$status_lapor = CCGetFromGet("status_lapor", NULL);
	if(strpos(strtolower($status_lapor), "sudah lapor wp active") !== false){
		header("Location: ./t_status_pelaporan_pajak_sudah_lapor.php?active=1&p_finance_period_id=" . $selected_id);
	}
	if(strpos(strtolower($status_lapor), "sudah lapor wp non active") !== false){
		header("Location: ./t_status_pelaporan_pajak_sudah_lapor.php?active=0&p_finance_period_id=" . $selected_id);
	}
	if(strpos(strtolower($status_lapor), "belum lapor wp active") !== false){
		header("Location: ./t_status_pelaporan_pajak_belum_lapor.php?active=1&p_finance_period_id=" . $selected_id);
	}
	if(strpos(strtolower($status_lapor), "belum lapor wp non active") !== false){
		header("Location: ./t_status_pelaporan_pajak_belum_lapor.php?active=0&p_finance_period_id=" . $selected_id);
	}
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

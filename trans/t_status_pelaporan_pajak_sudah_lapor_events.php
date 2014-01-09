<?php
//BindEvents Method @1-CA7DBD8C
function BindEvents()
{
    global $t_status_pelaporan_pajak_sudah_laporGrid;
    global $CCSEvents;
    $t_status_pelaporan_pajak_sudah_laporGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow";
    $t_status_pelaporan_pajak_sudah_laporGrid->CCSEvents["BeforeSelect"] = "t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow @2-A5E90426
function t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_laporGrid; //Compatibility
//End t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow
	
	global $selected_id;
	if ($selected_id<0) {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
	}

//Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow @2-7710F6E9
    return $t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow

//t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect @2-E6DAD2D4
function t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect(& $sender)
{
    $t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_laporGrid; //Compatibility
//End t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect

//Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect @2-7E58EF2F
    return $t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect;
}
//End Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect

//Page_OnInitializeView @1-A516E3F0
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_lapor; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
		global $selected_id;
		$selected_id = -1;
		$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);
  // -------------------------

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

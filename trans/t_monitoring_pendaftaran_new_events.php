<?php
include(RelativePath . "/include/create_dynamic_table.php");
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-7483D7DD
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_monitoring_pendaftaran_new; //Compatibility
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

//Page_BeforeShow @1-CED37798
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_monitoring_pendaftaran_new; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
	$param_arr['nilai'] = CCGetFromGet('nilai');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	$param_arr['year_code'] = CCGetFromGet('year_code');
	$param_arr['code'] = CCGetFromGet('code');
	if($doAction == 'view_html') {
		$Label1->SetText(GetCetakHTML($param_arr));
	}
	if($doAction == 'view_excel') {
		$Label1->SetText(GetCetakExcel($param_arr));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($param_arr) {
	
	$output = '';
	$DBConn = new clsDBConnSIKP();
	$SQL = "select replace(replace(f_monitor_tipro_daftar_v2(1,".$param_arr['nilai'].",".$param_arr['p_finance_period_id'].",".$param_arr['p_vat_type_id']."),'(\"',''),'\")','') from dual";	
	//die($SQL);
	$DBConn->query($SQL);
		  
	return create_table_grid ($DBConn, "INFORMASI MONITORING", "", $qs, "Y", $arrJml, "2");
}

?>

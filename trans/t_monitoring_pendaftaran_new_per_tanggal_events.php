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

//Page_OnInitializeView @1-2C83A54A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_monitoring_pendaftaran_new_per_tanggal; //Compatibility
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

//Page_BeforeShow @1-116013A9
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_monitoring_pendaftaran_new_per_tanggal; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
	$param_arr['date_start_laporan'] = CCGetFromGet('date_start_laporan');
	$param_arr['date_end_laporan'] = CCGetFromGet('date_end_laporan');
	$param_arr['nilai'] = CCGetFromGet('nilai');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
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
	$SQL = "select replace(replace(f_monitor_tipro_daftar_per_tanggal(1,"
	.$param_arr['nilai'].",'".$param_arr['date_start_laporan']."','".$param_arr['date_end_laporan']."',"
	.$param_arr['p_vat_type_id']."),'(\"',''),'\")','') from dual";	
	//die($SQL);
	$DBConn->query($SQL);
		  
	return create_table_grid ($DBConn, "INFORMASI MONITORING", "", $qs, "Y", $arrJml, "2");
}

?>

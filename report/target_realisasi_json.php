<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "target_realisasi_json.php");
include_once(RelativePath . "/Common.php");

$dbConn = new clsDBConnSIKP();

$query="select * from t_target_realisasi_sementara
		ORDER BY p_vat_type_id";

$dbConn->query($query);
$item=array();
$json = array('items'=>array(),'message'=>'data ditemukan','success'=>'1');
while ($dbConn->next_record()) {	
	$item[] = array(
		'p_vat_type_id' => $dbConn->f("p_vat_type_id"),
		'jenis_pajak' => $dbConn->f("jenis_pajak"),
		'target_tahunan' => $dbConn->f("target_tahunan"),
		'target_triwulan' => $dbConn->f("target_triwulan"),
		'realisasi_tahunan' => $dbConn->f("realisasi_tahunan"),
		'realisasi_triwulan' => $dbConn->f("realisasi_triwulan"),
		'start_date' => $dbConn->f("start_date"),
		'end_date' => $dbConn->f("end_date")
		);	
}
if (empty($item)) {
	$json = array('items'=>array(),'message'=>'data tidak ditemukan','success'=>'0');
}
$json['items']=$item;
$json=json_encode ($json);
echo( ($json));
$dbConn->close();


?>

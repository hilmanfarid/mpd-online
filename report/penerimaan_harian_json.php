<?php
ob_start(); 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Status, WeFindErrorCode, WeFindErrorDesc");
header("Access-Control-Allow-Methods: OPTIONS, POST, GET, UPDATE, DELETE");
header('Content-Type: text/javascript; charset=UTF-8');

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "target_realisasi_json.php");
include_once(RelativePath . "/Common.php");

$dbConn = new clsDBConnSIKP();

$query="SELECT 
		united.p_vat_type_id,
		united.vat_code, 
		united.payment_vat_amount
		FROM (
		(SELECT b.p_vat_type_id, b.vat_code, 
		sum(jml_hari_ini) as payment_vat_amount 
		from f_rep_harian_global(to_char(sysdate,'dd-mm-yyyy')) a 
		left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id 
		where b.p_vat_type_id NOT IN (7)
		GROUP BY  b.p_vat_type_id, b.vat_code 
		ORDER BY b.p_vat_type_id
		)
		) AS united
		where p_vat_type_id not in (8,9,10)
		ORDER BY united.p_vat_type_id ASC";

$dbConn->query($query);
$item=array();
$json = array('items'=>array(),'message'=>'data ditemukan','success'=>'1');
while ($dbConn->next_record()) {	
	$item[] = array(
		'p_vat_type_id' => $dbConn->f("p_vat_type_id"),
		'jenis_pajak' => $dbConn->f("vat_code"),
		'realisasi' => $dbConn->f("payment_vat_amount")
		);	
}

//PBB
$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/pbb/pokok/'.date("d-m-Y"));
$ws_data = json_decode($ws_data);
$pbb = str_replace('.','',$ws_data->nilai);

if($pbb!='' && $pbb>0){
	$item[] = array(
		'p_vat_type_id' => 8,
		'jenis_pajak' => "PBB",
		'realisasi' => $pbb 
		);	
}

//PAT
$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/pat/pokok/'.date("d-m-Y"));
$ws_data = json_decode($ws_data);
//print_r(str_replace('.','',$ws_data->nilai));exit;
$pat = str_replace('.','',$ws_data->nilai);	
if($pat!='' && $pat>0){
	$item[] = array(
		'p_vat_type_id' => 9,
		'jenis_pajak' => "PAT",
		'realisasi' => $pat 
		);	
}

//REKLAME
$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/reklame/pokok/'.date("d-m-Y"));
$ws_data = json_decode($ws_data);
$reklame = str_replace('.','',$ws_data->nilai);
if($reklame!='' && $reklame>0){
	$item[] = array(
		'p_vat_type_id' => 10,
		'jenis_pajak' => "REKLAME",
		'realisasi' => $reklame 
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

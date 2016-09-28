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


$p_vat_type_id = CCGetFromGet("p_vat_type_id", 1);
$month = CCGetFromGet("month", 1);
$year = CCGetFromGet("year", 2016);
$dbConn = new clsDBConnSIKP();

if(1>$month || $month>12){
	$month = 1;
}

$query="select * from t_cust_account 
where 
p_vat_type_id = ".$p_vat_type_id."
and creation_date BETWEEN to_date('01-'||lpad('".$month."', 2,'0')||'-".$year."') 
	and (date_trunc('MONTH', to_date('01-'||lpad('".$month."', 2,'0')||'-".$year."')) + INTERVAL '1 MONTH - 1 day')::DATE
ORDER BY company_brand";

$dbConn->query($query);
$item=array();
$json = array('items'=>array(),'message'=>'data ditemukan','success'=>'1');
while ($dbConn->next_record()) {	
	$item[] = array(
		't_cust_account_id' => $dbConn->f("t_cust_account_id"),
		'npwd' => $dbConn->f("npwd"),
		'p_vat_type_id' => $dbConn->f("p_vat_type_id"),
		'p_account_status_id' => $dbConn->f("p_account_status_id"),
		'wp_name' => $dbConn->f("wp_name"),
		'wp_address_name' => $dbConn->f("wp_address_name"),
		'company_brand' => $dbConn->f("company_brand"),
		'brand_address_name' => $dbConn->f("brand_address_name"),
		'p_vat_type_dtl_id' => $dbConn->f("p_vat_type_dtl_id"),
		'npwpd_jabatan' => $dbConn->f("npwpd_jabatan")
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

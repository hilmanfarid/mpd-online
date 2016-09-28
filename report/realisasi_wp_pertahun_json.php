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
$npwpd = CCGetFromGet("npwpd", '');
$year = CCGetFromGet("year", 2016);
$dbConn = new clsDBConnSIKP();

if ($npwpd == ''){
	$json = array('items'=>array(),'message'=>'npwpd kosong,data tidak ditemukan','success'=>'0');
	$json=json_encode ($json);
	echo( ($json));
	exit;
}

$query="SELECT x.code,'".$npwpd."' as npwpd,to_char(x.start_date,'MM') as month,to_char(x.start_date,'yyyy')as year,nvl(realisasi,0) as realisasi
FROM p_finance_period x
left join p_year_period z on z.p_year_period_id = x.p_year_period_id
left join (
	select a.p_finance_period_id,a.code,npwd,sum(c.payment_amount) as realisasi
	from p_finance_period a
	left join p_year_period b on a.p_year_period_id = b.p_year_period_id
	left join t_payment_receipt c on c.p_finance_period_id = a.p_finance_period_id 
	WHERE year_code = '".$year."'
		and npwd = '".$npwpd."'
		and c.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl WHERE p_vat_type_id=".$p_vat_type_id.")
		GROUP BY a.code,c.npwd,a.start_date,a.p_finance_period_id
) y on x.p_finance_period_id = y.p_finance_period_id
where year_code = '".$year."'
ORDER BY x.start_date";

$dbConn->query($query);
$item=array();
$json = array('items'=>array(),'message'=>'data ditemukan','success'=>'1');
while ($dbConn->next_record()) {	
	$item[] = array(
		'p_vat_type_id' => $dbConn->f("p_vat_type_id"),
		'npwpd' => $dbConn->f("npwpd"),
		'month' => $dbConn->f("month"),
		'year' => $dbConn->f("year"),
		'realisasi' => $dbConn->f("realisasi")
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

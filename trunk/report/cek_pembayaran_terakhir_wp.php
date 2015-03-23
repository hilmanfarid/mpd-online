<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");

$npwpd = CCGetFromGet("npwpd", "");

$dbConn = new clsDBConnSIKP();

$query="select * from t_payment_receipt where npwd = upper('".$npwpd."')
		ORDER BY payment_date desc limit 1";

$dbConn->query($query);
$data=array();
if ($dbConn->next_record()) {
	$json = array('items'=>array(),'message'=>'data ditemukan','success'=>'success');
	$item = array(
		'npwd' => $dbConn->f("npwd"),
		'payment_vat_amount' => $dbConn->f("payment_vat_amount"),
		'finance_period_code' => $dbConn->f("finance_period_code")
		);
	$json['items']=$item;
	print_r( ($json));
}else{
	$json = array('items'=>array(),'message'=>'data tidak ditemukan','success'=>'fail');
	echo json_encode($json);
}
$dbConn->close();


?>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");
$return = file_get_contents('http://202.154.24.4:81/webservice-pbb/trans/bphtb_webservice.php?method=realisasi&param='.date('Y-m-d'));
$return = json_decode($return);
if($return->success){
	$opts = array( 'http'=>array( 'method'=>"GET",
              'header'=>"Accept-language: en\r\n" .
               "Cookie: WEBISID=".session_id()."\r\n" ) );

	$context = stream_context_create($opts);
	session_write_close();   // this is the key
	$return = file_get_contents('http://202.154.24.4:81/server/ws.php?type=json&module=base&class=roles.dologin&method=login&username=jaktap&password=jaktap123', false, $context);
	//echo $return;
	//exit;
	$return = file_get_contents('http://202.154.24.4:81/server/ws.php?type=json&module=bds&class=t_payment_receipt_skpd&method=syncPaymentReceipt&code=110801&payment_date='.date('Y-m-d').'&payment_vat_amount=190000', false, $context);
	echo $return;
}else{
	echo 'Gagal untuk me-retrieve data realisasi';
}
?>
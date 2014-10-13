<?php
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");
if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

    // Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}
$nmrHP=$_POST['user_hp'];
$eMail=$_POST['user_email'];
$sms='';
$dbConn = new clsDBConnSIKP();
$sql = " select f_send_verification_code('" . $nmrHP . "','" . $eMail . "','" . $sms. "') as hasil ";
$dbConn->query($sql);
$dbConn->next_record();
$_SESSION['verification_code']=$dbConn->Record['hasil'];
//$output=file_get_contents('http://localhost/mpd-online/include/excel/curl_tes.php?npwd=registration&no_telp='.$nmrHP.'&message=Kode+anda+'.$dbConn->Record['hasil']);
//echo $output;
print_r(json_encode($dbConn->Record));
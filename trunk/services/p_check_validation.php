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
$refkode=$_SESSION['verification_code'];
$verifkode=$_POST['validation_code_Name'];
$dbConn = new clsDBConnSIKP();
$sql = " select f_validate_verification_code('" . $refkode . "','" . $verifkode . "') as hasil ";
$dbConn->query($sql);
$dbConn->next_record();
print_r(json_encode(array('hasil' => $dbConn->Record['hasil'])));
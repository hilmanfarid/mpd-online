<?php
	define("RelativePath", "..");
	define("PathToCurrentPage", "/report/");
	define("FileName", "cetak_registrasi.php");
	include_once(RelativePath . "/Common.php");

	$dbConn = new clsDBConnSIKP();
	
	$t_customer_order_id = CCGetFromGet("t_customer_order_id");
	$user = CCGetSession('UserLogin');
	
	$sql = "select f_print_register_new($t_customer_order_id, '$user')";
	
	$dbConn->query($sql);
	$dbConn->next_record();
	echo $dbConn->f('f_print_register_new');
?>
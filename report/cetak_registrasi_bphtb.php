<?php
	define("RelativePath", "..");
	define("PathToCurrentPage", "/report/");
	define("FileName", "cetak_registrasi_bphtb.php");
	include_once(RelativePath . "/Common.php");

	$dbConn = new clsDBConnSIKP();
	
	$t_customer_order_id = CCGetFromGet("no_registration");
	$user = CCGetSession('UserLogin');
	
	$sql = "select sikp.f_print_register_new_bphtb('$t_customer_order_id', '$user')";
	
	$dbConn->query($sql);
	$dbConn->next_record();
	echo $dbConn->f('f_print_register_new_bphtb');
?>
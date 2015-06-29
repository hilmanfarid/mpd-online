<?php
	define("RelativePath", "..");
	include_once(RelativePath . "/Common2.php");
	$dbConn	= new clsDBConnSIKP();
	$code = $_GET['link'];
	$query = "SELECT real_link from t_short_link where code='".$code."'";
	$dbConn->query($query);
	$item = $dbConn->next_record();
	header("Location : ".$dbConn->f('real_link'));
?>
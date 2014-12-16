<?php
error_reporting(E_ALL ^ E_WARNING ^ E_DEPRECATED);
define("RelativePath", "../..");
	define("PathToCurrentPage", "/include/excel/");	
	define("FileName", "curl_tes_2.php"); 	
	include_once(RelativePath . "/Common.php");

function sendSms(){
	
    include 'save_excel_2.php';
	include '../../gammu/send_sms.php';

	$SendSms = new SendSms();	

	$dbConn	= new clsDBConnSIKP();
	$query = "SELECT * FROM t_sms_outbox where is_sent = 'N'";
	$dbConn->query($query);
	$data = array();
	while ($dbConn->next_record()) {
		$data[]=$item = array (
		    't_sms_outbox_id' => $dbConn->f("t_sms_outbox_id"), 	
			'npwpd' => $dbConn->f("npwpd"), 	
			'mobile_no' => $dbConn->f("mobile_no"), 	
			'message' => $dbConn->f("message"),
			'is_sent' => $dbConn->f("is_sent"),
			'date_sent' => $dbConn->f("date_sent"),
			'date_addded' => $dbConn->f("date_addded")
		);
		
		$SendSms->send($item["mobile_no"],$item["message"]);
	}
	
	for($counter = 0;$counter < sizeof($data);$counter++){
		$query=" UPDATE t_sms_outbox
	   		SET is_sent='Y',date_sent=sysdate
	 		WHERE t_sms_outbox_id=".$data[$counter]['t_sms_outbox_id'];
		$dbConn->query($query);
	}
	
}
sendSms();
<?php
/*
 * Simple tes file for Sending SMS to radnet web service 
 */ 

$ch = curl_init();
$url = "http://sms.radsby.net/api/sms/send/format/json";
// --- for xml output use: format/xml eg:http://localhost/radnet/api/sms/send/format/xml

$postdata[] = array('no'=>'081321192756','msg'=>'tes1');
$postdata[] = array('no'=>'085624124368','msg'=>'tes2');

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('body' => json_encode($postdata))));


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

//echo $server_output;
	$op = json_decode($server_output,true);
	echo 'Error Code : '.$op['error_code'].'<br>';
	echo 'Total Inserted : '.$op['inserted'].'<br>';
	echo 'Total Failed : '.$op['failed'].'<br>';
	if(isset($op['failed_no'])) echo 'Failed Number : '.implode(', ',$op['failed_no']);

/*LIST OF ERROR CODE 
 * 000 -> No error
 * 001 -> invalid post data
 * 002 -> Failed insert to db
 */ 

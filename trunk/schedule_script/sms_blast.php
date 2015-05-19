<?php
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");

while(true){
	try{
		sleep(1);
		echo "getting the message......\n";
		$dbConn = new clsDBConnSIKP();
		$sql = " select * from t_sms_outbox where message_type = 'SMS_BLAST' and is_sent='N'";
		$dbConn->query($sql);
		
		$dbConn->next_record();
		$rec = $dbConn->Record;
		print_r($rec);
		echo "\n";
		if(!empty($rec['t_sms_outbox_id'])){
			$nmrHP = $rec['mobile_no'];
			$url = 'http://172.16.20.2:81/mpd/include/excel/curl_tes_decode.php?npwd=registration&no_telp='.$nmrHP.'&message='.base64_encode($dbConn->Record['message']);
			$output=file_get_contents($url);
			$sql = " update t_sms_outbox set is_sent='Y' where t_sms_outbox_id=".$rec['t_sms_outbox_id'];
			$dbConn->query($sql);
		}
	}catch(Exception $e){
		$dbConn->close();
		pg_close($dbConn->Provider->Link_ID);
		continue;
	}
	$dbConn->close();
	pg_close($dbConn->Provider->Link_ID);
	echo "========================================\n";
}
/*while(true){
	sleep(1);
	echo "getting the message......\n";
	$dbConn = new clsDBConnSIKP();
	$sql = " select * from t_sms_outbox where message_type = 'SMS_BLAST' and is_sent='N'";
	$dbConn->query($sql);
	
	$dbConn->next_record();
	$rec = $dbConn->Record;
	print_r($rec);
	echo "\n";
	if(!empty($rec['t_sms_outbox_id'])){
		$nmrHP = $rec['mobile_no'];
		$url = 'http://172.16.20.2:81/mpd/include/excel/curl_tes_decode.php?npwd=registration&no_telp='.$nmrHP.'&message='.base64_encode($dbConn->Record['message']);
		$output=file_get_contents($url);
		$sql = " update t_sms_outbox set is_sent='Y' where t_sms_outbox_id=".$rec['t_sms_outbox_id'];
		$dbConn->query($sql);
	}
	$dbConn->close();
}*/
/*	function sendSMS($outbox_id){
		echo "getting the message......\n";
		$dbConn = new clsDBConnSIKP();
		$sql = " select * from t_sms_outbox where t_sms_outbox_id =".$outbox_id;
		$dbConn->query($sql);
		
		$dbConn->next_record();
		$rec = $dbConn->Record;
		//print_r($rec);
		//echo "\n";
		if(!empty($rec['t_sms_outbox_id'])){
			$nmrHP = $rec['mobile_no'];
			$url = 'http://172.16.20.2:81/mpd/include/excel/curl_tes_decode.php?npwd=registration&no_telp='.$nmrHP.'&message='.base64_encode($dbConn->Record['message']);
			$output=file_get_contents($url);
			$sql = " update t_sms_outbox set is_sent='Y' where t_sms_outbox_id=".$rec['t_sms_outbox_id'];
			$dbConn->query($sql);
		}
		$dbConn->close();
	}
//print_r(json_encode($dbConn->Record));*/
?>
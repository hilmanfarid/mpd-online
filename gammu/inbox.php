<?php
	define("RelativePath", "..");
	include_once('class.sms.gammu.php');
	include_once('SmsCode.php');
	include_once(RelativePath . "/Common.php");
	include_once(RelativePath . "/Template.php");
	include_once(RelativePath . "/Sorter.php");
	include_once(RelativePath . "/Navigator.php");
	//print_r($send_sms->send('081572572525','tes dari php'));
	//exit;
	$gammuclass = new gammu();
	$output = '';
	$result= $gammuclass->Get();
	$items = $result['Inbox'];
	if(!is_array($items)){
		echo 'No Message Received';
		exit;
	}
	foreach($result['Inbox'] as $item){
		echo "processing\n";
		print_r($item);
		$dbConn = new clsDBConnSIKP();
		//$number =  $item['Number'];
		$number  = str_replace("+62", "0", $item['Number']);
		$arrfunc = array('INFO');
		$mess_piece = explode(" ",$item['body']);
		$dbConn->query("INSERT INTO t_sms_inbox (mobile_no, message, is_replied, date_receive) VALUES ('$number', '".$item['body']."', 'N', sysdate)");
		$gammuclass->gammu_exe($gammuclass->gammu.' deletesms 1 '.$item['location'],&$output);
		if(in_array($mess_piece[0], $arrfunc)){
			$func = $mess_piece[0];
			$sms_code = new SmsCode();
			$sms_code->$func($number);
		}
		echo "data processed.....";
	}
<?php

	define("RelativePath", "..");
	include_once(RelativePath . "/Common.php");
	include_once(RelativePath . "/include/excel/save_excel_2.php");
	$dbConn	= new clsDBConnSIKP();
	
	$query = "SELECT * FROM t_sms_outbox where is_sent = 'N' and message_type='SMS_BLAST'";
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
	}
	
	if(count($data) < 1){
		exit;
	}
	
	$file_name = createExcel($data);
	//print_r($file_name);
	//exit;
	date_default_timezone_set('Asia/Jakarta');
	$send_date = date('Y-m-d-H-i-s');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://smsblast.radbdg.net/_libz/usersignin.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    // in real life you should use something like:
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                    array(  'loginUsername'  => 'disyanjak',
                            'loginPass'    => 'disyanjakbdg12345678',
                            'attached_type' => 'action_1',
                            'senderID'      => 'JMP000007',
                            'sender'	    => 'DISYANJAK',
                            'tanggal'	    => substr($send_date,0,10),//'2014-03-11',
							'jam1'	        => substr($send_date,11,2),//'16',
							'mnt1'	        => ''.(substr($send_date,14,2)+3).'',//'19',
                            'pesan'	        => "",
                            'tb_simpan'	    => 'Submit',
                            'login_btn'     => 'Login',
                            'nmbatch'       => ''
                          )
                    );
    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    
    $tmp_fname = tempnam("/tmp", "COOKIE");
     
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $tmp_fname);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec ($ch);
    
    curl_setopt($ch, CURLOPT_URL,"http://smsblast.radbdg.net/userarea/p/personalize_exe.php");
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $tmp_fname);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	
    // in real life you should use something like:
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                    array(  'loginUsername'  => 'disyanjak',
                            'loginPass'    => 'disyanjakbdg12345678',
                            'attached_type' => 'action_1',
                            'senderID'      => 'JMP000007',
                            'sender'	    => 'UCI',
                            'tanggal'	    => substr($send_date,0,10),//'2014-03-11',
							'jam1'	        => substr($send_date,11,2),//'16',
							'mnt1'	        => ''.(substr($send_date,14,2)+3).'',//'19',
                            'pesan'	        => "",
                            'tb_simpan'	    => 'Submit',
                            'login_btn'     => 'Login',
                            'nmbatch'       => '@' . realpath($file_name.'.xls') . ';filename='.$file_name.'.xls'
                          )
                    );
    $server_output = curl_exec ($ch);
	echo $server_output;
    if(empty($server_output)){
		for($counter = 0;$counter < sizeof($data);$counter++){
			$query=" UPDATE t_sms_outbox
				SET is_sent='Y',date_sent=sysdate
				WHERE t_sms_outbox_id=".$data[$counter]['t_sms_outbox_id'];
			$dbConn->query($query);
		}
		@unlink(realpath($file_name.'.xls'));
	}
    
    curl_close ($ch);
	//exit;
?>
<?php
function sendSms(){
    $npwd = '';
    $no_telp = '';
    $message = '';
    include 'save_excel.php';
    if(!empty($_GET)){
        $npwd = $_GET['npwd'];
        $no_telp = $_GET['no_telp'];
        $message = $_GET['message'];
    }else if(!empty($_POST)){
        $npwd = $_POST['npwd'];
        $no_telp = $_POST['no_telp'];
        $message = $_POST['message'];
    }
	$ptn = "/^0/";  // Regex
	$rpltxt = "62";  // Replacement string
	$no_telp = preg_replace($ptn, $rpltxt, $no_telp);
    $file_name = createExcel($no_telp,$npwd.'_'.time());
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
                            'pesan'	        => $message,
                            'tb_simpan'	    => 'Submit',
                            'login_btn'     => 'Login',
                            'nmbatch'       => '@' . realpath($file_name.'.xls') . ';filename='.$file_name.'.xls'
                          )
                    );
    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    
    $tmp_fname = tempnam("/tmp", "COOKIE");
     
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $tmp_fname);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec ($ch);
    
    curl_setopt($ch, CURLOPT_URL,"http://smsblast.radbdg.net/userarea/p/single_exe.php");
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $tmp_fname);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
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
                            'pesan'	        => $message,
                            'tb_simpan'	    => 'Submit',
                            'login_btn'     => 'Login',
                            'nmbatch'       => '@' . realpath($file_name.'.xls') . ';filename='.$file_name.'.xls'
                          )
                    );
    $server_output = curl_exec ($ch);
    echo $server_output;
    exit;
    curl_close ($ch);
}
sendSms();
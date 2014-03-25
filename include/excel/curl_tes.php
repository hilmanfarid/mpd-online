<?php
function sendSms(){
    include 'save_excel.php';
    if(isset($_GET)){
        $npwd = $_GET['npwd'];
        $no_telp = $_GET['no_telp'];
        $message = $_GET['message'];
    }else if(isset($_POST)){
        $npwd = $_POST['npwd'];
        $no_telp = $_POST['no_telp'];
        $message = $_POST['message'];
    }
    print_r(json_encode($_GET));
    exit;
    $file_name = createExcel($no_telp,$npwd);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://smsblast.radbdg.net/_libz/usersignin.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    // in real life you should use something like:
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                    array(  'loginUsername'  => 'radnettrial',
                            'loginPass'    => 'trial',
                            'attached_type' => 'action_1',
                            'senderID'      => 'JMP000003',
                            'sender'	    => 'INFO',
                            'tanggal'	    => '2014-03-11',
                            'jam1'	        => '16',
                            'mnt1'	        => '19',
                            'pesan'	        => $message,
                            'tb_simpan'	    => 'Submit',
                            'login_btn'     => 'Login',
                            'nmbatch'       => '@' . realpath($file_name.'.xls') . ';filename=send_sms.xls'
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
    $server_output = curl_exec ($ch);
    curl_close ($ch);
}
sendSms();
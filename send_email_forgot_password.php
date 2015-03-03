<?php
    require_once 'include/swift/lib/swift_required.php';               
    $mailConfig = array(
        'host_smtp' => 'smtp.gmail.com',
        //'username' => 'helpdesk@disyanjak.net',
        //'password' => 'disyanjakbdg'
		'username' => 'testmpd2014@gmail.com',
        'password' => 'mpdonline'
    );
    
    $transport = Swift_SmtpTransport::newInstance($mailConfig['host_smtp'], 465, "ssl")
      ->setUsername($mailConfig['username'])
      ->setPassword($mailConfig['password']);
    
    $mailer = Swift_Mailer::newInstance($transport);
    
	$html.= '<p>Anda telah mengajukan permintaan pergantian password pada aplikasi wp.disyanjak.net. 
	Username dan Password yang baru untuk akun Anda adalah sebagai berikut:</p>
	<p>	username : '.$_GET['username'].'</p>
	<p>	password baru : '.$_GET['password'].'</p>';
    $message = Swift_Message::newInstance('PENGUBAHAN PASSWORD')//SUBJECT
      ->setFrom(array($mailConfig['username'] => 'DINAS PELAYANAN PAJAK KOTA BANDUNG'))//NAME APPEAR IN INBOX (sender's name)
      ->setTo($_GET['receiver'])
      //->setBody($_GET['message'], 'text/html');
	  ->setBody($html, 'text/html');
	  /*->attach(
    Swift_Attachment::fromPath('var/attachment/image.jpg')->setFilename('myfilename.jpg')
    );*/
    $result = $mailer->send($message);
	if ($result==1){
	echo 'mail sent';
	}else{
	echo 'failed sending email';
	}
	
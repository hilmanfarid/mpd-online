<?php
    require_once 'include/swift/lib/swift_required.php';           
    $html.=    '<p>tes email in var html
    
            </p></br>';     
    $mailConfig = array(
        'host_smtp' => 'smtp.gmail.com',
        'username' => 'testmpd2014@gmail.com',
        'password' => 'mpdonline'
    );
    
    $transport = Swift_SmtpTransport::newInstance($mailConfig['host_smtp'], 465, "ssl")
      ->setUsername($mailConfig['username'])
      ->setPassword($mailConfig['password']);
    
    $mailer = Swift_Mailer::newInstance($transport);
    
    $message = Swift_Message::newInstance('MPD ONLINE')//SUBJECT
      ->setFrom(array($mailConfig['username'] => 'DINAS PELAYANAN PAJAK'))//NAME APPEAR IN INBOX (sender's name)
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
	
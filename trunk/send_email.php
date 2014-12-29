<?php
    require_once 'include/swift/lib/swift_required.php';           
    $html.=    '<p>tes email
    
            </p></br>';     
    $mailConfig = array(
        'host_smtp' => 'smtp.gmail.com',
        'username' => 'user',
        'password' => 'password'
    );
    
    $transport = Swift_SmtpTransport::newInstance($mailConfig['host_smtp'], 465, "ssl")
      ->setUsername($mailConfig['username'])
      ->setPassword($mailConfig['password']);
    
    $mailer = Swift_Mailer::newInstance($transport);
    
    $message = Swift_Message::newInstance('BOSS BANDUNG')
      ->setFrom(array($mailConfig['username'] => 'BOSS'))
      ->setTo($_GET['receiver'])
      ->setBody($_GET['message'], 'text/html');/*->attach(
    Swift_Attachment::fromPath('var/attachment/image.jpg')->setFilename('myfilename.jpg')
    );*/
    $result = $mailer->send($message);
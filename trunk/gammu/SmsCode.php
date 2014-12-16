<?php
	class SmsCode{
		private $send_sms;
		public function SmsCode(){
			include_once('send_sms.php');
			$this->send_sms = new Sendsms();
		}
		public function INFO($number){
			return $this->send_sms->send($number,'Info Dari Gammu');
		}
	}
?>
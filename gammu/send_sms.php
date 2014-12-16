<?php
	class SendSms{
		private $db;
		private $gammuClass;
		public function SendSms(){
			define("RelativePath", "..");
			include_once('class.sms.gammu.php');
			include_once(RelativePath . "/Common.php");
			$this->gammuClass = new gammu();
			$this->db = new clsDBConnSIKP();
		}
		public function send($number,$message){
			$output = '';
			$this->gammuClass->Send($number,$message,true,true,true,$output);
			return $output;
		}
	}
?>
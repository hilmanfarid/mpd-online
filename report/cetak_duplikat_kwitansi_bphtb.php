<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_duplikat_kwitansi_bphtb.php");
include_once(RelativePath . "/Common.php");
require("../include/qrcode/fpdf17/fpdf.php");

$registration_no = CCGetFromGet("registration_no", "");//'15-12-2013';

$data = array();
$dbConn = new clsDBConnSIKP();
$query = "select f_bphtb_receipt_duplicate('$registration_no')";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["f_bphtb_receipt_duplicate"] = $dbConn->f("f_bphtb_receipt_duplicate");
}
$dbConn->close();

class FormCetak extends FPDF {
	var $height = 5;
	
	function FormCetak() {
		$this->FPDF("P", "in", array(9.5, 5.5));
	}
	
	function __construct() {
		$this->FormCetak();
		$this->startY = $this->GetY();
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
	}
	
	function PageCetak($data) {
		$this->AddPage();
		$this->SetFont('Arial', '', 10);
		$this->Cell(0, $this->height, $data["f_bphtb_receipt_duplicate"], 0, 0, "L");
	}
	
	function Footer() {
		
	}
	
	function __destruct() {
		return null;
	}
}

$formulir = new FormCetak();
$formulir->PageCetak($data);
$formulir->Output();

?>

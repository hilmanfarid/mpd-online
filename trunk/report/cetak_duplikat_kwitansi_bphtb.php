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
		$this->FPDF("L", "mm", array(241.3, 139.7));
		$this->lMargin = 30;
	}
	
	function __construct() {
		$this->FormCetak();
	}
	
	function PageCetak($data) {
		$this->AddPage();
		// $this->Cell(0, $this->height, $data["f_bphtb_receipt_duplicate"], 0, 0, "L");
		
		$this->Ln(20);
		$this->SetFont('Courier', '', 14);
		$this->Cell(180, $this->height, "", "T", 0, "C");
		$this->Ln();
		$this->Cell(180, $this->height, "BUKTI PEMBAYARAN BPHTB", "", 0, "C");
		$this->Ln();
		$this->Cell(180, $this->height, "", "B", 0, "C");
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		$this->SetFont('Courier', '', 10);
		$data = explode("\n", $data["f_bphtb_receipt_duplicate"]);
		foreach($data as $datum){
			$this->Cell(241.3, $this->height, $datum, 0, 0, "L");
			$this->Ln();
		}

		$this->Cell(180, $this->height, "", "B", 0, "C");
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

<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_surat_validasi_bphtb.php");
include_once(RelativePath . "/Common.php");
require("../include/qrcode/fpdf17/fpdf.php");


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
		
		$exp_data = explode("\n", $data["f_bphtb_receipt_duplicate"]); //get no kuitansi
		$exp_data1 = explode(":", $exp_data[0]);
	
		$encImageData = '';
		$dbConn = new clsDBConnSIKP();
		$query = "select f_encrypt_str('".trim($exp_data1[1])."') AS enc_data";

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$encImageData = $dbConn->f("enc_data");
		}
		$dbConn->close();
		
		if(empty($encImageData)) {
			$encImageData = "EmptyData";
		}

		$this->Image('../images/logo_pemda.png',37,13,25,25);
		//$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,179,13,25,25,'PNG');
		$this->Image('http://172.16.20.2:81/mpd/include/qrcode/generate-qr.php?param='.encImageData,179,13,25,25,'PNG');
		
		$this->SetFont('Arial', '', 11);

		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(101, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(101, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(101, $this->height, "Jalan Wastukancana No 2", "", 0, 'C');
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(101, $this->height, "Telp. 022 4235052 - Bandung", "", 0, 'C');
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(40, $this->height + 7, "", "B", 0, 'L');
		$this->Cell(101, $this->height + 7, "Surat Validasi BPHTB", "B", 0, 'C');
		$this->Cell(40, $this->height + 7, "", "B", 0, 'L');

		$this->Ln(5);
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


$registration_no = CCGetFromGet("registration_no", "");//'15-12-2013';

$start_date = CCGetFromGet("start_date", "");//'15-12-2013';
$end_date = CCGetFromGet("end_date", "");//'15-12-2013';

$dbConn = new clsDBConnSIKP();
$dbConn2 = new clsDBConnSIKP();
$data = array();

if(!empty($registration_no)) {
	$query = "select f_bphtb_receipt_duplicate('$registration_no')";
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data["f_bphtb_receipt_duplicate"] = $dbConn->f("f_bphtb_receipt_duplicate");
	}

	$formulir = new FormCetak();
	$formulir->PageCetak($data);
	$formulir->Output();
}else {
	$query = "SELECT registration_no FROM
				t_bphtb_registration
				WHERE trunc(creation_date) BETWEEN '".$start_date."' AND '".$end_date."'
				AND status_verifikasi = 'Y'";
	
	$formulir = new FormCetak();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$query2 = "select f_bphtb_receipt_duplicate('".$dbConn->f('registration_no')."')";
		$dbConn2->query($query2);
		
		while ($dbConn2->next_record()) {
			$data["f_bphtb_receipt_duplicate"] = $dbConn2->f("f_bphtb_receipt_duplicate");
			$formulir->PageCetak($data);
		}
	}
	$dbConn2->close();
	$formulir->Output();
}


$dbConn->close();

?>

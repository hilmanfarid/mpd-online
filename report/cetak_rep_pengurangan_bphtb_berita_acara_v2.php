<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_bpps.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$t_bphtb_registration_id		= CCGetFromGet("t_bphtb_registration_id", "");

// $t_bphtb_registration_id		= 23;

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select a.*,
b.region_name as wp_region,
c.region_name as wp_region_kec,
d.region_name as wp_region_kel,
e.region_name as object_region,
f.region_name as object_region_kec,
g.region_name as object_region_kel,
h.description as doc_name

from t_bphtb_registration as a 
left join p_region as b
	on a.wp_p_region_id = b.p_region_id
left join p_region as c
	on a.wp_p_region_id_kec = c.p_region_id
left join p_region as d
	on a.wp_p_region_id_kel = d.p_region_id
left join p_region as e
	on a.object_p_region_id = e.p_region_id
left join p_region as f
	on a.object_p_region_id_kec = f.p_region_id
left join p_region as g
	on a.object_p_region_id_kel = g.p_region_id
left join p_bphtb_legal_doc_type as h
	on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
where a.t_bphtb_registration_id = $t_bphtb_registration_id";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["wp_name"]				= $dbConn->f("wp_name");
	$data["npwp"]					= $dbConn->f("npwp");
	$data["wp_address_name"]		= $dbConn->f("wp_address_name");
	$data["wp_rt"]					= $dbConn->f("wp_rt");
	$data["wp_rw"]					= $dbConn->f("wp_rw");
	$data["wp_region"]				= $dbConn->f("wp_region");
	$data["wp_region_kec"]			= $dbConn->f("wp_region_kec");
	$data["wp_region_kel"]			= $dbConn->f("wp_region_kel");
	$data["njop_pbb"]				= $dbConn->f("njop_pbb");
	$data["object_address_name"]	= $dbConn->f("object_address_name");
	$data["object_rt"]				= $dbConn->f("object_rt");
	$data["object_rw"]				= $dbConn->f("object_rw");
	$data["object_region"]			= $dbConn->f("object_region");
	$data["object_region_kec"]		= $dbConn->f("object_region_kec");
	$data["object_region_kel"]		= $dbConn->f("object_region_kel");
	$data["doc_name"]				= $dbConn->f("doc_name");
	$data["land_area"]				= $dbConn->f("land_area");
	$data["land_price_per_m"]		= $dbConn->f("land_price_per_m");
	$data["land_total_price"]		= $dbConn->f("land_total_price");
	$data["building_area"]			= $dbConn->f("building_area");
	$data["building_price_per_m"]	= $dbConn->f("building_price_per_m");
	$data["building_total_price"]	= $dbConn->f("building_total_price");
	$data["market_price"]			= $dbConn->f("market_price");
	$data["npop"]					= $dbConn->f("npop");
	$data["npop_tkp"]				= $dbConn->f("npop_tkp");
	$data["npop_kp"]				= $dbConn->f("npop_kp");
	$data["bphtb_amt"]				= $dbConn->f("bphtb_amt");
	$data["bphtb_discount"]			= $dbConn->f("bphtb_discount");
	$data["bphtb_amt_final"]		= $dbConn->f("bphtb_amt_final");
	$data["registration_no"]		= $dbConn->f("registration_no");
	$data["verificated_by"]			= $dbConn->f("verificated_by");
	$data["verificated_nip"]		= $dbConn->f("verificated_nip");
	$data["jenis_harga_bphtb"]		= $dbConn->f("jenis_harga_bphtb");
	$data["description"]			= $dbConn->f("description");
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	// var $paperWSize = 330;
	// var $paperHSize = 215;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P');
	}
	
	function __construct() {
	    $this->DefPageSize = $size;
		$this->CurPageSize = $size;
		$this->FormCetak();
		$size = $this->_getpagesize("Legal");
		//$this->DefPageSize = $size;
		//$this->CurPageSize = $size;
		$this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$encImageData = '';
		$dbConn = new clsDBConnSIKP();
		$query = "select f_encrypt_str('".$data['registration_no']."') AS enc_data";

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$encImageData = $dbConn->f("enc_data");
		}
		$this->Image('../images/logo_pemda.png',10,10,20,20);
		//$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		$this->SetFont("Arial", "B", 10);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, "C");
		$this->Ln();
		$this->SetFont("Arial", "B", 14);
		$this->Cell($this->lengthCell, $this->height, "DINAS PELAYANAN PAJAK", "", 0, "C");
		$this->Ln();
		$this->SetFont("Arial", "B", 8);
		$this->Cell($this->lengthCell, $this->height, "Jl. Wastukencana No. 2 Telp : (022) 4235052", "B", 0, "C");
		$this->Ln();
		//$this->newLine();
		//$this->Cell($this->lengthCell, $this->height, "JENIS TRANSAKSI: ".strtoupper($data['doc_name']), "", 0, "C");
		//$this->Ln();
		//$this->Cell($this->lengthCell, $this->height, "NO REGISTRASI: ".strtoupper($data['registration_no']), "", 0, "C");
		
		$this->newLine();
		
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;
		
		$this->SetFont("Arial", "B", 8);
		$this->SetWidths(array($this->lengthCell));
		$this->SetAligns(array("C"));
		$this->RowMultiBorderWithHeight(
			array
			(	"BERITA ACARA"
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Ln();

		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($this->lengthCell));
		$this->SetAligns(array("J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Pada hari "."Senin"." tanggal "."dua puluh bulan oktober dua ribu empat belas.".
				" Berdasarkan hasil pengkajian baik dari sisi administratif maupun normatif, yang telah kami lakukan,".
				" kami selaku Tim Pengkaji Keringanan Dan Pengurangan BPHTB telah mengkaji permohonan BPHTB Waris yang diajukan oleh pemohon dengan data teknis sebagai berikut :"
			),
			array
			(
				""
			),
			$this->height-1);
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($this->length - $lbody1, $this->height, "Subjek Pajak", "", 0, "");
		$this->Ln();
		$this->barisBaru("", "1 Nama Wajib Pajak", ": " . $data["wp_name"]);
		$this->barisBaru("", "2 Ahli Waris", ": Departemen Dalam Negeri");
		$this->barisBaru("", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
		$this->barisBaru("", "4 RT/RW", ": RT. " . $data["wp_rt"] . "/RW. " .  $data["wp_rw"]);
		$this->barisBaru("", "5 Kelurahan", ": " . $data["wp_region_kel"]);
		$this->barisBaru("", "6 Kecamatan", ": " . $data["wp_region_kec"]);
		$this->barisBaru("", "7 Kabupaten/Kota", ": " . $data["wp_region"]);
		$this->Ln();
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($this->length - $lbody1, $this->height, "Objek Pajak", "", 0, "");
		$this->Ln();
		$this->barisBaru("", "1 NOP PBB ", ": " . $data["njop_pbb"]);
		$this->barisBaru("", "2 Alamat", ": " . $data["object_address_name"]);
		$this->barisBaru("", "3 Luas Tanah", ": " . $data["land_area"]);
		$this->barisBaru("", "4 Luas Bangunan", ": " . $data["building_area"]);
		$this->barisBaru("", "5 RT/RW", ": RT. " . $data["object_rt"] . "/RW. " . $data["object_rw"]);
		$this->barisBaru("", "6 Kelurahan", ": " . $data["object_region_kel"]);
		$this->barisBaru("", "7 Kecamatan", ": " . $data["object_region_kec"]);
		$this->barisBaru("", "8 Kabupaten/Kota", ": " . $data["object_region"]);
		$this->Ln();
		$lbody15 = $lbody * 15;
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody4+10, $this->height, "Akta/ Risalah Lelang/ Keputusan", "", 0, "");
		$this->SetFont("Arial", "", 8);
		$this->Cell($lbody15-10, $this->height, ": Akta Keterangan Hak Atas Waris Kecamatan Sukajadi", "", 0, "");
		$this->Ln();
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody4+10, $this->height, "Pemberian Hak/ Putusan Hakim/", "", 0, "");
		$this->Ln();
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody4+10, $this->height, "Dokumen lainnya", "", 0, "");
		$this->Ln();
		$this->Ln();
		$this->barisBaru("", "- Nomor", ": " . "291/HM/BPN 32.73/2014");
		$this->barisBaru("", "- Tanggal", ": " . "08 Oktober 2014");
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody4+10, $this->height, "NJOP", "", 0, "");
		$this->SetFont("Arial", "", 8);
		$this->Cell($lbody15-10, $this->height, ": Rp 1.000.000,00", "", 0, "");
		$this->Ln();
		$this->Ln();
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody1, $this->height, "1", "", 0, "");
		$this->SetWidths(array($this->lengthCell-$lbody1-$lbody1));
		$this->SetAligns(array("J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Bahwa ".$data["wp_name"]." merupakan ahli waris dari "."Tn. Alm Anwar Arifin (ayah) dan Ny. Rd. Pursitaningsih. ".
				"Akta Keterangan Hak Atas Waris Kecamatan No "."590/76-Kec.Cddp"." tanggal "."14 Agustus 2014"
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody1, $this->height, "2", "", 0, "");
		$this->SetWidths(array($this->lengthCell-$lbody1-$lbody1));
		$this->SetAligns(array("J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Secara normatif, bedasarkan Pasal 17 Ayat 3 huruf a angka 4 Peraturan Walikota Nomor 308 Tahun 2012 bahwa Pemberian pengurangan dan keringanan dapat diberikan kepada Wajib Pajak orang pribadi yang menerima hibah dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau satu derajat ke bawah, sebesar 50% (lima puluh persen) yang didukung oleh bukti akta hibah dari notaris yang berdasarkan ketentuan yang berlaku. Di luar garis keturunan tersebut tidak memperoleh hak keringanan atau pengurangan."
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Ln(2);
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->SetWidths(array($this->lengthCell-$lbody1-$lbody1));
		$this->SetAligns(array("J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Hasil Perhitungan sebagai berikut :"
			),
			array
			(
				""
			),
			$this->height);
		$this->barisBaru2($lbody1+$lbody1, "- Nilai Perolehan Objek Pajak (NPOP)", "", "Rp", $data["npop"]);
		$this->barisBaru2($lbody1+$lbody1, "- Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)", "", "Rp", $data["npop_tkp"]);
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1+$lbody1, "- Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp","NIHIL");
		}else{
			$this->barisBaru2($lbody1+$lbody1, "- Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp", $data["npop_kp"]);
		}
		
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", "NIHIL");
		}else{
			$this->barisBaru2($lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", $data["bphtb_amt"]);
		}

		$this->Cell($lbody1+$lbody1, $this->height, "", "", 0, "");
		$this->Cell($this->length - $lbody1 - $lbody1, $this->height, "- Pengenaan Pengurangan Karena "."Waris", "", 0, "");
		$this->Ln();
		$this->barisBaru2($lbody1+$lbody1, "- Besaran Pengenaan Pengurangan ", "50%", "Rp", $data["bphtb_discount"]);

		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", "NIHIL");
		}else{
			$this->barisBaru3($lbody1+$lbody1, "- Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"]);
		}

		$this->Cell($lbody1+$lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbody1+ $lbody1+$lbody1, $this->height, "Terbilang :", "", 0, "");
		$this->SetFont("Arial", "iB", 8);
		$this->Cell($this->length - $lbody1- $lbody1- $lbody1 -$lbody1, $this->height, "Sekian Juta Sekian ratus ribu sekian puluh ribu sekian ribu sekian ratus rupiah", "", 0, "");
		$this->Ln(7);

		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($this->lengthCell));
		$this->SetAligns(array("J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Demikian Berita Acara ini dibuat dengan sebenarnya. Apabila dikemudian hari ternyata terdapat kekeliruan dalam Berita Acara Pengkajian akan dibetulkan sebagaimana mestinya."
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Ln();			
	}

	function signaturePage() {
		$this->AliasNbPages();
		$this->AddPage("P");
		$encImageData = '';

		//$this->Image('../images/logo_pemda.png',10,10,20,20);
		//$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		$lbody = $this->lengthCell / 10;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody6 = $lbody * 6;
		
		/*$this->Cell($lbody1, $this->height, "1", "BLTR", 0, "R");
		$this->Cell($lbody4, $this->height, "KASI PENYELESAIAN PIUTANG", "BLTR", 0, "l");
		$this->Cell($this->lengthCell-$lbody1-$lbody4, $this->height, "", "BLTR", 0, "l");*/
		$this->SetWidths(array($lbody1,$lbody4,$this->lengthCell-$lbody1-$lbody4));
		$this->SetAligns(array("R","L","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	1,
				"KASI PENYELESAIAN PIUTANG \nRACHMAT SATIADI, S.IP, M.Si \nPembina \nNIP. 09691104 1998031 007",
				"1)\n\n\n_________________________________________"
			),
			array
			(
				"","",""
			),
			$this->height);
		$this->Ln();

		$this->SetWidths(array($lbody1,$lbody4,$this->lengthCell-$lbody1-$lbody4));
		$this->SetAligns(array("R","L","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	2,
				"PETUGAS PEMERIKSA \nACEP AKHMAD TAUFIK G \nPranata Muda Tk I \nNIP. 19591021 198603 1 009",
				"2)\n\n\n_________________________________________"
			),
			array
			(
				"","",""
			),
			$this->height);

		$this->Ln();
		$this->SetWidths(array($lbody1,$lbody4,$this->lengthCell-$lbody1-$lbody4));
		$this->SetAligns(array("R","L","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	3,
				"PETUGAS ADMINISTRASI\nE. GANDA PERMANA K \nPenata \nNIP. 19740304 200604 1 017",
				"3)\n\n\n_________________________________________"
			),
			array
			(
				"","",""
			),
			$this->height);
	}
	
	function barisBaru3($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell($subtractor, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$this->SetFont("Arial", "", 8);
		$this->Ln();
	}

	function barisBaru2($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell($subtractor, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$this->Ln();
	}

	function barisBaruStr($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell($subtractor, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, " ", "", 0, "L");
		$this->Cell($lbodyx2, $this->height, $data, "", 0, "R");
		$this->Ln();
	}
	
	function barisBaru($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$this->Cell($lbody4+10, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15-10));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}

	function barisBaru_special($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1, $this->height, "$section", "", 0, "L");
		//$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		$this->SetWidths(array($lbody4+10,$lbody15-10));
		$this->SetAligns(array("J","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	"$field",$data
			),
			array
			(
				"",""
			),
			$this->height);
		
		/*$this->SetWidths(array($lbody15));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);*/
	}
	
	function barisBaru_bold($section, $field, $data){
		$this->SetFont("Arial", "B", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1, $this->height, "$section", "", 0, "L");
		//$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		$this->SetWidths(array($lbody4+10));
		$this->SetAligns(array("J","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	"$field"
			),
			array
			(
				""
			),
			$this->height);
		
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody15-10));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(
			array
			(	$data
			),
			array
			(
				""
			),
			$this->height);
		
		/*$this->SetWidths(array($lbody15));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);*/
	}
	
	function newLine(){
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function kotakKosong($pembilang, $penyebut, $jumlahKotak){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, "", "LR", 0, 'L');
		}
	}
	
	function kotak($pembilang, $penyebut, $jumlahKotak, $isi){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, $isi, "TBLR", 0, 'C');
		}
	}
	
	function getNumberFormat($number, $dec) {
			if (!empty($number)) {
				return number_format($number, $dec);
			} else {
				return "";
			}
	}
	
	function SetWidths($w)
	{
	    //Set the array of column widths
	    $this->widths=$w;
	}

	function SetAligns($a)
	{
	    //Set the array of column alignments
	    $this->aligns=$a;
	}

	function Row($data)
	{
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
	    $h=5*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row
	    for($i=0;$i<count($data);$i++)
	    {
	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x, $y, $w, $h);
	        //Print the text
	        $this->MultiCell($w, 5, $data[$i], 0, $a);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w, $y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	}

	function CheckPageBreak($h)
	{
	    //If the height h would cause an overflow, add a new page immediately
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}
	
	function RowMultiBorderWithHeight($data, $border = array(),$height)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$height*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			$this->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
			$this->SetXY($x,$y);
			//Print the text
			$this->MultiCell($w,$height,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function NbLines($w, $txt)
	{
	    //Computes the number of lines a MultiCell of width w will take
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r", '', $txt);
	    $nb=strlen($s);
	    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
	    $sep=-1;
	    $i=0;
	    $j=0;
	    $l=0;
	    $nl=1;
	    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
	            $i++;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	            continue;
	        }
	        if($c==' ')
	            $sep=$i;
	        $l+=$cw[$c];
	        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}
	
	function Footer() {
		
	}
	
	function __destruct() {
		return null;
	}
}

$formulir = new FormCetak();
$formulir->PageCetak($data, $user);
$formulir->signaturePage();
$formulir->Output();

?>

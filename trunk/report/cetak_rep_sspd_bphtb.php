<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_sspd_bphtb.php");
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
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	var $page_orientation;
	var $page_size;
	var $lengthCell;
	
	function FormCetak() {
		$this->page_orientation = "P";
		$this->page_size = "Legal";
		$this->FPDF($this->page_orientation, "mm", $this->page_size);
		
		$size = $this->_getpagesize($this->page_size);
		if($this->page_orientation == "L"){
			$this->lengthCell = $size[1] - $this->lMargin - $this->rMargin;
		}
		else{
			$this->lengthCell = $size[0] - $this->lMargin - $this->rMargin;
		}
	}
	
	function __construct() {
		$this->FormCetak();
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user) {
		$this->AliasNbPages();
		$this->AddPage();
		
		$this->Image('../images/logo_pemda.png', $this->lMargin + $this->height, $this->tMargin + $this->height, 25, 25);
		
		
		/* ========================================= HEADER */
		$lheaderkecil = 35;
		$lheader = $this->lengthCell - $lheaderkecil * 2;
		$this->SetFont("Arial", "B", 12);
		$this->Cell($lheaderkecil, 2.5, "", "TLR", 0, "C");
		$this->Cell($lheader, 2.5, "", "TR", 0, "C");
		$this->Cell($lheaderkecil, 2.5, "", "TR", 0, "C");
		$this->Ln();
		
		$this->Cell($lheaderkecil, $this->height, "", "LR", 0, "C");
		$this->Cell($lheader, $this->height, "SURAT SETORAN PAJAK DAERAH", "R", 0, "C");
		$this->Cell($lheaderkecil, $this->height, "", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lheaderkecil, $this->height, "", "LR", 0, "C");
		$this->Cell($lheader, $this->height, "BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN", "R", 0, "C");
		$this->SetFont("Arial", "B", 14);
		$this->Cell($lheaderkecil, $this->height, "Lembar 1", "R", 0, "C");
		$this->Ln();
		
		$this->SetFont("Arial", "B", 14);
		$this->Cell($lheaderkecil, $this->height, "", "LR", 0, "C");
		$this->Cell($lheader, $this->height, "(SSPD - BPHTB)", "R", 0, "C");
		$this->SetFont("Arial", "", 10);
		$this->Cell($lheaderkecil, $this->height, "Untuk Wajib Pajak", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lheaderkecil, 2.5, "", "LR", 0, "C");
		$this->Cell($lheader, 2.5, "", "R", 0, "C");
		$this->Cell($lheaderkecil, 2.5, "", "R", 0, "C");
		$this->Ln();
		
		$this->SetFont("Arial", "B", 10);
		$this->Cell($lheaderkecil, 2.5, "", "LR", 0, "C");
		$this->Cell($lheader, 2.5, "", "TR", 0, "C");
		$this->Cell($lheaderkecil, 2.5, "", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lheaderkecil, $this->height, "", "LR", 0, "C");
		$this->Cell($lheader, $this->height, "BERFUNGSI SEBAGAI SURAT PEMBERITAHUAN OBJEK PAJAK", "R", 0, "C");
		$this->Cell($lheaderkecil, $this->height, "", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lheaderkecil, $this->height, "", "LR", 0, "C");
		$this->Cell($lheader, $this->height, "PAJAK BUMI DAN BANGUNAN (SPOP PBB)", "R", 0, "C");
		$this->Cell($lheaderkecil, $this->height, "", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lheaderkecil, 2.5, "", "BLR", 0, "C");
		$this->Cell($lheader, 2.5, "", "BR", 0, "C");
		$this->Cell($lheaderkecil, 2.5, "", "BR", 0, "C");
		$this->Ln();
		
		/* ========================================= BODY */
		$this->SetFont("Arial", "B", 8);
		$this->Cell($this->lengthCell, $this->height, "DINAS PELAYANAN PAJAK KOTA BANDUNG", "LR", 0, "L");
		$this->Ln();
		
		$this->SetFont("Arial", "UB", 8);
		$this->Cell(20, $this->height, "PERHATIAN", "BL", 0, "L");
		$this->SetFont("Arial", "", 8);
		$this->Cell($this->lengthCell - 20, $this->height, ": Bacalah petunjuk pengisian pada halaman belakang lembar ini terlebih dahulu.", "BR", 0, "L");
		$this->Ln();

		$this->barisBaru("", "", "");
		$this->barisBaruKotak("A.", "1. Nama Wajib Pajak", trim($data["wp_name"]), "nama");
		$this->barisBaruKotak("", "2. NPWP", trim($data["npwp"]), "npwp");
		$this->barisBaru("", "3. Alamat Wajib Pajak", ": " . trim($data["wp_address_name"]));
		$kel  = ": " . trim($data["wp_region_kel"]);
		$rtrw = ": " . trim($data["wp_rt"]) . "/" .  trim($data["wp_rw"]);
		$kec = ": " . trim($data["wp_region_kec"]);
		$this->barisBaru3Kolom("", "4. Kelurahan/Desa", $kel, "5. RT/RW", $rtrw, "6. Kecamatan", $kec);
		$kab = ": " . trim($data["wp_region"]);
		$kode_pos = ": " . trim($data["kode_pos"]);
		$this->barisBaru3Kolom("", "7. Kabupaten/Kota", $kab, "", "", "8. Kode Pos", $kode_pos);
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, "L");
		$this->Ln();
		
		$this->barisBaruKotak("B.", "1. Nomor Objek Pajak (NOP) PBB", trim($data["njop_pbb"]), "npop");
		$this->barisBaru("", "2. Letak tanah atau bangunan", ": " . trim($data["object_address_name"]));
		$kel  = ": " . trim($data["object_region_kel"]);
		$rtrw = ": " . trim($data["object_rt"]) . "/" .  trim($data["object_rw"]);
		$this->barisBaru3Kolom("", "3. Kelurahan/Desa", $kel, "", "", "4. RT/RW", $rtrw);
		$kec = ": " . trim($data["object_region_kec"]);
		$kab = ": " . trim($data["object_region"]);
		$this->barisBaru3Kolom("", "5. Kecamatan", $kec, "", "", "6. Kota", $kab);
		
		/* ========================================= NJOP PBB */
		$this->SetFont("Arial", "B", 8);
		$this->barisBaru("", "Penghitungan NJOP PBB", "");
		$lbody = $this->lengthCell / 40;
		$lbody1 = $lbody * 1;
		$lbodyx = ($this->lengthCell - 2 * $lbody1) / 12;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		
		$this->SetFont("Arial", "BI", 8);
		$this->SetWidths(array($lbody1, $lbodyx3, $lbodyx3, $lbodyx3, $lbodyx3, $lbody1));
		$this->SetAligns(array("C", "C", "C", "C", "C", "C"));
		$this->RowMultiBorderWithHeight(
			array
			(
				"",
				"\nUraian",
				"Luas\n(Diisi luas tanah dan atau bangunan yang haknya diperoleh)",
				"NJOP PBB / m2\n(Diisi berdasarkan SPPT PBB tahun terjadinya perolehan hak / Tahun",
				"\nLuas x NJOP PBB / m2",
				""
			),
			array
			(
				"L",
				"TBL",
				"TBL",
				"TBL",
				"TBL",
				"LR"
			),
			$this->height);
		
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "", "L", 0, "");
		$this->Cell($lbodyx3, $this->height, "Tanah (bumi)", "L", 0, "");
		$this->Cell($lbodyx2, $this->height, number_format($data["land_area"], 0, ",", "."), "L", 0, "R");
		$this->Cell($lbodyx1, $this->height, "m2", "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "Rp", "L", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data["land_price_per_m"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "Rp", "L", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data["land_total_price"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbody1, $this->height, "", "LR", 0, "");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "");
		$this->Cell($lbodyx3, $this->height, "Bangunan", "BL", 0, "");
		$this->Cell($lbodyx2, $this->height, number_format($data["building_area"], 0, ",", "."), "BL", 0, "R");
		$this->Cell($lbodyx1, $this->height, "m2", "B", 0, "R");
		$this->Cell($lbodyx1, $this->height, "Rp", "BL", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data["building_price_per_m"], 0, ",", "."), "B", 0, "R");
		$this->Cell($lbodyx1, $this->height, "Rp", "BL", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data["building_total_price"], 0, ",", "."), "B", 0, "R");
		$this->Cell($lbody1, $this->height, "", "LR", 0, "");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "");
		$this->Cell($lbodyx3, $this->height, "", "", 0, "");
		$this->Cell($lbodyx2, $this->height, "", "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "", 0, "L");
		$this->SetFont("Arial", "", 8);
		$this->Cell($lbodyx2, $this->height, "13. NJOP PBB:", "", 0, "R");
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbodyx1, $this->height, "Rp", "BL", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data["land_total_price"] + $data["building_total_price"], 0, ",", "."), "B", 0, "R");
		$this->Cell($lbody1, $this->height, "", "LR", 0, "");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "");
		$this->Cell($lbodyx3, $this->height, "", "", 0, "");
		$this->Cell($lbodyx2, $this->height, "", "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "", 0, "R");
		$this->SetFont("Arial", "", 8);
		$this->Cell($lbodyx3, $this->height, "14. Harga Transaksi / Nilai Pasar:", "", 0, "R");
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbodyx1, $this->height, "Rp", "BL", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data["market_price"], 0, ",", "."), "B", 0, "R");
		$this->Cell($lbody1, $this->height, "", "LR", 0, "");
		$this->Ln();
		
		$this->SetFont("Arial", "", 8);
		$this->barisBaru3Kolom("", "15. Jenis perolehan hak atas tanah dan atau bangunan", "", ":", "", "", "");
		$this->barisBaru3Kolom("", "16. Nomor Sertifikat", ":", "", "", "", "");
		
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, "L");
		$this->Ln();
		// $this->barisBaru3Kolom("C.", "AKUMULASI NILAI PEROLEHAN HAK SEBELUMNYA", "", "", "", "Rp", number_format(0, 0, ",", "."));
		$this->barisBaru2($lbody1, "AKUMULASI NILAI PEROLEHAN HAK SEBELUMNYA", "", "Rp", 0, "C.");
		
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, "L");
		$this->Ln();
		$this->barisBaru3Kolom("D.", "PENGHITUNGAN BPHTB (hanya diisi berdasarkan perhitungan Wajib Pajak)", "", "", "", "", "");
		$this->barisBaru2($lbody1, "1. Nilai Perolehan Objek Pajak (NPOP)", "", "Rp", $data["npop"], "");
		$this->barisBaru2($lbody1, "2. Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)", "", "Rp", $data["npop_tkp"], "");
		$this->barisBaru2($lbody1, "3. Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp", $data["npop_kp"], "");
		$this->barisBaru2($lbody1, "4. Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "", "Rp", $data["bphtb_amt"], "");
		// $this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan potongan", "", "Rp", $data["bphtb_discount"]);
		// $this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"]);
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, "L");
		$this->Ln();
		
		$this->barisBaru3Kolom("E.", "Jumlah Setoran berdasarkan:", "", "", "", "", "");
		$this->Cell($this->lengthCell, 7, "", "LR", 0, "L");
		$this->Ln(1);
		
		$gap = $this->lengthCell - $lbody1 - ($this->lengthCell / 45);
		$this->Cell($lbody1, $this->height, "", "L", 0, "L");
		$this->kotak(1, 45, 1, "");
		$this->Cell($gap, $this->height, "a. Penghitungan Wajib Pajak", "R", 0, "L");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "L");
		$this->kotak(1, 45, 1, "");
		$this->Cell($gap, $this->height, "b. STPD BPHTB / SKPD KURANG BAYAR / SKPDKBT *)                        Nomor:", "R", 0, "L");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "L");
		$this->kotak(1, 45, 1, "");
		$this->Cell(1 * $gap / 4, $this->height, "c. Pengurangan ditetapkan menjadi ", "R", 0, "L");
		$this->kotak(1, 45, 1, "");
		$this->kotak(1, 45, 1, "");
		$this->Cell(3 * $gap / 4 - (2 * $this->lengthCell / 45), $this->height, "% berdasar Peraturan Walikota Bandung No. 106 Tahun 2011 ", "R", 0, "L");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "L");
		$this->kotak(1, 45, 1, "");
		$this->Cell($gap, $this->height, "d. ...................................................", "R", 0, "L");
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, "L");
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, "L");
		$this->Ln();
		
		$lbody = ($this->lengthCell  - ($this->lengthCell / 40)) / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$lbody4 = $lbody * 4;
		
		$this->Cell($this->lengthCell / 40, $this->height, "", "L", 0, "L");
		$this->Cell($lbody2, $this->height, "JUMLAH YANG DISETOR (dengan angka)", "", 0, "L");
		$this->Cell($lbody2, $this->height, "(dengan huruf):", "R", 0, "L");
		$this->Ln();
		
		$this->SetFont("Arial", "B", 8);
		$this->Cell($this->lengthCell / 40, $this->height, "", "L", 0, "L");
		$this->Cell($lbody4, $this->height, "Rp", "R", 0, "L");
		$this->Ln();
		
		$this->SetFont("Arial", "I", 8);
		$this->Cell($this->lengthCell / 40, $this->height, "", "L", 0, "L");
		$this->Cell($lbody4, $this->height, "(berdasarkan perhitungan D4 dan pilihan E)", "R", 0, "L");
		$this->Ln();
		
		$this->Cell($this->lengthCell / 40, $this->height, "", "L", 0, "L");
		$this->Cell($lbody4, $this->height, "*) Coret yang tidak perlu", "R", 0, "L");
		$this->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$lbody4 = $lbody * 4;
		
		$this->SetFont("Arial", "", 6);
		$this->Cell($lbody1, $this->height, "", "TL", 0, "L");
		$this->Cell($lbody1, $this->height, "", "TL", 0, "L");
		$this->Cell($lbody1, $this->height, "", "T", 0, "L");
		$this->Cell($lbody1, $this->height, "", "TR", 0, "L");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, ", tgl " . date("j M Y") , "L", 0, "C");
		$this->Cell($lbody1, $this->height, "MENGETAHUI", "L", 0, "C");
		$this->Cell($lbody1, $this->height, "DITERIMA OLEH:", "", 0, "C");
		$this->Cell($lbody1, $this->height, "Telah Diverifikasi", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "WAJIB PAJAK / PENYETOR", "L", 0, "C");
		$this->Cell($lbody1, $this->height, "PPAT NOTARIS", "L", 0, "C");
		$this->Cell($lbody1, $this->height, "TEMPAT PEMBAYARAN BPTHTB", "", 0, "C");
		$this->Cell($lbody1, $this->height, "DINAS PELAYANAN PAJAK KOTA BANDUNG", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "C");
		$this->Cell($lbody1, $this->height, "", "L", 0, "C");
		$this->Cell($lbody1, $this->height, "Tanggal:", "", 0, "C");
		$this->Cell($lbody1, $this->height, "", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "C");
		$this->Cell($lbody3, $this->height, "", "LR", 0, "C");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, "C");
		$this->Cell($lbody3, $this->height, "", "LR", 0, "C");
		$this->Ln();
		
		$gap = 5;
		$this->Cell($gap, $this->height, "", "L", 0, "C");
		$this->Cell($lbody1 - 2 * $gap, $this->height, "Nama lengkap dan tanda tangan", "T", 0, "C");
		$this->Cell($gap, $this->height, "", "", 0, "C");
		$this->Cell($gap, $this->height, "", "L", 0, "C");
		$this->Cell($lbody1 - 2 * $gap, $this->height, "Nama lengkap, stempel, dan tanda tangan", "T", 0, "C");
		$this->Cell($gap, $this->height, "", "", 0, "C");
		$this->Cell($gap, $this->height, "", "", 0, "C");
		$this->Cell($lbody1 - 2 * $gap, $this->height, "Nama lengkap, stempel, dan tanda tangan", "T", 0, "C");
		$this->Cell($gap, $this->height, "", "", 0, "C");
		$this->Cell($gap, $this->height, "", "", 0, "C");
		$this->Cell($lbody1 - 2 * $gap, $this->height, "Nama lengkap, stempel, dan tanda tangan", "T", 0, "C");
		$this->Cell($gap, $this->height, "", "R", 0, "C");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "TL", 0, "C");
		$this->Cell($lbody3, $this->height, "", "TLR", 0, "C");
		$this->Ln();
		
		$this->Cell($lbody1, 7, "", "L", 0, "L");
		$this->Cell($lbody3, 7, "", "LR", 0, "L");
		$this->Ln(1);
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "Hanya diisi oleh petugas", "", 0, "L");
		$this->SetFont("Arial", "", 8);
		$this->Cell($lbody1 - 20, $this->height, "Nomor Dokumen:", "", 0, "L");
		$nomordokumen = str_split("");
		$this->kotak(1, 45, 1, $nomordokumen[0]);
		$this->kotak(1, 45, 1, $nomordokumen[1]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[2]);
		$this->kotak(1, 45, 1, $nomordokumen[3]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[4]);
		$this->kotak(1, 45, 1, $nomordokumen[5]);
		$this->kotak(1, 45, 1, $nomordokumen[6]);
		$this->kotak(1, 45, 1, $nomordokumen[7]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[8]);
		$this->kotak(1, 45, 1, $nomordokumen[9]);
		$this->kotak(1, 45, 1, $nomordokumen[10]);
		$this->kotak(1, 45, 1, $nomordokumen[11]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[12]);
		$this->kotak(1, 45, 1, $nomordokumen[13]);
		$this->kotak(1, 45, 1, $nomordokumen[14]);
		$this->Ln();

		$this->Cell($lbody1, 7, "", "BL", 0, "L");
		$this->Cell($lbody3, 7, "", "BLR", 0, "L");
		$this->Ln(1);
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbody1, $this->height, "yang berwenang", "", 0, "L");
		$this->SetFont("Arial", "", 8);
		$this->Cell($lbody1 - 20, $this->height, "NOP PBB Baru:", "", 0, "L");
		$nop = str_split("");
		$this->kotak(1, 45, 1, $nomordokumen[0]);
		$this->kotak(1, 45, 1, $nomordokumen[1]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[2]);
		$this->kotak(1, 45, 1, $nomordokumen[3]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[4]);
		$this->kotak(1, 45, 1, $nomordokumen[5]);
		$this->kotak(1, 45, 1, $nomordokumen[6]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[7]);
		$this->kotak(1, 45, 1, $nomordokumen[8]);
		$this->kotak(1, 45, 1, $nomordokumen[9]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[10]);
		$this->kotak(1, 45, 1, $nomordokumen[11]);
		$this->kotak(1, 45, 1, $nomordokumen[12]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[13]);
		$this->kotak(1, 45, 1, $nomordokumen[14]);
		$this->kotak(1, 45, 1, $nomordokumen[15]);
		$this->kotak(1, 45, 1, $nomordokumen[16]);
		$this->kotakKosong(1, 45, 1, "");
		$this->kotak(1, 45, 1, $nomordokumen[17]);
		$this->Ln();
	}
	
	function barisBaru3Kolom($section, $field, $data, $field2, $data2, $field3, $data3){
		$lbody = $this->lengthCell / 40;
		$lbody1 = $lbody * 1;
		$lbody3 = $lbody * 3;
		$lbody9 = $lbody * 9;
		$lbody6 = $lbody * 6;
		
		$this->Cell($lbody1, $this->height, "$section", "L", 0, "L");
		$this->Cell($lbody9, $this->height, "$field", "", 0, "L");
		$this->Cell($lbody9, $this->height, "$data", "", 0, "L");
		$this->Cell($lbody3, $this->height, "$field2", "", 0, "L");
		$this->Cell($lbody3, $this->height, "$data2", "", 0, "L");
		$this->Cell($lbody6, $this->height, "$field3", "", 0, "L");
		$this->Cell($lbody9, $this->height, "$data3", "R", 0, "L");
		$this->Ln();
	}
	
	function barisBaruKotak($section, $field, $data, $jenis){
		$lbody = $this->lengthCell / 40;
		$lbody1 = $lbody * 1;
		$lbody9 = $lbody * 9;
		$lbody30 = $lbody * 30;
		
		$this->Cell($this->lengthCell, 7, "", "LR", 0, "L");
		$this->Ln(1);
		$this->Cell($lbody1, $this->height, "$section", "L", 0, "C");
		$this->Cell($lbody9, $this->height, "$field", "", 0, "L");
		
		$data = str_split($data);
		$jenis = strtolower($jenis);
		$this->kotakKosong(1, 70, 1, ":");
		if($jenis == "nama"){
			for($i = 0; $i < 30; $i++){
				$this->kotak(1, 45, 1, $data[$i]);
			}
		}
		else if($jenis == "npwp"){
			$this->kotak(1, 45, 1, $data[0]);
			$this->kotak(1, 45, 1, $data[1]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[2]);
			$this->kotak(1, 45, 1, $data[3]);
			$this->kotak(1, 45, 1, $data[4]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[5]);
			$this->kotak(1, 45, 1, $data[6]);
			$this->kotak(1, 45, 1, $data[7]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[8]);
			$this->kotak(1, 45, 1, $data[9]);
			$this->kotak(1, 45, 1, $data[10]);
			$this->kotak(1, 45, 1, $data[11]);
			$this->kotak(1, 45, 1, $data[12]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[13]);
			$this->kotak(1, 45, 1, $data[14]);
			$this->kotak(1, 45, 1, $data[15]);
		}
		else if($jenis == "npop"){
			$this->kotak(1, 45, 1, $data[0]);
			$this->kotak(1, 45, 1, $data[1]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[2]);
			$this->kotak(1, 45, 1, $data[3]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[4]);
			$this->kotak(1, 45, 1, $data[5]);
			$this->kotak(1, 45, 1, $data[6]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[7]);
			$this->kotak(1, 45, 1, $data[8]);
			$this->kotak(1, 45, 1, $data[9]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[10]);
			$this->kotak(1, 45, 1, $data[11]);
			$this->kotak(1, 45, 1, $data[12]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[13]);
			$this->kotak(1, 45, 1, $data[14]);
			$this->kotak(1, 45, 1, $data[15]);
			$this->kotak(1, 45, 1, $data[16]);
			$this->kotakKosong(1, 45, 1, "");
			$this->kotak(1, 45, 1, $data[17]);
		}
		$this->Cell($lbody30, $this->height, "", "R", 0, "L");
		$this->Ln();
	}
	
	function barisBaru($section, $field, $data){
		$lbody = $this->lengthCell / 40;
		$lbody1 = $lbody * 1;
		$lbody9 = $lbody * 9;
		$lbody30 = $lbody * 30;
		
		$this->Cell($lbody1, $this->height, "$section", "L", 0, "C");
		$this->Cell($lbody9, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody30));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array("R"), $this->height);
	}
	
	function barisBaru2($subtractor, $field, $middle, $currency, $data, $section){
		$lbodyx = ($this->lengthCell - 2 * $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;

		$this->Cell($subtractor, $this->height, "$section", "L", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$this->Cell($subtractor, $this->height, "", "R", 0, "L");
		$this->Ln();
	}
	
	function newLine(){
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function kotakKosong($pembilang, $penyebut, $jumlahKotak, $isi){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, $isi, "", 0, 'L');
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
$formulir->Output();

?>

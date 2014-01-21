<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_lap_harian_bdhr.php");
include_once(RelativePath . "/Common.php");
//include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$start_date		= CCGetFromGet("start_date", "");//'15-12-2013';
$end_date		= CCGetFromGet("end_date", "");//'15-12-2013';
// $tgl_penerimaan		= '15-12-2013';

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select * from f_rep_harian_murni($start_date, $end_date) order by nomor_ayat";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["nomor_ayat"][]		= $dbConn->f("nomor_ayat");
	$data["nama_ayat"][]		= $dbConn->f("nama_ayat");
	$data["nama_jns_pajak"][]	= $dbConn->f("nama_jns_pajak");
	$data["kode_jns_pjk"][]	= $dbConn->f("kode_jns_pjk");
	$data["jns_pajak"][]		= $dbConn->f("jns_pajak");
	$data["type_ayat"][]		= $dbConn->f("type_ayat");
	$data["p_vat_type_id"][]	= $dbConn->f("p_vat_type_id");
	$data["p_vat_type_dtl_id"][]= $dbConn->f("p_vat_type_dtl_id");
	$data["bulan"][]			= $dbConn->f("bulan");
	$data["tahun"][]			= $dbConn->f("tahun");
	$data["jml_hari_ini"][]		= $dbConn->f("jml_hari_ini");
	$data["jml_sd_hari_lalu"][]	= $dbConn->f("jml_sd_hari_lalu");
	$data["jml_sd_hari_ini"][]	= $dbConn->f("jml_sd_hari_ini");
	$data["count_jml_hari_ini"][]		= $dbConn->f("count_jml_hari_ini");
	$data["count_jml_sd_hari_lalu"][]	= $dbConn->f("count_jml_sd_hari_lalu");
	$data["count_jml_sd_hari_ini"][]	= $dbConn->f("count_jml_sd_hari_ini");
	$data["sptpd_jml_hari_ini"][]		= $dbConn->f("sptpd_jml_hari_ini");
	$data["sptpd_jml_sd_hari_lalu"][]	= $dbConn->f("sptpd_jml_sd_hari_lalu");
	$data["sptpd_jml_sd_hari_ini"][]	= $dbConn->f("sptpd_jml_sd_hari_ini");
	$data["count_sptpd_jml_hari_ini"][]		= $dbConn->f("count_sptpd_jml_hari_ini");
	$data["count_sptpd_jml_sd_hari_lalu"][]	= $dbConn->f("count_sptpd_jml_sd_hari_lalu");
	$data["count_sptpd_jml_sd_hari_ini"][]	= $dbConn->f("count_sptpd_jml_sd_hari_ini");
	$data["sptpd_thn_lalu"][]	= $dbConn->f("sptpd_thn_lalu");
	$data["sptpd"][]	= $dbConn->f("sptpd");
	$data["target"][]	= $dbConn->f("target");
	
}
$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $paperWSize = 330;
	var $paperHSize = 215;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF();
	}
	
	function __construct() {
		$this->FormCetak();
		$this->startY = $this->GetY();
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user, $start_date, $end_date) {
		$this->AliasNbPages();
		$this->AddPage("L");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "T", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "TR", 0, 'L');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "LAPORAN HARIAN PENERIMAAN", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "Tanggal Penerimaan", "R", 0, 'C');		
		$this->Ln();
		$start_date = str_replace("'", "", $start_date);
		$end_date = str_replace("'", "", $end_date);
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, $start_date . " s.d. " . $end_date, "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		$this->Ln();
		
		$ltable = $this->lengthCell / 44;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable5 = $ltable * 5;
		$ltable16 = $ltable * 16;
		
		$this->SetFont('Arial', '', 6);
		$this->Cell($ltable1, $this->height, "NO.", "TLR", 0, 'C');
		$this->Cell($ltable5, $this->height, "JENIS PAJAK", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "TARGET", "TLR", 0, 'C');
		$this->Cell($ltable1 + $ltable3, $this->height, "HARI INI", "TBLR", 0, 'C');
		$this->Cell($ltable1 + $ltable3, $this->height, "SD HARI LALU", "TBLR", 0, 'C');
		$this->Cell($ltable1 + $ltable3 + $ltable1, $this->height, "SD HARI INI", "TBLR", 0, 'C');
		$this->Cell($ltable1 + $ltable3 + $ltable1 + $ltable3 + $ltable1 + $ltable3, $this->height, "REALISASI PENERIMAAN MURNI", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SPTPD", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SISA LEBIH/KRG", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SISA LEBIH/KRG", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SISA LEBIH/KRG", "TLR", 0, 'C');
		$this->Ln();
		$this->Cell($ltable1, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable5, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SSPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SSPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SSPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "BESAR", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "%", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SPTPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "HARI INI", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SPTPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SD HR LALU", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "SPTPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SD HR INI", "TBLR", 0, 'C');
		$this->Cell($ltable1, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "THD KETETAPAN", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "4 BULAN", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "1 TAHUN", "BLR", 0, 'C');
		$this->Ln();
		
		// $data["nama_ayat"]		= array("*1", "*2", "*3", "resto", "katering", "bioskop", "diskotik");
		// $data["nama_jns_pajak"]	= array("p hotel", "p hotel", "p hotel", "p restoran", "p restoran", "p hiburan", "p hiburan");
		// $data["kode_jns_pajak"]	= array("1101", "1101", "1101", "1102", "1102", "1103", "1103");
		// $data["type_ayat"]		= array("02", "03", "04", "05", "06", "07", "08");
		// $data["jml_hari_ini"]		= array(1, 2, 3, 4, 5, 6, 7);
		// $data["jml_sd_hari_lalu"]	= array(1, 2, 3, 4, 5, 6, 7);
		// $data["jml_sd_hari_ini"]	= array(2, 4, 6, 8, 10, 12, 14);
		// $data["r_jml_hari_ini"]		= array(11, 12, 13, 14, 15, 16, 17);
		// $data["r_jml_sd_hari_lalu"]	= array(11, 12, 13, 14, 15, 16, 17);
		// $data["r_jml_sd_hari_ini"]	= array(22, 24, 26, 28, 30, 32, 34);
		// $data["target"] = array(10, 20, 30, 40, 50, 60, 70);
		//untuk subtotal
		$j_target = array();
		$j_count_jml_hari_ini = array();
		$j_jml_hari_ini = array();
		$j_count_jml_sd_hari_lalu = array();
		$j_jml_sd_hari_lalu = array();
		$j_count_jml_sd_hari_ini = array();
		$j_jml_sd_hari_ini = array();
		$j_count_sptpd_jml_hari_ini = array();
		$j_sptpd_jml_hari_ini = array();
		$j_count_sptpd_jml_sd_hari_lalu = array();
		$j_sptpd_jml_sd_hari_lalu = array();
		$j_count_sptpd_jml_sd_hari_ini = array();
		$j_sptpd_jml_sd_hari_ini = array();
		$j_sptpd = array();
		$j_slktk = array();
		$j_slk4bln = array();
		$j_slk1thn= array();
		
		$no = 1;
		$tot_sptpd_thn_lalu=0;
		$tot_sptpd_thn_lalu_all=0;
		for ($i = 0; $i < count($data["nama_ayat"]); $i++) {
			//isi kolom
			$this->SetWidths(array($ltable1, $ltable2, $ltable3, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable3, $ltable3));
			$this->SetAligns(array("C", "C", "L", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
			//print data
			$this->SetFont('Arial', '', 6);
			$this->RowMultiBorderWithHeight(
				array($no,
					  $data["kode_jns_pjk"][$i] . "." . $data["type_ayat"][$i],
					  $data["nama_ayat"][$i],
					  number_format($data["target"][$i], 0, ',', '.'),
					  number_format($data["count_jml_hari_ini"][$i], 0, ',', '.'),
					  number_format($data["jml_hari_ini"][$i], 0, ',', '.'),
					  number_format($data["count_jml_sd_hari_lalu"][$i], 0, ',', '.'),
					  number_format($data["jml_sd_hari_lalu"][$i], 0, ',', '.'),
					  number_format($data["count_jml_sd_hari_ini"][$i], 0, ',', '.'),
					  number_format($data["jml_sd_hari_ini"][$i], 0, ',', '.'),
					  0,
					  number_format($data["count_sptpd_jml_hari_ini"][$i], 0, ',', '.'),
					  number_format($data["sptpd_jml_hari_ini"][$i], 0, ',', '.'),
					  number_format($data["count_sptpd_jml_sd_hari_lalu"][$i], 0, ',', '.'),
					  number_format($data["sptpd_jml_sd_hari_lalu"][$i], 0, ',', '.'),
					  number_format($data["count_sptpd_jml_sd_hari_ini"][$i], 0, ',', '.'),
					  number_format($data["sptpd_jml_sd_hari_ini"][$i], 0, ',', '.'),
					  number_format(abs($data["count_sptpd_jml_hari_ini"][$i] - $data["count_jml_hari_ini"][$i]), 0, ',', '.'),
					  number_format(abs($data["sptpd_jml_sd_hari_ini"][$i]-$data["jml_sd_hari_ini"][$i]), 0, ',', '.'),
					  number_format($data["sptpd_thn_lalu"][$i], 0, ',', '.'),
					  //abs(number_format($data["sptpd_jml_sd_hari_ini"][$i]-$data["target"][$i], 0, ',', '.'))
					  number_format(abs($data["sptpd_thn_lalu"][$i]-$data["jml_sd_hari_ini"][$i]), 0, ',', '.')
					  ),
				array("TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR",
					  "TBLR"
					  ),
				$this->height);
			$no++;

			//hitung jml_hari_ini sampai baris ini
			$j_target[] = $data["target"][$i];
			$j_count_jml_hari_ini[] = $data["count_jml_hari_ini"][$i];
			$j_jml_hari_ini[] = $data["jml_hari_ini"][$i];
			$j_count_jml_sd_hari_lalu[] = $data["count_jml_sd_hari_lalu"][$i];
			$j_jml_sd_hari_lalu[] = $data["jml_sd_hari_lalu"][$i];
			$j_count_jml_sd_hari_ini[] = $data["count_jml_sd_hari_ini"][$i];
			$j_jml_sd_hari_ini[] = $data["jml_sd_hari_ini"][$i];
			$j_count_sptpd_jml_hari_ini[] = $data["count_sptpd_jml_hari_ini"][$i];
			$j_sptpd_jml_hari_ini[] = $data["sptpd_jml_hari_ini"][$i];
			$j_count_sptpd_jml_sd_hari_lalu[] = $data["count_sptpd_jml_sd_hari_lalu"][$i];
			$j_sptpd_jml_sd_hari_lalu[] = $data["sptpd_jml_sd_hari_lalu"][$i];
			$j_count_sptpd_jml_sd_hari_ini[] = $data["count_sptpd_jml_sd_hari_ini"][$i];
			$j_sptpd_jml_sd_hari_ini[] = $data["sptpd_jml_sd_hari_ini"][$i];
			$j_sptpd[] = 0;
			$j_slktk[] = abs($data["sptpd_jml_sd_hari_ini"][$i]-$data["jml_sd_hari_ini"][$i]);
			$j_slk4bln[] = 0;
			$j_slk1thn[] = abs($data["sptpd_jml_sd_hari_ini"][$i]-$data["target"][$i]);
			
			$this->SetWidths(array($ltable1 + $ltable2 + $ltable3, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable1, $ltable3, $ltable3, $ltable3));
			$this->SetAligns(array("C", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
			//cek apakah perlu bikin baris jumlah
			//jika iya, simpan jumlahtemp ke jumlahperjenis, print jumlahtemp, reset jumlahtemp
			$jenis = $data["nama_jns_pajak"][$i];
			$jenissesudah = $data["nama_jns_pajak"][$i + 1];
			$tot_sptpd_thn_lalu = $tot_sptpd_thn_lalu + $data['sptpd_thn_lalu'][$i];
			$tot_sptpd_thn_lalu_all = $tot_sptpd_thn_lalu_all + $data['sptpd_thn_lalu'][$i];
			$this->SetFont('Arial', 'B', 6);
			if($jenis != $jenissesudah){
				$this->RowMultiBorderWithHeight(
					array("JUMLAH " . strtoupper($data["nama_jns_pajak"][$i]),
							number_format(array_sum($j_target), 0, ',', '.'),
							number_format(array_sum($j_count_jml_hari_ini), 0, ',', '.'),
							number_format(array_sum($j_jml_hari_ini), 0, ',', '.'),
							number_format(array_sum($j_count_jml_sd_hari_lalu), 0, ',', '.'),
							number_format(array_sum($j_jml_sd_hari_lalu), 0, ',', '.'),
							number_format(array_sum($j_count_jml_sd_hari_ini), 0, ',', '.'),
							number_format(array_sum($j_jml_sd_hari_ini), 0, ',', '.'),
							0,
							number_format(array_sum($j_count_sptpd_jml_hari_ini), 0, ',', '.'),
							number_format(array_sum($j_sptpd_jml_hari_ini), 0, ',', '.'),
							number_format(array_sum($j_count_sptpd_jml_sd_hari_lalu), 0, ',', '.'),
							number_format(array_sum($j_sptpd_jml_sd_hari_lalu), 0, ',', '.'),
							number_format(array_sum($j_count_sptpd_jml_sd_hari_ini), 0, ',', '.'),
							number_format(array_sum($j_sptpd_jml_sd_hari_ini), 0, ',', '.'),
							number_format(abs(array_sum($j_count_sptpd_jml_hari_ini)-array_sum($j_count_jml_hari_ini)), 0, ',', '.'),
							number_format(abs(array_sum($j_slktk)), 0, ',', '.'),
							number_format($tot_sptpd_thn_lalu, 0, ',', '.'),
							number_format(abs(array_sum($j_slk1thn)), 0, ',', '.')
						  ),
					array("TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR",
							"TBLR"
						  ),
					  $this->height);
				
				$j_t_target	+= array_sum($j_target);
				$j_t_count_jml_hari_ini	+= array_sum($j_count_jml_hari_ini);
				$j_t_jml_hari_ini	+= array_sum($j_jml_hari_ini);
				$j_t_count_jml_sd_hari_lalu	+= array_sum($j_count_jml_sd_hari_lalu);
				$j_t_jml_sd_hari_lalu	+= array_sum($j_jml_sd_hari_lalu);
				$j_t_count_jml_sd_hari_ini	+= array_sum($j_count_jml_sd_hari_ini);
				$j_t_jml_sd_hari_ini	+= array_sum($j_jml_sd_hari_ini);
				$j_t_count_sptpd_jml_hari_ini	+= array_sum($j_count_sptpd_jml_hari_ini);
				$j_t_sptpd_jml_hari_ini	+= array_sum($j_sptpd_jml_hari_ini);
				$j_t_count_sptpd_jml_sd_hari_lalu	+= array_sum($j_count_sptpd_jml_sd_hari_lalu);
				$j_t_sptpd_jml_sd_hari_lalu	+= array_sum($j_sptpd_jml_sd_hari_lalu);
				$j_t_count_sptpd_jml_sd_hari_ini	+= array_sum($j_count_sptpd_jml_sd_hari_ini);
				$j_t_sptpd_jml_sd_hari_ini	+= array_sum($j_sptpd_jml_sd_hari_ini);
				$j_t_sptpd = 0;
				$j_t_slktk += abs(array_sum($j_slktk));
				$j_t_slk4bln = 0;
				$j_t_slk1thn +=abs(array_sum($j_slk1thn));
				
				//Re-initialize
				$j_target = array();
				$j_count_jml_hari_ini = array();
				$j_jml_hari_ini = array();
				$j_count_jml_sd_hari_lalu = array();
				$j_jml_sd_hari_lalu = array();
				$j_count_jml_sd_hari_ini = array();
				$j_jml_sd_hari_ini = array();
				$j_count_sptpd_jml_hari_ini = array();
				$j_sptpd_jml_hari_ini = array();
				$j_count_sptpd_jml_sd_hari_lalu = array();
				$j_sptpd_jml_sd_hari_lalu = array();
				$j_count_sptpd_jml_sd_hari_ini = array();
				$j_sptpd_jml_sd_hari_ini = array();
				$j_sptpd = array();
				$j_slktk = array();
				$j_slk4bln = array();
				$j_slk1thn= array();
				$tot_sptpd_thn_lalu=0;
			}
			
			//Total
			if($i == count($data['nama_ayat']) - 1){
				$this->RowMultiBorderWithHeight(
					array("JUMLAH TOTAL",
							number_format($j_t_target, 0, ',', '.'),
							number_format($j_t_count_jml_hari_ini, 0, ',', '.'),
							number_format($j_t_jml_hari_ini, 0, ',', '.'),
							number_format($j_t_count_jml_sd_hari_lalu, 0, ',', '.'),
							number_format($j_t_jml_sd_hari_lalu, 0, ',', '.'),
							number_format($j_t_count_jml_sd_hari_ini, 0, ',', '.'),
							number_format($j_t_jml_sd_hari_ini, 0, ',', '.'),
							0,
							number_format($j_t_count_sptpd_jml_hari_ini, 0, ',', '.'),
							number_format($j_t_sptpd_jml_hari_ini, 0, ',', '.'),
							number_format($j_t_count_sptpd_jml_sd_hari_lalu, 0, ',', '.'),
							number_format($j_t_sptpd_jml_sd_hari_lalu, 0, ',', '.'),
							number_format($j_t_count_sptpd_jml_sd_hari_ini, 0, ',', '.'),
							number_format($j_t_sptpd_jml_sd_hari_ini, 0, ',', '.'),
							number_format(abs($j_t_count_sptpd_jml_hari_ini-$j_t_count_jml_hari_ini), 0, ',', '.'),
							number_format(abs($j_t_slktk), 0, ',', '.'),
							number_format(abs($tot_sptpd_thn_lalu_all), 0, ',', '.'),
							number_format(abs($j_t_slk1thn), 0, ',', '.')
						  ),
					array("TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR",
						  "TBLR"
						  ),
					  $this->height);
			}
			$this->SetFont('Arial', '', 8);
		}
		
		$this->Ln();
		$this->newLine();
		$this->newLine();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "BENDAHARA PENERIMAAN, ", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		//$this->Cell($lbody1 + 10, $this->height, "KOTA BANDUNG", "", 0, 'C');
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "(....................................)", "", 0, 'C');
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
$formulir->PageCetak($data, $user, $start_date, $end_date);
$formulir->Output();

?>

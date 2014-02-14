<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_skpdn_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$dbConn = new clsDBConnSIKP();

$data = array();

$idVatSS = CCGetFromGet("t_vat_setllement_id","");
if (empty($idVatSS)){
	echo "Data Tidak Ditemukan";
	exit;
}else{
	$sql = "SELECT * "
		  ."FROM v_vat_setllement "
		  ."WHERE t_vat_setllement_id = ".$idVatSS;
		  
	$dbConn->query($sql);
	while($dbConn->next_record()){
		$data["t_cust_account_id"] = $dbConn->f("t_cust_account_id");
		$data["finance_period_code"] = $dbConn->f("finance_period_code");
		$data["tahun"] = $dbConn->f("tahun");
		$data["npwd"] = $dbConn->f("npwd");
		$data["due_date"] = $dbConn->f("due_date");
		$data["no_urut"] = $dbConn->f("order_no");
		$data["jenis_pajak"] = $dbConn->f("jenis_pajak");
		$data["debt_vat_amt"] = $dbConn->f("debt_vat_amt");
		$data["terutang"] = $dbConn->f("terutang");
		$data["cr_adjustment"] = $dbConn->f("cr_adjustment");
		$data["cr_payment"] = $dbConn->f("cr_payment");
		$data["cr_others"] = $dbConn->f("cr_others");
		$data["cr_stp"] = $dbConn->f("cr_stp");
		$data["db_interest_charge"] = $dbConn->f("db_interest_charge");
		$data["db_increasing_charge"] = $dbConn->f("db_increasing_charge");
		$data["vat_code"] = $dbConn->f("nomor_ayat");
		$data["total_trans_amount"] = $dbConn->f("total_trans_amount");

		
	} 
	
	$kpd = "select wp_name, wp_address_name, wp_kota
			from v_cust_account_update
			where t_cust_account_id = ".$data["t_cust_account_id"];
	$dbConn->query($kpd);	
	while($dbConn->next_record()){
		$data["wp_name"] = $dbConn->f("wp_name");
		$data["wp_address_name"] = $dbConn->f("wp_address_name");
		$data["wp_kota"] = $dbConn->f("wp_kota");		
	} 	
	//barcode
	$bcr = "select f_gen_barcode('test')";
	$dbConn->query($bcr);
	while($dbConn->next_record()){
		$data["barcode"] = $dbConn->f("f_gen_barcode");
	}
	
	//nip & nama
	$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin "
		  ."FROM p_global_param "
		  ."WHERE code = 'TTD KADIN'";
		  
	$dbConn->query($ttd);
	while($dbConn->next_record()){
		$data["nama_kadin"] = $dbConn->f("nama_kadin");
		$data["nip_kadin"] = $dbConn->f("nip_kadin");
	}
	
	//end barcode
	$dbConn->close();
}
class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 210;
	var $paperHSize = 297;
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
		$this->startX = $this->paperWSize-42;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',12,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader3 - 15, $this->height, "", "TR", 0, 'L');
		$this->Cell($lheader2 + 15, $this->height, "", "TR", 0, 'C');
		$this->Cell($lheader2, $this->height, "", "TR", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3 - 15, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->SetFont('Arial', '', 12);
		$this->Cell($lheader2 + 15, $this->height, "SKPDN", "R", 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3 - 15, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->SetFont('Arial', '', 8);
		$this->Cell($lheader2 + 15, $this->height, "(Surat Keterangan Pajak Daerah Nihil)", "R", 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height, "No. Urut", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lheader3 - 15, $this->height + 2, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->SetFont('Arial', '', 8);
		$this->Cell(9, $this->height + 2, "", "", 0, 'L');
		$this->Cell($lheader1 + 6, $this->height + 2, "Masa Pajak ", "", 0, 'L');
		$this->Cell($lheader1, $this->height + 2, ": ".$data["finance_period_code"], "R", 0, 'L');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height + 2, "", "R", 0, 'C');
		$this->Ln($this->height - 4);
		// No Urut
		$this->Cell($lheader2 + $lheader4 + 1, $this->height, "", "R", 0, 'C');
		
		$no_urut = str_split($data["no_urut"]);
		$this->kotak(1, 34, 8, $no_urut);
		$this->Ln();
		// =======
		
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3 - 15, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->SetFont('Arial', '', 8);
		$this->Cell(9, $this->height, "", "", 0, 'L');
		$this->Cell($lheader1 + 6, $this->height, "Tahun Pajak ", "", 0, 'L');
		$this->Cell($lheader1, $this->height, ": ".$data["tahun"], "R", 0, 'L');
		$this->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3 - 15, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader2 + 15, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader2, $this->height, "", "BR", 0, 'L');
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Ln();
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Nama", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " . $data["wp_name"], "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Alamat", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " . $data["wp_address_name"], "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height + 2, "NPWPD", "", 0, 'L');
		$this->Cell($lbody1, $this->height + 2, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		$rep_npwd = str_replace(".", "", $data["npwd"]);
		$arr1 = str_split($rep_npwd);
		
		$this->kotak(1, 34, 1,$arr1[0]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[1]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[2]);
		$this->kotak(1, 34, 1,$arr1[3]);
		$this->kotak(1, 34, 1,$arr1[4]);
		$this->kotak(1, 34, 1,$arr1[5]);
		$this->kotak(1, 34, 1,$arr1[6]);
		$this->kotak(1, 34, 1,$arr1[7]);
		$this->kotak(1, 34, 1,$arr1[8]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[9]);
		$this->kotak(1, 34, 1,$arr1[10]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[11]);
		$this->kotak(1, 34, 1,$arr1[12]);
		$this->Ln();
		
		$this->Cell($lbody2 * 2, $this->height, "", "BLR", 0, 'L');
		$this->Ln();
		
		$this->tulis("I. Berdasarkan Pasal 65 ayat (1) huruf c Peraturan Daerah Nomor 20 Tahun 2011, telah dilakukan pemeriksaan atau keterangan lain diatas", "L");
		$this->tulis("pelaksanaan kewajiban:", "L");
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$indent = $this->lengthCell / 30;
		
		$this->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height + 2, "Ayat Pajak", "", 0, 'L');
		$this->Cell($lbody3, $this->height + 2, ": " /*. $data["ayat"]*/, "R", 0, 'L');
		$this->Ln($this->height - 4);
		
		// Ayat Pajak
		/*$this->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		$this->kotak(1, 34, 6, "");
		$this->Ln();*/
		// ==========

		// Ayat Pajak
		$this->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		if(!empty($data["vat_code"])) {
			$arr_ayat = str_split($data["vat_code"]);
		} else {
			$arr_ayat = array();
			$this->kotak(1, 45, 1," - ");
		}		
		//$this->kotak(1, 34, 6, "");
		for($i = 0; $i < count($arr_ayat); $i++) {
			if($arr_ayat[$i] != " ")
				$this->kotak(1, 45, 1,$arr_ayat[$i]);
			else
				$this->kotakKosong(1, 34, 1);
		}
		$this->Ln();
		// ==========
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Nama Pajak", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": ".$data["jenis_pajak"], "R", 0, 'L');
		$this->Ln();
		
		$this->tulis("II. Dari pemeriksaan atau keterangan lain tersebut di atas, perhitungan jumlah yang masih harus dibayar adalah sebagai berikut:", "L");
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody3 - 5, $this->height, "1. Dasar Pengenaan", "", 0, 'L');
		$this->Cell(5, $this->height, "Rp ", "", 0, 'L');
		$this->Cell($lbody1-15, $this->height, number_format($data["total_trans_amount"],2,",","."), "", 0, 'R');
		$this->Cell(10, $this->height, "", "R", 0, 'L');
		$this->Ln();

		/*$this->Cell($lbody1, $this->height, "Rp ", "", 0, 'L');
		$this->Cell($lbody1 - 10, $this->height, number_format($data["total_trans_amount"],2,",","."), "", 0, 'R');
		$this->Cell(10, $this->height, "", "R", 0, 'R');
*/
				
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody3 - 5, $this->height, "2. Pajak yang Terutang", "", 0, 'L');
		//$this->Cell($lbody1, $this->height, "Rp ".number_format($data["terutang"],2,",","."), "R", 0, 'L');
		$this->Cell(5, $this->height, "Rp ", "", 0, 'L');
		$this->Cell($lbody1-15, $this->height, number_format($data["terutang"],2,",","."), "", 0, 'R');
		$this->Cell(10, $this->height, "", "R", 0, 'L');
		
		$this->Ln();
		
		$this->tulis("3. Kredit Pajak", "L");
		
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody2 - 10, $this->height, "a. Kompensasi kelebihan dari tahun sebelumnya", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Rp ".number_format($data["cr_adjustment"],2,",","."), "", 0, 'L');
		$this->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody2 - 10, $this->height, "b. Setoran yang dilakukan", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Rp ".number_format($data["cr_payment"],2,",","."), "", 0, 'L');
		$this->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody2 - 10, $this->height, "c. Lain-lain", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Rp ".number_format($data["cr_others"],2,",","."), "B", 0, 'L');
		$this->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody2 - 10, $this->height, "d. STP (Pokok)", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Rp ".number_format($data["cr_stp"],2,",","."), "B", 0, 'L');
		$this->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$jum = $data["cr_others"] + $data["cr_payment"] + $data["cr_adjustment"] + $data["cr_stp"];
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody2 - 10, $this->height, "e. Jumlah yang dapat dikreditkan (a + b + c + d)", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Rp ".number_format($jum,2,",","."), "", 0, 'L');
		$this->Cell($lbody1, $this->height, "", "R", 0, 'L');
		$this->Ln();
		

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody3 - 5, $this->height, "4. Jumlah yang harus dibayar (2-3e)", "", 0, 'L');
		$this->Cell($lbody1 / 5, $this->height, "Rp ", "B", 0, 'L');
		$this->Cell($lbody1 / 5 * 4, $this->height, "NIHIL", "BR", 0, 'C');
		$this->Ln();
		$this->newLine();
		
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y"), "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "KEPALA DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "KOTA BANDUNG", "R", 0, 'C');
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, $data["nama_kadin"], "R", 0, 'C');
		$this->Ln();

		$this->Cell($lbody3 - 10, $this->height, "", "BL", 0, 'L');
		$this->Cell($lbody1 + 8, $this->height, "NIP. " . $data["nip_kadin"], "BT", 0, 'L'); //isi nip
		$this->Cell(2, $this->height, "", "BR", 0, 'L');
		$this->Ln();

		$this->Cell($this->lengthCell, $this->height, "Gunting di sini", "B", 0, 'C');
		$this->Ln();
		$this->Ln();
		$this->Cell($lbody1, $this->height, "", "TL", 0, 'L');
		$this->Cell($lbody2, $this->height, "TANDA TERIMA", "T", 0, 'C');
		$this->Cell($lbody1, $this->height, "No. SKPDN", "TR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "     NPWPD", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, ": ".$data["npwd"], "R", 0, 'L');
		$this->Ln();

		$this->Cell($lbody1, $this->height, "     Nama", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, ": ".$data["wp_name"], "R", 0, 'L');
		$this->Ln();

		$this->Cell($lbody1, $this->height, "     Alamat", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, ": ".$data["wp_address_name"], "R", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y"), "R", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Yang menerima, ", "R", 0, 'C');
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();

		$this->Cell($lbody3 - 10, $this->height, "", "BL", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "(....................................)", "BR", 0, 'C');
	}

	function tulis($text, $align){
		$this->Cell(5, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 10, $this->height, $text, "", 0, $align);
		$this->Cell(5, $this->height, "", "R", 0, 'C');
		$this->Ln();
	}
	
	function newLine(){
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
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
			$this->Cell($lkotak, $this->height, $isi[$i], "TBLR", 0, 'C');
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
$formulir->PageCetak($data);
$formulir->Output();

?>

<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_sptpd_hotel_pdf.php");
include_once(RelativePath . "/Common.php");
require("../include/qrcode/fpdf17/fpdf.php");

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
		$data["t_vat_registration_id"] = $dbConn->f("t_vat_registration_id");
		$data["start_date_txt"] =  $dbConn->f("start_date_txt");
		$data["end_date_txt"] =  $dbConn->f("end_date_txt");
		$data["total_trans_amount"] =  $dbConn->f("total_trans_amount");
		$data["total_vat_amount"] =  $dbConn->f("total_vat_amount");
		$data["doc_no"] = $dbConn->f("doc_no");
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
	//end barcode
	$dbConn->close();
}
class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 206;
	var $paperHSize = 330.2;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	var $unit = 'in';
	
	function FormCetak() {
		//paper size diubah ke inchi: 203.2 = 8 inchi; 330.2 = 13 inchi.
		$this->FPDF('P', 'mm', array(203.2,330.2));
	}
	
	function __construct() {
		$this->FormCetak();
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");		
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;		
		$this->SetFont('Arial', '', 10);
		
		$lengthJudul1 = ($lengthCell * 2) / 10;
		$lengthJudul2 = ($lengthCell * 4) / 10;
		$lengthJudul3 = ($lengthCell * 4) / 10;
		$leng1 = ($lengthJudul3 * 3) / 10;
		$leng2 = ($lengthJudul3 * 7) / 10;
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);
		// $this->Cell($lengthCell, $this->height, "2.	BENTUK SURAT PEMBERITAHUAN PAJAK DAERAH UNTUK PAJAK HOTEL", 0, 0, 'L');
		// $this->Ln(6);
		$this->Cell($lengthJudul1, $this->height, "", "LT", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "", "TR", 0, 'R');
		$this->Cell($lengthJudul3, $this->height, "", "TR", 0, 'R');
		$this->Ln();
		$this->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "PEMERINTAHAN KOTA BANDUNG", "R", 0, 'C');
		$this->Cell($leng1, $this->height, " No. SPTPD", 0, 0, 'L');
		$this->Cell($leng2, $this->height, ": ".$data["doc_no"], "R", 0, 'L');
		$this->Ln();
		$this->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($leng1, $this->height, " Masa Pajak", 0, 0, 'L');
		$this->Cell($leng2, $this->height, ": ".$data["finance_period_code"], "R", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', '', 8);
		$this->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "Jalan Wastukancana No. 2", "R", 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell($leng1, $this->height, " Tahun Pajak", 0, 0, 'L');
		$this->Cell($leng2, $this->height, ": ".$data["tahun"], "R", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', '', 8);
		$this->Cell($lengthJudul1, $this->height, "", "L", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Cell($lengthJudul3, $this->height, "", "R", 0, 'R');
		$this->Ln();
		$this->Cell($lengthJudul1, $this->height, "", "LB", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "", "RB", 0, 'R');
		$this->Cell($lengthJudul3, $this->height, "", "RB", 0, 'R');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lengthCell, $this->height, "SPTPD", "LR", 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "(SURAT PEMBERITAHUAN PAJAK DAERAH)", "LR", 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "PAJAK HOTEL", "LR", 0, 'C');
		$this->Ln();
		
		$kepada1 = ($lengthCell * 10) / 15;
		$kepada2 = ($lengthCell * 5) / 15;
		$this->SetFont('Arial', '', 10);
		$this->Cell($kepada1, $this->height, "", "L", 0, 'C');
		$this->Cell($kepada2, $this->height, "Kepada Yth :", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kepada1, $this->height, "", "L", 0, 'C');
		$this->Cell($kepada2, $this->height, $data["wp_name"], "R", 0, 'L');
		$this->Ln();
		$spasi = ($kepada1 * 1) / 51;
		$npwd1 = ($kepada1 * 3) / 51;
		$npwd2 = ($kepada1 * 2) / 51;
		$npwd3 = ($kepada1 * 3) / 51;
		$npwd4 = ($kepada1 * 2) / 51;
		$npwd5 = ($kepada1 * 3) / 51;
		$npwd6 = ($kepada1 * 3) / 51;
		$npwd7 = ($kepada1 * 3) / 51;
		$npwd8 = ($kepada1 * 3) / 51;
		$npwd9 = ($kepada1 * 3) / 51;
		$npwd10 = ($kepada1 * 3) / 51;
		$npwd11 = ($kepada1 * 3) / 51;
		$npwd12 = ($kepada1 * 2) / 51;
		$npwd13 = ($kepada1 * 3) / 51;
		$npwd14 = ($kepada1 * 3) / 51;
		$npwd15 = ($kepada1 * 2) / 51;
		$npwd16 = ($kepada1 * 3) / 51;
		$npwd17 = ($kepada1 * 3) / 51;
		$npwd18 = ($kepada1 * 3) / 51;
		
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($kepada1, $this->height, " NPWPD.", "L", 0, 'L');
		$this->SetFont('Arial', '', 10);
		$this->Cell($kepada2, $this->height, $data["wp_address_name"], "R", 0, 'L');
		$this->Ln();
		//npwd
		//$this->Cell($kepada1, $this->height, "", "L", 0, 'C');
		$rep_npwd = str_replace(".","",$data["npwd"]);
		$arr1 = str_split($rep_npwd);
		
		$this->Cell($spasi, $this->height, "", "L", 0, 'C');
		$this->Cell($npwd1, $this->height, $arr1[0], 1, 0, 'C');
		$this->Cell($npwd2, $this->height, "", 0, 0, 'C');
		$this->Cell($npwd3, $this->height, $arr1[1], 1, 0, 'C');
		$this->Cell($npwd4, $this->height, "", 0, 0, 'C');
		$this->Cell($npwd5, $this->height, $arr1[2], 1, 0, 'C');
		$this->Cell($npwd6, $this->height, $arr1[3], 1, 0, 'C');
		$this->Cell($npwd7, $this->height, $arr1[4], 1, 0, 'C');
		$this->Cell($npwd8, $this->height, $arr1[5], 1, 0, 'C');
		$this->Cell($npwd9, $this->height, $arr1[6], 1, 0, 'C');
		$this->Cell($npwd10, $this->height, $arr1[7], 1, 0, 'C');
		$this->Cell($npwd11, $this->height, $arr1[8], 1, 0, 'C');
		$this->Cell($npwd12, $this->height, "", 0, 0, 'C');
		$this->Cell($npwd13, $this->height, $arr1[9], 1, 0, 'C');
		$this->Cell($npwd14, $this->height, $arr1[10], 1, 0, 'C');
		$this->Cell($npwd15, $this->height, "", 0, 0, 'C');
		$this->Cell($npwd16, $this->height, $arr1[11], 1, 0, 'C');
		$this->Cell($npwd17, $this->height, $arr1[12], 1, 0, 'C');
		$this->Cell($npwd18, $this->height, "", 0, 0, 'C');
		$this->Cell($kepada2, $this->height, "di ".$data["wp_kota"], "R", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", "LRB", 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 9);
		$this->Cell($lengthCell, $this->height, "PERHATIAN  :", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "1.	Harap diisi dalam rangkap (3) ditulis dengan huruf CETAK.", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "2.	Beri nomor pada kotak yang tersedia untuk jawaban yang diberikan", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "3.	Setelah diisi dan ditandatangani harap diserahkan kembali kepada Dinas Pelayanan Pajak paling lambat 15 hari Kalender", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "4.	Keterlambatan Penyerahan dari tanggal tersebut di atas akan dilakukan Penerbitan Surat Teguran.", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", "LRB", 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lengthCell, $this->height, "A. DIISI OLEH WAJIB PAJAK / PENANGGUNG PAJAK", 1, 0, 'C');
		$this->SetFont('Arial', '', 9);
		$this->Ln();
		//kelas Hotel							
		$this->Cell($lengthCell, $this->height, "", "LR", 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 9);
		
		$kel1 = ($lengthCell * 5) / 16;
		$kel2 = ($lengthCell * 3) / 16;
		$kel3 = ($lengthCell * 3) / 16;
		$kel4 = ($lengthCell * 5) / 16;
		
		$spcs = ($kel2 * 6)/10;
		$kela1 = ($kel2 * 2)/10;
		$kela2 = ($kel2 * 2)/10;
		
		
		$this->Cell($kel1, $this->height, " 3. Menggunakan Kas Register", "L", 0, 'L');
		$this->Cell($spcs, $this->height, "", 0, 0, 'L');
		$this->Cell($kela1, $this->height, "", 1, 0, 'C'); //isi
		$this->Cell($kela2, $this->height, "", 0, 0, 'C');		
		$this->Cell($kel3, $this->height, "1.  Ya", 0, 0, 'L');
		$this->Cell($kel4, $this->height, "2.  Tidak", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kel1+$kel2, $this->height, "", "L", 0, 'L');
		$this->Cell($kel3, $this->height, "", 0, 0, 'L');
		$this->Cell($kel4, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kel1, $this->height, " 4. Mengadakan pembukuan/pencetakan", "L", 0, 'L');
		$this->Cell($spcs, $this->height, "", 0, 0, 'L');
		$this->Cell($kela1, $this->height, "", 1, 0, 'C'); //isi
		$this->Cell($kela2, $this->height, "", 0, 0, 'C');	
		$this->Cell($kel3, $this->height, "1.  Ya", 0, 0, 'L');
		$this->Cell($kel4, $this->height, "2.  Tidak", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kel1+$kel2, $this->height, "", "L", 0, 'L');
		$this->Cell($kel3, $this->height, "", 0, 0, 'L');
		$this->Cell($kel4, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kel1, $this->height, " 5. Mengadakan Bon", "L", 0, 'L');
		$this->Cell($spcs, $this->height, "", 0, 0, 'L');
		$this->Cell($kela1, $this->height, "", 1, 0, 'C'); //isi
		$this->Cell($kela2, $this->height, "", 0, 0, 'C');	
		$this->Cell($kel3, $this->height, "1.  Ya", 0, 0, 'L');
		$this->Cell($kel4, $this->height, "2.  Tidak", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kel1+$kel2, $this->height, "", "L", 0, 'L');
		$this->Cell($kel3, $this->height, "", 0, 0, 'L');
		$this->Cell($kel4, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, " 6. Nomor Urut Bon Penjualan Seri ..... No ........s/d No ..........", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lengthCell, $this->height, "B. DIISI OLEH WAJIB PAJAK / PENANGGUNG PAJAK SELF ASSESMENT", 1, 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 9);
		$kol1 = ($lengthCell * 1) / 20;
		$kol2 = ($lengthCell * 9) / 20;
		$kol3 = ($lengthCell * 10) / 20;
		
		$this->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "1.", "L", 0, 'C');
		$this->Cell($kol2+$kol3, $this->height, "Jumlah Pembayaran dan Pajak Terutang untuk Masa Pajak sebelumnya (akumulasi dari awal Masa Pajak dalam", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2+$kol3, $this->height, "Tahun Pajak Tertentu)", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "a. Masa Pajak", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": Tgl..........................s/d Tgl..........................", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "b. Dasar Pengenaan (Jumlah pembayaran yang", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": Rp............................................................", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "    diterima)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "c. Tarif Pajak (sesuai Perda)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": ...............%", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "d. Pajak terutang  (b x c)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": Rp............................................................", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "2.", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "Jumlah Pembayaran dan Pajak Terutang untuk Masa Pajak sekarang (lampiran foto copy dokumen)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "a. Masa Pajak", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": Tgl. ".$data["start_date_txt"]." s/d Tgl. ".$data["end_date_txt"], "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "b. Dasar Pengenaan (Jumlah pembayaran yang", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": Rp. ".number_format($data["total_trans_amount"],2,",","."), "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "    diterima)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "c. Tarif Pajak (sesuai Perda)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": 10%", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "d. Pajak terutang  (b x c)", 0, 0, 'L');
		$this->Cell($kol3, $this->height, ": Rp. ".number_format($data["total_vat_amount"],2,",","."), "R", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", "LRB", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lengthCell, $this->height, "C. PERNYATAAN", 1, 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 9);
		$this->Cell($lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$kolm1 = ($lengthCell * 1) / 40;
		$kolm2 = ($lengthCell * 18) / 40;
		$kolm3 = ($lengthCell * 20) / 40;
		$kolm4 = ($lengthCell * 1) / 40;
		$this->Cell($kolm1, $this->height, "", "L", 0, 'C');
		$this->Cell($kolm2+$kolm3+$kolm4, $this->height, "Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kolm1, $this->height, "", "L", 0, 'C');
		$this->Cell($kolm2+$kolm3+$kolm4, $this->height, "yang berlaku, saya atau yang saya beri kuasa menyalakan bahwa apa yang telah kami beritahukan tersebut di atas beserta", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kolm1, $this->height, "", "L", 0, 'C');
		$this->Cell($kolm2+$kolm3+$kolm4, $this->height, "lampiran-lampiran adalah benar, lengkap dan jelas", "R", 0, 'L');
		$this->Ln();
		$this->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$this->Cell($kolm3+$kolm4, $this->height, "................................................................, tahun ...........", "R", 0, 'C');
		$this->Ln();
		$this->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$this->Cell($kolm3+$kolm4, $this->height, "Wajib Pajak/Penanggung Pajak", "R", 0, 'C');
		$this->Ln();
		//barcode
		$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$data["barcode"],135,$this->getY(),25,0,'PNG');
		$this->Cell($kolm1+$kolm2, $this->height*4, "", "L", 0, 'C');
		$this->Cell($kolm3+$kolm4, $this->height*4, "", "R", 0, 'C');
		$this->Ln();
		$this->Cell($kolm1+$kolm2, $this->height, "", "L", 0, 'C');
		$this->Cell($kolm3, $this->height, "", "B", 0, 'C');
		$this->Cell($kolm4, $this->height, "", "R", 0, 'C');
		$this->Ln();
		$this->Cell($kolm1+$kolm2, $this->height, "", "LB", 0, 'C');
		$this->Cell($kolm3+$kolm4, $this->height, "Nama Jelas", "RB", 0, 'C');
		$this->Ln();
		
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

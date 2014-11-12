<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_surat_pengukuhan_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("CURR_DOC_ID", "");
//$t_customer_order_id = 1;
$data = array();

$dbConn = new clsDBConnSIKP();

$query="begin;";
$dbConn->query($query);
$query="select 
		c.wp_name,
		c.wp_address_name || ' ' || nvl(wp_address_no,' ') as wp_address_name,
		c.company_owner ,
		c.company_brand,
		c.npwpd,
		c.company_name,
		c.address_name || ' ' || nvl(address_no,' ') as company_address,
		c.address_name_owner ||nvl(address_no_owner,' ') as alamat_tinggal,
		c.brand_address_name ||nvl(brand_address_no,' ') as alamat_pajak ,
		c.brand_address_name || ' ' || nvl(brand_address_no,' ') as alamat_brand ,
		b.p_vat_type_id,
		type.vat_code,
		c.reg_letter_no,
		decode(c.p_hotel_grade_id,null,null,1,1,2,1,3,1,4,1,5,1,0) as klasifikasi,
		d.vat_code as detail_jenis_pajak
from t_customer_order a,
		p_rqst_type b,
		t_vat_registration c,
		p_vat_type type,
		p_vat_type_dtl d
where a.p_rqst_type_id = b.p_rqst_type_id
	and a.t_customer_order_id = c.t_customer_order_id
	and b.p_vat_type_id = type.p_vat_type_id
	and c.p_vat_type_dtl_id = d.p_vat_type_dtl_id
	and a.t_customer_order_id =".$t_customer_order_id;

$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["wp_name"] = $dbConn->f("wp_name");
		$data["wp_address_name"] = $dbConn->f("wp_address_name");
		$data["company_owner"] = $dbConn->f("company_owner");
		$data["company_brand"] = $dbConn->f("company_brand");
		$data["company_name"] = $dbConn->f("company_name");
		$data["company_address"] = $dbConn->f("company_address");
		$data["npwpd"] = $dbConn->f("npwpd");
		$data["alamat_tinggal"] = $dbConn->f("alamat_tinggal");
		$data["alamat_pajak"] = $dbConn->f("alamat_pajak");
		$data["alamat_brand"] = $dbConn->f("alamat_brand");
		$data["p_vat_type_id"] = $dbConn->f("p_vat_type_id");
		$data["reg_letter_no"] = $dbConn->f("reg_letter_no");
		$data["klasifikasi"] = $dbConn->f("klasifikasi");
		$data["vat_code"] = $dbConn->f("vat_code");
		$data["detail_jenis_pajak"] = $dbConn->f("detail_jenis_pajak");
}

$dbConn->query("end;");
$dbConn->close();
// echo "<pre>";
// var_dump($data);
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
	}
	
	function setCourier(){
		$this->SetFont('Courier', 'B', 11);
	}

	function setTimes(){
		$this->SetFont('Times', 'B', 11);
	}
	
	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");		
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX + 20;
		
		// Set margins
		$this->SetLeftMargin(17);
		$this->SetRightMargin(15);
		
		// Judul
		for($i = 0; $i < 7; $i++){
			$this->Cell($lengthCell, $this->height, "", 0, 0, "C");
			$this->Ln();
		}
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->SetFont('Times', 'B', 12);
		$this->Cell($lengthCell, $this->height, "SURAT PENGUKUHAN WAJIB PAJAK DAERAH", 0, 0, 'C');
		$this->Ln();
		
		$this->SetFont('Times', '', 11);
		$this->Cell($lengthCell, $this->height, "Nomor: 973/" . $data["reg_letter_no"]."/".str_ireplace('Pajak ','',$data['vat_code']) ."/Disyanjak", 0, 0, 'C');
		// Body Atas
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "                Berdasarkan Undang-undang Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah dan", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "Peraturan Daerah No. 20 tahun 2011 tentang Pajak Daerah, dengan ini menyatakan bahwa:", 0, 0, 'L');
		
		// Form
		$this->Ln();
		$this->Ln();
		$formLen = $lengthCell / 3;
		$formLen1 = $formLen * 1;
		$formLen2 = $formLen * 2;
		$twelfth = $lengthCell / 12;
		$twelfth1 = $twelfth * 1;
		
		// Form 1. Wajib Pajak
		$this->SetFont('Times', 'B', 11);
		$this->Cell($formLen1, $this->height, "1. Wajib Pajak", 0, 0, 'L');
		$this->SetFont('Times', '', 11);
		$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
		$this->Cell($formLen2 - $twelfth1, $this->height, $data["wp_name"], 0, 0, 'L');
		

		// Form 2. NPWPD
		$this->Ln();
		$this->SetFont('Times', 'B', 11);
		$this->Cell($formLen1, $this->height, "2. Nomor Pokok Wajib Pajak Daerah", 0, 0, 'L');
		$this->SetFont('Times', '', 11);
		$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');

		$newstr = substr_replace($data["npwpd"],'.', 2, 0);
		$newstr = substr_replace($newstr,'.', 10, 0);
		$newstr = substr_replace($newstr,'.', 13, 0);
		$this->SetFont('Times', 'B', 14);
		$this->Cell($formLen2 - $twelfth1, $this->height, $newstr, 0, 0, 'L');
		$this->Ln();
		$this->SetFont('Times', 'B', 11);
		$this->Cell($formLen1, $this->height, "    (NPWPD)", 0, 0, 'L');

			
		if(empty($data['company_name']) or $data['company_name'] == '-' or $data['company_name'] == 'A' or strlen($data['company_name']) < 3 ) { 
			//PERORANGAN
			
			// Form 3. Nama Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "3. Nama Merek Dagang", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_brand"], 0, 0, 'L');
			
			// Form 4. Alamat Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "4. Alamat Lokasi Usaha", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["alamat_brand"], 0, 0, 'L');
		
			// Form 5. Alamat Wajib Pajak
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "5. Alamat Wajib Pajak", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["wp_address_name"], 0, 0, 'L');
			
			// Form 6. Jenis Pajak
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "6. Jenis Pajak", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');


		} else { //PERUSAHAAN

			// Form 3. Nama Badan/Perusahaan
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "3. Nama Badan/Perusahaan", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_name"], 0, 0, 'L');
		
				
			// Form 4. Nama Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "4. Nama Merek Dagang", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_brand"], 0, 0, 'L');
		
			// Form 5. Alamat Merek Dagang
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "5. Alamat Lokasi Usaha", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["alamat_brand"], 0, 0, 'L');
		

			// Form 6. Alamat Wajib Pajak
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "6. Alamat Wajib Pajak", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["wp_address_name"], '', 0, 'L');
		
			// Form 7. Alamat Badan/Perusahaan
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "7. Alamat Badan/Perusahaan", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
			$this->Cell($formLen2 - $twelfth1, $this->height, $data["company_address"], 0, 0, 'L');
		

			// Form 8. Jenis Pajak
			$this->Ln();
			$this->SetFont('Times', 'B', 11);
			$this->Cell($formLen1, $this->height, "8. Jenis Pajak", 0, 0, 'L');
			$this->SetFont('Times', '', 11);
			$this->Cell($twelfth1-12, $this->height, " : ", 0, 0, 'C');
		}

		// Form 8. Jenis Pajak -> Kotak Pilihan
		$kotakLen = ($formLen2 - $twelfth1) / 20;
		$kotakLen1 = $kotakLen * 1;
		$kotakLen3 = $kotakLen * 3;
		$kotakLen9 = $kotakLen * 9;
		
		$this->SetFont('Times', 'B', 11);
		
		$hotel = " ";
		$restoran = " ";
		$hiburan = " ";
		$parkir = " ";
		$ppj = " ";
		$bphtb = " ";
		
		switch($data["p_vat_type_id"]){
			case 1: $hotel = "X"; break;
			case 2: $restoran = "X"; break;
			case 3: $hiburan = "X"; break;
			case 4: $parkir = "X"; break;
			case 5: $ppj = "X"; break;
			case 6: $bphtb = "X"; break;
		}
		
		$bintang = " ";
		$melati = " ";
		$losmen = " ";
		$detail_bintang = array();
		$detail_melati = array();
		$detail_losmen = array();
		if(strpos(strtolower($data["detail_jenis_pajak"]), "bintang") !== false){ //HOTEL BINTANG X
			preg_match("/\d+/", $data["detail_jenis_pajak"], $detail_bintang);
			$bintang = "X";
			//$bintang = $detail_bintang[0];
		}
		else if(strpos(strtolower($data["detail_jenis_pajak"]), "melati") !== false){ //HOTEL MELATI X
			preg_match("/\d+/", $data["detail_jenis_pajak"], $detail_melati);
			//$melati = $detail_melati[0];
			$melati = "X";
		}
		else if(strpos(strtolower($data["detail_jenis_pajak"]), "rumah kos") !== false){ //HOTEL MELATI X
			preg_match("/\d+/", $data["detail_jenis_pajak"], $detail_losmen);
			//$losmen = $detail_losmen[0];
			$losmen = "X";
			$hotel=" ";
		}
		
		// switch($data["klasifikasi"]){
			// case 1: $bintang = "X"; break;
			// case 0: $melati = "X"; break;
		// }
		
		// if(is_null($data["klasifikasi"])){
			// $bintang = " ";
			// $melati = " ";
		// }
		
		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 1
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$parkir]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9, $this->height, " Pajak Parkir", "", 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[ ]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9, $this->height, " Pajak Reklame", "", 0, 'L');
		
		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 2
		$this->Ln();
		$this->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$hiburan]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9, $this->height, " Pajak Hiburan", "", 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$ppj]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9, $this->height, " Pajak Penerangan Jalan", "", 0, 'L');
		
		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 3
		$this->Ln();
		$this->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$restoran]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9 * 2 + $kotakLen1, $this->height, " Pajak Restoran/Rumah Makan", "", 0, 'L');
		
		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 4
		$this->Ln();
		$this->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$hotel]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9 + 8, $this->height, " Pajak Hotel: Klasifikasi: Bintang", "", 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$bintang]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen3 - 3, $this->height, "  Melati", "", 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$melati]", "", 0, 'L');
		
		// Form 6. Kewajiban Wajib Pajak -> Kotak Pilihan -> Baris 5
		$this->Ln();
		$this->Cell($formLen1 + $twelfth1-12, $this->height, "", 0, 0, 'L');
		$this->SetCourier();
		$this->Cell($kotakLen1, $this->height, "[$losmen]", "", 0, 'L');
		$this->SetTimes();
		$this->Cell($kotakLen9 * 2 + $kotakLen1, $this->height, " Pajak Sewa Menyewa/Kontrak Rumah dan/atau", "", 0, 'L');
		$this->Ln();
		$this->Cell($formLen1 + $twelfth1, $this->height, "", 0, 0, 'L');
		$this->Cell($kotakLen1, $this->height, "", "", 0, 'L');
		$this->Cell($kotakLen9 * 2 + $kotakLen1, $this->height, " Bangunan", "", 0, 'L');
		
		// Body Bawah
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->SetFont('Times', '', 11);
		$this->Cell($lengthCell, $this->height, "Telah dikukuhkan pada tata usaha kami sebagai Wajib Pajak", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "                Dengan terbitnya surat ini, maka dalam melaksanakan hak dan kewajiban yang berkenaan dengan", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "Pajak Daerah wajib mencantumkan NPWPD.", 0, 0, 'L');
		
		// Signature
		$this->Ln();
		$this->Ln();
		$sigLen = $lengthCell / 2;
		$sigLen1 = $sigLen * 1;
		$sigLen2 = $sigLen * 2;
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		//$this->Cell($sigLen1, $this->height, "Bandung, 26 September 2014" , 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "Bandung, " . date("j F Y"), 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->SetFont('Times', 'B', 11);
		$this->Cell($sigLen1, $this->height, "a.n. WALIKOTA BANDUNG", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "Kepala Dinas Pelayanan Pajak", 0, 0, 'C');
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "Drs. PRIANA WIRASAPUTRA, MM", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->SetFont('Times', '', 11);
		$this->Cell($sigLen1, $this->height, "Pembina Utama Muda", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "NIP. 19600308 198503 1 007", 0, 0, 'C');
		
		// Tembusan
		
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		$this->SetFont('Times', 'BU', 10);
		$this->Cell($lengthCell / 10, $this->height, "Tembusan,", 0, 0, 'L');
		$this->SetFont('Times', '', 10);
		$this->Cell($lengthCell - ($lengthCell / 10), $this->height, "disampaikan kepada Yth:", 0, 0, 'L');
		$this->Ln();
		
		$this->Cell($lengthCell, $this->height, "1. Bapak Walikota Bandung (sebagai laporan);", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "2. Bapak Wakil Walikota Bandung (sebagai laporan);", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "3. Bapak Sekretaris Daerah Kota Bandung (sebagai laporan);", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "4. Arsip.", 0, 0, 'L');
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

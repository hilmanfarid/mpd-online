<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_surat_pengukuhan_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");
include_once("../include/qrcode/generate-qr-file.php");
define('FPDF_FONTPATH','../include/font/');

$t_customer_order_id = CCGetFromGet("CURR_DOC_ID", "");
$tgl = CCGetFromGet("tgl", "");
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
		LPAD(c.reg_letter_no,5,0) as reg_letter_no,
		decode(c.p_hotel_grade_id,null,null,1,1,2,1,3,1,4,1,5,1,0) as klasifikasi,
		d.vat_code as detail_jenis_pajak
from t_vat_registration c		
left join t_customer_order a on a.t_customer_order_id = c.t_customer_order_id
left join p_rqst_type b on a.p_rqst_type_id = b.p_rqst_type_id
left join p_vat_type type on b.p_vat_type_id = type.p_vat_type_id
left join p_vat_type_dtl d on c.p_vat_type_dtl_id = d.p_vat_type_dtl_id
where a.t_customer_order_id =".$t_customer_order_id;

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
	var $fontFam = 'BookmanOldStyle';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 210;
	var $paperHSize = 340;
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
		$this->DefPageFormat[1] = 330;
		//echo '<pre>';print_r($this); exit;	
	}
	
	function setCourier(){
		$this->SetFont('Courier', 'B', 11);
	}

	function setBookmanOldStyle(){
		$this->SetFont('BookmanOldStyle', 'B', 11);
	}
	
	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");	
			
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX + 20;
		$this->height = 5;
		
		$this->AddFont('BookmanOldStyle','');
		$this->AddFont('BookmanOldStyle','B','BookmanOldStyleB.php');
		$this->AddFont('BookmanOldStyle','BI','BookmanOldStyleBI.php');
		
		$this->Image('../images/logo_pemda.png',25,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BookmanOldStyle', 'B', 12);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		$this->Ln(7);
		
		$this->SetFont('BookmanOldStyle', 'B', 18);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BookmanOldStyle', '', 10);
		$this->Cell($lheader1, $this->height + 3, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "B", 0, 'C');
		$this->Ln();
		
		// Set margins
		$this->SetLeftMargin(33);
		$this->SetRightMargin(0);
		
		// Judul
		
		$this->Ln();
		$this->Ln();
		$this->SetFont('BookmanOldStyle', 'B', 12);
		$this->Cell($lengthCell-40, $this->height, "SURAT PENGUKUHAN", 0, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell-40, $this->height, "NOMOR POKOK WAJIB PAJAK DAERAH (NPWPD) JABATAN", 0, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell-40, $this->height, "NOMOR : 973 / ".$data["reg_letter_no"]." / NPWPD.JBT - DISYANJAK", 0, 0, 'C');
		$this->Ln();
		
		$this->SetFont('BookmanOldStyle', '', 11);
		//$this->Cell($lengthCell, $this->height, "Nomor: 973/" . $data["reg_letter_no"]."/".str_ireplace('Pajak ','',$data['vat_code']) ."/Disyanjak", 0, 0, 'C');
		// Body Atas
		$this->Ln();
		$this->Ln();
		
		$this->SetWidths(array($lengthCell-40));
		$this->SetAligns(array("J"));
		$this->Cell(10, $this->height, "     ", 0, 0, 'J');
		$this->Cell($lengthCell-50, $this->height, "Berdasarkan  Peraturan  Daerah Kota Bandung Nomor 20 Tahun 2011", 0, 0, 'J');
		$this->Ln();
		$this->RowMultiBorderWithHeight(array(
			"tentang Pajak Daerah, bersama ini diterbitkan NPWPD Jabatan terhadap :"
			),
			array(
			""
			),
			$this->height);
		$this->Ln(2);
		$this->SetWidths(array(40,$lengthCell-40-40));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(array(
			"Objek Pajak",
			": ".$data["company_brand"]
			),
			array(
			"",""
			),
			$this->height);
			
		$this->RowMultiBorderWithHeight(array(
			"Alamat",
			": ".$data["alamat_brand"]
			),
			array(
			"",""
			),
			$this->height);
			
		$this->RowMultiBorderWithHeight(array(
			"Jenis Pajak",
			": ".$data["vat_code"]
			),
			array(
			"",""
			),
			$this->height);
			
		$this->RowMultiBorderWithHeight(array(
			"NPWPD Jabatan",
			": ".$data["npwpd"]
			),
			array(
			"",""
			),
			$this->height);
		
		$this->Ln(2);
		$this->SetWidths(array($lengthCell-40));
		$this->SetAligns(array("J"));
		$this->Cell(10, $this->height, "     ", 0, 0, 'J');
		$this->Cell($lengthCell-50, $this->height, "Untuk   memenuhi   ketentuan   pada   Peraturan   Daerah  dimaksud, ", 0, 0, 'J');
		$this->Ln();
		$this->RowMultiBorderWithHeight(array(
			"pemilik/pengelola usaha diminta untuk datang   ke   loket   informasi dan penanganan   pengaduan   pada  Dinas   Pelayanan   Pajak   Kota  Bandung"
			),
			array(
			""
			),
			$this->height);
		
		
		$this->Cell($lengthCell-120, $this->height, "Jl. Wastukancana  No. 2  Bandung", "", 0, 'J');
		$this->SetFont('BookmanOldStyle', 'BI', 11);
		$this->Cell(10, $this->height, " paling  lambat  7  (tujuh)  hari  kerja", 0, 0, 'J');
		$this->Ln();
		$this->SetFont('BookmanOldStyle', '', 11);
		$this->Cell(122, $this->height, "sejak   diterimanya   pengukuhan   ini   untuk    memberikan", 0, 0, 'J');
		$this->SetFont('BookmanOldStyle', 'BI', 11);
		$this->Cell($lengthCell-66, $this->height, "klarifikasi, ", 0, 0, 'J');
		$this->Ln();
		$this->Cell($lengthCell-80, $this->height, "pemutakhiran   data   dan   menerima    informasi", 0, 0, 'J');
		$this->SetFont('BookmanOldStyle', '', 11);
		$this->Cell(90, $this->height, " terkait   kewajiban", 0, 0, 'J');
		$this->Ln();
		$this->Cell(55, $this->height, "perpajakan  daerah  dengan ", 0, 0, 'J');
		$this->SetFont('BookmanOldStyle', 'BI', 11);
		$this->Cell(52, $this->height, "membawa  kelengkapan", 0, 0, 'J');
		$this->SetFont('BookmanOldStyle', '', 11);
		$this->Cell(90, $this->height, "sebagai berikut :", 0, 0, 'J');
		$this->Ln();
		$this->Ln(2);
		$this->SetWidths(array(7,$lengthCell-40-7));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(array(
			"1. ",
			"Fotocopy identitas diri (KTP atau SIM atau Paspor);"
			),
			array(
			"",""
			),
			$this->height);
		
		$this->RowMultiBorderWithHeight(array(
			"2. ",
			"Fotocopy akte pendirian (untuk badan usaha); dan"
			),
			array(
			"",""
			),
			$this->height);
		
		$this->RowMultiBorderWithHeight(array(
			"3. ",
			"Surat pernyataan kegiatan usaha dari pemilik/pengelola usaha dan/atau fotocopy perizinan kegiatan usaha dari instansi berwenang."
			),
			array(
			"",""
			),
			$this->height);
			
		$this->Ln(2);
		$this->SetWidths(array($lengthCell-40));
		$this->SetAligns(array("J"));
		$this->Cell(10, $this->height, "     ", 0, 0, 'J');
		$this->Cell($lengthCell-50, $this->height, "Apabila  Saudara  telah  mendaftarkan diri dan memiliki  NPWPD  agar", 0, 0, 'J');
		$this->Ln();
		$this->RowMultiBorderWithHeight(array(
			"segera melapor pada loket Pelayanan Informasi dan Penanganan Pengaduan Dinas Pelayanan Pajak Jl. Wastukancana No. 2 Bandung dengan  membawa FC bukti pembayaran pajak bulan terakhir."
			),
			array(
			""
			),
			$this->height);
		$this->Ln(2);
		$this->SetWidths(array($lengthCell-40));
		$this->SetAligns(array("J"));
		$this->Cell(10, $this->height, "     ", 0, 0, 'J');
		$this->Cell($lengthCell-50, $this->height, "Demikian disampaikan untuk menjadi perhatian.", 0, 0, 'J');
		$this->Ln();
		$this->Ln();
		
		// Signature
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$sigLen = ($lengthCell-40) / 2;
		$sigLen1 = $sigLen * 1;
		$sigLen2 = $sigLen * 2;
		$bulan =array();
		$bulan [1]= "Januari";
		$bulan [2]= "Februari";
		$bulan [3]= "Maret";
		$bulan [4]= "April";
		$bulan [5]= "Mei";
		$bulan [6]= "Juni";
		$bulan [7]= "Juli";
		$bulan [8]= "Agustus";
		$bulan [9]= "September";
		$bulan [10]= "Oktober";
		$bulan [11]= "Nopember";
		$bulan [12]= "Desember";
		
		$tgl = CCGetFromGet("tgl", "");
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		if ($tgl == ''){
			$this->Cell($sigLen1, $this->height, "Bandung, " . date("j").' '.$bulan[date('n')].' '.date("Y"), 0, 0, 'C');
		}else{
			$this->Cell($sigLen1, $this->height, "Bandung, ".$tgl , 0, 0, 'C');
		}
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->SetFont('BookmanOldStyle', 'B', 11);
		$this->Cell($sigLen1, $this->height, "a.n. WALIKOTA BANDUNG", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "KEPALA DINAS PELAYANAN PAJAK", 0, 0, 'C');
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		/*
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "Drs. PRIANA WIRASAPUTRA, MM", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->SetFont('BookmanOldStyle', '', 11);
		$this->Cell($sigLen1, $this->height, "Pembina Utama Muda", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "NIP. 19600308 198503 1 007", 0, 0, 'C');
		*/
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "Drs. H. EMA SUMARNA, M. Si", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->SetFont('BookmanOldStyle', '', 11);
		$this->Cell($sigLen1, $this->height, "PEMBINA UTAMA MUDA", 0, 0, 'C');
		$this->Ln();
		
		$this->Cell($sigLen1, $this->height, "", 0, 0, 'C');
		$this->Cell($sigLen1, $this->height, "NIP. 19661207 198603 1 006", 0, 0, 'C');
		
		$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.
		str_replace(" ","-","NOMOR : 973 / ".$data["reg_letter_no"]." / NPWPD.JBT - DISYANJAK")."_".
		$data["npwpd"]."_".
		str_replace(" ","-",$data["company_brand"])."_".
		str_replace(" ","-",$data["alamat_brand"])."_".
		str_replace(" ","-",$data["vat_code"])
		,40,228,25,25,'PNG');
		
		
		// Tembusan
		
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		$this->SetFont('BookmanOldStyle', 'BU', 11);
		$this->Cell(23, $this->height, "Tembusan,", 0, 0, 'L');
		$this->SetFont('BookmanOldStyle', '', 11);
		$this->Cell($lengthCell - ($lengthCell / 10), $this->height, "disampaikan kepada Yth. :", 0, 0, 'L');
		$this->Ln();
		$this->SetFont('BookmanOldStyle', '', 11);
		//$this->height = $this->height - 1;
		$this->height = 4;
		$this->Cell($lengthCell, $this->height, "1. Bapak Walikota Bandung (sebagai laporan);", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "2. Bapak Wakil Walikota Bandung (sebagai laporan); dan", 0, 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "3. Bapak Sekretaris Daerah Kota Bandung (sebagai laporan).", 0, 0, 'L');
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
if(!empty($_GET['save'])){
	$name_of_file = "print_pdf_".time().".pdf";
	try{
		$dbConn->query("INSERT INTO t_print_queue(t_customer_order_id, file_name, status) VALUES (".$t_customer_order_id.",'".$name_of_file."', 'SAVED');");
		$dbConn->next_record();
		
		$formulir->Output('D:\work\list_pdf\\'.$name_of_file,'F');
	}catch(Exception $e){
		@unlink('D:\work\list_pdf\\'.$name_of_file);
	}
}else{
	$formulir->Output();
}
?>

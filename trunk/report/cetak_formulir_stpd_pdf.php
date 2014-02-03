<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_stpd_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$VatId = CCGetFromGet("t_vat_setllement_id", "");
$data = array();

$dbConn = new clsDBConnSIKP();

$query="select b.npwd,
	   to_char(a.start_penalty,'YYYY') as tahun,	
       to_char(a.start_penalty,'DD-MON-YYYY')as start_penalty,
       to_char(a.end_penalty,'DD-MON-YYYY')as end_penalty,	
       a.month_qty,
       a.penalty_pct,
       a.penalty_amt,
       c.company_name,
       c.address_name,
	   d.vat_code,
	   e.order_no,
	   d.penalty_code as penalty_ayat,
      replace(f_terbilang(to_char(round(nvl(a.penalty_amt,0))),'IDR'), '  ', ' ') as dengan_huruf
from t_vat_penalty a, t_vat_setllement b, t_cust_account c, p_vat_type d, t_customer_order e
where a.t_vat_setllement_id = b.t_vat_setllement_id
and b.t_cust_account_id = c.t_cust_account_id
and b.t_customer_order_id = e.t_customer_order_id 
and c.p_vat_type_id = d.p_vat_type_id
and a.t_vat_setllement_id = ".$VatId;

$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["npwd"] = $dbConn->f("npwd");
		$data["start_penalty"] = $dbConn->f("start_penalty");
		$data["end_penalty"] = $dbConn->f("end_penalty");
		$data["month_qty"] = $dbConn->f("month_qty");
		$data["penalty_pct"] = $dbConn->f("penalty_pct");
		$data["penalty_amt"] = $dbConn->f("penalty_amt");
		$data["company_name"] = $dbConn->f("company_name");
		$data["address_name"] = $dbConn->f("address_name");
		$data["vat_code"] = $dbConn->f("vat_code");
		$data["dengan_huruf"] = $dbConn->f("dengan_huruf");
		$data["tahun"] = $dbConn->f("tahun");
		$data["penalty_ayat"] = $dbConn->f("penalty_ayat");
		$data["order_no"] = $dbConn->f("order_no");
		
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
	
$dbConn->close();


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
		
		$this->Image('../images/logo_pemda.png',15,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$this->Cell($lheader2, $this->height, "", "TR", 0, 'C');
		$this->Cell($lheader2, $this->height, "", "TR", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->SetFont('Arial', '', 12);
		$this->Cell($lheader2, $this->height, "STPD", "R", 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->SetFont('Arial', '', 8);
		$this->Cell($lheader2, $this->height, "(Surat Tagihan Pajak Daerah)", "R", 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height, "No. Urut", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height + 2, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell(5, $this->height + 2, "", "", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Cell($lheader1 - 5, $this->height + 2, "Masa Pajak ", "", 0, 'L');
		$this->Cell($lheader1, $this->height + 2, ": " . $data["tahun"], "R", 0, 'L');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height + 2, "", "R", 0, 'C');
		$this->Ln($this->height-4);
		// No Urut
		$this->Cell($lheader2 + $lheader4 + 7, $this->height, "", "R", 0, 'C');


		$no_urt = str_split($data["order_no"]);
		$this->kotak(1, 34, 1, $no_urt[0]);
		$this->kotak(1, 34, 1, $no_urt[1]);
		$this->kotak(1, 34, 1, $no_urt[2]);
		$this->kotak(1, 34, 1, $no_urt[3]);
		$this->kotak(1, 34, 1, $no_urt[4]);
		$this->kotak(1, 34, 1, $no_urt[5]);
		$this->Ln();
		// =======
		
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Cell(5, $this->height, "", "", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Cell($lheader1 - 5, $this->height, "Tahun Pajak ", "", 0, 'L');
		$this->Cell($lheader1, $this->height, ": " . $data["tahun"], "R", 0, 'L');
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader2, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader2, $this->height, "", "BR", 0, 'L');
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 10);
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Nama", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " . $data["company_name"], "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Alamat", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " . $data["address_name"], "R", 0, 'L');
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
		$this->kotak(1, 34, 2,$arr1[9]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 2,$arr1[10]);
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Tanggal jatuh tempo", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " . $data["start_penalty"]." s/d ".$data["end_penalty"], "R", 0, 'L');
		
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LBR", 0, 'L');
		$this->newLine();
		$this->tulis("I. Berdasarkan Pasal 67 ayat (1) Peraturan Daerah Nomor 20 Tahun 2011, telah dilakukan penelitian dan atau", "L");
		$this->tulis("keterangan lain atas pelaksanaan kewajiban:", "L");
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height + 2, "Ayat Pajak", "", 0, 'L');
		$this->Cell($lbody3, $this->height + 2, "" /*. $data["ayat"]*/, "R", 0, 'L');
		$this->Ln($this->height - 4);
		
		// Ayat Pajak
		$this->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
		$ayat_pajak = str_split($data["penalty_ayat"]);
		$this->kotak(1, 34, 1, $ayat_pajak[0]);
		$this->kotak(1, 34, 1, $ayat_pajak[1]);
		$this->kotak(1, 34, 1, $ayat_pajak[2]);
		$this->kotak(1, 34, 1, $ayat_pajak[3]);
		$this->kotak(1, 34, 1, $ayat_pajak[4]);
		$this->kotak(1, 34, 1, $ayat_pajak[5]);
		$this->Ln();
		// ==========
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height, "Nama Pajak", "", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " . $data["vat_code"], "R", 0, 'L');
		
		$this->newLine();
		$this->tulis("II. Dari penelitian dan/atau pemeriksaan lain tersebut di atas, penghitungan jumlah yang masih harus dibayar", "L");
		$this->tulis("adalah sebagai berikut:", "L");
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody3 - 5, $this->height, "1. Pajak yang kurang bayar", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Rp " /*. $data["ayat"]*/, "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody3 - 5, $this->height, "2. Sanksi administrasi bunga (Pasal 67 ayat (2)", "", 0, 'L');
		$this->Cell(6, $this->height, "Rp " , "B", 0, 'L');
		$this->Cell($lbody1-16, $this->height, $this->getNumberFormat($data["penalty_amt"],2), "B", 0, 'R');
		$this->Cell(10, $this->height, "" /*. $data["ayat"]*/, "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody3 - 5, $this->height, "3. Jumlah yang masih harus dibayar (1 + 2a)", "", 0, 'L');
		$this->Cell(6, $this->height, "Rp " , "", 0, 'L');
		$this->Cell($lbody1-16, $this->height,$this->getNumberFormat($data["penalty_amt"],2), "", 0, 'R');
		$this->Cell(10, $this->height, "" /*. $data["ayat"]*/, "R", 0, 'L');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "BLR", 0, 'L');
		$this->newLine();
		
		$this->Cell(5, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lbody1 - 5, $this->height + 2, "Dengan huruf", "", 0, 'L');
		$this->Cell($lbody3, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height - 4);
		
		// Dengan huruf
		$this->Cell($lbody1 - 5, $this->height, "", "", 0, 'L');
		$this->kotak(25, 34, 1, $data["dengan_huruf"]);
		$this->Ln();
		// ============
		
		$this->Cell($this->lengthCell, $this->height, "", "BLR", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', 'U', 10);
		$this->Cell($lbody1, $this->height, "PERHATIAN:", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->tulis("1. Harap penyetoran dilakukan melalui Kas Daerah dengan menggunakan Surat Setoran Pajak Daerah (SSPD)", "L");
		$this->tulis("2. Apabila STPD ini tidak atau kurang dibayar setelah lewat waktu paling lama 15 hari kalender sejak STPD ini", "L");
		$this->tulis("diterbitkan dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan.", "L");
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "R", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "KEPALA BIDANG PAJAK, ", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "KOTA BANDUNG", "R", 0, 'C');
		$this->newLine();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "H. SONI BAKHTIYAR, S.SOS, M.SI", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 8, $this->height, "NIP. 19750625 1994031 1 001", "T", 0, 'L'); //isi nip
		$this->Cell(2, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LBR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "Gunting di sini", "B", 0, 'C');
		$this->Ln();
		$this->Ln();
		$this->Cell($lbody3, $this->height, "", "LT", 0, 'L');
		$this->Cell($lbody1, $this->height, "No. STPD", "TR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "TANDA TERIMA", "LR", 0, 'C');
		$this->Ln();
		$this->Cell($lbody1, $this->height, "     NPWPD", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " /*.$data["npwpd"]*/, "R", 0, 'L');
		$this->Ln();
		$this->Cell($lbody1, $this->height, "     Nama", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " /*.$data["nama"]*/, "R", 0, 'L');
		$this->Ln();
		$this->Cell($lbody1, $this->height, "     Alamat", "L", 0, 'L');
		$this->Cell($lbody3, $this->height, ": " /*.$data["alamat"]*/, "R", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "R", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Yang menerima, ", "R", 0, 'C');
		$this->newLine();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
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
		$this->Ln();
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
$formulir->PageCetak($data);
$formulir->Output();

?>

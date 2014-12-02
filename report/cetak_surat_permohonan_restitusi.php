<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_bpps.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$t_bphtb_restitusi_id		= CCGetFromGet("t_bphtb_restitusi_id", "");
if(empty($t_bphtb_restitusi_id)){
	die("Proses membutuhkan restitusi id");
}
// $t_bphtb_registration_id		= 23;

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$sql = "select *,to_char(payment_date, 'dd-mon-yyyy') as payment_date
		from t_bphtb_restitusi a
		left join t_bphtb_registration x on a.t_bphtb_registration_id= x.t_bphtb_registration_id
		LEFT JOIN t_payment_receipt_bphtb y on a.t_bphtb_registration_id = y.t_bphtb_registration_id
		where t_bphtb_restitusi_id =".$t_bphtb_restitusi_id;

$dbConn->query($sql);
$items = array();
while($dbConn->next_record()){
	$data["wp_name"] = $dbConn->f("wp_name");
	$data["wp_address_name"] = $dbConn->f("wp_address_name");
	$data["npwd"] = $dbConn->f("npwd");
	$data["no_urut"] = $dbConn->f("registration_no");
	$data["bphtb_amt_final"] = $dbConn->f("bphtb_amt_final");
	$data["njop_pbb"] = $dbConn->f("njop_pbb");
	$data["restitusi_amt"] = $dbConn->f("restitusi_amt");
	$data["payment_date"] = $dbConn->f("payment_date");
	$items[] = $data;
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

		$this->Image('../images/logo_pemda.png',10,10,20,20);
		
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
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;
		$lbody5 = $lbody * 5;
		$lbody10 = $lbody * 10;
		$lbody15 = $lbody * 15;
		
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody2,$lbody4+$lbody2+$lbody4,$lbody4+$lbody4));
		$this->SetAligns(array("L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"\n".
				"\nNomor".
				"\nSifat".
				"\nLampiran".
				"\nPerihal"
				,
				"\n".
				"\n: ".
				"\n: Biasa".
				"\n: 1 (satu) Berkas".
				"\n: Permohonan Restitusi a.n. ".$data["wp_name"]
				,
				"Bandung,                         2014".
				"\n".
				"\nKepada Yth :".
				"\nKepala Dinas Pengelolaan Keuangan dan Aset Daerah (DPKAD) Kota Bandung".
				"\n\ndi \n     B A N D U N G"

			),
			array
			(
				"","",""
			),
			$this->height);
		$this->Ln();

		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody2,$this->lengthCell-$lbody2));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Menindaklanjuti permohonan Restitusi Pajak BPHTB a.n. ".$data["wp_name"].
				", yang secara garis besarnya adanya pembayaran penuh atas Pajak BPHTB terhadap Wajib Pajak orang pribadi yang menerima waris dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau ke bawah.".
				"Dapat kami informasikan, pembayaran BPHTB berdasarkan perhitungan atas Waris adalah NIHIL sebagaimana Berita Acara Pemeriksaan terlampir.".
				"Namun dikarenakan pemohon melakukan pembayran BPHTB penuh via BJB Kas Pelayanan BPHTB Dinas Bandung pada tanggal ".
				$data["payment_date"].
				" sebesar Rp. ".number_format($data["bphtb_amt_final"],2,",",".").
				" maka ada kelebihan sebesar Rp. ".number_format($data["restitusi_amt"],2,",",".")."."
			),
			array
			(
				"",""
			),
			$this->height);
		$this->Ln();
		$this->SetWidths(array($lbody2,$this->lengthCell-$lbody2));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Berhubungan dengan hal tersebut, kmai meminta bantuannya pengembalian kelebihan pembayran pajak dimaksud sebagaimana tertulis pada data pendukung sebagaimana terlampir.".
				"Adapaun pengembalian agar disampaikan melalui transfer ke ".
				"BANK BNI CAB. PERINTIS KEMERDEKAAN JL PERINTIS KEMERDEKAAN NO. 3".
				" a.n. pemegang rekening "."NY. KARMILAH SAMBAS".
				" dengan nomor rekening "."002086583-5".
				"."
			),
			array
			(
				"",""
			),
			$this->height);
		$this->Ln();
		$this->SetWidths(array($lbody2,$this->lengthCell-$lbody2));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Demikian agar menjadi maklum. Atas perhatian dan bantuannya diucpkan terima kasih."
			),
			array
			(
				"",""
			),
			$this->height);
		$this->Ln();
		$this->SetFont("Arial", "B", 8);
		$this->SetWidths(array($lbody2,$lbody4+$lbody2+$lbody4,$lbody4+$lbody4));
		$this->SetAligns(array("L","C","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	"","",
				"KEPALA DINAS PELAYANAN PAJAK\n".
				"\n".
				"\n".
				"\nDrs. PRIANA WIRASAPUTRA MM".
				"\nPembina Utama Muda".
				"\nNIP. 19600308 198503 1 007"

			),
			array
			(
				"","",""
			),
			$this->height);
		$this->Ln();
		$this->Ln();
		
		$this->SetFont("Arial", "BU", 8);
		$this->Cell(16, $this->height, "Tembusan, ", "", 0, 'L');
		$this->SetFont("Arial", "", 8);
		$this->Cell("", $this->height, "disampaikan kepada Yth: ", "", 0, 'L');
		$this->Ln();
		$this->SetWidths(array(5,""));
		$this->SetAligns(array("L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"1.\n".
				"2.\n".
				"3.\n"
				,
				"Bapak Walikota Bandung (sebagai laporan)".
				"\nBapak Wakil walikota Bandung (sebagai laporan)".
				"\nBapak Plt. Sekretaris Daerah Kota Bandung (sebagai laporan)"

			),
			array
			(
				"",""
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
$formulir->Output();

?>

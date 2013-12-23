<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_sts_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$yearId = CCGetFromGet("p_year_period_id", "");
$tglPenerimaan = CCGetFromGet("tgl_penerimaan", "");
$data = array();

$dbConn = new clsDBConnSIKP();

$query="Select *
from
  (
  select kode_jns_pajak  as kode_rekening ,jns_pajak as rincian_object, sum(jumlah_terima) as jumlah  from f_rep_sts(".$yearId.", '".$tglPenerimaan."',1)
  group by kode_jns_pajak ,jns_pajak
  UNION
  select kode_jns_pajak  as kode_rekening ,jns_pajak as rincian_object, sum(jumlah_terima) as jumlah  from f_rep_sts(".$yearId.", '".$tglPenerimaan."',2)
  group by kode_jns_pajak ,jns_pajak
  )
order by kode_rekening ";

$dbConn->query($query);

while ($dbConn->next_record()) {
		$data["kode_rekening"][] = $dbConn->f("kode_rekening");
		$data["rincian_object"][] = $dbConn->f("rincian_object");
		$data["jumlah"][] = $dbConn->f("jumlah");
}

$total = 0;
for ($i=0; $i<count($data['kode_rekening']); $i++) {
	$totalUang = $data["jumlah"][$i];
	
	$total = $total + $data["jumlah"][$i];
}

$query_ter = "select replace(f_terbilang(to_char(round(nvl(".$total.",0))),'IDR'), '  ', ' ') as dengan_huruf";
$dbConn->query($query_ter);
while ($dbConn->next_record()) {
	$terbilang = $dbConn->f("dengan_huruf");
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 210;
	var $paperHSize = 100;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		//$this->FPDF();
		$this->FPDF('P', 'mm', array(210,150));
	}
	
	function __construct() {
		$this->FormCetak();
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data,$terbilang,$total) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;		
		$this->SetFont('Arial', '', 8);
		
		$this->Cell($lengthCell, $this->height, "PEMERINTAHAN KOTA BANDUNG", 0, 0, 'C');	
		$this->Ln();
		$this->SetFont('Arial', '', 10);
		$this->Cell($lengthCell, $this->height, "SURAT TANDA SETORAN", 0, 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 12);
		$this->Cell($lengthCell, $this->height, "(STS)", 0, 0, 'C');
		$this->Ln();
		$this->Ln();
		
		$length1 = ($lengthCell * 1) / 18;
		$length2 = ($lengthCell * 4) / 18;
		$length3 = ($lengthCell * 9) / 18;
		$length4 = ($lengthCell * 4) / 18;
		$this->SetFont('Arial', '', 8);
		$this->Cell($length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length2, $this->height, "STS NO :", 0, 0, 'L');
		$this->Cell($length2+$length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length1+$length1, $this->height, "Bank", 0, 0, '');
		$this->Cell($length1, $this->height, ":", 0, 0, '');
		$this->Ln();
		$this->Cell($length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length2, $this->height, "", 0, 0, 'L');
		$this->Cell($length2+$length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length1+$length1, $this->height, "No Rekening", 0, 0, '');
		$this->Cell($length1, $this->height, ":", 0, 0, '');
		$this->Ln();
		$this->Cell($length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length2+3, $this->height, "Harap diterima uang sebesar ", 0, 0, 'L');
		$this->Cell($length2+$length1, $this->height, ": Rp. ".$total, 0, 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length2+3, $this->height, "(dengan huruf)", 0, 0, 'L');
		$this->Cell($length2+$length1, $this->height, ": ".$terbilang, 0, 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", 0, 0, 'L');
		$this->Cell($length2+3, $this->height, "Dengan rincian penerimaan sebagai berikut :", 0, 0, 'L');
		$this->Ln(7);
		$this->SetFont('Arial', '', 8);
		$this->Cell($length1, $this->height, "No.", 1, 0, 'C');
		$this->Cell($length2, $this->height, "Kode Rekening", 1, 0, 'C');
		$this->Cell($length3, $this->height, "Uraian Rincian Obyek", 1, 0, 'C');
		$this->Cell($length4, $this->height, "Jumlah(Rp.)", 1, 0, 'C');
		$this->Ln();
		
		
		
		//isi kolom
		$this->SetWidths(array($length1, $length2, $length3, $length4));
		$this->SetAligns(array("C", "L", "L", "R"));
		$no = 1;
		$jumlah = 0;
		for ($i=0; $i<count($data['kode_rekening']); $i++) {
		$this->RowMultiBorderWithHeight(array($no,
											  $data["kode_rekening"][$i],
											  $data["rincian_object"][$i],
											  number_format($data["jumlah"][$i],2,",","."))
											 ,
										array('LR',
										      'LR',
											  'LR',
											  'LR')
											  ,$this->height);
		$no = $no + 1;										
		$jumlah = $jumlah + $data["jumlah"][$i];
		}
		
		$this->Cell($length1+$length2+$length3, $this->height, "Jumlah", 1, 0, 'C');
		$this->Cell($length4, $this->height, number_format($jumlah,2,",","."), 1, 0, 'R');
		$this->Ln(7);
		$this->Cell($lengthCell, $this->height, "Uang tersebut diterima pada tanggal : ".date("d F Y"), 0, 0, 'C');
		$this->Ln();
		
		$ttd1 = ($lengthCell * 3)/9;
		$ttd2 = ($lengthCell * 3)/9;
		$ttd3 = ($lengthCell * 3)/9;
		
		$this->Cell($ttd1, $this->height, "Mengetahui", 0, 0, 'C');
		$this->Cell($ttd1, $this->height, "", 0, 0, 'C');
		$this->Cell($ttd1, $this->height, "Bendahara Penerima", 0, 0, 'C');
		$this->Ln();
		$this->Cell($ttd1, $this->height, "Kuasa Pengguna Anggaran", 0, 0, 'C');
		$this->Cell($ttd1, $this->height, "", 0, 0, 'C');
		$this->Cell($ttd1, $this->height, "", 0, 0, 'C');
		$this->Ln();
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
$formulir->PageCetak($data,$terbilang,$total);
$formulir->Output();

?>

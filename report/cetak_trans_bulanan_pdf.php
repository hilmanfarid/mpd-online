<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_trans_bulanan_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_cust_account_id = CCGetFromGet("t_cust_account_id", "");
$data = array();
	
if(empty($t_cust_account_id)){
	echo "data tidak ada";
	exit();
}else{

	$dbConn = new clsDBConnSIKP();

	$query="select * from f_get_cust_acc_dtl_trans_month(".$t_cust_account_id.") AS tbl (t_cust_acc_dtl_trans_month) ";

	$dbConn->query($query);
	while ($dbConn->next_record()) {
			$data["trans_date_txt"][] = $dbConn->f("trans_date_txt");
			$data["service_charge"][] = $dbConn->f("service_charge");
			$data["vat_charge"][] = $dbConn->f("vat_charge");
	}

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
	}

	
	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");		
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;		
		$this->SetFont('Arial', '', 10);
		
		$kosong = ($lengthCell * 3) / 15;
		$kol1 = ($lengthCell * 3) / 15;
		$kol2 = ($lengthCell * 3) / 15;
		$kol3 = ($lengthCell * 3) / 15;  
		$kosong2 = ($lengthCell * 3) / 15;
		
		$this->Cell($lengthCell, $this->height, "TRANSAKSI BULANAN WP", 0, 0, 'C');
		$this->Ln(10);
		$this->Cell($kosong, $this->height, "", 0, 0, 'C');
		$this->Cell($kol1, $this->height, "Tanggal Transaksi", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "Nilai Transaksi", 1, 0, 'C');
		$this->Cell($kol3, $this->height, "Nilai Pajak", 1, 0, 'C');
		$this->Cell($kosong2, $this->height, "", 0, 0, 'C');
		$this->Ln();
		$this->SetWidths(array($kosong, $kol1, $kol2, $kol3, $kosong2));
		$this->SetAligns(array("C", "C", "R", "R", "C"));
		for ($i=0; $i<count($data['trans_date_txt']); $i++) {
		$this->RowMultiBorderWithHeight(array("",
											  $data["trans_date_txt"][$i],
											  $data["service_charge"][$i],
											  $data["vat_charge"][$i],"")
											 ,
										array('',
											  'TBLR',
											  'TBLR',
											  'TBLR','')
											  ,$this->height);
		}		
		
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

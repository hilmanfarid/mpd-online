<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "view_daftar_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");
//$t_customer_order_id = 67;
$data = array();

if(empty($t_customer_order_id)){
	echo "data tidak ada";
	exit();
}else{
$dbConn = new clsDBConnSIKP();

$query="select * from f_debt_letter_list(".$t_customer_order_id.") AS tbl (ty_debt_letter_list)";

$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["npwd"][] = $dbConn->f("npwd");
		$data["company_name"][] = $dbConn->f("company_name");
		$data["vat_code"][] = $dbConn->f("vat_code");
		$data["tap_no"][] = $dbConn->f("tap_no");
		$data["tap_date"][] = $dbConn->f("tap_date");
		//$data["due_date"][] = $dbConn->f("due_date");
		$data["debt_amount"][] = $dbConn->f("debt_amount");

}

$dbConn->close();
}

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 297;
	var $paperHSize = 210;
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
		$this->AddPage("L");		
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;		
		$this->SetFont('Arial', '', 10);
		
		$kol1 = ($lengthCell * 3) / 18;
		$kol2 = ($lengthCell * 3) / 18;
		$kol3 = ($lengthCell * 3) / 18; 
		$kol4 = ($lengthCell * 3) / 18;
		$kol5 = ($lengthCell * 3) / 18; 
		$kol5 = ($lengthCell * 3) / 18; 
		
		$this->Cell($lengthCell, $this->height, "VIEW DAFTAR SURAT TEGURAN", 0, 0, 'C');
		$this->Ln(10);
		$this->Cell($kol1, $this->height, "NPWPD", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "Nama", 1, 0, 'C');
		$this->Cell($kol3, $this->height, "Jenis Pajak", 1, 0, 'C');
		$this->Cell($kol4, $this->height, "No. Ketetapan", 1, 0, 'C');
		$this->Cell($kol5, $this->height, "Tgl. Jatuh Tempo", 1, 0, 'C');
		$this->Cell($kol6, $this->height, "Tagihan (Rp.)", 1, 0, 'C');
		$this->Ln();
		
		$this->SetWidths(array($kol1, $kol2, $kol3, $kol4, $kol5, $kol6));
		$this->SetAligns(array("L", "L", "L", "L", "C", "R"));
		for ($i=0; $i<count($data['npwd']); $i++) {
		$this->RowMultiBorderWithHeight(array($data["npwd"][$i],
											  $data["company_name"][$i],
											  $data["vat_code"][$i],
											  $data["tap_no"][$i]." - ".$data["tap_date"][$i],
											  "", //$data["due_date"][$i]
											  $data["debt_amount"][$i])
											 ,
										array('TBLR',
											  'TBLR',
											  'TBLR',
											  'TBLR',
											  'TBLR',
											  'TBLR')
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

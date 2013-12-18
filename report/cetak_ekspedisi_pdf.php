<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_sspd_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

//$custId = CCGetFromGet("t_customer_order_id", "");
// $custId = 7;
$data = array();
// $dataArr = array();
// $dataBaru = array();
//$dbConn = new clsDBConnSIKP();
/*
$query="select a.order_no ,
       c.company_name ||'('||c.company_brand||')' as nama ,
       c.address_name ||' no. '|| c.address_no as alamat,
       c.npwd,
       'SPTPD' as dasar_setoran ,
       e.code as masa_pajak,
       to_char(e.start_date,'YYYY') as tahun,
       d.receipt_no as no_urut ,
       f.code as ayat ,
       f.vat_code as jenis_pajak,
       b.total_vat_amount as jumlah,
	   replace(f_terbilang(to_char(round(b.total_vat_amount)),'IDR'), '  ', ' ') as dengan_huruf
from t_customer_order a,
     t_vat_setllement b,
     t_cust_account c ,
     t_payment_receipt d,
     p_finance_period e ,
     p_vat_type f
where a.t_customer_order_id = b.t_customer_order_id 
      and b.t_cust_account_id = c.t_cust_account_id 
      and b.t_vat_setllement_id = d.t_vat_setllement_id (+) 
      and b.p_finance_period_id = e.p_finance_period_id
      and c.p_vat_type_id = f.p_vat_type_id
      and a.t_customer_order_id = ".$custId;
$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["o_order_no"] = $dbConn->f("o_order_no");
		$data["nama"] = $dbConn->f("nama");
		$data["alamat"] = $dbConn->f("alamat");
		$data["npwd"] = $dbConn->f("npwd");
		$data["dasar_setoran"] = $dbConn->f("dasar_setoran");
		$data["masa_pajak"] = $dbConn->f("masa_pajak");
		$data["no_urut"] = $dbConn->f("no_urut");
		$data["ayat"] = $dbConn->f("ayat");
		$data["jenis_pajak"] = $dbConn->f("jenis_pajak");
		$data["jumlah"] = $dbConn->f("jumlah");
		$data["dengan_huruf"] = $dbConn->f("dengan_huruf");
		$data["tahun"] = $dbConn->f("tahun");
}

$dbConn->close();
*/
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
		$this->SetFont('Arial', '', 12);
		
		$this->Cell($this->lengthCell, $this->height, "CETAK EKSPEDISI", "", 0, 'C');
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
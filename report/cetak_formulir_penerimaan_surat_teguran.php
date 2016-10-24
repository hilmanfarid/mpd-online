<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf17/mc_table.php");
include_once("../include/qrcode/generate-qr-file.php");

$p_year_period_id = CCGetFromGet("p_year_period_id", "");
$p_finance_period_id = CCGetFromGet("p_finance_period_id", "");
$sequence_no = CCGetFromGet("sequence_no", "");
$pejabat = CCGetFromGet("pejabat", 1);
$p_vat_type_id = CCGetFromGet("p_vat_type_id", 1);

$dbConn = new clsDBConnSIKP();
$query="select * from t_debt_letter where 
	p_finance_period_id=".$p_finance_period_id." and sequence_no = ".$sequence_no;
//echo $query;exit;
$dbConn->query($query);
$dbConn->next_record();
$t_customer_order_id = $dbConn->f("t_customer_order_id");

//$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");

//$t_customer_order_id = 67;
//$dataArr = array();
// $dataBaru = array();

if(empty($t_customer_order_id)||$t_customer_order_id==""){
	echo "data tidak ada";
	exit();
}else{
$dbConn = new clsDBConnSIKP();

//nip & nama
	$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin "
		  ."FROM p_global_param "
		  ."WHERE code = 'TTD KADIN'";
		  
	$dbConn->query($ttd);
	
	$nama_kadin = "";
	$nip_kadin = "";

	while($dbConn->next_record()){
		$nama_kadin = $dbConn->f("nama_kadin");
		$nip_kadin = $dbConn->f("nip_kadin");
	}


$query="select * from f_debt_letter_print2(".$t_customer_order_id.") AS tbl (ty_debt_letter_list)
		LEFT JOIN t_cust_account as b ON tbl.t_cust_account_id = b.t_cust_account_id
		LEFT JOIN t_debt_letter_dtl AS c ON tbl.t_cust_account_id = c.t_cust_account_id and tbl.t_debt_letter_id = c.t_debt_letter_id
		WHERE b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43) 
		and b.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id = ".$p_vat_type_id.")
		order by b.company_brand";

$dbConn->query($query);
//echo $query;exit;
$data=array();
while ($dbConn->next_record()) {
		$data[]= array(
			'npwd' => $dbConn->f("npwd"),
			'company_name' => $dbConn->f("company_brand"),
			'address' => $dbConn->f("brand_address_name").' '.$dbConn->f("brand_address_no"),
			'letter_no' => $dbConn->f("letter_no"),
			'vat_code' => $dbConn->f("vat_code"),
			'periode' => $dbConn->f("periode"),
			'tap_no' => $dbConn->f("tap_no"),
			'tap_date' => $dbConn->f("tap_date"),
			'due_date' => $dbConn->f("due_date"),
			'debt_amount' => $dbConn->f("debt_amount"),
			'terbilang' =>  $dbConn->f("terbilang"),
			'debt_period_code' =>  $dbConn->f("debt_period_code"),
			'sequence_no' => $dbConn->f("sequence_no"),
			'letter_date_txt' => $dbConn->f("letter_date_txt"),
			't_debt_letter_dtl_id' => $dbConn->f("t_debt_letter_dtl_id"),
			'nama_kadin' => $nama_kadin,
			'nip_kadin' => $nip_kadin
		);
}

	
$dbConn->close();
}

//$path = '';
//generate_qr($param,$path);

class FormCetak extends PDF_MC_Table {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 160;
	var $paperHSize = 210;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
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
	
	function PageCetak($data,$no_urut) {
		$this->AliasNbPages();
		$this->SetRightMargin(5);
		$this->SetLeftMargin(5);
		$this->SetTopMargin(15);
		$this->AddPage('Landscape', array(160,210));
		$this->AddFont('BookmanOldStyle','');
		$this->AddFont('BookmanOldStyle','B','BookmanOldStyleB.php');
		$this->AddFont('BookmanOldStyle','BI','BookmanOldStyleBI.php');
		
		$this->Image('../images/logo_pemda_warna.png',12,15,26,20);

		$this->SetFont('BookmanOldStyle', 'B',14);
		$this->SetWidths(array(40,160));
		$this->SetAligns(array("C","C"));
		$this->RowMultiBorderWithHeight(array("","PEMERINTAH KOTA BANDUNG"),array('',''),10);
		$this->SetFont('BookmanOldStyle', 'B',16);
		$this->RowMultiBorderWithHeight(array("","D I N A S   P E L A Y A N A N   P A J A K"),array('',''),10);
		$this->SetFont('BookmanOldStyle', '',12);
		$this->RowMultiBorderWithHeight(array("","Jalan Wastukancana No.2 Telp / Fax. 022-4235052 Bandung"),array('',''),10);
		$this->RowMultiBorderWithHeight(array("",""),array('B','B'),2);
		$this->ln(2);
		$this->Ln();
		$this->SetFont('BookmanOldStyle', 'B',14);
		$this->SetWidths(array(200));
		$this->SetAligns(array("C"));
		$this->RowMultiBorderWithHeight(array("TANDA TERIMA SURAT"),array(''),10);
		
		$this->SetFont('BookmanOldStyle', '',14);
		$this->SetWidths(array(5,35,155,5));
		$this->SetAligns(array("L","L","L","C"));
		$this->RowMultiBorderWithHeight(array("","Kepada Yth. :","Pimpinan ".$data['company_name'],""),array('','','',''),10);
		$this->RowMultiBorderWithHeight(array("","             ",$data["address"],""),array('','','',''),10);
		
		$this->SetFont('BookmanOldStyle', 'B',12);
		$this->SetWidths(array(10,90,100));
		$this->SetAligns(array("C","C","C"));
		$this->RowMultiBorderWithHeight(array("NO.","TGL. & NO. SURAT","PERIHAL"),array('BLTR','BLTR','BLTR'),10);
		$this->SetFont('BookmanOldStyle', '',10);
		$this->SetAligns(array("L","L","L"));
		$this->RowMultiBorderWithHeight(array("1",$data['letter_date_txt']." - 973 /       - Disyanjak","SURAT TEGURAN ".numberToRoman($data["sequence_no"])),array('BLTR','BLTR','BLTR'),10);
		$this->RowMultiBorderWithHeight(array("","",""),array('BLTR','BLTR','BLTR'),10);
		//$this->RowMultiBorderWithHeight(array("","",""),array('BLTR','BLTR','BLTR'),10);
		
		$this->SetFont('BookmanOldStyle', '',12);
		$this->SetWidths(array(100,100));
		$this->SetAligns(array("C","C"));
		$this->RowMultiBorderWithHeight(array("Dikirim tanggal ...........................","Diterima tanggal ..........................."),array('',''),10);
		$this->RowMultiBorderWithHeight(array("",""),array('',''),10);
		$this->SetFont('BookmanOldStyle', 'B',12);
		$this->RowMultiBorderWithHeight(array("PENGIRIM","PENERIMA"),array('',''),5);
		
		$dbConn = new clsDBConnSIKP();
		$query = "select f_encrypt_str('".$data['t_debt_letter_dtl_id']."') AS enc_data";

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$encImageData = $dbConn->f("enc_data");
		}
		//$this->Image('../images/logo_pemda.png',20,10,25,25);
		$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,90,120,30,30,'PNG');
		
		
	}

	function CellFJ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='')
	{
		$k=$this->k;
		if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
		{
			$x=$this->x;
			$ws=$this->ws;
			if($ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->AddPage($this->CurOrientation);
			$this->x=$x;
			if($ws>0)
			{
				$this->ws=$ws;
				$this->_out(sprintf('%.3f Tw', $ws*$k));
			}
		}
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$s='';
		if($fill==1 or $border==1)
		{
			if($fill==1)
				$op=($border==1) ? 'B' : 'f';
			else
				$op='S';
			$s=sprintf('%.2f %.2f %.2f %.2f re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
		}
		if(is_string($border))
		{
			$x=$this->x;
			$y=$this->y;
			if(is_int(strpos($border, 'L')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'T')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);
			if(is_int(strpos($border, 'R')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'B')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
		}
		if($txt!='')
		{
			if($align=='R')
				$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
			elseif($align=='C')
				$dx=($w-$this->GetStringWidth($txt))/2;
			elseif($align=='FJ')
			{
				//Set word spacing
				$wmax=($w-2*$this->cMargin);
				$this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt, ' ');
				$this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
				$dx=$this->cMargin;
			}
			else
				$dx=$this->cMargin;
			$txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
			if($this->ColorFlag)
				$s.='q '.$this->TextColor.' ';
			$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET', ($this->x+$dx)*$k, ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k, $txt);
			if($this->underline)
				$s.=' '.$this->_dounderline($this->x+$dx, $this->y+.5*$h+.3*$this->FontSize, $txt);
			if($this->ColorFlag)
				$s.=' Q';
			if($link)
			{
				if($align=='FJ')
					$wlink=$wmax;
				else
					$wlink=$this->GetStringWidth($txt);
				$this->Link($this->x+$dx, $this->y+.5*$h-.5*$this->FontSize, $wlink, $this->FontSize, $link);
			}
		}
		if($s)
			$this->_out($s);
		if($align=='FJ')
		{
			//Remove word spacing
			$this->_out('0 Tw');
			$this->ws=0;
		}
		$this->lasth=$h;
		if($ln>0)
		{
			$this->y+=$h;
			if($ln==1)
				$this->x=$this->lMargin;
		}
		else
			$this->x+=$w;
	}

	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->CellFJ(204.3, $this->height, $text, "", 0, $align);
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
function dateToString($date){
	if(empty($date)) return "";
	
	$monthname = array(0  => '-',
	                   1  => 'Januari',
	                   2  => 'Februari',
	                   3  => 'Maret',
	                   4  => 'April',
	                   5  => 'Mei',
	                   6  => 'Juni',
	                   7  => 'Juli',
	                   8  => 'Agustus',
	                   9  => 'September',
	                   10 => 'Oktober',
	                   11 => 'November',
	                   12 => 'Desember');    
	
	$pieces = explode('-', $date);
	
	return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
}


// A function to return the Roman Numeral, given an integer
 function numberToRoman($num)
 {
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value)
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
 }


$formulir = new FormCetak();
$no_urut=0;
foreach($data as $item){
	$formulir->PageCetak($item,$no_urut);
	$no_urut++;
}
$formulir->Output();

?>

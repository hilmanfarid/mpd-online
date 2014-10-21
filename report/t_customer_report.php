<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "t_customer_report.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$s_npwd = CCGetFromGet("s_npwd", "");
$p_vat_type_id = CCGetFromGet("p_vat_type_id", "");
$p_vat_type_dtl_id = CCGetFromGet("p_vat_type_dtl_id", "");
$s_wp_name = CCGetFromGet("s_wp_name", "");
$s_company_name = CCGetFromGet("s_company_name", "");
$s_company_brand = CCGetFromGet("s_company_brand", "");
$s_keyword = CCGetFromGet("s_keyword", "");

//$t_customer_order_id = 67;
$data = array();

if(empty($p_vat_type_id)){
	echo "Inputkan Jenis Pajak";
	exit();
}else{

$dbConn = new clsDBConnSIKP();

$p_vat_type_dtl_id_condition = '';
if(!empty($p_vat_type_dtl_id)) {
	$p_vat_type_dtl_id_condition = 'and b.p_vat_type_dtl_id = '.$p_vat_type_dtl_id.' ';
}

$query="select a.*, b.npwd, c.vat_code, d.vat_code as detail_pajak_code
FROM t_customer a
LEFT JOIN t_cust_account b ON a.t_customer_id = b.t_customer_id
LEFT JOIN p_vat_type c ON b.p_vat_type_id = c.p_vat_type_id
LEFT JOIN p_vat_type_dtl d ON b.p_vat_type_dtl_id = d.p_vat_type_dtl_id

WHERE upper(a.company_owner) like upper('%$s_keyword%') 
       and upper(a.address_name_owner) like upper('%$s_keyword%')
       and upper(b.npwd) like upper('%$s_npwd%')
       and upper(b.wp_name) like upper('%$s_wp_name%')
       and upper(b.company_name) like upper('%$s_company_name%')
       and upper(b.company_brand) like upper('%$s_company_brand%')
	   and b.p_vat_type_id like '%$p_vat_type_id%'
	   $p_vat_type_dtl_id_condition
	   and b.p_account_status_id = 1
	   ";

$dbConn->query($query);

while ($dbConn->next_record()) {
		$data["npwd"][] = $dbConn->f("npwd");
		$data["company_owner"][] = $dbConn->f("company_owner");
		$data["address_name_owner"][] = $dbConn->f("address_name_owner");
		$data["address_no_owner"][] = $dbConn->f("address_no_owner");
		$data["address_rt_owner"][] = $dbConn->f("address_rt_owner");
		$data["address_rw_owner"][] = $dbConn->f("address_rw_owner");
		$data["vat_code"][] = $dbConn->f("vat_code");
		$data["detail_pajak_code"][] = $dbConn->f("detail_pajak_code");
		$data["mobile_no_owner"][] = $dbConn->f("mobile_no_owner");
		$data["email_address"][] = $dbConn->f("email_address");
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
		
		$kol = $lengthCell / 18;
		$kol1 = $kol * 1;
		$kol2 = $kol * 2;
		$kol3 = $kol * 3;
		$kol4 = $kol * 4;
		$kol5 = $kol * 5;
		
		$this->SetFont('Arial', 'B', 12);
		$this->Cell($lengthCell, $this->height, "DAFTAR WAJIB PAJAK ", 0, 0, 'C');
		$this->Ln(10);
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($kol1-7, $this->height, "NO", 1, 0, 'C');
		$this->Cell($kol4, $this->height, "Nama Pemilik/Pengelola", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "NPWD", 1, 0, 'C');
		$this->Cell($kol3, $this->height, "Alamat", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "Jenis Pajak", 1, 0, 'C');
		$this->Cell($kol2+10, $this->height, "Ayat Pajak", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "No Selular", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "Email", 1, 0, 'C');
		$this->Ln();
		

		$this->SetFont('Arial', '', 8);
		$this->SetWidths(array($kol1-7, $kol4, $kol2, $kol3, $kol2, $kol2+10, $kol2, $kol2));
		$this->SetAligns(array("C", "L", "L", "L", "C", "L", "L", "L"));
		for ($i=0; $i<count($data['company_owner']); $i++) {
			$this->RowMultiBorderWithHeight(
				array(
					$i + 1,
					$data["company_owner"][$i],
					$data["npwd"][$i],
					$data["address_name_owner"][$i]." No ".$data["address_no_owner"][$i]." RT/RW : ".$data["address_rt_owner"][$i]."/".$data["address_rw_owner"][$i],
					$data["vat_code"][$i],
					$data["detail_pajak_code"][$i],
					$data["mobile_no_owner"][$i],
					$data["email_address"][$i]
				),
				array(
					'TBLR',
					'TBLR',
					'TBLR',
					'TBLR',
					'TBLR',
					'TBLR',
					'TBLR',
					'TBLR'
				),
				$this->height
			);
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

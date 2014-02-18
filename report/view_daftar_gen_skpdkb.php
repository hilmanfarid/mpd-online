<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "view_daftar_gen_skpdkb.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");
$p_vat_type_id = CCGetFromGet("p_vat_type_id", "");
//$t_customer_order_id = 67;
$data = array();

if(empty($t_customer_order_id)){
	echo "data tidak ada";
	exit();
}else{
$dbConn = new clsDBConnSIKP();

$query="select 0 as x_dummy, 
                         a.t_gen_skpdkb_id ,
                         b.t_cust_account_id, 
                         a.t_customer_order_id, 
                         c.npwd, 
                         c.company_name, 
                         d.vat_code, 
                         f.code as settlement_type, 
                         a.tap_date, 
                         a.letter_no, 
                         e.code as periode, 
                         b.tap_no, 
                         b.tap_date, 
                         b.debt_amount,
                         c.wp_address_name as address_name,
                         to_char(e.start_date,'dd-mm-yyyy') as start_date ,
                         to_char(e.end_date,'dd-mm-yyyy') as end_date ,
                         '15-'||to_char(add_months(e.start_date,1),'mm-yyyy') due_date  ,
                         '-' as description ,
                         c.p_vat_type_id
                    
					FROM t_gen_skpdkb a
                    LEFT JOIN t_gen_skpdkb_dtl b ON a.t_gen_skpdkb_id = b.t_gen_skpdkb_id
                    LEFT JOIN t_cust_account c ON b.t_cust_account_id = c.t_cust_account_id
                    LEFT JOIN p_vat_type d ON c.p_vat_type_id = d.p_vat_type_id
                    LEFT JOIN p_finance_period e ON a.p_finance_period_id = e.p_finance_period_id
                    LEFT JOIN p_settlement_type f ON a.p_settlement_type_id = f.p_settlement_type_id
					INNER JOIN t_vat_setllement g ON b.t_vat_setllement_id = g.t_vat_setllement_id
					WHERE a.t_customer_order_id = $t_customer_order_id 
                         and b.p_account_status_id = 1 
                         and c.p_vat_type_id = $p_vat_type_id";
$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["npwd"][] = $dbConn->f("npwd");
		$data["company_name"][] = $dbConn->f("company_name");
		$data["address_name"][] = $dbConn->f("address_name");
		$data["vat_code"][] = $dbConn->f("vat_code");
		$data["due_date"][] = $dbConn->f("due_date");
		$data["start_date"][] = $dbConn->f("start_date");
		$data["end_date"][] = $dbConn->f("end_date");
		$data["debt_amount"][] = $dbConn->f("debt_amount");
		$data["description"][] = $dbConn->f("description");
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
		
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lengthCell, $this->height, "DAFTAR SKPDKB " . strtoupper($data["vat_code"][0]), 0, 0, 'C');
		$this->Ln(10);
		$this->SetFont('Arial', '', 10);
		$this->Cell($kol1, $this->height, "NO", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "NPWPD", 1, 0, 'C');
		$this->Cell($kol3, $this->height, "NAMA", 1, 0, 'C');
		$this->Cell($kol3, $this->height, "ALAMAT", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "JATUH TEMPO", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "MASA PAJAK", 1, 0, 'C');
		$this->Cell($kol2, $this->height, "BESARNYA", 1, 0, 'C');
		$this->Cell($kol3, $this->height, "KETERANGAN", 1, 0, 'C');
		$this->Ln();
		
		$this->SetWidths(array($kol1, $kol2, $kol3, $kol3, $kol2, $kol2, $kol2, $kol3));
		$this->SetAligns(array("C", "L", "L", "L", "C", "C", "R", "L"));
		for ($i=0; $i<count($data['npwd']); $i++) {
			$this->RowMultiBorderWithHeight(
				array(
					$i + 1,
					$data["npwd"][$i],
					$data["company_name"][$i],
					$data["address_name"][$i],
					$data["due_date"][$i],
					$data["start_date"][$i]." - ".$data["end_date"][$i],
					$data["debt_amount"][$i],
					$data["description"][$i]
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
		$this->ln(8);
		$this->SetAligns(array("C","C"));
		$this->SetWidths(array($kol1+$kol2+$kol3+$kol3+$kol2+$kol2, $kol2+$kol3));
		$this->RowMultiBorderWithHeight(array('',"Kepala Seksi Piutang\n\n\n\n\n\nRACHMAT SATIADI, S.Ip., M.Si\nNIP.19691104 199803 1 007"),array('',''),$this->height);
		/*$this->ln(16);
		$this->RowMultiBorderWithHeight(array('','RACHMAT SATIADI, S.Ip., M.Si'),array('',''),$this->height);
		$this->RowMultiBorderWithHeight(array('','NIP.19691104 199803 1 007'),array('',''),$this->height);	*/	
		
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

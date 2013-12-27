<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_berita_acara_pemeriksaan_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");
// $t_customer_order_id = 39;
$data = array();

$dbConn = new clsDBConnSIKP();

$query = 	"select a.wp_name, a.wp_address_name, a.company_name, a.address_name, b.code as job_name, a.bap_employee_no_1, a.bap_employee_name_1, a.bap_employee_no_2, a.bap_employee_name_2, a.bap_employee_job_pos_1, a.bap_employee_job_pos_2 " .
			"from t_vat_registration a " .
			"join p_job_position b " .
			"on a.p_job_position_id = b.p_job_position_id " .
			"where t_customer_order_id = $t_customer_order_id";
// die($query);
$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["wp_name"]				= $dbConn->f("wp_name");
	$data["wp_address_name"]		= $dbConn->f("wp_address_name");
	$data["company_name"]			= $dbConn->f("company_name");
	$data["address_name"]			= $dbConn->f("address_name");
	$data["job_name"]				= $dbConn->f("job_name");
	$data["bap_employee_no_1"]		= $dbConn->f("bap_employee_no_1");
	$data["bap_employee_no_2"]		= $dbConn->f("bap_employee_no_2");
	$data["bap_employee_name_1"]	= $dbConn->f("bap_employee_name_1");
	$data["bap_employee_name_2"]	= $dbConn->f("bap_employee_name_2");
	$data["bap_employee_job_pos_1"]	= $dbConn->f("bap_employee_job_pos_1");
	$data["bap_employee_job_pos_2"]	= $dbConn->f("bap_employee_job_pos_2");
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 206;
	var $paperHSize = 330.2;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P', 'mm', array(203.2,330.2));
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
		
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 14);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader1, $this->height + 3, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "B", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->SetFont('Arial', 'UB', 12);
		$this->Cell($this->lengthCell, $this->height, "BERITA ACARA PEMERIKSAAN", "", 0, 'C');
		$this->newLine();
		$this->newLine();
		
		$this->SetFont('Arial', '', 10);
		$this->tulis("Pada hari ini .......... Tanggal ..... Bulan .................... Tahun .........., kami yang bertanda tangan di bawah ini:", "L");
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		// Nama Petugas
		$this->isi("1.", "Nama", ": " . $data["bap_employee_name_1"]);
		$this->isi("", "NIP", ": " . $data["bap_employee_no_1"]);
		$this->isi("", "Jabatan", ": " . $data["bap_employee_job_pos_1"]);
		$this->isi("2.", "Nama", ": " . $data["bap_employee_name_2"]);
		$this->isi("", "NIP", ": " . $data["bap_employee_no_2"]);
		$this->isi("", "Jabatan", ": " . $data["bap_employee_job_pos_2"]);

		// Body
		$this->newLine();
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(5, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2 * 2 - 25, $this->height, "Telah melakukan pemeriksaan atas:", "", 0, 'L');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->isi("1.", "Nama Wajib Pajak/", "");
		$this->isi("", "Penanggung Pajak", ": " . $data["wp_name"]);
		$this->isi("2.", "Alamat Wajib Pajak/", "");
		
		//alamat wajib pajak
		$this->SetWidths(array(10, 5, $lbody1, $lbody3 - 25, 10));
		$this->SetAligns(array("L", "L", "L", "L", "L"));
		$this->RowMultiBorderWithHeight(array(
			"",
			"",
			"Penanggung Pajak",
			": " . $data["wp_address_name"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
		
		$this->isi("3.", "Nama Perusahaan", ": " . $data["company_name"]);
		
		//alamat perusahaan
		$this->SetWidths(array(10, 5, $lbody1, $lbody3 - 25, 10));
		$this->SetAligns(array("L", "L", "L", "L", "L"));
		$this->RowMultiBorderWithHeight(array(
			"",
			"4.",
			"Alamat Perusahaan",
			": " . $data["address_name"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);

		$this->Cell(10, $this->height + 2, "", "", 0, 'L');
		$this->Cell(5, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1, $this->height + 2, "NPWD", "", 0, 'L');
		$this->Cell($lbody3 - 25, $this->height + 2, ":", "", 0, 'L');
		$this->Cell(10, $this->height + 2, "", "", 0, 'L');
		$this->Ln($this->height - 4);
		
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 8, $this->height, "", "", 0, 'L');
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

		$this->newLine();
		$this->isi_full("Dalam pemeriksaan tersebut di atas telah ditemukan hal-hal sebagai berikut:");
		$this->isi_full(".................................................................................................................................................................");
		$this->isi_full(".................................................................................................................................................................");
		$this->isi_full(".................................................................................................................................................................");
		$this->isi_full(".................................................................................................................................................................");
		$this->isi_full(".................................................................................................................................................................");
		$this->isi_full(".................................................................................................................................................................");
		$this->isi_full("Demikian Berita Acara Pemeriksaan ini dibuat dengan sebenar-benarnya.");
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Menyetujui,", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Wajib Pajak/Penanggung Pajak", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Petugas Pendata 1,", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody2, $this->height, "Nama Jelas:", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, $data["wp_name"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, $data["bap_employee_name_1"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, "", "T", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. " . $data["bap_employee_no_1"], "T", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "Jabatan:", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, $data["job_name"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, "(Tanda Tangan dan Cap Perusahaan)", "T", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Petugas Pendata 2,", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, $data["bap_employee_name_2"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();

		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. " . $data["bap_employee_no_2"], "T", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
	}
	
	function isi($no, $field, $content){
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(5, $this->height, "$no", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "$field", "", 0, 'L');
		$this->Cell($lbody3 - 25, $this->height, "$content", "", 0, 'L');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function isi_full($content){
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(5, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2 * 2 - 25, $this->height, "$content", "", 0, 'L');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->Ln();
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
$formulir->PageCetak($data);
$formulir->Output();

?>

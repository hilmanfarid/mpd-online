<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_penerimaan_pertahun.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");
$params=array();
$params['p_year_period_id'] = $p_year_period_id	= CCGetFromGet("p_year_period_id", "");
$params['p_vat_type_id'] = $p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
$params['tgl_status'] = $tgl_status			= CCGetFromGet("tgl_status", "");
$params['p_account_status_id'] = $p_account_status_id= CCGetFromGet("p_account_status_id", "");
$params['start_piutang'] = $start_piutang= CCGetFromGet("start_piutang", "");
$params['end_piutang'] = $end_piutang= CCGetFromGet("end_piutang", "");
$params['status_bayar'] = $status_bayar = CCGetFromGet("status_bayar", "");

// $p_year_period_id	= 4;
// $p_vat_type_id		= 1;
// $tgl_status			= '15-12-2013';
if(empty($p_account_status_id)) $p_account_status_id = "NULL";
if(empty($status_bayar)) $status_bayar = "NULL";

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select * from sikp.f_rep_penerimaan_pertahun_sts_piutang($p_year_period_id,$p_vat_type_id,$start_piutang,$end_piutang,$tgl_status,$p_account_status_id)";
					   

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["jenis_pajak"][]	= $dbConn->f("jenis_pajak");
	$data["tahun"][]		= $dbConn->f("tahun");
	$data["nama"][]			= $dbConn->f("nama");
	$data["alamat"][]		= $dbConn->f("alamat");
	$data["npwpd"][]		= $dbConn->f("npwpd");
	$data["f_12_sts"][]		= $dbConn->f("f_12_sts");
	$data["f_12_amt"][]		= $dbConn->f("f_12_amt");
	$data["f_12_paydate"][]	= $dbConn->f("f_12_paydate");
	$data["f_11_sts"][]		= $dbConn->f("f_11_sts");
	$data["f_11_amt"][]		= $dbConn->f("f_11_amt");
	$data["f_11_paydate"][]	= $dbConn->f("f_11_paydate");
	$data["f_10_sts"][]		= $dbConn->f("f_10_sts");
	$data["f_10_amt"][]		= $dbConn->f("f_10_amt");
	$data["f_10_paydate"][]	= $dbConn->f("f_10_paydate");
	$data["f_09_sts"][]		= $dbConn->f("f_09_sts");
	$data["f_09_amt"][]		= $dbConn->f("f_09_amt");
	$data["f_09_paydate"][]	= $dbConn->f("f_09_paydate");
	$data["f_08_sts"][]		= $dbConn->f("f_08_sts");
	$data["f_08_amt"][]		= $dbConn->f("f_08_amt");
	$data["f_08_paydate"][]	= $dbConn->f("f_08_paydate");
	$data["f_07_sts"][]		= $dbConn->f("f_07_sts");
	$data["f_07_amt"][]		= $dbConn->f("f_07_amt");
	$data["f_07_paydate"][]	= $dbConn->f("f_07_paydate");
	$data["f_06_sts"][]		= $dbConn->f("f_06_sts");
	$data["f_06_amt"][]		= $dbConn->f("f_06_amt");
	$data["f_06_paydate"][]	= $dbConn->f("f_06_paydate");
	$data["f_05_sts"][]		= $dbConn->f("f_05_sts");
	$data["f_05_amt"][]		= $dbConn->f("f_05_amt");
	$data["f_05_paydate"][]	= $dbConn->f("f_05_paydate");
	$data["f_04_sts"][]		= $dbConn->f("f_04_sts");
	$data["f_04_amt"][]		= $dbConn->f("f_04_amt");
	$data["f_04_paydate"][]	= $dbConn->f("f_04_paydate");
	$data["f_03_sts"][]		= $dbConn->f("f_03_sts");
	$data["f_03_amt"][]		= $dbConn->f("f_03_amt");
	$data["f_03_paydate"][]	= $dbConn->f("f_03_paydate");
	$data["f_02_sts"][]		= $dbConn->f("f_02_sts");
	$data["f_02_amt"][]		= $dbConn->f("f_02_amt");
	$data["f_02_paydate"][]	= $dbConn->f("f_02_paydate");
	$data["f_01_sts"][]		= $dbConn->f("f_01_sts");
	$data["f_01_amt"][]		= $dbConn->f("f_01_amt");
	$data["f_01_paydate"][]	= $dbConn->f("f_01_paydate");
}
$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $paperWSize = 400;
	var $paperHSize = 215;
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
		$this->startX = $this->paperWSize-140;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user,$params) {
		$this->AliasNbPages();
		$this->AddPage("L");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "T", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "TR", 0, 'L');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "LAPORAN POSISI WP BELUM BAYAR", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "Periode Belum Bayar : " . str_replace("'","",$params['start_piutang']).' s/d '.str_replace("'","",$params['end_piutang']), "R", 0, 'C');		
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "Posisi Laporan Tanggal : ".str_replace("'","",$params['tgl_status']), "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		$this->Ln();
		
		$ltable = $this->lengthCell / 46;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable9 = $ltable * 9;
		$ltable36 = $ltable * 36;

		$this->SetFont('Arial', '', 6);
		
		$this->Cell($ltable2, $this->height + 5, "NO.", "TLR", 0, 'C');
		$this->Cell($ltable4, $this->height, "NAMA", "TLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 5, "ALAMAT", "TLR", 0, 'C');
		$this->Cell($ltable36, $this->height, "REALISASI DAN TANGGAL BAYAR", "TBLR", 0, 'C');
		$this->Ln();
		
		$this->Cell($ltable2, $this->height, "", "LR", 0, 'C');
		$this->Cell($ltable4, $this->height, "PERUSAHAAN", "LR", 0, 'C');
		$this->Cell($ltable4, $this->height, "", "LR", 0, 'C');
		$this->Cell($ltable3, $this->height, "DESEMBER", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "JANUARI", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "FEBRUARI", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "MARET", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "APRIL", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "MEI", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "JUNI", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "JULI", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "AGUSTUS", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SEPTEMBER", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "OKTOBER", "TLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "NOVEMBER", "TLR", 0, 'C');
		$this->Ln();
		
		$this->Cell($ltable2, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable4, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable4, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, $data["tahun"][0] - 1, "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "", "BLR", 0, 'C');
		$this->Ln();
		
		//isi kolom
		$no = 1;
		for ($i = 0; $i < count($data["nama"]); $i++) {
			$this->SetWidths(array($ltable2, $ltable4, $ltable4, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3));
			$this->SetAligns(array("C", "L", "L", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
			
			// print data piutang
			$data2 = array();
			for($j = 1; $j <= 12; $j++){
				$sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
				$amt = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_amt";
				
				if(is_null($data[$sts][$i])){
					$data2[$j] = number_format($data[$amt][$i], 0, ',', '.');
				}
				else{
					$data2[$j] = $data[$sts][$i];
				}
			}
			
			$this->RowMultiBorderWithHeight(
				array(
					$no,
					$data["nama"][$i],
					$data["alamat"][$i],
					$data2[12],
					$data2[1],
					$data2[2],
					$data2[3],
					$data2[4],
					$data2[5],
					$data2[6],
					$data2[7],
					$data2[8],
					$data2[9],
					$data2[10],
					$data2[11]
				),
				array(
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR",
					"TLR"
				),
				$this->height
			);
			
			// print data tanggal bayar
			$data2 = array();
			for($j = 1; $j <= 12; $j++){
				$sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
				$paydate = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_paydate";
				
				if(is_null($data[$sts][$i])){
					$data2[$j] = $data[$paydate][$i];
				}
				else{
					$data2[$j] = $data[$sts][$i];
				}
			}
			
			$this->RowMultiBorderWithHeight(
				array(
					"",
					"",
					$data["npwpd"][$i],
					$data2[12],
					$data2[1],
					$data2[2],
					$data2[3],
					$data2[4],
					$data2[5],
					$data2[6],
					$data2[7],
					$data2[8],
					$data2[9],
					$data2[10],
					$data2[11]
				),
				array(
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR",
					"BLR"
				),
				$this->height
			);
			
			$no++;
		}
		$this->Ln();
		$this->newLine();
		$this->newLine();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$nama_pajak = strtoupper(substr($data["jenis_pajak"][0], 5));
		$this->Cell($lbody1 + 10, $this->height, "KOORDINATOR " . $nama_pajak, "", 0, 'C');
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "NIP. ", "", 0, 'L');
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
	    // $this->Ln($h);
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
$formulir->PageCetak($data, $user,$params);
$formulir->Output();

?>

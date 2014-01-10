<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_lap_harian_bdhr.php");
include_once(RelativePath . "/Common.php");
//include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");//'15-12-2013';
// $tgl_penerimaan		= '15-12-2013';

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select * from f_rep_lap_harian_bdhr($tgl_penerimaan) order by nomor_ayat";
$tgl_penerimaan		= str_replace("'", "", $tgl_penerimaan);
$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["nomor_ayat"][]		= $dbConn->f("nomor_ayat");
	$data["nama_ayat"][]		= $dbConn->f("nama_ayat");
	$data["nama_jns_pajak"][]	= $dbConn->f("nama_jns_pajak");
	$data["kode_jns_pajak"][]	= $dbConn->f("kode_jns_pajak");
	$data["jns_pajak"][]		= $dbConn->f("jns_pajak");
	$data["type_ayat"][]		= $dbConn->f("type_ayat");
	$data["p_vat_type_id"][]	= $dbConn->f("p_vat_type_id");
	$data["p_vat_type_dtl_id"][]= $dbConn->f("p_vat_type_dtl_id");
	$data["bulan"][]			= $dbConn->f("bulan");
	$data["tahun"][]			= $dbConn->f("tahun");
	$data["jml_hari_ini"][]		= $dbConn->f("jml_hari_ini");
	$data["jml_sd_hari_lalu"][]	= $dbConn->f("jml_sd_hari_lalu");
	$data["jml_sd_hari_ini"][]	= $dbConn->f("jml_sd_hari_ini");
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $paperWSize = 330;
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
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user, $tgl_penerimaan) {
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
		$this->Cell($lheader4, $this->height, "LAMPIRAN LAPORAN HARIAN", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "BENDAHARA PENERIMAAN", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		
		$tahun = date("Y", strtotime($tgl_penerimaan));
		$this->Cell($lheader4, $this->height, "Tahun Anggaran " . $tahun, "R", 0, 'C');		
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "Tanggal Penerimaan " . $tgl_penerimaan, "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		$this->Ln();
		
		$ltable = $this->lengthCell / 20;
		$ltable1 = $ltable * 1;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 2.6;
		$ltable16 = $ltable * 16;
		
		$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "AYAT", "TBLR", 0, 'C');
		$this->Cell($ltable4*2.2+4, $this->height + 2, "PAJAK/RETRIBUSI", "TBLR", 0, 'C');
		$this->Cell($ltable4*1.1, $this->height + 2, "JUMLAH HARI INI", "TBLR", 0, 'C');
		$this->Cell($ltable*4.04, $this->height + 2, "JUMLAH S/D HARI YANG LALU", "TBLR", 0, 'C');
		$this->Cell($ltable4*1.3-4, $this->height + 2, "JUMLAH S/D HARI INI", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom
		$this->SetWidths(array($ltable1, $ltable3, $ltable4*2.2+4, $ltable4*1.1, $ltable*4.04, $ltable4*1.3-4));
		$this->SetAligns(array("C", "L", "L", "R", "R", "R"));
		$no = 1;
		
		$jumlahperjenis = array();
		$jumlahtotal = 0;
		$jumlahtemp = 0;
		$jumlahperjenis_harilalu = array();
		$jumlahtotal_harilalu = 0;
		$jumlahtemp_harilalu = 0;
		$jumlahperjenis_hariini = array();
		$jumlahtotal_hariini = 0;
		$jumlahtemp_hariini = 0;
		
		for ($i = 0; $i < count($data['nomor_ayat']); $i++) {
			//print data
			$this->RowMultiBorderWithHeight(array($no,
												  $data["nomor_ayat"][$i] . " " . $data["kode_jns_trans"][$i],
												  "P. " . strtoupper($data["nama_ayat"][$i]),
												  number_format($data["jml_hari_ini"][$i], 0, ',', '.'),
												  number_format($data["jml_sd_hari_lalu"][$i], 0, ',', '.'),
												  number_format($data["jml_sd_hari_ini"][$i], 0, ',', '.')
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR'
												  )
												  ,$this->height);
			$no++;

			//hitung jml_hari_ini sampai baris ini
			$jumlahtemp += $data["jml_hari_ini"][$i];
			$jumlahtotal += $data["jml_hari_ini"][$i];
			$jumlahtemp_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtotal_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtemp_hariini += $data["jml_sd_hari_ini"][$i];
			$jumlahtotal_hariini += $data["jml_sd_hari_ini"][$i];
			
			//cek apakah perlu bikin baris jumlah
			//jika iya, simpan jumlahtemp ke jumlahperjenis, print jumlahtemp, reset jumlahtemp
			$jenis = $data["nama_jns_pajak"][$i];
			$jenissesudah = $data["nama_jns_pajak"][$i + 1];
			$this->SetFont('Arial', 'B', 10);
			if($jenis != $jenissesudah){
				$jumlahperjenis[] = $jumlahtemp;
				$jumlahperjenis_harilalu[] = $jumlahtemp_harilalu;
				$jumlahperjenis_hariini[] = $jumlahtemp_hariini;
				$this->Cell($ltable1 + $ltable3 + $ltable4*2.2+4, $this->height + 2, "JUMLAH " . strtoupper($data["nama_jns_pajak"][$i]), "TBLR", 0, 'C');
				$this->Cell($ltable4*1.1, $this->height + 2, number_format($jumlahtemp, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable*4.04, $this->height + 2, number_format($jumlahtemp_harilalu, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable4*1.3-4, $this->height + 2, number_format($jumlahtemp_hariini, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Ln();
				$jumlahtemp = 0;
				$jumlahtemp_harilalu = 0;
				$jumlahtemp_hariini = 0;
			}
			
			if($i == count($data['nomor_ayat']) - 1){
				$this->Cell($ltable1 + $ltable3 + $ltable4*2.2+4, $this->height + 2, "JUMLAH TOTAL", "TBLR", 0, 'C');
				$this->Cell($ltable4*1.1, $this->height + 2, number_format($jumlahtotal, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable*4.04, $this->height + 2, number_format($jumlahtotal_harilalu, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable4*1.3-4, $this->height + 2, number_format($jumlahtotal_hariini, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Ln();
				$jumlahtotal = 0;
				$jumlahtotal_harilalu = 0;
				$jumlahtotal_hariini = 0;
			}
			$this->SetFont('Arial', '', 10);
		}

		$this->Ln();
		$this->newLine();
		$this->newLine();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "BENDAHARA PENERIMAAN, ", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		//$this->Cell($lbody1 + 10, $this->height, "KOTA BANDUNG", "", 0, 'C');
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "(                ABDURACHIM                )", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "NIP. 19590622 198503 1 003", "", 0, 'C');
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
$formulir->PageCetak($data, $user, $tgl_penerimaan);
$formulir->Output();

?>

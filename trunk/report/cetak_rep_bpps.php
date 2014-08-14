<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_bpps.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
$p_year_period_id	= CCGetFromGet("p_year_period_id", "");
$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");
$i_flag_setoran		= CCGetFromGet("i_flag_setoran", "");

// $p_vat_type_id		= 1;
// $p_year_period_id	= 4;
// $tgl_penerimaan		= '15-12-2013';


$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select * from f_rep_bpps_mod_1($p_vat_type_id, $p_year_period_id, $tgl_penerimaan,$i_flag_setoran) order by kode_jns_trans, kode_jns_pajak, kode_ayat";
$dbConn->query($query);

$tgl_penerimaan2 = $tgl_penerimaan;
$tgl_penerimaan = str_replace("'", "", $tgl_penerimaan);
$tahun = date("Y", strtotime($tgl_penerimaan));
while ($dbConn->next_record()) {
	$data[]= array(
	"kode_jns_trans"	=> $dbConn->f("kode_jns_trans"),
	"jns_trans"		=> $dbConn->f("jns_trans"),
	"kode_jns_pajak"	=> $dbConn->f("kode_jns_pajak"),
	"kode_ayat"		=> $dbConn->f("kode_ayat"),
	"jns_pajak"		=> $dbConn->f("jns_pajak"),
	"jns_ayat"			=> $dbConn->f("jns_ayat"),
	"nama_ayat"		=> $dbConn->f("nama_ayat"),
	"no_kohir"		=> $dbConn->f("no_kohir"),
	"wp_name"			=> $dbConn->f("wp_name"),
	"wp_address_name"	=> $dbConn->f("wp_address_name"),
	"wp_address_no"		=> $dbConn->f("wp_address_no"),
	"npwpd"			=> $dbConn->f("npwpd"),
	"jumlah_terima"	=> $dbConn->f("jumlah_terima"),
	"masa_pajak"		=> $dbConn->f("masa_pajak"),
	"kd_tap"			=> $dbConn->f("kd_tap"),
	"keterangan"		=> $dbConn->f("keterangan"),
	"payment_date"		=> $dbConn->f("payment_date"),
	"jam"		=> $dbConn->f("jam"));
}


if ($p_vat_type_id != 7){
	$query				= "select * from f_rep_bpps_mod_1(7, $p_year_period_id, $tgl_penerimaan2,$i_flag_setoran) order by kode_jns_trans, kode_jns_pajak, kode_ayat";
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[]= array(
		"kode_jns_trans"	=> $dbConn->f("kode_jns_trans"),
		"jns_trans"		=> $dbConn->f("jns_trans"),
		"kode_jns_pajak"	=> $dbConn->f("kode_jns_pajak"),
		"kode_ayat"		=> $dbConn->f("kode_ayat"),
		"jns_pajak"		=> $dbConn->f("jns_pajak"),
		"jns_ayat"			=> $dbConn->f("jns_ayat"),
		"nama_ayat"		=> $dbConn->f("nama_ayat"),
		"no_kohir"		=> $dbConn->f("no_kohir"),
		"wp_name"			=> $dbConn->f("wp_name"),
		"wp_address_name"	=> $dbConn->f("wp_address_name"),
		"wp_address_no"		=> $dbConn->f("wp_address_no"),
		"npwpd"			=> $dbConn->f("npwpd"),
		"jumlah_terima"	=> $dbConn->f("jumlah_terima"),
		"masa_pajak"		=> $dbConn->f("masa_pajak"),
		"kd_tap"			=> $dbConn->f("kd_tap"),
		"keterangan"		=> $dbConn->f("keterangan"),
		"payment_date"		=> $dbConn->f("payment_date"),
		"jam"		=> $dbConn->f("jam"));
	}
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
	
	function PageCetak($data, $user, $tahun, $tgl_penerimaan) {
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
		$this->Cell($lheader4, $this->height, "BPPS", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "(BUKU PEMBANTU PENERIMAAN SEJENIS)", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "Tahun " . $tahun, "R", 0, 'C');		
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
		
		$ltable = $this->lengthCell / 26;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable22 = $ltable * 22;
		
		
		
		$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
		$no_kohir_text = 'NO. KOHIR';
		$npwpd_text = 'NPWPD';

		if($p_vat_type_id == 6) { //BPHTB
			$no_kohir_text = 'NO. REG';
			$npwpd_text = 'NOP';
		}
		

		$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable2, $this->height + 2, "NO. AYAT", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NAMA AYAT", "TBLR", 0, 'C');
		$this->Cell($ltable2, $this->height + 2, $no_kohir_text, "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, $npwpd_text, "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "JUMLAH", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "MASA PAJAK", "TBLR", 0, 'C');
		$this->Cell($ltable2, $this->height + 2, "TGL TAP", "TBLR", 0, 'C');
		$this->Cell($ltable2, $this->height + 2, "KET.", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom
		$this->SetWidths(array($ltable1, $ltable2, $ltable3, $ltable2, $ltable5, $ltable3, $ltable3, $ltable3, $ltable2, $ltable2));
		$this->SetAligns(array("C", "L", "L", "L", "L", "L", "R", "L", "L", "L"));
		$no = 1;
		$jumlahperayat = array();
		$jumlahperwaktu = array();
		$jumlahtemp = 0;
		$i=0;
		$total=0;
		foreach($data as $item) {
			//print data
			$this->RowMultiBorderWithHeight(array($no,
												  $item["kode_jns_pajak"]." ".$item["kode_ayat"],
												  $item["nama_ayat"],
												  $item["no_kohir"],
												  $item["wp_name"],
												  $item["npwpd"],
												  number_format($item["jumlah_terima"], 0, ',', '.'),
												  $item["masa_pajak"],
												  $item["kd_tap"],
												  $item["keterangan"]
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;

			//hitung jumlahperayat sampai baris ini
			$jumlahtemp += $item["jumlah_terima"];
			$total+= $item["jumlah_terima"];
			//cek apakah perlu bikin baris jumlah
			//jika iya, simpan jumlahtemp ke jumlahperayat, print jumlahtemp, reset jumlahtemp
			$ayat = $item["kode_ayat"];
			$ayatsesudah = $data[$i+1]["kode_ayat"];
			if(($ayat != $ayatsesudah&&count($data)>1)||empty($data[$i+1])){
				$jumlahperayat[] = $jumlahtemp;
				$this->Cell($ltable22, $this->height + 2, "JUMLAH " . strtoupper($item["jns_pajak"]), "TBLR", 0, 'C');
				$this->Cell($ltable4, $this->height + 2, number_format($jumlahtemp, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Ln();
				$jumlahtemp = 0;
				
			}
			//cek apakah sudah pindah waktu (pagi ke titipan)
			//jika ya, totalkan jumlahperayat jadi tempperayat, copy ke jumlahperwaktu, print tempperayat, reset jumlahperayat
			/*$waktuayat = $item["jns_trans"];
			$waktuayatsesudah = $data[$i+1]["jns_trans"];
			if($waktuayat != $waktuayatsesudah&&count($data)>1){
				$tempperayat = 0;
				for($j = 0; $j < count($jumlahperayat); $j++){
					$tempperayat += $jumlahperayat[$j];
				}

				$jumlahperwaktu[] = $tempperayat;
				$this->Cell($ltable22, $this->height + 2, "JUMLAH " . $item["jns_trans"], "TBLR", 0, 'C');
				$this->Cell($ltable4, $this->height + 2, number_format($tempperayat, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Ln();
				$jumlahperayat = array();
			}*/
			$i++;
		}
		$this->Cell($ltable22, $this->height + 2, "TOTAL " . strtoupper($item["jns_pajak"]), "TBLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, number_format($total, 0, ',', '.'), "TBLR", 0, 'R');

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
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "(                ABDURACHIM                )", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "NIP. 19590622 198503 1 008", "", 0, 'C');
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
$formulir->PageCetak($data, $user, $tahun, $tgl_penerimaan);
$formulir->Output();
?>

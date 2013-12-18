<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_lap_spjp.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

// $p_finance_period_id= CCGetFromGet("p_finance_period_id", "");
// $p_year_period_id	= CCGetFromGet("p_year_period_id", "");
// $jenis_laporan		= CCGetFromGet("jenis_laporan", "");//administratif atau fungsional

$p_finance_period_id= 12;
$p_year_period_id	= 4;
$jenis_laporan		= "administratif";

$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select * from f_rep_lap_spjp($p_finance_period_id, $p_year_period_id) order by nomor_ayat";
// die($query);
$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["nomor_ayat"][]			= $dbConn->f("nomor_ayat");
	$data["nama_ayat"][]			= $dbConn->f("nama_ayat");
	$data["nama_jns_pajak"][]		= $dbConn->f("nama_jns_pajak");
	$data["kode_jns_pjk"][]			= $dbConn->f("kode_jns_pjk");
	$data["jns_pajak"][]			= $dbConn->f("jns_pajak");
	$data["type_ayat"][]			= $dbConn->f("type_ayat");
	$data["p_vat_type_id"][]		= $dbConn->f("p_vat_type_id");
	$data["p_vat_type_dtl_id"][]	= $dbConn->f("p_vat_type_dtl_id");
	$data["bulan"][]				= $dbConn->f("bulan");
	$data["tahun"][]				= $dbConn->f("tahun");
	$data["jml_anggaran_bln_lalu"][]= $dbConn->f("jml_anggaran_bln_lalu");
	$data["terima_bln_lalu"][]		= $dbConn->f("terima_bln_lalu");
	$data["setor_bln_lalu"][]		= $dbConn->f("setor_bln_lalu");
	$data["sisa_bln_lalu"][]		= $dbConn->f("sisa_bln_lalu");
	$data["terima"][]				= $dbConn->f("terima");
	$data["setor"][]				= $dbConn->f("setor");
	$data["sisa"][]					= $dbConn->f("sisa");
	$data["terealisasi"][]			= $dbConn->f("terealisasi");
	$data["belum_disetor"][]		= $dbConn->f("belum_disetor");
	$data["belum_terealisasi"][]	= $dbConn->f("belum_terealisasi");
}

	$kpa = "Hendar Suhendar, SE";
	$bendahara = "Abdurachim";
/*
if ($data["no_urut"] != "") {
//barcode
	$bcr = "select f_gen_barcode('".$data["no_urut"]."')";
	$dbConn->query($bcr);
	while($dbConn->next_record()){
		$data["barcode"] = $dbConn->f("f_gen_barcode");
	}
}
//end barcode
*/
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
	
	function PageCetak($data, $jenis_laporan, $kpa, $bendahara) {
		$this->AliasNbPages();
		$this->AddPage("L");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;

		$this->newLine();
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		$this->Cell($lheader4, $this->height, "LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENERIMAAN SKPD", "", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lheader4, $this->height, "(SPJ PENDAPATAN - " . strtoupper($jenis_laporan) . ")", "", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "", 0, 'C');
		$this->Cell($lheader4, $this->height, "Tahun " . $data["tahun"][0], "", 0, 'C');		
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "", 0, 'C');
		$this->Cell($lheader4, $this->height, "", "", 0, 'C');
		$this->Ln();
		$this->newLine();
		
		$ltable = $this->lengthCell / 39;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable22 = $ltable * 22;

		$this->Cell($ltable3 * 3, $this->height, "Kuasa Pengguna Anggaran", "", 0, 'L');
		$this->Cell($ltable3 * 10, $this->height, ": " . $kpa, "", 0, 'L');
		$this->Ln();
		
		$this->Cell($ltable3 * 3, $this->height, "Bendahara Penerimaan", "", 0, 'L');
		$this->Cell($ltable3 * 10, $this->height, ": " . $bendahara, "", 0, 'L');
		$this->Ln();
		
		$this->Cell($ltable3 * 3, $this->height, "Bulan", "", 0, 'L');
		$this->Cell($ltable3 * 10, $this->height, ": " . $data["bulan"][0], "", 0, 'L');
		$this->Ln();
		$this->newLine();
		
		$this->Cell($ltable3, $this->height * 2, "REKENING", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height * 2, "URAIAN", "TBLR", 0, 'C');
		$this->Cell($ltable3 * 4, $this->height, "SAMPAI DENGAN BULAN LALU", "TBLR", 0, 'C');
		$this->Cell($ltable3 * 7, $this->height, "SAMPAI DENGAN BULAN INI", "TBLR", 0, 'C');
		$this->Ln();
		
		$this->Cell($ltable3, $this->height * 2, "", "", 0, 'C');
		$this->Cell($ltable3, $this->height * 2, "", "", 0, 'C');
		$this->Cell($ltable3, $this->height, "ANGGARAN", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "TERIMA", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SETOR", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SISA", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "TERIMA", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SETOR", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "SISA", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "REALISASI", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "DISETOR", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "B REALISASI", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "B DISETOR", "TBLR", 0, 'C');
		$this->Ln();

		$this->Cell($ltable3, $this->height, "1", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "2", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "3", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "4", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "5", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "6=(5-4)", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "7", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "8", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "9=(8-7)", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "10=(4+7)", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "11=(5+8)", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "12=(11-20)", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height, "13=(3-10)", "TBLR", 0, 'C');
		$this->Ln();
		
		$jumlahtemp = 0;
		// echo "<pre>";
		// var_dump($data);
		for ($i = 0; $i < count($data['nomor_ayat']); $i++) {
			$jenis_pajak = $data["kode_jns_pjk"][$i];
			$jenis_pajak_sebelum = $data["kode_jns_pjk"][$i - 1];
			if($jenis_pajak != $jenis_pajak_sebelum){
				$this->SetFont('Arial', 'B', 10);
				$this->Cell($ltable1, $this->height, substr($data["kode_jns_pjk"][$i], 0, 2), "TBLR", 0, 'C');
				$this->Cell($ltable1, $this->height, substr($data["kode_jns_pjk"][$i], 2, 2), "TBLR", 0, 'C');
				$this->Cell($ltable1, $this->height, "", "TBLR", 0, 'C');
				$this->Cell($ltable3, $this->height, $data["nama_jns_pajak"][$i], "TBLR", 0, 'C');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Cell($ltable3, $this->height, "-", "TBLR", 0, 'R');
				$this->Ln();
				$this->SetFont('Arial', '', 10);
			}
			
			$this->SetWidths(array($ltable1, $ltable1, $ltable1, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3, $ltable3));
			$this->SetAligns(array("L", "L", "L", "L", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R"));
			//print data
			$this->RowMultiBorderWithHeight(array(	"",
													"",
													$data["type_ayat"][$i],
													ucwords(strtolower($data["nama_ayat"][$i])),
													number_format($data["jml_anggaran_bln_lalu"][$i], 0, ',', '.'),
													number_format($data["terima_bln_lalu"][$i], 0, ',', '.'),
													number_format($data["setor_bln_lalu"][$i], 0, ',', '.'),
													number_format($data["sisa_bln_lalu"][$i], 0, ',', '.'),
													number_format($data["terima"][$i], 0, ',', '.'),
													number_format($data["setor"][$i], 0, ',', '.'),
													number_format($data["sisa"][$i], 0, ',', '.'),
													number_format($data["terealisasi"][$i], 0, ',', '.'),
													number_format($data["disetor"][$i], 0, ',', '.'),
													number_format($data["belum_terealisasi"][$i], 0, ',', '.'),
													number_format($data["belum_disetor"][$i], 0, ',', '.')
												  ),
											array(	'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR',
													'TBLR')
											,$this->height);
		}

		$this->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody3, $this->height, "", "", 0, 'L');
		$this->SetFont('Arial', 'B', 10);
		if($jenis_laporan == "administratif"){
			$this->Cell($lbody1, $this->height, strtoupper($bendahara), "", 0, 'C');
		}
		else{
			$this->Cell($lbody1, $this->height, strtoupper($kpa), "", 0, 'C');
		}
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lbody3, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "NIP. 19590622 198503 1 008", "T", 0, 'C');
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
$formulir->PageCetak($data, $jenis_laporan, $kpa, $bendahara);
$formulir->Output();

?>

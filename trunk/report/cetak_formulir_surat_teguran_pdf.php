<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");

//$t_customer_order_id = 67;
//$dataArr = array();
// $dataBaru = array();

if(empty($t_customer_order_id)){
	echo "data tidak ada";
	exit();
}else{
$dbConn = new clsDBConnSIKP();

$query="select * from f_debt_letter_print(".$t_customer_order_id.") AS tbl (ty_debt_letter_list)";

$dbConn->query($query);
$data=array();
while ($dbConn->next_record()) {
		$data[]= array(
			'npwd' => $dbConn->f("npwd"),
			'company_name' => $dbConn->f("company_name"),
			'address' => $dbConn->f("address"),
			'letter_no' => $dbConn->f("letter_no"),
			'vat_code' => $dbConn->f("vat_code"),
			'periode' => $dbConn->f("periode"),
			'tap_no' => $dbConn->f("tap_no"),
			'tap_date' => $dbConn->f("tap_date"),
			'due_date' => $dbConn->f("due_date"),
			'debt_amount' => $dbConn->f("debt_amount"),
			'terbilang' =>  $dbConn->f("terbilang")
		);
}

	//nip & nama
	$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin "
		  ."FROM p_global_param "
		  ."WHERE code = 'TTD KADIN'";
		  
	$dbConn->query($ttd);
	while($dbConn->next_record()){
		$data["nama_kadin"] = $dbConn->f("nama_kadin");
		$data["nip_kadin"] = $dbConn->f("nip_kadin");
	}
	
$dbConn->close();
}

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
		$this->AddFont('BKANT');
		
		$this->SetFont('BKANT', '', 12);
		
		$this->Image('../images/logo_pemda.png',25,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "TR", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BKANT', '', 12);
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BKANT', '', 16);
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BKANT', '', 12);
		$this->Cell($lheader1, $this->height + 3, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "BR", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		

		$this->SetWidths(array(20,2,$this->lengthCell-22));
		$this->SetAligns(array("L","L","L"));
		$posy = $this->getY();
		$this->RowMultiBorderWithHeight(
			array("Nomor",
				":",
				$data["letter_no"]
			),
			array("",
				"",
				""
			),
			3
		);
		$this->RowMultiBorderWithHeight(
			array("Perihal",
				":",
				"SURAT TEGURAN"
			),
			array("L",
				"",
				"R"
			),
			3
		);

		/*$this->Cell($lbody1, $this->height + 2, "NPWPD", "L", 0, 'C');
		$this->Cell($lbody1, $this->height + 2, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');
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
		$this->kotak(1, 34, 2,$arr1[10]);*/
		//$this->newLine();
		$this->setY($posy-3);
		$today = getdate();
		$lkepada = $this->lengthCell / 5;
		$lkepada2 = $lkepada * 2;
		$lkepada3 = $lkepada * 3;
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Bandung, ".dateToString($today['year']."-".$today['mon']."-".$today['mday']), "R", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Kepada Yth,", "R", 0, 'L');
		$this->Ln(10);

		
		$this->SetWidths(array($lkepada3,22,2,51.2));
		$this->RowMultiBorderWithHeight(
			array("",
				"Pimpinan",
				":",
				$data['company_name']
			),
			array("L",
				"",
				"",
				"R"
			),
			($this->height/2)-1
		);
		
		
		/*$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell(20, $this->height, "Pimpinan ", "", 0, 'L');
		$this->Cell(2, $this->height, ":", "", 0, 'L');
		$this->Cell($lkepada2-22, $this->height, $data['company_name'], "R", 0, 'L');
		$this->Ln();*/

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell(22, $this->height, "NPWPD ", "", 0, 'L');
		$this->Cell(2, $this->height, ":", "", 0, 'L');
		$this->Cell($lkepada2-24, $this->height, $data['npwd'], "R", 0, 'L');
		$this->Ln();

		/*$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height,$data['address'], "R", 0, 'L');
		$this->Ln();*/
		$this->SetWidths(array($lkepada3,$lkepada2));
		$this->SetAligns(array("L","L"));
		$this->RowMultiBorderWithHeight(
			array("",
				$data["address"]
			),
			array("L",
				"R"
			),
			3
		);
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Di ", "R", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Tempat", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BKANT', '', 12);
		$this->Cell($this->lengthCell, $this->height, "SURAT TEGURAN", "LR", 0, 'C');
		$this->newLine();
		
		$this->SetFont('BKANT', '', 12);
		/*$this->Cell($this->lengthCell, $this->height, "Nomor: ".$data["letter_no"], "LR", 0, 'C');
		$this->newLine();*/
		$this->SetWidths(array(10,173, 5));
		$this->RowMultiBorderWithHeight(array("",
				"Menurut pembukuan kami hingga saat ini Saudara masih mempunyai tunggakan Pajak sebagai berikut:",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);
		//$this->newLine();
		// Tabel
		$ltable = $this->lengthCell / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;
		
		$this->SetWidths(array(5, $ltable6-16, $ltable1+2, $ltable2+7, $ltable1 + $ltable2 - 10+7, $ltable2, 5));
		$this->SetAligns(array("L", "C", "C", "C", "C", "C", "L"));
		
		$this->RowMultiBorderWithHeight(
			array("",
				"Jenis Pajak",
				"Tahun",
				"Bulan",
				"SPTPD",
				"TGL.SETOR",
				""
			),
			array("LR",
				"TBLR",
				"TBLR",
				"TBLR",
				"TBLR",
				"TBLR",
				"LR"
			),
			$this->height
		);
		
		
		$this->SetWidths(array(5, $ltable6-16, $ltable1+2, $ltable2+7, $ltable1 + $ltable2 - 10+7, $ltable2, 5));
		$this->SetAligns(array("L", "C", "C", "C", "C", "C", "L"));
		$tahun = explode(" ",$data["periode"]);
		$bulan_periode = explode(",",$data["debt_periode_code"]);
		$bulan_string='';
		$i=0;
		foreach($bulan_periode as $item ){
			$bulan = explode(" ",$item);
			$bulan_string.= $bulan[0];
			$i++;
			if(!empty($bulan_periode[$i])){
				$bulan_string.='\n';
			}
		}
		$this->RowMultiBorderWithHeight(
			array("",
				$data["vat_code"],
				$tahun[1],
				$data["debt_periode_code"],
				$data["tap_no"],
				"-",
				""
			),
			array("LR",
				"TBLR",
				"TBLR",
				"TBLR",
				"TBLR",
				"TBLR",
				"LR"
			),
			$this->height
		);
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(20, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 20, $this->height, "Dengan huruf ".$data["terbilang"], "", 0, 'L');
		$this->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		/*$this->tulis("Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Peraturan Daerah Nomor 20", "L");
		$this->tulis("Tahun 2011, maka diminta kepada Saudara agar melunasi jumlah Tunggakan dalam waktu 7 (tujuh) hari", "L");
		$this->tulis("setelah Surat Teguran ini. Setelah batas waktu tersebut tindakan penagihan akan dilanjutkan dengan", "L");
		$this->tulis("penyerahan Surat Paksa.", "L");*/
		$this->SetAligns(array("L", "L", "L", "L", "L", "L", "L"));
		$this->SetWidths(array(10,173, 5));
		$this->RowMultiBorderWithHeight(array("",
				"Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Peraturan Daerah Nomor 20 ".
				"Tahun 2011, maka diminta kepada Saudara agar melunasi jumlah Tunggakan dalam waktu 7 (tujuh) hari ".
				"setelah Surat Teguran ini. Setelah batas waktu tersebut tindakan penagihan akan dilanjutkan dengan ".
				"penyerahan Surat Paksa",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
		$this->Ln();
		$this->SetWidths(array(10,173, 5));
		$this->RowMultiBorderWithHeight(array("",
				"Dalam hal Saudara telah melunasi Tunggakan tersebut di atas, diminta agar Saudara segera melaporkan kepada",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);
			
		//$this->tulis("Dalam hal Saudara telah melunasi Tunggakan tersebut di atas, diminta agar Saudara segera melaporkan", "L");
		//$this->tulis("kepada", "L");
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, ",", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "an. KEPALA DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4-6, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4+20, $this->height, "H.SONI BAKHTIYAR, S.SOS, M.SI ", "B", 0, 'C');
		$this->Cell($lbody2-14, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. 19750625 1994031 1 00 1", "", 0, 'L'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "BL", 0, 'L');
		$this->Cell($this->lengthCell - 10, $this->height, "*) Coret yang tidak perlu", "BR", 0, 'L');
	}

	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "R", 0, 'C');
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

$formulir = new FormCetak();
foreach($data as $item){
	$formulir->PageCetak($item);
}
$formulir->Output();

?>

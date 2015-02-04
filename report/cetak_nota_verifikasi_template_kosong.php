<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_bpps.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$t_bphtb_registration_id		= CCGetFromGet("t_bphtb_registration_id", "");

// $t_bphtb_registration_id		= 23;

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select a.*,
b.region_name as wp_region,
c.region_name as wp_region_kec,
d.region_name as wp_region_kel,
e.region_name as object_region,
f.region_name as object_region_kec,
g.region_name as object_region_kel,
h.description as doc_name

from t_bphtb_registration as a 
left join p_region as b
	on a.wp_p_region_id = b.p_region_id
left join p_region as c
	on a.wp_p_region_id_kec = c.p_region_id
left join p_region as d
	on a.wp_p_region_id_kel = d.p_region_id
left join p_region as e
	on a.object_p_region_id = e.p_region_id
left join p_region as f
	on a.object_p_region_id_kec = f.p_region_id
left join p_region as g
	on a.object_p_region_id_kel = g.p_region_id
left join p_bphtb_legal_doc_type as h
	on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
where a.t_bphtb_registration_id = $t_bphtb_registration_id";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["wp_name"]				= '';
	$data["npwp"]					= '';
	$data["wp_address_name"]		= '';
	$data["wp_rt"]					= '';
	$data["wp_rw"]					= '';
	$data["wp_region"]				= '';
	$data["wp_region_kec"]			= '';
	$data["wp_region_kel"]			= '';
	$data["njop_pbb"]				= '';
	$data["object_address_name"]	= '';
	$data["object_rt"]				= '';
	$data["object_rw"]				= '';
	$data["object_region"]			= '';
	$data["object_region_kec"]		= '';
	$data["object_region_kel"]		= '';
	$data["doc_name"]				= '';
	$data["land_area"]				= 0;
	$data["land_price_per_m"]		= 0;
	$data["land_total_price"]		= 0;
	$data["building_area"]			= 0;
	$data["building_price_per_m"]	= 0;
	$data["building_total_price"]	= 0;
	$data["market_price"]			= 0;
	$data["npop"]					= 0;
	$data["npop_tkp"]				= 0;
	$data["npop_kp"]				= 0;
	$data["bphtb_amt"]				= 0;
	$data["bphtb_discount"]			= 0;
	$data["bphtb_amt_final"]		= 0;
	$data["registration_no"]		= $dbConn->f("registration_no");
	$data["verificated_by"]			= '';
	$data["verificated_nip"]		= '';
	$data["jenis_harga_bphtb"]		= '';
	$data["description"]			= '';
	$data["is_ok"]			= '';
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	// var $paperWSize = 330;
	// var $paperHSize = 215;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P');
	}
	
	function __construct() {
	    $this->DefPageSize = $size;
		$this->CurPageSize = $size;
		$this->FormCetak();
		$size = $this->_getpagesize("Legal");
		//$this->DefPageSize = $size;
		//$this->CurPageSize = $size;
		$this->startY = 0;
		$this->startX = 0;
		$this->lengthCell = $size[0]-30;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$encImageData = '';
		$dbConn = new clsDBConnSIKP();
		$query = "select f_encrypt_str('".$data['registration_no']."') AS enc_data";

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$encImageData = $dbConn->f("enc_data");
		}
		$this->Image('../images/logo_pemda.png',20,10,25,25);
		$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		$this->SetFont("Arial", "B", 12);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "NOTA VERIFIKASI", "", 0, "C");
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN", "", 0, "C");
		$this->Ln();
		$this->newLine();
		$this->Cell($this->lengthCell, $this->height, "JENIS TRANSAKSI: -", "", 0, "C");
		$this->Ln();
		
		if(!empty($data['is_ok']) and $data['is_ok'] == 'Y') {
		    $this->Cell($this->lengthCell, $this->height, "NO REGISTRASI: -", "", 0, "C");
	    }else {
	        $this->Cell($this->lengthCell, $this->height, "NO REGISTRASI: -", "", 0, "C");
	    }
	    
		$this->newLine();
		$this->newLine();
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;

		$this->barisBaru("A", "1 Nama Wajib Pajak", ": " . $data["wp_name"]);
		$this->barisBaru("", "2 NPWP", ": " . $data["npwp"]);
		$this->barisBaru("", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
		$this->barisBaru("", "4 RT/RW", ": " . $data["wp_rt"] . "/" .  $data["wp_rw"]);
		$this->barisBaru("", "5 Kelurahan/Desa", ": " . $data["wp_region_kel"]);
		$this->barisBaru("", "6 Kecamatan", ": " . $data["wp_region_kec"]);
		$this->barisBaru("", "7 Kabupaten/Kota", ": " . $data["wp_region"]);
		$this->Ln();
		
		$this->barisBaru("B", "1 Nomor Objek Pajak PBB ", ": " . $data["njop_pbb"]);
		$this->barisBaru("", "2 Letak tanah atau bangunan", ": " . $data["object_address_name"]);
		$this->barisBaru("", "3 RT/RW", ": " . $data["object_rt"] . "/" . $data["object_rw"]);
		$this->barisBaru("", "4 Kelurahan/Desa", ": " . $data["object_region_kel"]);
		$this->barisBaru("", "5 Kecamatan", ": " . $data["object_region_kec"]);
		$this->barisBaru("", "6 Kabupaten/Kota", ": " . $data["object_region"]);
		$this->barisBaru("", "7 Dokumen Pendukung", ": " . $data["doc_name"]);
		$this->Ln();
		
		$this->barisBaru("C", "Penghitungan NJOP PBB", "");
		$lbodyx = ($this->lengthCell - $lbody1) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->SetWidths(array($lbodyx1, $lbodyx2, $lbodyx3, $lbodyx3));
		$this->SetAligns(array("C", "C", "C", "C"));
		$this->RowMultiBorderWithHeight(
			array
			(
				"\nUraian",
				"Luas\n(Diisi luas tanah dan atau bangunan yang haknya diperoleh)",
				"NJOP PBB / m2\n(Diisi berdasarkan SPPT PBB tahun terjadinya perolehan hak / Tahun",
				"\nLuas x NJOP PBB / m2"
			),
			array
			(
				"TBL",
				"TBR",
				"TBLR",
				"TBLR"
			),
			$this->height);
		
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbodyx1, $this->height, "Tanah (bumi)", "L", 0, "");
		$this->Cell($lbodyx1, $this->height, number_format($data["land_area"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "m2", "R", 0, "L");
		$this->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, number_format($data["land_price_per_m"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$this->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, number_format($data["land_total_price"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbodyx1, $this->height, "Bangunan", "L", 0, "");
		$this->Cell($lbodyx1, $this->height, number_format($data["building_area"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "m2", "R", 0, "L");
		$this->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, number_format($data["building_price_per_m"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$this->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, number_format($data["building_total_price"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbodyx1, $this->height, "", "L", 0, "");
		$this->Cell($lbodyx1, $this->height, "", "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "R", 0, "L");
		$this->Cell($lbodyx1, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "", "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "NJOP PBB", "R", 0, "R");
		$this->Cell($lbodyx1, $this->height, "Rp", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, number_format($data["land_total_price"] + $data["building_total_price"], 0, ",", "."), "", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "R", 0, "");
		$this->Ln();
		$jenis_harga_bphtb = $data["jenis_harga_bphtb"];
		if(empty($jenis_harga_bphtb)) $jenis_harga_bphtb = 99;
		$jenis_harga = array(1 => 'Harga Transaksi',2 =>  'Harga Pasar',3 => 'Harga Lelang', 99 => 'Harga Pasar');

		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($lbodyx1, $this->height, "", "BL", 0, "");
		$this->Cell($lbodyx1, $this->height, "", "B", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "BR", 0, "L");
		$this->Cell($lbodyx1, $this->height, "", "B", 0, "L");
		$this->Cell($lbodyx1-20, $this->height, "", "B", 0, "R");
		$this->Cell($lbodyx1+20, $this->height, $jenis_harga[$jenis_harga_bphtb], "RB", 0, "R");
		$this->Cell($lbodyx1, $this->height, "Rp", "B", 0, "L");
		$this->Cell($lbodyx1, $this->height, number_format($data["market_price"], 0, ",", "."), "B", 0, "R");
		$this->Cell($lbodyx1, $this->height, "", "BR", 0, "");
		$this->Ln();
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($this->length - $lbody1, $this->height, "Jenis perolehan hak atas tanah dan atau bangunan", "", 0, "");
		$this->Ln();
		$this->Ln();
		
		$this->Cell($lbody1, $this->height, "", "", 0, "");
		$this->Cell($this->length - $lbody1, $this->height, "PENGHITUNGAN BPHTB", "", 0, "");
		$this->Ln();
		
		$this->barisBaru2($lbody1, "Nilai Perolehan Objek Pajak (NPOP)", "", "Rp", $data["npop"]);
		$this->barisBaru2($lbody1, "Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)", "", "Rp", $data["npop_tkp"]);
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1, "Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp","NIHIL");
		}else{
			$this->barisBaru2($lbody1, "Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp", $data["npop_kp"]);
		}
		
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", "NIHIL");
		}else{
			$this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", $data["bphtb_amt"]);
		}
		
		$this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan potongan", "", "Rp", $data["bphtb_discount"]);
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", "NIHIL");
		}else{
			$this->barisBaru2($lbody1, "Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"]);
		}
		
		
		$this->newLine();
				
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
			
		$this->SetFont("Arial", "i", 8);
		
		$this->Cell($lbody1 + 10 , $this->height, "            Keterangan: Nota ini bukan bukti pembayaran", "", 0, 'L');
		$this->Ln();
		//$this->Cell($lbody1 + 10, $this->height, "            Catatan: ".$data["description"], "", 0, 'L');
		$this->SetWidths(array(9, 150, $lbodyx2));
		$this->SetAligns(array("L", "L"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"Catatan : ".$data["description"]
			),
			array
			(
				"",
				""
			),
			$this->height-2);		

		$this->SetFont("Arial", "B", 10);
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 - 103, $this->height, "Bandung, ".date("d-m-Y"), "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody1 + 10, $this->height, "KOORDINATOR PEMERIKSA", "", 0, 'C');
		$this->Cell($lbody3 - $lbody1 - 20, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "PETUGAS PEMERIKSA", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody1 + 10, $this->height, "BPHTB", "", 0, 'C');
		$this->Cell($lbody3 - $lbody1 - 20, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 10, $this->height, "BPHTB", "", 0, 'C');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		
		$this->Ln();
		$this->newLine();
		$this->newLine();				
		//$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
		//$this->Cell($lbody1 + 10, $this->height, "(....................................)", "", 0, 'C');
		$this->Cell($lbody1 + 10, $this->height - 4, "()", "", 0, 'C');
		$this->Cell(202, $this->height - 4, "( ".$data['verificated_by']." )", "", 0, 'C');
		$this->newLine();
		$this->Cell($lbody1 + 10, $this->height - 4, "NIP : - ", "", 0, 'C');
		$this->Cell(202, $this->height - 4, "NIP : ".$data['verificated_nip']." ", "", 0, 'C');

			
	}
	
	function barisBaru2($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell($subtractor, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$this->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$this->Ln();
	}

	function barisBaruStr($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell($subtractor, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, " ", "", 0, "L");
		$this->Cell($lbodyx2, $this->height, $data, "", 0, "R");
		$this->Ln();
	}
	
	function barisBaru($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);
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
$formulir->PageCetak($data, $user);
$formulir->Output();

?>

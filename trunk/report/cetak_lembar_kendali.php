<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_bpps.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$t_bphtb_registration_id		= CCGetFromGet("t_bphtb_registration_id", "");
/*if(empty($t_bphtb_restitusi_id)){
	die("Proses membutuhkan restitusi id");
}*/
// $t_bphtb_registration_id		= 23;

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$sql				= "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,
to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,
j.nomor_berita_acara, j.nomor_notaris,
k.pemeriksa_nama as nama_pemeriksa, k.pemeriksa_nip as nip_pemeriksa, k.pemeriksa_jabatan as jabatan_pemeriksa,
l.pemeriksa_nama as nama_operator, l.pemeriksa_nip as nip_operator, l.pemeriksa_jabatan as jabatan_operator,
a.*,
cust_order.p_rqst_type_id,
b.region_name as wp_kota,
c.region_name as wp_kecamatan,
d.region_name as wp_kelurahan,
e.region_name as object_region,
f.region_name as object_kecamatan,
g.region_name as object_kelurahan,
h.description as doc_name

from t_bphtb_exemption as j
left join t_bphtb_registration as a  on j.t_bphtb_registration_id = a.t_bphtb_registration_id
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
left join t_customer_order as cust_order
	on cust_order.t_customer_order_id = a.t_customer_order_id
left join t_bphtb_exemption_pemeriksa as k
   on j.pemeriksa_id = k.t_bphtb_exemption_pemeriksa_id
left join t_bphtb_exemption_pemeriksa as l
	on j.administrator_id = l.t_bphtb_exemption_pemeriksa_id
where j.t_bphtb_registration_id = $t_bphtb_registration_id";

$dbConn->query($sql);

while($dbConn->next_record()){
	$data["wp_name"]				= $dbConn->f("wp_name");
	$data["npwp"]					= $dbConn->f("npwp");
	$data["wp_address_name"]		= $dbConn->f("wp_address_name");
	$data["wp_rt"]					= $dbConn->f("wp_rt");
	$data["wp_rw"]					= $dbConn->f("wp_rw");
	$data["wp_region"]				= $dbConn->f("wp_kota");
	$data["wp_region_kec"]			= $dbConn->f("wp_kecamatan");
	$data["wp_region_kel"]			= $dbConn->f("wp_kelurahan");
	$data["njop_pbb"]				= $dbConn->f("njop_pbb");
	$data["object_address_name"]	= $dbConn->f("object_address_name");
	$data["object_rt"]				= $dbConn->f("object_rt");
	$data["object_rw"]				= $dbConn->f("object_rw");
	$data["object_region"]			= $dbConn->f("object_region");
	$data["object_region_kec"]		= $dbConn->f("object_kecamatan");
	$data["object_region_kel"]		= $dbConn->f("object_kelurahan");
	$data["doc_name"]				= $dbConn->f("doc_name");
	$data["land_area"]				= $dbConn->f("land_area");
	$data["land_price_per_m"]		= $dbConn->f("land_price_per_m");
	$data["land_total_price"]		= $dbConn->f("land_total_price");
	$data["building_area"]			= $dbConn->f("building_area");
	$data["building_price_per_m"]	= $dbConn->f("building_price_per_m");
	$data["building_total_price"]	= $dbConn->f("building_total_price");
	$data["market_price"]			= $dbConn->f("market_price");
	$data["npop"]					= $dbConn->f("npop");
	$data["npop_tkp"]				= $dbConn->f("npop_tkp");
	$data["npop_kp"]				= $dbConn->f("npop_kp");
	$data["bphtb_amt"]				= $dbConn->f("bphtb_amt");
	$data["bphtb_discount"]			= $dbConn->f("bphtb_discount");
	$data["bphtb_amt_final"]		= $dbConn->f("bphtb_amt_final");
	$data["registration_no"]		= $dbConn->f("registration_no");
	$data["jenis_harga_bphtb"]		= $dbConn->f("jenis_harga_bphtb");
	$data["description"]			= $dbConn->f("description");
	$data["exemption_amount"]		= $dbConn->f("exemption_amount");
	$data["dasar_pengurang"]		= $dbConn->f("dasar_pengurang");
	$data["analisa_penguranan"]		= $dbConn->f("analisa_penguranan");
	$data["nama_pemeriksa"]		    = $dbConn->f("nama_pemeriksa");
	$data["jabatan_pemeriksa"]		= $dbConn->f("jabatan_pemeriksa");
	$data["nip_pemeriksa"]		    = $dbConn->f("nip_pemeriksa");
	$data["nama_operator"]		    = $dbConn->f("nama_operator");
	$data["jabatan_operator"]		= $dbConn->f("jabatan_operator");
	$data["nip_operator"]		    = $dbConn->f("nip_operator");
	$data["jenis_pensiunan"]		= $dbConn->f("jenis_pensiunan");
	$data["sk_bpn_no"]		        = $dbConn->f("sk_bpn_no");
	$data["tanggal_sk"]		        = $dbConn->f("tanggal_sk");
	$data["persen_pengurangan"]     = ceil($dbConn->f("bphtb_discount")/$dbConn->f("bphtb_amt") * 100);
	$data["jenis_perolehan_hak"]	= $dbConn->f("jenis_perolehan_hak");
	$data["pilihan_lembar_cetak"]	= $dbConn->f("pilihan_lembar_cetak");
	$data["opsi_a2"]	            = $dbConn->f("opsi_a2");
	$data["opsi_a2_keterangan"]	    = $dbConn->f("opsi_a2_keterangan");
	$data["opsi_b7"]	            = $dbConn->f("opsi_b7");
	$data["opsi_b7_keterangan"]	    = $dbConn->f("opsi_b7_keterangan");
	$data["keterangan_opsi_c"]	    = $dbConn->f("keterangan_opsi_c");
	$data["keterangan_opsi_c_gono_gini"]	    = $dbConn->f("keterangan_opsi_c_gono_gini");
	$data["nomor_berita_acara"]	    = $dbConn->f("nomor_berita_acara");
	$data["nomor_notaris"]	    = $dbConn->f("nomor_notaris");
	$data["tanggal_berita_acara"]	    = $dbConn->f("tanggal_berita_acara");
	
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

		//$this->Image('../images/logo_pemda.png',10,10,20,20);
		
		$this->SetFont("Arial", "B", 10);		
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;
		$lbody5 = $lbody * 5;
		$lbody10 = $lbody * 10;
		$lbody15 = $lbody * 15;
		
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody1,$lbody2+$lbody1,""));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"No. Register\n".
				"Tanggal Masuk",
				": ".$data['registration_no']."\n".
				": ".date("d-m-Y").""

			),
			array
			(
				"","",""
			),
			$this->height);
		
		$this->Ln();
		$this->SetFont("Arial", "BU", 14);
		$this->SetWidths(array(""));
		$this->SetAligns(array("C"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"LEMBAR KENDALI"
			),
			array
			(
				""
			),
			$this->height);
		$this->Ln();
		
		$this->SetFont("Arial", "B", 8);
		$this->SetWidths(array($lbody2,$lbody4*3,$lbody4+$lbody2));
		$this->SetAligns(array("C","C","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"No",
				"Uraian",
				"Ket."
			),
			array
			(
				"BLTR","BLTR","BLTR"
			),
			$this->height);
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody1,$lbody1,$lbody4,$lbody4*2,$lbody4+$lbody2));
		$this->SetAligns(array("L","L","L","L","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"A.\n".
				"\n".
				"\n".
				"\n".
				"\n".
				""
				,
				"\n".
				"1.\n".
				"2.\n".
				"3.\n".
				"4.\n".
				"5."
				,
				"\n".
				"Nama Wajib Pajak\n".
				"NPWP\n".
				"Alamat Wajib Pajak/Telp.\n".
				"Kelurahan\n".
				"Kecamatan"
				,
				"\n".
				": ".$data['wp_name']."\n".
				": ".$data["npwp"]."\n".
				": ".$data["wp_address_name"].". RT ".$data['wp_rt']."/RW ".$data['wp_rw']."\n".
				": ".$data['wp_region_kel']."\n".
				": ".$data['wp_region_kec']."\n"
				,
				"\n".
				"\n".
				"\n".
				"\n".
				"\n".
				""
			),
			array
			(
				"BL","BR","BL","BR","BLR"
			),
			$this->height);
			
		$this->SetWidths(array($lbody1,$lbody1,$lbody5,$lbody4*2-$lbody1,$lbody4+$lbody2));
		$this->SetAligns(array("L","L","L","L","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"B.\n".
				"\n".
				"\n".
				"\n".
				"\n".
				""
				,
				"\n".
				"1.\n".
				"2.\n".
				"3.\n".
				"\n".
				"4.\n".
				"5.\n".
				"6.\n".
				"7."
				,
				"\n".
				"Nomor Objek Pajak (NOP) PBB\n".
				"Letak tanah dan/atau bangunan\n".
				"Kelurahan\n".
				"\n".
				"Kecamatan\n".
				"NJOP PBB\n".
				"Harga Transaksi\n".
				"Jumlah yang disetor\n"
				,
				"\n".
				": ".$data["njop_pbb"]."\n".
				": ".$data["object_address_name"]."\n".
				": ".$data["object_region_kel"]."\n".
				"  RT/RW ".trim($data["object_rt"])."/".trim($data["object_rw"])."\n".
				": ".$data["object_region_kec"]."\n".
				": Rp. ".$data["bphtb_amt_final"]."\n".
				": Rp. ".$data["npop"]."\n".
				": Rp. ".$data["bphtb_amt_final"]."\n"
				,
				"\n".
				"\n".
				"\n".
				"\n".
				"\n".
				"\n".
				"\n".
				"\n".
				""
			),
			array
			(
				"BL","BR","BL","BR","BLR"
			),
			$this->height);
			
		$this->SetWidths(array($lbody2,$lbody4*3,$lbody2,$lbody2,$lbody2));
		$this->SetAligns(array("L","C","C","C","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"C.",
				"Telah Diperiksa / Diteliti",
				"Tgl","Waktu","TTD"
			),
			array
			(
				"BLR","BLR","BLR","BLR","BLR"
			),
			$this->height);
		
		$this->SetWidths(array($lbody1,$lbody1,$lbody4+$lbody2,$lbody4*2-$lbody2,$lbody2,$lbody2,$lbody2));
		$this->SetAligns(array("L","L","L","L","C","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"1.",
				"Nama Petugas Loket",
				": ..........................................................",
				"","",""
			),
			array
			(
				"BL","BR","BL","BR","BLR","BLR","BLR"
			),
			$this->height);
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"2.",
				"Nama Petugas Operator Komputer",
				": ..........................................................",
				"","",""
			),
			array
			(
				"BL","BR","BL","BR","BLR","BLR","BLR"
			),
			$this->height);
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"3.",
				"Nama Petugas Pemeriksa Dokumen",
				": ..........................................................",
				"","",""
			),
			array
			(
				"BL","BR","BL","BR","BLR","BLR","BLR"
			),
			$this->height);
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"4.",
				"Penanggung Jawab Pemeriksa Berkas",
				": ..........................................................",
				"","",""
			),
			array
			(
				"BL","BR","BL","BR","BLR","BLR","BLR"
			),
			$this->height);
		$this->Ln();
		
		$this->Ln();
		$this->SetWidths(array($this->lengthCell/2-6,12,$this->lengthCell/2-6));
		$this->SetAligns(array("R","C","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"------------------------------------------------------------------------------------------",
				"disobek",
				"------------------------------------------------------------------------------------------",
			),
			array
			(
				"","",""
			),
			$this->height);
		$this->Ln();
		
		$this->Ln();
		$this->SetWidths(array($lbody1,$lbody2+$lbody1,""));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"No. Register\n".
				"Tanggal Masuk",
				": ".$data['registration_no']."\n".
				": ".date("d-m-Y").""

			),
			array
			(
				"","",""
			),
			$this->height);
		
		$this->Ln();
		
		$this->SetWidths(array($lbody1,$lbody4+$lbody1,""));
		$this->SetAligns(array("L","L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"1. Nama WP\n".
				"2. NPWP\n".
				"3. Alamat WP\n".
				"4. NOP PBB\n".
				"5. Letak tanah dan bangunan\n".
				"6. NJOP PBB\n".
				"7. Jumlah yang disetor\n"
				,
				": ".$data['wp_name']."\n".
				": ".$data['npwp']."\n".
				": ".$data["wp_address_name"].". RT ".$data['wp_rt']."/RW ".$data['wp_rw']."\n".
				": ".$data["njop_pbb"]."\n".
				": ".$data["object_address_name"]."\n".
				": ".$data["bphtb_amt_final"]."\n".
				": Rp. ".$data["bphtb_amt_final"]

			),
			array
			(
				"","",""
			),
			$this->height);
		
		$this->Ln();
		$this->Ln();
		
		$this->Ln();
		$this->SetWidths(array($lbody10,$lbody10));
		$this->SetAligns(array("L","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Petugas Pemeriksa\n".
				"\n".
				"\n".
				"\n".
				"(".$data['nama_operator'].")"
			),
			array
			(
				"",""
			),
			$this->height);
	}
	
	function barisBaru3($subtractor, $field, $middle, $currency, $data){
		$lbodyx = ($this->lengthCell - $subtractor) / 9;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell($subtractor, $this->height, "", "", 0, "L");
		$this->Cell($lbodyx3 + $lbodyx2, $this->height, "$field", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$middle", "", 0, "L");
		$this->Cell($lbodyx1, $this->height, "$currency", "", 0, "L");
		$this->SetFont("Arial", "B", 8);
		$this->Cell($lbodyx2, $this->height, number_format($data, 0, ",", "."), "", 0, "R");
		$this->SetFont("Arial", "", 8);
		$this->Ln();
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
		$this->Cell($lbody4+10, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15-10));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}

	function barisBaru_special($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1, $this->height, "$section", "", 0, "L");
		//$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		$this->SetWidths(array($lbody4+10,$lbody15-10));
		$this->SetAligns(array("J","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	"$field",$data
			),
			array
			(
				"",""
			),
			$this->height);
		
		/*$this->SetWidths(array($lbody15));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);*/
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

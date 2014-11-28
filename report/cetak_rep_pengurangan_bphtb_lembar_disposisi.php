<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_pengurangan_bphtb_lembar_disposisi.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$t_bphtb_registration_id		= CCGetFromGet("t_bphtb_registration_id", "");

//$t_bphtb_registration_id		= 24804;

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,
to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,
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

$dbConn->query($query);
while ($dbConn->next_record()) {
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
		/*$query = "select f_encrypt_str('".$data['registration_no']."') AS enc_data";

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$encImageData = $dbConn->f("enc_data");
		}*/
		//$this->Image('../images/logo_pemda.png',20,10,25,25);
		//$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		$this->SetFont("Arial", "B", 12);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "LEMBAR DISPOSISI", "", 0, "C");
		$this->Ln();
		//$this->SetFont("Arial", "B", 13);
		$this->Cell($this->lengthCell, $this->height, "PERSETUJUAN", "", 0, "C");
		$this->Ln();
		//$this->SetFont("Arial", "B", 14);
		$this->Cell($this->lengthCell, $this->height, "KERINGANAN BPHTB", "", 0, "C");
		$this->Ln();
		//$this->newLine();
		//$this->Cell($this->lengthCell, $this->height, "JENIS TRANSAKSI: ".strtoupper($data['doc_name']), "", 0, "C");
		//$this->Ln();
		//$this->Cell($this->lengthCell, $this->height, "NO REGISTRASI: ".strtoupper($data['registration_no']), "", 0, "C");
		
		$this->newLine();
		
		$this->SetFont("Arial", "B", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;

		$this->SetAligns(array("L", "L"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"I",
				"PEMOHON :"
			),
			array
			(
				"TBL",
				"TBR"
			),
			$this->height);

		//$this->SetAligns(array("L", "L"));
		//$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"Subjek Pajak"
			),
			array
			(
				"L",
				"R"
			),
			$this->height);
		
		
		$this->barisBaru_long("", "1 Nama Wajib Pajak", ": " . $data["wp_name"]);
		$this->barisBaru_long("", "2 ".$data['opsi_a2'], ": ".$data['opsi_a2_keterangan']);
		$this->barisBaru_long("", "3 Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
		$this->barisBaru_long("", "4 RT/RW", ": RT. " . $data["wp_rt"] . "/RW. " .  $data["wp_rw"]);
		$this->barisBaru_long("", "5 Kelurahan/Desa", ": " . $data["wp_region_kel"]);
		$this->barisBaru_long("", "6 Kecamatan", ": " . $data["wp_region_kec"]);
		$this->barisBaru_long("", "7 Kabupaten/Kota", ": " . $data["wp_region"]);
		$this->barisBaru_long("", "", "" . "");

		$this->SetFont("Arial", "B", 8);
		$this->SetAligns(array("L", "L"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"Objek Pajak"
			),
			array
			(
				"TL",
				"TR"
			),
			$this->height);
		$this->barisBaru_long("", "1 Nomor Objek Pajak (NOP) PBB ", ": " . $data["njop_pbb"]);
		$this->barisBaru_long("", "2 Letak tanah atau bangunan", ": " . $data["object_address_name"]);
		$this->barisBaru_long("", "3 Luas Tanah", ": " . $data["land_area"]." m2");
		$this->barisBaru_long("", "4 Luas Bangunan", ": " . $data["building_area"]." m2");
		$this->barisBaru_long("", "5 RT/RW", ": RT. ".trim($data["object_rt"])."/RW. " . $data["object_rw"]);
		$this->barisBaru_long("", "6 Kelurahan/Desa", ": " . $data["object_region_kel"]);
		$this->barisBaru_long("", "7 Kecamatan", ": " . $data["object_region_kec"]);
		$this->barisBaru_long("", "8 Kabupaten/Kota", ": " . $data["object_region"]);
		$this->barisBaru_long("", "", "" . "");

		$this->SetFont("Arial", "B", 8);
		$this->SetAligns(array("L", "L"));
		$this->SetWidths(array($lbody1,$lbody1+$lbody4, $this->lengthCell-$lbody1-$lbody4-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"STATUS PENGURANGAN",":"
			),
			array
			(
				"TL","T",
				"TR"
			),
			$this->height);
		
		$this->barisBaru("", "", "" . "");

		$this->SetFont("Arial", "B", 8);
		$this->SetAligns(array("L", "L"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"II",
				"DASAR PENGURANGAN :"
			),
			array
			(
				"TL",
				"TR"
			),
			$this->height);

		$this->SetFont("Arial", "", 8);
		$this->SetAligns(array("L", "J"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				$data['dasar_pengurang']
				/*"Secara normatif berdasarkan Pasal 17 Ayat 3 huruf b Angka 6 Peraturan Walikota No. 393 Tahun 2012 Wajib Pajak dan penanggung pajak orang pribadi Veteran, Pegawai Negeri Sipil (PNS), Tentara Nasional Indonesia (TNI), Polisi Republik Indonesia (Polri), Pensiunan PNS, Purnawirawan TNI, Purnawirawan Polri atau janda/duda-nya yang memperoleh hak atas tanah dan/atau bangunan rumah dinas Pemerintah, sebesar 50% (lima puluh persen) yang dibuktikan dengan akta maupun keterangan sesuai dengan ketentuan pelepasan hak atas tanah dan/atau bangunan rumah dinas Pemerintah dimaksud. Di luar wajib pajak atau penanggung pajak dimaksud tidak memperoleh  hak keringanan atau pengurangan"*/
			),
			array
			(
				"L",
				"R"
			),
			$this->height);
		
		$this->barisBaru("", "", "" . "");

		$this->SetFont("Arial", "B", 8);
		$this->SetAligns(array("L", "L"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"III",
				"ANALISA PERMOHONAN PENGURANGAN UNTUK :"
			),
			array
			(
				"TL",
				"TR"
			),
			$this->height);	
		$this->SetFont("Arial", "", 8);
		$this->SetAligns(array("L", "J"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				$data['analisa_penguranan']
				/*"Setelah diteliti secara administratif Permohonan Pengurangan "."Rumah Dinas"." untuk Tanah dan Bangunan sebagaimana yang diajukan oleh Pemohon dapat dipertimbangkan"*/
			),
			array
			(
				"L",
				"R"
			),
			$this->height);	
		$this->barisBaru("", "", "" . "");

		$this->SetFont("Arial", "B", 8);
		$this->SetAligns(array("L", "L"));
		$this->SetWidths(array($lbody1, $this->lengthCell-$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"IV",
				"SETUJU PENGURANGAN"
			),
			array
			(
				"TL",
				"TR"
			),
			$this->height);	
		$this->SetFont("Arial", "", 8);
		$this->SetAligns(array("L", "J", "C"));
		$this->SetWidths(array($lbody1, ($this->lengthCell-$lbody1)/2-$lbody1,($this->lengthCell-$lbody1)/2+$lbody1));
		$this->RowMultiBorderWithHeight(
			array
			(	
				"",
				"Paraf :",
				$data['persen_pengurangan']."% \n\n"."(".$this->numbertell($data['persen_pengurangan'])." Persen )"
			),
			array
			(
				"LB","B",
				"RB"
			),
			$this->height);	
			
	}
	
	function numbertell($x){
        $abil = array(
        "",
        "Satu", "Dua", "Tiga",
        "Empat", "Lima", "Enam",
        "Tujuh", "Delapan", "Sembilan",
        "Sepuluh", "Sebelas"
        );
        if ($x < 12)
        return " ".$abil[$x];
        elseif ($x<20)
        return $this->numbertell($x-10)." Belas";
        elseif ($x<100)
        return $this->numbertell($x/10)." Puluh".$this->numbertell($x%10);
        elseif ($x<200)
        return " Seratus".$this->numbertell($x-100);
        elseif ($x<1000)
        return $this->numbertell($x/100)." Ratus".$this->numbertell($x % 100);
        elseif ($x<2000)
        return " Seribu".$this->numbertell($x-1000);
        elseif ($x<1000000)
        return $this->numbertell($x/1000)." Ribu".$this->numbertell($x%1000);
        elseif ($x<1000000000)
        return $this->numbertell($x/1000000)." Juta".$this->numbertell($x%1000000);
        elseif ($x<1000000000000)
        return $this->numbertell($x/1000000000)." Milyar".$this->numbertell($x%1000000000);
        elseif ($x<1000000000000000)
        return $this->numbertell($x/1000000000000)." Trilyun".$this->numbertell($x%1000000000000);
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
		
		$this->Cell($lbody1+$lbody1, $this->height, "$section", "L", 0, "L");
		$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15-$lbody1));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array("R"), $this->height);
	}
	function barisBaru_long($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1+$lbody1, $this->height, "$section", "L", 0, "L");
		$this->Cell($lbody4+$lbody1, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15-$lbody1-$lbody1));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array("R"), $this->height);
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

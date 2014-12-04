<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_pengurangan_bphtb_surat_keputusan.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$t_bphtb_registration_id		= CCGetFromGet("t_bphtb_registration_id", "");

// $t_bphtb_registration_id		= 23;

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, 
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
		$dbConn = new clsDBConnSIKP();
		$query = "SELECT * FROM f_terbilang('".ceil($data['bphtb_amt_final'])."','') as terbilang";
		$dbConn->query($query);
		$data['terbilang'] = '';
		if($dbConn->next_record()) {
		    $data['terbilang'] = ucwords($dbConn->f("terbilang"))." Rupiah";
		}
		
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody10 = $lbody * 15;

		$this->Image('../images/logo_pemda.png',10,10,20,20);
		//$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,165,10,25,25,'PNG');
		$this->SetFont("Arial", "B", 10);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, "C");
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, "C");
		$this->Ln();
		$this->SetFont("Arial", "B", 14);
		$this->Cell($this->lengthCell, $this->height, "DINAS PELAYANAN PAJAK", "", 0, "C");
		$this->Ln();
		$this->SetFont("Arial", "B", 8);
		$this->Cell($this->lengthCell, $this->height, "Jl. Wastukencana No. 2 Telp : (022) 4235052 Bandung", "B", 0, "C");
		$this->Ln(); 
		$this->Ln(); 
		//$this->newLine();
		//$this->Cell($this->lengthCell, $this->height, "JENIS TRANSAKSI: ".strtoupper($data['doc_name']), "", 0, "C");
		//$this->Ln();
		//$this->Cell($this->lengthCell, $this->height, "NO REGISTRASI: ".strtoupper($data['registration_no']), "", 0, "C");
		
		$this->SetFont("Arial", "B", 8);
		$this->SetWidths(array($this->lengthCell));
		$this->SetAligns(array("C"));
		$this->RowMultiBorderWithHeight(
			array
			(	"PEMERINTAH KOTA BANDUNG \nKEPUTUSAN KEPALA DINAS PELAYANAN PAJAK \nNOMOR : "."                                   ".
				"\nPEMBERIAN PENGURANGAN \nBEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN \nYANG TERUTANG \nKEPALA DINAS PELAYANAN PAJAK KOTA BANDUNG"
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Ln();

		$this->newLine();

		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody1+$lbody1,$this->lengthCell-$lbody1-$lbody1));
		$this->SetAligns(array("L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Membaca",
				": Surat Permohonan Pengurangan Bea Perolehan Hak atas Tanah dan Bangunan atas nama"
			),
			array
			(
				"",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1,$lbody1+$lbody1+$lbody1,$this->lengthCell-$lbody1-$lbody1-$lbody1-$lbody1-$lbody1));
		$this->SetAligns(array("L","L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				" - Nama",
				": ".$data["wp_name"]
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1,$lbody1+$lbody1+$lbody1,$this->lengthCell-$lbody1-$lbody1-$lbody1-$lbody1-$lbody1));
		$this->SetAligns(array("L","L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				" - ".$data['opsi_a2'],
				": ".$data['opsi_a2_keterangan']
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->Ln();

		$this->SetWidths(array($lbody1+$lbody1,6,$this->lengthCell-$lbody1-$lbody1-6));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Menimbang",
				": a.",
				"Hasil pemeriksaan atas permohonan pengurangan Bea Perolehan Hak atas Tanah dan Bangunan yang terutang sebagaimana pemeriksaan"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1+6,$lbody1+$lbody1+$lbody1-6,$this->lengthCell-$lbody1-$lbody1-$lbody1-$lbody1-$lbody1));
		$this->SetAligns(array("L","L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Nomor",
				": ".$data['nomor_berita_acara']
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1+6,$lbody1+$lbody1+$lbody1-6,$this->lengthCell-$lbody1-$lbody1-$lbody1-$lbody1-$lbody1));
		$this->SetAligns(array("L","L","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Tanggal",
				": ".$this->beautyDate($data['tanggal_berita_acara'])
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1,6,$this->lengthCell-$lbody1-$lbody1-6));
		$this->SetAligns(array("L","R","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				" b.",
				"Bahwa terdapat/tidak terdapat )* cukup alasan untuk mengurangkan besarnya Bea Perolehan Hak atas Tanan dan Bangunan yang terutang"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->Ln();

		$this->SetWidths(array($lbody1+$lbody1,6,$this->lengthCell-$lbody1-$lbody1-6));
		$this->SetAligns(array("L","R","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Mengingat",
				": 1.",
				"Peraturan Daerah Nomor 20 Tahun 2011 tentang Pajak Daerah;"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1,6,$this->lengthCell-$lbody1-$lbody1-6));
		$this->SetAligns(array("L","R","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				" 2.",
				"Peraturan Walikota Nomor 308 Tahun 2013 tentang Tata Cara Pemungutan dan Standar Operasional Prosedur Bea Perolehan Hak atas Tanah dan Bangunan"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->Ln();
		
		$this->SetFont("Arial", "B", 8);
		$this->SetWidths(array($this->lengthCell));
		$this->SetAligns(array("C"));
		$this->RowMultiBorderWithHeight(
			array
			(	"MEMUTUSKAN"
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Ln();
		
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody1+$lbody1,3,$this->lengthCell-$lbody1-$lbody1-3));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"Menetapkan",":",
				"KEPUTUSAN KEPALA DINAS PELAYANAN PAJAK KOTA BANDUNG TENTANG PEMBERIAN PENGURANGAN BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN YANG TERUTANG"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->Ln();	

		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody1+$lbody1,3,$this->lengthCell-$lbody1-$lbody1-3));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"PERTAMA",":",
				"Mengabulkan seluruhnya/mengabaikan sebagian/menolak permohonan pengurangan Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB) yang terutang kepada wajib pajak"
			),
			array
			(
				"","",""
			),
			$this->height-1);

		$this->SetFont("Arial", "B", 12);
		$this->barisBaru("", "Nama Wajib Pajak", ": " . $data["wp_name"]);
		$this->barisBaru("", $data['opsi_a2'], ": ".$data['opsi_a2_keterangan']);
		$this->barisBaru("", "Alamat Wajib Pajak", ": " . $data["wp_address_name"]);
		$this->barisBaru("", "RT/RW", ": RT. " . $data["wp_rt"] . "/RW. " .  $data["wp_rw"]);
		$this->barisBaru("", "Kelurahan/Desa", ": " . $data["wp_region_kel"]);
		$this->barisBaru("", "Kecamatan", ": " . $data["wp_region_kec"]);
		$this->barisBaru("", "Kabupaten/Kota", ": " . $data["wp_region"]);
		$this->barisBaru("", "Tahun BPHTB", ": ".date("Y"));
		$this->barisBaru_special("", "Atas perolehan hak atas tanah dan/atau bangunannya dengan", ": ".$data['jenis_perolehan_hak']);
		$this->barisBaru("", "Akta/Risalah Lelang/Keputusan Pemberian Hak/Putusan Hakim/Dokumen lainnya)**", "");
		$this->barisBaru("", $data['keterangan_opsi_c']."", "");
		$this->barisBaru("", "Nomor", ": ".$data['opsi_b7_keterangan']);
		$this->barisBaru("", "Tanggal", ": ".$this->beautyDate($data['tanggal_sk']));
		$this->barisBaru("", "NOP PBB", ": " . $data["njop_pbb"]);
		$this->barisBaru("", "NJOP", ": Rp. ".number_format($data['npop'], 0, ",", "."));
		$this->barisBaru("", "Alamat", ": " . $data["object_address_name"]);
		$this->barisBaru("", "RT/RW", ": RT. " . trim($data["object_rt"]). "/RW. " . $data["object_rw"]);
		$this->barisBaru("", "Kelurahan/Desa", ": " . $data["object_region_kel"]);
		$this->barisBaru("", "Kecamatan", ": " . $data["object_region_kec"]);
		$this->barisBaru("", "Kabupaten/Kota", ": " . $data["object_region"]);
		$this->Ln();

		$this->SetWidths(array($lbody1+$lbody1,3,$this->lengthCell-$lbody1-$lbody1-3));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"KEDUA",":",
				"Sesuai dengan keputusan sebagaimana dimaksud pada dictum PERTAMA maka besarnya BPHTB yang seharusnya dibayar adalah sebagai berikut :"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		
		$this->barisBaru2($lbody1+$lbody1+3, "- Nilai Perolehan Objek Pajak (NPOP)", "", "Rp", $data["npop"]);
		$this->barisBaru2($lbody1+$lbody1+3, "- Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)", "", "Rp", $data["npop_tkp"]);
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1+$lbody1+3, "- Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp","NIHIL");
		}else{
			$this->barisBaru2($lbody1+$lbody1+3, "- Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", "Rp", $data["npop_kp"]);
		}
		
		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1+$lbody1+3, "- Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", "NIHIL");
		}else{
			$this->barisBaru2($lbody1+$lbody1+3, "- Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "5%", "Rp", $data["bphtb_amt"]);
		}

		$this->Cell($lbody1+$lbody1+3, $this->height, "", "", 0, "");
		$this->Cell($this->length - $lbody1+$lbody1+3, $this->height, "- Pengenaan Pengurangan Karena ".$data['jenis_perolehan_hak'], "", 0, "");
		$this->Ln();
		$this->barisBaru2($lbody1+$lbody1+3, "- Besaran Pengenaan Pengurangan ", $data['persen_pengurangan']."%", "Rp", $data["bphtb_discount"]);

		if($data["npop_kp"]==0){
			$this->barisBaruStr($lbody1+$lbody1+3, "- Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", "NIHIL");
		}else{
			$this->barisBaru3($lbody1+$lbody1+3, "- Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar", "", "Rp", $data["bphtb_amt_final"]);
		}

		$this->Cell($lbody1+$lbody1+3, $this->height, "", "", 0, "");
		$this->Cell($lbody1+ $lbody1, $this->height, "- Terbilang :", "", 0, "");
		$this->SetFont("Arial", "iB", 8);
		$this->Cell($this->length - $lbody1- $lbody1- $lbody1-$lbody1-3, $this->height, $data['terbilang'], "", 0, "");
		$this->Ln();
		$this->Ln();
		
		$this->SetFont("Arial", "", 8);
		$this->SetWidths(array($lbody1+$lbody1,3,$this->lengthCell-$lbody1-$lbody1-3));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"KETIGA",":",
				"Apabila dikemudian hari ternyata terdapat kekeliruan dalam surat keputusan ini maka akan dibetulkan sebagaimana mestinya"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->Ln();

		$this->SetWidths(array($lbody1+$lbody1,6,$this->lengthCell-$lbody1-$lbody1-6));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"KEEMPAT",": a.",
				"Asli Keputusan ini disampaikan kepada Wajib Pajak"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->SetWidths(array($lbody1+$lbody1,6,$this->lengthCell-$lbody1-$lbody1-6));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(
			array
			(	"","  b.",
				"Salinan Keputusan ini disimpan sebagai arsip Dinas Pelayanan Pajak Kota Bandung"
			),
			array
			(
				"","",""
			),
			$this->height-1);
		$this->Ln();
		
		$ttd = $this->lengthCell / 3;
		$ttd1 = $ttd * 1;
		$ttd2 = $ttd * 2;
		
		$this->SetWidths(array($ttd2,$ttd1));
		$this->SetAligns(array("C","L"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"Ditetapkan di Bandung \npada tanggal "
			),
			array
			(
				"",""
			),
			$this->height-1);	
		$this->Ln();

		$this->SetFont("Arial", "B", 8);
		$this->SetWidths(array($ttd2,$ttd1));
		$this->SetAligns(array("C","C"));
		$this->RowMultiBorderWithHeight(
			array
			(	"",
				"KEPALA DINAS PELAYANAN PAJAK\n\n\n\n\nDrs. PRIANA WIRASAPUTRA, MM\nPembina Utama Muda\nNIP. 19600308 198503 1 007"
			),
			array
			(
				"",""
			),
			$this->height-1);
		$this->Ln();
		$this->Ln();
		$this->Ln();
		
		$this->Cell(15, $this->height-2, "Tembusan, ", "B", 0, "L");
		$this->SetFont("Arial", "", 8);
		$this->Cell(15, $this->height-2, " disampaikan kepada Yth :", "", 0, "L");
		$this->Ln();
		
		$this->SetWidths(array(100));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(
			array
			(	"1. Bapak Walikota Bandung (sebagai laporan)\n".
				"2. Bapak Wakil Walikota Bandung (sebagai laporan)\n".
				"3. Bapak Sekretaris Kota Bandung (sebagai laporan)\n".
				"4. Arsip"
			),
			array
			(
				""
			),
			$this->height-1);
		$this->Ln();		
	}
	
	function beautyDate($tgl) {
	    
	    $arrtgl = explode("-", $tgl);
	    $dd = $arrtgl[0];
	    $mm = $arrtgl[1];
	    $yyyy = $arrtgl[2];
	    
	    $arrmonth = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	    return $dd." ".$arrmonth[$mm-1]." ".$yyyy;
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
		
		$this->Cell($lbody1+$lbody1+3, $this->height, "$section", "", 0, "L");
		$this->Cell($lbody4, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15-$lbody1-3));
		$this->SetAligns(array("L"));
		$this->RowMultiBorderWithHeight(array($data), array(""), $this->height);
	}

	function barisBaru_special($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;		
		$this->SetWidths(array($lbody1+$lbody1+3,$lbody4,$lbody15-$lbody1-3));
		$this->SetAligns(array("L","J","J"));
		$this->RowMultiBorderWithHeight(array($section,$field,$data), array("","",""), $this->height);
	}

	function barisBaru_long($section, $field, $data){
		$this->SetFont("Arial", "", 8);
		$lbody = $this->lengthCell / 20;
		$lbody1 = $lbody * 1;
		$lbody4 = $lbody * 4;
		$lbody15 = $lbody * 15;
		
		$this->Cell($lbody1, $this->height, "$section", "", 0, "L");
		$this->Cell($lbody4+$lbody1, $this->height, "$field", "", 0, "L");
		
		$this->SetWidths(array($lbody15-$lbody1));
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

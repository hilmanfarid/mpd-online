<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_parkir_pdf.php");
include_once(RelativePath . "/Common.php");
require("../include/qrcode/fpdf17/fpdf.php");

$custId = CCGetFromGet("t_customer_order_id", "");
//$custId = 1;
$data = array();
$dataArr = array();
$dataBaru = array();
$dbConn = new clsDBConnSIKP();

$query="begin;";
$dbConn->query($query);
$query="select * from f_cetak_pajak_parking(".$custId.", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "
		."NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "
		."NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, " 
		."NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, " 
		."NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "
		."'refone', 'refone2');";
$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["o_order_no"] = $dbConn->f("o_order_no");
		$data["o_rqst_type_id"] = $dbConn->f("o_rqst_type_id");
		$data["o_order_status_id"] = $dbConn->f("o_order_status_id");
		$data["o_order_date"] = $dbConn->f("o_order_date");
		$data["o_vat_registration_id"] = $dbConn->f("o_vat_registration_id");
		$data["o_rqst_type_code"] = $dbConn->f("o_rqst_type_code");
		$data["o_order_status_code"] = $dbConn->f("o_order_status_code");
		$data["o_registration_date"] = $dbConn->f("o_registration_date");
		$data["o_company_name"] = $dbConn->f("o_company_name");
		$data["o_company_brand"] = $dbConn->f("o_company_brand");
		$data["o_address_name"] = $dbConn->f("o_address_name");
		$data["o_address_no"] = $dbConn->f("o_address_no");
		$data["o_address_rt"] = $dbConn->f("o_address_rt");
		$data["o_address_rw"] = $dbConn->f("o_address_rw");
		$data["o_phone_no"] = $dbConn->f("o_phone_no");
		$data["o_mobile_no"] = $dbConn->f("o_mobile_no");
		$data["o_fax_no"] = $dbConn->f("o_fax_no");
		$data["o_zip_code"] = $dbConn->f("o_zip_code");
		$data["o_company_owner"] = $dbConn->f("o_company_owner");
		$data["o_address_name_owner"] = $dbConn->f("o_address_name_owner");
		$data["o_address_no_owner"] = $dbConn->f("o_address_no_owner");		
		$data["o_address_rt_owner"] = $dbConn->f("o_address_rt_owner");
		$data["o_address_rw_owner"] = $dbConn->f("o_address_rw_owner");
		$data["o_phone_no_owner"] = $dbConn->f("o_phone_no_owner");
		$data["o_mobile_no_owner"] = $dbConn->f("o_mobile_no_owner");
		$data["o_fax_no_owner"] = $dbConn->f("o_fax_no_owner");
		$data["o_zip_code_owner"] = $dbConn->f("o_zip_code_owner");
		$data["o_job_position_code"] = $dbConn->f("o_job_position_code");
		$data["o_kelurahan_code"] = $dbConn->f("o_kelurahan_code");
		$data["o_kecamatan_code"] = $dbConn->f("o_kecamatan_code");
		$data["o_kota_code"] = $dbConn->f("o_kota_code");		
		$data["o_kelurahan_own_code"] = $dbConn->f("o_kelurahan_own_code");
		$data["o_kecamatan_own_code"] = $dbConn->f("o_kecamatan_own_code");
		$data["o_kota_own_code"] = $dbConn->f("o_kota_own_code");
		$data["o_email"] = $dbConn->f("o_email");		
		$data["o_wp_name"] = $dbConn->f("o_wp_name");	
		$data["o_wp_address_name"] = $dbConn->f("o_wp_address_name");			
		$data["o_wp_address_no"] = $dbConn->f("o_wp_address_no");
		$data["o_wp_address_rt"] = $dbConn->f("o_wp_address_rt");
		$data["o_wp_address_rw"] = $dbConn->f("o_wp_address_rw"); 
		$data["o_wp_kelurahan"] = $dbConn->f("o_wp_kelurahan");
		$data["o_wp_kecamatan"] = $dbConn->f("o_wp_kecamatan");
		$data["o_wp_kota"] = $dbConn->f("o_wp_kota");
		$data["o_wp_phone_no"] = $dbConn->f("o_wp_phone_no");
		$data["o_wp_mobile_no"] = $dbConn->f("o_wp_mobile_no");
		$data["o_wp_fax_no"] = $dbConn->f("o_wp_fax_no");
		$data["o_wp_zip_code"] = $dbConn->f("o_wp_zip_code");
		$data["o_wp_email"] = $dbConn->f("o_wp_email");
		$data["o_brand_address_name"] = $dbConn->f("o_brand_address_name");
		$data["o_brand_address_no"] = $dbConn->f("o_brand_address_no");
		$data["o_brand_address_rt"] = $dbConn->f("o_brand_address_rt");
		$data["o_brand_address_rw"] = $dbConn->f("o_brand_address_rw");
		$data["o_brand_kelurahan"] = $dbConn->f("o_brand_kelurahan");
		$data["o_brand_kecamatan"] = $dbConn->f("o_brand_kecamatan");
		$data["o_brand_kota"] = $dbConn->f("o_brand_kota");
		$data["o_brand_phone_no"] = $dbConn->f("o_brand_phone_no");
		$data["o_brand_mobile_no"] = $dbConn->f("o_brand_mobile_no");
		$data["o_brand_fax_no"] = $dbConn->f("o_brand_fax_no");
		$data["o_brand_zip_code"] = $dbConn->f("o_brand_zip_code");
		$data["npwpd"] = $dbConn->f("npwpd");
}

$query = "fetch all in \"refone\";";
$dbConn->query($query);
while ($dbConn->next_record()) {
	$dataArr["license_no"][] = $dbConn->f("license_no");
	$dataArr["valid_from"][] = $dbConn->f("valid_from");
	$dataArr["valid_to"][] = $dbConn->f("valid_to");
	$dataArr["license_type_code"][] = $dbConn->f("license_type_code");
}

$query = "fetch all in \"refone2\";";
$dbConn->query($query);
while ($dbConn->next_record()) {
	$dataBaru["classification_desc"][] = $dbConn->f("classification_desc");
	$dataBaru["parking_size"][] = $dbConn->f("parking_size");
	$dataBaru["max_load_qty"][] = $dbConn->f("max_load_qty");
	$dataBaru["avg_subscription_qty"][] = $dbConn->f("avg_subscription_qty");	
	$dataBaru["first_service_charge"][] = $dbConn->f("first_service_charge");
	$dataBaru["next_service_charge"][] = $dbConn->f("next_service_charge");
	$dataBaru["parking_classification_code"][] = $dbConn->f("parking_classification_code");
}

$dbConn->query("end;");
	//barcode
	$bcr = "select f_gen_barcode('test')";
	$dbConn->query($bcr);
	while($dbConn->next_record()){
		$data["barcode"] = $dbConn->f("f_gen_barcode");
	}
	//end barcode
$dbConn->close();
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
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data,$dataArr,$dataBaru) {
		$this->AliasNbPages();
		$this->AddPage("P");		
		$startY = $this->GetY();
		$startX = $this->paperWSize-42;
		$lengthCell = $startX+20;		
		$this->SetFont('Arial', '', 10);
		
		$lengthJudul1 = ($lengthCell * 3) / 9;
		$lengthJudul2 = ($lengthCell * 3) / 9;
		$lengthJudul3 = ($lengthCell * 3) / 9;
		$batas1 = ($lengthJudul3 * 2) / 5;
		$batas2 = ($lengthJudul3 * 3) / 5;
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);
		// $this->Cell($lengthJudul1, $this->height, "", 0, 0, 'C');
		// $this->Cell($lengthJudul2, $this->height, "LAMPIRAN :", 0, 0, 'R');
		// $this->Cell($lengthJudul3, $this->height, "PERATURAN WALIKOTA BANDUNG", 0, 0, 'L');
		// $this->Ln();
		// $this->Cell($lengthJudul1, $this->height, "", 0, 0, 'C');
		// $this->Cell($lengthJudul2, $this->height, "", 0, 0, 'R');
		// $this->Cell($batas1, $this->height, "NOMOR", 0, 0, 'L');
		// $this->Cell($batas2, $this->height, ": 387 TAHUN 2012", 0, 0, 'L');
		// $this->Ln();
		// $this->Cell($lengthJudul1, $this->height, "", 0, 0, 'C');
		// $this->Cell($lengthJudul2, $this->height, "", 0, 0, 'R');
		// $this->Cell($batas1, $this->height, "TANGGAL", "B", 0, 'L');
		// $this->Cell($batas2, $this->height, ": 4 Juni 2012", "B", 0, 'L');
		// $this->Ln(10);
		
		// $this->Cell($lengthCell, $this->height, "1.	FORMULIR PENDAFTARAN WAJIB PAJAK", 0, 0, 'L');
		// $this->Ln(6);
		
		$length1 = ($lengthCell * 2) / 9;
		$length2 = ($lengthCell * 4) / 9;
		$length3 = ($lengthCell * 3) / 9;
		$kolom1 = ($length3 * 1) / 10;
		$kolom2 = ($length3 * 1) / 10;
		$kolom3 = ($length3 * 1) / 10;
		$kolom4 = ($length3 * 1) / 10;
		$kolom5 = ($length3 * 1) / 10;
		$kolom6 = ($length3 * 1) / 10;
		$kolom7 = ($length3 * 1) / 10;
		$kolom8 = ($length3 * 1) / 10;
		$penutup  = ($length3 * 2) / 10;
		
		$this->SetFont('Arial', '', 8);
		$this->Cell($length1, $this->height-4, "", "TL", 0, 'C');
		$this->Cell($length2, $this->height-4, "", "T", 0, 'C');
		$this->Cell($length3, $this->height-4, "", "TR", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "PEMERINTAH KOTA BANDUNG", 0, 0, 'C');
		$this->Cell($length3, $this->height, "  Nomor Formulir", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "DINAS PELAYANAN PAJAK", 0, 0, 'C');
		
		//nomor formulir
		$arr1 = str_split($data["o_order_no"]);
		$this->Cell($kolom1, $this->height, $arr1[0], 1, 0, 'C');
		$this->Cell($kolom2, $this->height, $arr1[1], 1, 0, 'C');
		$this->Cell($kolom3, $this->height, $arr1[2], 1, 0, 'C');
		$this->Cell($kolom4, $this->height, $arr1[3], 1, 0, 'C');
		$this->Cell($kolom5, $this->height, $arr1[4], 1, 0, 'C');
		$this->Cell($kolom6, $this->height, $arr1[5], 1, 0, 'C');
		$this->Cell($kolom7, $this->height, $arr1[6], 1, 0, 'C');
		$this->Cell($kolom8, $this->height, $arr1[7], 1, 0, 'C');
		$this->Cell($penutup, $this->height, "", "R", 0, 'C');
		//================
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "Jl. Wastukancana No. 2", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "Telp. (022) 4235052", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "Fax (022) 4208604", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "BANDUNG", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height-4, "", "BL", 0, 'C');
		$this->Cell($length2, $this->height-4, "", "B", 0, 'C');
		$this->Cell($length3, $this->height-4, "", "BR", 0, 'L');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lengthCell, $this->height-4, "", "TLR", 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "FORMULIR PENDAFTARAN", "LR", 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "WAJIB PAJAK PARKIR", "LR", 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height-4, "", "BLR", 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', '', 8);
		
		$len1 = ($lengthCell * 6) / 10;
		$len2 = ($lengthCell * 4) / 10;
		$this->Cell($len1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($len2, $this->height, "Kepada Yth.", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($len1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($len2, $this->height, "DINAS PELAYANAN PAJAK KOTA BANDUNG", "BR", 0, 'L');
		$this->Ln();
		/*
		$this->Cell($len1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($len2, $this->height, ".............................................................", "BR", 0, 'L');
		$this->Ln();		
		$this->Cell($len1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($len2, $this->height, "Di...........................................................", "BR", 0, 'L');
		$this->Ln();
		*/
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->SetFont('Arial', 'B', 8);
		$this->Cell($lengthCell, $this->height, "PERHATIAN :", 1, 0, 'L');
		$this->Ln();
		
		$this->SetFont('Arial', '', 8);
		$per1 = ($lengthCell * 1) / 40;
		$per2 = ($lengthCell * 10) / 40;
		$per3 = ($lengthCell * 29) / 40;
		$this->Cell($per1, $this->height, "1. ", "TBL", 0, 'C');
		$this->Cell($per2+$per3, $this->height, "Harap diisi dalam rangkap 2 (dua) ditulis dalam huruf CETAK;", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "2. ", "TBL", 0, 'C');
		$this->Cell($per2+$per3, $this->height, "Diberi v pada kotak yang tersedia untuk jawaban yang diberikan;", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "3. ", "TBL", 0, 'C');
		$this->Cell($per2+$per3, $this->height, "Setelah Formulir Pendaftaran ini diisi dan ditanda tangani,  harap diserahkan kembali Kepada Dinas Pelayanan Pajak", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'L');
		$this->Cell($per2+$per3, $this->height, "Kota Bandung langsung atau dikirim melalui Pos paling lambat tanggal .......................", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 8);		
		$this->Cell($lengthCell, $this->height, "DIISI OLEH SELURUH WAJIB PAJAK BADAN", 1, 0, 'C');
		$this->SetFont('Arial', '', 8);
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 8);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "KETERANGAN WAJIB PAJAK", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Ln();
		$this->Cell($per1, $this->height, "1. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Nama Wajib Pajak", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_name"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "2. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Alamat", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ":", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Jalan/Nomor", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_address_name"]." / ".$data["o_wp_address_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- RT/RW", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_address_rt"]." / ".$data["o_wp_address_rw"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kelurahan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_kelurahan"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kecamatan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_kecamatan"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kabupaten/Kota", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_kota"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Nomor Telepon", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_phone_no"]."     No. Selular ".$data["o_wp_mobile_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Nomor Fax", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_wp_fax_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height+2, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height+2, "- Kode Pos", "TB", 0, 'L');
		$this->Cell($per3, $this->height+2, ": ", "TBR", 0, 'L');
		$spasi = ($per3 * 1) / 20;
		$zip1 = ($per3 * 1) / 20;
		$zip2 = ($per3 * 1) / 20;
		$zip3 = ($per3 * 1) / 20;
		$zip4 = ($per3 * 1) / 20;
		$zip5 = ($per3 * 1) / 20;
		$this->Ln($this->height-4);
		$zipCodeOwn = str_split($data["o_wp_zip_code"]);
		$this->Cell($per1+$per2, $this->height, "", 0, 0, 'C');
		$this->Cell($spasi-4, $this->height, "", 0, 0, 'C'); //spasi kode pos
		$this->Cell($zip1, $this->height, $zipCodeOwn[0], 1, 0, 'C');
		$this->Cell($zip2, $this->height, $zipCodeOwn[1], 1, 0, 'C');
		$this->Cell($zip3, $this->height, $zipCodeOwn[2], 1, 0, 'C');
		$this->Cell($zip4, $this->height, $zipCodeOwn[3], 1, 0, 'C');
		$this->Cell($zip5, $this->height, $zipCodeOwn[4], 1, 0, 'C');
		$this->Ln(6);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', 'B', 8);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "KETERANGAN PERUSAHAAN/BADAN", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Ln();
		$this->Cell($per1, $this->height, "3. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Nama Perusahaan / Badan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_company_name"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "4. ", "TBL", 0, 'C');
		$this->Cell($per2+$per3, $this->height, "Alamat (Photo copy Surat Keterangan Domisili dilampirkan)", "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Jalan/Nomor", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_address_name"]." / ".$data["o_address_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- RT/RW", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_address_rt"]." / ".$data["o_address_rw"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kelurahan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_kelurahan_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kecamatan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_kecamatan_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kabupaten/Kota", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_kota_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Nomor Telepon", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_phone_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height+2, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height+2, "- Kode Pos", "TB", 0, 'L');
		$this->Cell($per3, $this->height+2, ": ", "TBR", 0, 'L');
		$spasi = ($per3 * 1) / 20;
		$zip1 = ($per3 * 1) / 20;
		$zip2 = ($per3 * 1) / 20;
		$zip3 = ($per3 * 1) / 20;
		$zip4 = ($per3 * 1) / 20;
		$zip5 = ($per3 * 1) / 20;
		$this->Ln($this->height-4);
		$this->Cell($per1+$per2, $this->height, "", 0, 0, 'C');
		//kode pos
		$zipCode = str_split($data["o_zip_code"]);
		$this->Cell($spasi-4, $this->height, "", 0, 0, 'C'); //spasi kode pos
		$this->Cell($zip1, $this->height, $zipCode[0], 1, 0, 'C');
		$this->Cell($zip2, $this->height, $zipCode[1], 1, 0, 'C');
		$this->Cell($zip3, $this->height, $zipCode[2], 1, 0, 'C');
		$this->Cell($zip4, $this->height, $zipCode[3], 1, 0, 'C');
		$this->Cell($zip5, $this->height, $zipCode[4], 1, 0, 'C');
		$this->Ln(6);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->Ln();
		$this->SetFont('Arial', 'B', 8);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "KETERANGAN MERK DAGANG", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Ln();
		$this->Cell($per1, $this->height, "5. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Nama Merk Dagang", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_company_brand"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "6. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Alamat Lokasi Usaha", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ":", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Jalan/Nomor", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_address_name"]." / ".$data["o_brand_address_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- RT/RW", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_address_rt"]." / ".$data["o_brand_address_rw"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kelurahan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_kelurahan"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kecamatan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_kecamatan"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kabupaten/Kota", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_kota"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Nomor Telepon", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_phone_no"]."     No. Selular ".$data["o_brand_mobile_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Nomor Fax", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_brand_fax_no"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height+2, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height+2, "- Kode Pos", "TB", 0, 'L');
		$this->Cell($per3, $this->height+2, ": ", "TBR", 0, 'L');
		$spasi = ($per3 * 1) / 20;
		$zip1 = ($per3 * 1) / 20;
		$zip2 = ($per3 * 1) / 20;
		$zip3 = ($per3 * 1) / 20;
		$zip4 = ($per3 * 1) / 20;
		$zip5 = ($per3 * 1) / 20;
		$this->Ln($this->height-4);
		$zipCodeOwn = str_split($data["o_brand_zip_code"]);
		$this->Cell($per1+$per2, $this->height, "", 0, 0, 'C');
		$this->Cell($spasi-4, $this->height, "", 0, 0, 'C'); //spasi kode pos
		$this->Cell($zip1, $this->height, $zipCodeOwn[0], 1, 0, 'C');
		$this->Cell($zip2, $this->height, $zipCodeOwn[1], 1, 0, 'C');
		$this->Cell($zip3, $this->height, $zipCodeOwn[2], 1, 0, 'C');
		$this->Cell($zip4, $this->height, $zipCodeOwn[3], 1, 0, 'C');
		$this->Cell($zip5, $this->height, $zipCodeOwn[4], 1, 0, 'C');
		$this->Ln(6);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "7. ", "TBL", 0, 'C');
		$this->Cell($per2+$per3, $this->height, "Surat Izin yang dimiliki (Photo copy Surat Izin harap dilampirkan)", "TBR", 0, 'L');
		$this->Ln();
		
		$isi1 = ($per3 * 3) / 9;
		$isi2 = ($per3 * 3) / 9;
		$isi3 = ($per3 * 3) / 9;
		//surat izin
		
		for($i=0; $i<count($dataArr["license_no"]); $i++){
			$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
			$this->Cell($per2, $this->height, "- Surat Izin ".$dataArr["license_type_code"][$i], "B", 0, 'L');
			$this->Cell($isi1, $this->height, ": ", "B", 0, 'L');
			$this->Cell($isi2, $this->height, "No. ".$dataArr["license_no"][$i], "B", 0, 'L');
			$this->Cell($isi3, $this->height, "Tgl. ".$dataArr["valid_from"][$i], "BR", 0, 'L');
			$this->Ln();		
		}
		
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 8);
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "KETERANGAN PEMILIK ATAU PENGELOLA", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($per1, $this->height, "8. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Nama Pemilik/Pengelola", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_company_owner"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "9. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Jabatan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_job_position_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "10. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Alamat Tempat Tinggal", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ":", "BR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Jalan/Nomor", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_address_name_owner"]." / ".$data["o_address_no_owner"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- RT/RW", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_address_rt_owner"]." / ".$data["o_address_rw_owner"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kelurahan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_kelurahan_own_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kecamatan", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_kecamatan_own_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Kabupaten/Kota", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_kota_own_code"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "- Nomor Telepon", "TB", 0, 'L');
		$this->Cell($per3, $this->height, ": ".$data["o_phone_no_owner"]."     No. Selular ".$data["o_mobile_no_owner"], "TBR", 0, 'L');
		$this->Ln();
		$this->Cell($per1, $this->height+2, "", "TBL", 0, 'C');
		$this->Cell($per2, $this->height+2, "- Kode Pos", "TB", 0, 'L');
		$this->Cell($per3, $this->height+2, ": ", "TBR", 0, 'L');
		$spasi = ($per3 * 1) / 20;
		$zip1 = ($per3 * 1) / 20;
		$zip2 = ($per3 * 1) / 20;
		$zip3 = ($per3 * 1) / 20;
		$zip4 = ($per3 * 1) / 20;
		$zip5 = ($per3 * 1) / 20;
		$this->Ln($this->height-4);
		$zipCodeOwn = str_split($data["o_zip_code_owner"]);
		$this->Cell($per1+$per2, $this->height, "", 0, 0, 'C');
		$this->Cell($spasi-4, $this->height, "", 0, 0, 'C'); //spasi kode pos
		$this->Cell($zip1, $this->height, $zipCodeOwn[0], 1, 0, 'C');
		$this->Cell($zip2, $this->height, $zipCodeOwn[1], 1, 0, 'C');
		$this->Cell($zip3, $this->height, $zipCodeOwn[2], 1, 0, 'C');
		$this->Cell($zip4, $this->height, $zipCodeOwn[3], 1, 0, 'C');
		$this->Cell($zip5, $this->height, $zipCodeOwn[4], 1, 0, 'C');
		$this->Ln(6);
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($per1, $this->height, "11. ", "TBL", 0, 'C');
		$this->Cell($per2, $this->height, "Pendataan Pajak Parkir", "TB", 0, 'L');
		$this->Cell($per3, $this->height, "", "TBR", 0, 'L');
		$this->Ln();
		
		//kolom ke 7
		$kol1 = ($lengthCell * 2) / 29;
		$kol2 = ($lengthCell * 7) / 29;
		$kol3 = ($lengthCell * 6) / 29;
		$kol4 = ($lengthCell * 6) / 29;
		$kol5 = ($lengthCell * 6) / 29;
		$kol6 = ($lengthCell * 2) / 29;
		
		$this->Cell($kol1, $this->height, "", "LT", 0, 'C');
		$this->Cell($kol2, $this->height, "", "TB", 0, 'C');
		$this->Cell($kol3, $this->height, "", "TB", 0, 'C');
		$this->Cell($kol4, $this->height, "", "TB", 0, 'C');
		$this->Cell($kol5, $this->height, "", "TB", 0, 'C');
		$this->Cell($kol6, $this->height, "", "RT", 0, 'C');
		$this->Ln();
		$this->Cell($kol1, $this->height*2, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height*2, "", 1, 0, 'C');
		$this->Cell($kol3, $this->height*2, "", 1, 0, 'C');
		$this->Cell($kol4, $this->height*2, "", 1, 0, 'C');
		$this->Cell($kol5, $this->height*2, "", 1, 0, 'C');
		$this->Cell($kol6, $this->height*2, "", "R", 0, 'C');
		$this->Ln($this->height-5);
		$this->Cell($kol1, $this->height*2, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height*2, "Klasifikasi Tempat Parkir", 0, 0, 'C');
		$this->Cell($kol3, $this->height*2, "Luas Lahan Parkir", 0, 0, 'C');
		$this->Cell($kol4, $this->height+2, "Daya Tampung", 0, 0, 'C');
		$this->Cell($kol5, $this->height+2, "Frekuensi", 0, 0, 'C');
		$this->Cell($kol6, $this->height*2, "", "R", 0, 'C');
		$this->Ln($this->height);
		$this->Cell($kol1, $this->height, "", "L", 0, 'C');
		$this->Cell($kol2, $this->height, "", 0, 0, 'C');
		$this->Cell($kol3, $this->height, "", 0, 0, 'C');
		$this->Cell($kol4, $this->height-2, "Kendaraan Bermotor", 0, 0, 'C');
		$this->Cell($kol5, $this->height-2, "Kendaraan Bermotor", 0, 0, 'C');
		$this->Cell($kol6, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		//isi kolom
		$this->SetWidths(array($kol1, $kol2, $kol3, $kol4, $kol5, $kol6));
		$this->SetAligns(array("C", "L", "C", "C", "C", "C"));
		for ($i=0; $i<count($dataBaru['classification_desc']); $i++) {
		$this->RowMultiBorderWithHeight(array("",
											  $dataBaru["classification_desc"][$i],
											  $dataBaru["parking_size"][$i],
											  $dataBaru["max_load_qty"][$i],
											  $dataBaru["avg_subscription_qty"][$i],
											  "")
											 ,
										array('L',
										      'TBL',
											  'TBL',
											  'TBL',
											  'TBL',
											  'LR')
											  ,$this->height);
		}									  
	
		$this->Cell($kol1, $this->height, "", "LB", 0, 'C');
		$this->Cell($kol2, $this->height, "", "B", 0, 'C');
		$this->Cell($kol3, $this->height, "", "B", 0, 'C');
		$this->Cell($kol4, $this->height, "", "B", 0, 'C');
		$this->Cell($kol5, $this->height, "", "B", 0, 'C');
		$this->Cell($kol6, $this->height, "", "RB", 0, 'C');
		$this->Ln();
		
		
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		
		//Tanda tangan 
		$ttd1 = ($lengthCell * 8) / 13;
		$ttd2 = ($lengthCell * 5) / 13;
		$this->Cell($ttd1, $this->height, "", "LTB", 0, 'C');
		$this->Cell($ttd2, $this->height, "Nama Jelas :", "TRB", 0, 'L');
		$this->Ln();
		$this->Cell($ttd1, $this->height, "", "LTB", 0, 'C');
		$this->Cell($ttd2, $this->height, "Tanda Tangan", "TRB", 0, 'L');
		$this->Ln();
		$this->Cell($lengthCell, $this->height*6, "", 1, 0, 'C');
		$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$data["barcode"],124,$this->getY()+3,25,0,'PNG');
		$this->Ln();
		
		//petugas 
		$jarak = ($lengthCell * 1) / 40;
		$ttdP1 = ($lengthCell * 15) / 40;
		$ttdP2 = ($lengthCell * 24) / 40;
		$this->Cell($jarak, $this->height, "", "LTB", 0, 'L');
		$this->Cell($ttdP1, $this->height, "DIISI OLEH PETUGAS PENERIMAN", "TB", 0, 'L');
		$this->Cell($ttdP2, $this->height, "DIISI OLEH PETUGAS PENCATATAN DATA", "TRB", 0, 'L');
		$this->Ln();
		$this->Cell($jarak, $this->height, "", "LTB", 0, 'L');
		$this->Cell($ttdP1, $this->height, "Diterima tanggal", "TB", 0, 'L');
		$this->Cell($ttdP2, $this->height, "NPWPD yang diberikan :", "TRB", 0, 'L');
		$this->Ln();
		$this->Cell($jarak, $this->height+2, "", "LTB", 0, 'L');
		$this->Cell($ttdP1, $this->height+2, "Nama Jelas/NIP", "TB", 0, 'L');
		$this->Cell($ttdP2, $this->height+2, "", "TRB", 0, 'L'); //NPWPD
		
		//isi NPWPD
		$spasi2 = ($per3 * 1) / 20;
		$npwpd1 = ($per3 * 1) / 20;
		$npwpd2 = ($per3 * 1) / 20;
		$npwpd3 = ($per3 * 1) / 20;
		$npwpd4 = ($per3 * 1) / 20;
		$npwpd5 = ($per3 * 1) / 20;
		$npwpd6 = ($per3 * 1) / 20;
		$npwpd7 = ($per3 * 1) / 20;
		$npwpd8 = ($per3 * 1) / 20;
		$npwpd9 = ($per3 * 1) / 20;
		$npwpd10 = ($per3 * 1) / 20;
		$npwpd11 = ($per3 * 1) / 20;
		$npwpd12 = ($per3 * 1) / 20;
		$npwpd13 = ($per3 * 1) / 20;
		$this->Ln($this->height-4);
		$this->Cell($jarak+$ttdP1, $this->height, "", 0, 0, 'C');
		$this->Cell($spasi2-4, $this->height, "", 0, 0, 'C'); //spasi npwpd
		$this->Cell($npwpd1, $this->height, "", 1, 0, 'C');
		$this->Cell($spasi2-4, $this->height, "", 0, 0, 'C'); //spasi npwpd
		$this->Cell($npwpd2, $this->height, "", 1, 0, 'C');
		$this->Cell($spasi2-4, $this->height, "", 0, 0, 'C'); //spasi npwpd
		$this->Cell($npwpd3, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd4, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd5, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd6, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd7, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd8, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd9, $this->height, "", 1, 0, 'C');
		$this->Cell($spasi2-4, $this->height, "", 0, 0, 'C'); //spasi npwpd
		$this->Cell($npwpd10, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd11, $this->height, "", 1, 0, 'C');
		$this->Cell($spasi2-4, $this->height, "", 0, 0, 'C'); //spasi npwpd
		$this->Cell($npwpd12, $this->height, "", 1, 0, 'C');
		$this->Cell($npwpd13, $this->height, "", 1, 0, 'C');
		$this->Ln(6);
		
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($lengthCell, $this->height, "", 1, 0, 'C');
		$this->Ln();
		$this->Cell($jarak, $this->height, "", "LTB", 0, 'L');
		$this->Cell($ttdP1, $this->height, "", "TB", 0, 'L');
		$this->Cell($ttdP2, $this->height, "Nama Jelas/NIP :", "TRB", 0, 'L');
		$this->Ln();
		$this->Cell($jarak, $this->height, "", "LTB", 0, 'L');
		$this->Cell($ttdP1, $this->height, "", "TB", 0, 'L');
		$this->Cell($ttdP2, $this->height, "Tanda Tangan", "TRB", 0, 'L');
		
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
$formulir->PageCetak($data,$dataArr,$dataBaru);
$formulir->Output();

?>

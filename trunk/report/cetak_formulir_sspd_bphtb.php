<?php
	define("RelativePath", "..");
	define("PathToCurrentPage", "/report/");
	define("FileName", "cetak_formulir_skpd.php");
	include_once(RelativePath . "/Common.php");
	include_once("../include/fpdf.php");

	$dbConn = new clsDBConnSIKP();

	$t_bphtb_registration_id = CCGetFromGet("t_bphtb_registration_id","");
	//$settlement_type = CCGetFromGet("settlement_type","");

	if(empty($t_bphtb_registration_id)){
		die("masukan t_bphtb_registration_id");
	}

	
	if($t_bphtb_registration_id > 0){
		$sql = "SELECT b.t_bphtb_registration_id, b.t_customer_order_id , 
		b.registration_no,b.wp_name, b.npwp, b.wp_address_name, b.phone_no, 
		b.mobile_phone_no, b.wp_rt, b.wp_rw,
		b.wp_p_region_id, b.wp_p_region_id_kel, b.wp_p_region_id_kec, 
		kota.region_name AS wp_kota_name, 
		kelurahan.region_name AS wp_kelurahan_name, 
		kecamatan.region_name AS wp_kecamatan_name,
		b.njop_pbb, b.object_address_name, b.object_rt, b.object_rw,
		b.object_p_region_id, b.object_p_region_id_kec, b.object_p_region_id_kel, 
		object_kota.region_name AS object_kota_name, 
		object_kelurahan.region_name AS object_kelurahan_name, 
		object_kecamatan.region_name AS object_kecamatan_name,
		b.p_bphtb_legal_doc_type_id, b.bphtb_legal_doc_description, 
		b.land_area, b.building_area, b.land_price_per_m, b.building_price_per_m,
		b.land_total_price, b.building_total_price, b.market_price, b.add_disc_percent,
		(b.land_total_price + b.building_total_price) AS total_price,
		(b.add_disc_percent * b.npop) AS add_discount,
		b.jenis_harga_bphtb, b.npop, b.npop_tkp, b.npop_kp, b.bphtb_amt, 
		b.bphtb_discount, b.description,
		to_char(b.creation_date, 'YYYY-MM-DD') as creation_date,
		b.bphtb_amt_final

		FROM t_bphtb_registration AS b
		LEFT JOIN t_customer_order AS cust_order ON b.t_customer_order_id = cust_order.t_customer_order_id 
		LEFT JOIN p_region AS kota ON b.wp_p_region_id = kota.p_region_id
		LEFT JOIN p_region AS kelurahan ON b.wp_p_region_id_kel = kelurahan.p_region_id
		LEFT JOIN p_region AS kecamatan ON b.wp_p_region_id_kec = kecamatan.p_region_id
		LEFT JOIN p_region AS object_kota ON b.object_p_region_id = object_kota.p_region_id
		LEFT JOIN p_region AS object_kelurahan ON b.object_p_region_id_kec = object_kelurahan.p_region_id
		LEFT JOIN p_region AS object_kecamatan ON b.object_p_region_id_kel = object_kecamatan.p_region_id 
		WHERE b.t_bphtb_registration_id =" . $t_bphtb_registration_id;

	}else{
		die("salah t_bphtb_registration_id");
	}

	$dbConn->query($sql);
	//$items = array();
	$data = array();
	while($dbConn->next_record()){
		$data["t_bphtb_registration_id"] = $dbConn->f("t_bphtb_registration_id");
		$data["t_customer_order_id"] = $dbConn->f("t_customer_order_id");
		$data["registration_no"] = $dbConn->f("registration_no");
		$data["wp_name"] = $dbConn->f("wp_name");
		$data["npwp"] = $dbConn->f("npwp");
		$data["wp_address_name"] = $dbConn->f("wp_address_name");
		$data["phone_no"] = $dbConn->f("phone_no");
		$data["mobile_phone_no"] = $dbConn->f("mobile_phone_no");
		$data["wp_rt"] = $dbConn->f("wp_rt");
		$data["wp_rw"] = $dbConn->f("wp_rw");
		$data["wp_p_region_id"] = $dbConn->f("wp_p_region_id");
		$data["wp_p_region_id_kel"] = $dbConn->f("wp_p_region_id_kel");
		$data["wp_p_region_id_kec"] = $dbConn->f("wp_p_region_id_kec");
		$data["wp_kota_name"] = $dbConn->f("wp_kota_name");
		$data["wp_kelurahan_name"] = $dbConn->f("wp_kelurahan_name");
		$data["wp_kecamatan_name"] = $dbConn->f("wp_kecamatan_name");
		$data["njop_pbb"] = $dbConn->f("njop_pbb");
		$data["object_address_name"] = $dbConn->f("object_address_name");
		$data["object_rt"] = $dbConn->f("object_rt");
		$data["object_rw"] = $dbConn->f("object_rw");
		$data["object_p_region_id"] = $dbConn->f("object_p_region_id");
		$data["object_p_region_id_kec"] = $dbConn->f("object_p_region_id_kec");
		$data["object_p_region_id_kel"] = $dbConn->f("object_p_region_id_kel");
		$data["object_kota_name"] = $dbConn->f("object_kota_name");
		$data["object_kelurahan_name"] = $dbConn->f("object_kelurahan_name");
		$data["object_kecamatan_name"] = $dbConn->f("object_kecamatan_name");
		$data["p_bphtb_legal_doc_type_id"] = $dbConn->f("p_bphtb_legal_doc_type_id");
		$data["bphtb_legal_doc_description"] = $dbConn->f("bphtb_legal_doc_description");
		$data["land_area"] = $dbConn->f("land_area");
		$data["building_area"] = $dbConn->f("building_area");
		$data["land_price_per_m"] = $dbConn->f("land_price_per_m");
		$data["building_price_per_m"] = $dbConn->f("building_price_per_m");
		$data["land_total_price"] = $dbConn->f("land_total_price");
		$data["building_total_price"] = $dbConn->f("building_total_price");
		$data["market_price"] = $dbConn->f("market_price");
		$data["add_disc_percent"] = $dbConn->f("add_disc_percent");
		$data["total_price"] = $dbConn->f("total_price");
		$data["add_discount"] = $dbConn->f("add_discount");
		$data["jenis_harga_bphtb"] = $dbConn->f("jenis_harga_bphtb");
		$data["npop"] = $dbConn->f("npop");
		$data["npop_tkp"] = $dbConn->f("npop_tkp");
		$data["npop_kp"] = $dbConn->f("npop_kp");
		$data["bphtb_amt"] = $dbConn->f("bphtb_amt");
		$data["bphtb_discount"] = $dbConn->f("bphtb_discount");
		$data["description"] = $dbConn->f("description");
		$data["creation_date"] = $dbConn->f("creation_date");
		$data["bphtb_amt_final"] = $dbConn->f("bphtb_amt_final");

		//$items[] = $data;
	}

	$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	var $page_orientation;
	var $page_size;
	var $lengthCell;
	var $paperWSize = 210;
	var $paperHSize = 297;
	//9.5" x 11" = 24.13 x 27.94
	
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
		$this->SetFont('Arial', '', 10);
		
		// $this->Image('../images/logo_pemda.png',12,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader5 = $lheader * 5;
		$lheader6 = $lheader * 6;
		
		$this->Cell($lheader1, $this->height-2, "", "TRL", 0, 'C');
		$this->Cell($lheader2, $this->height-2, "", "T", 0, 'C');
		$this->Cell($lheader3+$lheader1, $this->height-2, "", "TR", 0, 'C');
		$this->Cell($lheader1, $this->height-2, "", "TR", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Image('../images/logo_pemda.png',12,15,20,20);
		$this->Cell($lheader1, $this->height, "", "LR", 0, 'C');			
		$this->SetFont('Arial', '', 9);
		$this->Cell($lheader3+$lheader2+$lheader1, $this->height, "SURAT SETORAN PAJAK DAERAH", "R", 0, 'C');
		$this->Cell($lheader1, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader1, $this->height, "", "LR", 0, 'C');
		$this->SetFont('Arial', '', 9);
		$this->Cell($lheader3+$lheader2+$lheader1, $this->height, "BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN", "R", 0, 'C');
		$this->SetFont('Arial', '', 7);
		$this->Cell($lheader1/2 + 3, $this->height, "Lembar", "", 0, 'R');
		$this->SetFont('Arial', '', 12);
		$this->Cell($lheader1/2 - 3, $this->height, "1", "R", 0, 'L');
		$this->Ln();

		$this->Cell($lheader1, $this->height, "", "LR", 0, 'C');
		$this->SetFont('Arial', '', 12);
		$this->Cell($lheader3+$lheader2+$lheader1, $this->height, "SKPD - BPHTB", "BR", 0, 'C');
		$this->Cell($lheader1, $this->height, "", "R", 0, 'C');
		$this->Ln($this->height-5);
		
		
		// No Urut
		$this->Cell($lheader2 + $lheader4 + $lheader1, $this->height, "", "R", 0, 'C');
		$this->SetFont('Arial', '', 7);
		$this->Cell($lheader1, $this->height, "Untuk Wajib Pajak", "", 0, 'C');
		$this->Ln();
		// =======
		
		/*$this->Cell($lheader2, $this->height + 2, "", "BL", 0, 'R');
		$this->Cell($lheader1, $this->height + 2, "Tahun Pajak ", "B", 0, 'L');
		$this->Cell($lheader3, $this->height + 2, ": ".$data["tahun"], "BR", 0, 'L');
		$this->Cell($lheader2, $this->height + 2, "", "BR", 0, 'C');
		*/
		$this->Cell($lheader1, $this->height, "", "LR", 0, 'C');	
		$this->SetFont('Arial', '', 8);
		$this->Cell($lheader3+$lheader2+$lheader1, $this->height, "BERFUNGSI SEBAGAI SURAT PEMBERITAHUAN OBJEK PAJAK", "R", 0, 'C');
		$this->Cell($lheader1, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		// $this->Cell($lheader3, $this->height + 2, "", "BL", 0, 'R');
		// $this->Cell($lheader3, $this->height + 2, "", "BR", 0, 'L');
		// $this->Cell($lheader2, $this->height + 2, "", "BR", 0, 'C');
		// $this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "BRL", 0, 'C');	
		$this->SetFont('Arial', '', 8);
		$this->Cell($lheader3+$lheader2+$lheader1, $this->height, "PAJAK BUMI DAN BANGUNAN (SPOP PBB)", "BR", 0, 'C');
		$this->Cell($lheader1, $this->height, "", "BR", 0, 'C');
		$this->Ln();

		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$lbodyS = $lbody / 2;

		//$this->Cell(5, $this->height, "", "TL", 0, 'L');
		$this->Cell($lbody1 + $lbody3 , $this->height, "DINAS PENDAPATAN KOTA BANDUNG", "LR", 0, 'L');
		$this->Ln();

		//$this->Cell(5, $this->height, "", "BL", 0, 'L');
		$this->Cell($lbody1 + $lbody3 , $this->height, "PERHATIAN : Bacalah petunjuk pada halaman belakang lembar ini terlebih dahulu", "LBR", 0, 'L');
		$this->Ln();

		//A
		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "A.", "L", 0, 'L');
		$this->Cell($lbodyS , $this->height, "1. Nama", "", 0, 'L');
		$this->Cell($lbody3+$lbodyS- 5, $this->height, ": " . $data["wp_name"], "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbodyS , $this->height, "2. NPWP", "", 0, 'L');
		$this->Cell($lbody3+$lbodyS- 5, $this->height, ": " .$data["npwp"], "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbodyS , $this->height, "3. Alamat", "", 0, 'L');
		$this->Cell($lbody3 + $lbodyS- 5, $this->height, ": " . $data["wp_address_name"], "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbodyS , $this->height, "4. Kelurahan/Desa", "", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2 - 20, $this->height, ": ".$data["wp_kelurahan_name"], "", 0, 'L');
		$this->Cell(30, $this->height, "5. RT/RW : ".$data["wp_rt"]."/".$data["wp_rw"], "", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2 - 10, $this->height, "6. Kecamatan : ".$data["wp_kecamatan_name"], "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "BL", 0, 'L');
		$this->Cell($lbodyS , $this->height, "7. Kabupaten/Kota", "B", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2 - 20, $this->height, ": ".$data["wp_kota_name"], "B", 0, 'L');
		$this->Cell(30, $this->height, "", "B", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2 - 10, $this->height, "8. Kode Pos : -", "BR", 0, 'L');
		$this->Ln();

		//B
		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "B.", "L", 0, 'L');
		$this->Cell($lbody1 , $this->height, "1. Nama Objek Pajak (NOP) PBB", "", 0, 'L');
		$this->Cell($lbody3- 5, $this->height, ": " . $data["njop_pbb"], "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 , $this->height, "2. Letak Tanah dan Bangunan", "", 0, 'L');
		$this->Cell($lbody3- 5, $this->height, ": " .$data["object_address_name"], "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbodyS , $this->height, "3. Kelurahan/Desa", "", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2, $this->height, ": ".$data["object_kelurahan_name"], "", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2, $this->height, "4. RT/RW : ".$data["object_rt"]."/".$data["object_rw"], "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbodyS , $this->height, "5. Kecamatan", "", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2, $this->height, ": ".$data["object_kecamatan_name"], "", 0, 'L');
		$this->Cell(($lbody3+$lbodyS- 5)/2, $this->height, "6. Kabupaten/Kota : ".$data["object_kota_name"], "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 , $this->height, "Perhitungan NJOP PBB", "", 0, 'L');
		$this->Cell($lbody3- 5, $this->height, ":", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 , $this->height + 2.5, "Uraian", "LTR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height, "Luas", "TR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height, "NJOP PBB/m2", "TR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height + 2.5, "Luas x NJOP PBB", "TR", 0, 'C');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln($this->height/2 +1);

		$this->SetFont('Arial', '', 5);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 , $this->height/2, "", "LR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height/2, "(Diisi luas tanah dan atau", "R", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height/2, "(Diisi beradasarkan SPPT PBB tahun", "R", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height/2, "", "R", 0, 'C');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln($this->height/2-1);
		
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 , $this->height/2, "", "LBR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height/2, "bangunan yang haknya diperoleh)", "BR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height/2, "terjadinya perolehan hak / tahun ...)", "BR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height/2, "", "BR", 0, 'C');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln($this->height/2);

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 , $this->height, "Tanah (bumi)", "LBR", 0, 'L');
		$this->Cell(3, $this->height, "7", "BR", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-3, $this->height, number_format($data["land_area"],2,",","."), "BR", 0, 'R');
		$this->Cell(4, $this->height, "9", "BR", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-4, $this->height, "Rp ".number_format($data["land_price_per_m"],2,",","."), "BR", 0, 'R');
		$this->Cell(4, $this->height, "11", "BR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-4, $this->height, "Rp ".number_format($data["land_total_price"],2,",","."), "BR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 , $this->height, "Bangunan", "LBR", 0, 'L');
		$this->Cell(3, $this->height, "8", "BR", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-3, $this->height, number_format($data["building_area"],2,",","."), "BR", 0, 'R');
		$this->Cell(4, $this->height, "10", "BR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-4, $this->height, "Rp ".number_format($data["building_price_per_m"],2,",","."), "BR", 0, 'R');
		$this->Cell(4, $this->height, "12", "BR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-4, $this->height, "Rp ".number_format($data["building_total_price"],2,",","."), "BR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 , $this->height, "", "", 0, 'L');
		$this->Cell(3, $this->height, "", "", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-3, $this->height,"", "", 0, 'R');
		$this->Cell(4, $this->height, "", "", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-4, $this->height, "NJOP PBB :", "", 0, 'C');
		$this->Cell(4, $this->height, "13", "LBR", 0, 'C');
		$this->Cell(($lbody1 + ($lbody3- 10))/4-4, $this->height, "Rp ".number_format($data["total_price"],2,",","."), "BR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(($lbody1 + ($lbody3)), 1, "", "LR", 0, 'L');
		$this->Ln(1);

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3- 10))/4 * 3 / 2 + 10 , $this->height, "15. Jenis perolehan hak atas tanah dan atau bangunan", 0, 'R');
		$this->kotak(1, 30, 1, "");
		$this->kotak(1, 30, 1, "");
		$this->Cell(($lbody1 + ($lbody3- 10))/4 * 3 / 2 - 22.5, $this->height, "14. Harga transaksi, nilai pasar. ", 0, 'R');
		$this->Cell(($lbody1 + ($lbody3- 10))/4, $this->height, "Rp ".number_format($data["market_price"],2,",","."), "BLTR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();
		
		$bigger = $data["market_price"];
		if ( $data["market_price"] < $data["total_price"]) {
			$bigger = $data["total_price"];
		}
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody1 + ($lbody3) - 10), $this->height, "16. Nomor Sertifikat : -", "", 0, 'L');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(($lbody1 + ($lbody3)), 1, "", "LBR", 0, 'L');
		$this->Ln(1);

		//C
		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "C.", "LB", 0, 'L');
		$this->Cell(($lbody3) - 7.5, $this->height, "AKUMULASI PEROLEHAN NILAI SEBELUMNYA", "RB", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"Rp ".number_format($bigger,2,",","."), "B", 0, 'R');
		$this->Cell(5, $this->height,"", "BR", 0, 'L');
		$this->Ln();

		//D
		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "D.", "L", 0, 'L');
		$this->Cell(($lbody3) - 7.5, $this->height, "PENGHITUNGAN BPHTB (hanya diisi berdasarkan penghitungan wajib pajak)", "", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3) - 11, $this->height, "1. Nilai Perolehan Objek Pajak (NPOP) memperhatikan nilai pada B.13, B.14 dan C", "", 0, 'L');
		$this->Cell(3.5, $this->height,"1.", "BLTR", 0, 'C');
		$this->Cell($lbody1 - 2.5, $this->height,"Rp ".number_format($data["npop"],2,",","."), "BLTR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3) - 11, $this->height, "2. Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP) memperhatikan nilai C", "", 0, 'L');
		$this->Cell(3.5, $this->height,"2.", "BLTR", 0, 'C');
		$this->Cell($lbody1 - 2.5, $this->height,"Rp ".number_format($data["npop_tkp"],2,",","."), "BLTR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3) - 31, $this->height, "3. Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)", "", 0, 'L');
		$this->SetFont('Arial', '', 5);
		$this->Cell(20, $this->height, "angka 1 - angka 2", "", 0, 'R');
		$this->SetFont('Arial', '', 8);
		$this->Cell(3.5, $this->height,"3.", "BLTR", 0, 'C');
		$this->Cell($lbody1 - 2.5, $this->height,"Rp ".number_format($data["npop_kp"],2,",","."), "BLTR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3) - 31, $this->height, "4. Bea Perolehan Hak atas Tanah dan Bangunan yang terutang", "", 0, 'L');
		$this->SetFont('Arial', '', 5);
		$this->Cell(20, $this->height, "5% x angka 3", "", 0, 'R');
		$this->SetFont('Arial', '', 8);
		$this->Cell(3.5, $this->height,"4.", "BLTR", 0, 'C');
		$this->Cell($lbody1 - 2.5, $this->height,"Rp ".number_format($data["bphtb_amt"],2,",","."), "BLTR", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(($lbody1 + ($lbody3)), 1, "", "LBR", 0, 'L');
		$this->Ln(1);

		//E
		$this->SetFont('Arial', '', 8);
		$this->Cell(5, $this->height, "E.", "L", 0, 'L');
		$this->Cell(($lbody3) - 7.5, $this->height, "Jumlah Setoran Berdasarkan", "", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 38, 1, "");
		$this->Cell(($lbody3) - 12.5, $this->height, "a. Penghitungan Wajib Pajak", "", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 38, 1, "");
		$this->Cell(($lbody3) - 12.5, $this->height, "b. STPD BPHTB / SKPD ( KURANG BAYAR / SKPD", "", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(5, $this->height,"", "", 0, 'R');
		$this->Cell(($lbody3 - 12.5)/2 + 5, $this->height, "    KURANG BAYAR TAMBAHAN *)", "", 0, 'L');
		$this->Cell(($lbody3 - 12.5)/4 + 20, $this->height, "    Nomor : -", "", 0, 'L');
		$this->Cell(($lbody3 - 12.5)/4 - 25, $this->height, "    Tanggal : -", "", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 38, 1, "");
		$this->Cell(($lbody3 - 12.5)/2 , $this->height, "c. Pengurangan dihitung sendiri menjadi ", "", 0, 'L');
		//$diskon = str_split(sprintf("%03s",$data["add_disc_percent"]*100));
		
		if($data["add_disc_percent"] == 0) {
			$satu = "";
			$dua = "";
			$tiga = 0;
		}

		if($data["add_disc_percent"] == 0.25) {
			$satu = "";
			$dua = 2;
			$tiga = 5;
		}

		if($data["add_disc_percent"] == 0.5) {
			$satu = "";
			$dua = 5;
			$tiga = 0;
		}

		if($data["add_disc_percent"] == 1) {
			$satu = 1;
			$dua = 0;
			$tiga = 0;
		}
				
		$this->kotak(1, 38, 1, $satu);
		$this->kotak(1, 38, 1, $dua);
		$this->kotak(1, 38, 1, $tiga);
		$this->Cell(($lbody3 - 12.5)/4 , $this->height, "% Berdasarkan Peraturan Walikota No. .... Tahun 2012", "", 0, 'L');
		$this->Cell($lbody1 + 14.8, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 38, 1, "");
		$this->Cell(($lbody3) - 12.5, $this->height, "d. ..............................................", "", 0, 'L');
		$this->Cell($lbody1 - 2.5, $this->height,"", "", 0, 'R');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(($lbody1 + ($lbody3)), 1, "", "LBR", 0, 'L');
		$this->Ln(1);

		//F

		$dbConn2 = new clsDBConnSIKP();
		$total = number_format($data["bphtb_amt_final"],0,"","");
		$hrf = "select replace(f_terbilang('". $total . "','rp.'), '  ', ' ') as dengan_huruf";
		$dbConn2->query($hrf);	
		while($dbConn2->next_record()){
			$huruf = $dbConn2->f("dengan_huruf");
		}

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4 + 20, $this->height, "JUMLAH YANG DISETORKAN (dengan angka)", "", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4 * 3 - 20, $this->height,"(dengan huruf)", "", 0, 'L');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4 + 10, $this->height, "Rp ".number_format($data["bphtb_amt_final"],2,",","."), "BLTR", 0, 'R');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4 * 3 - 20, $this->height,$huruf. "rupiah", "BLTR", 0, 'L');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(5, $this->height, "", "L", 0, 'L');
		$this->SetFont('Arial', '', 5);
		$this->Cell(($lbody3 + $lbody1 - 10)/4 + 10, $this->height, "(berdasarkan pehitungan D4 dan perolehan di E)", "", 0, 'C');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Cell(($lbody3 + $lbody1 - 10)/4 * 3 - 20, $this->height,"", "", 0, 'L');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(($lbody1 + ($lbody3)), 1, "", "LBR", 0, 'L');
		$this->Ln(1);

		//G
		$this->Cell(1, $this->height, "", "L", 0, 'L');
		$this->SetFont('Arial', '', 5);
		$this->Cell(($lbody3 + $lbody1 - 10)/4-8, $this->height,"............, tgl ...................", "R", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->SetFont('Arial', '', 8);
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-14, $this->height,"MENGETAHUI :", "", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+14, $this->height,"DITERIMA OLEH :", "", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+8, $this->height,"Telah diverivikasi", "", 0, 'C');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(1, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-8, $this->height,"WAJIB PAJAK / PENYETOR", "R", 0, 'C');
		//$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-10, $this->height,"PPAT / NOTARIS", "", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+10, $this->height,"TEMPAT PEMBAYARAN PBHTB", "", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+10, $this->height,"DINAS PENDAPATAN KOTA BANDUNG", "", 0, 'C');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln(3);

		$this->Cell(1, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-8, $this->height,"", "R", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-10, $this->height,"", "", 0, 'C');
		$this->SetFont('Arial', '', 5);
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+10, $this->height,"Tanggal : .......................", "", 0, 'C');
		$this->SetFont('Arial', '', 8);
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+10, $this->height,"", "", 0, 'C');
		$this->Cell(4, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(1, $this->height, "", "L", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-8, $this->height,"", "R", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-10, $this->height,"", "", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+10, $this->height,"", "", 0, 'C');
		$this->Cell(1, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+10, $this->height,"", "", 0, 'C');
		$this->Cell(4, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(3, $this->height, "", "L", 0, 'L');
		$this->SetFont('Arial', '', 6);
		$this->Cell(($lbody3 + $lbody1 - 10)/4-13, $this->height,$data["wp_name"], "B", 0, 'C');
		$this->Cell(3, $this->height, "", "R", 0, 'R');
		$this->Cell(3, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-14, $this->height,"", "B", 0, 'C');
		$this->Cell(7, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+2, $this->height,"", "B", 0, 'C');
		$this->Cell(9, $this->height, "", "", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+4, $this->height,"", "B", 0, 'C');
		$this->Cell(6, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(3, $this->height, "", "LB", 0, 'L');
		$this->SetFont('Arial', '', 6);
		$this->Cell(($lbody3 + $lbody1 - 10)/4-13, $this->height,"Nama lengkap dan tanda tangan", "B", 0, 'C');
		$this->Cell(3, $this->height, "", "RB", 0, 'R');
		$this->Cell(3, $this->height, "", "B", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4-14, $this->height,"Nama lengkap dan tanda tangan", "B", 0, 'C');
		$this->Cell(7, $this->height, "", "B", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+2, $this->height,"Nama lengkap dan tanda tangan", "B", 0, 'C');
		$this->Cell(9, $this->height, "", "B", 0, 'R');
		$this->Cell(($lbody3 + $lbody1 - 10)/4+4, $this->height,"Nama lengkap dan tanda tangan", "B", 0, 'C');
		$this->Cell(6, $this->height,"", "BR", 0, 'L');
		$this->Ln();
		
		//H
		$this->Cell(2,1, "", "TL", 0, 'L');
		$this->Cell(33, 1,"", "R", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 40), 1,"", "T", 0, 'L');
		$this->Cell(5, 1,"", "TR", 0, 'L');
		$this->Ln(1);

		$this->Cell(2, $this->height, "", "L", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Cell(33, $this->height,"Hanya diisi oleh ", "R", 0, 'L');
		$this->Cell(30, $this->height,"Nomor Dokumen : ", "", 0, 'L');
		$this->kotak(1, 38, 2, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 2, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 4, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 4, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 3, "");
		$this->Cell(40.8, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(2, $this->height, "", "L", 0, 'L');
		$this->Cell(33, $this->height,"", "R", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 40), $this->height,"", "", 0, 'L');
		$this->Cell(5, $this->height,"", "R", 0, 'L');
		$this->Ln(1);

		$this->Cell(2, $this->height, "", "L", 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Cell(33, $this->height,"petugas yang berwenang", "R", 0, 'L');
		$this->Cell(30, $this->height,"NOP PBB baru : ", "", 0, 'L');
		$this->kotak(1, 38, 2, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 2, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 3, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 3, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 3, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 4, "");
		$this->Cell(2, $this->height,"", "R", 0, 'L');
		$this->kotak(1, 38, 1, "");
		$this->Cell(22, $this->height,"", "R", 0, 'L');
		$this->Ln();

		$this->Cell(2,1, "", "BL", 0, 'L');
		$this->Cell(33, 1,"", "BR", 0, 'L');
		$this->Cell(($lbody3 + $lbody1 - 40), 1,"", "B", 0, 'L');
		$this->Cell(5, 1,"", "BR", 0, 'L');
		$this->Ln(1);

	}

	function tulis($text, $align){
		$this->Cell(5, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 10, $this->height, $text, "", 0, $align);
		$this->Cell(5, $this->height, "", "R", 0, 'C');
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

//foreach($items as $data){
	$formulir->PageCetak($data);
//}

// $formulir->Output("skpdkb_jabatan" . date("d F Y") . ".pdf", "D");
$formulir->Output();

?>

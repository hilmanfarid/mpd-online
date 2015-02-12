<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_berita_acara_pemeriksaan_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");
// $t_customer_order_id = 39;
$data = array();

$dbConn = new clsDBConnSIKP();

$query = 	"select a.p_vat_type_dtl_id,a.t_vat_registration_id,c.vat_code,
			a.company_brand, a.brand_address_name, a.brand_address_no, a.wp_name, a.wp_address_name, a.company_name, a.address_name, b.code as job_name, a.bap_employee_no_1, a.bap_employee_name_1, a.bap_employee_no_2, a.bap_employee_name_2, a.bap_employee_job_pos_1, a.bap_employee_job_pos_2 " .
			"from t_vat_registration a " .
			"join p_job_position b " .
			"on a.p_job_position_id = b.p_job_position_id " .
			"left join p_vat_type_dtl c on c.p_vat_type_dtl_id=a.p_vat_type_dtl_id ".
			"where t_customer_order_id = $t_customer_order_id";
//die($query);
$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["wp_name"]				= $dbConn->f("wp_name");
	$data["wp_address_name"]		= $dbConn->f("wp_address_name");
	$data["company_name"]			= $dbConn->f("company_name");
	$data["address_name"]			= $dbConn->f("address_name");
	$data["job_name"]				= $dbConn->f("job_name");
	$data["company_brand"]			= $dbConn->f("company_brand");
	$data["brand_address_name"]		= $dbConn->f("brand_address_name");
	$data["brand_address_no"]		= $dbConn->f("brand_address_no");
	$data["bap_employee_no_1"]		= $dbConn->f("bap_employee_no_1");
	$data["bap_employee_no_2"]		= $dbConn->f("bap_employee_no_2");
	$data["bap_employee_name_1"]	= $dbConn->f("bap_employee_name_1");
	$data["bap_employee_name_2"]	= $dbConn->f("bap_employee_name_2");
	$data["bap_employee_job_pos_1"]	= $dbConn->f("bap_employee_job_pos_1");
	$data["bap_employee_job_pos_2"]	= $dbConn->f("bap_employee_job_pos_2");
	$data["p_vat_type_dtl_id"]	= $dbConn->f("p_vat_type_dtl_id");
	$data["t_vat_registration_id"]	= $dbConn->f("t_vat_registration_id");
	$data["vat_code"]	= $dbConn->f("vat_code");
}

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 206;
	var $paperHSize = 330.2;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P', 'mm', array(203.2,330.2));
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
		
		$this->Image('../images/logo_pemda.png',25,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 12);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 16);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader1, $this->height + 3, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "B", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->SetFont('Arial', 'UB', 12);
		$this->Cell($this->lengthCell, $this->height, "BERITA ACARA PENELITIAN LAPANGAN", "", 0, 'C');
		$this->newLine();
		$this->newLine();
		
		$this->SetFont('Arial', '', 10);
		$this->tulis("Pada hari ini .......... Tanggal ..... Bulan .................... Tahun .........., kami yang bertanda tangan di bawah ini:", "L");
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		// Nama Petugas
		$titik = "........................................................................................................";
		$nama_1 = ($data["bap_employee_name_1"] == "") ? $titik : $data["bap_employee_name_1"];
		$nama_2 = ($data["bap_employee_name_2"] == "") ? $titik : $data["bap_employee_name_2"];
		$no_1 = ($data["bap_employee_no_1"] == "") ? $titik : $data["bap_employee_no_1"];
		$no_2 = ($data["bap_employee_no_2"] == "") ? $titik : $data["bap_employee_no_2"];
		$job_1 = ($data["bap_employee_job_pos_1"] == "") ? $titik : $data["bap_employee_job_pos_1"];
		$job_2 = ($data["bap_employee_job_pos_2"] == "") ? $titik : $data["bap_employee_job_pos_2"];
		
		$this->isi("1.", "Nama", ": " . $nama_1);
		$this->isi("", "NIP", ": " . $no_1);
		$this->isi("", "Jabatan", ": " . $job_1);
		$this->isi("2.", "Nama", ": " . $nama_2);
		$this->isi("", "NIP", ": " . $no_2);
		$this->isi("", "Jabatan", ": " . $job_2);

		// Body
		$this->newLine();
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(5, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2 * 2 - 25, $this->height, "Telah melakukan penelitian lapangan atas:", "", 0, 'L');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->isi("1", "Nama Pemohon NPWPD", ": " . $data["wp_name"]);
		//alamat wp
		$this->SetWidths(array(10, 5, $lbody1, $lbody3 - 25, 10));
		$this->SetAligns(array("L", "L", "L", "L", "L"));
		$this->RowMultiBorderWithHeight(array(
			"",
			"2.",
			"Alamat Pemohon NPWPD",
			": " . $data["wp_address_name"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
			
		$this->isi("3.", "Nama Perusahaan", ": " . $data["company_name"]);
		
		//alamat perusahaan
		$this->SetWidths(array(10, 5, $lbody1, $lbody3 - 25, 10));
		$this->SetAligns(array("L", "L", "L", "L", "L"));
		$this->RowMultiBorderWithHeight(array(
			"",
			"4.",
			"Alamat Perusahaan",
			": " . $data["address_name"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);

		$this->RowMultiBorderWithHeight(array(
			"",
			"5.",
			"Nama Merek Dagang",
			": " . $data["company_brand"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
		
		$this->RowMultiBorderWithHeight(array(
			"",
			"6.",
			"Alamat Lokasi Usaha",
			": " . $data["brand_address_name"] . " " . $data["brand_address_no"],
			""
			)
			,
			array(
			"",
			"",
			"",
			"",
			""
			)
			,
			$this->height);
		

		$this->newLine();
		$this->isi_full("Dalam penelitian lapangan tersebut di atas telah ditemukan hal-hal sebagai berikut:");
		
		$data_pajak = array();
		$dbConn = new clsDBConnSIKP();
		$query = 	"select * from p_vat_type_dtl where p_vat_type_dtl_id =  " . $data["p_vat_type_dtl_id"];

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data_pajak["p_vat_type_id"]		= $dbConn->f("p_vat_type_id");
		}
		$dbConn->close();
		
		if ($data_pajak["p_vat_type_id"]==1){
			$sePerLima = ($this->lengthCell -20) /5;
			
			$this->SetWidths(array(10,$sePerLima, $sePerLima, $sePerLima, $sePerLima, $sePerLima));
			$this->SetAligns(array("C", "C", "C", "C", "C","C"));
			//$this->SetvAligns(array("M", "M", "M", "M", "M","M"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Kelas Hotel",
				"Golongan Kamar",
				"Jumlah Kamar",
				"Frekuensi Pengguna Layanan",
				"Tarif kamar"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			/*$data_detail = array();
			$dbConn = new clsDBConnSIKP();
			$query = 	"select code,room_qty,service_qty,service_charge_wd,service_charge_we from t_vat_reg_dtl_hotel a
					left join p_room_type x on a.p_room_type_id=x.p_room_type_id
					where t_vat_registration_id = ".$data["t_vat_registration_id"];

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data_detail["code"]		= $dbConn->f("code");
				$data_detail["room_qty"]		= $dbConn->f("room_qty");
				$data_detail["service_qty"]		= $dbConn->f("service_qty");
				$data_detail["service_charge_wd"]		= $dbConn->f("service_charge_wd");
				$data_detail["service_charge_we"]		= $dbConn->f("service_charge_we");
				
				$this->RowMultiBorderWithHeight(array(
					"",
					ucwords(strtolower($data["vat_code"])),
					ucwords(strtolower($data_detail["code"])),
					$data_detail["room_qty"],
					$data_detail["service_qty"],
					number_format($data_detail["service_charge_wd"],2,",",".")." (weekday), ".number_format($data_detail["service_charge_we"],2,",",".")." (weekend)"
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					$this->height);
			}*/
			$this->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$this->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			$dbConn->close();
			
			
			$this->SetWidths(array(10,40, ($this->lengthCell-60)));
			$this->SetAligns(array("L", "L", "L"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		
		if ($data_pajak["p_vat_type_id"]==2){
			$sePerEnam = ($this->lengthCell -20) /6;
			
			$this->SetWidths(array(10,$sePerEnam, $sePerEnam, $sePerEnam, $sePerEnam, $sePerEnam,$sePerEnam));
			$this->SetAligns(array("C", "C", "C", "C", "C","C","C"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Jenis Pelayanan Restoran",
				"Jumlah Meja dan Kursi",
				"Harga Makanan Terendah & Tertinggi",
				"Harga Minuman Terendah & Tertinggi",
				"Daya Tampung",
				"Jumlah Pengunjung Rata-rata Perbulan"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			/*$data_detail = array();
			$dbConn = new clsDBConnSIKP();
			$query = 	"select * from t_vat_reg_dtl_restaurant
					where t_vat_registration_id = ".$data["t_vat_registration_id"];

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data_detail["seat_qty"]		= $dbConn->f("seat_qty");
				$data_detail["table_qty"]		= $dbConn->f("table_qty");
				$data_detail["max_service_qty"]		= $dbConn->f("max_service_qty");
				$data_detail["avg_subscription"]		= $dbConn->f("avg_subscription");
				$data_detail["service_type_desc"]		= $dbConn->f("service_type_desc");
				
				$this->RowMultiBorderWithHeight(array(
					"",
					ucwords(strtolower($data_detail["service_type_desc"])),
					$data_detail["table_qty"]	." meja dan ".$data_detail["seat_qty"]." kursi",
					"",
					"",
					$data_detail["max_service_qty"],
					number_format($data_detail["avg_subscription"],0,",",".")
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					$this->height);
			}*/
			$this->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$this->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			
			$dbConn->close();
			
			
			$this->SetWidths(array(10,40, ($this->lengthCell-60)));
			$this->SetAligns(array("L", "L", "L"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		if ($data_pajak["p_vat_type_id"]==3){
			$sePerDelapan = ($this->lengthCell -20) /8;
			
			$this->SetWidths(array(10,$sePerDelapan, $sePerDelapan, $sePerDelapan+5, $sePerDelapan-5, $sePerDelapan,$sePerDelapan,$sePerDelapan,$sePerDelapan));
			$this->SetAligns(array("C", "C", "C", "C", "C","C","C","C","C"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Jenis Hiburan",
				"Cover Charge / HTM / Tarif",
				"Jumlah Lembar Meja / Kursi",
				"Jumlah Room",
				"Jumlah PL Pramuria / Pemijat",
				"Booking / Jam",
				"F / B",
				"Porsi / Orang"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			/*$data_detail = array();
			$dbConn = new clsDBConnSIKP();
			$query = 	"select * from t_vat_reg_dtl_entertaintment
					where t_vat_registration_id = ".$data["t_vat_registration_id"];

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data_detail["seat_qty"]		= $dbConn->f("seat_qty");
				$data_detail["room_qty"]		= $dbConn->f("room_qty");
				$data_detail["clerk_qty"]		= $dbConn->f("clerk_qty");
				$data_detail["booking_hour"]		= $dbConn->f("booking_hour");
				$data_detail["f_and_b"]		= $dbConn->f("f_and_b");
				$data_detail["portion_person"]		= $dbConn->f("portion_person");
				$data_detail["entertainment_desc"]		= $dbConn->f("entertainment_desc");
				$data_detail["service_charge_wd"]		= $dbConn->f("service_charge_wd");
				$data_detail["service_charge_we"]		= $dbConn->f("service_charge_we");
				
				$this->RowMultiBorderWithHeight(array(
					"",
					ucwords(strtolower($data_detail["entertainment_desc"])),
					number_format($data_detail["service_charge_wd"],2,",",".")." (weekday), ".number_format($data_detail["service_charge_we"],2,",",".")." (weekend)",
					$data_detail["seat_qty"],
					$data_detail["room_qty"],
					$data_detail["clerk_qty"],
					$data_detail["booking_hour"],
					$data_detail["f_and_b"],
					$data_detail["portion_person"]
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					$this->height);
			}*/
			$this->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$this->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			
			$dbConn->close();
			
			
			$this->SetWidths(array(10,40, ($this->lengthCell-60)));
			$this->SetAligns(array("L", "L", "L"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		if ($data_pajak["p_vat_type_id"]==4){
			$sePerEmpat = ($this->lengthCell -20) /4;
			
			$this->SetWidths(array(10,$sePerEmpat, $sePerEmpat, $sePerEmpat, $sePerEmpat));
			$this->SetAligns(array("C", "C", "C", "C", "C"));
			//$this->SetvAligns(array("M", "M", "M", "M", "M","M"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Klasifikasi Tempat Parkir",
				"Luas Lahan Parkir",
				"Daya Tampung Kendaraan Bermotor",
				"Frekuensi Kendaraan Bermotor"
				)
				,
				array(
				"",
				"BLTR",
				"BLTR",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
			
			/*$data_detail = array();
			$dbConn = new clsDBConnSIKP();
			$query = 	"select * from t_vat_reg_dtl_parking
					where t_vat_registration_id = ".$data["t_vat_registration_id"];

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data_detail["classification_desc"]		= $dbConn->f("classification_desc");
				$data_detail["parking_size"]		= $dbConn->f("parking_size");
				$data_detail["max_load_qty"]		= $dbConn->f("max_load_qty");
				$data_detail["avg_subscription_qty"]		= $dbConn->f("avg_subscription_qty");
				
				$this->SetAligns(array("C", "C", "C", "C", "R"));
				$this->RowMultiBorderWithHeight(array(
					"",
					ucwords(strtolower($data_detail["classification_desc"])),
					$data_detail["parking_size"],
					$data_detail["max_load_qty"],
					$data_detail["avg_subscription_qty"]
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					$this->height);
			}*/
			$this->RowMultiBorderWithHeight(array(
					"",
					"",
					"",
					"",
					""
					)
					,
					array(
					"",
					"LR",
					"LR",
					"LR",
					"LR"
					)
					,
					25);
			$this->RowMultiBorderWithHeight(array(
				"",
				"",
				"",
				"",
				""
				)
				,
				array(
				"",
				"T",
				"T",
				"T",
				"T"
				)
				,
				$this->height);
			$dbConn->close();
			
			
			$this->SetWidths(array(10,40, ($this->lengthCell-60)));
			$this->SetAligns(array("L", "L", "L"));
			$this->RowMultiBorderWithHeight(array(
				"",
				"Tanggal Operasional",
				""
				)
				,
				array(
				"",
				"BLTR",
				"BLTR"
				)
				,
				$this->height);
		}
		
		$this->Ln();			
		$this->isi_full("Demikian Berita Acara Penelitian Lapangan ini dibuat dengan sebenar-benarnya.");
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		//$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Menyetujui,", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Pemohon NPWPD", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Petugas Pendata 1,", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody2, $this->height, "Nama Jelas:", "", 0, 'L');
		$this->ln(4);
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, $data["wp_name"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, $data["bap_employee_name_1"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, "", "T", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. " . $data["bap_employee_no_1"], "T", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "Jabatan:", "", 0, 'L');
		$this->ln(4);
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, $data["job_name"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, "(Tanda Tangan dan Cap Perusahaan)", "T", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Petugas Pendata 2,", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, $data["bap_employee_name_2"], "", 0, 'C');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();

		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. " . $data["bap_employee_no_2"], "T", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		/*$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');*/
	}
	
	function isi($no, $field, $content){
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(5, $this->height, "$no", "", 0, 'L');
		$this->Cell($lbody1, $this->height, "$field", "", 0, 'L');
		$this->Cell($lbody3 - 25, $this->height, "$content", "", 0, 'L');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function isi_full($content){
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell(5, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2 * 2 - 25, $this->height, "$content", "", 0, 'L');
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "", 0, 'C');
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
$formulir->PageCetak($data);
$formulir->Output();

?>

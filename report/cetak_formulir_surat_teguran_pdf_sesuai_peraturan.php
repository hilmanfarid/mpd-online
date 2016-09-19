<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");
include_once("../include/qrcode/generate-qr-file.php");


$dbConn = new clsDBConnSIKP();

//$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");
$p_year_period_id = CCGetFromGet("p_year_period_id", "");
$p_finance_period_id = CCGetFromGet("p_finance_period_id", "");
$p_vat_type_id = CCGetFromGet("p_vat_type_id", "");
$ttd = CCGetFromGet("ttd", 1);
if(empty($p_vat_type_id)){
	$p_vat_type_id = 0;
}

$query ="select * from t_debt_letter where sequence_no = 3 and p_finance_period_id = ".$p_finance_period_id;
//echo $query;exit;
$dbConn->query($query);
$dbConn->next_record();
$t_customer_order_id = $dbConn->f("t_customer_order_id");

//$t_customer_order_id = 67;
//$dataArr = array();
// $dataBaru = array();

if(empty($t_customer_order_id)){
	echo "data tidak ada";
	exit();
}else{

//nip & nama
	$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin "
		  ."FROM p_global_param "
		  ."WHERE code = 'TTD KADIN'";
		  
	$dbConn->query($ttd);
	
	$nama_kadin = "";
	$nip_kadin = "";

	while($dbConn->next_record()){
		$nama_kadin = $dbConn->f("nama_kadin");
		$nip_kadin = $dbConn->f("nip_kadin");
	}

$query ="select to_char(start_date - interval '1 month','dd-mm-yyyy') as start_date,
		to_char(end_date- interval '1 month','dd-mm-yyyy') as end_date 
		from p_year_period where p_year_period_id = ".$p_year_period_id;
//echo $query;exit;
$dbConn->query($query);
$dbConn->next_record();
$start_year = $dbConn->f("start_date");
$end_year = $dbConn->f("end_date");

$query="select to_char(letter_date,'dd-mm-yyyy') as letter_date_short,c.region_name as kota,* from f_debt_letter_print2(".$t_customer_order_id.") AS tbl (ty_debt_letter_list)
		LEFT JOIN t_cust_account as b ON tbl.t_cust_account_id = b.t_cust_account_id
		left join p_region as c on b.brand_p_region_id = c.p_region_id
		WHERE b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)
			AND B.p_account_status_id = 1
			and case 
					when ".$p_vat_type_id." = 0 then true
					else b.p_vat_type_id = ".$p_vat_type_id."
				end
			and EXISTS (select 1
				from t_vat_setllement x 
				left join t_payment_receipt y on x.t_vat_setllement_id = y.t_vat_setllement_id
				where x.t_cust_account_id = tbl.t_cust_account_id
				and y.t_payment_receipt_id is NULL
				and x.p_settlement_type_id = 4
				and x.start_period between 
					to_date('".$start_year."','dd-mm-yyyy') and to_date('".$end_year."','dd-mm-yyyy')
				)
		order by p_vat_type_id,company_brand";
//echo $query;exit;
$dbConn->query($query);
$data=array();
while ($dbConn->next_record()) {
		$data[]= array(
			'npwd' => $dbConn->f("npwd"),
			't_cust_account_id' => $dbConn->f("t_cust_account_id"),
			//'company_name' => $dbConn->f("company_name"),
			//'address' => $dbConn->f("address"),
			'company_name' => $dbConn->f("company_brand"),
			'address' => $dbConn->f("brand_address_name").' '.$dbConn->f("brand_address_no"),
			'letter_no' => $dbConn->f("letter_no"),
			'vat_code' => $dbConn->f("vat_code"),
			'periode' => $dbConn->f("periode"),
			'tap_no' => $dbConn->f("tap_no"),
			'tap_date' => $dbConn->f("tap_date"),
			'due_date' => $dbConn->f("due_date"),
			'debt_amount' => $dbConn->f("debt_amount"),
			'terbilang' =>  $dbConn->f("terbilang"),
			'debt_period_code' =>  $dbConn->f("debt_period_code"),
			'sequence_no' => $dbConn->f("sequence_no"),
			'letter_date_txt' => $dbConn->f("letter_date_txt"),
			'letter_date' => $dbConn->f("letter_date_short"),
			'kota' => $dbConn->f("kota"),
			'nama_kadin' => $nama_kadin,
			'nip_kadin' => $nip_kadin
		);
}

	
$dbConn->close();
}

//$path = '';
//generate_qr($param,$path);

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 241.3;
	var $paperHSize = 279.4;
	var $height = 4;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
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
	
	function PageCetak($data,$no_urut,$start_year,$end_year) {
		$this->AliasNbPages();
		$this->SetLeftMargin(10);
		$this->SetTopMargin(2);
		$this->AddPage("P");
		$this->AddFont('BKANT');
		
		$this->SetFont('BKANT', '', 12);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		/*
		//header
		$this->Image('../images/logo_pemda.png',25,3,25,25);
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "TR", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 12);
		$this->Cell($lheader1, 8, "", "L", 0, 'L');
		$this->Cell($lheader7, 8, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->Ln(8);
		
		$this->SetFont('Arial', 'B', 16);
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader1, $this->height + 3, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "RB", 0, 'C');
		$this->Ln();
		//end header
		*/
		
		// header kosong
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 12);
		$this->Cell($lheader1, 8, "", "", 0, 'L');
		$this->Cell($lheader7, 8, "", "", 0, 'C');
		$this->Ln(8);
		
		$this->SetFont('Arial', 'B', 16);
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader1, $this->height + 3, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "", 0, 'C');
		$this->Ln();
		//end header kosong
		
		$this->Cell($lheader1, $this->height, "", "", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "", 0, 'C');
		$this->Ln(1);
		
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, 'L');
		$this->Ln();
		
		$this->SetFont('BKANT', '', 10);
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(10, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lbody1 - 10, $this->height + 2, "NPWPD", "", 0, 'L');
		$this->Cell($lbody1, $this->height + 2, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1 + 3, $this->height, ":", "L", 0, 'R');
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
		$this->kotak(1, 34, 1,$arr1[9]);
		$this->kotak(1, 34, 1,$arr1[10]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[11]);
		$this->kotak(1, 34, 1,$arr1[12]);
		$this->Ln(9);

		$this->SetWidths(array(20,2,$this->lengthCell-22));
		$this->SetAligns(array("L","L","L"));
		$posy = $this->getY();
				
		$this->setY($posy-3);
		$today = getdate();
		$lkepada = $this->lengthCell / 5;
		$lkepada2 = $lkepada * 2;
		$lkepada3 = $lkepada * 3;
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		//$this->Cell($lkepada2, $this->height, "Bandung, ".$data['letter_date_txt'], "R", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "R", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Kepada Yth,", "R", 0, 'L');
		$this->Ln();

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array($lkepada3,22,2,63.7));
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
			$this->height
		);
		
		/*$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array($lkepada3,22,2,63.7));
		$this->RowMultiBorderWithHeight(
			array("",
				"NPWPD",
				":",
				$data['npwd']
			),
			array("L",
				"",
				"",
				"R"
			),
			$this->height/2
		);*/
		
		$this->SetWidths(array($lkepada3,$lkepada2));
		$this->SetAligns(array("L","L"));
		$this->RowMultiBorderWithHeight(
			array("",
				$data["address"]
			),
			array("L",
				"R"
			),
			$this->height
		);
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Di ", "R", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, $data['kota'], "R", 0, 'L');
		$this->Ln();
		
		// $this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		// $this->Cell($lkepada2, $this->height, "", "R", 0, 'C');
		// $this->Ln();
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BKANT', 'U', 10);
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
		// $this->newLine();
		$this->Cell($this->lengthCell, $this->height, "SURAT TEGURAN", "LR", 0, 'C');
		$this->Ln();
		$this->SetFont('BKANT', '', 10);
		$data["letter_no"]=trim($data["letter_no"]);
		//echo $data["letter_no"];exit;
		if ($data["letter_no"]==""){
			$this->Cell($this->lengthCell, $this->height, "Nomor : ..........................................", "LR", 0, 'C');
		}else{
			$this->Cell($this->lengthCell, $this->height, "Nomor : ".$data["letter_no"], "LR", 0, 'C');
		}
		$this->newLine();
		
		$this->SetFont('BKANT', '', 10);
		/*$this->Cell($this->lengthCell, $this->height, "Nomor: ".$data["letter_no"], "LR", 0, 'C');
		$this->newLine();*/
		$this->SetWidths(array(10,204.3, 5));
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
		$ltable = ($this->lengthCell - 15) / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;
		
		$dbConn = new clsDBConnSIKP();
		$query="select to_char(start_period,'dd-mm-yyyy') ||' s.d. '||to_char(end_period,'dd-mm-yyyy') as masa_pajak,  
				c.code,to_char(a.due_date,'dd-mm-yyyy') as due_date_short, 
				round(nvl(total_vat_amount,0) + nvl(total_penalty_amount,0)) as piutang,
				d.order_no,
				to_char(a.settlement_date,'dd-mm-yyyy') as tgl_ketetapan
				from t_vat_setllement a 
				left join t_payment_receipt b on a.t_vat_setllement_id = b.t_vat_setllement_id
				left join p_settlement_type c on c.p_settlement_type_id = a.p_settlement_type_id
				left join t_customer_order d on d.t_customer_order_id = a.t_customer_order_id
				where a.t_cust_account_id = ".$data["t_cust_account_id"]." 
				and b.t_payment_receipt_id is NULL
				and a.p_settlement_type_id = 4
				and a.start_period between 
					to_date('".$start_year."','dd-mm-yyyy') and to_date('".$end_year."','dd-mm-yyyy')
				ORDER BY start_period ";
		//echo $query;exit;
		$dbConn->query($query);
		$data_piutang=array();
		while ($dbConn->next_record()) {
				$data_piutang[]= array(
					'masa_pajak' => $dbConn->f("masa_pajak"),
					'code' => $dbConn->f("code"),
					'due_date' => $dbConn->f("due_date_short"),
					'order_no' => $dbConn->f("order_no"),
					'tgl_ketetapan' => $dbConn->f("tgl_ketetapan"),
					'piutang' => $dbConn->f("piutang")
				);
		}
		$dbConn->close();
			
		
		$this->SetWidths(array(10, $ltable2+5, $ltable4-5, $ltable3, $ltable2, $ltable3, 5));
		$this->SetAligns(array("L",  "C", "C", "C", "C", "C","L"));
		
		$title_kolom4 = 'SPTPD';
		$title_kolom5 = 'Tgl. Setor';

		if( $data["sequence_no"] == 3) {
			$title_kolom4 = 'No dan Tanggal SKPDKB';
			$title_kolom5 = 'Jumlah Tunggakan';
		}

		$this->RowMultiBorderWithHeight(
			array("",
				"Jenis Pajak",
				"Masa Pajak",
				$title_kolom4,
				"Tanggal Jatuh Tempo",
				$title_kolom5,
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
		
		
		//$this->SetWidths(array(10, $ltable4, $ltable2+ $ltable2, $ltable3, 5));
		$this->SetAligns(array("L",  "C", "C", "C", "C", "R","L"));
		$tahun = explode(" ",$data["periode"]);

		$bulan_periode = explode(",",$data['debt_period_code']);
		$bulan_string='';
		$i=0;
		foreach($bulan_periode as $item ){
			$bulan = explode(" ",$item);
			$bulan_string.= $bulan[0];
			$i++;
			if(!empty($bulan_periode[$i])){
				$bulan_string.="\n";
			}
		}

		$total_piutang = 0;
		if( $data["sequence_no"] == 3) {
			foreach($data_piutang as $item ){
				$this->RowMultiBorderWithHeight(
					array("",
						$data["vat_code"],
						$item["masa_pajak"],
						$item["order_no"].' - '.$item["tgl_ketetapan"],
						$item["due_date"],
						number_format($item["piutang"],0,",","."),
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
				$total_piutang += $item["piutang"];
			}
			$this->RowMultiBorderWithHeight(
				array("",
					"",
					"",
					"",
					"",
					number_format($total_piutang,0,",","."),
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
		} else {
			$this->SetAligns(array("L",  "C", "C", "C", "C", "C","L"));
			$this->RowMultiBorderWithHeight(
				array("",
					$data["vat_code"],
					$bulan_string.' '.$tahun[1],
					$data["tap_no"],
					"-",
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
		}
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$data["terbilang"]=trim($data["terbilang"]);
		$this->Cell(20, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 20,"", "", 0, 'L');	
		$this->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$dbConn = new clsDBConnSIKP();
		$query="select trim(f_terbilang) as terbilang 
				from f_terbilang('".$total_piutang."','') ";
		//echo $query;exit;
		$dbConn->query($query);
		$dbConn->next_record();
		$terbilang = $dbConn->f("terbilang");
		$dbConn->close();
		if ($total_piutang!=0){
			$this->SetWidths(array(10,$this->lengthCell-20,10));
			$this->SetAligns(array("L","J","L"));
			$this->RowMultiBorderWithHeight(
				array("",
					"Dengan huruf : (".$terbilang.")",
					""
				),
				array("L",
					"",
					"R"
				),
				$this->height
			);		
		}
		
		$this->SetWidths(array(10,$this->lengthCell-20,10));
		$this->SetAligns(array("L","J","L"));
		$this->RowMultiBorderWithHeight(
			array("",
				"\nUntuk    mencegah    tindakan    penagihan    dengan    Surat    Paksa    berdasarkan    Peraturan    Daerah    Kota    Bandung ".
				"Nomor 20 Tahun 2011 tentang Pajak Daerah, maka diminta kepada Saudara agar melunasi jumlah tunggakan dimaksud ".
				"paling lambat 7 (tujuh) hari setelah diterimanya Surat Teguran ini. Lewat batas waktu tersebut tindakan ".
				"penagihan akan dilanjutkan dengan penyerahan Surat Paksa.",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);
		
		$this->RowMultiBorderWithHeight(
			array("",
				"\nDalam hal saudara telah melunasi Tunggakan di atas, diminta agat Saudara segera melapor kepada Seksi Penyelesaian ".
				"Piutang pada Bidang Pajak Pendaftaran Dinas Pelayanan Pajak Kota Bandung (dengan membawa bukti pembayaran).",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);
		/*$this->tulis("Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Peraturan Daerah Kota Bandung", "FJ");
		$this->tulis("2009 dan Peraturan Daerah Nomor 20 Tahun 2011 Ps 70, maka diminta kepada Saudara agar melunasi", "FJ");
		$this->tulis("jumlah tunggakan dalam waktu 7 (tujuh) hari setelah Surat Teguran ini. Setelah batas waktu tersebut", "FJ");
		$this->tulis("tindakan penagihan akan ditindaklanjuti dengan penyerahan Surat Paksa.", "L");
		$this->tulis("", "L");
		$this->tulis("Apabila saudara telah melaksanakan pembayaran pajak tersebut, kami mohon untuk dapat memperlihatkan", "FJ");
		$this->tulis("SSPD yang telah divalidasi dengan melampirkan photo copy dokumen yang dimaksud.", "L");
		$this->tulis("", "L");
		$this->tulis("Demikian agar menjadi maklum, atas perhatian dan kerjasamanya kami ucapkan terima kasih.", "L");
		*/
		
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		// $this->Ln();
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		// $this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;
		
		//setting ttd
		$ttd = CCGetFromGet("ttd", 1);
		if ($ttd == 1){
			$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.
			str_replace(" ","_",$data['company_name'])."-".
			$data["npwd"]
			,160,153+sizeof($data_piutang)*4,25,25,'PNG');
		}

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4, $this->height, "Bandung, " .$data['letter_date_txt'] /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, ............................................" /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "KEPALA DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
/*		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();*/

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();

		//$this->Image('../images/ttd_pa_gun_gun.jpg',$lbody2+$lbody4+$lbody4-20,168,$lbody4+48,20);
		//$this->Image('../images/ttd_pa_soni.jpg',$lbody2+$lbody4+$lbody4-20,168,$lbody4+48,20);

		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4-5, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4+10, $this->height, "", "", 0, 'C');
		$this->Cell($lbody2-5, $this->height, "", "R", 0, 'C');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4-5, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4+10, $this->height, "Drs. PRIANA WIRASAPUTRA, MM.", "B", 0, 'C');
		//$this->Cell($lbody4+10, $this->height, "H. SONI BAKHTIAR, S.Sos, M.Si.", "B", 0, 'C');
		$this->Cell($lbody4+10, $this->height, "Drs. H. EMA SUMARNA, M. Si", "B", 0, 'C');
		$this->Cell($lbody2-5, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4 - 2, $this->height, "NIP. 19600308 198503 1 007", "", 0, 'C'); //isi nip
		//$this->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
		$this->Cell($lbody4 - 2, $this->height, "NIP. 19661207 198603 1 006", "", 0, 'C'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "BL", 0, 'L');
		//$this->Cell($this->lengthCell - 10, $this->height, "*) Coret yang tidak perlu", "BR", 0, 'L');
		$this->Cell($this->lengthCell - 10, $this->height, "", "BR", 0, 'L');
	}

	function CellFJ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='')
	{
		$k=$this->k;
		if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
		{
			$x=$this->x;
			$ws=$this->ws;
			if($ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->AddPage($this->CurOrientation);
			$this->x=$x;
			if($ws>0)
			{
				$this->ws=$ws;
				$this->_out(sprintf('%.3f Tw', $ws*$k));
			}
		}
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$s='';
		if($fill==1 or $border==1)
		{
			if($fill==1)
				$op=($border==1) ? 'B' : 'f';
			else
				$op='S';
			$s=sprintf('%.2f %.2f %.2f %.2f re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
		}
		if(is_string($border))
		{
			$x=$this->x;
			$y=$this->y;
			if(is_int(strpos($border, 'L')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'T')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);
			if(is_int(strpos($border, 'R')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'B')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
		}
		if($txt!='')
		{
			if($align=='R')
				$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
			elseif($align=='C')
				$dx=($w-$this->GetStringWidth($txt))/2;
			elseif($align=='FJ')
			{
				//Set word spacing
				$wmax=($w-2*$this->cMargin);
				$this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt, ' ');
				$this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
				$dx=$this->cMargin;
			}
			else
				$dx=$this->cMargin;
			$txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
			if($this->ColorFlag)
				$s.='q '.$this->TextColor.' ';
			$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET', ($this->x+$dx)*$k, ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k, $txt);
			if($this->underline)
				$s.=' '.$this->_dounderline($this->x+$dx, $this->y+.5*$h+.3*$this->FontSize, $txt);
			if($this->ColorFlag)
				$s.=' Q';
			if($link)
			{
				if($align=='FJ')
					$wlink=$wmax;
				else
					$wlink=$this->GetStringWidth($txt);
				$this->Link($this->x+$dx, $this->y+.5*$h-.5*$this->FontSize, $wlink, $this->FontSize, $link);
			}
		}
		if($s)
			$this->_out($s);
		if($align=='FJ')
		{
			//Remove word spacing
			$this->_out('0 Tw');
			$this->ws=0;
		}
		$this->lasth=$h;
		if($ln>0)
		{
			$this->y+=$h;
			if($ln==1)
				$this->x=$this->lMargin;
		}
		else
			$this->x+=$w;
	}

	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->CellFJ(204.3, $this->height, $text, "", 0, $align);
		$this->Cell(5, $this->height, "", "R", 0, 'C');
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


// A function to return the Roman Numeral, given an integer
 function numberToRoman($num)
 {
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value)
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
 }


$formulir = new FormCetak();
$no_urut=0;
foreach($data as $item){
	$formulir->PageCetak($item,$no_urut,$start_year,$end_year);
	$no_urut++;
}
$formulir->Output();

?>

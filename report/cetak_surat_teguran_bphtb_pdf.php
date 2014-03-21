<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_surat_teguran_bphtb_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_bphtb_registration_id = CCGetFromGet("t_bphtb_registration_id", "");
$date_start = CCGetFromGet("date_start", "");
$date_end = CCGetFromGet("date_end", "");

$param_arr = array();
$param_arr['date_start'] = $date_start;
$param_arr['date_end'] = $date_end;

$dbConn	= new clsDBConnSIKP();
						
$whereClause='';
if(!empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
	$whereClause.= " AND (trunc(reg_bphtb.creation_date) BETWEEN '".$param_arr['date_start']."'";
	$whereClause.= " AND '".$param_arr['date_end']."')";
}else if(!empty($param_arr['date_start'])&&empty($param_arr['date_end'])){
	$whereClause.= " AND trunc(reg_bphtb.creation_date) >= '".$param_arr['date_start']."'";
}else if(empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
	$whereClause.= " AND trunc(reg_bphtb.creation_date) <= '".$param_arr['date_end']."'";
}

$whereClause.= " AND ( payment.receipt_no is null or payment.receipt_no = '') ";

$query = "SELECT
	reg_bphtb.t_bphtb_registration_id,
	reg_bphtb.npwp,
	reg_bphtb.wp_address_name,
	to_char(reg_bphtb.creation_date, 'YYYY-MM-DD') as creation_date,
	registration_no,
	wp_name,
	reg_bphtb.p_bphtb_legal_doc_type_id,
	bphtb_doc.description,
	njop_pbb,
	land_area,
	land_total_price,
	building_area,
	building_total_price,
	market_price,
	bphtb_amt_final
FROM
	sikp.t_bphtb_registration reg_bphtb
LEFT JOIN p_bphtb_legal_doc_type bphtb_doc on bphtb_doc.p_bphtb_legal_doc_type_id = reg_bphtb.p_bphtb_legal_doc_type_id
LEFT JOIN t_customer_order cust_order ON cust_order.t_customer_order_id = reg_bphtb.t_customer_order_id 
LEFT JOIN t_payment_receipt_bphtb payment ON reg_bphtb.t_bphtb_registration_id = payment.t_bphtb_registration_id 
WHERE cust_order.p_order_status_id <> 1";
$query.= $whereClause;

if(!empty($t_bphtb_registration_id)) {
	$query.= " AND reg_bphtb.t_bphtb_registration_id = ".$t_bphtb_registration_id;
}

$query.= " order by trunc(reg_bphtb.creation_date) ASC,upper(wp_name) ASC";
$dbConn->query($query);

$data = array();
while ($dbConn->next_record()) {
	$data[] = array (
	    'creation_date' => $dbConn->f("creation_date"), 	
		'npwp' => $dbConn->f("npwp"), 	
		'wp_address_name' => $dbConn->f("wp_address_name"), 	
		'registration_no' => $dbConn->f("registration_no"),
		'wp_name' => $dbConn->f("wp_name"),
		'p_bphtb_legal_doc_type_id' => $dbConn->f("p_bphtb_legal_doc_type_id"),
		'description' => $dbConn->f("description"),
		'njop_pbb' => $dbConn->f("njop_pbb"),
		'land_area' => $dbConn->f("land_area"),
		'land_total_price' => $dbConn->f("land_total_price"),
		'building_area' => $dbConn->f("building_area"),
		'building_total_price' => $dbConn->f("building_total_price"),
		'market_price' => $dbConn->f("market_price"),
		'bphtb_amt_final' => $dbConn->f("bphtb_amt_final")
	);
}

$dbConn->close();


class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 241.3;
	var $paperHSize = 279.4;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
		$this->lMargin = 30;
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
	
	function PageCetak($data,$no_urut) {
		$this->AliasNbPages();
		$this->SetLeftMargin(10);
		$this->AddPage("P");
		$this->AddFont('BKANT');
		
		$this->SetFont('ARIAL', '', 12);
		
		// $this->Image('../images/logo_pemda.png',25,17,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->SetFont('ARIAL', '', 12);

		$this->Image('../images/logo_pemda.png',17,13,25,25);

		$this->SetFont('ARIAL', 'B', 14);
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(181, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		
		$this->Ln();
		$this->SetFont('ARIAL', 'B', 20);
		$this->Cell(40, $this->height+10, "", "", 0, 'L');
		$this->Cell(181, $this->height+10, "D I N A S  P E L A Y A N A N  P A J A K", "", 0, 'C');
		
		$this->Ln();
		$this->SetFont('ARIAL', '', 12);
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(181, $this->height, "Jalan Wastukancana No 2 Telp. 022 4235052 - Bandung", "", 0, 'C');

		$this->Ln(5);
		$this->Ln();
		
		$this->SetFont('ARIAL', '', 12);
		$this->Cell($this->lengthCell, $this->height, "", "T", 100, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;

		$this->SetWidths(array(20,2,50,49));
		$this->SetAligns(array("L","L","L","L"));
		$posy = $this->getY();
		$data["letter_no"] = trim($data["letter_no"]);
		if(!empty($data["letter_no"])){
			$this->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					/*$data["letter_no"]."-".$no_urut*/"-",
					"-Disyanjak"
				),
				array("",
					"",
					"",
					""
				),
				2
			);
		}else{
			$this->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					/*" - "*/"-",
					"-Disyanjak"
				),
				array("",
					"",
					"",
					""
				),
				2
			);
		}

		$this->SetWidths(array(20,2,$this->lengthCell-22));
		$this->SetAligns(array("L","L","L"));
		$posy = $this->getY();

		$this->RowMultiBorderWithHeight(
			array("Sifat",
				":",
				"-"
			),
			array("",
				"",
				""
			),
			2
		);

		$this->RowMultiBorderWithHeight(
			array("Lampiran",
				":",
				"-"
			),
			array("",
				"",
				""
			),
			2
		);

		$this->RowMultiBorderWithHeight(
			array("Perihal",
				":",
				"Konfirmasi Data"
			),
			array("",
				"",
				""
			),
			2
		);

		$this->setY($posy-12);
		$today = getdate();
		$lkepada = $this->lengthCell / 5;
		$lkepada2 = $lkepada * 2;
		$lkepada3 = $lkepada * 3;
		
		$this->Cell($lkepada3, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Bandung, ".$data['creation_date'], "", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Kepada Yth,", "", 0, 'L');
		$this->Ln();

		$this->SetAligns(array("L","L"));
		$this->SetWidths(array($lkepada3,""));
		$this->RowMultiBorderWithHeight(
			array("",
				$data['wp_name']
			),
			array("",
				""
			),
			$this->height
		);

		
		$this->Cell($lkepada3, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Di ", "", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "          Bandung", "", 0, 'L');
		$this->Ln();
		
		// $this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		// $this->Cell($lkepada2, $this->height, "", "R", 0, 'C');
		// $this->Ln();
		$this->Cell($lkepada3, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('ARIAL', '', 12);
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
		// $this->newLine();
		//$this->Cell($this->lengthCell, $this->height, "SURAT TEGURAN", "", 0, 'C');
		
		$this->SetFont('ARIAL', '', 12);
		/*$this->Cell($this->lengthCell, $this->height, "Nomor: ".$data["letter_no"], "LR", 0, 'C');
		$this->newLine();*/
		$this->tulis("Dengan ini dipermaklumkan bahwa berdasarkan data yang kami terima dari KPP Pratama Bandung Karees,", "FJ");
		$this->tulis("ternyata Wajib Pajak BPHTB :","L");
		$this->tulis("", "L");
		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("20","50","2",""));
		$this->RowMultiBorderWithHeight(
			array("",
				"Atas Nama",
				":",
				$data['wp_name']
			),
			array("",
				"",
				"",
				""
			),
			3
		);

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("20","50","2",""));
		$this->RowMultiBorderWithHeight(
			array("",
				"Alamat",
				":",
				$data['wp_address_name']
			),
			array("",
				"",
				"",
				""
			),
			3
		);

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("20","50","2",""));
		$this->RowMultiBorderWithHeight(
			array("",
				"Nomor Nota Verifikasi",
				":",
				$data['registration_no']
			),
			array("",
				"",
				"",
				""
			),
			3
		);
		//$this->newLine();
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell("135", $this->height, "Sampai Saat ini belum melakukan pembayaran pajak BPHTB Tahun", "", 0, "J");
		$this->Cell("20", $this->height, "", "", 0, 'L');
		$this->Cell("15", $this->height, "dengan Pajak Terutang", "", 0, 'L');

		$this->Ln();
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell("68", $this->height, "dengan Pajak Terutang sebesar Rp", "", 0, "J");
		$this->Cell("20", $this->height, number_format($data['bphtb_amt_final'],2,",","."), "", 0, 'L');
		
		$this->newLine();
		$this->tulis("Berkenaan dengan hal tersebut di atas, kami mohon agar saudara dapat hadir selambat-lambatnya", "FJ");
		$this->tulis("7 (tujuh) hari setelah diterimanya surat ini, pada :","L");
		
		$this->Ln();
		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("20","30","2",""));
		$this->RowMultiBorderWithHeight(
			array("",
				"Hari",
				":",
				"Senin-Jum'at"
			),
			array("",
				"",
				"",
				""
			),
			3
		);

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("20","30","2",""));
		$this->RowMultiBorderWithHeight(
			array("",
				"Jam",
				":",
				"08.00 s.d 16.00 WIB" 
			),
			array("",
				"",
				"",
				""
			),
			3
		);

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("20","30","2","163"));
		$this->RowMultiBorderWithHeight(
			array("",
				"Tempat",
				":",
				"Seksi Penyelesaian Piutang Pajak Bidang Pajak Pendaftaran"
			),
			array("",
				"",
				"",
				""
			),
			2
		);
		$this->Cell(52, $this->height, "", "", 0, 'L');
		$this->Cell("", $this->height, "DINAS PELAYANAN PAJAK", "", 0, "J");
		$this->Ln();
		$this->Cell(52, $this->height, "", "", 0, 'L');
		$this->Cell("", $this->height, "Kota Bandung Jl. Wastukecana No. 2 Bandung.", "", 0, "J");

		$this->newLine();

		$this->tulis("Apabila saudara telah melaksanakan pembayaran pajak tersebut, kami mohon untuk dapat memperlihatkan", "FJ");
		$this->tulis("SSB (Surat Setoran BPHTB) yang telah divalidasi beserta Resi Pembayaran dari Bank dengan melampirkan", "FJ");
		$this->tulis("photo copy dokumen yang dimaksud.", "L");
		$this->tulis("", "L");
		//$this->newLine();
		$this->tulis("Demikian agar menjadi maklum, atas perhatian dan kerjasamanya kami ucapkan terima kasih.", "L");
		
		/*$this->SetAligns(array("L","L","L"));
		$this->SetWidths(array("10","","20"));
		$this->RowMultiBorderWithHeight(
			array("",
				"Sampai Saat ini belum melakukan pembayaran pajak BPHTB Tahun 2014 dengan Pajak Terutang sebesar Rp ",
				"-"
			),
			array("",
				"",
				""
			),
			2
		);
		*/

		//$this->newLine();
		// Tabel
		$ltable = ($this->lengthCell - 15) / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;

		/*
		$this->SetWidths(array(10, $ltable4, $ltable2, $ltable2, $ltable3, $ltable3, 5));
		$this->SetAligns(array("L", "C", "C", "C", "C", "C", "L"));
		
		$this->RowMultiBorderWithHeight(
			array("",
				"JENIS PAJAK",
				"TAHUN",
				"BULAN",
				"SPTPD",
				"TGL. SETOR",
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
		
		
		$this->SetWidths(array(10, $ltable4, $ltable2, $ltable2, $ltable3, $ltable3, 5));
		$this->SetAligns(array("L", "C", "C", "L", "C", "C", "L"));
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
		$this->RowMultiBorderWithHeight(
			array("",
				$data["vat_code"],
				$tahun[1],
				$bulan_string,
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
		$data["terbilang"]=trim($data["terbilang"]);
		$this->Cell(20, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 20,"", "", 0, 'L');	
		$this->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		*/
		
		//$this->tulis("Sampai saat ini belum melunasi pembayaran pajak.", "L");
		/*$this->tulis("", "L");
		$this->tulis("Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Undang-undang Nomor 28 Tahun", "FJ");
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
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		//$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		//$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4, $this->height, "Bandung, " .$data['letter_date_txt'] /*. $data["tanggal"]*/, "", 0, 'C');
		//$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		//$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "an. KEPALA DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();

		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4-5, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4+10, $this->height, "H. SONI BAKHTIYAR, S.Sos, M.Si", "B", 0, 'C');
		$this->Cell($lbody2-5, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		

		$this->SetFont('ARIAL', '', 10);
		$this->Ln();
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell("", $this->height, "Tembusan, disampaikan kepada Yth. :", "", 0, 'L');
		$this->Ln();
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell("", $this->height, "Bapak Kepala Dinas Pelayanan Pajak (sebagai laporan)", "", 0, 'L');

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
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->CellFJ(201, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->Ln();
	}
	
	function newLine(){
		$this->Ln();
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
$no_urut=0;
foreach($data as $item){
	$formulir->PageCetak($item,$no_urut);
	$no_urut++;
}
$formulir->Output();

?>

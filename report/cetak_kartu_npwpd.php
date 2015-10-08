<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_kartu_npwpd_2.php");
include_once(RelativePath . "/Common.php");
	
include "../include/fpdf17/mc_table.php";

$t_customer_order_id = CCGetFromGet("t_customer_order_id", "");

//$t_customer_order_id = 67;     
//$dataArr = array();
// $dataBaru = array();

if(empty($t_customer_order_id)){
	echo "data tidak ada";
	exit();
}
$dbConn = new clsDBConnSIKP();
$query="select b.vat_code,to_char(a.registration_date,'dd Mon yyyy') as registration_date_2,company_owner,a.* from t_vat_registration a 
		left join p_vat_type_dtl b on a.p_vat_type_dtl_id = b.p_vat_type_dtl_id
		where t_customer_order_id = ".$t_customer_order_id;
//echo $query;exit;
$dbConn->query($query);
$data=array();
while ($dbConn->next_record()) {
		$data= array(
			'npwpd' => $dbConn->f("npwpd"),
			'company_name' => $dbConn->f("company_owner"),
			'company_brand' => $dbConn->f("company_brand"),
			'brand_address_name' => $dbConn->f("brand_address_name").' '.$dbConn->f("brand_address_no"),
			'registration_date' => $dbConn->f("registration_date_2"),
			'vat_code' => $dbConn->f("vat_code"),
		);
	
$dbConn->close();
}
//print_r($data);exit;
$_HEIGHT = 4;
$_BORDER = 0;
$_FONT = 'Times';
$_FONTSIZE = 10;
$pdf = new PDF_MC_Table();
$size = $pdf->_getpagesize('Legal');
$size[1]=6;
$pdf->DefPageSize = $size;
$pdf->CurPageSize = $size;
$pdf->AddPage('L',array(200,150));
//$pdf->AddPage('P',array(210,296));

$pdf->SetFont('helvetica', '', $_FONTSIZE);
$pdf->SetRightMargin($_HEIGHT);
$pdf->SetLeftMargin($_HEIGHT);

$pdf->SetAutoPageBreak(false,0);
$pdf->Ln(0);
$pdf->Image('../images/Logo.png',7,10,15,15);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(10, 5, "", "TL", 0, 'L');
$pdf->Cell(80, 5, "PEMERINTAH KOTA BANDUNG", "TR", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(90, 5, "", "TLR", 0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, "", "L", 0, 'L');
$pdf->Cell(80, 5, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(90, 5, "PERHATIAN", "LR", 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "L", 0, 'L');
$pdf->Cell(80, 5, "Jalan Wastukencana No. 2 Telp/Fax (022) 4235052", "R", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(90, 5, "", "LR", 0, 'C');
$pdf->Ln(1);
$pdf->Cell(5, 5, "", "L", 0, 'L');
$pdf->Cell(15, 5, "", "B", 0, 'L');
$pdf->Cell(65, 5, "", "B", 0, 'C');
$pdf->Cell(5, 5, "", "R", 0, 'L');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(90, 5, "", "LR", 0, 'C');
$pdf->Ln();

$pdf->SetWidths(array(90, 10,10, 75,5));
$pdf->SetAligns(array("L", "L","C", "L"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"",
		"",
		"*",
		"NPWPD ini merupakan tanda pengenal diri atau identitas wajib Pajak dalam melakukan hak dan kewajiban perpajakan daerah di kota bandung.",
		""
	),
	array
	(
		"LR",
		"",
		"L",
		"",
		"R"
	),
	3
);
/*
$pdf->SetWidths(array(90, 10,10, 75,5));
$pdf->SetAligns(array("L", "L","C", "L"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"",
		"",
		"*",
		"Kartu ini harap di simpan baik-baik dan apabila hilang atau terjadi perubahan data kepemilikan, agar segera melapor ke kantor Dinas Pelayanan Pajak Kota Bandung.",
		""
	),
	array
	(
		"LR",
		"",
		"L",
		"",
		"R"
	),
	$_HEIGHT
);

$pdf->SetWidths(array(90, 10,10, 75,5));
$pdf->SetAligns(array("L", "L","C", "L"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"",
		"",
		"*",
		"Jatuh Tempo pembayaran Pajak Daerah tanggal 15 setiap bulannya",
		""
	),
	array
	(
		"LR",
		"",
		"L",
		"",
		"R"
	),
	$_HEIGHT
);
*/
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(90, 5, "NPWPD : ".$data['npwpd'], "LR", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(10, 3, "*", "L", 0, 'C');
$pdf->Cell(75, 3, "Kartu ini harap di simpan baik-baik dan apabila hilang atau terjadi perubahan", "", 0, 'J');
$pdf->Cell(5, 5, "", "R", 0, 'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 9, $data['company_brand'], "LR", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(10, 3, "", "L", 0, 'C');
$pdf->Cell(75, 3, "data kepemilikan, agar segera melapor ke kantor Dinas Pelayanan Pajak", "", 0, 'J');
$pdf->Cell(5, 5, "", "R", 0, 'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(90, 12, $data['brand_address_name'], "LR", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(10, 3, "", "L", 0, 'C');
$pdf->Cell(75, 3, "Kota Bandung.", "", 0, 'J');
$pdf->Cell(5, 5, "", "R", 0, 'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(90, 15, $data['company_name'], "LR", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(10, 5, "*", "L", 0, 'C');
$pdf->Cell(75, 3, "Jatuh Tempo pembayaran Pajak Daerah tanggal 15 setiap bulannya.", "", 0, 'J');
$pdf->Cell(5, 5, "", "R", 0, 'C');
$pdf->Ln();
$pdf->Cell(90, 5, "", "LR", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(90, 5, "", "LR", 0, 'C');
$pdf->Ln();
$pdf->Cell(90, 5, "", "LR", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(90, 5, "www.disyanjak.bandung.go.id", "LR", 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(45, 5, 'TERDAFTAR : '. $data['registration_date'], "L", 0, 'L');
$pdf->Cell(45, 5, $data['vat_code'], "R", 0, 'R');
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(90, 3, "BAYAR PAJAK MUDAH! BANDUNG JUARA!", "LR", 0, 'C');
$pdf->Ln(1);
$pdf->Cell(90, 5, "", "BLR", 0, 'C');	
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Cell(90, 5, "", "BLR", 0, 'C');

$pdf->Ln(7);
$pdf->SetWidths(array(190));
$pdf->SetAligns(array("C"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"
	),
	array
	(
		""
	),
	$_HEIGHT
);
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 14);
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"\nTANDA TERIMA KARTU NPWPD\n"
	),
	array
	(
		"TLR"
	),
	$_HEIGHT
);
$pdf->SetFont('Arial', '', 10);
$pdf->SetWidths(array(10,40,130,10));
$pdf->SetAligns(array("L","L","L","L"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"",
		"\nNPWPD
		\nMerk Dagang
		\nAlamat
		",
		
		"\n: ".$data['npwpd']."
		\n: ".$data['company_brand']."
		\n: ".$data['brand_address_name']."
		\n",
		""
	),
	array
	(
		"L",
		"",
		"",
		"R"
	),
	$_HEIGHT
);

$pdf->SetWidths(array(70,120));
$pdf->SetAligns(array("L","C"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"",
		"Bandung, ".date('d-m-Y')."
		\nYang menerima
		\n
		\n
		".$data['company_name']."
		\n"
	),
	array
	(
		"BL",
		"BR"
	),
	$_HEIGHT
);

//$pdf->Output("","I");
if(!empty($_GET['save'])){
	$name_of_file = "print_kartu_pdf_".time().".pdf";
	try{
		$dbConn->query("INSERT INTO t_print_queue(t_customer_order_id, file_name, status) VALUES (".$t_customer_order_id.",'".$name_of_file."', 'SAVED');");
		$dbConn->next_record();
		
		$pdf->Output('D:\work\list_pdf\\'.$name_of_file,'F');
	}catch(Exception $e){
		@unlink('D:\work\list_pdf\\'.$name_of_file);
	}
}else{
	$pdf->Output("","I");
}
exit;
?>

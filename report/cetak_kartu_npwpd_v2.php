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
$pdf->AddPage('L',array(94,60));
//$pdf->AddPage('P',array(210,296));

$pdf->SetFont('helvetica', '', $_FONTSIZE);
$pdf->SetRightMargin($_HEIGHT);
$pdf->SetLeftMargin($_HEIGHT);

$pdf->SetAutoPageBreak(false,0);
$pdf->Ln(0);
//$pdf->Image('../images/Logo.png',7,10,15,15);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(74, 5, "", "", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(74, 5, "", "", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Cell(74, 5, "", "", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'L');
$pdf->Ln(1);
$pdf->Cell(5, 5, "", "", 0, 'L');
$pdf->Cell(15, 5, "", "", 0, 'L');
$pdf->Cell(59, 5, "", "", 0, 'C');
$pdf->Cell(5, 5, "", "", 0, 'L');
$pdf->Ln();

$pdf->SetWidths(array(84, 10));
$pdf->SetAligns(array("L", "L","C", "L"));
$pdf->RowMultiBorderWithHeight(
	array
	(	
		"",
		""
	),
	array
	(
		"",
		""
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
$pdf->Cell(84, 5, "NPWPD : ".$data['npwpd'], "", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(84, 9, $data['company_brand'], "", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(84, 12, $data['brand_address_name'], "", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(84, 15, $data['company_name'], "", 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln();
$pdf->Cell(84, 5, "", "", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln();
$pdf->Cell(84, 5, "", "", 0, 'C');
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(42, 5, 'TERDAFTAR : '. $data['registration_date'], "", 0, 'L');
$pdf->Cell(42, 5, $data['vat_code'], "", 0, 'R');
$pdf->Cell(10, 5, "", "", 0, 'C');
$pdf->Ln(1);
$pdf->Cell(84, 5, "", "", 0, 'C');	
$pdf->Cell(10, 5, "", "", 0, 'C');


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

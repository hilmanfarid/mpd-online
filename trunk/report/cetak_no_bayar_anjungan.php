<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_registrasi_payment.php");
include_once(RelativePath . "/Common.php");
	
include "../include/fpdf17/mc_table.php";

$param_arr = CCGetFromGet("codeline");
$no_bayar = CCGetFromGet("no_bayar");
if(empty($no_bayar)) exit;

$data = array();
$dbConn				= new clsDBConnSIKP();
$query				= "SELECT x.payment_key,x.npwd,nvl(x.total_vat_amount,0) as total_vat_amount,a.vat_code as ayat, b.code as periode from t_vat_setllement x
						left join p_vat_type_dtl a on x.p_vat_type_dtl_id =a.p_vat_type_dtl_id
						left join p_finance_period b on x.p_finance_period_id=b.p_finance_period_id
						where payment_key = '$no_bayar'";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["payment_key"]		= $dbConn->f("payment_key");
	$data["p_vat_type_dtl_id"]		    = $dbConn->f("ayat");
	$data["npwd"]		    = $dbConn->f("npwd");
	$data["total_vat_amount"]		    = $dbConn->f("total_vat_amount");
	$data["p_finance_period_id"]		        = $dbConn->f("periode");
}
$_HEIGHT = 3;
$_BORDER = 0;
$_FONT = 'Times';
$_FONTSIZE = 8;
$pdf = new PDF_MC_Table();
$size = $pdf->_getpagesize('Legal');
$size[1]=6;
$pdf->DefPageSize = $size;
$pdf->CurPageSize = $size;
$pdf->AddPage('P',array(80,80));
//$pdf->AddPage('P',array(210,296));

$pdf->SetRightMargin($_HEIGHT);
$pdf->SetLeftMargin($_HEIGHT);

$pdf->SetAutoPageBreak(false,0);

$pdf->SetFont('Arial', '',8);

$pdf->Image('../images/logo_pemda.png',5.5,8,10,10);
$pdf->ln();
$pdf->SetWidths(array(15,60));
$pdf->SetAligns(array("L","C"));
$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"PEMERINTAH KOTA BANDUNG\n".
				"DINAS PELAYANAN PAJAK"
			),
			array
			(
			    "",
				""
			),
			$_HEIGHT+1);
$pdf->ln(1);
$pdf->SetWidths(array(15,50, 10));
$pdf->SetAligns(array("L","L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"",
				""
			),
			array
			(
			    "T",
				"T",
				"T"
			),
			1);

$pdf->ln();
$pdf->SetFont('Arial', '',11);
$pdf->SetWidths(array(5,65, 5));
$pdf->SetAligns(array("L","C", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"No. Bayar :",
				""
			),
			array
			(
			    "",
				"",
				""
			),
			$_HEIGHT+2);

$pdf->SetFont('Arial', 'B',18);
$pdf->SetWidths(array(5,65, 5));
$pdf->SetAligns(array("L","C", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				$data["payment_key"],
				""
			),
			array
			(
			    "",
				"BLTR",
				""
			),
			$_HEIGHT+5);
			
$pdf->ln();
$pdf->SetFont('Arial', '',11);
$pdf->SetWidths(array(5,25,40, 5));
$pdf->SetAligns(array("L","L","L", "L"));
$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"NPWPD",
				": ".$data["npwd"],
				""
			),
			array
			(
			    "",
				"",
				"",
				""
			),
			$_HEIGHT+2);

$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"Ayat Pajak",
				": ".$data["p_vat_type_dtl_id"],
				""
			),
			array
			(
			    "",
				"",
				"",
				""
			),
			$_HEIGHT+2);

$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"Total Pajak",
				": Rp. ".number_format($data["total_vat_amount"],2,",","."),
				//": Rp. ".number_format(999999999,2,",","."),
				""
			),
			array
			(
			    "",
				"",
				"",
				""
			),
			$_HEIGHT+2);
$pdf->RowMultiBorderWithHeight(
			array
			(	"",
				"Masa Pajak",
				": ".$data["p_finance_period_id"],
				""
			),
			array
			(
			    "",
				"",
				"",
				""
			),
			$_HEIGHT+2);
			
$pdf->Output("","I");
exit;
?>
<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_registrasi.php");
include_once(RelativePath . "/Common.php");
	
include "../include/fpdf17/mc_table.php";

$param_arr = CCGetFromGet("codeline");

$_BORDER = 0;
$_FONT = 'Times';
$_FONTSIZE = 10;
$pdf = new PDF_MC_Table();
$size = $pdf->_getpagesize('Legal');
$size[1]=6;
$pdf->DefPageSize = $size;
$pdf->CurPageSize = $size;
$pdf->AddPage('Landscape',array(150,40));
$pdf->SetFont('helvetica', '', $_FONTSIZE);
$pdf->SetRightMargin(5);
$pdf->SetLeftMargin(5);
$pdf->SetAutoPageBreak(false,0);

$pdf->SetFont('helvetica', '',12);
$pdf->SetWidths(array(200));
$pdf->ln(1);
$items = explode('#',$param_arr);
foreach($items as $item){
	$pdf->RowMultiBorderWithHeight(array($item),array('',''),6);
}
//$pdf->ln(8);
$pdf->Output("","I");
exit;
?>
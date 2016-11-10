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
$query				= "select x.company_brand,x.brand_address_name,x.brand_address_no,to_char(a.settlement_date,'dd-mm-yyyy') as settlement_date,
				to_char(a.settlement_date,'HH24:MI:ss') as pukul,a.npwd,wp_name,vat_code,z.code, nvl(total_vat_amount,0)as total_vat_amount,
				nvl(total_penalty_amount,0) as total_penalty_amount,nvl(total_vat_amount,0)+nvl(total_penalty_amount,0) as total_bayar,payment_key,
				replace(f_terbilang(to_char(nvl(total_vat_amount,0)+nvl(total_penalty_amount,0)),'IDR'),'    sen ','') as dengan_huruf ,
				payment_due_day,p_settlement_type_id, nvl(w.is_employee,'N') as is_employee, nvl(a.is_surveyed,'N') as is_surveyed
				from sikp.t_vat_setllement a
				left join sikp.t_cust_account x on a.t_cust_account_id =x.t_cust_account_id 
				left join sikp.p_vat_type_dtl y on y.p_vat_type_dtl_id = a.p_vat_type_dtl_id
				left join sikp.p_finance_period z on z.p_finance_period_id = a.p_finance_period_id
				left join sikp.p_app_user w on w.app_user_name = a.created_by
				where payment_key ='".$no_bayar."'";

$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["company_brand"]	= $dbConn->f("company_brand");
	$data["brand_address_name"]		= $dbConn->f("brand_address_name");
	$data["brand_address_no"]		    = $dbConn->f("brand_address_no");
	$data["settlement_date"]		    = $dbConn->f("settlement_date");
	$data["pukul"]		    = $dbConn->f("pukul");
	$data["npwd"]		            = $dbConn->f("npwd");
	$data["wp_name"]		        = $dbConn->f("wp_name");
	$data["vat_code"]		        = $dbConn->f("vat_code");
	$data["code"]		    = $dbConn->f("code");
	$data["total_vat_amount"]		    = $dbConn->f("total_vat_amount");
	$data["total_penalty_amount"]		    = $dbConn->f("total_penalty_amount");
	$data["total_bayar"]		    = $dbConn->f("total_bayar");
	$data["dengan_huruf"]		    = $dbConn->f("dengan_huruf");
	$data["payment_key"]		    = $dbConn->f("payment_key");	
	$data["payment_due_day"]		    = $dbConn->f("payment_due_day");
	$data["p_settlement_type_id"]		    = $dbConn->f("p_settlement_type_id");
	$data["is_employee"]		    = $dbConn->f("is_employee");
	$data["is_surveyed"]		    = $dbConn->f("is_surveyed");
}
if ($data["is_employee"]!='Y' && $data["is_surveyed"]!='Y'){
	echo '<html>
			<head>
				<script language="javascript">';
				echo 'alert("Anda diharapkan untuk mengisi survey terlebih dahulu untuk mencetak dokumen No. Bayar");';
				echo 'location.href="../trans/t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.php?payment_key="+"'.$no_bayar.'";';
			echo '</script>
			</head>
		</html>';
	EXIT;
}
$items = $data;

$_BORDER = 0;
$_FONT = 'Times';
$_FONTSIZE = 10;
$pdf = new PDF_MC_Table();
$size = $pdf->_getpagesize('Legal');
$pdf->DefPageSize = $size;
$pdf->CurPageSize = $size;
$pdf->AddPage('Landscape', array(160,210));
$pdf->SetFont('helvetica', '', $_FONTSIZE);
$pdf->SetRightMargin(5);
$pdf->SetLeftMargin(5);
$pdf->SetTopMargin(-20);
$pdf->SetAutoPageBreak(false,0);

$pdf->Image('../images/logo_pemda_warna.png',12,15,20,20);

$pdf->SetFont('helvetica', 'B',14);
$pdf->SetWidths(array(10,165));
$pdf->SetAligns(array("C","C"));
$pdf->RowMultiBorderWithHeight(array("","PEMERINTAH KOTA BANDUNG\nDINAS PELAYANAN PAJAK"),array('',''),6);
$pdf->SetFont('helvetica', '',12);
$pdf->SetWidths(array(15,165));
$pdf->SetAligns(array("C","C"));
$pdf->RowMultiBorderWithHeight(array("","Jalan Wastukancana No.2\nTelp. 022-4235052 - Bandung"),array('',''),6);
$pdf->SetWidths(array(15,165,20));
$pdf->RowMultiBorderWithHeight(array("","",""),array('B','B','B'),6);
$pdf->ln(2);

$pdf->SetFont('helvetica', '',12);
$pdf->SetAligns(array("L","L","L"));
$pdf->SetWidths(array(40,4,80));
$pdf->ln(2);
$pdf->RowMultiBorderWithHeight(array("MERK DAGANG",":",$items['company_brand']),array('','',''),6);
$pdf->RowMultiBorderWithHeight(array("ALAMAT",":",$items['brand_address_name']." ".$items['brand_address_no']),array('','',''),6);

$pdf->SetAligns(array("L","L","L","C"));
$pdf->SetWidths(array(40,4,80,70));
$pdf->RowMultiBorderWithHeight(array("NPWPD",":",$items['npwd'],"NOMOR PEMBAYARAN"),array('','','','BLTR'),6);

$pdf->SetAligns(array("L","L","L"));
$pdf->SetWidths(array(40,4,80));
//$pdf->RowMultiBorderWithHeight(array("JENIS PAJAK",":",$items['items'][0]['vat_code']),array('','',''),6);
$pdf->Cell(40, 6, 'JENIS PAJAK', "", 0, 'l');
$pdf->Cell(4, 6, ':', "", 0, 'L');
$pdf->Cell(80, 6, $items['vat_code'], "", 0, 'L');
$pdf->SetFont('helvetica', 'B',26);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(70, 15, $no_bayar, "BLTR", 0, 'C');
$pdf->SetFont('helvetica', '',12);
$pdf->SetTextColor(0,0,0);
$pdf->ln(6);
$pdf->RowMultiBorderWithHeight(array("MASA PAJAK",":",$items['code']),array('','',''),6);

$pdf->SetAligns(array("L","L","R"));
$pdf->SetWidths(array(40,4,40));
$pdf->RowMultiBorderWithHeight(array("JUMLAH (Rp)",":",number_format($items['total_vat_amount'],2,",",".")),array('','',''),6);
$pdf->RowMultiBorderWithHeight(array("DENDA (Rp)",":",number_format($items['total_penalty_amount'],2,",",".")),array('','',''),6);
$pdf->RowMultiBorderWithHeight(array("TOTAL (Rp)",":",number_format($items['total_bayar'],2,",",".")),array('','',''),6);
$pdf->SetAligns(array("L","L","L"));
$pdf->SetWidths(array(40,4,80));

$pdf->RowMultiBorderWithHeight(array("TERBILANG",":",ucwords($items['dengan_huruf'].' rupiah')),array('','',''),6);
//$pdf->RowMultiBorderWithHeight(array("BATAS WAKTU PEMBAYARAN",":",$items['items'][0]['pay_due_date']),array('','',''),6);

$pdf->SetWidths(array(200));
$pdf->SetAligns(array("L"));
$pdf->SetFont('helvetica', '',10);
$pdf->ln(6);
if ($items['p_settlement_type_id']==1){
	$pdf->RowMultiBorderWithHeight(array("*Nomor pembayaran dan denda pajak yang tertera pada slip ini berlaku sampai dengan tanggal ".$items['payment_due_day']),array(''),6);
}
//$pdf->RowMultiBorderWithHeight(array("**Keterlambatan pembayaran melewati tanggal jatuh tempo akan dikenakan denda sesuai administrasi berupa bunga sebesar 2% (dua persen) setiap bulannya."),
//array(''),6);
$pdf->ln(8);
$pdf->SetFont('helvetica', '',12);
$pdf->SetAligns(array("C"));
$pdf->RowMultiBorderWithHeight(array("Bandung, ".date('d-M-y')),array(''),6);
$pdf->SetFont('helvetica', '',12);
$pdf->RowMultiBorderWithHeight(array("BAYAR PAJAK MUDAH BANDUNG JUARA"),array(''),6);
$pdf->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$no_bayar.'',175,13,25,25,'PNG');
$pdf->Output(time()."_kwitansi_".$no_bayar,"I");
exit;
?>
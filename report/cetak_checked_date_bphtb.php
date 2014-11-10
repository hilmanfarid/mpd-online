<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");
include_once("../include/qrcode/generate-qr-file.php");

$s_keyword		= CCGetFromGet("s_keyword", "");
$date_start_laporan		= CCGetFromGet("date_start_laporan", "");
$date_end_laporan		= CCGetFromGet("date_end_laporan", "");

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();

$query	= "SELECT *,kec.region_name as kecamatan, kel.region_name as kelurahan  FROM t_payment_receipt_bphtb x
	LEFT JOIN t_bphtb_registration y ON y.t_bphtb_registration_id = x.t_bphtb_registration_id
	LEFT JOIN t_customer_order z ON y.t_customer_order_id = z.t_customer_order_id
	left join p_region kec on kec.p_region_id = y.wp_p_region_id_kec
	left join p_region kel on kel.p_region_id = y.wp_p_region_id_kel
	WHERE
		check_date IS NOT NULL
	AND wp_name ILIKE '%$s_keyword%'";
	
if ($date_end_laporan != "" && $date_start_laporan !=""){
	$query .= "AND(check_date BETWEEN to_date ('$date_start_laporan') AND ('$date_end_laporan'))";
}else{
	if ($date_end_laporan != ""){
		$query .= "AND(check_date <= to_date ('$date_end_laporan') )";
	}
	if ($date_start_laporan != ""){
		$query .= "AND(check_date >= to_date ('$date_start_laporan') )";
	}
}
$dbConn->query($query);
while ($dbConn->next_record()) {
	$data[]= array(
	"wp_name"	=> $dbConn->f("wp_name"),
	"order_no"	=> $dbConn->f("order_no"),
	"receipt_no"	=> $dbConn->f("receipt_no"),
	"check_date"		=> $dbConn->f("check_date"),
	"wp_address_name"	=> $dbConn->f("wp_address_name"),
	"t_payment_receipt_id"		=> $dbConn->f("t_payment_receipt_id"),
	"t_bphtb_registration_id"		=> $dbConn->f("t_bphtb_registration_id"),
	"bphtb_registration_no"			=> $dbConn->f("bphtb_registration_no"),
	"t_customer_order_id"		=> $dbConn->f("t_customer_order_id"),
	"payment_date"		=> $dbConn->f("payment_date"),
	"njop_pbb"		=> $dbConn->f("njop_pbb"),
	"kecamatan"		=> $dbConn->f("kecamatan"),
	"kelurahan"		=> $dbConn->f("kelurahan"),
	"land_area"		=> $dbConn->f("land_area"),
	"building_area"		=> $dbConn->f("building_area"),
	"npop_kp"		=> $dbConn->f("npop_kp"),
	"payment_vat_amount"		=> $dbConn->f("payment_vat_amount"));
}
$dbConn->close();

$output = '';
/*
$output.='<table><tr>';
$output.='<th>NO</th>';
$output.='<th>NAMA WP</th>';
$output.='<th>ALAMAT WP</th>';
$output.='<th>TANGGAL CEK</th>';
$output.='<th>NO. KWITANSI</th>';
$output.='<th>TANGGAL BAYAR</th>';
$output.='<th>NO. REGISTRASI</th>';
$output.='<th>NILAI PAJAK</th>';
$output.='<th>NO. ORDER</th>';
$output.='</tr>';
*/
echo '<h1>LAPORAN PEMERIKSAAN BPHTB</h1>';
echo '<table><tr>';
echo '<th>NO</th>';
echo '<th>NO. TRANSAKSI</th>';
echo '<th>NOP</th>';
echo '<th>TANGGAL BAYAR</th>';
echo '<th>NAMA</th>';
echo '<th>ALAMAT</th>';
echo '<th>KELURAHAN</th>';
echo '<th>KECAMATAN</th>';
echo '<th>LUAS TNH</th>';
echo '<th>LUAS BGN</th>';
echo '<th>NJOP(Rp)</th>';
echo '<th>TOTAL BAYAR(Rp)</th>';
echo '<th>TANGGAL CEK</th>';
echo '<th>NO. ORDER</th>';
echo '<th>NO. REGISTRASI</th>';
echo '</tr>';
$i=1;
foreach($data as $item) {
	echo '<tr>';
	echo '<td align="center">'.($i).'</td>';
	echo '<td align="left">'.$item["receipt_no"].'</td>';
	echo '<td align="left">'.$item["njop_pbb"].'</td>';
	echo '<td align="left">'.$item["payment_date"].'</td>';
	echo '<td align="left">'.$item["wp_name"].'</td>';
	echo '<td align="left">'.$item["wp_address_name"].'</td>';
	echo '<td align="left">'.$item["kelurahan"].'</td>';
	echo '<td align="left">'.$item["kecamatan"].'</td>';
	echo '<td align="left">'.$item["land_area"].'</td>';
	echo '<td align="left">'.$item["building_area"].'</td>';
	echo '<td align="right">'.number_format($item["npop_kp"], 2, ',', '.').'</td>';
	echo '<td align="right">'.number_format($item["payment_vat_amount"], 2, ',', '.').'</td>';
	echo '<td align="left">'.$item["check_date"].'</td>';
	echo '<td align="left">'.$item["order_no"].'</td>';
	echo '<td align="left">'.$item["bphtb_registration_no"].'</td>';
	$i++;
}
echo '</table>';
?>

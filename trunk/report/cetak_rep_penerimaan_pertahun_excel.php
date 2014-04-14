<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_penerimaan_pertahun_excel.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$p_year_period_id	= CCGetFromGet("p_year_period_id", "");
$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
$tgl_status			= CCGetFromGet("tgl_status", "");
$p_account_status_id= CCGetFromGet("p_account_status_id", "");
$status_bayar = CCGetFromGet("status_bayar", "");

// $p_year_period_id	= 4;
// $p_vat_type_id		= 1;
// $tgl_status			= '15-12-2013';
if(empty($p_account_status_id)) $p_account_status_id = "NULL";
if(empty($status_bayar)) $status_bayar = "NULL";

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();
$query				= "select * from f_rep_penerimaan_pertahun_sts_new($p_year_period_id, $p_vat_type_id, $tgl_status, $p_account_status_id, $status_bayar);";


$dbConn->query($query);
while ($dbConn->next_record()) {
	$data["jenis_pajak"][]	= $dbConn->f("jenis_pajak");
	$data["tahun"][]		= $dbConn->f("tahun");
	$data["nama"][]			= $dbConn->f("nama");
	$data["alamat"][]		= $dbConn->f("alamat");
	$data["npwpd"][]		= $dbConn->f("npwpd");
	$data["f_12_sts"][]		= $dbConn->f("f_12_sts");
	$data["f_12_amt"][]		= $dbConn->f("f_12_amt");
	$data["f_12_paydate"][]	= $dbConn->f("f_12_paydate");
	$data["f_11_sts"][]		= $dbConn->f("f_11_sts");
	$data["f_11_amt"][]		= $dbConn->f("f_11_amt");
	$data["f_11_paydate"][]	= $dbConn->f("f_11_paydate");
	$data["f_10_sts"][]		= $dbConn->f("f_10_sts");
	$data["f_10_amt"][]		= $dbConn->f("f_10_amt");
	$data["f_10_paydate"][]	= $dbConn->f("f_10_paydate");
	$data["f_09_sts"][]		= $dbConn->f("f_09_sts");
	$data["f_09_amt"][]		= $dbConn->f("f_09_amt");
	$data["f_09_paydate"][]	= $dbConn->f("f_09_paydate");
	$data["f_08_sts"][]		= $dbConn->f("f_08_sts");
	$data["f_08_amt"][]		= $dbConn->f("f_08_amt");
	$data["f_08_paydate"][]	= $dbConn->f("f_08_paydate");
	$data["f_07_sts"][]		= $dbConn->f("f_07_sts");
	$data["f_07_amt"][]		= $dbConn->f("f_07_amt");
	$data["f_07_paydate"][]	= $dbConn->f("f_07_paydate");
	$data["f_06_sts"][]		= $dbConn->f("f_06_sts");
	$data["f_06_amt"][]		= $dbConn->f("f_06_amt");
	$data["f_06_paydate"][]	= $dbConn->f("f_06_paydate");
	$data["f_05_sts"][]		= $dbConn->f("f_05_sts");
	$data["f_05_amt"][]		= $dbConn->f("f_05_amt");
	$data["f_05_paydate"][]	= $dbConn->f("f_05_paydate");
	$data["f_04_sts"][]		= $dbConn->f("f_04_sts");
	$data["f_04_amt"][]		= $dbConn->f("f_04_amt");
	$data["f_04_paydate"][]	= $dbConn->f("f_04_paydate");
	$data["f_03_sts"][]		= $dbConn->f("f_03_sts");
	$data["f_03_amt"][]		= $dbConn->f("f_03_amt");
	$data["f_03_paydate"][]	= $dbConn->f("f_03_paydate");
	$data["f_02_sts"][]		= $dbConn->f("f_02_sts");
	$data["f_02_amt"][]		= $dbConn->f("f_02_amt");
	$data["f_02_paydate"][]	= $dbConn->f("f_02_paydate");
	$data["f_01_sts"][]		= $dbConn->f("f_01_sts");
	$data["f_01_amt"][]		= $dbConn->f("f_01_amt");
	$data["f_01_paydate"][]	= $dbConn->f("f_01_paydate");
}
$dbConn->close();


startExcel("laporan_penerimaan_pertahun_".$data["tahun"][0]);
echo "<div><h3> LAPORAN PENERIMAAN PER TAHUN </h3></div>";	
echo "<div><h3>TAHUN : ".$data["tahun"][0]."</h3></div>";	


echo '<table border="1" width="100%"> ';
echo '<tr>
			<th rowspan="2">NO</th>
			<th rowspan="2">Nama Perusahaan</th>
			<th rowspan="2">Alamat</th>
			<th colspan="12">Realisasi dan Tanggal Bayar</th>
			<th rowspan="2">Jumlah</th>
	  </tr>
	 ';

echo '<tr>
		<th> Desember <br/> '.($data["tahun"][0] - 1).' </th>
		<th> Januari </th>
		<th> Februari </th>
		<th> Maret </th>
		<th> April </th>
		<th> Mei </th>
		<th> Juni </th>
		<th> Juli </th>
		<th> Agustus </th>
		<th> September </th>
		<th> Oktober </th>
		<th> November </th>
	</tr>';

$jumlah_kanan = array();
$grand_total = 0;
for ($i = 0; $i < count($data["nama"]); $i++) {

	$data2 = array();
	$arrpaydate = array();

	for($j = 1; $j <= 12; $j++){
		$sts = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_sts";
		$amt = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_amt";
		$paydate = "f_" . str_pad($j, 2, '0', STR_PAD_LEFT) . "_paydate";
					
		if(is_null($data[$sts][$i])){
			$data2[$j] = number_format($data[$amt][$i], 0, ',', '.');
			$arrpaydate[$j] = $data[$paydate][$i];
		}
		else{
			$data2[$j] = $data[$sts][$i];
		}
	}
	
	$jumlah_kanan[$i] = 0;
	for($k = 1; $k <=12; $k++) {
		$amt = "f_" . str_pad($k, 2, '0', STR_PAD_LEFT) . "_amt";
		$jumlah_kanan[$i] += $data[$amt][$i];
	}
	
	$grand_total += $jumlah_kanan[$i]; //total bottom

	echo '<tr>
		<td align="center" valign="top">'.($i+1).'</td>
		<td valign="top">'.$data["nama"][$i].'</td>
		<td valign="top">'.$data["alamat"][$i].' <br/> '.$data["npwpd"][$i].'</td>
		<td align="right" valign="top">'.$data2[12].'<br/> '.$arrpaydate[12].'</td>
		<td align="right" valign="top">'.$data2[1].'<br/> '.$arrpaydate[1].'</td>
		<td align="right" valign="top">'.$data2[2].'<br/> '.$arrpaydate[2].'</td>
		<td align="right" valign="top">'.$data2[3].'<br/> '.$arrpaydate[3].'</td>
		<td align="right" valign="top">'.$data2[4].'<br/> '.$arrpaydate[4].'</td>
		<td align="right" valign="top">'.$data2[5].'<br/> '.$arrpaydate[5].'</td>
		<td align="right" valign="top">'.$data2[6].'<br/> '.$arrpaydate[6].'</td>
		<td align="right" valign="top">'.$data2[7].'<br/> '.$arrpaydate[7].'</td>
		<td align="right" valign="top">'.$data2[8].'<br/> '.$arrpaydate[8].'</td>
		<td align="right" valign="top">'.$data2[9].'<br/> '.$arrpaydate[9].'</td>
		<td align="right" valign="top">'.$data2[10].'<br/> '.$arrpaydate[10].'</td>
		<td align="right" valign="top">'.$data2[11].'<br/> '.$arrpaydate[11].'</td>
		<td align="right" valign="top">'.number_format($jumlah_kanan[$i], 0, ',', '.').'</td>
	</tr>';
	
}


echo '<tr>
		<td colspan="15" align="center"> <b>TOTAL</b> </td>
		<td><b>'.number_format($grand_total, 0, ',', '.').'</b></td>
	</tr>';
echo '</table>';
exit;


function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}





?>

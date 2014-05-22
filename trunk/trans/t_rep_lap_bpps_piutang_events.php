<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-36241AEE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_bpps_piutang; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-AEF64B9F
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_bpps_piutang; //Compatibility
//End Page_BeforeShow

//Custom Code @570-2A29BDB7
// -------------------------
    $cetak_laporan = CCGetFromGet('cetak_laporan');

	if($cetak_laporan == 'download_excel') {
		$param_arr = array();

		$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
		$param_arr['i_flag_setoran'] = CCGetFromGet('i_flag_setoran');
		$param_arr['tgl_penerimaan_last'] = CCGetFromGet('tgl_penerimaan_last');
		$param_arr['jenis_laporan'] = CCGetFromGet('jenis_laporan', 'all');
		
		print_excel($param_arr);

	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function print_excel($param_arr) {
	
	$date_start = str_replace("'", "", $param_arr['tgl_penerimaan']);
	$date_end = str_replace("'", "", $param_arr['tgl_penerimaan_last']);

	$date_arr = explode("-", $date_start);
	$year_date = $date_arr[2];
	
	startExcel("laporan_realisasi_harian_dan_piutang");
	echo "<div><h3> LAPORAN REALISASI HARIAN PER JENIS PAJAK</h3></div>";
	echo "<b>TAHUN ".$year_date."<b/> <br/>";
	echo "<b>Tanggal Penerimaan : ".$date_start. " s.d ".$date_end." </b><br/>";
	
	echo '<table width="100%" border="1">';
	echo '<tr>
		<th>NO</th>
		<th>NO.AYAT</th>
		<th>NAMA AYAT</th>
		<th>NO.KOHIR</th>
		<th>NAMA WP</th>
		<th>NPWPD</th>
		<th>JUMLAH</th>
		<th>MASA PAJAK</th>
		<th>TGL TAP</th>
		<th>TGL BAYAR</th>
	</tr>';
	
	$dbConn = new clsDBConnSIKP();
	$query = '';
	$jenis_laporan = $param_arr['jenis_laporan'];
	$tgl_penerimaan = $param_arr['tgl_penerimaan'];
	$p_year_period_id = $param_arr['p_year_period_id'];
	$p_vat_type_id = $param_arr['p_vat_type_id'];
	$i_flag_setoran = $param_arr['i_flag_setoran'];
	$tgl_penerimaan_last = $param_arr['tgl_penerimaan_last'];

	if($jenis_laporan == 'all'){
		$query	= "select *,trunc(payment_date) from f_rep_bpps($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
	}else if($jenis_laporan == 'piutang'){
		$query	= "select *,trunc(payment_date) 
		from f_rep_bpps_piutang($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
		WHERE
		EXTRACT (YEAR FROM rep.settlement_date) < $year_date
		order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
	}else if($jenis_laporan == 'murni'){
		$query	= "select *,trunc(payment_date) 
		from f_rep_bpps_piutang($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
		WHERE
		EXTRACT (YEAR FROM rep.settlement_date) = $year_date
		order by kode_jns_trans, kode_jns_pajak, kode_ayat";
	}
	
	$dbConn->query($query);
	$tgl_penerimaan = str_replace("'", "", $tgl_penerimaan);
	$tgl_penerimaan_last = str_replace("'", "", $tgl_penerimaan_last);
	$tahun = date("Y", strtotime($tgl_penerimaan));

	while ($dbConn->next_record()) {
		$data[]= array(
		"kode_jns_trans"	=> $dbConn->f("kode_jns_trans"),
		"jns_trans"		=> $dbConn->f("jns_trans"),
		"kode_jns_pajak"	=> $dbConn->f("kode_jns_pajak"),
		"kode_ayat"		=> $dbConn->f("kode_ayat"),
		"jns_pajak"		=> $dbConn->f("jns_pajak"),
		"jns_ayat"			=> $dbConn->f("jns_ayat"),
		"nama_ayat"		=> $dbConn->f("nama_ayat"),
		"no_kohir"		=> $dbConn->f("no_kohir"),
		"wp_name"			=> $dbConn->f("wp_name"),
		"wp_address_name"	=> $dbConn->f("wp_address_name"),
		"wp_address_no"		=> $dbConn->f("wp_address_no"),
		"npwpd"			=> $dbConn->f("npwpd"),
		"jumlah_terima"	=> $dbConn->f("jumlah_terima"),
		"masa_pajak"		=> $dbConn->f("masa_pajak"),
		"kd_tap"			=> $dbConn->f("kd_tap"),
		"keterangan"		=> $dbConn->f("keterangan"),
		"payment_date"		=> $dbConn->f("payment_date"),
		"jam"		=> $dbConn->f("jam"));
	}
	$dbConn->close();
	
	$no = 1;
	$jumlahtemp = 0;
	$jumlahperayat = array();
	$jumlahperwaktu = array();
	$i = 0;
	$total = 0;

	foreach($data as $item) {

		echo '<tr>';
		echo '<td align="center">'.$no.'</td>';
		echo '<td align="left">'.$item["kode_jns_pajak"].' '.$item["kode_ayat"].'</td>';
		echo '<td align="left">'.$item["nama_ayat"].'</td>';
		echo '<td align="left">'.$item["no_kohir"].'</td>';
		echo '<td align="left">'.$item["wp_name"].'</td>';
		echo '<td align="left">'.$item["npwpd"].'</td>';
		echo '<td align="right">'.number_format($item["jumlah_terima"], 0, ",", ".").'</td>';
		echo '<td align="left">'.$item["masa_pajak"].'</td>';
		echo '<td align="left">'.$item["kd_tap"].'</td>';
		echo '<td align="left">'.$item["payment_date"].'</td>';
		echo '</tr>';

		$no++;

		//hitung jumlahperayat sampai baris ini
		$jumlahtemp += $item["jumlah_terima"];
		$total += $item["jumlah_terima"];
		
		//cek apakah perlu bikin baris jumlah
		//jika iya, simpan jumlahtemp ke jumlahperayat, print jumlahtemp, reset jumlahtemp
		$ayat = $item["kode_ayat"];
		$ayatsesudah = $data[$i+1]["kode_ayat"];

		if(($ayat != $ayatsesudah && count($data)>1) || empty($data[$i+1])){
			$jumlahperayat[] = $jumlahtemp;
			
			echo '<tr>
				<td align="center" colspan="9"> <b> JUMLAH '.strtoupper($item["jns_pajak"])." ".$item["nama_ayat"].' </b></td>
				<td align="right"><b>'.number_format($jumlahtemp, 0, ",", ".").'</b></td>
			</tr>';
			$jumlahtemp = 0;				
		}

		$i++;

	}

	echo '<tr>
		<td align="center" colspan="9"> <b>TOTAL '.strtoupper($item["jns_pajak"]).'</b></td>
		<td align="right"><b>'.number_format($total, 0, ",", ".").'</b></td>
	</tr>';
	
	echo '</table>';
	exit;
}

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

?>

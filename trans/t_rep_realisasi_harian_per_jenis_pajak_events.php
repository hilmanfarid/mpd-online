<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-6794A5EF
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_realisasi_harian_per_jenis_pajak; //Compatibility
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

//Page_BeforeShow @1-2A8008CF
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_realisasi_harian_per_jenis_pajak; //Compatibility
//End Page_BeforeShow

//Custom Code @568-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$doAction = CCGetFromGet('doAction');
	
	if($doAction == 'download_excel') {
		$param_arr=array();

		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
		$param_arr['i_flag_setoran'] = CCGetFromGet('i_flag_setoran');
		$param_arr['tgl_penerimaan_last'] = CCGetFromGet('tgl_penerimaan_last');
		$param_arr['jenis_laporan'] = CCGetFromGet("jenis_laporan", "all");

		print_excel($param_arr);

	}


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function print_excel($param_arr) {
	$date_start=str_replace("'", "",$param_arr['tgl_penerimaan']);
	$year_date = DateTime::createFromFormat('d-m-Y', $date_start)->format('Y');
	startExcel("laporan_realisasi_harian_per_jenis_pajak.xls");
	echo "<div><h3> LAPORAN REALISASI HARIAN PER JENIS PAJAK</h3></div>";	
	echo "<div> Tahun ".$year_date."</div>";	
	echo "<div> Tanggal Penerimaan ".str_replace("'", "",$param_arr['tgl_penerimaan'])."-".str_replace("'", "",$param_arr['tgl_penerimaan_last'])."</div><br>";	
	echo '<table border="1" width="100%"> ';
	echo '<tr>
			<th>NO</th>
			<th>NO AYAT</th>
			<th>NAMA AYAT</th>
			<th>NO KOHIR</th>
			<th>NAMA WP</th>
			<th>NPWPD</th>
			<th>JUMLAH</th>
			<th>MASA PAJAK</th>
			<th>TANGGAL TAP</th>
			<th>TANGGAL BAYAR</th>
	  </tr>
	 ';

	$dbConn = new clsDBConnSIKP();
	
	
	if($param_arr['jenis_laporan'] == 'all'){
		$query	= "select *,trunc(payment_date) from f_rep_bpps(".$param_arr['p_vat_type_id'].",
		".$param_arr['p_year_period_id'].", ".$param_arr['tgl_penerimaan'].", 
		".$param_arr['tgl_penerimaan_last'].", ".$param_arr['i_flag_setoran'].") 
		order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
	}else if($param_arr['jenis_laporan'] == 'piutang'){
		$query	= "select *,trunc(payment_date) 
		from f_rep_bpps_piutang(".$param_arr['p_vat_type_id'].", ".$param_arr['p_year_period_id'].",
		".$param_arr['tgl_penerimaan'].", ".$param_arr['tgl_penerimaan_last'].",
		".$param_arr['i_flag_setoran'].") rep
	WHERE
		EXTRACT (YEAR FROM rep.settlement_date) < $year_date
		order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
	}else if($param_arr['jenis_laporan'] == 'murni'){
		$query	= "select *,trunc(payment_date) 
		from f_rep_bpps_piutang(".$param_arr['p_vat_type_id'].", ".$param_arr['p_year_period_id'].",
		".$param_arr['tgl_penerimaan'].", ".$param_arr['tgl_penerimaan_last'].",
		".$param_arr['i_flag_setoran'].") rep
	WHERE
		EXTRACT (YEAR FROM rep.settlement_date) = $year_date
		order by kode_jns_trans, kode_jns_pajak, kode_ayat";
	}

	//echo ($query);
	//exit;
	$dbConn->query($query);
	$data = array();
	

	while($dbConn->next_record()){
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
	
	$total_nilai_penerimaan = 0;
	$no = 1;
	
	foreach ($data as $item){
		echo '<tr>';
		echo '<td align="center">'.$no.'</td>';
		echo '<td align="center">'.$item['kode_jns_pajak'].' '.$item['kode_ayat'].'</td>';
		echo '<td align="left">&nbsp;'.$item['nama_ayat'].'</td>';
		echo '<td align="left">'.$item['no_kohir'].'</td>';
		echo '<td align="left">'.trim(strtoupper($item['wp_name'])).'</td>';
		echo '<td align="left">'.$item['npwpd'].'</td>';
		echo '<td align="right">'.number_format($item['jumlah_terima'],2,",",".").'</td>';
		echo '<td align="left">'.$item['masa_pajak'].'</td>';
		echo '<td align="center">'.$item['kd_tap'].'</td>';
		echo '<td align="center">'.$item['payment_date'].'</td>';
		echo '</tr>';
		
		$total_nilai_penerimaan += $item['jumlah_terima'];
		$no++;
	}

	echo '<tr>
			<td colspan="9" align="center"> <b>TOTAL</b> </td>
			<td align="right"><b>'.number_format($total_nilai_penerimaan,2,",",".").'</b></td>
		 </tr>';
	echo '</table>';
	exit;
}

function startExcel($filename) {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}


?>

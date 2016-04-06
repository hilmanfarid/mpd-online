<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-0E1C0721
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_bpps2; //Compatibility
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

//Page_BeforeShow @1-7EEBD936
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_bpps2; //Compatibility
//End Page_BeforeShow

//Custom Code @568-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	$cetak = CCGetFromGet('cetak');
	if ($cetak == 'html'){
		$Label1->SetText(PageCetak());
	}
	if ($cetak == 'excel'){
		PageCetak();
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function PageCetak() {
	$data				= array();
	$dbConn				= new clsDBConnSIKP();
	$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
	$p_year_period_id	= CCGetFromGet("p_year_period_id", "");
	$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");
	$i_flag_setoran		= CCGetFromGet("i_flag_setoran", "");
	$kode_bank			= CCGetFromGet("kode_bank", "");
	$status				= CCGetFromGet("status", "");
	
    
	$query				= "select b.payment_key, a.* 
						from f_rep_bpps_mod_4($p_vat_type_id, $p_year_period_id, '$tgl_penerimaan',$i_flag_setoran,'$kode_bank', '$status') a
						left join t_vat_setllement b on b.t_vat_setllement_id=a.t_vat_setllement_id
						order by kode_jns_trans, kode_jns_pajak, kode_ayat";
	//die($query);
	$dbConn->query($query);

	$tgl_penerimaan2 = $tgl_penerimaan;
	$tgl_penerimaan = str_replace("'", "", $tgl_penerimaan);
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
		"payment_key"		=> $dbConn->f("payment_key"),
		"brand_name"		=> $dbConn->f("brand_name"),
		"status"		=> $dbConn->f("status"),
		"jam"		=> $dbConn->f("jam"));
	}

	$cetak = CCGetFromGet('cetak');
	if($cetak == 'excel') {
		startExcel("laporan_bpps.xls");
	}

	$output='';
		
	$output.='<table>
				<tr>';
	$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderLeft"></td> 
              <td class="th"><strong>LAPORAN BPPS</strong></td> 
              <td class="HeaderRight"></td>
            </tr>
          </table>

          <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
            <tr class="Caption">';

//NO. NO. AYAT NAMA AYAT NO. KOHIR NAMA WP NPWPD JUMLAH MASA PAJAK TGL TAP KET.
	$output.='<th style="text-align:center;">NO</th>';
	$output.='<th style="text-align:center;">NO. AYAT</th>';
	$output.='<th style="text-align:center;">NAMA AYAT</th>';
	$output.='<th style="text-align:center;">NO. KOHIR</th>';
	$output.='<th style="text-align:center;">NO. BAYAR</th>';
	$output.='<th style="text-align:center;">NAMA WP</th>';
	$output.='<th style="text-align:center;">MERK DAGANG</th>';
	$output.='<th style="text-align:center;">NPWPD</th>';
	$output.='<th style="text-align:center;">JUMLAH</th>';
	$output.='<th style="text-align:center;">MASA PAJAK</th>';
	$output.='<th style="text-align:center;">TGL TAP</th>';
	$output.='<th style="text-align:center;">KET.</th>';
	$output.='<th style="text-align:center;">STATUS.</th>';
	$output.='</tr>';
	$no = 0;
	$jumlahtemp = 0;	
	$total=0;
	foreach($data as $item) {
		$output.='<tr>';
			$output.='<td>'.($no+1).'</td>';
			$output.='<td>'.$item["kode_jns_pajak"].' '.$item["kode_ayat"].'</td>';
			$output.='<td>'.$item["nama_ayat"].'</td>';
			$output.='<td>'.$item["no_kohir"].'</td>';
			$output.='<td>'.$item["payment_key"].'</td>';
			$output.='<td>'.$item["wp_name"].'</td>';
			$output.='<td>'.$item["brand_name"].'</td>';
			$output.='<td>'.$item["npwpd"].'</td>';
			$output.='<td align="right">'.number_format($item["jumlah_terima"], 0, ',', '.').'</td>';
			$output.='<td>'.$item["masa_pajak"].'</td>';
			$output.='<td>'.$item["kd_tap"].'</td>';
			$output.='<td>'.$item["keterangan"].'</td>';
			$output.='<td>'.$item["status"].'</td>';
		$output.='</tr>';

		$jumlahtemp += $item["jumlah_terima"];
		$total+= $item["jumlah_terima"];

		$ayat = $item["kode_ayat"];
		$ayatsesudah = $data[$no+1]["kode_ayat"];
		if(($ayat != $ayatsesudah && count($data)>1) || empty($data[$no+1])){
			$output.='<tr>';
				$output.='<td colspan=8 align="center">'."JUMLAH " . strtoupper($item["nama_ayat"]).'</td>';
				$output.='<td align="right">'.number_format($jumlahtemp, 0, ',', '.').'</td>';
			$output.='</tr>';
			$jumlahtemp = 0;
			
		}
		$no++;
	}
	$output.='<tr>';
		$output.='<td colspan=8 align="center">'."TOTAL " . strtoupper($item["jns_pajak"]).'</td>';
		$output.='<td align="right">'.number_format($total, 0, ',', '.').'</td>';
	$output.='</tr>';

	if($cetak == 'excel') {
		echo $output;
		exit;
	}
	return $output;
}

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

?>

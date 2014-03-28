<?php
//BindEvents Method @1-FA3AC75D
function BindEvents()
{
    global $CCSEvents;
	$CCSEvents["BeforeShow"] = "Page_BeforeShow";
    //$CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_bpps_piutang2; //Compatibility
//End Page_BeforeShow
	global $Label1;
// -------------------------
    // Write your own code here.

	$doAction = CCGetFromGet('doAction');
	if($doAction == 'view_html') {
		
		$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
		$p_year_period_id	= CCGetFromGet("p_year_period_id", "");
		$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");
		$i_flag_setoran		= CCGetFromGet("i_flag_setoran", "");
		$tgl_penerimaan_last = CCGetFromGet("tgl_penerimaan_last", "");

		$tgl_penerimaan = "'".$tgl_penerimaan."'";
		$tgl_penerimaan_last = "'".$tgl_penerimaan_last."'";
		

		// $p_vat_type_id		= 1;
		// $p_year_period_id	= 4;
		// $tgl_penerimaan		= '15-12-2013';
		$date_start=str_replace("'", "",$tgl_penerimaan);
		$year_date = DateTime::createFromFormat('d-m-Y', $date_start)->format('Y');

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$jenis_laporan		= CCGetFromGet("jenis_laporan", "all"); 
		if($jenis_laporan == 'all'){
			$query	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
			//echo $query;
			//exit;
		}else if($jenis_laporan == 'piutang'){
			$border= $year_date-1;
			$query	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
		WHERE
			SUBSTRING(rep.masa_pajak,22,4) < $year_date
			AND 
				(NOT (SUBSTRING(rep.masa_pajak,22,4) = $border
				AND SUBSTRING(rep.masa_pajak,19,2) = 12))
			order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
			//echo $query;
			//exit;
		}else if($jenis_laporan == 'murni'){
			$query	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
		WHERE
			EXTRACT (YEAR FROM rep.settlement_date) = $year_date
			order by kode_jns_trans, kode_jns_pajak, kode_ayat";
		}
		//die($query);
		//echo $query;
		//exit;
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
				
		$Label1->SetText(GetCetakHTML($data));
	}
	else {
		
		//do nothing 
	}
	
// -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}


function GetCetakHTML($data) {
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN REALISASI HARIAN MURNI DAN NON MURNI</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .= '<h2>LAPORAN REALISASI HARIAN PER JENIS PAJAK </h2>';
	//$output .= '<h2>TANGGAL : '.dateToString($date_start, "-")." s/d ".dateToString($date_end, "-").'</h2> <br/>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


		$output.='<th>NO</th>';
		$output.='<th>NO AYAT</th>';
		$output.='<th>NAMA AYAT</th>';
		//$output.='<th>NO KOHIR</th>';
		$output.='<th>NAMA WP</th>';
		$output.='<th>NPWPD</th>';
		$output.='<th>JUMLAH</th>';
		$output.='<th>MASA PAJAK</th>';
		$output.='<th>TGL TAP</th>';
		$output.='<th>TGL BAYAR</th>';
		$output.='</tr>';
    
	$jumlahtemp = 0;
	$jumlahperayat = 0;
	$i=0;
	foreach($data as $item) {
		$output .= '<tr>';
		$output .= '<td align="center">'.($i+1).'</td>';
		$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
		$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
		//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
		$output .= '<td align="left">'.$item['wp_name'].'</td>';
		$output .= '<td align="left">'.$item['npwpd'].'</td>';
		$output .= '<td align="right">Rp. '.number_format($item["jumlah_terima"], 2, ',', '.').'</td>';
		$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
		$output .= '<td align="left">'.$item['kd_tap'].'</td>';
		$output .= '<td align="left">'.$item['payment_date'].'</td>';
		$output .= '</tr>';
		

		
		//hitung jumlahperayat sampai baris ini
		$jumlahtemp += $item["jumlah_terima"];
		//$total+= $item["jumlah_terima"];
		//cek apakah perlu bikin baris jumlah
		//jika iya, simpan jumlahtemp ke jumlahperayat, print jumlahtemp, reset jumlahtemp
		$ayat = $item["kode_ayat"];
		$ayatsesudah = $data[$i+1]["kode_ayat"];
		if(($ayat != $ayatsesudah&&count($data)>1)||empty($data[$i+1])){
			$jumlahperayat += $jumlahtemp;
			$output .= '<tr>';
				$output .= '<td align="CENTER" colspan=5>JUMLAH PAJAK '.$item["nama_ayat"].'</td>';
				$output .= '<td align="right">Rp. '.number_format($jumlahtemp, 2, ',', '.').'</td>';
			$output .= '</tr>';
			$jumlahtemp = 0;
			
		}
		$i=$i+1;
	}
	$output .= '<tr>';
		$output .= '<td align="CENTER" colspan=5>TOTAL PAJAK</td>';
		$output .= '<td align="right">Rp. '.number_format($jumlahperayat, 2, ',', '.').'</td>';
	$output .= '</tr>';
	
	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
}


//Page_OnInitializeView @1-16619CEA
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_bpps_piutang2; //Compatibility
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


?>

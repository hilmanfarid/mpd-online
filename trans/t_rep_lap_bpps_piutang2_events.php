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
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) 
			order by kode_ayat, wp_name, masa_pajak";	
			//echo $query;
			//exit;
		}else if($jenis_laporan == 'piutang'){
			$border= $year_date-1;
			$query	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
		WHERE
			(	SUBSTRING(rep.masa_pajak,22,4) < $year_date
				AND 
				(NOT (SUBSTRING(rep.masa_pajak,22,4) = $border
				AND SUBSTRING(rep.masa_pajak,19,2) = 12))
			)
			OR
			(
				(SUBSTRING(rep.masa_pajak,22,4) = $year_date
				AND SUBSTRING(rep.masa_pajak,19,2) = 12)
			)
			OR
			(
				SUBSTRING(rep.masa_pajak,22,4) > $year_date
			)
			order by kode_ayat, wp_name, masa_pajak";	
			//echo $query;
			//exit;
		}else if($jenis_laporan == 'murni'){
			$query	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang3($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
		WHERE
			EXTRACT (YEAR FROM rep.settlement_date) = $year_date
			order by kode_ayat, wp_name, masa_pajak";
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
			if($doAction == 'view_html2') {
		
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
			/*
			if($jenis_laporan == 'all'){
				$query	= "select *
				from f_rep_bpps_list_distinct_semua($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last) order by npwpd";	
				//echo $query;
				//exit;
			}else if($jenis_laporan == 'piutang'){
				$border= $year_date-1;
				$query	= "select *
				from f_rep_bpps_list_distinct_non_murni($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_year_date) rep order by npwpd";	
				//echo $query;
				//exit;
			}else if($jenis_laporan == 'murni'){
				$query	= "select *
				from f_rep_bpps_list_distinct_non_murni($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_year_date) rep order by npwpd";	
			}*/
			if($jenis_laporan == 'all'){
				$query	= "select *,trunc(payment_date) 
				from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) 
				order by kode_ayat, wp_name, masa_pajak";	
				//echo $query;
				//exit;
			}else if($jenis_laporan == 'piutang'){
				$border= $year_date-1;
				$query	= "select *,trunc(payment_date) 
				from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
			WHERE
				(	SUBSTRING(rep.masa_pajak,22,4) < $year_date
					AND 
					(NOT (SUBSTRING(rep.masa_pajak,22,4) = $border
					AND SUBSTRING(rep.masa_pajak,19,2) = 12))
				)
				OR
				(
					(SUBSTRING(rep.masa_pajak,22,4) = $year_date
					AND SUBSTRING(rep.masa_pajak,19,2) = 12)
				)
				OR
				(
					SUBSTRING(rep.masa_pajak,22,4) > $year_date
				)
				order by kode_ayat, wp_name, masa_pajak";	
				//echo $query;
				//exit;
			}else if($jenis_laporan == 'murni'){
				$query	= "select *,trunc(payment_date) 
				from f_rep_bpps_piutang3($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
			WHERE
				EXTRACT (YEAR FROM rep.settlement_date) = $year_date
				order by kode_ayat, wp_name, masa_pajak";
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
			/*
			while ($dbConn->next_record()) {
				$data[]= array(
				"npwpd"			=> $dbConn->f("npwpd"));
			}
			*/
			$dbConn->close();
				
			$Label1->SetText(GetCetakHTML3($data));
		}
		else {		
			//do nothing 
		}
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
	
	$jumlahtemp=0;
	$jumlahperayat=0;
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
		$output .= '<td align="left">'.$item['no_kohir'].'</td>';
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

function GetCetakHTML2($data) {
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


		$output.='<th rowspan = 2 align="center">NO</th>';
		//$output.='<th>NO AYAT</th>';
		//$output.='<th rowspan = 2 align="center">NAMA AYAT</th>';
		//$output.='<th>NO KOHIR</th>';
		$output.='<th rowspan = 2 align="center">NPWPD</th>';
		//$output.='<th rowspan = 2 align="center">NAMA PERUSAHAAN</th>';
		//$output.='<th>JUMLAH</th>';
		//$output.='<th>MASA PAJAK</th>';
		//$output.='<th>TGL TAP</th>';
		//$output.='<th>TGL BAYAR</th>';
		$output.='<th colspan = 12 align=center>REALISASI DAN TANGGAL BAYAR</th>';
		$output.='</tr>';
		$output.='<tr class="Caption">';
			$output.='<th align="center">DESEMBER</th>';
			$output.='<th align="center">JANUARI</th>';
			$output.='<th align="center">FEBRUARI</th>';
			$output.='<th align="center">MARET</th>';
			$output.='<th align="center">APRIL</th>';
			$output.='<th align="center">MEI</th>';
			$output.='<th align="center">JUNI</th>';
			$output.='<th align="center">JULI</th>';
			$output.='<th align="center">AGUSTUS</th>';
			$output.='<th align="center">SEPTEMBER</th>';
			$output.='<th align="center">OKTOBER</th>';
			$output.='<th align="center">NOVEMBER</th>';
		$output.='</tr>';
		
	$i=0;
	foreach($data as $item) {
		$output .= '<tr>';
		$output .= '<td align="center">'.($i+1).'</td>';
		//$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
		//$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
		//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
		$output .= '<td align="left">'.$item['npwpd'].'</td>';
		//$output .= '<td align="left">'.$item['wp_name'].'</td>';
		//$output .= '<td align="right">Rp. '.number_format($item["jumlah_terima"], 2, ',', '.').'</td>';
		//$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
		//$output .= '<td align="left">'.$item['kd_tap'].'</td>';
		//$output .= '<td align="left">'.$item['payment_date'].'</td>';
		
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
		$data2				= array();
		$dbConn2				= new clsDBConnSIKP();
		$jenis_laporan		= CCGetFromGet("jenis_laporan", "all");
    
	
		if($jenis_laporan == 'all'){
			$query2	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) 
			where npwpd = '".$item['npwpd']."'
			order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
			//echo $query;
			//exit;
		}else if($jenis_laporan == 'piutang'){
			$border= $year_date-1;
			$query2	= "select *, trunc(payment_date) 
			from f_rep_bpps_piutang2($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
			where (npwpd ='".$item['npwpd']."')
			AND
			(
				(	SUBSTRING(rep.masa_pajak,22,4) < $year_date
					AND 
					(NOT (SUBSTRING(rep.masa_pajak,22,4) = $border
					AND SUBSTRING(rep.masa_pajak,19,2) = 12))
				)
				OR
				(
					(SUBSTRING(rep.masa_pajak,22,4) = $year_date
					AND SUBSTRING(rep.masa_pajak,19,2) = 12)
				)
				OR
				(
					SUBSTRING(rep.masa_pajak,22,4) > $year_date
				)
			)
			order by kode_jns_trans, kode_jns_pajak, kode_ayat";	
			//echo $query;
			//exit;
		}else if($jenis_laporan == 'murni'){
			$query2	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) rep
			where npwpd ='".$item['npwpd']."'
			AND
			EXTRACT (YEAR FROM rep.settlement_date) = $year_date
			order by kode_jns_trans, kode_jns_pajak, kode_ayat";
		}
		//echo $query;
		//exit;

		
		$dbConn2->query($query2);

		$tgl_penerimaan = str_replace("'", "", $tgl_penerimaan);
		$tgl_penerimaan_last = str_replace("'", "", $tgl_penerimaan_last);
		$tahun = date("Y", strtotime($tgl_penerimaan));
		while ($dbConn2->next_record()) {
			$data2[]= array(
			//"kode_jns_trans"	=> $dbConn2->f("kode_jns_trans"),
			//"jns_trans"		=> $dbConn2->f("jns_trans"),
			//"kode_jns_pajak"	=> $dbConn2->f("kode_jns_pajak"),
			//"kode_ayat"		=> $dbConn2->f("kode_ayat"),
			//"jns_pajak"		=> $dbConn2->f("jns_pajak"),
			//"jns_ayat"			=> $dbConn2->f("jns_ayat"),
			//"nama_ayat"		=> $dbConn2->f("nama_ayat"),
			//"no_kohir"		=> $dbConn2->f("no_kohir"),
			//"wp_name"			=> $dbConn2->f("wp_name"),
			//"wp_address_name"	=> $dbConn2->f("wp_address_name"),
			//"wp_address_no"		=> $dbConn2->f("wp_address_no"),
			//"npwpd"			=> $dbConn2->f("npwpd"),
			"jumlah_terima"	=> $dbConn2->f("jumlah_terima"),
			"masa_pajak"		=> $dbConn2->f("masa_pajak")
			//"kd_tap"			=> $dbConn2->f("kd_tap"),
			//"keterangan"		=> $dbConn2->f("keterangan"),
			//"payment_date"		=> $dbConn2->f("payment_date"),
			//"jam"		=> $dbConn2->f("jam")
			);
		}

		$dbConn2->close();
		
		$jan=0;
		$feb=0;
		$mar=0;
		$apr=0;
		$mei=0;
		$jun=0;
		$jul=0;
		$agu=0;
		$sep=0;
		$okt=0;
		$nov=0;
		$des=0;
		foreach($data2 as $item2) {
			$bln = substr($item2["masa_pajak"],-7,2);
			switch ($bln) {
			    case "12":
			        $des=$des+$item2["jumlah_terima"];
			        break;
			    case "01":
					$jan=$jan+$item2["jumlah_terima"];
			        break;
			    case "02":
			        $feb=$feb+$item2["jumlah_terima"];
			        break;
			    case "03":
			        $mar=$mar+$item2["jumlah_terima"];
			        break;
			    case "04":
			        $apr=$apr+$item2["jumlah_terima"];
			        break;
			    case "05":
			        $mei=$mei+$item2["jumlah_terima"];
			        break;
			    case "06":
			        $jun=$jun+$item2["jumlah_terima"];
			        break;
			    case "07":
			        $jul=$jul+$item2["jumlah_terima"];
			        break;
			    case "08":
			        $agu=$agu+$item2["jumlah_terima"];
			        break;
			    case "09":
			        $sep=$sep+$item2["jumlah_terima"];
			        break;
			    case "10":
			        $okt=$okt+$item2["jumlah_terima"];
			        break;
			    case "11":
			        $nov=$nov+$item2["jumlah_terima"];
			        break;

			}

			//$output .= '<td align="right">Rp. '.number_format($item2["jumlah_terima"], 2, ',', '.').'</td>';
			//$output .= '<td align="right"></td>';
		}
		
		

		
		$output .= '</tr>';
		$i++;
	}
	
	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
}

function GetCetakHTML3($data) {
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


	$output.='<th rowspan = 2>NO</th>';
	$output.='<th rowspan = 2>NO AYAT</th>';
	$output.='<th rowspan = 2>NAMA AYAT</th>';
	//$output.='<th>NO KOHIR</th>';
	$output.='<th rowspan = 2>NAMA WP</th>';
	$output.='<th rowspan = 2>NPWPD</th>';
	$output.='<th colspan = 13 align=center>REALISASI DAN TANGGAL BAYAR</th>';
	$output.='</tr>';
		$output.='<tr class="Caption">';
			$output.='<th align="center">DESEMBER</th>';
			$output.='<th align="center">JANUARI</th>';
			$output.='<th align="center">FEBRUARI</th>';
			$output.='<th align="center">MARET</th>';
			$output.='<th align="center">APRIL</th>';
			$output.='<th align="center">MEI</th>';
			$output.='<th align="center">JUNI</th>';
			$output.='<th align="center">JULI</th>';
			$output.='<th align="center">AGUSTUS</th>';
			$output.='<th align="center">SEPTEMBER</th>';
			$output.='<th align="center">OKTOBER</th>';
			$output.='<th align="center">NOVEMBER</th>';
			$output.='<th align="center">JUMLAH</th>';
		$output.='</tr>';
	$output.='</tr>';
	
	$jumlahtemp=0;
	$jumlahperayat=0;
	$i=0;
	$i2=0;
	$before=0;
	$new=0;
	$jan=0;
	$feb=0;
	$mar=0;
	$apr=0;
	$mei=0;
	$jun=0;
	$jul=0;
	$agu=0;
	$sep=0;
	$okt=0;
	$nov=0;
	$des=0;
	foreach($data as $item) {
		$bln = substr($item["masa_pajak"],-7,2);
		if ($new == 0){
			$output .= '<tr>';
			$output .= '<td align="center">'.($i+1).'</td>';
			$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
			$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
			//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
			$output .= '<td align="left">'.$item['wp_name'].'</td>';
			$output .= '<td align="left">'.$item['npwpd'].'</td>';
			//$before = $item;
			switch ($bln) {
			    case "12":
			        $des=$des+$item["jumlah_terima"];
			        break;
			    case "01":
					$jan=$jan+$item["jumlah_terima"];
			        break;
			    case "02":
			        $feb=$feb+$item["jumlah_terima"];
			        break;
			    case "03":
			        $mar=$mar+$item["jumlah_terima"];
			        break;
			    case "04":
			        $apr=$apr+$item["jumlah_terima"];
			        break;
			    case "05":
			        $mei=$mei+$item["jumlah_terima"];
			        break;
			    case "06":
			        $jun=$jun+$item["jumlah_terima"];
			        break;
			    case "07":
			        $jul=$jul+$item["jumlah_terima"];
			        break;
			    case "08":
			        $agu=$agu+$item["jumlah_terima"];
			        break;
			    case "09":
			        $sep=$sep+$item["jumlah_terima"];
			        break;
			    case "10":
			        $okt=$okt+$item["jumlah_terima"];
			        break;
			    case "11":
			        $nov=$nov+$item["jumlah_terima"];
			        break;
			}
			//$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
			//$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
			//$output .= '<td align="left">'.$item['kd_tap'].'</td>';
			//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
			//$output .= '</tr>';
			$jumlahtemp += $item["jumlah_terima"];
			$new =1;
		}else{
			if ($before['npwpd']==$item['npwpd']){				
				switch ($bln) {
				    case "12":
				        $des=$des+$item["jumlah_terima"];
				        break;
				    case "01":
						$jan=$jan+$item["jumlah_terima"];
				        break;
				    case "02":
				        $feb=$feb+$item["jumlah_terima"];
				        break;
				    case "03":
				        $mar=$mar+$item["jumlah_terima"];
				        break;
				    case "04":
				        $apr=$apr+$item["jumlah_terima"];
				        break;
				    case "05":
				        $mei=$mei+$item["jumlah_terima"];
				        break;
				    case "06":
				        $jun=$jun+$item["jumlah_terima"];
				        break;
				    case "07":
				        $jul=$jul+$item["jumlah_terima"];
				        break;
				    case "08":
				        $agu=$agu+$item["jumlah_terima"];
				        break;
				    case "09":
				        $sep=$sep+$item["jumlah_terima"];
				        break;
				    case "10":
				        $okt=$okt+$item["jumlah_terima"];
				        break;
				    case "11":
				        $nov=$nov+$item["jumlah_terima"];
				        break;
				}
				//$output .= '</tr>';
				//$output .= '<td align="CENTER" colspan=5></td>';
				//$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
				//$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
				//$output .= '<td align="left">'.$item['kd_tap'].'</td>';
				//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
				//$output .= '</tr>';
				$jumlahtemp += $item["jumlah_terima"];
				$ayat = $item["kode_ayat"];
			}else{
				$output .= '<td align="right">'.number_format($des, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jan, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($feb, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($mar, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($apr, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($mei, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jun, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jul, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($agu, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($sep, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($okt, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($nov, 2, ',', '.').'</td>';
				//$new=0;
				//$output .= '<tr>';
				$jumlahperayat += $jumlahtemp;
				//$output .= '<tr>';
					//$output .= '<td align="CENTER" colspan=5>JUMLAH PAJAK '.$before["wp_name"].'</td>';
					$output .= '<td align="right">'.number_format($jumlahtemp, 2, ',', '.').'</td>';
				$output .= '</tr>';
				$jumlahtemp=0;
				$jan=0;
				$feb=0;
				$mar=0;
				$apr=0;
				$mei=0;
				$jun=0;
				$jul=0;
				$agu=0;
				$sep=0;
				$okt=0;
				$nov=0;
				$des=0;
				$output .= '<td align="center">'.($i+1).'</td>';
				$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
				$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
				//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
				$output .= '<td align="left">'.$item['wp_name'].'</td>';
				$output .= '<td align="left">'.$item['npwpd'].'</td>';
				//$before = $item;
				//$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
				switch ($bln) {
				    case "12":
				        $des=$des+$item["jumlah_terima"];
				        break;
				    case "01":
						$jan=$jan+$item["jumlah_terima"];
				        break;
				    case "02":
				        $feb=$feb+$item["jumlah_terima"];
				        break;
				    case "03":
				        $mar=$mar+$item["jumlah_terima"];
				        break;
				    case "04":
				        $apr=$apr+$item["jumlah_terima"];
				        break;
				    case "05":
				        $mei=$mei+$item["jumlah_terima"];
				        break;
				    case "06":
				        $jun=$jun+$item["jumlah_terima"];
				        break;
				    case "07":
				        $jul=$jul+$item["jumlah_terima"];
				        break;
				    case "08":
				        $agu=$agu+$item["jumlah_terima"];
				        break;
				    case "09":
				        $sep=$sep+$item["jumlah_terima"];
				        break;
				    case "10":
				        $okt=$okt+$item["jumlah_terima"];
				        break;
				    case "11":
				        $nov=$nov+$item["jumlah_terima"];
				        break;
				}
				//$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
				//$output .= '<td align="left">'.$item['kd_tap'].'</td>';
				//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
				//$output .= '</tr>';
				$jumlahtemp += $item["jumlah_terima"];
				$i=$i+1;
				
			}
		}
				
		$before = $item;
		$i2=$i2+1;
		if(empty($data[$i2]))
		{
			$output .= '<td align="right">'.number_format($des, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($jan, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($feb, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($mar, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($apr, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($mei, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($jun, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($jul, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($agu, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($sep, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($okt, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($nov, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.number_format($jumlahtemp, 2, ',', '.').'</td>';
			$output .= '</tr>';
		}
	}
	$output .= '<tr>';
		$output .= '<td align="CENTER" colspan=17>TOTAL PAJAK</td>';
		$output .= '<td align="right">'.number_format($jumlahperayat, 2, ',', '.').'</td>';
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

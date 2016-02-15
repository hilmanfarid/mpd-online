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
	if($doAction == 'view_html2') {
		$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
		$p_year_period_id	= CCGetFromGet("p_year_period_id", "");
		$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");
		$tgl_penerimaan_last = CCGetFromGet("tgl_penerimaan_last", "");
		$year_code = CCGetFromGet("year_code", "");

		$tgl_penerimaan = "'".$tgl_penerimaan."'";
		$tgl_penerimaan_last = "'".$tgl_penerimaan_last."'";
	
		$date_start=str_replace("'", "",$year_code);
		$year_date = $year_code;

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$jenis_laporan		= CCGetFromGet("jenis_laporan", "all"); 
		
		$query	= "select to_char(active_date,'dd-mm-yyyy') as active_date2,*,
			case 
				when payment_date is not null then to_char(payment_date,'dd-mm-yyyy')
				else ''
			end as payment_date 
		from f_rep_bpps_piutang2new_mod_1($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, 1) a
		left join t_cust_account x on a.npwpd = x.npwd 
		order by kode_ayat, npwpd, masa_pajak";	
		//echo $query;
		//exit;
		$dbConn->query($query);

		$tgl_penerimaan = str_replace("'", "", $tgl_penerimaan);
		$tgl_penerimaan_last = str_replace("'", "", $tgl_penerimaan_last);
		$tahun = date("Y", strtotime($tgl_penerimaan));
		while ($dbConn->next_record()) {
			$data[]= array(
			"address"	=> $dbConn->f("address"),
			"company_name"	=> $dbConn->f("company_name"),
			"kode_jns_trans"	=> $dbConn->f("kode_jns_trans"),
			"jns_trans"		=> $dbConn->f("jns_trans"),
			"kode_jns_pajak"	=> $dbConn->f("kode_jns_pajak"),
			"kode_ayat"		=> $dbConn->f("kode_ayat"),
			"jns_pajak"		=> $dbConn->f("jns_pajak"),
			"jns_ayat"			=> $dbConn->f("jns_ayat"),
			"nama_ayat"		=> $dbConn->f("nama_ayat"),
			"no_kohir"		=> $dbConn->f("no_kohir"),
			"wp_name"			=> $dbConn->f("company_brand"),
			"wp_address_name"	=> $dbConn->f("brand_address_name"),
			"wp_address_no"		=> $dbConn->f("brand_address_no"),
			"active_date2"		=> $dbConn->f("active_date2"),
			"npwpd"			=> $dbConn->f("npwpd"),
			"jumlah_terima"	=> $dbConn->f("jumlah_terima"),
			"masa_pajak"		=> $dbConn->f("masa_pajak"),
			"kd_tap"			=> $dbConn->f("kd_tap"),
			"keterangan"		=> $dbConn->f("keterangan"),
			"payment_date"		=> $dbConn->f("payment_date"),
			"jam"		=> $dbConn->f("jam"));
		}
		
		$Label1->SetText(GetCetakHTML2($data));	
	}
	
// -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}

function GetCetakHTML2($data) {
	$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");
	$year_code = CCGetFromGet("year_code", "");
	$date_start=str_replace("'", "",$year_code);
	//$year_date = DateTime::createFromFormat('d-m-Y', $date_start)->format('Y');
	$year_date = $year_code;
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN KETETAPAN DAN REALISASI</strong></td> 
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
	$output.='<th rowspan = 2>MERK DAGANG</th>';
	$output.='<th rowspan = 2>ALAMAT MERK DAGANG</th>';
	$output.='<th rowspan = 2>TANGGAL PENGUKUHAN</th>';
	$output.='<th rowspan = 2>NPWPD</th>';

	$output.='<th colspan = 14 align=center>REALISASI DAN TANGGAL BAYAR</th>';
	$output.='<th rowspan = 2>KETETAPAN REALISASI</th>';
	$output.='<th rowspan = 2>JUMLAH <BR>BULAN BAYAR</th>';
	$output.='<th rowspan = 2>RATA-RATA KETETAPAN</th>';
	$output.='</tr>';
		$output.='<tr class="Caption">';
			$output.='<th align="center">SEBELUM DESEMBER '.($year_date-1).'</th>';
			$output.='<th align="center">DESEMBER '.($year_date-1).'</th>';
			$output.='<th align="center">JANUARI '.$year_date.'</th>';
			$output.='<th align="center">FEBRUARI '.$year_date.'</th>';
			$output.='<th align="center">MARET '.$year_date.'</th>';
			$output.='<th align="center">APRIL '.$year_date.'</th>';
			$output.='<th align="center">MEI '.$year_date.'</th>';
			$output.='<th align="center">JUNI '.$year_date.'</th>';
			$output.='<th align="center">JULI '.$year_date.'</th>';
			$output.='<th align="center">AGUSTUS '.$year_date.'</th>';
			$output.='<th align="center">SEPTEMBER '.$year_date.'</th>';
			$output.='<th align="center">OKTOBER '.$year_date.'</th>';
			$output.='<th align="center">NOVEMBER '.$year_date.'</th>';
			$output.='<th align="center">SETELAH NOVEMBER '.$year_date.'</th>';
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
	$xdes=0;
	$xnov=0;
	$tgl_bayar_jan= '';
	$tgl_bayar_feb= '';
	$tgl_bayar_mar= '';
	$tgl_bayar_apr= '';
	$tgl_bayar_mei= '';
	$tgl_bayar_jun= '';
	$tgl_bayar_jul= '';
	$tgl_bayar_agu= '';
	$tgl_bayar_sep= '';
	$tgl_bayar_okt= '';
	$tgl_bayar_nov= '';
	$tgl_bayar_des= '';
	$tgl_bayar_xdes='';
	$tgl_bayar_xnov='';
	$jumlah_jan= 0;
	$jumlah_feb= 0;
	$jumlah_mar= 0;
	$jumlah_apr= 0;
	$jumlah_mei= 0;
	$jumlah_jun= 0;
	$jumlah_jul= 0;
	$jumlah_agu= 0;
	$jumlah_sep= 0;
	$jumlah_okt= 0;
	$jumlah_nov= 0;
	$jumlah_des= 0;
	$jumlah_xdes=0;
	$jumlah_xnov=0;
	$jumlah_jan_per_ayat= 0;
	$jumlah_feb_per_ayat= 0;
	$jumlah_mar_per_ayat= 0;
	$jumlah_apr_per_ayat= 0;
	$jumlah_mei_per_ayat= 0;
	$jumlah_jun_per_ayat= 0;
	$jumlah_jul_per_ayat= 0;
	$jumlah_agu_per_ayat= 0;
	$jumlah_sep_per_ayat= 0;
	$jumlah_okt_per_ayat= 0;
	$jumlah_nov_per_ayat= 0;
	$jumlah_des_per_ayat= 0;
	$jumlah_xdes_per_ayat=0;
	$jumlah_xnov_per_ayat=0;
	$jumlah_per_wp = 0;
	$jumlah_bulan_bayar = 0;
	$ketetapan_realisasi = 0; //jumlah pembayaran
	foreach($data as $item) {
		$bln = substr($item["masa_pajak"],-7,2);
		$thn = substr($item["masa_pajak"],-4,4);
		if ($new == 0){
			$output .= '<tr>';
			$output .= '<td align="center">'.($i+1).'</td>';
			$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
			$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
			//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
			$output .= '<td align="left">'.$item['wp_name'].'</td>';
			$output .= '<td align="left">'.$item['wp_address_name'].' '.$item['wp_address_no'].'</td>';
			$output .= '<td align="left">'.$item['active_date2'].'</td>';
			$output .= '<td align="left">'.$item['npwpd'].'</td>';
			//$before = $item;
			if ($thn == $year_date && $bln != 12){
				switch ($bln) {
				    case "01":
						$jan=$jan+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_jan=$jumlah_jan+$item["jumlah_terima"];
						$jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_jan=$item["payment_date"];
				        break;
				    case "02":
				        $feb=$feb+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_feb=$jumlah_feb+$item["jumlah_terima"];
						$jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_feb=$item["payment_date"];
				        break;
				    case "03":
				        $mar=$mar+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_mar=$jumlah_mar+$item["jumlah_terima"];
						$jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_mar=$item["payment_date"];
				        break;
				    case "04":
				        $apr=$apr+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_apr=$jumlah_apr+$item["jumlah_terima"];
						$jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_apr=$item["payment_date"];
				        break;
				    case "05":
				        $mei=$mei+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_mei=$jumlah_mei+$item["jumlah_terima"];
						$jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_mei=$item["payment_date"];
				        break;
				    case "06":
				        $jun=$jun+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_jun=$jumlah_jun+$item["jumlah_terima"];
						$jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_jun=$item["payment_date"];
				        break;
				    case "07":
				        $jul=$jul+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_jul=$jumlah_jul+$item["jumlah_terima"];
						$jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_jul=$item["payment_date"];
				        break;
				    case "08":
				        $agu=$agu+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_agu=$jumlah_agu+$item["jumlah_terima"];
						$jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_agu=$item["payment_date"];
				        break;
				    case "09":
				        $sep=$sep+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_sep=$jumlah_sep+$item["jumlah_terima"];
						$jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_sep=$item["payment_date"];
				        break;
				    case "10":
				        $okt=$okt+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_okt=$jumlah_okt+$item["jumlah_terima"];
						$jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_okt=$item["payment_date"];
				        break;
				    case "11":
				        $nov=$nov+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_nov=$jumlah_nov+$item["jumlah_terima"];
						$jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_nov=$item["payment_date"];
				        break;
				}
			}else{
				if ($thn == ($year_date - 1) && $bln == 12){
					$des=$des+$item["jumlah_terima"];
					$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
					if ($item["jumlah_terima"] > 0){
						$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
					}
					$jumlah_des=$jumlah_des+$item["jumlah_terima"];
					$jumlah_des_per_ayat=$jumlah_des_per_ayat+$item["jumlah_terima"];
					$tgl_bayar_des=$item["payment_date"];
				}
				else{
					if ($thn < $year_date){
						$xdes=$xdes+$item["jumlah_terima"];
						$jumlah_xdes=$jumlah_xdes+$item["jumlah_terima"];
						$jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_xdes=$item["payment_date"];
					}
					else{
						if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
								$xnov=$xnov+$item["jumlah_terima"];
								$jumlah_xnov=$jumlah_xnov+$item["jumlah_terima"];
								$jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$item["jumlah_terima"];
								$tgl_bayar_xnov=$item["payment_date"];
						}
					}
				}
			}
			//$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
			//$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
			//$output .= '<td align="left">'.$item['kd_tap'].'</td>';
			//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
			//$output .= '</tr>';
			$jumlahtemp += $item["jumlah_terima"];
			$new =1;
			$i = $i+1;
			//$i2 = $i2 + 1;
		}else{
			if ($before['npwpd']==$item['npwpd']){				
				if ($thn == $year_date && $bln != 12){
					switch ($bln) {
					    case "01":
							$jan=$jan+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_jan=$jumlah_jan+$item["jumlah_terima"];
							$jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_jan=$item["payment_date"];
					        break;
					    case "02":
					        $feb=$feb+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_feb=$jumlah_feb+$item["jumlah_terima"];
							$jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_feb=$item["payment_date"];
					        break;
					    case "03":
					        $mar=$mar+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_mar=$jumlah_mar+$item["jumlah_terima"];
							$jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_mar=$item["payment_date"];
					        break;
					    case "04":
					        $apr=$apr+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_apr=$jumlah_apr+$item["jumlah_terima"];
							$jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_apr=$item["payment_date"];
					        break;
					    case "05":
					        $mei=$mei+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_mei=$jumlah_mei+$item["jumlah_terima"];
							$jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_mei=$item["payment_date"];
					        break;
					    case "06":
					        $jun=$jun+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_jun=$jumlah_jun+$item["jumlah_terima"];
							$jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_jun=$item["payment_date"];
					        break;
					    case "07":
					        $jul=$jul+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_jul=$jumlah_jul+$item["jumlah_terima"];
							$jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_jul=$item["payment_date"];
					        break;
					    case "08":
					        $agu=$agu+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_agu=$jumlah_agu+$item["jumlah_terima"];
							$jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_agu=$item["payment_date"];
					        break;
					    case "09":
					        $sep=$sep+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_sep=$jumlah_sep+$item["jumlah_terima"];
							$jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_sep=$item["payment_date"];
					        break;
					    case "10":
					        $okt=$okt+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_okt=$jumlah_okt+$item["jumlah_terima"];
							$jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_okt=$item["payment_date"];
					        break;
					    case "11":
					        $nov=$nov+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_nov=$jumlah_nov+$item["jumlah_terima"];
							$jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_nov=$item["payment_date"];
					        break;
					}
				}else{
					if ($thn == ($year_date - 1) && $bln == 12){
						$des=$des+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_des=$jumlah_des+$item["jumlah_terima"];
						$jumlah_des_per_ayat=$jumlah_des_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_des=$item["payment_date"];
					}
					else{
						if ($thn < $year_date){
							$xdes=$xdes+$item["jumlah_terima"];
							$jumlah_xdes=$jumlah_xdes+$item["jumlah_terima"];
							$jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_xdes=$item["payment_date"];
						}
						else{
							if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
									$xnov=$xnov+$item["jumlah_terima"];
									$jumlah_xnov=$jumlah_xnov+$item["jumlah_terima"];
									$jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$item["jumlah_terima"];
									$tgl_bayar_xnov=$item["payment_date"];
							}
						}
					}
				}
				$jumlahtemp += $item["jumlah_terima"];
				$ayat = $item["kode_ayat"];
			}else{
				$output .= '<td align="right">'.number_format($xdes, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_xdes.'</td>';
				$output .= '<td align="right">'.number_format($des, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_des.'</td>';
				$output .= '<td align="right">'.number_format($jan, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_jan.'</td>';
				$output .= '<td align="right">'.number_format($feb, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_feb.'</td>';
				$output .= '<td align="right">'.number_format($mar, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_mar.'</td>';
				$output .= '<td align="right">'.number_format($apr, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_apr.'</td>';
				$output .= '<td align="right">'.number_format($mei, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_mei.'</td>';
				$output .= '<td align="right">'.number_format($jun, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_jun.'</td>';
				$output .= '<td align="right">'.number_format($jul, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_jul.'</td>';
				$output .= '<td align="right">'.number_format($agu, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_agu.'</td>';
				$output .= '<td align="right">'.number_format($sep, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_sep.'</td>';
				$output .= '<td align="right">'.number_format($okt, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_okt.'</td>';
				$output .= '<td align="right">'.number_format($nov, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_nov.'</td>';
				$output .= '<td align="right">'.number_format($xnov, 2, ',', '.');
				$output .= '<br>'.$tgl_bayar_xnov.'</td>';
		
				//$new=0;
				//$output .= '<tr>';
				$jumlahperayat += $jumlahtemp;
		
				//$output .= '<tr>';
					//$output .= '<td align="CENTER" colspan=5>JUMLAH PAJAK '.$before["wp_name"].'</td>';
					//$output .= '<td align="right">'.number_format($jumlah_per_wp, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_per_wp, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.$jumlah_bulan_bayar.'</td>';
				if ($jumlah_bulan_bayar<1){
					$output .= '<td align="right">'.number_format(0, 2, ',', '.').'</td>';
				}else{
					$output .= '<td align="right">'.number_format($jumlah_per_wp/$jumlah_bulan_bayar, 2, ',', '.').'</td>';
				}
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
				$xdes=0;
				$xnov=0;
				$tgl_bayar_jan= '';
				$tgl_bayar_feb= '';
				$tgl_bayar_mar= '';
				$tgl_bayar_apr= '';
				$tgl_bayar_mei= '';
				$tgl_bayar_jun= '';
				$tgl_bayar_jul= '';
				$tgl_bayar_agu= '';
				$tgl_bayar_sep= '';
				$tgl_bayar_okt= '';
				$tgl_bayar_nov= '';
				$tgl_bayar_des= '';
				$tgl_bayar_xdes='';
				$tgl_bayar_xnov='';
				$ayat = $item["kode_ayat"];
				$ayatsesudah = $before["kode_ayat"];
				if(($ayat != $ayatsesudah&&count($data)>1)){
					$output .= '<tr>';
						$output .= '<td align="CENTER" colspan=7>JUMLAH PER AYAT</td>';
						$output .= '<td align="right">'.number_format($jumlah_xdes_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_des_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_jan_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_feb_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_mar_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_apr_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_mei_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_jun_per_ayatun, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_jul_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_agu_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_sep_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_okt_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_nov_per_ayat, 2, ',', '.').'</td>';
						$output .= '<td align="right">'.number_format($jumlah_xnov_per_ayat, 2, ',', '.').'</td>';
					$output .= '</tr>';
					$jumlah_jan_per_ayat= 0;
					$jumlah_feb_per_ayat= 0;
					$jumlah_mar_per_ayat= 0;
					$jumlah_apr_per_ayat= 0;
					$jumlah_mei_per_ayat= 0;
					$jumlah_jun_per_ayat= 0;
					$jumlah_jul_per_ayat= 0;
					$jumlah_agu_per_ayat= 0;
					$jumlah_sep_per_ayat= 0;
					$jumlah_okt_per_ayat= 0;
					$jumlah_nov_per_ayat= 0;
					$jumlah_des_per_ayat= 0;
					$jumlah_xdes_per_ayat=0;
					$jumlah_xnov_per_ayat=0;
				}
				$jumlah_per_wp = 0;
				$jumlah_bulan_bayar = 0;
				$ketetapan_realisasi = 0; //jumlah pembayaran
				$output .= '<tr><td align="center">'.($i+1).'</td>';
				$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
				$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
				//$output .= '<td align="left">'.$item['no_kohir'].'</td>';
				$output .= '<td align="left">'.$item['wp_name'].'</td>';
				$output .= '<td align="left">'.$item['wp_address_name'].' '.$item['wp_address_no'].'</td>';
				$output .= '<td align="left">'.$item['active_date2'].'</td>';
				$output .= '<td align="left">'.$item['npwpd'].'</td>';
				//$before = $item;
				//$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'<br></br>'.$item['kd_tap'].'</td>';
				if ($thn == $year_date && $bln != 12){
					switch ($bln) {
					    case "01":
							$jan=$jan+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_jan=$jumlah_jan+$item["jumlah_terima"];
							$jumlah_jan_per_ayat=$jumlah_jan_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_jan=$item["payment_date"];
					        break;
					    case "02":
					        $feb=$feb+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_feb=$jumlah_feb+$item["jumlah_terima"];
							$jumlah_feb_per_ayat=$jumlah_feb_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_feb=$item["payment_date"];
					        break;
					    case "03":
					        $mar=$mar+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_mar=$jumlah_mar+$item["jumlah_terima"];
							$jumlah_mar_per_ayat=$jumlah_mar_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_mar=$item["payment_date"];
					        break;
					    case "04":
					        $apr=$apr+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_apr=$jumlah_apr+$item["jumlah_terima"];
							$jumlah_apr_per_ayat=$jumlah_apr_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_apr=$item["payment_date"];
					        break;
					    case "05":
					        $mei=$mei+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_mei=$jumlah_mei+$item["jumlah_terima"];
							$jumlah_mei_per_ayat=$jumlah_mei_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_mei=$item["payment_date"];
					        break;
					    case "06":
					        $jun=$jun+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_jun=$jumlah_jun+$item["jumlah_terima"];
							$jumlah_jun_per_ayat=$jumlah_jun_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_jun=$item["payment_date"];
					        break;
					    case "07":
					        $jul=$jul+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_jul=$jumlah_jul+$item["jumlah_terima"];
							$jumlah_jul_per_ayat=$jumlah_jul_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_jul=$item["payment_date"];
					        break;
					    case "08":
					        $agu=$agu+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_agu=$jumlah_agu+$item["jumlah_terima"];
							$jumlah_agu_per_ayat=$jumlah_agu_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_agu=$item["payment_date"];
					        break;
					    case "09":
					        $sep=$sep+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_sep=$jumlah_sep+$item["jumlah_terima"];
							$jumlah_sep_per_ayat=$jumlah_sep_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_sep=$item["payment_date"];
					        break;
					    case "10":
					        $okt=$okt+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_okt=$jumlah_okt+$item["jumlah_terima"];
							$jumlah_okt_per_ayat=$jumlah_okt_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_okt=$item["payment_date"];
					        break;
					    case "11":
					        $nov=$nov+$item["jumlah_terima"];
							$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
							if ($item["jumlah_terima"] > 0){
								$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
							}
							$jumlah_nov=$jumlah_nov+$item["jumlah_terima"];
							$jumlah_nov_per_ayat=$jumlah_nov_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_nov=$item["payment_date"];
					        break;
					}
				}else{
					if ($thn == ($year_date - 1) && $bln == 12){
						$des=$des+$item["jumlah_terima"];
						$jumlah_per_wp = $jumlah_per_wp + $item["jumlah_terima"];
						if ($item["jumlah_terima"] > 0){
							$jumlah_bulan_bayar = $jumlah_bulan_bayar + 1;
						}
						$jumlah_des=$jumlah_des+$item["jumlah_terima"];
						$jumlah_des_per_ayat=$jumlah_des_per_ayat+$item["jumlah_terima"];
						$tgl_bayar_des=$item["payment_date"];
					}
					else{
						if ($thn < $year_date){
							$xdes=$xdes+$item["jumlah_terima"];
							$jumlah_xdes=$jumlah_xdes+$item["jumlah_terima"];
							$jumlah_xdes_per_ayat=$jumlah_xdes_per_ayat+$item["jumlah_terima"];
							$tgl_bayar_xdes=$item["payment_date"];
						}
						else{
							if (($thn == $year_date && $bln == 12)||($thn > $year_date)){
									$xnov=$xnov+$item["jumlah_terima"];
									$jumlah_xnov=$jumlah_xnov+$item["jumlah_terima"];
									$jumlah_xnov_per_ayat=$jumlah_xnov_per_ayat+$item["jumlah_terima"];
									$tgl_bayar_xnov=$item["payment_date"];
							}
						}
					}
				}
				$jumlahtemp += $item["jumlah_terima"];
				$i=$i+1;
		
			}
		}
		
		$before = $item;
		$i2=$i2+1;
		if(empty($data[$i2]))
		{
			$jumlahperayat += $jumlahtemp;
			$output .= '<td align="right">'.number_format($xdes, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_xdes.'</td>';
			$output .= '<td align="right">'.number_format($des, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_des.'</td>';
			$output .= '<td align="right">'.number_format($jan, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_jan.'</td>';
			$output .= '<td align="right">'.number_format($feb, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_feb.'</td>';
			$output .= '<td align="right">'.number_format($mar, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_mar.'</td>';
			$output .= '<td align="right">'.number_format($apr, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_apr.'</td>';
			$output .= '<td align="right">'.number_format($mei, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_mei.'</td>';
			$output .= '<td align="right">'.number_format($jun, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_jun.'</td>';
			$output .= '<td align="right">'.number_format($jul, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_jul.'</td>';
			$output .= '<td align="right">'.number_format($agu, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_agu.'</td>';
			$output .= '<td align="right">'.number_format($sep, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_sep.'</td>';
			$output .= '<td align="right">'.number_format($okt, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_okt.'</td>';
			$output .= '<td align="right">'.number_format($nov, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_nov.'</td>';
			$output .= '<td align="right">'.number_format($xnov, 2, ',', '.');
			$output .= '<br>'.$tgl_bayar_xnov.'</td>';
			
			$output .= '<td align="right">'.number_format($jumlah_per_wp, 2, ',', '.').'</td>';
			$output .= '<td align="right">'.$jumlah_bulan_bayar.'</td>';
			$output .= '<td align="right">'.number_format($jumlah_per_wp/$jumlah_bulan_bayar, 2, ',', '.').'</td>';
			$output .= '</tr>';
			$output .= '<tr>';
				$output .= '<td align="CENTER" colspan=7>JUMLAH PER AYAT</td>';
				$output .= '<td align="right">'.number_format($jumlah_xdes_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_des_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_jan_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_feb_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_mar_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_apr_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_mei_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_jun_per_ayatun, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_jul_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_agu_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_sep_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_okt_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_nov_per_ayat, 2, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($jumlah_xnov_per_ayat, 2, ',', '.').'</td>';
			$output .= '</tr>';
		}
	}
	$output .= '<tr>';
		$output .= '<td align="CENTER" colspan=7>TOTAL PAJAK</td>';
		$output .= '<td align="right">'.number_format($jumlah_xdes, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_des, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_jan, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_feb, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_mar, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_apr, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_mei, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_jun, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_jul, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_agu, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_sep, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_okt, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_nov, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlah_xnov, 2, ',', '.').'</td>';
		$output .= '<td align="right">'.number_format($jumlahperayat, 2, ',', '.').'</td>';
	$output .= '</tr>';

	$output.='</td></tr></table>';
	$output.='</table>';
		
	return $output;
}

//Page_OnInitializeView @1-5261C3FE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_ketetapan_dan_realisasi; //Compatibility
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

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
		//$year_code = CCGetFromGet("year_code", "");

		$tgl_penerimaan = "'01-01-2013'";
		$tgl_penerimaan_last = "'31-12-2014'";
		$i_flag_setoran = 1;


		$p_year_period_id = 4;
		//year_period_id 4 = 2013
		//year_period_id 16 = 2014
		
		$date_start=str_replace("'", "",$year_code);
		//$year_date = DateTime::createFromFormat('d-m-Y', $date_start)->format('Y');
		$year_date = $year_code; 		

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$jenis_laporan		= "all"; 
		$query	= "select *,trunc(payment_date) 
			from f_rep_bpps_piutang2new($p_vat_type_id, $p_year_period_id, $tgl_penerimaan, $tgl_penerimaan_last, $i_flag_setoran) 
			order by kode_ayat, npwpd, payment_date";	
		
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
                  		<td class="th"><strong>LAPORAN REALISASI TERAKHIR BAYAR</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .= '<h2>LAPORAN TERAKHIR BAYAR PER JENIS PAJAK </h2>';
	//$output .= '<h2>TANGGAL : '.dateToString($date_start, "-")." s/d ".dateToString($date_end, "-").'</h2> <br/>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


	$output.='<th>NO</th>';
	$output.='<th>NO AYAT</th>';
	//$output.='<th>NAMA AYAT</th>';
	$output.='<th>NO KOHIR</th>';
	$output.='<th>NAMA WP</th>';
	$output.='<th>ALAMAT</th>';
	$output.='<th>NPWPD</th>';
	$output.='<th>PEMBAYARAN </br>TERAKHIR</th>';
	$output.='<th>TGL BAYAR </br>TERAKHIR</th>';
	$output.='<th width=140>MASA PAJAK</th>';
	$output.='</tr>';
	
	$jumlahtemp=0;
	$jumlahperayat=0;
	$i=0;
	$j=0;
	$item = array();
	foreach($data as $item2) {
		if ($j==0){
			$item=$item2;
			$j=1;
		}else{
			if ($item['npwpd'] == $item2['npwpd']){
				$item=$item2;
			}else{
				$output .= '<tr>';
					$output .= '<td align="center">'.($i+1).'</td>';
					$output .= '<td align="center">'.$item["kode_jns_pajak"]." ".$item["kode_ayat"].'</td>';
					//$output .= '<td align="center">'.$item["nama_ayat"].'</td>';
					$output .= '<td align="left">'.$item['no_kohir'].'</td>';
					$output .= '<td align="left">'.$item['wp_name'].'</td>';
					$output .= '<td align="left">'.$item['address'].'</td>';
					$output .= '<td align="left">'.$item['npwpd'].'</td>';
					$output .= '<td align="right">'.number_format($item["jumlah_terima"], 2, ',', '.').'</td>';
					$output .= '<td align="left">'.date("d-m-Y", strtotime($item['payment_date'])).'</td>';
					$output .= '<td align="left">'.$item['masa_pajak'].'</td>';
				$output .= '</tr>';
				$item=$item2;
				$i=$i+1;
			}			
		}
	}

	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
}


//Page_OnInitializeView @1-8ECBBEB7
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_bpps_terakhir_bayar; //Compatibility
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

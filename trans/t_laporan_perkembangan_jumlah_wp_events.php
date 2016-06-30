<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-95BBAC4F
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_perkembangan_jumlah_wp; //Compatibility
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

//Page_BeforeShow @1-71065EE6
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_perkembangan_jumlah_wp; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
	$param_arr['status_bayar'] = CCGetFromGet('ListBox1');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	$param_arr['year_code'] = CCGetFromGet('year_code');
	$param_arr['code'] = CCGetFromGet('code');

	$param_arr['npwpd_jabatan'] = CCGetFromGet('npwpd_jabatan');

	if($doAction == 'view_html') {		
		$Label1->SetText(GetCetakHTML($param_arr));
	}
	if($doAction == 'view_excel') {		
		GetCetakHTML($param_arr);
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($param_arr) {
	$doAction = CCGetFromGet('doAction');
	if($doAction == 'view_excel') {	
		startExcel("laporan_perkembangan_jumlah_wajib_pajak.xls");	
	}

	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	if($doAction != 'view_excel') {	
		$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN PERKEMBANGAN JUMLAH WP</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	}
	
	$output .= '<h2 style="color:black;" align="center">LAPORAN PERKEMBANGAN JUMLAH WAJIB PAJAK</h2>';
	$output .= '<h2 style="color:black;" align="center">HOTEL, RESTORAN, HIBURAN, PARKIR DAN PAJAK PENERANGAN JALAN</h2>';
	$output .= '<br>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" rowspan=2 >NO</th>';
	$output.='<th align="center" rowspan=2 >URAIAN JENIS PAJAK</th>';
	$output.='<th align="center" colspan=2 >JUMLAH S.D. BULAN LALU</th>';
	$output.='<th align="center" colspan=2 >PEMUTAKHIRAN DATA BULAN INI</th>';
	$output.='<th align="center" colspan=2 >JUMLAH S.D. BULAN INI</th>';
	$output.='<th align="center" rowspan=2 >KETERANGAN</th>';
	$output.='</tr>';
	$output.='<tr>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >NON AKTIF</th>';
	$output.='<th align="center" >PENERBITAN NPWPD</th>';
	$output.='<th align="center" >PERUBAHAN STATUS NON AKTIF</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >NON AKTIF</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select upper(b.vat_code) as jenis_pajak ,a.vat_code as ayat_pajak, 
			(select count(*) from t_cust_account x 
				where case when ".$param_arr['npwpd_jabatan']." = 1 then true 
						   else x.npwpd_jabatan = 'Y'
					  end
					and x.p_vat_type_dtl_id = a.p_vat_type_dtl_id and x.p_account_status_id = 1 and
							trunc(x.last_satatus_date) <= (select end_date from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id'].")) as jumlah_aktif_sd_bulan_ini,

			(select count(*) from t_cust_account x 
				where case when ".$param_arr['npwpd_jabatan']." = 1 then true 
						   else x.npwpd_jabatan = 'Y'
					  end
					and x.p_vat_type_dtl_id = a.p_vat_type_dtl_id and x.p_account_status_id != 1 and
							trunc(x.last_satatus_date) <= (select end_date from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id'].")) as jumlah_non_aktif_sd_bulan_ini,

			(select count(*) from t_cust_account x 
				where case when ".$param_arr['npwpd_jabatan']." = 1 then true 
						   else x.npwpd_jabatan = 'Y'
					  end
					and x.p_vat_type_dtl_id = a.p_vat_type_dtl_id and x.p_account_status_id = 1 and
							trunc(x.last_satatus_date) BETWEEN (select start_date from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id'].") 
								and (select end_date from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id'].")) as jumlah_aktif_bulan_ini,

			(select count(*) from t_cust_account x 
				where case when ".$param_arr['npwpd_jabatan']." = 1 then true 
						   else x.npwpd_jabatan = 'Y'
					  end
					and x.p_vat_type_dtl_id = a.p_vat_type_dtl_id and x.p_account_status_id != 1 and
							trunc(x.last_satatus_date) BETWEEN (select start_date from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id'].") 
								and  (select end_date from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id'].")) as jumlah_non_aktif_bulan_ini,

			(select count(*) from t_cust_account x 
				where case when ".$param_arr['npwpd_jabatan']." = 1 then true 
						   else x.npwpd_jabatan = 'Y'
					  end
					and x.p_vat_type_dtl_id = a.p_vat_type_dtl_id and x.p_account_status_id = 1 and
							trunc(x.last_satatus_date) <= (select end_date from p_finance_period z where z.end_date = 
								(select start_date-1 from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id']."))) as jumlah_aktif_sd_bulan_lalu,

			(select count(*) from t_cust_account x 
				where case when ".$param_arr['npwpd_jabatan']." = 1 then true 
						   else x.npwpd_jabatan = 'Y'
					  end
					and x.p_vat_type_dtl_id = a.p_vat_type_dtl_id and x.p_account_status_id != 1 and
							trunc(x.last_satatus_date) <= (select end_date from p_finance_period z where z.end_date = 
								(select start_date-1 from p_finance_period y where y.p_finance_period_id = ".$param_arr['p_finance_period_id']."))) as jumlah_non_aktif_sd_bulan_lalu


			from p_vat_type_dtl a
			left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id
			where a.p_vat_type_id in (1,2,3,4,5)
			ORDER BY a.p_vat_type_id,a.code";

	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	$j = 0;
	$total_aktif_sd_bulan_lalu = 0;
	$total_non_aktif_sd_bulan_lalu = 0;
	$total_aktif_bulan_ini = 0;
	$total_non_aktif_bulan_ini = 0;
	$total_aktif_sd_bulan_ini = 0;
	$total_non_aktif_sd_bulan_ini = 0;

	for ($i = 0; $i < count($data); $i++) {
		if($data[$i]['jenis_pajak'] != $data[$i-1]['jenis_pajak']){
			$output.='<tr><td align="center" ><b>'.($j+1).'</b></td>';
			$output.='<td align="left" ><b>'.$data[$i]['jenis_pajak'].'</b></td>';
			if($data[$i]['jenis_pajak'] == 'PAJAK PARKIR' || $data[$i]['jenis_pajak'] == 'PAJAK PPJ'){
				$output.='<td align="right" >'.$data[$i]['jumlah_aktif_sd_bulan_lalu'].'</td>';
				$output.='<td align="right" >'.$data[$i]['jumlah_non_aktif_sd_bulan_lalu'].'</td>';
				$output.='<td align="right" >'.$data[$i]['jumlah_aktif_bulan_ini'].'</td>';
				$output.='<td align="right" >'.$data[$i]['jumlah_non_aktif_bulan_ini'].'</td>';
				$output.='<td align="right" >'.$data[$i]['jumlah_aktif_sd_bulan_ini'].'</td>';
				$output.='<td align="right" >'.$data[$i]['jumlah_non_aktif_sd_bulan_ini'].'</td>';
				$output.='<td align="left" ></td>';
			}else{
				$output.='<td align="left" ></td>';
				$output.='<td align="left" ></td>';
				$output.='<td align="left" ></td>';
				$output.='<td align="left" ></td>';
				$output.='<td align="left" ></td>';
				$output.='<td align="left" ></td>';
				$output.='<td align="left" ></td>';
			}
			$output.='</tr>';
			$j++;
		}

		if($data[$i]['jenis_pajak'] != 'PAJAK PARKIR' && $data[$i]['jenis_pajak'] != 'PAJAK PPJ'){
			$output.='<tr><td align="center" ></td>';
			$output.='<td align="left" >- '.$data[$i]['ayat_pajak'].'</td>';
			$output.='<td align="right" >'.$data[$i]['jumlah_aktif_sd_bulan_lalu'].'</td>';
			$output.='<td align="right" >'.$data[$i]['jumlah_non_aktif_sd_bulan_lalu'].'</td>';
			$output.='<td align="right" >'.$data[$i]['jumlah_aktif_bulan_ini'].'</td>';
			$output.='<td align="right" >'.$data[$i]['jumlah_non_aktif_bulan_ini'].'</td>';
			$output.='<td align="right" >'.$data[$i]['jumlah_aktif_sd_bulan_ini'].'</td>';
			$output.='<td align="right" >'.$data[$i]['jumlah_non_aktif_sd_bulan_ini'].'</td>';
			$output.='<td align="left" ></td>';
			$output.='</tr>';
		}
		$total_aktif_sd_bulan_lalu = $total_aktif_sd_bulan_lalu + $data[$i]['jumlah_aktif_sd_bulan_lalu'];
		$total_non_aktif_sd_bulan_lalu = $total_non_aktif_sd_bulan_lalu + $data[$i]['jumlah_non_aktif_sd_bulan_lalu'];
		$total_aktif_bulan_ini = $total_aktif_bulan_ini + $data[$i]['jumlah_aktif_bulan_ini'];
		$total_non_aktif_bulan_ini = $total_non_aktif_bulan_ini + $data[$i]['jumlah_non_aktif_bulan_ini'];
		$total_aktif_sd_bulan_ini = $total_aktif_sd_bulan_ini + $data[$i]['jumlah_aktif_sd_bulan_ini'];
		$total_non_aktif_sd_bulan_ini = $total_non_aktif_sd_bulan_ini + $data[$i]['jumlah_non_aktif_sd_bulan_ini'];
	}
	$output.='<tr><td align="center" ></td>';
	$output.='<td align="left" ><b>JUMLAH</b></td>';
	$output.='<td align="right" >'.$total_aktif_sd_bulan_lalu.'</td>';
	$output.='<td align="right" >'.$total_non_aktif_sd_bulan_lalu.'</td>';
	$output.='<td align="right" >'.$total_aktif_bulan_ini.'</td>';
	$output.='<td align="right" >'.$total_non_aktif_bulan_ini.'</td>';
	$output.='<td align="right" >'.$total_aktif_sd_bulan_ini.'</td>';
	$output.='<td align="right" >'.$total_non_aktif_sd_bulan_ini.'</td>';
	$output.='<td align="left" ></td>';
	$output.='</tr>';

	$output.='</table>';
	if($doAction == 'view_excel') {	
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

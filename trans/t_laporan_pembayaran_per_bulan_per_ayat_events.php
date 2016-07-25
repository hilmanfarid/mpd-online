<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-E2D2DBA5
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_per_bulan_per_ayat; //Compatibility
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

//Page_BeforeShow @1-D9F1EFC0
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_per_bulan_per_ayat; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['year_code'] = CCGetFromGet('year_code');
	$param_arr['npwpd_jabatan'] = CCGetFromGet('npwpd_jabatan');
	$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
	$param_arr['tgl_penerimaan_last'] = CCGetFromGet('tgl_penerimaan_last');
	$param_arr['kode_wilayah'] = CCGetFromGet('kode_wilayah');
	

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
                  		<td class="th"><strong>LAPORAN PEMBAYARAN PER JENIS DAN MASA PAJAK</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	}
	
	$output .= '<h2 style="color:black;" align="center">REKAPITULASI PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</h2>';
	if($param_arr['npwpd_jabatan'] == 2) {	
		$output .= '<h2 style="color:black;" align="center">NPWPD JABATAN</h2>';
	}
	if($param_arr['kode_wilayah'] != 'semua' && $param_arr['kode_wilayah'] != 'lainnya' ) {	
		$output .= '<h2 style="color:black;" align="center">'.$param_arr['kode_wilayah'].'</h2>';
	}
	$output .= '<br>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	
	$output.='<th align="center" rowspan=2 >NO</th>';
	$output.='<th align="center" rowspan=2 >URAIAN JENIS PAJAK</th>';
	$output.='<th align="center" colspan=3 >JANUARI</th>';
	$output.='<th align="center" colspan=3 >FEBRUARI</th>';
	$output.='<th align="center" colspan=3 >MARET</th>';
	$output.='<th align="center" colspan=3 >APRIL</th>';
	$output.='<th align="center" colspan=3 >MEI</th>';
	$output.='<th align="center" colspan=3 >JUNI</th>';
	$output.='<th align="center" colspan=3 >JULI</th>';
	$output.='<th align="center" colspan=3 >AGUSTUS</th>';
	$output.='<th align="center" colspan=3 >SEPTEMBER</th>';
	$output.='<th align="center" colspan=3 >OKTOBER</th>';
	$output.='<th align="center" colspan=3 >NOVEMBER</th>';
	$output.='<th align="center" colspan=3 >DESEMBER</th>';
	$output.='</tr>';
	
	$output.='<tr>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='<th align="center" >AKTIF</th>';
	$output.='<th align="center" >BAYAR</th>';
	$output.='<th align="center" >NILAI</th>';
	$output.='</tr>';

	$dbConn	= new clsDBConnSIKP();

	$query="select case when p_vat_type_dtl_id = 35 then 'RUMAH KOS' 
						when p_vat_type_dtl_id = 18 then 'DISKOTIK/KLUB MALAM' 
						when p_vat_type_dtl_id = 13 then 'PANTI PIJAT/SPA/REFLEKSI' 
						when p_vat_type_dtl_id = 31 then 'HIBURAN INSIDENTIL' 
						else ayat_pajak end as ayat_pajak_2,* 
			from 
			(select upper(b.vat_code) as jenis_pajak ,a.vat_code as ayat_pajak,a.p_vat_type_dtl_id,a.p_vat_type_id
			from p_vat_type_dtl a
			left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id
			where a.p_vat_type_id in (1,2,3,4,5)
				and a.p_vat_type_dtl_id not in (9,20,44,15,41,12,17,21,42,43,27,30)
			ORDER BY a.p_vat_type_id,a.code)";

	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	$j = 0;
	$total = array();
	for($bulan=1;$bulan<=12;$bulan++){
		$total[$bulan]['aktif'] = 0;
		$total[$bulan]['bayar'] = 0;
		$total[$bulan]['nilai'] = 0;
	}

	for ($i = 0; $i < count($data); $i++) {
		if($data[$i]['jenis_pajak'] != $data[$i-1]['jenis_pajak']){
			$output.='<tr><td align="center" ><b>'.($j+1).'</b></td>';
			$output.='<td align="left" ><b>'.$data[$i]['jenis_pajak'].'</b></td>';
			for($bulan=1;$bulan<=12;$bulan++){
				$data_per_bulan = getDataPerJenis($data[$i]['p_vat_type_id'],
						'01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$param_arr['year_code']); 
				$output.='<td align="right" >'.$data_per_bulan['aktif'].'</td>';
				$output.='<td align="right" >'.$data_per_bulan['bayar'].'</td>';
				$output.='<td align="right" >'.number_format($data_per_bulan['nilai'], 2, ',', '.').'</td>';
				$total[$bulan]['aktif'] += $data_per_bulan['aktif'];
				$total[$bulan]['bayar'] += $data_per_bulan['bayar'];
				$total[$bulan]['nilai'] += $data_per_bulan['nilai'];
			}
			$output.='</tr>';
			$j++;
		}

		if($data[$i]['jenis_pajak'] != 'PAJAK PARKIR' && $data[$i]['jenis_pajak'] != 'PAJAK PPJ'){
			$output.='<tr><td align="center" ></td>';
			$output.='<td align="left" >- '.$data[$i]['ayat_pajak_2'].'</td>';
			//get data perbulan
			for($bulan=1;$bulan<=12;$bulan++){
				
				$data_per_bulan = getData($data[$i]['p_vat_type_dtl_id'],
					'01-'.str_pad($bulan, 2, "0", STR_PAD_LEFT).'-'.$param_arr['year_code']); 
				$output.='<td align="right" >'.$data_per_bulan['aktif'].'</td>';
				$output.='<td align="right" >'.$data_per_bulan['bayar'].'</td>';
				$output.='<td align="right" >'.number_format($data_per_bulan['nilai'], 2, ',', '.').'</td>';
				
			}
			$output.='</tr>';
		}
	}
	$output.='<tr><td align="center" ></td>';
	$output.='<td align="left" ><b>JUMLAH</b></td>';
	for($bulan=1;$bulan<=12;$bulan++){
		$output.='<td align="right" >'.$total[$bulan]['aktif'].'</td>';
		$output.='<td align="right" >'.$total[$bulan]['bayar'].'</td>';
		$output.='<td align="right" >'.number_format($total[$bulan]['nilai'], 2, ',', '.').'</td>';
	}
	
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

function getData($p_vat_type_dtl_id,$start_date) {
	$param_arr['npwpd_jabatan'] = CCGetFromGet('npwpd_jabatan');
	$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
	$param_arr['tgl_penerimaan_last'] = CCGetFromGet('tgl_penerimaan_last');
	$param_arr['kode_wilayah'] = CCGetFromGet('kode_wilayah');

   	$dbConn	= new clsDBConnSIKP();
	$data = array();
	$query="select
				(select count(*) from t_cust_account where p_account_status_id = 1 
				and trunc(last_satatus_date) <= (select end_date from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))
				and case when ".$p_vat_type_dtl_id." = 10 then p_vat_type_dtl_id in (9,10) 
					when ".$p_vat_type_dtl_id." = 18 then p_vat_type_dtl_id in (18,20)
					when ".$p_vat_type_dtl_id." = 13 then p_vat_type_dtl_id in (13,44) 
					when ".$p_vat_type_dtl_id." = 31 then p_vat_type_dtl_id in (15,41,12,17,21,42,43,27,30,31) 
					else p_vat_type_dtl_id = ".$p_vat_type_dtl_id."
					end
				and case when '".$param_arr['kode_wilayah']."' = 'semua' then true 
					when '".$param_arr['kode_wilayah']."' = 'lainnya' then f_get_wilayah(npwd)='-' 
					else '".$param_arr['kode_wilayah']."' = f_get_wilayah(npwd) end
				and case when ".$param_arr['npwpd_jabatan']." = 1 then true else npwpd_jabatan='Y' end) as aktif,
				count(DISTINCT a.t_cust_account_id) as bayar,sum(payment_amount) as nilai
			from t_vat_setllement a
				left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
				left join t_payment_receipt c on c.t_vat_setllement_id=a.t_vat_setllement_id
			where p_account_status_id = 1 
				and trunc(last_satatus_date) <= (select end_date from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))
				and case when ".$p_vat_type_dtl_id." = 10 then b.p_vat_type_dtl_id in (9,10) 
					when ".$p_vat_type_dtl_id." = 18 then b.p_vat_type_dtl_id in (18,20)
					when ".$p_vat_type_dtl_id." = 13 then b.p_vat_type_dtl_id in (13,44) 
					when ".$p_vat_type_dtl_id." = 31 then b.p_vat_type_dtl_id in (15,41,12,17,21,42,43,27,30,31) 
					else b.p_vat_type_dtl_id = ".$p_vat_type_dtl_id."
					end
				and c.t_payment_receipt_id is not null
				and trunc(payment_date) between to_date('".$param_arr['tgl_penerimaan']."','dd-mm-yyyy') and to_date('".$param_arr['tgl_penerimaan_last']."','dd-mm-yyyy')
				and case when ".$param_arr['npwpd_jabatan']." = 1 then true else npwpd_jabatan='Y' end
				and case when '".$param_arr['kode_wilayah']."' = 'semua' then true 
					when '".$param_arr['kode_wilayah']."' = 'lainnya' then f_get_wilayah(b.npwd)='-' 
					else '".$param_arr['kode_wilayah']."' = f_get_wilayah(b.npwd) end
				and a.p_finance_period_id = (select p_finance_period_id from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))";
	//echo $query;exit;
	$dbConn->query($query);
	$dbConn->next_record();
	$data = $dbConn->Record;
	$dbConn->close();
	return $data;
}

function getDataPerJenis($p_vat_type_id,$start_date) {
   	$param_arr['npwpd_jabatan'] = CCGetFromGet('npwpd_jabatan');
	$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
	$param_arr['tgl_penerimaan_last'] = CCGetFromGet('tgl_penerimaan_last');
	$param_arr['kode_wilayah'] = CCGetFromGet('kode_wilayah');

	$dbConn	= new clsDBConnSIKP();
	$data = array();
	$query="select 
				(select count(*) from t_cust_account where p_account_status_id = 1 
				and trunc(last_satatus_date) <= (select end_date from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))
				and p_vat_type_id = ".$p_vat_type_id."
				and case when '".$param_arr['kode_wilayah']."' = 'semua' then true 
					when '".$param_arr['kode_wilayah']."' = 'lainnya' then f_get_wilayah(npwd)='-' 
					else '".$param_arr['kode_wilayah']."' = f_get_wilayah(npwd) end
				and case when ".$param_arr['npwpd_jabatan']." = 1 then true else npwpd_jabatan='Y' end) as aktif,
				count(DISTINCT a.t_cust_account_id) as bayar,sum(payment_amount) as nilai
			from t_vat_setllement a
				left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
				left join t_payment_receipt c on c.t_vat_setllement_id=a.t_vat_setllement_id
			where p_account_status_id = 1 
				and trunc(last_satatus_date) <= (select end_date from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))
				and b.p_vat_type_id = ".$p_vat_type_id."
				and c.t_payment_receipt_id is not null
				and trunc(payment_date) between to_date('".$param_arr['tgl_penerimaan']."','dd-mm-yyyy') and to_date('".$param_arr['tgl_penerimaan_last']."','dd-mm-yyyy')
				and case when ".$param_arr['npwpd_jabatan']." = 1 then true else npwpd_jabatan='Y' end
				and case when '".$param_arr['kode_wilayah']."' = 'semua' then true 
					when '".$param_arr['kode_wilayah']."' = 'lainnya' then f_get_wilayah(b.npwd)='-' 
					else '".$param_arr['kode_wilayah']."' = f_get_wilayah(b.npwd) end
				and a.p_finance_period_id = (select p_finance_period_id from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))";
	//echo $query;exit;
	$dbConn->query($query);
	$dbConn->next_record();
	$data = $dbConn->Record;
	$dbConn->close();
	return $data;
}
?>

<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-B8ADB20A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_detil_pembayaran_per_bulan_per_ayat; //Compatibility
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

//Page_BeforeShow @1-2E8C3804
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_detil_pembayaran_per_bulan_per_ayat; //Compatibility
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
                  		<td class="th"><strong>LAPORAN DETIL PEMBAYARAN PER JENIS DAN MASA PAJAK</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	}
	
	$output .= '<h2 style="color:black;" align="center">PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</h2>';
	if($param_arr['npwpd_jabatan'] == 2) {	
		$output .= '<h2 style="color:black;" align="center">NPWPD JABATAN</h2>';
	}
	if($param_arr['kode_wilayah'] == 'semua') {	
		$output .= '<h2 style="color:black;" align="center">KOTA BANDUNG</h2>';
	}
	if($param_arr['kode_wilayah'] == 'lainnya') {	
		$output .= '<h2 style="color:black;" align="center">WILAYAH LAINNYA</h2>';
	}
	if($param_arr['kode_wilayah'] != 'semua' && $param_arr['kode_wilayah'] != 'lainnya' ) {	
		$output .= '<h2 style="color:black;" align="center">'.$param_arr['kode_wilayah'].'</h2>';
	}
	$output .= '<br>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	
	$output.='<th align="center">NO</th>';
	$output.='<th align="center">JENIS PAJAK</th>';
	$output.='<th align="center">URAIAN JENIS PAJAK</th>';
	$output.='<th align="center">NPWPD</th>';
	$output.='<th align="center">OBJEK PAJAK</th>';
	$output.='<th align="center">ALAMAT</th>';
	$output.='<th align="center">MASA PAJAK</th>';
	$output.='<th align="center">TOTAL BAYAR</th>';
	$output.='<th align="center">TANGGAL BAYAR</th>';
	$output.='<th align="center">WILAYAH</th>';
	$output.='</tr>';

	$dbConn	= new clsDBConnSIKP();

	$query="select 
				f_get_wilayah(b.npwd) as wilayah,e.vat_code as jenis_pajak,
				f.vat_code as ayat_pajak,d.code as masa_pajak,
				to_char(payment_date,'dd-mm-yyyy') as tanggal_bayar,*
			from t_vat_setllement a
				left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
				left join t_payment_receipt c on c.t_vat_setllement_id=a.t_vat_setllement_id
				LEFT JOIN p_finance_period d on d.p_finance_period_id=a.p_finance_period_id
				left join p_vat_type e on e.p_vat_type_id = b.p_vat_type_id
				left join p_vat_type_dtl f on f.p_vat_type_dtl_id = b.p_vat_type_dtl_id
			where p_account_status_id = 1 
				--and trunc(last_satatus_date) <= (select end_date from p_finance_period where start_date = to_date('".$start_date."','dd-mm-yyyy'))
				and c.t_payment_receipt_id is not null
				and trunc(payment_date) between to_date('".$param_arr['tgl_penerimaan']."','dd-mm-yyyy') and to_date('".$param_arr['tgl_penerimaan_last']."','dd-mm-yyyy')
				and case when ".$param_arr['npwpd_jabatan']." = 1 then true else npwpd_jabatan='Y' end
				and case when '".$param_arr['kode_wilayah']."' = 'semua' then true 
					when '".$param_arr['kode_wilayah']."' = 'lainnya' then f_get_wilayah(b.npwd)='-' 
					else '".$param_arr['kode_wilayah']."' = f_get_wilayah(b.npwd) end
			order by wilayah, company_brand, b.npwd, d.start_date";

	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='</tr>'; 
		$output.='<td align="left" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['jenis_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['ayat_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['npwd'].'</td>';
		$output.='<td align="left" >'.$data[$i]['company_brand'].'</td>';
		$output.='<td align="left" >'.$data[$i]['brand_address_name'].' '.$data[$i]['brand_address_no'].'</td>';
		$output.='<td align="left" >'.$data[$i]['masa_pajak'].'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['payment_amount'], 2, ',', '.').'</td>';
		$output.='<td align="left" >'.$data[$i]['tanggal_bayar'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wilayah'].'</td>';
		$output.='</tr>';
	}

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

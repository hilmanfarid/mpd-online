<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-D4EC9AC5
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_ketetapan_vs_realisasi; //Compatibility
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

//Page_BeforeShow @1-3051686C
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_ketetapan_vs_realisasi; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['end_date'] = CCGetFromGet('date_end_laporan');
	$param_arr['start_date'] = CCGetFromGet('date_start_laporan');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id','');
	$param_arr['status_bayar'] = CCGetFromGet('ListBox1');
	$param_arr['ketetapan'] = CCGetFromGet('ListBox2',4);

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	
	if($doAction == 'view_rekap_html') {
		$Label1->SetText(GetCetakRekapHTML($param_arr));
	}
	
	if($doAction == 'cetak_rekap_excel') {		
		GetCetakRekapHTML($param_arr);
	}
	
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakRekapHTML($param_arr) {
	$doAction = CCGetFromGet('doAction');
	if($doAction == 'cetak_rekap_excel') {
		startExcel("laporan_ketetapan_vs_realisasi.xls");
	}
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="HeaderLeft"></td> 
                  		<td class="th"><strong>LAPORAN KETETAPAN VS REALISASI</strong></td> 
                  		<td class="HeaderRight"></td>
                	</tr>
              		</table>';
	
	//$output .= '<h2>JENIS PAJAK : '.$param_arr['vat_code'].' </h2>';
	$output .= '<h2>PERIODE PENETAPAN : '.$param_arr['start_date'].' s.d. '.$param_arr['end_date'].'</h2>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" rowspan=2>NO</th>';
	$output.='<th align="center" rowspan=2>AYAT</th>';
	$output.='<th align="center" rowspan=2>PAJAK/RETRIBUSI</th>';
	$output.='<th align="center" colspan=2>KETETAPAN</th>';
	$output.='<th align="center" colspan=2>REALISASI</th>';
	$output.='<th align="center" colspan=2>SISA</th>';
	$output.='</tr>';

	$output.='<tr>';
	$output.='<th align="center" >Jumlah (Rp)</th>';
	$output.='<th align="center" >Jumlah SSPD</th>';
	$output.='<th align="center" >Jumlah (Rp)</th>';
	$output.='<th align="center" >Jumlah SSPD</th>';
	$output.='<th align="center" >Jumlah (Rp)</th>';
	$output.='<th align="center" >Jumlah SSPD</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select * from v_p_vat_type_dtl_rep
			ORDER BY nomor_ayat";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();
	$jumlah =0;
	$jumlah_relisasi =0;
	$jumlah_sisa =0;
	$jumlah_per_ayat =0;
	$jumlah_relisasi_per_ayat =0;
	$jumlah_sisa_per_ayat =0;
	$jumlah_sspd =0;
	$jumlah_sspd_relisasi =0;
	$jumlah_sspd_sisa =0;
	$jumlah_sspd_per_ayat =0;
	$jumlah_sspd_relisasi_per_ayat =0;
	$jumlah_sspd_sisa_per_ayat =0;
	for ($i = 0; $i < count($data); $i++) {

		$dbConn2	= new clsDBConnSIKP();
		if ($param_arr['ketetapan'] == 7)
		{
			$query2="select SUM (round(a.penalty_amount)) AS realisasi,
							count(a.t_payment_receipt_id) as jumlah_sspd_realisasi,
							SUM (round(b.penalty_amt)) AS ketetapan,
							count(e.t_vat_setllement_id) as jumlah_sspd_ketetapan
				from t_vat_setllement e
				left join t_payment_receipt a  on a.t_vat_setllement_id = e.t_vat_setllement_id
				left join t_vat_penalty b on b.t_vat_setllement_id = e.t_vat_setllement_id
				left join p_vat_type_dtl c on c.p_vat_type_dtl_id = e.p_vat_type_dtl_id
				left join p_vat_type d on c.p_vat_type_id = d.p_vat_type_id
				where p_settlement_type_id = ".$param_arr['ketetapan']." 
				and trunc(settlement_date) between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
					and (to_date('".$param_arr['end_date']."','yyyy-mm-dd'))
				and decode(c.p_vat_type_id,7,d.code||c.code,d.penalty_code) = ".$data[$i]['nomor_ayat']."
				and b.penalty_amt is not null";
			if ($param_arr['p_vat_type_id']!=''){
				$query2.="and a.p_vat_type_dtl_id in (select p_vat_type_dtl_id 
						from p_vat_type_dtl where p_vat_type_id =".$param_arr['p_vat_type_id'].")";
			}
			if ($param_arr['status_bayar']==2){
				$query2.="and receipt_no is not null";
			}
			if ($param_arr['status_bayar']==3){
				$query2.="and receipt_no is null";
			}
			//echo $query2;exit;
		}else{
			$query2="select SUM (y.payment_vat_amount) AS realisasi,count(y.t_payment_receipt_id) as jumlah_sspd_realisasi,
							SUM (A .total_vat_amount) AS ketetapan,count(a.t_vat_setllement_id) as jumlah_sspd_ketetapan
				from t_vat_setllement a
				left join t_payment_receipt y on y.t_vat_setllement_id=a.t_vat_setllement_id
				left join t_cust_account x on x.t_cust_account_id=a.t_cust_account_id
				where p_settlement_type_id = ".$param_arr['ketetapan']." 
				and trunc(settlement_date) between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
					and (to_date('".$param_arr['end_date']."','yyyy-mm-dd'))
				and ".$data[$i]['p_vat_type_dtl_id']."=a.p_vat_type_dtl_id ";
			if ($param_arr['p_vat_type_id']!=''){
				$query2.="and a.p_vat_type_dtl_id in (select p_vat_type_dtl_id 
						from p_vat_type_dtl where p_vat_type_id =".$param_arr['p_vat_type_id'].")";
			}
			if ($param_arr['status_bayar']==2){
				$query2.="and receipt_no is not null";
			}
			if ($param_arr['status_bayar']==3){
				$query2.="and receipt_no is null";
			}
		}

		//echo $query2;exit;
		$data2 = array();
		$dbConn2->query($query2);
		while ($dbConn2->next_record()) {
			$data2 = $dbConn2->Record;
		}
		$dbConn2->close();
		//print_r($data2); exit;
		
		$output.='<tr ><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['nomor_ayat'].'</td>';
		$output.='<td align="left" >'.$data[$i]['nama_ayat'].'</td>';
		$output.='<td align="right" >'.number_format($data2['ketetapan'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data2['jumlah_sspd_ketetapan'], 0, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data2['realisasi'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data2['jumlah_sspd_realisasi'], 0, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data2['ketetapan']-$data2['realisasi'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data2['jumlah_sspd_ketetapan']-$data2['jumlah_sspd_realisasi'], 0, ',', '.').'</td>';
		$output.='</tr>';

		$jumlah +=$data2['ketetapan'];
		$jumlah_relisasi += $data2['realisasi'];
		$jumlah_sisa += ($data2['ketetapan']-$data2['realisasi']);

		$jumlah_sspd +=$data2['jumlah_sspd_ketetapan'];
		$jumlah_sspd_relisasi += $data2['jumlah_sspd_realisasi'];
		$jumlah_sspd_sisa += ($data2['jumlah_sspd_ketetapan']-$data2['jumlah_sspd_realisasi']);

		$jumlah_per_ayat +=$data2['ketetapan'];
		$jumlah_relisasi_per_ayat += $data2['realisasi'];
		$jumlah_sisa_per_ayat += ($data2['ketetapan']-$data2['realisasi']);

		$jumlah_sspd_per_ayat +=$data2['jumlah_sspd_ketetapan'];
		$jumlah_sspd_relisasi_per_ayat += $data2['jumlah_sspd_realisasi'];
		$jumlah_sspd_sisa_per_ayat += ($data2['jumlah_sspd_ketetapan']-$data2['jumlah_sspd_realisasi']);

		$ayat = $data[$i]["kode_jns_pjk"];
		$ayatsesudah = $data[$i+1]["kode_jns_pjk"];
		if(($ayat != $ayatsesudah&&count($data)>1)||empty($data[$i+1])){
			$output.='<tr >';
			$output.='<td align="center" colspan=3><span style="font-weight:bold">'.$data[$i]['nama_jns_pajak'].'</span></td>';
			$output.='<th align="right" >'.number_format($jumlah_per_ayat, 2, ',', '.').'</th>';
			$output.='<th align="right" >'.number_format($jumlah_sspd_per_ayat, 0, ',', '.').'</th>';
			$output.='<th align="right" >'.number_format($jumlah_relisasi_per_ayat, 2, ',', '.').'</th>';
			$output.='<th align="right" >'.number_format($jumlah_sspd_relisasi_per_ayat, 0, ',', '.').'</th>';
			$output.='<th align="right" >'.number_format($jumlah_sisa_per_ayat, 2, ',', '.').'</th>';
			$output.='<th align="right" >'.number_format($jumlah_sspd_sisa_per_ayat, 0, ',', '.').'</th>';
			$output.='</tr>';

			$jumlah_per_ayat = 0;
			$jumlah_relisasi_per_ayat = 0;
			$jumlah_sisa_per_ayat = 0;

			$jumlah_sspd_per_ayat = 0;
			$jumlah_sspd_relisasi_per_ayat = 0;
			$jumlah_sspd_sisa_per_ayat = 0;
		}
	}

	$output.='<tr><td align="center" colspan=3 ><span style="font-weight:bold">JUMLAH TOTAL</span></td>';
	$output.='<th align="right">'.number_format($jumlah, 2, ',', '.').'</th>';
	$output.='<th align="right">'.number_format($jumlah_sspd, 0, ',', '.').'</th>';
	$output.='<th align="right">'.number_format($jumlah_relisasi, 2, ',', '.').'</th>';
	$output.='<th align="right">'.number_format($jumlah_sspd_relisasi, 0, ',', '.').'</th>';
	$output.='<th align="right">'.number_format($jumlah_sisa, 2, ',', '.').'</th>';
	$output.='<th align="right">'.number_format($jumlah_sspd_sisa, 0, ',', '.').'</th>';
	$output.='</tr>';

	$output.='</table>';
	if($doAction == 'cetak_rekap_excel') {
		echo $output;
		exit;
	}
	return $output;
}


?>

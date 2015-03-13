<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-2C6702FE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cetak_rekap_skpdkb; //Compatibility
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

//Page_BeforeShow @1-5DAA40FE
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cetak_rekap_skpdkb; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	if($doAction == 'view_html') {
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
		$param_arr['status_bayar'] = CCGetFromGet('ListBox1');

		$param_arr['vat_code'] = CCGetFromGet('vat_code');
		$param_arr['year_code'] = CCGetFromGet('year_code');
		$param_arr['code'] = CCGetFromGet('code');
		$Label1->SetText(GetCetakHTML($param_arr));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($param_arr) {
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN REKAP SKPDKB</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .= '<h2>JENIS PAJAK : '.$param_arr['vat_code'].' </h2>';
	$output .= '<h2>PERIODE PAJAK : '.$param_arr['code'].'</h2>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >NAMA</th>';
	$output.='<th align="center" >ALAMAT</th>';
	$output.='<th align="center" >JATUH TEMPO</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >TGL TAP</th>';
	$output.='<th align="center" >POKOK (PAJAK TERHUTANG+KENAIKAN)</th>';
	$output.='<th align="center" >PAJAK TEHUTANG</th>';
	$output.='<th align="center" >KENAIKAN PAJAK TERHUTANG</th>';
	$output.='<th align="center" >DENDA</th>';
	$output.='<th align="center" >TOTAL HARUS DIBAYAR</th>';
	$output.='<th align="center" >STATUS BAYAR</th>';
	$output.='<th align="center" >TANGGAL BAYAR</th>';
	$output.='<th align="center" colspan=2>CETAK DATA TERPILIH</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select a.t_vat_setllement_id as set_id,a.npwd as npwpd ,to_char(start_period,'dd-mm-yyyy')||' s.d. '||to_char(end_period,'dd-mm-yyyy') as masa_pajak,
		to_char(due_date,'dd-mm-yyyy')as due_date_char, to_char(settlement_date,'dd-mm-yyyy') as tgl_tap,
		* from t_vat_setllement a
		left join t_cust_account x on x.t_cust_account_id=a.t_cust_account_id
		left join t_payment_receipt y on y.t_vat_setllement_id=a.t_vat_setllement_id
		where p_settlement_type_id = 4 and a.p_finance_period_id =".$param_arr['p_finance_period_id']."
		and a.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id =".$param_arr['p_vat_type_id'].")
		and x.p_account_status_id = 1";
	if ($param_arr['status_bayar']==2){
		$query.="and receipt_no is not null ORDER BY wp_name";
	}else{
		if ($param_arr['status_bayar']==3){
			$query.="and receipt_no is null ORDER BY wp_name";
		}else{
			$query.="ORDER BY wp_name";
		}
	}
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['npwpd'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_address_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['due_date_char'].'</td>';
		$output.='<td align="left" >'.$data[$i]['masa_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['tgl_tap'].'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['total_vat_amount'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['debt_vat_amt'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['db_increasing_charge'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['total_penalty_amount'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format(($data[$i]['total_penalty_amount']+$data[$i]['db_increasing_charge']+$data[$i]['debt_vat_amt']), 2, ',', '.').'</td>';
		
		if ($data[$i]['payment_date']=='') {
			$output.='<td align="left" >Belum Bayar</td>';
		}else{
			$output.='<td align="left" >Sudah Bayar</td>';
		}
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		$output.='<td align="left" ><input id="cetak_skpdkb" class="btn_tambah" onclick="cetak_skpdkb('.$data[$i]['set_id'].'); return false;" value="Non-Brcd" type="button">';
		$output.='<td align="left" ><input id="cetak_skpdkb_barcode" class="btn_tambah" onclick="cetak_skpdkb_barcode('.$data[$i]['set_id'].'); return false;" value="Barcode" type="button"></td>';
		$output.='</tr>';
	}

	$output.='</table>';
	
	return $output;
}
?>

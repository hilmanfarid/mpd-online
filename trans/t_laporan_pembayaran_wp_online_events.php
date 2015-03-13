<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-62D998DD
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_online; //Compatibility
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

//Page_BeforeShow @1-39013A25
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_online; //Compatibility
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
		$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');

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
                  		<td class="th"><strong>LAPORAN PEMBAYARAN WP ONLINE</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >NAMA</th>';
	$output.='<th align="center" >ALAMAT</th>';
	$output.='<th align="center" >JUMLAH PEMBAYARAN</th>';
	$output.='<th align="center" >TANGGAL PEMBAYARAN</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >NO. PEMBAYARAN</th>';
	$output.='<th align="center" >KODE BANK</th>';
	$output.='<th align="center" >KODE CABANG</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select a.npwd as npwpd , a.payment_key as no_bayar, * from t_vat_setllement a
		INNER join p_app_user b on a.created_by=b.app_user_name
		INNER join t_payment_receipt c on c.t_vat_setllement_id=a.t_vat_setllement_id
		left join t_cust_account d on d.t_cust_account_id = a.t_cust_account_id
		where is_employee = 'N'
		and p_vat_type_id = ".$param_arr['p_vat_type_id']."
		and (a.p_finance_period_id = ".$param_arr['p_finance_period_id']."
			OR
			to_char(trunc(payment_date),'dd-mm-yyyy')= '".$param_arr['tgl_penerimaan']."')
		ORDER BY wp_name, start_period desc";
		
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
		$output.='<td align="right" >'.number_format($data[$i]['payment_vat_amount'], 2, ',', '.').'</td>';
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		$output.='<td align="left" >'.$data[$i]['finance_period_code'].'</td>';
		$output.='<td align="left" >'.$data[$i]['no_bayar'].'</td>';	
		$output.='<td align="left" >'.$data[$i]['kode_bank'].'</td>';		
		$output.='<td align="left" >'.$data[$i]['kode_cabang'].'</td>';		
		$output.='</tr>';
	}

	$output.='</table>';
	
	return $output;
}
?>

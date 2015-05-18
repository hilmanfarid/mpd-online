<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-A8615A84
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_history_skpdkb; //Compatibility
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

//Page_BeforeShow @1-239EC31F
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_history_skpdkb; //Compatibility
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
	$output.='<th align="center" >AYAT PAJAK</th>';
	$output.='<th align="center" >ALAMAT</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >TGL TAP LAMA</th>';
	$output.='<th align="center" >TGL TAP BARU</th>';
	$output.='<th align="center" >JUMLAH PAJAK LAMA</th>';
	$output.='<th align="center" >JUMLAH PAJAK BARU</th>';
	$output.='<th align="center" >STATUS BAYAR</th>';
	$output.='<th align="center" >TANGGAL BAYAR</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="SELECT
     t_vat.npwd as npwpd,
		to_char(t_vat.settlement_date,'dd-mm-yyyy') as ketetapan_baru,
		to_char(h_vat.settlement_date,'dd-mm-yyyy') as ketetapan_lama,
		t_vat.start_period,
		t_vat.end_period,
		t_vat.total_vat_amount as jumlah,
		h_vat.total_vat_amount as jumlah_lama,
		a.*,
		b.code as masa_pajak,
		to_char(c.payment_date,'dd-mm-yyyy') as payment_date,
		d.vat_code as ayat_pajak
	FROM
	     t_vat_setllement t_vat,
	     h_vat_setllement h_vat,
		 t_cust_account a,
		 p_finance_period b ,
		 t_payment_receipt c,
		 p_vat_type_dtl d
	WHERE
		h_vat.p_settlement_type_id in(4,5)
		and t_vat.p_settlement_type_id =1
		and t_vat.p_finance_period_id = h_vat.p_finance_period_id
		and t_vat.t_cust_account_id = h_vat.t_cust_account_id
		and t_vat.p_finance_period_id = ".$param_arr['p_finance_period_id']."
		and a.t_cust_account_id= t_vat.t_cust_account_id
		and b.p_finance_period_id = t_vat.p_finance_period_id
		and t_vat.t_vat_setllement_id=c.t_vat_setllement_id (+)
		and upper(h_vat.modification_type) = 'DELETE'
		and d.p_vat_type_dtl_id=t_vat.p_vat_type_dtl_id
		order by wp_name ASC, t_vat.start_period DESC";

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
		$output.='<td align="left" >'.$data[$i]['ayat_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_address_name'].'</td>';
		$output.='<td align="left" width="85px">'.$data[$i]['masa_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['ketetapan_lama'].'</td>';
		$output.='<td align="left" >'.$data[$i]['ketetapan_baru'].'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['jumlah_lama'], 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['jumlah'], 2, ',', '.').'</td>';
		
		if ($data[$i]['payment_date']=='') {
			$output.='<td align="left" >Belum Bayar</td>';
		}else{
			$output.='<td align="left" >Sudah Bayar</td>';
		}
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		$output.='</tr>';
	}

	$output.='</table>';
	
	return $output;
}
?>

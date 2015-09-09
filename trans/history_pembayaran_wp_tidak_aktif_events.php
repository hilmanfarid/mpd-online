<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-6465D803
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $history_pembayaran_wp_tidak_aktif; //Compatibility
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

//Page_BeforeShow @1-CB8B7EBD
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $history_pembayaran_wp_tidak_aktif; //Compatibility
//End Page_BeforeShow

//Custom Code @70-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['t_cust_account_id'] = CCGetFromGet('t_cust_account_id');
	if($doAction == 'view_html') {
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
	
	$output .='<table class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  <td class="th"><strong>HISTORY TRANSAKSI WAJIB PAJAK <input style="WIDTH: 112px; HEIGHT: 22px" id="HistoryGridcustomer_name" value="{customer_name}" size="15" type="hidden" name="{customer_name_Name}">&nbsp;<input style="WIDTH: 100px; HEIGHT: 22px" id="HistoryGridt_customer_id" value="{t_customer_id}" size="13" type="hidden" name="{t_customer_id_Name}"><input style="WIDTH: 100px; HEIGHT: 22px" id="HistoryGridt_cust_acc_id" value="{t_cust_acc_id}" size="13" type="hidden" name="{t_cust_acc_id_Name}"></strong></td> 
                  <td class="HeaderRight"><font color="#ffffff"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></font></td>
                </tr>
              </table>
 
              <table border="1" class="Grid" cellspacing="0" cellpadding="0">
                <tr class="Caption">
                  <th style="TEXT-ALIGN: center; VERTICAL-ALIGN: middle" rowspan="3" scope="col">NPWPD</th>
 
                  <th style="TEXT-ALIGN: center; VERTICAL-ALIGN: middle" rowspan="3" scope="col">Nama Badan</th>
 
                  <th style="TEXT-ALIGN: center" colspan="15" scope="col">Pelaporan Pajak</th>
 
                  <th style="TEXT-ALIGN: center" colspan="3" scope="col">&nbsp;Pembayaran</th>
                </tr>
 
                <tr class="Caption">
                  <th rowspan="2" scope="col">&nbsp;Jenis Ketetapan</th>
 
                  <th rowspan="2" scope="col">Ayat Pajak&nbsp;</th>
 
                  <th rowspan="2" scope="col">Periode Pelaporan</th>
 
                  <th rowspan="2" scope="col">&nbsp;Periode Transaksi</th>
 
                  <th rowspan="2" scope="col">&nbsp;Tgl. Pelaporan</th>
 
                  <th scope="col" rowspan="2" >Tgl.Jatuh Tempo&nbsp;</th>
 
                  <th rowspan="2" scope="col">No. Kohir&nbsp;</th>
 
                  <th rowspan="2" scope="col">Total Transaksi&nbsp;</th>
 
                  <th rowspan="2" scope="col">&nbsp;Total Pajak</th>
 
                  <th rowspan="2" scope="col">&nbsp;Pajak Terhutang</th>
 
                  <th colspan="2" scope="col">Sanksi Adm.&nbsp;</th>
 
                  <th rowspan="2" scope="col">&nbsp;Denda</th>
 
                  <th rowspan="2" scope="col">&nbsp;Total Harus Bayar</th>
 
                  <th rowspan="2" scope="col">&nbsp;No. Kwitansi</th>
 
                  <th rowspan="2" scope="col">Tgl. Pembayaran&nbsp;</th>
 
                  <th rowspan="2" scope="col">Nilai Pembayaran&nbsp;</th>
                </tr>
 
                <tr class="Caption">
                  <th scope="col">25%</th>
 
                  <th scope="col">2%</th>
                </tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select x.vat_code as ayat,hasil.* from 
			(Select c.npwd, 
				   a.t_vat_setllement_id,	
				   c.t_cust_account_id,
			       c.company_name, 
			       b.code as Periode_pelaporan, 
			       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
			       a.total_trans_amount as total_transaksi,
			       a.total_vat_amount as total_pajak ,
				   nvl(a.total_penalty_amount,0) as total_denda,
			       d.receipt_no as kuitansi_pembayaran, 
			       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
			       d.payment_amount,
			       c.t_cust_account_id ,
			       b.p_finance_period_id ,
			       to_char(a.start_period,'DD-MON-YYYY') as periode_awal_laporan,
			       to_char(a.end_period,'DD-MON-YYYY') as periode_akhir_laporan,
						 e.code as type_code,
			 			 nvl(A.debt_vat_amt,a.total_vat_amount) as debt_vat_amt,
						 nvl(a.db_increasing_charge,0) as db_increasing_charge,
						 CASE WHEN debt_vat_amt=0 THEN total_vat_amount
				            ELSE nvl(A.debt_vat_amt,a.total_vat_amount)
							END + nvl(a.db_increasing_charge,0) +nvl(a.db_interest_charge,0) + nvl(a.total_penalty_amount,0) as total_hrs_bayar,
						 nvl(a.db_increasing_charge,0) as kenaikan,
						 nvl(a.db_interest_charge,0) as kenaikan1,
						 a.p_vat_type_dtl_id,
						 a.no_kohir,
						 to_char(a.due_date,'DD-MON-YYYY') as jatuh_tempo
			from t_vat_setllement a,
			     p_finance_period b,
			     t_cust_account c,
			     t_payment_receipt d,
				 p_settlement_type e
			where a.p_finance_period_id = b.p_finance_period_id
			      and a.t_cust_account_id = c.t_cust_account_id
				  and a.t_cust_account_id = ".$param_arr['t_cust_account_id']."
			      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
				  and a.p_settlement_type_id = e.p_settlement_type_id
				  and d.receipt_no is null
			order by c.npwd , b.start_date desc,
			  a.t_vat_setllement_id) as hasil
		left join p_vat_type_dtl x on x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id";
	//return $output;
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr {HistoryGrid:rowStyle}> 
                  <td style="">&nbsp;'.$data[$i]['npwd'].'</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['company_name'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['type_code'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['ayat'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['periode_pelaporan'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['periode_awal_laporan'].' s/d '.$data[$i]['periode_akhir_laporan'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['tgl_pelaporan'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['jatuh_tempo'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['no_kohir'].'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['total_transaksi'], 2, ',', '.').'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['total_pajak'], 2, ',', '.').'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['debt_vat_amt'], 2, ',', '.').'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['kenaikan'], 2, ',', '.').'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['kenaikan1'], 2, ',', '.').'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; COLOR: red; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['total_denda'], 2, ',', '.').'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['total_hrs_bayar'], 2, ',', '.').'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['kuitansi_pembayaran'].'&nbsp;</td> 
                  <td style="BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.$data[$i]['tgl_pembayaran'].'&nbsp;</td> 
                  <td style="TEXT-ALIGN: right; BORDER-RIGHT: #dcdcdc 1px solid" nowrap>&nbsp;'.number_format($data[$i]['payment_amount'], 2, ',', '.').'&nbsp;</td>
                </tr>';
	}

	$output.='</table>';
	
	return $output;
}
?>

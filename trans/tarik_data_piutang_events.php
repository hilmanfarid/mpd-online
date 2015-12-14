<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-E6AC57E3
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tarik_data_piutang; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$cetak_laporan = CCGetFromGet('cetak_laporan');
	global $Label1;
	 
// -------------------------
    // Write your own code here.

	if($cetak_laporan == 'view_html') {
		$param_arr = array();
		$param_arr['p_vat_type_id'] = CCGetFromGet("p_vat_type_id",'');
		$param_arr['p_year_period_id'] = CCGetFromGet("p_year_period_id",'');
		$param_arr['year_code'] = CCGetFromGet("year_code",'');
		$param_arr['vat_code'] = CCGetFromGet("vat_code",'');
		$param_arr['npwpd'] = CCGetFromGet("npwpd",'');

		$Label1->SetText(view_html($param_arr));

	}else if($cetak_laporan == 'download_excel') {
		$param_arr = array();
		$param_arr['p_vat_type_id'] = CCGetFromGet("p_vat_type_id",'');
		$param_arr['p_year_period_id'] = CCGetFromGet("p_year_period_id",'');
		$param_arr['year_code'] = CCGetFromGet("year_code",'');
		$param_arr['vat_code'] = CCGetFromGet("vat_code",'');
		$param_arr['npwpd'] = CCGetFromGet("npwpd",'');

		cetak_excel($param_arr);
	}
	
// -------------------------


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


function cetak_excel($param_arr){
		
	$dbConn = new clsDBConnSIKP();
	$whereCondition = "";
    if($param_arr['npwpd'] != "") {
	   $whereCondition .= " AND A .npwd = '".$param_arr['npwpd']."' ";
	}

	$query="SELECT
					nvl (nama, company_name) AS new_company_name,
					masa_awal,
					masa_akhir,
					data_transaksi.*
				FROM
					(
						SELECT
							*
						FROM
							(
								SELECT
									C .npwd,
									A .t_vat_setllement_id,
									C .company_name,
									b.code AS periode_pelaporan,
									to_char(
										A .settlement_date,
										'DD-MON-YYYY'
									) tgl_pelaporan,
									A .total_trans_amount AS total_transaksi,
									A .total_vat_amount AS total_pajak,
									nvl (A .total_penalty_amount, 0) AS total_denda,
									d.receipt_no AS kuitansi_pembayaran,
									to_char(
										payment_date,
										'DD-MON-YYYY HH24:MI:SS'
									) tgl_pembayaran,
									d.payment_amount,
									C .t_cust_account_id,
									b.p_finance_period_id,
									to_char(
										A .start_period,
										'DD-MON-YYYY'
									) AS periode_awal_laporan,
									to_char(A .end_period, 'DD-MON-YYYY') AS periode_akhir_laporan,
									e.code AS type_code,
									nvl (
										A .debt_vat_amt,
										A .total_vat_amount
									) AS debt_vat_amt,
									nvl (A .db_increasing_charge, 0) AS db_increasing_charge,
									nvl (
										A .debt_vat_amt,
										A .total_vat_amount
									) + nvl (A .db_increasing_charge, 0) + nvl (A .db_interest_charge, 0) + nvl (A .total_penalty_amount, 0) AS total_hrs_bayar,
									nvl (A .db_increasing_charge, 0) AS kenaikan,
									nvl (A .db_interest_charge, 0) AS kenaikan1,
									A .p_vat_type_dtl_id,
									A .no_kohir,
									to_char(A .due_date, 'DD-MON-YYYY') AS jatuh_tempo,
									settlement_date,
									b.start_date,
									A .is_settled
								FROM
									t_vat_setllement A,
									p_finance_period b,
									t_cust_account C,
									t_payment_receipt d,
									p_settlement_type e
								WHERE
									A .p_finance_period_id = b.p_finance_period_id
								AND A .t_cust_account_id = C .t_cust_account_id
								AND EXTRACT (YEAR FROM A .settlement_date) = '".$param_arr['year_code']."'
								AND A .is_settled = 'N'
								".$whereCondition."
								AND A .t_vat_setllement_id = d.t_vat_setllement_id (+)
								AND A .p_settlement_type_id = e.p_settlement_type_id
							) AS hasil
						LEFT JOIN p_vat_type_dtl x ON x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id
					) AS data_transaksi
				LEFT JOIN t_cust_acc_masa_jab masa_jab ON masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id
				AND masa_awal <= settlement_date
				AND CASE
				WHEN masa_akhir IS NULL THEN
					TRUE
				WHEN masa_akhir >= settlement_date THEN
					masa_akhir >= settlement_date
				END
				WHERE
					data_transaksi.p_vat_type_id = ".$param_arr['p_vat_type_id']."
				ORDER BY
					npwd,
					start_date DESC,
					t_vat_setllement_id";
	
	
	$dbConn->query($query);
	
	$output = "";

	startExcel("data_piutang_".date("d_m_Y").".xls");
	$output .= '<h2>DATA PIUTANG '.strtoupper($param_arr['vat_code']).' TAHUN '.$param_arr['year_code'].'<h2/>';
	$output .='<table border="1" cellspacing="0" cellpadding="0" width="100%">';

	$output.='<tr>
				<th rowspan="3" style="VERTICAL-ALIGN: middle; TEXT-ALIGN: center">NO</th>
				<th rowspan="3" style="VERTICAL-ALIGN: middle; TEXT-ALIGN: center">NPWPD</th>
				<th rowspan="3" style="VERTICAL-ALIGN: middle; TEXT-ALIGN: center">Nama Badan</th>
				<th colspan="14" style="TEXT-ALIGN: center">Pelaporan Pajak</th>
				<th colspan="3" style="TEXT-ALIGN: center"> Pembayaran</th>
			</tr>
			<tr>
				<th rowspan="2"> Jenis Ketetapan</th>
				<th rowspan="2"> Ayat Pajak </th>
				<th rowspan="2"> Periode Pelaporan</th>
				<th rowspan="2"> Periode Transaksi</th>
				<th rowspan="2"> Tgl. Pelaporan</th>
				<th rowspan="2"> Tgl.Jatuh Tempo </th>
				<th rowspan="2"> No. Kohir </th>
				<th rowspan="2"> Total Transaksi </th>
				<th rowspan="2"> Total Pajak</th>
				<th rowspan="2"> Pajak Terhutang</th>
				<th colspan="2"> Sanksi Adm. </th>
				<th rowspan="2"> Denda</th>
				<th rowspan="2"> Total Harus Bayar</th>
				<th rowspan="2"> No. Kwitansi</th>
				<th rowspan="2"> Tgl. Pembayaran </th>
				<th rowspan="2"> Nilai Pembayaran </th>
			</tr>
			<tr>
				<th>25%</th>
				<th>2%</th>
			</tr>';
	
	$total = 0;
	$no=1;

	while($dbConn->next_record()){
		$item = $dbConn->Record;
		
		$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$item['npwd'].'</td>';
			$output .= '<td align="left">'.$item['company_name'].'</td>';
			$output .= '<td align="left">'.$item['type_code'].'</td>';
			$output .= '<td align="left">'.$item['vat_code'].'</td>';
			$output .= '<td align="left">&nbsp;'.$item['periode_pelaporan'].'</td>';
			$output .= '<td align="left">'.$item['periode_awal_laporan'].' s.d '.$item['periode_awal_laporan'].'</td>';
			$output .= '<td align="center">&nbsp;'.$item['tgl_pelaporan'].'</td>';
			$output .= '<td align="center">&nbsp;'.$item['jatuh_tempo'].'</td>';
			$output .= '<td align="center">&nbsp;'.$item['no_kohir'].'</td>';
			$output .= '<td align="right">'.number_format($item['total_transaksi'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['total_pajak'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['debt_vat_amt'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['kenaikan'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['kenaikan1'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['total_denda'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['total_hrs_bayar'],0,",",".").'</td>';
			$output .= '<td align="center">'.$item['kuitansi_pembayaran'].'</td>';		
			$output .= '<td align="center">&nbsp;'.$item['tgl_pembayaran'].'</td>';
			$output .= '<td align="right">'.number_format($item['payment_amount'],0,",",".").'</td>';

		$output .= '</tr>';
	}

	
	$output.='</table>';
	echo $output;
	exit;
}

function view_html($param_arr) {
	$output = '';	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="160%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>DATA PIUTANG '.strtoupper($param_arr['vat_code']).' TAHUN '.$param_arr['year_code'].'</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
               </table>';
	
	$output .='<table class="report" cellspacing="0" cellpadding="0" width="100%">';

	$output.='<tr>
				<th rowspan="3" style="VERTICAL-ALIGN: middle; TEXT-ALIGN: center">NO</th>
				<th rowspan="3" style="VERTICAL-ALIGN: middle; TEXT-ALIGN: center">NPWPD</th>
				<th rowspan="3" style="VERTICAL-ALIGN: middle; TEXT-ALIGN: center">Nama Badan</th>
				<th colspan="14" style="TEXT-ALIGN: center">Pelaporan Pajak</th>
				<th colspan="3" style="TEXT-ALIGN: center"> Pembayaran</th>
			</tr>
			<tr>
				<th rowspan="2"> Jenis Ketetapan</th>
				<th rowspan="2"> Ayat Pajak </th>
				<th rowspan="2"> Periode Pelaporan</th>
				<th rowspan="2"> Periode Transaksi</th>
				<th rowspan="2"> Tgl. Pelaporan</th>
				<th rowspan="2"> Tgl.Jatuh Tempo </th>
				<th rowspan="2"> No. Kohir </th>
				<th rowspan="2"> Total Transaksi </th>
				<th rowspan="2"> Total Pajak</th>
				<th rowspan="2"> Pajak Terhutang</th>
				<th colspan="2"> Sanksi Adm. </th>
				<th rowspan="2"> Denda</th>
				<th rowspan="2"> Total Harus Bayar</th>
				<th rowspan="2"> No. Kwitansi</th>
				<th rowspan="2"> Tgl. Pembayaran </th>
				<th rowspan="2"> Nilai Pembayaran </th>
			</tr>
			<tr>
				<th>25%</th>
				<th>2%</th>
			</tr>';
	
	$dbConn = new clsDBConnSIKP();
	$whereCondition = "";
    if($param_arr['npwpd'] != "") {
	   $whereCondition .= " AND A .npwd = '".$param_arr['npwpd']."' ";
	}

	$query="SELECT
					nvl (nama, company_name) AS new_company_name,
					masa_awal,
					masa_akhir,
					data_transaksi.*
				FROM
					(
						SELECT
							*
						FROM
							(
								SELECT
									C .npwd,
									A .t_vat_setllement_id,
									C .company_name,
									b.code AS periode_pelaporan,
									to_char(
										A .settlement_date,
										'DD-MON-YYYY'
									) tgl_pelaporan,
									A .total_trans_amount AS total_transaksi,
									A .total_vat_amount AS total_pajak,
									nvl (A .total_penalty_amount, 0) AS total_denda,
									d.receipt_no AS kuitansi_pembayaran,
									to_char(
										payment_date,
										'DD-MON-YYYY HH24:MI:SS'
									) tgl_pembayaran,
									d.payment_amount,
									C .t_cust_account_id,
									b.p_finance_period_id,
									to_char(
										A .start_period,
										'DD-MON-YYYY'
									) AS periode_awal_laporan,
									to_char(A .end_period, 'DD-MON-YYYY') AS periode_akhir_laporan,
									e.code AS type_code,
									nvl (
										A .debt_vat_amt,
										A .total_vat_amount
									) AS debt_vat_amt,
									nvl (A .db_increasing_charge, 0) AS db_increasing_charge,
									nvl (
										A .debt_vat_amt,
										A .total_vat_amount
									) + nvl (A .db_increasing_charge, 0) + nvl (A .db_interest_charge, 0) + nvl (A .total_penalty_amount, 0) AS total_hrs_bayar,
									nvl (A .db_increasing_charge, 0) AS kenaikan,
									nvl (A .db_interest_charge, 0) AS kenaikan1,
									A .p_vat_type_dtl_id,
									A .no_kohir,
									to_char(A .due_date, 'DD-MON-YYYY') AS jatuh_tempo,
									settlement_date,
									b.start_date,
									A .is_settled
								FROM
									t_vat_setllement A,
									p_finance_period b,
									t_cust_account C,
									t_payment_receipt d,
									p_settlement_type e
								WHERE
									A .p_finance_period_id = b.p_finance_period_id
								AND A .t_cust_account_id = C .t_cust_account_id
								AND EXTRACT (YEAR FROM A .settlement_date) = '".$param_arr['year_code']."'
								AND A .is_settled = 'N'
								".$whereCondition."
								AND A .t_vat_setllement_id = d.t_vat_setllement_id (+)
								AND A .p_settlement_type_id = e.p_settlement_type_id
							) AS hasil
						LEFT JOIN p_vat_type_dtl x ON x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id
					) AS data_transaksi
				LEFT JOIN t_cust_acc_masa_jab masa_jab ON masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id
				AND masa_awal <= settlement_date
				AND CASE
				WHEN masa_akhir IS NULL THEN
					TRUE
				WHEN masa_akhir >= settlement_date THEN
					masa_akhir >= settlement_date
				END
				WHERE
					data_transaksi.p_vat_type_id = ".$param_arr['p_vat_type_id']."
				ORDER BY
					npwd,
					start_date DESC,
					t_vat_setllement_id";
	
	
	$dbConn->query($query);
	$total = 0;
	$no=1;

	while($dbConn->next_record()){
		$item = $dbConn->Record;
		
		$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$item['npwd'].'</td>';
			$output .= '<td align="left">'.$item['company_name'].'</td>';
			$output .= '<td align="left">'.$item['type_code'].'</td>';
			$output .= '<td align="left">'.$item['vat_code'].'</td>';
			$output .= '<td align="left">'.$item['periode_pelaporan'].'</td>';
			$output .= '<td align="left">'.$item['periode_awal_laporan'].' s.d '.$item['periode_awal_laporan'].'</td>';
			$output .= '<td align="center">'.$item['tgl_pelaporan'].'</td>';
			$output .= '<td align="center">'.$item['jatuh_tempo'].'</td>';
			$output .= '<td align="center">'.$item['no_kohir'].'</td>';
			$output .= '<td align="right">'.number_format($item['total_transaksi'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['total_pajak'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['debt_vat_amt'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['kenaikan'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['kenaikan1'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['total_denda'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['total_hrs_bayar'],0,",",".").'</td>';
			$output .= '<td align="center">'.$item['kuitansi_pembayaran'].'</td>';		
			$output .= '<td align="center">'.$item['tgl_pembayaran'].'</td>';
			$output .= '<td align="right">'.number_format($item['payment_amount'],0,",",".").'</td>';

		$output .= '</tr>';
	}

	
	$output.='</table>';
	
	return $output;
}


function dateToString($date){
	if(empty($date)) return "";
	
	$monthname = array(0  => '-',
	                   1  => 'Januari',
	                   2  => 'Februari',
	                   3  => 'Maret',
	                   4  => 'April',
	                   5  => 'Mei',
	                   6  => 'Juni',
	                   7  => 'Juli',
	                   8  => 'Agustus',
	                   9  => 'September',
	                   10 => 'Oktober',
	                   11 => 'November',
	                   12 => 'Desember');    
	
	$pieces = explode('-', $date);
	
	return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
}

?>

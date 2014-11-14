<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-56FF48A3
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_harian_teller; //Compatibility
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

//Page_BeforeShow @1-7165DB58
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_harian_teller; //Compatibility
//End Page_BeforeShow

//Custom Code @562-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	$tampil = CCGetFromGet('tampil');
	if($tampil=='T'){
		$tgl_penerimaan = CCGetFromGet('tgl_penerimaan');
		$nama_teller = CCGetFromGet('nama_teller');
		$param_arr = array();

		$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
		$param_arr['nama_teller'] = CCGetFromGet('nama_teller');

		$Label1->SetText(GetCetakGeneralHTML($param_arr));
	}elseif($tampil == 'download_excel') {
		$tgl_penerimaan = CCGetFromGet('tgl_penerimaan');
		$nama_teller = CCGetFromGet('nama_teller');
		$param_arr = array();

		$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
		$param_arr['nama_teller'] = CCGetFromGet('nama_teller');

		print_excel($param_arr);
		
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


function print_excel($param_arr) {
	
	startExcel("laporan_harian_teller");
	echo "<div><h3> LAPORAN HARIAN TELLER </h3></div>";	
	echo "<div><b>NAMA TELLER : ".$param_arr['nama_teller']."</b></div>";	
	echo "<div><b>TGL PENERIMAAN : ".$param_arr['tgl_penerimaan']."</b></div>";
	//echo "<div><b>STATUS : ".$param_arr['status_text']."</b></div><br/>";

			
	$dbConn = new clsDBConnSIKP();
	$query = "SELECT f.t_payment_receipt_id, f.p_cg_terminal_id, f.npwd, d.wp_name, f.receipt_no, f.payment_date, 
					a.no_kohir, f.finance_period_code, f.payment_amount, f.payment_vat_amount,
						c.vat_code as ayat_pajak,
						c.code as dtl_code,
						vat.code as vat_code
						FROM t_payment_receipt f, t_vat_setllement a, p_vat_type_dtl c, t_cust_account d,
						p_vat_type vat
						WHERE 
						f.t_vat_setllement_id = a.t_vat_setllement_id AND
						f.p_vat_type_dtl_id = c.p_vat_type_dtl_id AND
						a.t_cust_account_id = d.t_cust_account_id AND
						( upper(f.p_cg_terminal_id) LIKE upper('%".$param_arr['nama_teller']."%')
						) 
						AND trunc(f.payment_date) = '".$param_arr['tgl_penerimaan']."'
						and vat.p_vat_type_id = c.p_vat_type_id
						ORDER BY c.vat_code ASC, f.payment_date DESC";

	$dbConn->query($query);
	$data = array();
	while ($dbConn->next_record()) {
		$data["t_payment_receipt_id"][] = $dbConn->f("t_payment_receipt_id");
		$data["p_cg_terminal_id"][] = $dbConn->f("p_cg_terminal_id");
		$data["npwd"][] = $dbConn->f("npwd");
		$data["wp_name"][] = $dbConn->f("wp_name");
		$data["receipt_no"][] = $dbConn->f("receipt_no");
		$data["payment_date"][] = $dbConn->f("payment_date");
		$data["no_kohir"][] = $dbConn->f("no_kohir");
		$data["finance_period_code"][] = $dbConn->f("finance_period_code");
		$data["payment_vat_amount"][] = $dbConn->f("payment_vat_amount");
		$data["denda"][] = ($dbConn->f("payment_amount")-$dbConn->f("payment_vat_amount"));
		$data["vat_code"][] = $dbConn->f("vat_code");
		$data["dtl_code"][] = $dbConn->f("dtl_code");
		$data["ayat_pajak"][] = $dbConn->f("ayat_pajak");
	}
	$dbConn->close();
	
	$output = '';
	$output .='<table border="1" width="100%">
                <tr style="background:#498CD6;color:#FFFFFF;">';
	$output .= '<th>NO</th>';
	$output .= '<th>KODE AYAT</th>';
	$output .= '<th>NAMA WP</th>';
	$output .= '<th>NPWPD</th>';
	$output .= '<th>TGL PEMBAYARAN</th>';
	$output .= '<th>PERIODE</th>';
	$output .= '<th>AYAT PAJAK</th>';	
	$output .= '<th>NOMOR KOHIR</th>';
	$output .= '<th>NILAI DENDA</th>';
	$output .= '<th>NILAI PAJAK</th>';
	$output .= '</tr>';
	

	$no = 1;
	$total_payment = 0;
	$total_denda = 0;
	$ayat_pajak = $data['ayat_pajak'][0];
	
	$total_per_ayat = 0;
	$total_denda_per_ayat = 0;

	for($i = 0; $i < count($data['t_payment_receipt_id']); $i++) {

		$total_payment += $data['payment_vat_amount'][$i];
		$total_denda += $data['denda'][$i];

		if($ayat_pajak != $data['ayat_pajak'][$i]) {
						

			$output .= '<tr>';
			$output .= '<td colspan="8" align="center"> <b>TOTAL '.$ayat_pajak.'</b></td>';
			$output .= '<td align="right" style="color:#FF0000;">'.number_format($total_denda_per_ayat, 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">'.number_format($total_per_ayat, 0, ',', '.').'</td>';
			$output .= '<tr>';
			
			$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$data['p_cg_terminal_id'][$i].'</td>';
			$output .= '<td align="left">'.$data['wp_name'][$i].'</td>';
			$output .= '<td align="left">'.$data['npwd'][$i].'</td>';
			$output .= '<td align="center">'.$data['payment_date'][$i].'</td>';
			$output .= '<td align="left" style="color:#008000;font-weight:bold;">'.$data['finance_period_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['ayat_pajak'][$i].'</td>';
			$output .= '<td align="center" style="color:#008000;">'.$data['no_kohir'][$i].'</td>';
			$output .= '<td align="right" style="color:#FF0000;">'.number_format($data['denda'][$i], 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">'.number_format($data['payment_vat_amount'][$i], 0, ',', '.').'</td>';
			$output .= '</tr>';
			
			$ayat_pajak = $data['ayat_pajak'][$i];
			$total_per_ayat = 0;
			$total_denda_per_ayat = 0;

			$total_per_ayat += $data['payment_vat_amount'][$i];
			$total_denda_per_ayat += $data['denda'][$i];
		}else {

			$total_per_ayat += $data['payment_vat_amount'][$i];
			$total_denda_per_ayat += $data['denda'][$i];

			$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$data['vat_code'][$i].$data['dtl_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['wp_name'][$i].'</td>';
			$output .= '<td align="left">'.$data['npwd'][$i].'</td>';
			$output .= '<td align="center">'.$data['payment_date'][$i].'</td>';
			$output .= '<td align="left" style="color:#008000;font-weight:bold;">'.$data['finance_period_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['ayat_pajak'][$i].'</td>';
			$output .= '<td align="center" style="color:#008000;">'.$data['no_kohir'][$i].'</td>';
			$output .= '<td align="right" style="color:#FF0000;">'.number_format($data['denda'][$i], 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">'.number_format($data['payment_vat_amount'][$i], 0, ',', '.').'</td>';
			$output .= '</tr>';
		}
	}	
			
			$output .= '<tr>';
			$output .= '<td colspan="8" align="center"> <b>TOTAL '.$ayat_pajak.'</b></td>';
			$output .= '<td align="right" style="color:#FF0000;">'.number_format($total_denda_per_ayat, 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">'.number_format($total_per_ayat, 0, ',', '.').'</td>';
			$output .= '<tr>';

		$output .= '<tr>
			<td colspan="8" align="center" style="font-size:15px;"> <b>TOTAL </b></td>
			<td align="right" style="font-size:15px;color:#FF0000;font-weight:bold;">'.number_format($total_denda, 0, ',', '.').'</td>
			<td align="right" style="font-size:15px;color:#000080;font-weight:bold;">'.number_format($total_payment, 0, ',', '.').'</td>
		</tr>';

	$output .= '</table>';
	$output .= '</td></tr>';
	$output .= '</table>';
	
	echo $output;
	exit;
}

function GetCetakGeneralHTML($param_arr) {
	
	
	$output = '';
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="97% style="margin-left:10px;padding:5px 5px 5px 5px;">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN HARIAN TELLER</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              	</table>';
	//$output .= '<div align="right"><a href="#" onClick="downloadGeneral();"> Download Excel </a></div>';
	$output .= '<h3>NAMA TELLER : '.$param_arr["nama_teller"].'';
	$output .= '<h3>TANGGAL : '.$param_arr["tgl_penerimaan"].'</h3> <br/>';
	
	$output .='<table class="report" cellspacing="0" cellpadding="4px" width="100%">
                <tr style="background:#498CD6;color:#FFFFFF;">';
	$output .= '<th>NO</th>';
	$output .= '<th>KODE AYAT</th>';
	$output .= '<th>NAMA WP</th>';
	$output .= '<th>NPWPD</th>';
	$output .= '<th>TGL PEMBAYARAN</th>';
	$output .= '<th>PERIODE</th>';
	$output .= '<th>AYAT PAJAK</th>';	
	$output .= '<th>NOMOR KOHIR</th>';
	$output .= '<th>NILAI DENDA</th>';
	$output .= '<th>NILAI PAJAK</th>';
	$output .= '</tr>';
	
	
	$dbConn = new clsDBConnSIKP();
	$query = "SELECT f.t_payment_receipt_id, f.p_cg_terminal_id, f.npwd, d.wp_name, f.receipt_no, f.payment_date, 
					a.no_kohir, f.finance_period_code, f.payment_amount, f.payment_vat_amount,
						c.vat_code as ayat_pajak,
						c.code as dtl_code,
						vat.code as vat_code
						FROM t_payment_receipt f, t_vat_setllement a, p_vat_type_dtl c, t_cust_account d,
						p_vat_type vat
						WHERE 
						f.t_vat_setllement_id = a.t_vat_setllement_id AND
						f.p_vat_type_dtl_id = c.p_vat_type_dtl_id AND
						a.t_cust_account_id = d.t_cust_account_id AND
						( upper(f.p_cg_terminal_id) LIKE upper('%".$param_arr['nama_teller']."%')
						) 
						AND trunc(f.payment_date) = '".$param_arr['tgl_penerimaan']."'
						and vat.p_vat_type_id = c.p_vat_type_id
						ORDER BY c.vat_code ASC";
	//ECHO $query;EXIT;
	$dbConn->query($query);
	$data = array();
	while ($dbConn->next_record()) {
		$data["t_payment_receipt_id"][] = $dbConn->f("t_payment_receipt_id");
		$data["p_cg_terminal_id"][] = $dbConn->f("p_cg_terminal_id");
		$data["npwd"][] = $dbConn->f("npwd");
		$data["wp_name"][] = $dbConn->f("wp_name");
		$data["receipt_no"][] = $dbConn->f("receipt_no");
		$data["payment_date"][] = $dbConn->f("payment_date");
		$data["no_kohir"][] = $dbConn->f("no_kohir");
		$data["finance_period_code"][] = $dbConn->f("finance_period_code");
		$data["payment_vat_amount"][] = $dbConn->f("payment_vat_amount");
		$data["denda"][] = ($dbConn->f("payment_amount")-$dbConn->f("payment_vat_amount"));
		$data["ayat_pajak"][] = $dbConn->f("ayat_pajak");
		$data["vat_code"][] = $dbConn->f("vat_code");
		$data["dtl_code"][] = $dbConn->f("dtl_code");
	}
	$dbConn->close();
	
	$no = 1;
	$total_payment = 0;
	$total_denda = 0;
	$ayat_pajak = $data['ayat_pajak'][0];
	
	$total_per_ayat = 0;
	$total_denda_per_ayat = 0;

	for($i = 0; $i < count($data['t_payment_receipt_id']); $i++) {

		$total_payment += $data['payment_vat_amount'][$i];
		$total_denda += $data['denda'][$i];

		if($ayat_pajak != $data['ayat_pajak'][$i]) {
						

			$output .= '<tr>';
			$output .= '<td colspan="8" align="center"> <b>TOTAL '.$ayat_pajak.'</b></td>';
			$output .= '<td align="right" style="color:#FF0000;">Rp '.number_format($total_denda_per_ayat, 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">Rp '.number_format($total_per_ayat, 0, ',', '.').'</td>';
			$output .= '<tr>';
			
			$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$data['vat_code'][$i].$data['dtl_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['wp_name'][$i].'</td>';
			$output .= '<td align="left">'.$data['npwd'][$i].'</td>';
			$output .= '<td align="center">'.$data['payment_date'][$i].'</td>';
			$output .= '<td align="left" style="color:#008000;font-weight:bold;">'.$data['finance_period_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['ayat_pajak'][$i].'</td>';
			$output .= '<td align="center" style="color:#008000;">'.$data['no_kohir'][$i].'</td>';
			$output .= '<td align="right" style="color:#FF0000;">'.number_format($data['denda'][$i], 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">'.number_format($data['payment_vat_amount'][$i], 0, ',', '.').'</td>';
			$output .= '</tr>';
			
			$ayat_pajak = $data['ayat_pajak'][$i];
			$total_per_ayat = 0;
			$total_denda_per_ayat = 0;

			$total_per_ayat += $data['payment_vat_amount'][$i];
			$total_denda_per_ayat += $data['denda'][$i];
		}else {

			$total_per_ayat += $data['payment_vat_amount'][$i];
			$total_denda_per_ayat += $data['denda'][$i];

			$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$data['vat_code'][$i].$data['dtl_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['wp_name'][$i].'</td>';
			$output .= '<td align="left">'.$data['npwd'][$i].'</td>';
			$output .= '<td align="center">'.$data['payment_date'][$i].'</td>';
			$output .= '<td align="left" style="color:#008000;font-weight:bold;">'.$data['finance_period_code'][$i].'</td>';
			$output .= '<td align="left">'.$data['ayat_pajak'][$i].'</td>';
			$output .= '<td align="center" style="color:#008000;">'.$data['no_kohir'][$i].'</td>';
			$output .= '<td align="right" style="color:#FF0000;">'.number_format($data['denda'][$i], 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">'.number_format($data['payment_vat_amount'][$i], 0, ',', '.').'</td>';
			$output .= '</tr>';
		}
	}	
			
			$output .= '<tr>';
			$output .= '<td colspan="8" align="center"> <b>TOTAL '.$ayat_pajak.'</b></td>';
			$output .= '<td align="right" style="color:#FF0000;">Rp '.number_format($total_denda_per_ayat, 0, ',', '.').'</td>';
			$output .= '<td align="right" style="color:#000080;">Rp '.number_format($total_per_ayat, 0, ',', '.').'</td>';
			$output .= '<tr>';

		$output .= '<tr>
			<td colspan="8" align="center" style="font-size:15px;"> <b>TOTAL </b></td>
			<td align="right" style="font-size:15px;color:#FF0000;">Rp '.number_format($total_denda, 0, ',', '.').'</td>
			<td align="right" style="font-size:15px;color:#000080;">Rp '.number_format($total_payment, 0, ',', '.').'</td>
		</tr>';

	$output .= '</table>';
	$output .= '</td></tr>';
	$output .= '</table>';

	return $output;
} 
?>

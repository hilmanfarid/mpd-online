<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-252B8A6C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_denda_profesi_ppat; //Compatibility
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

//Page_BeforeShow @1-9F7B2A29
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_denda_profesi_ppat; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
	if ($param_arr['p_finance_period_id'] == 0){
		$param_arr['p_finance_period_id'] = '';
	}
	$param_arr['status_bayar'] = CCGetFromGet('ListBox1');

	$param_arr['year_code'] = CCGetFromGet('year_code');
	$param_arr['code'] = CCGetFromGet('code');
	if($doAction == 'view_html' || $doAction == 'view_excel') {
		$Label1->SetText(GetCetakHTML($param_arr));
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
		startExcel("laporan_denda_profesi.xls");
	}

	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="HeaderLeft"></td> 
                  		<td class="th"><strong>LAPORAN DENDA PROFESI PPAT</strong></td> 
                  		<td class="HeaderRight"></td>
                	</tr>
              		</table>';
	
	//$output .= '<h2>PERIODE PAJAK : '.$param_arr['code'].'</h2>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NAMA PPAT</th>';
	$output.='<th align="center" >ALAMAT</th>';
	$output.='<th align="center" >NO. SK PENGUKUHAN PPAT/S</th>';
	$output.='<th align="center" >TANGGAL KETETAPAN</th>';
	$output.='<th align="center" >BULAN DENDA PROFESI</th>';
	$output.='<th align="center" >DENDA ATAS AJB</th>';
	$output.='<th align="center" >BULAN DENDA AJB</th>';
	$output.='<th align="center" >JUMLAH DENDA</th>';
	$output.='<th align="center" >NO. BAYAR</th>';
	$output.='<th align="center" >STATUS BAYAR</th>';
	$output.='<th align="center" >TANGGAL BAYAR</th>';
	$output.='<th align="center" >CETAK</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select a.t_vat_setllement_id as set_id,nvl(sanksi_ajb,'-') as sanksi_ajb_2,
		to_char(settlement_date,'dd-mm-yyyy') as tgl_tap,
		case when sanksi_ajb is null then '-' else x.code end as bulan_ajb,
		case when sanksi_ajb is null then x.code else '-' end as bulan_denda_profesi,
		y.payment_date,
		a.* from t_vat_setllement_ppat a
		left join p_finance_period x on x.p_finance_period_id=a.p_finance_period_id
		left join t_payment_receipt_ppat y on y.t_vat_setllement_id=a.t_vat_setllement_id
		where TRUE ";
	if ($param_arr['p_finance_period_id']!=''){
		$query.="and a.p_finance_period_id =".$param_arr['p_finance_period_id'];
	}
	if ($param_arr['status_bayar']==2){
		$query.="and receipt_no is not null ";
	}else{
		if ($param_arr['status_bayar']==3){
			$query.="and receipt_no is null ";
		}else{
			$query.="";
		}
	}
	$query.="ORDER BY ppat_name,start_period";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['ppat_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['address_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['no_sk'].'</td>';
		$output.='<td align="left" >'.$data[$i]['tgl_tap'].'</td>';
		$output.='<td align="left" >'.$data[$i]['bulan_denda_profesi'].'</td>';
		$output.='<td align="left" >'.$data[$i]['sanksi_ajb_2'].'</td>';
		$output.='<td align="left" >'.$data[$i]['bulan_ajb'].'</td>';
		$output.='<td align="right" >'.number_format($data[$i]['total_vat_amount'], 2, ',', '.').'</td>';
		$output.='<td align="left" >'.$data[$i]['payment_key'].'</td>';
		if ($data[$i]['payment_date']=='') {
			$output.='<td align="left" >Belum Bayar</td>';
		}else{
			$output.='<td align="left" >Sudah Bayar</td>';
		}
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		if($doAction != 'view_excel') {
			$output.='<td align="left" ><input id="cetak" class="btn_tambah" onclick="cetak_surat_tagihan('.$data[$i]['t_customer_order_id'].'); return false;" value="Cetak" type="button"</td>';
		}
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
?>

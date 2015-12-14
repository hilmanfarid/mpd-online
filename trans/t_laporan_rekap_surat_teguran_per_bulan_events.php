<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-C28E3F75
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_rekap_surat_teguran_per_bulan; //Compatibility
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

//Page_BeforeShow @1-F9AD0B10
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_rekap_surat_teguran_per_bulan; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['year_code'] = CCGetFromGet('year_code');
	if($doAction == 'view_html') {
		$Label1->SetText(GetCetakHTML($param_arr));
	}
	if($doAction == 'view_excel') {
		$Label1->SetText(GetCetakExcel($param_arr));
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
                  		<td class="th"><strong>LAPORAN REKAP SURAT TEGURAN PERBULAN</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th rowspan=2 align="center" >NO</th>';
	$output.='<th rowspan=2 align="center" >BULAN</th>';
	$output.='<th colspan=3 align="center" >JUMLAH TEGURAN KE</th></tr>';
	$output.='<tr><th align="center" >1</th>';
	$output.='<th align="center" >2</th>';
	$output.='<th align="center" >3</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select t_debt_letter_id,t_customer_order_id,letter_date, sequence_no, code, 
					(select count(*)
					from f_debt_letter_list(a.t_customer_order_id) x
					LEFT JOIN t_cust_account as y ON x.t_cust_account_id = y.t_cust_account_id
					where y.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)) as jml
			from t_debt_letter a
			LEFT JOIN p_finance_period b on a.p_finance_period_id=b.p_finance_period_id
			 where 
				a.p_finance_period_id in (select p_finance_period_id 
					from p_finance_period where p_year_period_id = ".$param_arr['p_year_period_id'].")
			ORDER BY letter_date";
	
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();
	$no = 1;
	for ($i = 0; $i < count($data); $i++) {
		
		if ($data[$i]['code'] == $data[$i-1]['code'] && $i != 0){
			$output.='<td align="left" >'.$data[$i]['jml'].'</td>';
		}else{
			$output.='<tr><td align="center" >'.($no).'</td>';
			$output.='<td align="left" >'.$data[$i]['code'].'</td>';
			$output.='<td align="left" >'.$data[$i]['jml'].'</td>';
			$no++;
		}
	}

	$output.='</table>';
	
	return $output;
}

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakExcel($param_arr) {
	
	startExcel("rekap_skpdkb_jabatan.xls");
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td colspan=5 class="th"><strong>LAPORAN REKAP SURAT TEGURAN PERBULAN</strong></td> 
                	</tr>
					<tr>
              		</table>';
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th rowspan=2 align="center" >NO</th>';
	$output.='<th rowspan=2 align="center" >BULAN</th>';
	$output.='<th colspan=3 align="center" >JUMLAH TEGURAN KE</th></tr>';
	$output.='<tr><th align="center" >1</th>';
	$output.='<th align="center" >2</th>';
	$output.='<th align="center" >3</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select t_debt_letter_id,t_customer_order_id,letter_date, sequence_no, code, 
					(select count(*)
					from f_debt_letter_list(a.t_customer_order_id) x
					LEFT JOIN t_cust_account as y ON x.t_cust_account_id = y.t_cust_account_id
					where y.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)) as jml
			from t_debt_letter a
			LEFT JOIN p_finance_period b on a.p_finance_period_id=b.p_finance_period_id
			 where 
				a.p_finance_period_id in (select p_finance_period_id 
					from p_finance_period where p_year_period_id = ".$param_arr['p_year_period_id'].")
			ORDER BY letter_date";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	$no = 1;
	for ($i = 0; $i < count($data); $i++) {
		
		if ($data[$i]['code'] == $data[$i-1]['code'] && $i != 0){
			$output.='<td align="left" >'.$data[$i]['jml'].'</td>';
		}else{
			$output.='<tr><td align="center" >'.($no).'</td>';
			$output.='<td align="left" >'.$data[$i]['code'].'</td>';
			$output.='<td align="left" >'.$data[$i]['jml'].'</td>';
			$no++;
		}
	}

	$output.='</table>';

	echo $output;
	exit;
}
?>

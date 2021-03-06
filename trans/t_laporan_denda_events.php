<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-E5AE1BF3
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_denda; //Compatibility
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

//Page_BeforeShow @1-A48F6AA9
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_denda; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['end_date'] = CCGetFromGet('date_end_laporan');
	$param_arr['start_date'] = CCGetFromGet('date_start_laporan');
	$param_arr['p_vat_type_dtl_id'] = CCGetFromGet('p_vat_type_dtl_id','');
	$param_arr['status_bayar'] = CCGetFromGet('ListBox1');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	if($doAction == 'view_html') {
		$Label1->SetText(GetCetakHTML($param_arr));
	}
	if($doAction == 'view_rekap_html') {
		$Label1->SetText(GetCetakRekapHTML($param_arr));
	}
	if($doAction == 'cetak_excel') {		
		CetakExcel($param_arr);
	}
	if($doAction == 'cetak_rekap_excel') {		
		CetakRekapExcel($param_arr);
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
                  		<td class="th"><strong>LAPORAN DENDA </strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	//$output .= '<h2>JENIS PAJAK : '.$param_arr['vat_code'].' </h2>';
	$output .= '<h2>PERIODE PENETAPAN : '.$param_arr['start_date'].' s.d. '.$param_arr['end_date'].'</h2>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >JENIS PAJAK</th>';
	$output.='<th align="center" >AYAT PAJAK</th>';
	$output.='<th align="center" >NAMA WP</th>';
	$output.='<th align="center" >MERK DAGANG</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >TGL TAP</th>';
	$output.='<th align="center" >TOTAL DENDA</th>';
	$output.='<th align="center" >STATUS BAYAR</th>';
	$output.='<th align="center" >TANGGAL BAYAR</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select a.t_vat_setllement_id as set_id,a.npwd as npwpd ,z.code as masa_pajak,
		to_char(due_date,'dd-mm-yyyy')as due_date_char, to_char(settlement_date,'dd-mm-yyyy') as tgl_tap,
		p.vat_code as ayat_pajak,q.vat_code as jenis_pajak, 
		* from t_vat_setllement a
		left join t_cust_account x on x.t_cust_account_id=a.t_cust_account_id
		left join t_payment_receipt y on y.t_vat_setllement_id=a.t_vat_setllement_id
		left join p_finance_period z on z.p_finance_period_id = a.p_finance_period_id
		left join p_vat_type_dtl p on p.p_vat_type_dtl_id = a.p_vat_type_dtl_id
		left join p_vat_type q on q.p_vat_type_id = p.p_vat_type_id 
		left join p_settlement_type r on r.p_settlement_type_id=a.p_settlement_type_id
		where a.p_settlement_type_id = 7
		and a.settlement_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
			and (to_date('".$param_arr['end_date']."','yyyy-mm-dd')+1)
		and a.p_vat_type_dtl_id not in (11, 15, 41, 12, 42, 43, 30, 17, 21, 27, 31)
		and x.p_account_status_id = 1
		and nvl(a.total_penalty_amount,0) > 0";
	if ($param_arr['p_vat_type_dtl_id']!=''){
		$query.="and a.p_vat_type_dtl_id =".$param_arr['p_vat_type_dtl_id'];
	}
	if ($param_arr['status_bayar']==2){
		$query.="and receipt_no is not null ORDER BY wp_name";
	}else{
		if ($param_arr['status_bayar']==3){
			$query.="and receipt_no is null ORDER BY wp_name";
		}else{
			$query.="ORDER BY q.p_vat_type_id, ayat_pajak, wp_name,a.npwd, start_period";
		}
	}
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
	for ($i = 0; $i < count($data); $i++) {
		//$temp = ($data[$i]['total_penalty_amount']+$data[$i]['db_increasing_charge']+$data[$i]['db_interest_charge']+$data[$i]['debt_vat_amt']);
		$temp = $data[$i]['total_penalty_amount'];
		$temp_sisa = $temp - $data[$i]['payment_amount'];
		$jumlah = $jumlah + $temp;
		$jumlah_realisasi = $jumlah_realisasi + $data[$i]['payment_amount'];
		$jumlah_sisa = $jumlah_sisa + $temp_sisa;
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['jenis_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['ayat_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['company_brand'].'</td>';
		$output.='<td align="left" >'.$data[$i]['npwpd'].'</td>';
		$output.='<td align="left" >'.$data[$i]['masa_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['tgl_tap'].'</td>';
		$output.='<td align="right" >'.number_format($temp, 2, ',', '.').'</td>';
		
		if ($data[$i]['payment_date']=='') {
			$output.='<td align="left" >Belum Bayar</td>';
		}else{
			$output.='<td align="left" >Sudah Bayar</td>';
		}
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		$output.='</tr>';
	}

	$output.='<tr><td align="center" colspan=8 >Jumlah</td>';
	$output.='<td align="right">'.number_format($jumlah, 2, ',', '.').'</td>';
	$output.='</tr>';

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

function CetakExcel($param_arr) {
	
	startExcel("laporan_denda.xls");
	
	$dbConn	= new clsDBConnSIKP();
	$query="select a.t_vat_setllement_id as set_id,a.npwd as npwpd ,z.code as masa_pajak,
		to_char(due_date,'dd-mm-yyyy')as due_date_char, to_char(settlement_date,'dd-mm-yyyy') as tgl_tap,
		p.vat_code as ayat_pajak,q.vat_code as jenis_pajak, 
		* from t_vat_setllement a
		left join t_cust_account x on x.t_cust_account_id=a.t_cust_account_id
		left join t_payment_receipt y on y.t_vat_setllement_id=a.t_vat_setllement_id
		left join p_finance_period z on z.p_finance_period_id = a.p_finance_period_id
		left join p_vat_type_dtl p on p.p_vat_type_dtl_id = a.p_vat_type_dtl_id
		left join p_vat_type q on q.p_vat_type_id = p.p_vat_type_id 
		left join p_settlement_type r on r.p_settlement_type_id=a.p_settlement_type_id
		where a.p_settlement_type_id = 7
		and a.settlement_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
			and (to_date('".$param_arr['end_date']."','yyyy-mm-dd')+1)
		and a.p_vat_type_dtl_id not in (11, 15, 41, 12, 42, 43, 30, 17, 21, 27, 31)
		and x.p_account_status_id = 1
		and nvl(a.total_penalty_amount,0) > 0";
	if ($param_arr['p_vat_type_dtl_id']!=''){
		$query.="and a.p_vat_type_dtl_id =".$param_arr['p_vat_type_dtl_id'];
	}
	if ($param_arr['status_bayar']==2){
		$query.="and receipt_no is not null ORDER BY wp_name";
	}else{
		if ($param_arr['status_bayar']==3){
			$query.="and receipt_no is null ORDER BY wp_name";
		}else{
			$query.="ORDER BY q.p_vat_type_id, ayat_pajak, wp_name,a.npwd, start_period";
		}
	}
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	$output = '';
	$output .= '<h2>LAPORAN DENDA<h2/>';
	$output .= '<h2>PERIODE PENETAPAN : '.$param_arr['start_date'].' s.d. '.$param_arr['end_date'].'</h2>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >JENIS PAJAK</th>';
	$output.='<th align="center" >AYAT PAJAK</th>';
	$output.='<th align="center" >NAMA</th>';
	$output.='<th align="center" >MERK DAGANG</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >TGL TAP</th>';
	$output.='<th align="center" >TOTAL DENDA</th>';
	$output.='<th align="center" >STATUS BAYAR</th>';
	$output.='<th align="center" >TANGGAL BAYAR</th>';
	$output.='</tr>';
	$jumlah = 0;
	$jumlah_relisasi =0;
	$jumlah_sisa =0;

    for ($i = 0; $i < count($data); $i++) {
		//$temp = ($data[$i]['total_penalty_amount']+$data[$i]['db_increasing_charge']+$data[$i]['db_interest_charge']+$data[$i]['debt_vat_amt']);
		$temp = $data[$i]['total_penalty_amount'];
		$temp_sisa = $temp - $data[$i]['payment_amount'];
		$jumlah = $jumlah + $temp;
		$jumlah_realisasi = $jumlah_realisasi + $data[$i]['payment_amount'];
		$jumlah_sisa = $jumlah_sisa + $temp_sisa;
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['jenis_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['ayat_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['company_brand'].'</td>';
		$output.='<td align="left" >'.$data[$i]['npwpd'].'</td>';
		$output.='<td align="left" >'.$data[$i]['masa_pajak'].'</td>';
		$output.='<td align="left" >'.$data[$i]['tgl_tap'].'</td>';
		$output.='<td align="right" >'.number_format($temp, 2, ',', '.').'</td>';
		
		if ($data[$i]['payment_date']=='') {
			$output.='<td align="left" >Belum Bayar</td>';
		}else{
			$output.='<td align="left" >Sudah Bayar</td>';
		}
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		$output.='</tr>';
	}
	$output.='<tr><td align="center" colspan=8 >Jumlah</td>';
	$output.='<td align="right">'.number_format($jumlah, 2, ',', '.').'</td>';
	$output.='</tr>';

	$output.='</table></br></br>';
	/*
	$output.='<table width="100%">';
	$output.='<tr>
				<td align="center" width="50%"></td>
			 </tr>
			 <tr>
				<td align="center" width="50%"></td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%">Mengetahui,</td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%">KEPALA BIDANG</td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%">KEPALA VERIFIKASI, OTORISASI DAN PEMBUKUAN</td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%">PAJAK PENDAFTARAN</td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%">BIDANG PAJAK PENDAFTARAN</td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%"></td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%"></td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%"></td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%">Drs, H. GUN GUN SUMARYANA</td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%">Drs. H. DEDEN SAEPULLOH, MM</td>
			 </tr>
			 <tr>
			 	<td></td>
				<td align="center" colspan=2 width="50%">NIP. 19700806 199101 1001</td>
				<td align="center" colspan=5 width="50%"></td>
				<td align="center" colspan=3 width="50%">NIP. 19681210 199010 1001</td>
			 </tr>';
	$output.='</table>';
	*/
	echo $output;
	exit;
}

function GetCetakRekapHTML($param_arr) {
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN REKAP DENDA</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	//$output .= '<h2>JENIS PAJAK : '.$param_arr['vat_code'].' </h2>';
	$output .= '<h2>PERIODE PENETAPAN : '.$param_arr['start_date'].' s.d. '.$param_arr['end_date'].'</h2>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >BULAN PENERBITAN</th>';
	$output.='<th align="center" >DENDA</th>';
	$output.='<th align="center" >KETERANGAN</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="SELECT code,to_char(start_date,'yyyy-mm-dd') as start_date,
			to_char(end_date,'yyyy-mm-dd') as end_date 
			FROM p_finance_period where  
			start_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
				and to_date('".$param_arr['end_date']."','yyyy-mm-dd')
			or
			end_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
				and to_date('".$param_arr['end_date']."','yyyy-mm-dd')
			ORDER BY start_date";
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
	for ($i = 0; $i < count($data); $i++) {

		$dbConn2	= new clsDBConnSIKP();
		$query2="select sum(NVL(a.total_penalty_amount,0)) as denda
			from t_vat_setllement a 
			left join t_payment_receipt y on y.t_vat_setllement_id=a.t_vat_setllement_id
			left join t_cust_account x on x.t_cust_account_id=a.t_cust_account_id
			left join p_settlement_type r on r.p_settlement_type_id=a.p_settlement_type_id
			where a.p_settlement_type_id = 7
			and a.settlement_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
				and (to_date('".$param_arr['end_date']."','yyyy-mm-dd')+1)
			and a.settlement_date between to_date('".$data[$i]['start_date']."','yyyy-mm-dd') 
				and (to_date('".$data[$i]['end_date']."','yyyy-mm-dd')+1)
			and a.p_vat_type_dtl_id not in (11, 15, 41, 12, 42, 43, 30, 17, 21, 27, 31)
			and x.p_account_status_id = 1";
		if ($param_arr['p_vat_type_dtl_id']!=''){
			$query2.="and a.p_vat_type_dtl_id =".$param_arr['p_vat_type_dtl_id'];
		}
		if ($param_arr['status_bayar']==2){
			$query2.="and receipt_no is not null";
		}
		if ($param_arr['status_bayar']==3){
			$query2.="and receipt_no is null";
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
		$output.='<td align="left" >'.$data[$i]['code'].'</td>';
		$output.='<td align="right" >'.number_format($data2['denda'], 2, ',', '.').'</td>';
		$output.='<td align="left" ></td>';
		$output.='</tr>';
		$jumlah +=$data2['denda'];
	}

	$output.='<tr><td align="center" colspan=2 >Jumlah</td>';
	$output.='<td align="right">'.number_format($jumlah, 2, ',', '.').'</td>';
	$output.='<td align="center"></td>';
	$output.='</tr>';

	$output.='</table>';
	
	return $output;
}

function CetakRekapExcel($param_arr) {
	
	startExcel("laporan_rekap_denda.xls");

	$output = '';
	$output .= '<table><tr><td colspan=6 align="center"><strong>LAPORAN REKAP DENDA<strong/></td></tr>';
	$output .= '<tr><td colspan=6 align="center"><strong>TAHUN '.substr($param_arr['start_date'],0,4).'</strong></td></tr>';
	$output .= '<tr><td colspan=6 align="center"><strong>PERIODE PENETAPAN'.$param_arr['start_date'].' SD '.$param_arr['end_date'].'</strong></td></tr>';
	$output .= '<tr><td colspan=6 align="center"></td></tr>';
	$output .= '<tr><td colspan=6 align="center"></td></tr></table>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >BULAN PENERBITAN</th>';
	$output.='<th align="center" >DENDA</th>';
	$output.='<th align="center" >KETERANGAN</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="SELECT code,to_char(start_date,'yyyy-mm-dd') as start_date,
			to_char(end_date,'yyyy-mm-dd') as end_date 
			FROM p_finance_period where  
			start_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
				and to_date('".$param_arr['end_date']."','yyyy-mm-dd')
			or
			end_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
				and to_date('".$param_arr['end_date']."','yyyy-mm-dd')
			ORDER BY start_date";
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
	for ($i = 0; $i < count($data); $i++) {

		$dbConn2	= new clsDBConnSIKP();
		$query2="select sum(NVL(a.total_penalty_amount,0)) as denda
			from t_vat_setllement a 
			left join t_payment_receipt y on y.t_vat_setllement_id=a.t_vat_setllement_id
			left join t_cust_account x on x.t_cust_account_id=a.t_cust_account_id
			left join p_settlement_type r on r.p_settlement_type_id=a.p_settlement_type_id
			where a.p_settlement_type_id = 7
			and a.settlement_date between to_date('".$param_arr['start_date']."','yyyy-mm-dd') 
				and (to_date('".$param_arr['end_date']."','yyyy-mm-dd')+1)
			and a.settlement_date between to_date('".$data[$i]['start_date']."','yyyy-mm-dd') 
				and (to_date('".$data[$i]['end_date']."','yyyy-mm-dd')+1)
			and a.p_vat_type_dtl_id not in (11, 15, 41, 12, 42, 43, 30, 17, 21, 27, 31)
			and x.p_account_status_id = 1";
		if ($param_arr['p_vat_type_dtl_id']!=''){
			$query2.="and a.p_vat_type_dtl_id =".$param_arr['p_vat_type_dtl_id'];
		}
		if ($param_arr['status_bayar']==2){
			$query2.="and receipt_no is not null";
		}
		if ($param_arr['status_bayar']==3){
			$query2.="and receipt_no is null";
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
		$output.='<td align="left" >'.$data[$i]['code'].'</td>';
		$output.='<td align="right" >'.number_format($data2['denda'], 2, ',', '.').'</td>';
		$output.='<td align="left" ></td>';
		$output.='</tr>';
		$jumlah +=$data2['denda'];
	}

	$output.='<tr><td align="center" colspan=2 >Jumlah</td>';
	$output.='<td align="right">'.number_format($jumlah, 2, ',', '.').'</td>';
	$output.='<td align="center"></td>';
	$output.='</tr>';

	$output.='</table>';
	/*
	$output.='<table width="100%">';
	$output.='<tr>
				<td align="center" width="50%"></td>
			 </tr>
			 <tr>
				<td align="center" width="50%"></td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%">KEPALA VERIFIKASI, OTORISASI DAN PEMBUKUAN</td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%">BIDANG PAJAK PENDAFTARAN</td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%"></td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%">Drs. H. DEDEN SAEPULLOH, MM</td>
			 </tr>
			 <tr>
			 	<td colspan=3></td>
				<td align="center" colspan=3 width="50%">NIP. 19681210 199010 1001</td>
			 </tr>
			 ';
	$output.='</table>';
	*/
	echo $output;
	exit;
}
?>

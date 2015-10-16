<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-3E135CC0
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_kartu_kendali_nota_ver_bphtb; //Compatibility
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

//Page_BeforeShow @1-65CBFE38
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_kartu_kendali_nota_ver_bphtb; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	$param_arr['year_code'] = CCGetFromGet('year_code');
	$param_arr['code'] = CCGetFromGet('code');
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
                  		<td class="th" align="center"><h1><strong>KARTU LAPORAN</strong></td> 
						<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
					<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
						<td class="th" align="center"><h1><strong>REKAPITULASI TARGET/SASARAN MUTU</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
					<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th" align="center"><h1><strong>NOTA VERIFIKASI BPHTB</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .='<table>';
	$output .= '<tr><td>PERIODE </td><td>: '.$param_arr['code'].'</td></tr>';
	$output .= '<tr><td>JENIS TARGET </td><td>: PENERBITAN NOTA VERIFIKASI BPHTB 3 HARI KERJA</td></tr>';
	$output .= '</table></br>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >TANGGAL PROSES</th>';
	$output.='<th align="center" >JUMLAH PROSES</th>';
	$output.='<th align="center" >JUMLAH TERCAPAI</th>';
	$output.='<th align="center" >JUMLAH TIDAK TERCAPAI</th>';
	$output.='<th align="center" >ALASAN TIDAK TERCAPAI</th>';
	$output.='<th align="center" >KETERANGAN</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	
	$query="SELECT --*
			to_char(a.creation_date,'dd-mm-yyyy') as tanggal, count (to_char(a.creation_date,'dd-mm-yyyy')) as proses,
			count (case 
				when b.donor_date < f_get_work_day_relatif(trunc(a.creation_date), 4, 0) 
				then true 
				--OTHERS 
				--then FALSE
			end) as tercapai
			FROM t_bphtb_registration a
			left join t_product_order_control b on a.t_customer_order_id=b.doc_id and b.p_w_proc_id = 22
			left join p_finance_period c on c.p_finance_period_id=".$param_arr['p_finance_period_id']."
			where trunc(a.creation_date) BETWEEN c.start_date and c.end_date 
			GROUP BY tanggal--to_char(a.registration_date,'dd-mm-yyyy')
			ORDER BY tanggal
			--a.registration_date";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();
	$jumlah_proses=0;
	$jumlah_tercapai=0;
	$jumlah_tidak_tecapai=0;

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['tanggal'].'</td>';
		$output.='<td align="left" >'.$data[$i]['proses'].'</td>';
		$output.='<td align="left" >'.$data[$i]['tercapai'].'</td>';
		$output.='<td align="left" >'.($data[$i]['proses']-$data[$i]['tercapai']).'</td>';
		$output.='<td align="left" ></td>';
		$output.='<td align="left" ></td>';
		$jumlah_proses+=$data[$i]['proses'];
		$jumlah_tercapai+=$data[$i]['tercapai'];
		$jumlah_tidak_tecapai+=($data[$i]['proses']-$data[$i]['tercapai']);
	}
	$output.='<tr><td align="center" ></td>';
	$output.='<td align="left" >Jumlah</td>';
	$output.='<td align="left" >'.$jumlah_proses.'</td>';
	$output.='<td align="left" >'.$jumlah_tercapai.'</td>';
	$output.='<td align="left" >'.$jumlah_tidak_tecapai.'</td>';
	$output.='<td align="left" ></td>';
	$output.='<td align="left" ></td>';

	$output.='</table>';
	
	$output .='</br></br></br><table width=100% border=0>';
	$output .= '<tr >
					<td width=50%>
						 
					</td>
					<td width=50% align="center">
						Bandung, '.date("d-m-Y").'
					</td>
				</tr>';
	$output .= '<tr> 
					<td align="center">
						Mengetahui, </br> 
						Wakil Manajemen</br>
						</br></br></br>
						Drs. ASEP SAEPUL GUFRON, M.Si</br>
						NIP. 19690519 199603 1 003
					</td>
					<td align="center">
						Yang Membuat, </br> 
						Kepala Seksi Pendaftaran dan Pendataan</br>
						</br></br></br>
						OKKY DATUSUATI, S.STP</br>
						NIP. 19780927 199101 1 001
					</td>
				</tr>';
	$output .= '</table>';

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
	
	startExcel("kartu_kendali_nota_verifikasi_bphtb.xls");
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';
	$output .='<table>';
	$output .= '<tr><td class="th" align="center" colspan=7><h1><strong>KARTU LAPORAN</strong></td> </tr>';
	$output .= '<tr><td class="th" align="center" colspan=7><h1><strong>REKAPITULASI TARGET/SASARAN MUTU</strong></td> </tr>';
	$output .= '<tr><td class="th" align="center" colspan=7><h1><strong>NOTA VERIFIKASI BPHTB</strong></td></tr>';
	$output .= '</table></br>';
	
	$output .='<table>';
	$output .= '<tr></tr>';
	$output .= '<tr></tr>';
	$output .= '<tr><td colspan=2>PERIODE </td><td>: '.$param_arr['code'].'</td></tr>';
	$output .= '<tr><td colspan=2>JENIS TARGET </td><td>: PENERBITAN NOTA VERIFIKASI BPHTB 3 HARI KERJA</td></tr>';
	$output .= '<tr></tr>';
	$output .= '</table></br>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >TANGGAL PROSES</th>';
	$output.='<th align="center" >JUMLAH PROSES</th>';
	$output.='<th align="center" >JUMLAH TERCAPAI</th>';
	$output.='<th align="center" >JUMLAH TIDAK TERCAPAI</th>';
	$output.='<th align="center" >ALASAN TIDAK TERCAPAI</th>';
	$output.='<th align="center" >KETERANGAN</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	
	$query="SELECT --*
			to_char(a.creation_date,'dd-mm-yyyy') as tanggal, count (to_char(a.creation_date,'dd-mm-yyyy')) as proses,
			count (case 
				when b.donor_date < f_get_work_day_relatif(trunc(a.creation_date), 4, 0) 
				then true 
				--OTHERS 
				--then FALSE
			end) as tercapai
			FROM t_bphtb_registration a
			left join t_product_order_control b on a.t_customer_order_id=b.doc_id and b.p_w_proc_id = 22
			left join p_finance_period c on c.p_finance_period_id=".$param_arr['p_finance_period_id']."
			where trunc(a.creation_date) BETWEEN c.start_date and c.end_date 
			GROUP BY tanggal--to_char(a.registration_date,'dd-mm-yyyy')
			ORDER BY tanggal
			--a.registration_date";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();
	$jumlah_proses=0;
	$jumlah_tercapai=0;
	$jumlah_tidak_tecapai=0;


	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['tanggal'].'</td>';
		$output.='<td align="left" >'.$data[$i]['proses'].'</td>';
		$output.='<td align="left" >'.$data[$i]['tercapai'].'</td>';
		$output.='<td align="left" >'.($data[$i]['proses']-$data[$i]['tercapai']).'</td>';
		$output.='<td align="left" ></td>';
		$output.='<td align="left" ></td>';
		$jumlah_proses+=$data[$i]['proses'];
		$jumlah_tercapai+=$data[$i]['tercapai'];
		$jumlah_tidak_tecapai+=($data[$i]['proses']-$data[$i]['tercapai']);
	}
	$output.='<tr><td align="center" ></td>';
	$output.='<td align="left" >Jumlah</td>';
	$output.='<td align="left" >'.$jumlah_proses.'</td>';
	$output.='<td align="left" >'.$jumlah_tercapai.'</td>';
	$output.='<td align="left" >'.$jumlah_tidak_tecapai.'</td>';
	$output.='<td align="left" ></td>';
	$output.='<td align="left" ></td>';	

	$output.='</table>';
	
	$output .='<table width=100% border=0>';
	$output .= '<tr></tr>';
	$output .= '<tr></tr>';
	$output .= '<tr >
					<td width=50% colspan=4>
						  
					</td>
					<td width=50% align="center" colspan=3>
						Bandung, '.date("d-m-Y").'
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=4>
						Mengetahui, 
					</td>
					<td width=50% align="center" colspan=3>
						Yang Membuat, 
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=4>
						Wakil Manajemen 
					</td>
					<td width=50% align="center" colspan=3>
						Kepala Seksi Pendaftaran dan Pendataan 
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=4>
						 
					</td>
					<td width=50% align="center" colspan=3>
						 
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=4>
						
					</td>
					<td width=50% align="center" colspan=3>
						
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=4>
						Drs. ASEP SAEPUL GUFRON, M.Si
					</td>
					<td width=50% align="center" colspan=3>
						OKKY DATUSUATI, S.STP
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=4>
						NIP. 19690519 199603 1 003
					</td>
					<td width=50% align="center" colspan=3>
						NIP. 19780927 199101 1 001
					</td>
				</tr>';
	$output .= '</table>';

	echo $output;
	exit;
}
?>

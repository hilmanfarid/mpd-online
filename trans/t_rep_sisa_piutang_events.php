<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-D3A028B1
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_sisa_piutang; //Compatibility
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

//Page_BeforeShow @1-C8C6DB7F
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_sisa_piutang; //Compatibility
//End Page_BeforeShow
	global $Label1;
	global $t_rep_sisa_piutangSearch;
//Custom Code @566-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$doAction = CCGetFromGet('doAction');
	if($doAction == 'view_html') {
				
		$data = array();
		
		$param_arr = array();
				
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');

		$param_arr['tahun_periode'] = CCGetFromGet('tahun_periode');
		$param_arr['pajak_periode'] = CCGetFromGet('pajak_periode');
		$param_arr['jenis_pajak'] = CCGetFromGet('jenis_pajak');
		$param_arr['status'] = CCGetFromGet('status');

		$t_rep_sisa_piutangSearch->p_year_period_id->SetValue($param_arr['p_year_period_id']);
		$t_rep_sisa_piutangSearch->p_finance_period_id->SetValue($param_arr['p_finance_period_id']);
		$t_rep_sisa_piutangSearch->p_vat_type_id->SetValue($param_arr['p_vat_type_id']);
			
		$t_rep_sisa_piutangSearch->year_code->SetValue($param_arr['tahun_periode']);
		$t_rep_sisa_piutangSearch->code->SetValue($param_arr['pajak_periode']);
		$t_rep_sisa_piutangSearch->vat_code->SetValue($param_arr['jenis_pajak']);
		
		$t_rep_sisa_piutangSearch->ListBox1->SetValue($param_arr['status']);

		if(!empty($param_arr['p_finance_period_id']) and !empty($param_arr['p_vat_type_id'])) {
			
			$dbConn	= new clsDBConnSIKP();
			
			if(empty($param_arr['status'])) { /* GLOBAL */
				$query="SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.* 
				FROM f_rep_status_piutang (".$param_arr['p_vat_type_id'].", ".$param_arr['p_finance_period_id'].", 1) a
				left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
				ORDER BY company_brand, npwd";
			}
			else if($param_arr['status'] == '1') { /* BELUM BAYAR */
				$query="SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.*
						FROM f_rep_status_piutang2 (".$param_arr['p_vat_type_id'].", ".$param_arr['p_finance_period_id'].", 1) a
						left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
						WHERE ((f_teg1_amount is null) OR (f_teg1_amount < 1)) AND
							  ((f_teg2_amount is null) OR (f_teg2_amount < 1)) AND
							  ((f_teg3_amount is null) OR (f_teg3_amount < 1))
							  AND NOT textregexeq(f_action_sts,'^[[:digit:]]+(\.[[:digit:]]+)?$')
						ORDER BY company_brand, npwd";
			
			}else if($param_arr['status'] == '2') { /* SUDAH BAYAR */
				$query="SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.*, (f_amount IS NULL AND f_teg1_amount IS NULL AND f_teg2_amount IS NULL AND f_teg3_amount IS NULL AND f_action_sts > 0) AS bayar_setelah
						FROM f_rep_status_piutang (".$param_arr['p_vat_type_id'].", ".$param_arr['p_finance_period_id'].", 1) a
						left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
						WHERE (f_teg1_amount > 0) OR 
							  (f_teg2_amount > 0) OR 
							  (f_teg3_amount > 0) 
							  OR textregexeq(f_action_sts,'^[[:digit:]]+(\.[[:digit:]]+)?$')
						ORDER BY company_brand, npwd";
			}
			//echo $query;exit;
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data[] = $dbConn->Record;
			}
			$dbConn->close();
			
			// ----- AMBIL JATUH TEMPO ------
			$dbConn2	= new clsDBConnSIKP();
			$tgl_jatuh_tempo = '';
			$qJatuhTempo = "SELECT to_char((trunc(start_date) + due_in_day-1),'yyyy-mm-dd') AS jatuh_tempo
							FROM p_finance_period WHERE to_char(trunc(start_date),'yyyy-mm-dd') IN 
							( 	SELECT to_char((trunc(end_date) + 1), 'yyyy-mm-dd') 
								FROM p_finance_period 
								WHERE p_finance_period_id = ".$param_arr['p_finance_period_id'].")";
			$dbConn2->query($qJatuhTempo);
			while ($dbConn2->next_record()) {
				$tgl_jatuh_tempo = $dbConn2->f('jatuh_tempo');
			}
			
			$dbConn2->close();

			$Label1->SetText(GetCetakHTML($data, $param_arr['pajak_periode'], $param_arr['jenis_pajak'], $tgl_jatuh_tempo, $param_arr['status']));

		}else {
			/* Tampilkan Alert */
			echo '<script> alert("Semua Filter Harus Diisi"); </script>';
		}
	}
	elseif($doAction == 'download_excel') {
		
		$data = array();
		
		$param_arr = array();
				
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');

		$param_arr['tahun_periode'] = CCGetFromGet('tahun_periode');
		$param_arr['pajak_periode'] = CCGetFromGet('pajak_periode');
		$param_arr['jenis_pajak'] = CCGetFromGet('jenis_pajak');
		$param_arr['status'] = CCGetFromGet('status');

		$t_rep_sisa_piutangSearch->p_year_period_id->SetValue($param_arr['p_year_period_id']);
		$t_rep_sisa_piutangSearch->p_finance_period_id->SetValue($param_arr['p_finance_period_id']);
		$t_rep_sisa_piutangSearch->p_vat_type_id->SetValue($param_arr['p_vat_type_id']);
			
		$t_rep_sisa_piutangSearch->year_code->SetValue($param_arr['tahun_periode']);
		$t_rep_sisa_piutangSearch->code->SetValue($param_arr['pajak_periode']);
		$t_rep_sisa_piutangSearch->vat_code->SetValue($param_arr['jenis_pajak']);
		
		$t_rep_sisa_piutangSearch->ListBox1->SetValue($param_arr['status']);

		if(!empty($param_arr['p_finance_period_id']) and !empty($param_arr['p_vat_type_id'])) {
			
			$dbConn	= new clsDBConnSIKP();
			
			if(empty($param_arr['status'])) { /* GLOBAL */
				$query="SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.* 
				FROM f_rep_status_piutang (".$param_arr['p_vat_type_id'].", ".$param_arr['p_finance_period_id'].", 1) a
				left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
				ORDER BY company_brand, npwd";
			}
			else if($param_arr['status'] == '1') { /* BELUM BAYAR */
				$query="SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.*
						FROM f_rep_status_piutang2 (".$param_arr['p_vat_type_id'].", ".$param_arr['p_finance_period_id'].", 1) a
						left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
						WHERE ((f_teg1_amount is null) OR (f_teg1_amount < 1)) AND
							  ((f_teg2_amount is null) OR (f_teg2_amount < 1)) AND
							  ((f_teg3_amount is null) OR (f_teg3_amount < 1))
							  AND NOT textregexeq(f_action_sts,'^[[:digit:]]+(\.[[:digit:]]+)?$')
						ORDER BY company_brand, npwd";
			
			}else if($param_arr['status'] == '2') { /* SUDAH BAYAR */
				$query="SELECT b.company_brand,regexp_replace(b.brand_address_name, '\r|\n', '', 'g')||' '||b.brand_address_no as alamat_merk_dagang,a.*, (f_amount IS NULL AND f_teg1_amount IS NULL AND f_teg2_amount IS NULL AND f_teg3_amount IS NULL AND f_action_sts > 0) AS bayar_setelah
						FROM f_rep_status_piutang (".$param_arr['p_vat_type_id'].", ".$param_arr['p_finance_period_id'].", 1) a
						left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
						WHERE (f_teg1_amount > 0) OR 
							  (f_teg2_amount > 0) OR 
							  (f_teg3_amount > 0) 
							  OR textregexeq(f_action_sts,'^[[:digit:]]+(\.[[:digit:]]+)?$')
						ORDER BY company_brand, npwd";
			}
			
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$data[] = $dbConn->Record;
			}
			$dbConn->close();
			
			// ----- AMBIL JATUH TEMPO ------
			$dbConn2	= new clsDBConnSIKP();
			$tgl_jatuh_tempo = '';
			$qJatuhTempo = "SELECT to_char((trunc(start_date) + due_in_day-1),'yyyy-mm-dd') AS jatuh_tempo
							FROM p_finance_period WHERE to_char(trunc(start_date),'yyyy-mm-dd') IN 
							( 	SELECT to_char((trunc(end_date) + 1), 'yyyy-mm-dd') 
								FROM p_finance_period 
								WHERE p_finance_period_id = ".$param_arr['p_finance_period_id'].")";
			$dbConn2->query($qJatuhTempo);
			while ($dbConn2->next_record()) {
				$tgl_jatuh_tempo = $dbConn2->f('jatuh_tempo');
			}

			$dbConn2->close();

			CetakExcel($data, $param_arr['pajak_periode'], $param_arr['jenis_pajak'], $tgl_jatuh_tempo, $param_arr['status']);

		 }else {
			/* Tampilkan Alert */
			echo '<script> alert("Semua Filter Harus Diisi"); </script>';
		}
	}
	
//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($data, $pajak_periode, $jenis_pajak, $tgl_jatuh_tempo, $status) {
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN STATUS SURAT TEGURAN</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	$output .= '<h2>JENIS PAJAK : '.$jenis_pajak.' </h2>';
	$output .= '<h2>PERIODE PAJAK : '.$pajak_periode.'</h2>';
	$output .= '<h2>JATUH TEMPO : '.strtoupper(dateToString($tgl_jatuh_tempo)).'</h2> <br/>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr >';


		$output.='<th align="center" rowspan="2">NO</th>';
		$output.='<th align="center" rowspan="2" width="200">MERK DAGANG</th>';
		$output.='<th align="center" rowspan="2" width="200">ALAMAT MERK DAGANG</th>';
		$output.='<th align="center" rowspan="2" width="90">NPWPD</th>';
		$output.='<th align="center" rowspan="2">SPTPD</th>';
		$output.='<th align="center" rowspan="2">STPD</th>';
		$output.='<th align="center" colspan="2">TEGURAN I <br/> '.$data[0]['f_teg1_sts'].'</th>';
		$output.='<th align="center" colspan="2">TEGURAN II <br/> '.$data[0]['f_teg2_sts'].'</th>';
		$output.='<th align="center" colspan="2">TEGURAN III <br/> '.$data[0]['f_teg3_sts'].'</th>';
		$output.='<th align="center" rowspan="2">AKSI <br/>'.$data[0]['f_action_date'].'</th>';
		if($status == '2') /* SUDAH BAYAR */ {
			$output.='<th align="center" rowspan="2" width="150">PEMBAYARAN <br/> SETELAH <br/>'.$data[0]['f_action_date'].'</th>';
		}
		$output.='</tr>';
    	
		$output.='<tr >';
		$output.='<th align="center">SPTPD</th>';
		$output.='<th align="center">STPD</th>';
		$output.='<th align="center">SPTPD</th>';
		$output.='<th align="center">STPD</th>';
		$output.='<th align="center">SPTPD</th>';
		$output.='<th align="center">STPD</th>';
		$output.='</tr>';
    	
		for ($i = 0; $i < count($data); $i++) {

			$output .= '<tr>';
			$output .= '<td align="center">'.($i+1).'</td>';
			$output .= '<td align="left">'.$data[$i]['company_brand'].'</td>';
			$output .= '<td align="left">'.$data[$i]['alamat_merk_dagang'].'</td>';
			$output .= '<td align="center">'.$data[$i]['npwpd'].'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_penalty'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg1_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg1_penalty'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg2_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg2_penalty'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg3_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg3_penalty'],0,",",".").'</td>';
			
			if($status == '') {
				$kolom_aksi = is_numeric($data[$i]['f_action_sts']) ? number_format($data[$i]['f_action_sts'],0,",",".") : $data[$i]['f_action_sts'];
				$output .= '<td align="right">'.$kolom_aksi.'</td>';
			}else if($status == '1') /* BELUM BAYAR */ {
				$output .= '<td align="right">'.$data[$i]['f_action_sts'].'</td>';
			}else if($status == '2') /* SUDAH BAYAR */ {
				if($data[$i]['bayar_setelah'] == 't') {
					$output .= '<td align="right"> </td>';
					$output .= '<td align="right">'. number_format($data[$i]['f_action_sts'],0,",",".").'</td>';
				}else {
					$output .= '<td align="right"></td>';
					$output .= '<td align="right"></td>';
				}				
			}
 
			$output .= '</tr>';
		}
	
	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
}

function CetakExcel($data, $pajak_periode, $jenis_pajak, $tgl_jatuh_tempo, $status) {
	
	startExcel("laporan_status_teguran");
	
	$output = '';

	$output .= '<h2>LAPORAN SURAT TEGURAN<h2/>';

	$output .= '<h3>JENIS PAJAK : '.$jenis_pajak.'<br/>';
	$output .= 'PERIODE PAJAK : '.$pajak_periode.'<br/>';
	$output .= 'JATUH TEMPO : '.strtoupper(dateToString($tgl_jatuh_tempo)).'</h3>';

	$output .='<table border="1" widht="100%">
                <tr>';


		$output.='<th align="center" rowspan="2">NO</th>';
		$output.='<th align="center" rowspan="2">WAJIB PAJAK</th>';
		$output.='<th align="center" rowspan="2">ALAMAT</th>';
		$output.='<th align="center" rowspan="2">NPWPD</th>';
		$output.='<th align="center" rowspan="2">SPTPD</th>';
		$output.='<th align="center" rowspan="2">STPD</th>';
		$output.='<th align="center" colspan="2">TEGURAN I <br/> '.$data[0]['f_teg1_sts'].'</th>';
		$output.='<th align="center" colspan="2">TEGURAN II <br/> '.$data[0]['f_teg2_sts'].'</th>';
		$output.='<th align="center" colspan="2">TEGURAN III <br/> '.$data[0]['f_teg3_sts'].'</th>';
		$output.='<th align="center" rowspan="2">AKSI <br/>'.$data[0]['f_action_date'].'</th>';
		if($status == '2') /* SUDAH BAYAR */ {
			$output.='<th align="center" rowspan="2">PEMBAYARAN <br/> SETELAH <br/>'.$data[0]['f_action_date'].'</th>';
		}
		$output.='</tr>';
    	
		$output.='<tr >';
		$output.='<th align="center">SPTPD</th>';
		$output.='<th align="center">STPD</th>';
		$output.='<th align="center">SPTPD</th>';
		$output.='<th align="center">STPD</th>';
		$output.='<th align="center">SPTPD</th>';
		$output.='<th align="center">STPD</th>';
		$output.='</tr>';
    	
		for ($i = 0; $i < count($data); $i++) {

			$output .= '<tr>';
			$output .= '<td align="center">'.($i+1).'</td>';
			$output .= '<td align="left">'.$data[$i]['company_brand'].'</td>';
			$output .= '<td align="left">'.$data[$i]['alamat_merk_dagang'].'</td>';
			$output .= '<td align="left">'.$data[$i]['alamat'].'</td>';
			$output .= '<td align="center">'.$data[$i]['npwpd'].'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_penalty'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg1_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg1_penalty'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg2_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg2_penalty'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg3_amount'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($data[$i]['f_teg3_penalty'],0,",",".").'</td>';
			
			if($status == '') {
				$kolom_aksi = is_numeric($data[$i]['f_action_sts']) ? number_format($data[$i]['f_action_sts'],0,",",".") : $data[$i]['f_action_sts'];
				$output .= '<td align="right">'.$kolom_aksi.'</td>';
			}else if($status == '1') /* BELUM BAYAR */ {
				$output .= '<td align="right">'.$data[$i]['f_action_sts'].'</td>';
			}else if($status == '2') /* SUDAH BAYAR */ {
				if($data[$i]['bayar_setelah'] == 't') {
					$output .= '<td align="right"> </td>';
					$output .= '<td align="right">'. number_format($data[$i]['f_action_sts'],0,",",".").'</td>';
				}else {
					$output .= '<td align="right"></td>';
					$output .= '<td align="right"></td>';
				}				
			}
 
			$output .= '</tr>';
		}
	
	$output.='</table>';
	echo $output;
	exit;
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


function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

?>

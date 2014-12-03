<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-DD8E9707
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_bulanan_target_vs_realisasi; //Compatibility
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

//Page_BeforeShow @1-726031B9
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_bulanan_target_vs_realisasi; //Compatibility
//End Page_BeforeShow
	global $Label1;
	global $t_rep_bulanan_target_vs_realisasiSearch;
//Custom Code @566-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$doAction = CCGetFromGet('doAction');
	
	$data = array();
	$param_arr = array();
				
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
	$param_arr['p_finance_period_id1'] = CCGetFromGet('p_finance_period_id1');
		
	$param_arr['tahun_periode'] = CCGetFromGet('tahun_periode');
	$param_arr['pajak_periode'] = CCGetFromGet('pajak_periode');
	$param_arr['pajak_periode1'] = CCGetFromGet('pajak_periode1');

		
	$t_rep_bulanan_target_vs_realisasiSearch->p_year_period_id->SetValue($param_arr['p_year_period_id']);
	$t_rep_bulanan_target_vs_realisasiSearch->p_finance_period_id->SetValue($param_arr['p_finance_period_id']);
	$t_rep_bulanan_target_vs_realisasiSearch->p_finance_period_id1->SetValue($param_arr['p_finance_period_id1']);
	
	$t_rep_bulanan_target_vs_realisasiSearch->year_code->SetValue($param_arr['tahun_periode']);
	$t_rep_bulanan_target_vs_realisasiSearch->code->SetValue($param_arr['pajak_periode']);
	$t_rep_bulanan_target_vs_realisasiSearch->code1->SetValue($param_arr['pajak_periode1']);

		
	if($doAction == 'view_html') {
		
		if(!empty($param_arr['p_finance_period_id'])) {
			$Label1->SetText(GetCetakGeneralHTML($param_arr));
		}else {
			/* Tampilkan Alert */
			echo '<script> alert("Semua Filter Harus Diisi"); </script>';
		}
	} else {
		
		//do nothing 
	}
	
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


function GetCetakGeneralHTML($param_arr) {
	
	
	$output = '';
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="70%" style="margin-left:10px;padding:5px 5px 5px 5px;">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN TARGET DAN REALISASI</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              	</table>';
	//$output .= '<div align="right"><a href="#" onClick="downloadGeneral();"> Download Excel </a></div>';
	$output .= '<h3>BIDANG PAJAK PENDAFTARAN & PAJAK PENETAPAN</h3>';
	$output .= '<h3>PERIODE : '.$param_arr["pajak_periode"].' s.d '.$param_arr["pajak_periode1"].'</h3> <br/>';
	
	$output .='<table class="report" cellspacing="0" cellpadding="4px" width="100%">
                <tr style="background:#498CD6;color:#FFFFFF;">';
	$output .= '<th width="150">JENIS PAJAK</th>';
	$output .= '<th width="150">TARGET</th>';
	$output .= '<th width="150">REALISASI</th>';
	//$output .= '<th width="150">PIUTANG</th>';
	$output .= '<th width="150">KETERANGAN SELISIH</th>';
	$output .= '</tr>';
	
	
	$date_awal = getDateAwal($param_arr['p_finance_period_id']);
	$date_akhir = getDateAkhir($param_arr['p_finance_period_id1']);
	
	$dbConn = new clsDBConnSIKP();
	$query = "SELECT a.p_vat_type_id, upper(a.vat_code) AS jenis_pajak, upper(substring(a.vat_code from 7)) as pajak_text, b.vat_code, b.p_vat_type_dtl_id
				FROM p_vat_type AS a 
				LEFT JOIN p_vat_type_dtl as b ON a.p_vat_type_id = b.p_vat_type_id
				WHERE a.p_vat_type_id NOT IN (7,9) AND b.p_vat_type_dtl_id NOT IN (12, 23, 30, 31, 42, 43)
				ORDER BY a.p_vat_type_id ASC, b.vat_code ASC";

	$dbConn->query($query);
	$data = array();
	while ($dbConn->next_record()) {
		$data["p_vat_type_id"][] = $dbConn->f("p_vat_type_id");
		$data["jenis_pajak"][] = $dbConn->f("jenis_pajak");
		$data["pajak_text"][] = $dbConn->f("pajak_text");
		$data["vat_code"][] = $dbConn->f("vat_code");
		$data["p_vat_type_dtl_id"][] = $dbConn->f("p_vat_type_dtl_id");
		$data["date_awal"][] = $date_awal;
		$data["date_akhir"][] = $date_akhir;
	}
	$dbConn->close();
	
	$pajak_text = '';
	$pajak_text = $data['pajak_text'][0];
	$item = array();
	
	$total_target_ = 0;
	$total_realisasi_ = 0;
	$total_piutang_ = 0;
	$total_selisih_ = 0;


	$grand_total_target_ = 0;
	$grand_total_realisasi_ = 0;
	$grand_total_selisih_ = 0;
	$grand_total_piutang_ = 0;

	for($i = 0; $i < count($data['vat_code']); $i++) {

		$item = getDataRow($param_arr['p_year_period_id'], $data['p_vat_type_id'][$i],  $data['date_awal'][$i], $data['date_akhir'][$i], $data['p_vat_type_dtl_id'][$i]);

		if($pajak_text == $data['pajak_text'][$i]) {
			
			if($data['p_vat_type_id'][$i] == 1 or $data['p_vat_type_id'][$i] == 2 or $data['p_vat_type_id'][$i] == 3) {
				$output .= '<tr>';
				$output .= '<td>'.$data['vat_code'][$i].'</td>';
				$output .= '<td align="right">'.number_format($item['target'], 0, ',', '.').' </td>';
				$output .= '<td align="right">'.number_format($item['realisasiDanPiutang'], 0, ',', '.').'</td>';
				//$output .= '<td align="right">'.number_format($item['realisasi'], 0, ',', '.').'</td>';
				//$output .= '<td align="right">'.number_format($item['piutang'], 0, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($item['selisih'], 0, ',', '.').'</td>';
				$output .= '</tr>';	
			}
			$total_target_ += $item['target'];
			$total_realisasi_ += $item['realisasiDanPiutang'];
			//$total_realisasi_ += $item['realisasi'];
			//$total_piutang_ += $item['piutang'];
			$total_selisih_ += $item['selisih'];	
		} else {
			
			$output .= '<tr style="background:#498CD6;font-weight:bold;color:#FFFFFF;">';
			$output .= '<td style="padding-left:20px;"> JUMLAH '.$pajak_text.'</td>';
			$output .= '<td align="right"> '.number_format($total_target_, 0, ',', '.').' </td>';
			$output .= '<td align="right"> '.number_format($total_realisasi_, 0, ',', '.').'</td>';
			//$output .= '<td align="right"> '.number_format($total_piutang_, 0, ',', '.').'</td>';
			$output .= '<td align="right"> '.number_format($total_selisih_, 0, ',', '.').' </td>';
			$output .= '</tr>';	
			
			/*GRAND TOTATL */

			$grand_total_target_ += $total_target_;
			$grand_total_realisasi_ += $total_realisasi_;
			$grand_total_piutang_ += $total_piutang_;
			$grand_total_selisih_ += $total_selisih_;
				
			/*END GRAND TOTAL */

			$pajak_text = $data['pajak_text'][$i];
			$total_target_ = 0;
			$total_realisasi_ = 0;
			$total_piutang_ = 0;
			$total_selisih_ = 0;
			
			if($data['p_vat_type_id'][$i] == 1 or $data['p_vat_type_id'][$i] == 2 or $data['p_vat_type_id'][$i] == 3) {
				$output .= '<tr>';
				$output .= '<td>'.$data['vat_code'][$i].'</td>';
				$output .= '<td align="right">'.number_format($item['target'], 0, ',', '.').' </td>';
				$output .= '<td align="right">'.number_format($item['realisasiDanPiutang'], 0, ',', '.').'</td>';
				//$output .= '<td align="right">'.number_format($item['realisasi'], 0, ',', '.').'</td>';
				//$output .= '<td align="right">'.number_format($item['piutang'], 0, ',', '.').'</td>';
				$output .= '<td align="right">'.number_format($item['selisih'], 0, ',', '.').'</td>';
				$output .= '</tr>';	
			}

			$total_target_ += $item['target'];
			$total_realisasi_ += $item['realisasiDanPiutang'];
			//$total_realisasi_ += $item['realisasi'];
			//$total_piutang_ += $item['piutang'];
			$total_selisih_ += $item['selisih'];
		}			

	}
			$output .= '<tr style="background:#498CD6;font-weight:bold;color:#FFFFFF;">';
			$output .= '<td style="padding-left:20px;"> JUMLAH '.$pajak_text.'</td>';
			$output .= '<td align="right"> '.number_format($total_target_, 0, ',', '.').' </td>';
			$output .= '<td align="right"> '.number_format($total_realisasi_, 0, ',', '.').'</td>';
			//$output .= '<td align="right"> '.number_format($total_piutang_, 0, ',', '.').'</td>';
			$output .= '<td align="right"> '.number_format($total_selisih_, 0, ',', '.').' </td>';
			$output .= '</tr>';	
			

			$itemReklame = getDataRowReklame($param_arr['p_year_period_id'], $date_awal, $date_akhir);
			$output .= '<tr style="background:#498CD6;font-weight:bold;color:#FFFFFF;">';
			$output .= '<td style="padding-left:20px;"> JUMLAH REKLAME </td>';
			$output .= '<td align="right"> '.number_format($itemReklame['target'], 0, ',', '.').' </td>';
			$output .= '<td align="right"> '.number_format($itemReklame['realisasiDanPiutang'], 0, ',', '.').'</td>';
			//$output .= '<td align="right"> '.number_format($itemReklame['realisasi'], 0, ',', '.').'</td>';
			//$output .= '<td align="right"> '.number_format($itemReklame['piutang'], 0, ',', '.').'</td>';
			$output .= '<td align="right"> '.number_format($itemReklame['selisih'], 0, ',', '.').' </td>';
			$output .= '</tr>';	

	/*GRAND TOTATL */

		$grand_total_target_ += $total_target_ + $itemReklame['target'];
		$grand_total_realisasi_ += $total_realisasi_ + $itemReklame['realisasiDanPiutang'];
		//$grand_total_realisasi_ += $total_realisasi_ + $itemReklame['realisasi'];
		//$grand_total_piutang_ += $total_piutang_ + $itemReklame['piutang'];
		$grand_total_selisih_ += $total_selisih_ + $itemReklame['selisih'];
				
	/*END GRAND TOTAL */	

	$output .= '<tr style="background:#000000;font-weight:bold;font-size:14px;color:#FFFFFF;">';
	$output .= '<td style="padding-left:20px;"> JUMLAH TOTAL </td>';
	$output .= '<td align="right"> '.number_format($grand_total_target_, 0, ',', '.').' </td>';
	$output .= '<td align="right"> '.number_format($grand_total_realisasi_, 0, ',', '.').'</td>';
	//$output .= '<td align="right"> '.number_format($grand_total_piutang_, 0, ',', '.').'</td>';
	$output .= '<td align="right"> '.number_format($grand_total_selisih_, 0, ',', '.').' </td>';
	$output .= '</tr>';	

	$output .= '</table>';
	$output .= '</td></tr>';
	$output .= '</table>';

	return $output;
} 


function getDateAwal($p_finance_period_id) {
	
	$dbConn = new clsDBConnSIKP();
		
	$query = "SELECT trunc(start_date) as start_date FROM p_finance_period
				WHERE p_finance_period_id = ".$p_finance_period_id;
	$dbConn->query($query);
	$result = '';
	while ($dbConn->next_record()) {
		$result = $dbConn->f("start_date");
	}
	$dbConn->close();
	return $result;

}

function getDateAkhir($p_finance_period_id) {

	$dbConn = new clsDBConnSIKP();
		
	$query = "SELECT trunc(end_date) as end_date FROM p_finance_period
				WHERE p_finance_period_id = ".$p_finance_period_id;

	$dbConn->query($query);
	$result = '';
	while ($dbConn->next_record()) {
		$result = $dbConn->f("end_date");
	}
	$dbConn->close();
	return $result;

}

function getDataRow($year_period_id, $p_vat_type_id, $date_awal, $date_akhir, $p_vat_type_dtl_id) {
	
	$dbConn = new clsDBConnSIKP();
		
	$query = "SELECT SUM(target_amount) AS target, SUM(realisasi_amt) AS realisasi,
				SUM(debt_amt) AS piutang
				FROM f_target_vs_real_monthly_new(".$year_period_id.",".$p_vat_type_id.")
				WHERE trunc(start_date) >= '".$date_awal."'
				AND trunc(end_date) <= '".$date_akhir."'
				AND p_vat_type_dtl_id = ".$p_vat_type_dtl_id;

	$dbConn->query($query);
	$result = array();
	while ($dbConn->next_record()) {
		$result['target'] = $dbConn->f("target");
		$result['piutang'] = $dbConn->f("piutang");
		$result['realisasi'] = $dbConn->f("realisasi");
		$result['selisih'] = ($dbConn->f("realisasi") + $dbConn->f("piutang")) - $dbConn->f("target");
		$result['realisasiDanPiutang'] = $dbConn->f("realisasi") + $dbConn->f("piutang");
	}
	$dbConn->close();
	return $result;

}


function getDataRowReklame($year_period_id, $date_awal, $date_akhir) {
	
	$dbConn = new clsDBConnSIKP();
		
	$query = "SELECT SUM(target_amount) AS target, SUM(realisasi_amt) AS realisasi,
				SUM(debt_amt) AS piutang
				FROM f_target_vs_real_monthly_new(".$year_period_id.",9)
				WHERE trunc(start_date) >= '".$date_awal."'
				AND trunc(end_date) <= '".$date_akhir."'";

	$dbConn->query($query);
	$result = array();
	while ($dbConn->next_record()) {
		$result['target'] = $dbConn->f("target");
		$result['piutang'] = $dbConn->f("piutang");
		$result['realisasi'] = $dbConn->f("realisasi");
		$result['selisih'] = ($dbConn->f("realisasi") + $dbConn->f("piutang")) - $dbConn->f("target");
		$result['realisasiDanPiutang'] = $dbConn->f("realisasi") + $dbConn->f("piutang");
	}
	$dbConn->close();
	return $result;

}

?>

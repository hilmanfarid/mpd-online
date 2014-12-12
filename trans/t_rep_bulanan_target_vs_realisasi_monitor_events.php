<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-34701C14
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_bulanan_target_vs_realisasi_monitor; //Compatibility
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

//Page_BeforeShow @1-0D4E4C60
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_bulanan_target_vs_realisasi_monitor; //Compatibility
//End Page_BeforeShow
	global $Label1;
	global $t_rep_bulanan_target_vs_realisasiSearch;
//Custom Code @566-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$doAction = 'view_html';
	$data = array();
	$param_arr = array();
	
	$p_year_period_id = '';
	
	$dbConn = new clsDBConnSIKP();
	$query = "SELECT p_year_period_id 
				FROM p_year_period
				WHERE year_code = '".date("Y")."'";

	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$p_year_period_id = $dbConn->f("p_year_period_id");
	}

	$date_akhir = '';
	$bulan_now = date("n");
	if($bulan_now >=1 and $bulan_now <= 3) {
		$start_date = date("Y")."-01-01";
		$end_date = date("Y")."-03-31";

		$periode1 = "JANUARI ".date("Y");
		$periode2 = "MARET ".date("Y");

	}else if($bulan_now >=4 and $bulan_now <= 6) {
		$start_date = date("Y")."-04-01";
		$end_date = date("Y")."-06-30";

		$periode1 = "APRIL ".date("Y");
		$periode2 = "JUNI ".date("Y");
	}else if($bulan_now >=7 and $bulan_now <= 9) {
		$start_date = date("Y")."-07-01";
		$end_date = date("Y")."-09-30";

		$periode1 = "JULI ".date("Y");
		$periode2 = "SEPTEMBER ".date("Y");
	}else if($bulan_now >=10 and $bulan_now <= 12) {
		$start_date = date("Y")."-10-01";
		$end_date = date("Y")."-12-31";

		$periode1 = "OKTOBER ".date("Y");
		$periode2 = "DESEMBER ".date("Y");
	}

	
	/*$param_arr['date_awal'] = $start_date;
	$param_arr['date_akhir'] = $end_date;

	$param_arr['p_year_period_id'] = $p_year_period_id;
	$param_arr['tahun_periode'] = date("Y");

	$param_arr['pajak_periode'] = $periode1;
	$param_arr['pajak_periode1'] = $periode2;
	*/
	$param_arr['date_awal'] = date("Y")."-01-01";
	$param_arr['date_akhir'] = date("Y")."-12-31";

	$param_arr['p_year_period_id'] = $p_year_period_id;
	$param_arr['tahun_periode'] = date("Y");
	
	$param_arr['pajak_periode'] = "JANUARI ".date("Y");
	$param_arr['pajak_periode1'] = "DESEMBER ".date("Y");

		
	if($doAction == 'view_html') {
		$Label1->SetText(GetCetakGeneralHTML($param_arr));
		
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
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="98%" style="margin-left:10px;margin-right:10px;margin-top:10px;padding:5px 5px 5px 5px;">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong style="font-size:25px;">LAPORAN TARGET DAN REALISASI</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              	</table>';
	//$output .= '<div align="right"><a href="#" onClick="downloadGeneral();"> Download Excel </a></div>';
	$output .= '<h3>BIDANG PAJAK PENDAFTARAN & PAJAK PENETAPAN</h3>';
	$output .= '<h3>PERIODE : '.$param_arr["pajak_periode"].' s.d '.$param_arr["pajak_periode1"].'</h3> <br/>';
	
	$output .='<table class="report" cellspacing="0" cellpadding="4px" width="100%">
                <tr style="background:#282A68;color:#FFFFFF; font-size:15px;">';
	$output .= '<th width="150">JENIS PAJAK</th>';
	$output .= '<th width="150">TARGET</th>';
	$output .= '<th width="150">REALISASI</th>';
	//$output .= '<th width="150">PIUTANG</th>';
	$output .= '<th width="150">KETERANGAN SELISIH</th>';
	$output .= '</tr>';
	
	
	$date_awal = $param_arr['date_awal'];
	$date_akhir = $param_arr['date_akhir'];
	
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
	
	$output .= '<tr>
			<td colspan="4" align="right" style="text-align:right;font-size:15px;color:#282A68;">TIM IT Disyanjak@2014 &nbsp;&nbsp;&nbsp;&nbsp; www.disyanjak.bandung.go.id</td>
	</tr>';
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

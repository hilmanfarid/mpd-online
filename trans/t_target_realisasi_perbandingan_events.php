<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-B55F5F54
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_perbandingan; //Compatibility
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

//Page_BeforeShow @1-0662FDD8
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_perbandingan; //Compatibility
//End Page_BeforeShow

//Custom Code @562-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	$tampil = CCGetFromGet('tampil');
	if($tampil=='T'){
		$Label1->SetText("<table border=1><tr><td>tes</td></tr></table>");
		$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");//'15-12-2013';
		// $tgl_penerimaan		= '15-12-2013';

		$user				= CCGetUserLogin();
		$data				= array();
		$data2				= array();
		$data3				= array();
		$dbConn				= new clsDBConnSIKP();
		$tgl_penerimaan		= str_replace("'", "", $tgl_penerimaan);
		$query				= " 
				select
					nama_jns_pajak,sum(jml_sd_hari_ini) as realisasi,p_vat_type_id 
				from f_rep_lap_harian_bdhr_mod_1('".$tgl_penerimaan."') 
				where p_vat_type_id in (1,2,3,4,5,6)
				GROUP BY nama_jns_pajak,p_vat_type_id
				ORDER BY p_vat_type_id";
		//echo $query;exit;
		$tgl_penerimaan		= str_replace("'", "", $tgl_penerimaan);
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data['nama_jns_pajak'][] = $dbConn->f('nama_jns_pajak');
			$data['realisasi'][] = $dbConn->f('realisasi');
			$data['p_vat_type_id'][] = $dbConn->f('p_vat_type_id');
		}

		$tahun 	= substr ($tgl_penerimaan,6,4);
		$tgl_penerimaan2 = substr ($tgl_penerimaan,0,6).($tahun-1);
		$tgl_penerimaan3 = substr ($tgl_penerimaan,0,6).($tahun-2);
		$query				= " 
				select
					nama_jns_pajak,sum(jml_sd_hari_ini) as realisasi,p_vat_type_id 
				from f_rep_lap_harian_bdhr_mod_1('".$tgl_penerimaan2."') 
				where p_vat_type_id in (1,2,3,4,5,6)
				GROUP BY nama_jns_pajak,p_vat_type_id
				ORDER BY p_vat_type_id";
		//echo $query;exit;
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data2['nama_jns_pajak'][] = $dbConn->f('nama_jns_pajak');
			$data2['realisasi'][] = $dbConn->f('realisasi');
			$data2['p_vat_type_id'][] = $dbConn->f('p_vat_type_id');
		}

		$query				= " 
				select
					nama_jns_pajak,sum(jml_sd_hari_ini) as realisasi,p_vat_type_id 
				from f_rep_lap_harian_bdhr_mod_1('".$tgl_penerimaan2."') 
				where p_vat_type_id in (1,2,3,4,5,6)
				GROUP BY nama_jns_pajak,p_vat_type_id
				ORDER BY p_vat_type_id";
		//echo $query;exit;
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data3['nama_jns_pajak'][] = $dbConn->f('nama_jns_pajak');
			$data3['realisasi'][] = $dbConn->f('realisasi');
			$data3['p_vat_type_id'][] = $dbConn->f('p_vat_type_id');
		}

		$dbConn->close();
		$excel = CCGetFromGet('excel');
		if($excel=='T'){
			GetCetakExcel($data,$data2,$data3,$user,$tgl_penerimaan);
		}else{
			$Label1->SetText(PageCetak($data,$data2,$data3,$user,$tgl_penerimaan));
		}
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function PageCetak($data,$data2,$data3, $user, $tgl_penerimaan) {
		$kabid = CCGetFromGet('kabid');
		$bphtb_row=array();
		$output='';
		$output.='<table>
					<tr>';
		$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  <td class="th"><strong>TARGET VS REALISASI PERBANDINGAN</strong></td> 
                  <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                </tr>
              </table>
 
              <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';

		$tahun 	= substr ($tgl_penerimaan,6,4);
		$tgl_penerimaan2 = substr ($tgl_penerimaan,0,6).($tahun-1);
		$tgl_penerimaan3 = substr ($tgl_penerimaan,0,6).($tahun-2);
		$output.='<th rowspan=2 style="text-align:center;">NO</th>';
		$output.='<th rowspan=2 style="text-align:center;">JENIS PAJAK</th>';
		$output.='<th colspan=3 style="text-align:center;">'.($tahun-2).'</th>';
		$output.='<th colspan=3 style="text-align:center;">'.($tahun-1).'</th>';
		$output.='<th colspan=3 style="text-align:center;">'.$tahun.'</th></tr>';
		$output.='<tr class="Caption"><th style="text-align:center;">TARGET</th>';
		$output.='<th style="text-align:center;">REALISASI</th>';
		$output.='<th style="text-align:center;">% REAL</th>';
		$output.='<th style="text-align:center;">TARGET</th>';
		$output.='<th style="text-align:center;">REALISASI</th>';
		$output.='<th style="text-align:center;">% REAL</th>';
		$output.='<th style="text-align:center;">TARGET</th>';
		$output.='<th style="text-align:center;">REALISASI</th>';
		$output.='<th style="text-align:center;">% REAL</th>';
		$output.='</tr>';
				
		$no = 1;
		$total_target = 0;
		$total_realisasi =0;
		$total_target2 = 0;
		$total_realisasi2 =0;
		$total_target3 = 0;
		$total_realisasi3 =0;
		$bulan = substr ($tgl_penerimaan,3,2);
		for ($i = 0; $i < count($data['nama_jns_pajak']); $i++) {
			//print data
			$query = "select sum(target_amt)as target  
					from t_revenue_target_dtl where t_revenue_target_id =  
					(select t_revenue_target_id from t_revenue_target
					 where p_vat_type_id = ".$data['p_vat_type_id'][$i]."
						and p_year_period_id =
							(select p_year_period_id from p_year_period 
							where to_date('".$tgl_penerimaan."','dd-mm-yyyy') BETWEEN start_date and end_date
							)
					)";
			//echo $query;exit;
			$dbConn				= new clsDBConnSIKP();
			$dbConn->query($query);
			$dbConn->next_record();
			$target = $dbConn->f('target');
 
			$query = "select sum(target_amt)as target   
					from t_revenue_target_dtl where t_revenue_target_id =  
					(select t_revenue_target_id from t_revenue_target
					 where p_vat_type_id = ".$data['p_vat_type_id'][$i]."
						and p_year_period_id =
							(select p_year_period_id from p_year_period 
							where to_date('".$tgl_penerimaan2."','dd-mm-yyyy') BETWEEN start_date and end_date
							)
					)";

			$dbConn->query($query);
			$dbConn->next_record();
			$target2 = $dbConn->f('target');

			$query = "select sum(target_amt)as target  
					from t_revenue_target_dtl where t_revenue_target_id =  
					(select t_revenue_target_id from t_revenue_target
					 where p_vat_type_id = ".$data['p_vat_type_id'][$i]."
						and p_year_period_id =
							(select p_year_period_id from p_year_period 
							where to_date('".$tgl_penerimaan3."','dd-mm-yyyy') BETWEEN start_date and end_date
							)
					)";
			
			$dbConn->query($query);
			$dbConn->next_record();
			$target3 = $dbConn->f('target');

			$output.='<tr>';
				$output.='<td style="font-weight:bold;" align="left">'.$no.'</td>';
				$output.='<td style="font-weight:bold;" align="left">'.strtoupper($data["nama_jns_pajak"][$i]).'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($target3, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($data3["realisasi"][$i], 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format(($data3["realisasi"][$i]/$target3 * 100), 2, ',', '.').' %</td>';
				
				$output.='<td style="font-weight:bold;" align="right">'.number_format($target2, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($data2["realisasi"][$i], 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format(($data2["realisasi"][$i]/$target2 * 100), 2, ',', '.').' %</td>';
				
				$output.='<td style="font-weight:bold;" align="right">'.number_format($target, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($data["realisasi"][$i], 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format(($data["realisasi"][$i]/$target * 100), 2, ',', '.').' %</td>';
				
			$output.='</tr>';
			$no++;
			$total_target += $target;
			$total_realisasi += $data["realisasi"][$i];
			$total_target2 += $target2;
			$total_realisasi2 += $data2["realisasi"][$i];
			$total_target3 += $target3;
			$total_realisasi3 += $data3["realisasi"][$i];
		}
		$output.='<tr>';
			$output.='<td style="font-weight:bold;" align="left"></td>';
			$output.='<td style="font-weight:bold;" align="left">JUMLAH</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_target3, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_realisasi3, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format(($total_realisasi3/$total_target3 * 100), 2, ',', '.').' %</td>';
			
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_target2, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_realisasi2, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format(($total_realisasi2/$total_target2 * 100), 2, ',', '.').' %</td>';

			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_target, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_realisasi, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format(($total_realisasi/$total_target * 100), 2, ',', '.').' %</td>';
		$output.='</tr>';
		$output.='</table></table>';
		return $output;
	}


function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakExcel($data,$data2,$data3, $user, $tgl_penerimaan) {
	
	startExcel("laporan_target_vs_realisasi_perbandingan.xls");
	
	$output='';
		$output.='<table>
					<tr>';
		$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="th" colspan=11 align="center"><strong>TARGET DAN REALISASI PERBANDINGAN</strong></td> 
                </tr>
				<tr>
                  <td class="th" colspan=11 align="center"><strong>SAMPAI TANGGAL '.$tgl_penerimaan.'</strong></td> 
                </tr>
				<tr>
				</tr>
              </table>
 
              <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


		$tahun 	= substr ($tgl_penerimaan,6,4);
		$tgl_penerimaan2 = substr ($tgl_penerimaan,0,6).($tahun-1);
		$tgl_penerimaan3 = substr ($tgl_penerimaan,0,6).($tahun-2);
		$output.='<th rowspan=2 style="text-align:center;">NO</th>';
		$output.='<th rowspan=2 style="text-align:center;">JENIS PAJAK</th>';
		$output.='<th colspan=3 style="text-align:center;">'.($tahun-2).'</th>';
		$output.='<th colspan=3 style="text-align:center;">'.($tahun-1).'</th>';
		$output.='<th colspan=3 style="text-align:center;">'.$tahun.'</th></tr>';
		$output.='<tr class="Caption"><th style="text-align:center;">TARGET</th>';
		$output.='<th style="text-align:center;">REALISASI</th>';
		$output.='<th style="text-align:center;">% REAL</th>';
		$output.='<th style="text-align:center;">TARGET</th>';
		$output.='<th style="text-align:center;">REALISASI</th>';
		$output.='<th style="text-align:center;">% REAL</th>';
		$output.='<th style="text-align:center;">TARGET</th>';
		$output.='<th style="text-align:center;">REALISASI</th>';
		$output.='<th style="text-align:center;">% REAL</th>';
		$output.='</tr>';
				
		$no = 1;
		$total_target = 0;
		$total_realisasi =0;
		$total_target2 = 0;
		$total_realisasi2 =0;
		$total_target3 = 0;
		$total_realisasi3 =0;
		$bulan = substr ($tgl_penerimaan,3,2);
		for ($i = 0; $i < count($data['nama_jns_pajak']); $i++) {
			//print data
			$query = "select sum(target_amt)as target  
					from t_revenue_target_dtl where t_revenue_target_id =  
					(select t_revenue_target_id from t_revenue_target
					 where p_vat_type_id = ".$data['p_vat_type_id'][$i]."
						and p_year_period_id =
							(select p_year_period_id from p_year_period 
							where to_date('".$tgl_penerimaan."','dd-mm-yyyy') BETWEEN start_date and end_date
							)
					)";
			//echo $query;exit;
			$dbConn				= new clsDBConnSIKP();
			$dbConn->query($query);
			$dbConn->next_record();
			$target = $dbConn->f('target');
 
			$query = "select sum(target_amt)as target   
					from t_revenue_target_dtl where t_revenue_target_id =  
					(select t_revenue_target_id from t_revenue_target
					 where p_vat_type_id = ".$data['p_vat_type_id'][$i]."
						and p_year_period_id =
							(select p_year_period_id from p_year_period 
							where to_date('".$tgl_penerimaan2."','dd-mm-yyyy') BETWEEN start_date and end_date
							)
					)";

			$dbConn->query($query);
			$dbConn->next_record();
			$target2 = $dbConn->f('target');

			$query = "select sum(target_amt)as target  
					from t_revenue_target_dtl where t_revenue_target_id =  
					(select t_revenue_target_id from t_revenue_target
					 where p_vat_type_id = ".$data['p_vat_type_id'][$i]."
						and p_year_period_id =
							(select p_year_period_id from p_year_period 
							where to_date('".$tgl_penerimaan3."','dd-mm-yyyy') BETWEEN start_date and end_date
							)
					)";
			
			$dbConn->query($query);
			$dbConn->next_record();
			$target3 = $dbConn->f('target');

			$output.='<tr>';
				$output.='<td style="font-weight:bold;" align="left">'.$no.'</td>';
				$output.='<td style="font-weight:bold;" align="left">'.strtoupper($data["nama_jns_pajak"][$i]).'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($target3, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($data3["realisasi"][$i], 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format(($data3["realisasi"][$i]/$target3 * 100), 2, ',', '.').' %</td>';
				
				$output.='<td style="font-weight:bold;" align="right">'.number_format($target2, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($data2["realisasi"][$i], 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format(($data2["realisasi"][$i]/$target2 * 100), 2, ',', '.').' %</td>';
				
				$output.='<td style="font-weight:bold;" align="right">'.number_format($target, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($data["realisasi"][$i], 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format(($data["realisasi"][$i]/$target * 100), 2, ',', '.').' %</td>';
				
			$output.='</tr>';
			$no++;
			$total_target += $target;
			$total_realisasi += $data["realisasi"][$i];
			$total_target2 += $target2;
			$total_realisasi2 += $data2["realisasi"][$i];
			$total_target3 += $target3;
			$total_realisasi3 += $data3["realisasi"][$i];
		}
		$output.='<tr>';
			$output.='<td style="font-weight:bold;" align="left"></td>';
			$output.='<td style="font-weight:bold;" align="left">JUMLAH</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_target3, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_realisasi3, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format(($total_realisasi3/$total_target3 * 100), 2, ',', '.').' %</td>';
			
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_target2, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_realisasi2, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format(($total_realisasi2/$total_target2 * 100), 2, ',', '.').' %</td>';

			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_target, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($total_realisasi, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format(($total_realisasi/$total_target * 100), 2, ',', '.').' %</td>';
		$output.='</tr>';
		$output.='</table></table>';

	echo $output;
	exit;
}
?>

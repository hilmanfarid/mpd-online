<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-3F7A66D8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_per_3_tahun_bulanan; //Compatibility
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

//Page_BeforeShow @1-1F42B2E0
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_per_3_tahun_bulanan; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_finance_period_id'] = CCGetFromGet('p_finance_period_id');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id','');
	$param_arr['p_vat_type_dtl_id'] = CCGetFromGet('p_vat_type_dtl_id');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	$param_arr['vat_code_dtl'] = CCGetFromGet('vat_code_dtl');
	$param_arr['year_code'] = CCGetFromGet('year_code');
	$param_arr['code'] = CCGetFromGet('code');
	if($doAction == 'view_html') {
		$Label1->SetText(GetCetakHTML($param_arr));
	}
	if($doAction == 'view_excel') {
		GetCetakHTML($param_arr);
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
		startExcel("laporan_pembayaran_wp_per_3_tahun_bulanan.xls");
	}
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="th" colspan = 9 ><strong>LAPORAN PEMBAYARAN WP PER 3 TAHUN BULANAN</strong></td> 
                	</tr>
              		</table>';
	
	$output .= '<h2>JENIS PAJAK : '.$param_arr['vat_code'].' </h2>';
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	//$dbConn	= new clsDBConnSIKP();
	//$query="select year_code from p_year_period where p_year_period_id = ".$param_arr['p_year_period_id'];
	//echo $query;exit;
	$data = array();
	//$dbConn->query($query);
	//$dbConn->next_record();
	$tahun = $param_arr['year_code'];
	//$dbConn->close();

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >AYAT PAJAK</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >NAMA MERK DAGANG</th>';
	$output.='<th align="center" >ALAMAT MERK DAGANG</th>';
	$output.='<th align="center" >TGL PENGUKUHAN</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >'.($tahun-2).'</th>';
	$output.='<th align="center" >'.($tahun-1).'</th>';
	$output.='<th align="center" >'.$tahun.'</th>';
	$output.='</tr>';

	if ($param_arr['p_vat_type_dtl_id']==''){
		$param_arr['p_vat_type_dtl_id'] = 0;
	}

	$dbConn	= new clsDBConnSIKP();
	$query="(select DISTINCT (c.npwd), c.t_cust_account_id,c.company_brand,regexp_replace(c.brand_address_name, '\r|\n', '', 'g')||' '||regexp_replace(c.brand_address_no, '\r|\n', '', 'g') as alamat,
			to_char(active_date,'dd-mm-yyyy') as active_date,
			c.p_vat_type_dtl_id, vat_code
			from t_cust_account c
			left join p_vat_type_dtl d on d.p_vat_type_dtl_id=c.p_vat_type_dtl_id
			where (case 
						when ".$param_arr['p_vat_type_dtl_id']." = 0 then true
						when ".$param_arr['p_vat_type_dtl_id']." = 10 then c.p_vat_type_dtl_id in (10,9) 
						else c.p_vat_type_dtl_id = ".$param_arr['p_vat_type_dtl_id']." 
					end)
			and ".$param_arr['p_vat_type_id']." = c.p_vat_type_id 
			and c.p_account_status_id = 1
			)
			union
			(select DISTINCT (c.npwd),c.t_cust_account_id,c.company_brand,regexp_replace(c.brand_address_name, '\r|\n', '', 'g')||' '||regexp_replace(c.brand_address_no, '\r|\n', '', 'g') as alamat,
			to_char(active_date,'dd-mm-yyyy') as active_date,
			c.p_vat_type_dtl_id, vat_code
			from t_cust_account c
			left join p_vat_type_dtl d on d.p_vat_type_dtl_id=c.p_vat_type_dtl_id
			where (case 
						when ".$param_arr['p_vat_type_dtl_id']." = 0 then true
						when ".$param_arr['p_vat_type_dtl_id']." = 10 then c.p_vat_type_dtl_id in (10,9) 
						else c.p_vat_type_dtl_id = ".$param_arr['p_vat_type_dtl_id']." 
					end)
			and ".$param_arr['p_vat_type_id']." = c.p_vat_type_id 
			and c.p_account_status_id != 1
			and (
					(
						select start_date
						from t_payment_receipt x
						left join p_finance_period y on x.p_finance_period_id = y.p_finance_period_id
						where x.t_cust_account_id = c.t_cust_account_id
						ORDER BY y.start_date desc
						limit 1
					) >= to_date('01-01-2014')
				)
			)
			order by p_vat_type_dtl_id,company_brand,npwd ";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();
	asort ($data);
	/*echo "<pre>";
	print_r($data);
	echo "</pre>";
	exit;*/

	//echo $data[1]['t_cust_account_id'];
	//exit;
	$masa =array();
	$masa[0]= '<td>Januari</td>';
	/*$masa[1]= '<td>Februari</td>';
	$masa[2]= '<td>Maret</td>';
	$masa[3]= '<td>April</td>';
	$masa[4]= '<td>Mei</td>';
	$masa[5]= '<td>Juni</td>';
	$masa[6]= '<td>Juli</td>';
	$masa[7]= '<td>Agustus</td>';
	$masa[8]= '<td>September</td>';
	$masa[9]= '<td>Oktober</td>';
	$masa[10]= '<td>November</td>';
	$masa[11]= '<td>Desember</td>';*/

	for( $k = 0 ; $k<count($data); $k++ ){ 
		$json_url = "http://localhost/mpd/services/pembayaran_wp_bulanan.php?p_finance_period_id=".$param_arr['p_finance_period_id']."&t_cust_account_id=".$data[$k]['t_cust_account_id']."&p_vat_type_dtl_id=".$param_arr['p_vat_type_dtl_id'];
		//echo $json_url;exit;
		$json = file_get_contents($json_url);
		$data_json = json_decode($json, TRUE);
		/*echo "<pre>";
		print_r($data_json);
		echo "</pre>";
		exit;*/
		
		$arr_month = array();
		$html = array();
		
		foreach($data_json as $tahun){
			$i=0;
			$j=0;
			foreach($tahun['arr_data'] as $bulan){
				if($j==0){
					$no = '<tr><td>'.($k+1).'&nbsp</td>';
					$vat_code= '<td>'.$data[$k]['vat_code'].'</td>';
					$npwpd= '<td>'.$bulan['npwd'].'</td>';
					$company_brand= '<td>'.$data[$k]['company_brand'].'</td>';
					$alamat= '<td>'.$data[$k]['alamat'].'</td>';
					$active_date= '<td>'.$data[$k]['active_date'].'</td>';
					$masa= '<td>'.substr($bulan['code'],0,-5).'</td>';
					$jumlah_bayar = '<td>'.number_format($bulan['pajak'], 2, ',', '.').'</td>';
					$html[$i].=$no.$vat_code.$npwpd.$company_brand.$alamat.$active_date.$masa.$jumlah_bayar;
				}else{
					$html[$i].='<td>'.number_format($bulan['pajak'], 2, ',', '.').'</td>';
					if($j==2){
						$html[$i].='</tr>';
					}
				}
				$j++;
				$i++;
			}	
		}
		
		$output.=(implode($html,''));
		
	}
	
	//echo '<script>';
	//return $output;
	//echo '</script>';
	
	/*$j = 0;
	$i = 0;
	foreach ($data_json as $tahun){
		//echo "<pre>";
		//print_r($tahun['arr_data']);
		//echo "</pre>";
		//exit;
		foreach ($tahun['arr_data'] as $bulan){
			/*echo "<pre>";
			print_r($bulan['code']);
			echo "</pre>";
			exit;*/
	/*		$output.='<tr><td align="center" >'.($i+1).'</td>';
			$output.='<td align="left" >'.$bulan['npwd'].'</td>';
			$output.='<td align="left" >'.$bulan['code'].'</td>';
			$output.='<td align="right" >'.number_format($bulan['pajak'], 2, ',', '.').'</td>';
			$output.='</tr>';
			$i++;
		}	
	}*/
	
	if($doAction == 'view_excel') {		
		echo $output;
		exit;
	}else{	
		return $output;
	}
}

function startExcel($filename = "laporan.xls") {    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}
?>

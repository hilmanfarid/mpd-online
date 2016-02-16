<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-32AA2FF9
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_per_3_tahun; //Compatibility
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

//Page_BeforeShow @1-775905FC
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_per_3_tahun; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
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
		startExcel("laporan_pembayaran_wp_per_3_tahun.xls");
	}
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="th" colspan = 9 ><strong>LAPORAN PEMBAYARAN WP PER 3 TAHUN</strong></td> 
                	</tr>
              		</table>';
	
	$output .= '<h2>JENIS PAJAK : '.$param_arr['vat_code'].' </h2>';
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$dbConn	= new clsDBConnSIKP();
	$query="select year_code from p_year_period where p_year_period_id = ".$param_arr['p_year_period_id'];
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	$dbConn->next_record();
	$tahun = $dbConn->f('year_code');
	$dbConn->close();

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >NAMA MERK DAGANG</th>';
	$output.='<th align="center" >ALAMAT MERK DAGANG</th>';
	$output.='<th align="center" >TGL PENGUKUHAN</th>';
	$output.='<th align="center" >MASA PAJAK</th>';
	$output.='<th align="center" >'.($tahun-2).'</th>';
	$output.='<th align="center" >'.($tahun-1).'</th>';
	$output.='<th align="center" >'.$tahun.'</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select DISTINCT (a.npwd),a.t_cust_account_id,c.company_brand,c.brand_address_name||' '||c.brand_address_no as alamat,
			to_char(active_date,'dd-mm-yyyy') as active_date
			from t_vat_setllement a, t_payment_receipt b, t_cust_account c
			where a.t_vat_setllement_id = b.t_vat_setllement_id
				and a.npwd != '' 
				and a.p_vat_type_dtl_id in
					(select p_vat_type_dtl_id from p_vat_type_dtl 
					where p_vat_type_id = ".$param_arr['p_vat_type_id'].")
				and a.start_period > to_date ('31-12-2012','dd-mm-yyyy')
			and c.t_cust_account_id=a.t_cust_account_id
			order by c.company_brand,a.npwd";
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
	$masa[1]= '<td>Februari</td>';
	$masa[2]= '<td>Maret</td>';
	$masa[3]= '<td>April</td>';
	$masa[4]= '<td>Mei</td>';
	$masa[5]= '<td>Juni</td>';
	$masa[6]= '<td>Juli</td>';
	$masa[7]= '<td>Agustus</td>';
	$masa[8]= '<td>September</td>';
	$masa[9]= '<td>Oktober</td>';
	$masa[10]= '<td>November</td>';
	$masa[11]= '<td>Desember</td>';

	for( $k = 0 ; $k<count($data); $k++ ){ 
		$json_url = "http://localhost/mpd/services/pembayaran_wp.php?p_year_period_id=".$param_arr['p_year_period_id']."&t_cust_account_id=".$data[$k]['t_cust_account_id'];
		//echo $json_url;exit;
		$json = file_get_contents($json_url);
		$data_json = json_decode($json, TRUE);
		/*echo "<pre>";
		print_r($data_json);
		echo "</pre>";
		exit;
		*/
		$arr_month = array();
		$html = array();
		$j=0;
		foreach($data_json as $tahun){
			$i=0;
			foreach($tahun['arr_data'] as $bulan){
				if($j==0){
					$no = '<tr><td>'.($k+1).'-'.($i+1).'&nbsp</td>';
					$npwpd= '<td>'.$bulan['npwd'].'</td>';
					$company_brand= '<td>'.$data[$k]['company_brand'].'</td>';
					$alamat= '<td>'.$data[$k]['alamat'].'</td>';
					$active_date= '<td>'.$data[$k]['active_date'].'</td>';
					//$masa= '<td>'.$bulan['code'].'</td>';
					$tahun = '<td>'.number_format($bulan['pajak'], 2, ',', '.').'</td>';
					$html[$i].=$no.$npwpd.$company_brand.$alamat.$active_date.$masa[$i].$tahun;
				}else{
					$html[$i].='<td>'.number_format($bulan['pajak'], 2, ',', '.').'</td>';
					if($j==2){
						$html[$i].='</tr>';
					}
				}
				$i++;
			}
			$j++;	
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

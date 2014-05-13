<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-9F9DD31E
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_rekap_bphtb_verifikasi; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	if(CCGetFromGet('mode')=='update'){
		updateStatusVerifikasi(CCGetFromGet('t_bphtp_registration_id'));
	}else if(CCGetFromGet('cetak_laporan')=='T'){
		$param_arr=array();
		if(empty($param_arr['date_start_laporan'])){
			$param_arr['date_start']=CCGetFromGet('date_start_laporan');
		}
		if(empty($param_arr['date_end_laporan'])){
			$param_arr['date_end']=CCGetFromGet('date_end_laporan');
		}

		$param_arr['filter_lap'] = CCGetFromGet('filter_lap');
		//print_laporan($param_arr);
		$Label1->SetText(tampilkan_html($param_arr));
	}
	
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function dateToString($date, $strip = '/'){
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
	
	return $pieces[2].$strip.$monthname[(int)$pieces[1]].$strip.$pieces[0];
}

function tampilkan_html($param_arr){
	$dbConn = new clsDBConnSIKP();
	$whereClause='';
	if(!empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$whereClause.=" AND (trunc(reg_bphtb.creation_date) BETWEEN '".$param_arr['date_start']."'";
		$whereClause.=" AND '".$param_arr['date_end']."')";
	}else if(!empty($param_arr['date_start'])&&empty($param_arr['date_end'])){
		$whereClause.=" AND trunc(reg_bphtb.creation_date) >= '".$param_arr['date_start']."'";
	}else if(empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$whereClause.=" AND trunc(reg_bphtb.creation_date) <= '".$param_arr['date_end']."'";
	}

	if(!empty($param_arr['filter_lap'])) {
		
		if($param_arr['filter_lap'] == 1) //sudah bayar
			$whereClause.= " AND (payment.receipt_no is not null or payment.receipt_no <> '') ";
		if($param_arr['filter_lap'] == 2) //belum bayar
			$whereClause.= " AND ( payment.receipt_no is null or payment.receipt_no = '') ";
	}

	$query="SELECT
				reg_bphtb.t_bphtb_registration_id,
				to_char(reg_bphtb.creation_date, 'YYYY-MM-DD') as creation_date,
				registration_no,
				wp_name,
				reg_bphtb.p_bphtb_legal_doc_type_id,
				bphtb_doc.description,
				njop_pbb,
				land_area,
				land_total_price,
				building_area,
				building_total_price,
				market_price,
				bphtb_amt_final
			FROM
				sikp.t_bphtb_registration reg_bphtb
			LEFT JOIN p_bphtb_legal_doc_type bphtb_doc on bphtb_doc.p_bphtb_legal_doc_type_id = reg_bphtb.p_bphtb_legal_doc_type_id
			LEFT JOIN t_customer_order cust_order ON cust_order.t_customer_order_id = reg_bphtb.t_customer_order_id 
			LEFT JOIN t_payment_receipt_bphtb payment ON reg_bphtb.t_bphtb_registration_id = payment.t_bphtb_registration_id 
			WHERE cust_order.p_order_status_id <> 1 
			AND reg_bphtb.status_verifikasi is null";
	$query.=$whereClause;
	$query.=" order by trunc(reg_bphtb.creation_date) ASC,upper(wp_name) ASC";
	
	$dbConn->query($query);
	$items=array();
	while($dbConn->next_record()){
		$items[]= $item = array(
		   't_bphtb_registration_id' => $dbConn->f("t_bphtb_registration_id"), 
		   'creation_date' => $dbConn->f("creation_date"), 	
		   'registration_no' => $dbConn->f("registration_no"),
		   'wp_name' => $dbConn->f("wp_name"),
		   'p_bphtb_legal_doc_type_id' => $dbConn->f("p_bphtb_legal_doc_type_id"),
		   'description' => $dbConn->f("description"),
		   'njop_pbb' => $dbConn->f("njop_pbb"),
		   'land_area' => $dbConn->f("land_area"),
		   'land_total_price' => $dbConn->f("land_total_price"),
		   'building_area' => $dbConn->f("building_area"),
		   'building_total_price' => $dbConn->f("building_total_price"),
		   'market_price' => $dbConn->f("market_price"),
		   'bphtb_amt_final' => $dbConn->f("bphtb_amt_final")
		);
	}
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>DAFTAR NOTA VERIFIKASI BPHTB YANG SUDAH BAYAR</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
               </table>';
	
	//$output .= '<h2>LAPORAN REALISASI HARIAN PER JENIS PAJAK </h2>';
	//$output .= '<h2>TANGGAL : '.dateToString($date_start, "-")." s/d ".dateToString($date_end, "-").'</h2> <br/>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';

	$output.='<th>NO</th>';
	$output.='<th>TANGGAL</th>';
	$output.='<th>NO.REGISTRASI</th>';
	$output.='<th width = 500>NAMA WP</th>';
	$output.='<th>JENIS TRANSAKSI</th>';
	$output.='<th>NOP</th>';
	$output.='<th width = 200>LT / LB</th>';
	$output.='<th>HARGA TANAH</br>(Rp)</th>';
	$output.='<th>HARGA BANGUNAN</br>(Rp)</th>';
	$output.='<th>TOTAL NJOP </br>(Rp)</th>';
	$output.='<th>HARGA PASAR / </br>TRANSAKSI / LELANG (Rp)</th>';
	$output.='<th>NILAI PAJAK </br>YANG HARUS DIBAYAR(Rp)</th>';
	$output.='<th>VERIFIKASI</th>';
	$output.='</tr>';
	
	$no=1;
	foreach($items as $item) {
		$output .= '<tr>';
			$output .= '<td align="center">'.$no.'</td>';
			$output .= '<td align="left">'.dateToString($item['creation_date']).'</td>';
			$output .= '<td align="left">'.$item['registration_no'].'</td>';
			$output .= '<td align="left">'.$item['wp_name'].'</td>';
			$output .= '<td align="left">'.$item['description'].'</td>';
			$output .= '<td align="left">'.$item['njop_pbb'].'</td>';
			$output .= '<td align="right">'.number_format($item['land_area'],0,",",".")." / ".number_format($item['building_area'],0,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['land_total_price'],2,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['building_total_price'],2,",",".").'</td>';
			$output .= '<td align="right">'.number_format($nilai_njop,2,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['market_price'],2,",",".").'</td>';
			$output .= '<td align="right">'.number_format($item['bphtb_amt_final'],2,",",".").'</td>';
			$output .= '<td><button class="btn_tambah" onclick="updateStatusVerifikasi('.$item['t_bphtb_registration_id'].')">Verifikasi</button></td>';
		$output .= '</tr>';
		
		$no=$no+1;
	}
	
	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
}
function updateStatusVerifikasi($id){
	$dbConn = new clsDBConnSIKP();
	$query="UPDATE t_bphtb_registration 
	set status_verifikasi = 'Y' 
	WHERE t_bphtb_registration_id = $id";
	//echo $query;
	//exit;
	$dbConn->query($query);
	echo "<script>window.opener.location.reload();
	window.close();</script>";
	exit;
}

?>
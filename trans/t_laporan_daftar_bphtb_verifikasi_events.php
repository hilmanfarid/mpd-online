<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-D0DAE82C
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_daftar_bphtb; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    if($t_laporan_daftar_bphtb->cetak_laporan->GetValue()=='T'){
		$param_arr=array();
		$param_arr['date_start']=CCGetFromGet('date_start');
		$param_arr['date_end']=CCGetFromGet('date_end');
		$param_arr['object_p_region_id_kec']=CCGetFromGet('object_p_region_id_kec');
		$param_arr['kecamatan']=CCGetFromGet('kecamatan');
		
		print_excel($param_arr);
	}
	
// -------------------------
//End Custom Code

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
	
	return $pieces[2].'-'.$monthname[(int)$pieces[1]].'-'.$pieces[0];
}

function print_excel($param_arr) {

	startExcel("daftar_bphtb_".date('Y-m-d'));
	echo "<div><h3> LAPORAN DAFTAR BPHTB BERDASARKAN TANGGAL VERIFIKASI </h3></div>";	
	echo "<div><b>TANGGAL : ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])."</b></div>";	
		
	echo '<table border="1">';
	echo '<tr> 
		<th rowspan="2">NO</th>
		<th rowspan="1" colspan="4">WP</th>
		<th rowspan="2">JENIS TRANSAKSI</th>
		<th rowspan="2">NOP</th>
		<th rowspan="2">LOKASI OBJEK PAJAK</th>
		<th rowspan="2">LT</th>
		<th rowspan="2">LB</th>
		<th rowspan="2">HARGA TANAH / m2 (Rp)</th>
		<th rowspan="2">HARGA BANGUNAN / m2 (Rp)</th>
		<th rowspan="2">TOTAL</th>
		<th rowspan="2">HARGA TRANSAKSI / <br> PASAR / LELANG</th>
		<th rowspan="2">NILAI PAJAK YANG HARUS DIBAYAR</th>
		<th rowspan="1" colspan="3">NOTA VERIFIKASI</th>
		<th rowspan="1" colspan="3">SSPD BPHTB</th>
		<th rowspan="1" colspan="3">VALIDASI DAN LEGALISASI</th>
		<th rowspan="2">KETERANGAN</th>
	</tr>';
	
	echo '
		<tr>
			<th>NAMA WP</th>
			<th>ALAMAT</th>
			<th>KELURAHAN</th>
			<th>KECAMATAN</th>			

			<th>NOMOR</th>
			<th>TANGGAL</th>
			<th>(Rp)</th>

			<th>NOMOR</th>
			<th>TANGGAL</th>
			<th>(Rp)</th>

			<th>NOMOR</th>
			<th>TANGGAL</th>
			<th>KURANG BAYAR / LEBIH BAYAR (Rp)</th>
		</tr>
	';
	
	$dbConn = new clsDBConnSIKP();
	$whereClause= " WHERE ";
	$whereClause.=" (trunc(a.verification_date) BETWEEN '".$param_arr['date_start']."'";
	$whereClause.=" AND '".$param_arr['date_end']."')";
	if ($param_arr['object_p_region_id_kec']!=''){
		$whereClause.=" AND object_p_region_id_kec = ".$param_arr['object_p_region_id_kec'];
	}
	
	$query="SELECT a.*, to_char(a.creation_date,'yyyy-mm-dd') AS tgl_bphtb, b.order_no, kelurahan_wp.region_name AS kelurahan_wp_name, kecamatan_wp.region_name AS kecamatan_wp_name,
			kelurahan_op.region_name AS kelurahan_op_name, kecamatan_op.region_name AS kecamatan_op_name,
			doc_type.description AS nama_dokumen, c.receipt_no,to_char(c.payment_date,'yyyy-mm-dd') AS tgl_bayar,
			c.payment_amount

			FROM t_bphtb_registration AS a
			LEFT JOIN t_customer_order AS b ON a.t_customer_order_id = b.t_customer_order_id
			LEFT JOIN p_region AS kelurahan_wp ON a.wp_p_region_id_kel = kelurahan_wp.p_region_id
			LEFT JOIN p_region AS kecamatan_wp ON a.wp_p_region_id_kec = kecamatan_wp.p_region_id
			LEFT JOIN p_region AS kelurahan_op ON a.object_p_region_id_kel = kelurahan_op.p_region_id
			LEFT JOIN p_region AS kecamatan_op ON a.object_p_region_id_kec = kecamatan_op.p_region_id
			LEFT JOIN p_bphtb_legal_doc_type AS doc_type ON a.p_bphtb_legal_doc_type_id = doc_type.p_bphtb_legal_doc_type_id
			left join t_payment_receipt_bphtb as c on a.t_bphtb_registration_id = c.t_bphtb_registration_id";
	$query.= $whereClause;
	$query.= " ORDER BY a.wp_name ASC";

	$dbConn->query($query);
	
	
	$no = 1;
	while($dbConn->next_record()){
		$item = array(
						   'tgl_bphtb' => $dbConn->f("tgl_bphtb"), 
						   'order_no' => $dbConn->f("order_no"), 	
						   'registration_no' => $dbConn->f("registration_no"), 	
						   'wp_name' => $dbConn->f("wp_name"), 	
						   'npwp' => $dbConn->f("npwp"),
						   'wp_address_name' => $dbConn->f("wp_address_name"),
						   'wp_rt' => $dbConn->f("wp_rt"),
						   'wp_rw' => $dbConn->f("wp_rw"),
						   'kelurahan_wp_name' => $dbConn->f("kelurahan_wp_name"),
						   'kecamatan_wp_name' => $dbConn->f("kecamatan_wp_name"),
						   'phone_no' => $dbConn->f("phone_no"),
						   'mobile_phone_no' => $dbConn->f("mobile_phone_no"),
						   'njop_pbb' => $dbConn->f("njop_pbb"),
						   'object_address_name' => $dbConn->f("object_address_name"),
						   'object_rt' => $dbConn->f("object_rt"),
						   'object_rw' => $dbConn->f("object_rw"),
						   'kelurahan_op_name' => $dbConn->f("kelurahan_op_name"),
						   'kecamatan_op_name' => $dbConn->f("kecamatan_op_name"),
						   'nama_dokumen' => $dbConn->f("nama_dokumen"),
						   'land_area' => $dbConn->f("land_area"),
						   'land_price_per_m' => $dbConn->f("land_price_per_m"),
						   'land_total_price' => $dbConn->f("land_total_price"),
						   'building_area' => $dbConn->f("building_area"),
						   'building_price_per_m' => $dbConn->f("building_price_per_m"),
						   'building_total_price' => $dbConn->f("building_total_price"),
						   'market_price' => $dbConn->f("market_price"),
						   'npop' => $dbConn->f("npop"),
						   'npop_tkp' => $dbConn->f("npop_tkp"),
						   'npop_kp' => $dbConn->f("npop_kp"),
						   'bphtb_amt' => $dbConn->f("bphtb_amt"),
						   'bphtb_discount' => $dbConn->f("bphtb_discount"),
						   'bphtb_amt_final' => $dbConn->f("bphtb_amt_final"),
						   'description' => $dbConn->f("description"),
						   'creation_date' => $dbConn->f("creation_date"),
						   'created_by' => $dbConn->f("created_by"),
						   'updated_date' => $dbConn->f("updated_date"),
						   'updated_by' => $dbConn->f("updated_by"),
						   'verificated_by' => $dbConn->f("verificated_by"),
						   'receipt_no' => $dbConn->f("receipt_no"),
						   'tgl_bayar' => $dbConn->f("tgl_bayar"),
						   'payment_amount' => $dbConn->f("payment_amount"),
						   'verificated_nip' => $dbConn->f("verificated_nip")
						);

		echo '<tr>';
		echo '<td align="center">'.$no++.'</td>';
		echo '<td align="left">'.$item['wp_name'].'</td>';
		echo '<td align="left">'.$item['wp_address_name'].'</td>';
		echo '<td align="left">'.$item['kelurahan_wp_name'].'</td>';
		echo '<td align="left">'.$item['kecamatan_wp_name'].'</td>';
		echo '<td align="left">'.$item['nama_dokumen'].'</td>';
		echo '<td align="left">&nbsp;'.$item['njop_pbb'].'</td>';
		echo '<td align="left">'.$item['object_address_name'].'</td>';
		echo '<td align="right">'.number_format($item['land_area'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['building_area'],0,",",".").'</td>';	
		echo '<td align="right">'.number_format($item['land_price_per_m'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['building_price_per_m'],0,",",".").'</td>';	
		echo '<td align="right">'.number_format($item['land_total_price']+$item['building_total_price'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['market_price'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['bphtb_amt_final'],0,",",".").'</td>';
		echo '<td align="left">'.$item['registration_no'].'</td>';
		echo '<td align="left">'.$item['tgl_bphtb'].'</td>';
		echo '<td align="right">'.number_format($item['bphtb_amt_final'],0,",",".").'</td>';
		echo '<td align="left">'.$item['receipt_no'].'</td>';
		echo '<td align="left">'.$item['tgl_bayar'].'</td>';
		echo '<td align="right">'.number_format($item['payment_amount'],0,",",".").'</td>';
		echo '<td align="left">&nbsp;'.$item['order_no'].'</td>';
		echo '<td align="left">'.$item['tgl_bayar'].'</td>';
		if ($item['receipt_no']==''){
			echo '<td align="right">'.number_format(0,0,",",".").'</td>';
		}else{
			echo '<td align="right">'.number_format($item['bphtb_amt_final']-$item['payment_amount'],0,",",".").'</td>';
		}
		echo '<td align="left">'.$item['description'].'</td>';
		echo '</tr>';
	
	}
	
	echo '</table>';
	exit;
}
?>

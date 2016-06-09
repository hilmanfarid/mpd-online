<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-83C61F57
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_penerimaan_bphtb; //Compatibility
	global $Label1;
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
	$type_cetak = CCGetFromGet('cetak_laporan');
	
	$param_arr=array();
	if(empty($param_arr['date_start'])){
		$param_arr['date_start']= CCGetFromGet('date_start');
	}
	if(empty($param_arr['date_end'])){
		$param_arr['date_end']= CCGetFromGet('date_end');
	}

	$param_arr['receipt_no'] = CCGetFromGet('receipt_no');
	$param_arr['njop_pbb'] = CCGetFromGet('njop_pbb');
	$param_arr['wp_name'] = CCGetFromGet('wp_name');
	$param_arr['p_region_id_kecamatan'] = CCGetFromGet('p_region_id_kecamatan');
	$param_arr['p_region_id_kelurahan'] = CCGetFromGet('p_region_id_kelurahan');
	$param_arr['p_bphtb_legal_doc_type_id'] = CCGetFromGet('p_bphtb_legal_doc_type_id',0);
	if($type_cetak == 'excel') {
		print_laporan($param_arr);
	}else{
		$Label1->SetText(print_laporan($param_arr));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function print_laporan($param_arr) {
	$type_cetak = CCGetFromGet('cetak_laporan');
	if($type_cetak == 'excel') {
		startExcel("laporan_penerimaan_bpthb");
	}
	$output = "";

	$description="";
	if ($param_arr['p_bphtb_legal_doc_type_id']!=0){
		$dbConn = new clsDBConnSIKP();
		$query="SELECT * from p_bphtb_legal_doc_type 
				where p_bphtb_legal_doc_type_id = ".$param_arr['p_bphtb_legal_doc_type_id'];;
		$dbConn->query($query);
		$dbConn->next_record();
		$description = "(".$dbConn->f("description").")";	
	}

	$output .= "<div><h3>DAFTAR REKAPITULASI PERMOHONAN PENGURANGAN PEMBAYARAN BPHTB ".$description."</h3></div>";	
	$output .= "<div><h3>TANGGAL : ".dateToString($param_arr['date_start'], true)." s/d ".dateToString($param_arr['date_end'], true)."</h3></div>";	

	$output .= '<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="2px"> ';
	$output .= '<tr>
			<th>No</th>
			<th>Nama Pemohon</th>
			<th>Alamat</th> 
			<th>NOP PBB</th>
			<th>Letak Tanah dan Bangunan</th>
			<th>Akta/Risalah Lelang/Kep. Pemberian Hak/Dokumen lainnya</th>
			<th>NJOP (Rp)</th>
			<th>BPHTB TERHUTANG (Rp)</th>
			<th>PENGURANGAN (Rp)</th>
			<th>TANGGAL MENGAJUKAN PERMOHONAN</th> 
	  </tr>
	 ';

	 $dbConn = new clsDBConnSIKP();
	 $whereClause='';
	 $criteria = array();
	 
	 if(!empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$criteria[] = " (trunc(b.creation_date) BETWEEN '".$param_arr['date_start']."' AND '".$param_arr['date_end']."') ";

	}else if(!empty($param_arr['date_start'])&&empty($param_arr['date_end'])){
		$criteria[] = " trunc(b.creation_date) >= '".$param_arr['date_start']."' ";

	}else if(empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$criteria[] = " trunc(b.creation_date) <= '".$param_arr['date_end']."' ";
	}

	if(!empty($param_arr['receipt_no'])) {
		$criteria[] = " a.receipt_no ILIKE '%".$param_arr['receipt_no']."%' ";
	}

	if(!empty($param_arr['njop_pbb'])) {
		$criteria[] = " b.njop_pbb = '".$param_arr['njop_pbb']."' ";
	}

	if(!empty($param_arr['wp_name'])) {
		$criteria[] = " b.wp_name ILIKE '%".$param_arr['wp_name']."%' ";
	}


	if(!empty($param_arr['p_region_id_kecamatan'])) {
		$criteria[] = " b.wp_p_region_id_kec = ".$param_arr['p_region_id_kecamatan'];
	}
	
	if(!empty($param_arr['p_region_id_kelurahan'])) {
		$criteria[] = " b.wp_p_region_id_kel = ".$param_arr['p_region_id_kelurahan'];
	}

	if($param_arr['p_bphtb_legal_doc_type_id'] != 0) {
		$criteria[] = " b.p_bphtb_legal_doc_type_id = ".$param_arr['p_bphtb_legal_doc_type_id'];
	}
	
	$criteria[] = " pengurangan.t_bphtb_exemption_id is not null ";	

	$whereClause = join(" AND ", $criteria);
	$query="SELECT pengurangan.updated_by,a.receipt_no, b.njop_pbb, 
					to_char(a.payment_date, 'YYYY-MM-DD') AS payment_date, 
					to_char(b.creation_date, 'YYYY-MM-DD') AS creation_date, b.t_ppat_id,
					b.wp_name, b.wp_address_name, kelurahan.region_name AS kelurahan_name, 
					kecamatan.region_name AS kecamatan_name, kota.region_name AS kota_name, 
					b.object_address_name, object_kelurahan.region_name AS object_kelurahan_name, 
					object_kecamatan.region_name AS object_kecamatan_name, 
					object_kota.region_name AS object_kota_name, b.land_area, 
					b.building_area, b.land_total_price, a.payment_amount, b.verificated_by ,
					pengurangan.keterangan_opsi_c,(building_total_price+land_total_price) as njop,
					b.bphtb_amt_final, b.bphtb_discount
					FROM t_bphtb_registration AS b
			LEFT JOIN t_payment_receipt_bphtb AS a ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
			LEFT JOIN p_region AS kelurahan ON b.wp_p_region_id_kel = kelurahan.p_region_id
			LEFT JOIN p_region AS kecamatan ON b.wp_p_region_id_kec = kecamatan.p_region_id
			LEFT JOIN p_region AS kota ON b.wp_p_region_id = kota.p_region_id
			LEFT JOIN p_region AS object_kelurahan ON b.object_p_region_id_kel = object_kelurahan.p_region_id
			LEFT JOIN p_region AS object_kecamatan ON b.object_p_region_id_kec = object_kecamatan.p_region_id
			LEFT JOIN p_region AS object_kota ON b.object_p_region_id = object_kota.p_region_id
			LEFT JOIN t_bphtb_exemption AS pengurangan ON b.t_bphtb_registration_id = pengurangan.t_bphtb_registration_id";
	if(!empty($whereClause))
		$query.= " WHERE ".$whereClause;
	$query.= " ORDER BY b.creation_date ASC";

	//print_r($query); exit;
	$dbConn->query($query);
	$items = array();
	$total_njop = 0;
	$total_bphtb_amt_final = 0;
	$total_bphtb_discount = 0;
	$no = 1;

	while($dbConn->next_record()){
		$items[]= $item = array(
					   'receipt_no' => $dbConn->f("receipt_no"), 	
					   'njop_pbb' => $dbConn->f("njop_pbb"),
					   'payment_date' => $dbConn->f("payment_date"),
					   'creation_date' => $dbConn->f("creation_date"),
					   'wp_name' => $dbConn->f("wp_name"),
					   'wp_address_name' => $dbConn->f("wp_address_name"),
					   'kelurahan_name' => $dbConn->f("kelurahan_name"),
					   'kecamatan_name' => $dbConn->f("kecamatan_name"),
					   'land_area' => $dbConn->f("land_area"),
					   'building_area' => $dbConn->f("building_area"),
					   'land_total_price' => $dbConn->f("land_total_price"),
					   'payment_amount' => $dbConn->f("payment_amount"),
					   'verificated_by' => $dbConn->f("verificated_by"),
					   'updated_by' => $dbConn->f("updated_by"),
					   'kota_name' => $dbConn->f("kota_name"),
					   'object_address_name' => $dbConn->f("object_address_name"),
					   'object_kelurahan_name' => $dbConn->f("object_kelurahan_name"),
					   'object_kecamatan_name' => $dbConn->f("object_kecamatan_name"),
					   'object_kota_name' => $dbConn->f("object_kota_name"),
					   'keterangan_opsi_c' => $dbConn->f("keterangan_opsi_c"),
					   'njop' => $dbConn->f("njop"),
					   'bphtb_amt_final' => $dbConn->f("bphtb_amt_final"),
					   'bphtb_discount' => $dbConn->f("bphtb_discount"),
					   't_ppat_id' => $dbConn->f("t_ppat_id")
						);
		
		$status_daftar = empty($item['t_ppat_id']) ? "Tidak" : "Ya";

		$output .= '<tr>';
		$output .= '<td align="center">'.$no.'</td>';
		$output .= '<td align="left">'.trim(strtoupper($item['wp_name'])).'</td>';
		$output .= '<td align="left">'.$item['wp_address_name'].'<br>
						Kel. '.$item['kelurahan_name'].'<br>
						Kec. '.$item['kecamatan_name'].'<br>
						'.$item['kota_name'].'</td>';
		$output .= '<td align="left">&nbsp;'.$item['njop_pbb'].'</td>'; 
		$output .= '<td align="left">'.$item['object_address_name'].'<br>
						Kel. '.$item['object_kelurahan_name'].'<br>
						Kec. '.$item['object_kecamatan_name'].'<br>
						'.$item['object_kota_name'].'</td>';
		$output .= '<td align="left">'.$item['keterangan_opsi_c'].'</td>';

		$output .= '<td align="right">'.number_format($item['njop'],0,",",".").'</td>';
		$output .= '<td align="right">'.number_format($item['bphtb_amt_final'],0,",",".").'</td>';
		$output .= '<td align="right">'.number_format($item['bphtb_discount'],0,",",".").'</td>';

		$output .= '<td align="center">'.dateToString($item['creation_date']).'</td>';
		$output .= '</tr>';
		
		$total_njop += $item['njop'];
		$total_bphtb_amt_final += $item['bphtb_amt_final'];
		$total_bphtb_discount += $item['bphtb_discount'];
		$no++;
	}

	$output .= '<tr>
			<td colspan="6" align="center"> <b>TOTAL</b> </td>
			<td align="right"><b>'.number_format($total_njop,0,",",".").'</b></td>
			<td align="right"><b>'.number_format($total_bphtb_amt_final,0,",",".").'</b></td>
			<td align="right"><b>'.number_format($total_bphtb_discount,0,",",".").'</b></td>
			<td align="center"> &nbsp; </td>
		 </tr>';
	$output .= '</table>';
	if($type_cetak == 'excel') {
		$output .= '<table border=0>';
			$output .= '<tr>';
			$output .= '</tr>';
			$output .= '<tr>';
				$output .= '<td colspan =6></td>';
				$output .= '<td align="center">Bandung, </td>';
			$output .= '</tr>';
			$output .= '<tr>';
				$output .= '<td colspan =2></td>';

				$output .= '<td align="center" >Kepala Seksi<br>Penyelesaian Piutang <br><br><br><br>';
				$output .= 'DIN KAMADIANTINI, S.IP., M.M <br>';
				$output .= 'NIP. 19710320 1999803 2 006';
				$output .= '</td>';

				$output .= '<td colspan =3></td>';

				$output .= '<td align="center" colspan=2>Petugas Administrasi<br>Pengurangan BPHTB<br><br><br><br>';
				$output .= 'E. GANDA PERMANA K. SH. M.Si.<br>';
				$output .= 'NIP. 19740304 200604 1 017';
				$output .= '</td>';

			$output .= '</tr>';

			$output .= '<tr>';
				$output .= '<td colspan =4></td>';
				$output .= '<td align="center" colspan=2>Mengetahui<br>Kepala Bidang Pajak Pendaftaran<br><br><br><br>';
				$output .= 'Drs. GUN GUN SUMARYANA<br>Pembina<br>';
				$output .= 'NIP. 19700806 199101 1 001';
				$output .= '</td>';
			$output .= '</tr>';
		$output .= '</table>';
		echo $output; exit;
	}else{
		return $output;
	}
}

function dateToString($date, $complete = false){
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
	if(!$complete)
		return $pieces[2].'/'.$pieces[1].'/'.$pieces[0];
	else
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

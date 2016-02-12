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
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
	$type_cetak = CCGetFromGet('cetak_laporan');
	
	if($type_cetak == 'excel') {
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

		print_excel($param_arr);

	}else if($t_laporan_penerimaan_bphtb->cetak_laporan->GetValue()=='T'){
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

		print_laporan($param_arr);
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function print_excel($param_arr) {
	
	startExcel("laporan_penerimaan_bpthb");

	$description="";
	if ($param_arr['p_bphtb_legal_doc_type_id']!=0){
		$dbConn = new clsDBConnSIKP();
		$query="SELECT * from p_bphtb_legal_doc_type 
				where p_bphtb_legal_doc_type_id = ".$param_arr['p_bphtb_legal_doc_type_id'];;
		$dbConn->query($query);
		$dbConn->next_record();
		$description = "(".$dbConn->f("description").")";	
	}

	echo "<div><h3> LAPORAN PENERIMAAN BPHTB PENGURANGAN ".$description."</h3></div>";	
	echo "<div><h3>TANGGAL : ".dateToString($param_arr['date_start'], true)." s/d ".dateToString($param_arr['date_end'], true)."</h3></div>";	

	echo '<table border="1" width="100%"> ';
	echo '<tr> 
			<th>NO</th>
			<th>NO TRANSAKSI</th>
			<th>NOP</th>
			<th>TGL BAYAR</th>
			<th>TGL DAFTAR</th>
			<th>NAMA</th>
			<th>ALAMAT</th>
			<th>KELURAHAN</th>
			<th>KECAMATAN</th>
			<th>LUAS TNH</th>
			<th>LUAS BGN</th>
			<th>NJOP (Rp)</th>
			<th>TOTAL BAYAR (Rp)</th>
			<th>VERIFIKATOR</th>
			<th>PETUGAS INPUT</th>
	  </tr>
	 ';

	 $dbConn = new clsDBConnSIKP();
	 $whereClause='';
	 $criteria = array();
	 
	 if(!empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$criteria[] = " (trunc(a.payment_date) BETWEEN '".$param_arr['date_start']."' AND '".$param_arr['date_end']."') ";

	}else if(!empty($param_arr['date_start'])&&empty($param_arr['date_end'])){
		$criteria[] = " trunc(a.payment_date) >= '".$param_arr['date_start']."' ";

	}else if(empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$criteria[] = " trunc(a.payment_date) <= '".$param_arr['date_end']."' ";
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
	$query="SELECT pengurangan.updated_by,a.receipt_no, b.njop_pbb, to_char(a.payment_date, 'YYYY-MM-DD') AS payment_date, to_char(b.creation_date, 'YYYY-MM-DD') AS creation_date, b.t_ppat_id,
					b.wp_name, b.wp_address_name, kelurahan.region_name AS kelurahan_name, kecamatan.region_name AS kecamatan_name, b.land_area, b.building_area, b.land_total_price, a.payment_amount, b.verificated_by    
					FROM t_payment_receipt_bphtb AS a
			LEFT JOIN t_bphtb_registration AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
			LEFT JOIN p_region AS kelurahan ON b.wp_p_region_id_kel = kelurahan.p_region_id
			LEFT JOIN p_region AS kecamatan ON b.wp_p_region_id_kec = kecamatan.p_region_id
			LEFT JOIN t_bphtb_exemption AS pengurangan ON b.t_bphtb_registration_id = pengurangan.t_bphtb_registration_id";
	if(!empty($whereClause))
		$query.= " WHERE ".$whereClause;
	$query.= " ORDER BY a.receipt_no ASC";

	//print_r($query);
	//exit;
	$dbConn->query($query);
	$items = array();
	$total_nilai_penerimaan = 0;
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
					   't_ppat_id' => $dbConn->f("t_ppat_id")
						);
		
		$status_daftar = empty($item['t_ppat_id']) ? "Tidak" : "Ya";

		echo '<tr>';
		echo '<td align="center">'.$no.'</td>';
		echo '<td align="center">'.$item['receipt_no'].'</td>';
		echo '<td align="left">&nbsp;'.$item['njop_pbb'].'</td>';
		echo '<td align="center">'.dateToString($item['payment_date']).'</td>';
		echo '<td align="center">'.dateToString($item['creation_date']).'</td>';
		echo '<td align="left">'.trim(strtoupper($item['wp_name'])).'</td>';
		echo '<td align="left">'.$item['wp_address_name'].'</td>';
		echo '<td align="left">'.$item['kelurahan_name'].'</td>';
		echo '<td align="left">'.$item['kecamatan_name'].'</td>';
		echo '<td align="right">'.number_format($item['land_area'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['building_area'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['land_total_price'],0,",",".").'</td>';
		echo '<td align="right">'.number_format($item['payment_amount'],0,",",".").'</td>';
		echo '<td align="center">'.$item['verificated_by'].'</td>';
		echo '<td align="center">'.$item['updated_by'].'</td>';
		echo '</tr>';
		
		$total_nilai_penerimaan += $item['payment_amount'];
		$no++;
	}

	echo '<tr>
			<td colspan="12" align="center"> <b>TOTAL</b> </td>
			<td align="right"><b>'.number_format($total_nilai_penerimaan,0,",",".").'</b></td>
			<td align="center"> &nbsp; </td>
			<td align="center"> &nbsp; </td>
		 </tr>';
	echo '</table>';
	exit;
}


function print_laporan($param_arr){
	include "../include/fpdf17/mc_table.php";
	$_BORDER = 0;
	$_FONT = 'Times';
	$_FONTSIZE = 10;
    $pdf = new PDF_MC_Table();
	$size = $pdf->_getpagesize('Legal');
	$pdf->DefPageSize = $size;
	$pdf->CurPageSize = $size;
    $pdf->AddPage('Landscape', 'Legal');
    $pdf->SetFont('helvetica', '', $_FONTSIZE);
	$pdf->SetRightMargin(5);
	$pdf->SetLeftMargin(9);
	$pdf->SetAutoPageBreak(false,0);
	
	$description="";
	if ($param_arr['p_bphtb_legal_doc_type_id']!=0){
		$dbConn = new clsDBConnSIKP();
		$query="SELECT * from p_bphtb_legal_doc_type 
				where p_bphtb_legal_doc_type_id = ".$param_arr['p_bphtb_legal_doc_type_id'];;
		$dbConn->query($query);
		$dbConn->next_record();
		$description = "(".$dbConn->f("description").")";	
	}

	$pdf->SetFont('helvetica', '',12);
	$pdf->SetWidths(array(200));
	$pdf->ln(1);
    $pdf->RowMultiBorderWithHeight(array("LAPORAN PENERIMAAN BPHTB PENGURANGAN ".$description),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(40,200));
	$pdf->ln(4);
	$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'], true)." s/d ".dateToString($param_arr['date_end'], true)),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	$whereClause='';
	$criteria = array();	

	if(!empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$criteria[] = " (trunc(a.payment_date) BETWEEN '".$param_arr['date_start']."' AND '".$param_arr['date_end']."') ";

	}else if(!empty($param_arr['date_start'])&&empty($param_arr['date_end'])){
		$criteria[] = " trunc(a.payment_date) >= '".$param_arr['date_start']."' ";

	}else if(empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
		$criteria[] = " trunc(a.payment_date) <= '".$param_arr['date_end']."' ";
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
	$query="SELECT pengurangan.updated_by,b.verificated_by,a.receipt_no, b.njop_pbb, to_char(a.payment_date, 'YYYY-MM-DD') AS payment_date, to_char(b.creation_date, 'YYYY-MM-DD') AS creation_date,
					b.wp_name, b.wp_address_name, kelurahan.region_name AS kelurahan_name, kecamatan.region_name AS kecamatan_name, b.land_area, b.building_area, b.land_total_price, a.payment_amount,
					npop,npop_tkp,npop_kp,bphtb_amt,bphtb_discount,bphtb_amt_final
					FROM t_payment_receipt_bphtb AS a
			LEFT JOIN t_bphtb_registration AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
			LEFT JOIN p_region AS kelurahan ON b.wp_p_region_id_kel = kelurahan.p_region_id
			LEFT JOIN p_region AS kecamatan ON b.wp_p_region_id_kec = kecamatan.p_region_id
			LEFT JOIN t_bphtb_exemption AS pengurangan ON b.t_bphtb_registration_id = pengurangan.t_bphtb_registration_id";
	if(!empty($whereClause))
		$query.= " WHERE ".$whereClause;
	$query.= " order by trunc(b.creation_date) ASC, upper(b.wp_name) ASC";

	//print_r($query);
	//exit;
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',9);
	$pdf->ln(2);
	
	/* HEADER */
	$pdf->SetAligns(Array('C','C','C','C','C',
			'C','C','C','C','C',
			'C','C','C','C','C'));
	$pdf->SetWidths(array(6,22,25,15,16,
			20,35,28,28,25,
			25,25,25,25,25));
	$pdf->SetFont('arial', 'B',6);
	$pdf->RowMultiBorderWithHeight(array("NO","NO TRANSAKSI","NOP","TGL BAYAR","TGL DAFTAR",
			"NAMA","ALAMAT","KELURAHAN","KECAMATAN","NPOP",
			"NPOPTKP","NPOPKP","BPHTB TERUTANG","POTONGAN","BPHTB BAYAR"),
			array('LTB','LTB','LTB','LTB','LTB',
			'LTB','LTB','LTB','LTB','LTB',
			'LTB','LTB','LTB','LTB','LTBR'),5);
	/* END HEADER */	

	
	/* CONTENTS */
	$pdf->SetFont('arial', '',6);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','C','C','L','L','L','L','R','R','R','R','R','R'));
	$total_nilai_penerimaan = 0;
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
					   'updated_by' => $dbConn->f("updated_by"),
					   'verificated_by' => $dbConn->f("verificated_by"),
					   'npop' => $dbConn->f("npop"),
					   'npop_tkp' => $dbConn->f("npop_tkp"),
					   'npop_kp' => $dbConn->f("npop_kp"),
					   'bphtb_amt' => $dbConn->f("bphtb_amt"),
					   'bphtb_amt_final' => $dbConn->f("bphtb_amt_final"),
					   'payment_amount' => $dbConn->f("payment_amount")
						);
		$pdf->RowMultiBorderWithHeight(array($no,
											$item['receipt_no'],
											$item['njop_pbb'],
											dateToString($item['payment_date']),
											dateToString($item['creation_date']),
											trim(strtoupper($item['wp_name'])),
											$item['wp_address_name'],
											$item['kelurahan_name'],
											$item['kecamatan_name'],
											number_format($item['npop'],0),
											number_format($item['npop_tkp'],0),
											number_format($item['npop_kp'],0,",","."),
											number_format($item['bphtb_amt'],0,",","."),
											number_format($item['bphtb_discount'],0,",","."),
											number_format($item['payment_amount'],0,",","."),
											),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
		
		$total_nilai_penerimaan += $item['payment_amount'];
		$no++;
	}
	/* END CONTENTS */
	

	/* BOTTOM */
	$pdf->SetWidths(array(6+22+25+15+16+
			20+35+28+28+25+
			25+25+25+25,25));
	$pdf->SetAligns(Array('C','R'));
	$pdf->SetFont('arial', 'B',8);
	$pdf->RowMultiBorderWithHeight(array("TOTAL", number_format($total_nilai_penerimaan,0,",",".")), array('LB','LBR'), 6);
	/* END BOTTOM */

	$pdf->ln(12);
	
	$pdf->SetAligns(array("C", "C"));
	$pdf->SetWidths(array(169, 163));
	if ($param_arr['date_start']==''){
		$pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Kepala Seksi Penyelesaian Piutang \n\n\n\n\n\n\n\n DIN KAMADIANTINI S.IP, MM \n  ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯ ","\n Admin Penerimaan BPHTB"."\n\n\n\n\n\n\n\n INDRA WISNU, SE. \n ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯ "), array("",""), 4 );
		$pdf->RowMultiBorderWithHeight( array("NIP : 19710320.199803.2.006","NIP : 19731031.2009.1.1001"), array("",""), 1 );
	}else{
		if (date (strtotime($param_arr['date_start'])) < date (strtotime('01-06-2015'))){
			$pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Kepala Seksi Penyelesaian Piutang \n\n\n\n\n\n\n\n RACHMAT SATIADI, S.IP, M.Si \n  ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯ ","\n Admin Penerimaan BPHTB"."\n\n\n\n\n\n\n\n INDRA WISNU, SE. \n ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯ "), array("",""), 4 );
			$pdf->RowMultiBorderWithHeight( array("NIP : 19691104.199803.1.007","NIP : 19731031.2009.1.1001"), array("",""), 1 );
		}else{
			$pdf->RowMultiBorderWithHeight( array("Mengetahui, \n Kepala Seksi Penyelesaian Piutang \n\n\n\n\n\n\n\n DIN KAMADIANTINI S.IP, MM \n  ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯ ","\n Admin Penerimaan BPHTB"."\n\n\n\n\n\n\n\n INDRA WISNU, SE. \n ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯ "), array("",""), 4 );
			$pdf->RowMultiBorderWithHeight( array("NIP : 19710320.199803.2.006","NIP : 19731031.2009.1.1001"), array("",""), 1 );
		}
	}
	$pdf->Output("","I");
	exit;	
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

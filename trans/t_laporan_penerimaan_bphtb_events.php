<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-3CA6B8E9
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_penerimaan_bphtb; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    if($t_laporan_penerimaan_bphtb->cetak_laporan->GetValue()=='T'){
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

		print_laporan($param_arr);
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

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

	$pdf->SetFont('helvetica', '',12);
	$pdf->SetWidths(array(200));
	$pdf->ln(1);
    $pdf->RowMultiBorderWithHeight(array("LAPORAN PENERIMAAN BPHTB "),array('',''),6);
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
	
	$whereClause = join(" AND ", $criteria);
	$query="SELECT a.receipt_no, b.njop_pbb, to_char(a.payment_date, 'YYYY-MM-DD') AS payment_date,
					b.wp_name, b.wp_address_name, kelurahan.region_name AS kelurahan_name, kecamatan.region_name AS kecamatan_name, b.land_area, b.building_area, b.land_total_price, a.payment_amount    
					FROM t_payment_receipt_bphtb AS a
			LEFT JOIN t_bphtb_registration AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
			LEFT JOIN p_region AS kelurahan ON b.wp_p_region_id_kel = kelurahan.p_region_id
			LEFT JOIN p_region AS kecamatan ON b.wp_p_region_id_kec = kecamatan.p_region_id";
	if(!empty($whereClause))
		$query.= " WHERE ".$whereClause;
	$query.= " ORDER BY a.receipt_no ASC";

	//print_r($query);
	//exit;
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',9);
	$pdf->ln(2);
	
	/* HEADER */
	$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C','C'));
	$pdf->SetWidths(array(10,28,35,21,41,51,28,28,21,21,25,28));
	$pdf->SetFont('arial', 'B',7);
	$pdf->RowMultiBorderWithHeight(array("NO","NO TRANSAKSI","NOP","TGL BAYAR","NAMA","ALAMAT","KELURAHAN","KECAMATAN","LUAS TANAH","LUAS BGN","NJOP (Rp)","TOTAL BAYAR (Rp)"),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','TLBR'),5);
	/* END HEADER */	

	
	/* CONTENTS */
	$pdf->SetFont('arial', '',8);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','C','L','L','L','L','R','R','R','R'));
	$total_nilai_penerimaan = 0;
	while($dbConn->next_record()){
		$items[]= $item = array(
					   'receipt_no' => $dbConn->f("receipt_no"), 	
					   'njop_pbb' => $dbConn->f("njop_pbb"),
					   'payment_date' => $dbConn->f("payment_date"),
					   'wp_name' => $dbConn->f("wp_name"),
					   'wp_address_name' => $dbConn->f("wp_address_name"),
					   'kelurahan_name' => $dbConn->f("kelurahan_name"),
					   'kecamatan_name' => $dbConn->f("kecamatan_name"),
					   'land_area' => $dbConn->f("land_area"),
					   'building_area' => $dbConn->f("building_area"),
					   'land_total_price' => $dbConn->f("land_total_price"),
					   'payment_amount' => $dbConn->f("payment_amount")
						);
		$pdf->RowMultiBorderWithHeight(array($no,
											$item['receipt_no'],
											$item['njop_pbb'],
											dateToString($item['payment_date']),
											trim(strtoupper($item['wp_name'])),
											$item['wp_address_name'],
											$item['kelurahan_name'],
											$item['kecamatan_name'],
											number_format($item['land_area'],0),
											number_format($item['building_area'],0),
											number_format($item['land_total_price'],0,",","."),
											number_format($item['payment_amount'],2,",",".")
											),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
		
		$total_nilai_penerimaan += $item['payment_amount'];
		$no++;
	}
	/* END CONTENTS */
	

	/* BOTTOM */
	$pdf->SetWidths(array(309,28));
	$pdf->SetAligns(Array('C','R'));
	$pdf->SetFont('arial', 'B',8);
	$pdf->RowMultiBorderWithHeight(array("TOTAL", number_format($total_nilai_penerimaan,2,",",".")), array('LB','LBR'), 6);
	/* END BOTTOM */

	$pdf->ln(8);
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
?>

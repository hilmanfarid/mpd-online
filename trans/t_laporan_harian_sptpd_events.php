<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-DBAEF739
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_harian_sptpd; //Compatibility
//End Page_BeforeShow

// -------------------------
    // Write your own code here.
    if($t_laporan_harian_sptpd->cetak_laporan->GetValue()=='T'){
		$param_arr=array();
		$param_arr['year_code']=$t_laporan_harian_sptpd->year_code->GetValue();
		$param_arr['year_period_id']=$t_laporan_harian_sptpd->p_year_period_id->GetValue();
		$param_arr['date_start']=$t_laporan_harian_sptpd->date_start_laporan->GetValue();
		$param_arr['date_end']=$t_laporan_harian_sptpd->date_end_laporan->GetValue();
		$param_arr['p_vat_type_id']=$t_laporan_harian_sptpd->p_vat_type_id->GetValue();
		$param_arr['p_vat_type_dtl_id']=$t_laporan_harian_sptpd->p_vat_type_dtl_id->GetValue();
		$param_arr['vat_code_dtl']=$t_laporan_harian_sptpd->vat_code_dtl->GetValue();
		if(empty($param_arr['date_start'])){
			$param_arr['date_start']=$param_arr['year_code'].'-01-01';
		}
		if(empty($param_arr['date_end'])){
			$param_arr['date_end']=$param_arr['year_code'].'-12-31';
		}
		print_laporan($param_arr);
	}
	
// -------------------------


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
    $pdf->RowMultiBorderWithHeight(array("LAPORAN PENCETAKAN HARIAN PENERIMAAN SPTPD"),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(40,200));
	$pdf->ln(4);
	//$pdf->RowMultiBorderWithHeight(array("DAFTAR SPTPD",": ".$param_arr['vat_code_dtl']),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("TAHUN",": ".$param_arr['year_code']),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	/*echo '<pre>';
	print_r($param_arr);
	exit;*/
	if(empty($param_arr['p_vat_type_id'])){
		$param_arr['p_vat_type_id']='null';
	}
	if(!empty($param_arr['p_vat_type_dtl_id'])){
		$query="select *,to_char(start_period, 'DD-MM-YYYY') as start_period_formated,to_char(end_period, 'DD-MM-YYYY') as end_period_formated,to_char(tanggal, 'DD-MM-YYYY') as date_settle_formated from sikp.f_laporan_harian_sptpd(1,".$param_arr['year_code'].",'".$param_arr['date_start']."', '".$param_arr['date_end']."',".$param_arr['p_vat_type_dtl_id'].") ORDER BY tanggal, jenis ASC";
	}else{
		$query="select *,to_char(start_period, 'DD-MM-YYYY') as start_period_formated,to_char(end_period, 'DD-MM-YYYY') as end_period_formated,to_char(tanggal, 'DD-MM-YYYY') as date_settle_formated from sikp.f_laporan_harian_sptpd(".$param_arr['p_vat_type_id'].",2001,'".$param_arr['date_start']."', '".$param_arr['date_end']."') ORDER BY tanggal, jenis ASC";
	}
	
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',10);
	$pdf->ln(2);
	$pdf->SetWidths(array(10,22,28,40,40,28,22,42,27,40,40));
	$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
	if(!empty($param_arr['p_vat_type_dtl_id'])){
		$pdf->RowMultiBorderWithHeight(array("NO","TANGGAL","NO. URUT","NAMA","ALAMAT","NPWPD","KOHIR","MASA PAJAK","JENIS","OMZET","KETETAPAN"),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),6);
	}else{
		$pdf->RowMultiBorderWithHeight(array("NO","TANGGAL","AYAT PAJAK","NAMA","ALAMAT","NPWPD","KOHIR","MASA PAJAK","JENIS","OMZET","KETETAPAN"),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),6);
	}
	$pdf->SetFont('helvetica', '',10);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','L','L','L','L','C','L','R','R'));
	$jumlah_omzet = 0;
	$jumlah_ketetapan = 0;
	while($dbConn->next_record()){
		$start_period = $dbConn->f("start_period_formated");
		$end_period = $dbConn->f("end_period_formated");
		$date_settle = $dbConn->f("date_settle_formated");
		$items[]= $item = array('tanggal' => $date_settle,
					   'no_order' => $dbConn->f("no_order"),
					   'nama' => $dbConn->f("nama"),
					   'alamat' => $dbConn->f("alamat"),
					   'npwpd' => $dbConn->f("npwpd"),
					   'omzet' => $dbConn->f("omzet"),
					   'ketetapan' => $dbConn->f("ketetapan"),
					   'kohir' => $dbConn->f("kohir"),
					   'start_period' => $start_period,
					   'end_period' => $end_period,
					   'jenis_pajak' => $dbConn->f("jenis"),
					   'jenis_pajak_dtl' => $dbConn->f("jenis_dtl"),
					   'ayat_code' => $dbConn->f("ayat_code"),
					   'ayat_code_dtl' => $dbConn->f("ayat_code_dtl")
						);
		if(!empty($param_arr['p_vat_type_dtl_id'])){
			$pdf->RowMultiBorderWithHeight(array($no,$item['tanggal'],$item['no_order'],$item['nama'],$item['alamat'],$item['npwpd'], 2, ',', '.'),$item['kohir'],$item['start_period'].' - '.$item['end_period'],$item['jenis_pajak'],'Rp '.number_format($item['omzet'], 2, ',', '.'),'Rp '.number_format($item['ketetapan']),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);			
		}else{
			$pdf->RowMultiBorderWithHeight(array($no,$item['tanggal'],$item['ayat_code'].'.'.$item['ayat_code_dtl'],$item['nama'],$item['alamat'],$item['npwpd'],$item['kohir'],$item['start_period'].' - '.$item['end_period'],$item['jenis_pajak'],'Rp '.number_format($item['omzet'], 2, ',', '.'),'Rp '.number_format($item['ketetapan'], 2, ',', '.')),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
		}
		$jumlah_omzet += $dbConn->f("omzet");
		$jumlah_ketetapan += $dbConn->f("ketetapan");
		$no++;
	}
	$pdf->SetWidths(array(259,40,40));
	$pdf->SetAligns(Array('C','R','R'));
	$pdf->RowMultiBorderWithHeight(array('JUMLAH', 'Rp ' . number_format($jumlah_omzet, 2, ',', '.'), 'Rp ' . number_format($jumlah_ketetapan, 2, ',', '.')),array('LB','LB','LBR'),6);
	$pdf->Output("","I");
	echo 'tes';
	exit;	
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
	
	return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
}

?>

<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-8D135F5B
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_harian_denda; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
    if($t_laporan_harian_denda->cetak_laporan->GetValue()=='T'){
		$param_arr=array();
		$param_arr['year_code']=$t_laporan_harian_denda->year_code->GetValue();
		$param_arr['year_period_id']=$t_laporan_harian_denda->p_year_period_id->GetValue();
		$param_arr['date_start']=$t_laporan_harian_denda->date_start_laporan->GetValue();
		$param_arr['date_end']=$t_laporan_harian_denda->date_end_laporan->GetValue();
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
		if(empty($param_arr['date_start'])){
			$param_arr['date_start']=$param_arr['year_code'].'-01-01';
		}
		if(empty($param_arr['date_end'])){
			$param_arr['date_end']=$param_arr['year_code'].'-12-31';
		}
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
    $pdf->RowMultiBorderWithHeight(array("Laporan penerimaan"),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(40,200));
	$pdf->ln(4);
	$pdf->RowMultiBorderWithHeight(array("DAFTAR SPTPD",": "),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("TAHUN",": ".$param_arr['year_code']),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	
	//$query="select * from sikp.f_laporan_harian_denda(1,".$param_arr['year_code'].",'".$param_arr['date_start']."', '".$param_arr['date_end']."')";
	$query="select 
	nama,
	alamat,
	npwpd,
	to_char(trunc(start_period), 'DD-MM-YYYY') AS start_period_formated,
	to_char(trunc(end_period), 'DD-MM-YYYY') AS end_period_formated,
	no_kohir,
	to_char(trunc(tgl_masuk), 'DD-MM-YYYY') AS tgl_masuk_formated,
	to_char(trunc(jatuh_tempo), 'DD-MM-YYYY') AS jatuh_tempo_formated,
	to_char(trunc(tgl_bayar), 'DD-MM-YYYY') AS tgl_bayar_formated,
	sum(skpdkb_amount) as skpdkb_amount,
	to_char(trunc(skpdkb_tgl_tap), 'DD-MM-YYYY') AS skpdkb_tgl_tap_formated,
	to_char(trunc(skpdkb_tgl_bayar), 'DD-MM-YYYY') AS skpdkb_tgl_bayar_formated,
	sum(denda_amount) as denda_amount,
	to_char(trunc(denda_tgl_tap), 'DD-MM-YYYY') AS denda_tgl_tap_formated,
	to_char(trunc(denda_tgl_bayar), 'DD-MM-YYYY') AS denda_tgl_bayar_formated,
	sum(sptpd_amount) as sptpd_amount
from sikp.f_laporan_harian_denda(".$param_arr['p_vat_type_id'].",2014,'".$param_arr['date_start']."','".$param_arr['date_end']."')	
GROUP BY
	nama,
	alamat,
	npwpd,
	trunc(start_period),
	trunc(end_period),
	no_kohir,
	trunc(tgl_masuk),
	trunc(jatuh_tempo),
	trunc(tgl_bayar),
	trunc(skpdkb_tgl_tap),
	trunc(skpdkb_tgl_bayar),
	trunc(denda_tgl_tap),
	trunc(denda_tgl_bayar)
ORDER BY nama,trunc(start_period) ASC";
	
	/*"select *, 
	to_char(start_period, 'DD-MM-YYYY') AS start_period_formated,
	to_char(end_period, 'DD-MM-YYYY') AS end_period_formated,
	to_char(tgl_masuk, 'DD-MM-YYYY') AS tgl_masuk_formated,
	to_char(jatuh_tempo, 'DD-MM-YYYY') AS jatuh_tempo_formated,
	to_char(tgl_bayar, 'DD-MM-YYYY') AS tgl_bayar_formated,
	to_char(skpdkb_tgl_tap, 'DD-MM-YYYY') AS skpdkb_tgl_tap_formated,
	to_char(skpdkb_tgl_bayar, 'DD-MM-YYYY') AS skpdkb_tgl_bayar_formated,
	to_char(denda_tgl_tap, 'DD-MM-YYYY') AS denda_tgl_tap_formated,
	to_char(denda_tgl_bayar, 'DD-MM-YYYY') AS denda_tgl_bayar_formated from sikp.f_laporan_harian_denda(1,2014,'1-1-2014','30-12-2014')";
	*/
	echo $query;
	exit;
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('arial', '',8);
	$pdf->ln(2);
	$pdf->SetWidths(array(10,24,20,15,37,18,18,19,22,19,61,61,17));
	$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
	$pdf->RowMultiBorderWithHeight(array("","","","","","","","","","","","",""),array('LT','LT','LT','LT','LT','LT','LT','LT','LT','LT','LT','LT','LTR'),6);
	$pdf->RowMultiBorderWithHeight(array("","","","","","","","","","","SKPDKB","DENDA","JUMLAH"),array('L','L','L','L','L','L','L','L','L','L','L','L','LR'),4);
	$pdf->RowMultiBorderWithHeight(array("NO","NAMA","ALAMAT","NPWPD","MASA PAJAK","NO KOHIR","BESARNYA","TGL MASUK","JATUH TEMPO","TGL BAYAR","","",""),array('L','L','L','L','L','L','L','L','L','L','L','L','LR'),4);
	$pdf->SetWidths(array(10,24,20,15,37,18,18,19,22,19,16,15,14,16,16,15,14,16,17));
	$pdf->SetFont('arial', '',7);
	$pdf->RowMultiBorderWithHeight(array("","","","","","","","","","","BESARNYA","NO KOHIR","TGL TAP","TGL BAYAR","BESARNYA","NO KOHIR","TGL TAP","TGL BAYAR",""),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','TLB','TLB','TLB','TLB','TLB','TLB','TLB','TLBR'),9);
	$pdf->SetFont('arial', '',8);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','L','L','L','L','L','L','L','L'));
	$jumlah =0;
	$jumlah=0;
	$total_skpdkb=0;
	$total_sptpd=0;
	$total_denda=0;
	while($dbConn->next_record()){
		$items[]= $item = array('nama' => $dbConn->f("nama"),
					   'alamat' => $dbConn->f("alamat"),
					   'npwpd' => $dbConn->f("npwpd"),
					   'start_period' => $dbConn->f("start_period_formated"),
					   'end_period' => $dbConn->f("end_period_formated"),
					   'no_kohir' => $dbConn->f("no_kohir"),
					   'tgl_masuk' => $dbConn->f("tgl_masuk_formated"),
					   'jatuh_tempo' => $dbConn->f("jatuh_tempo_formated"),
					   'tgl_bayar' => $dbConn->f("tgl_bayar_formated"),
					   'skpdkb_amount' => $dbConn->f("skpdkb_amount"),
					   'skpdkb_no_kohir' => $dbConn->f("skpdkb_no_kohir"),
					   'skpdkb_tgl_tap' => $dbConn->f("skpdkb_tgl_tap_formated"),
					   'skpdkb_tgl_bayar' => $dbConn->f("skpdkb_tgl_bayar_formated"),
					   'denda_amount' => $dbConn->f("denda_amount"),
					   'denda_no_kohir' => $dbConn->f("denda_no_kohir"),
					   'denda_tgl_tap' => $dbConn->f("denda_tgl_tap_formated"),
					   'denda_tgl_bayar' => $dbConn->f("denda_tgl_bayar_formated"),
					   'sptpd_amount' => $dbConn->f("sptpd_amount")
						);
		//$pdf->RowMultiBorderWithHeight(array($no,$item['tanggal'],$item['no_order'],$item['nama'],$item['alamat'],$item['npwpd'],'Rp. '.number_format($item['omzet'], 2, ',', '.'),'Rp. '.number_format($item['ketetapan'], 2, ',', '.'),$item['kohir'],$item['start_period'].' - '.$item['end_period'],$item['jenis_pajak']),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);			
		//if(){
		$jumlah = $item['skpdkb_amount']+$item['denda_amount']+$item['sptpd_amount'];
			$pdf->RowMultiBorderWithHeight(array($no,$item['nama'],$item['alamat'],$item['npwpd'],$item['start_period']." s/d ".$item['end_period'],$item['no_kohir'],'Rp. '.number_format($item['sptpd_amount'], 2, ',', '.'),$item['tgl_masuk'],$item['jatuh_tempo'],$item['tgl_bayar'],'Rp. '.number_format($item['skpdkb_amount'], 2, ',', '.'),$item['skpdkb_no_kohir'],$item['skpdkb_tgl_tap'],$item['skpdkb_tgl_bayar'],'Rp. '.number_format($item['denda_amount'], 2, ',', '.'),$item['denda_no_kohir'],$item['denda_tgl_tap'],$item['denda_tgl_bayar'],'Rp. '.number_format($jumlah, 2, ',', '.')),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','TLB','TLB','TLB','TLB','TLB','TLB','TLB','TLBR'),6);
		
		$total_skpdkb+=$item['skpdkb_amount'];
		$total_sptpd+=$item['denda_amount'];
		$total_denda+=$item['sptpd_amount'];
	//	$jumlah_wp+=$dbConn->f("jumlah_wp");
		$no++;
	}
	$pdf->SetWidths(array(10+24+20+15+37+18,18,19+22+19,16,15+14+16,16,15+14+16+17));
	$pdf->RowMultiBorderWithHeight(array("",'Rp. '.number_format($total_sptpd, 2, ',', '.'),"",'Rp. '.number_format($total_skpdkb, 2, ',', '.'),"",'Rp. '.number_format($total_denda, 2, ',', '.'),""),array('LRTBR','LTBR','LTBR','LTBR','LTBR','LTBR','LTBR'),6);
	$pdf->SetWidths(array(250,70));
	$pdf->ln(8);
	$pdf->RowMultiBorderWithHeight(array("","KASIE VOP"),array('','','','','','',''),6);
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

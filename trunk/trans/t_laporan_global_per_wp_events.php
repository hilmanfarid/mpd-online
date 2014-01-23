<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-E6EA4CB1
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_global_per_wp; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
    if($t_laporan_global_per_wp->cetak_laporan->GetValue()=='T'){
		$param_arr=array();
		//$param_arr['year_code']=$t_laporan_global_per_wp->year_code->GetValue();
		//$param_arr['year_period_id']=$t_laporan_global_per_wp->p_year_period_id->GetValue();
		$param_arr['date_start']=$t_laporan_global_per_wp->date_start_laporan->GetValue();
		$param_arr['date_end']=$t_laporan_global_per_wp->date_end_laporan->GetValue();
		if(empty($param_arr['date_start'])){
			$param_arr['date_start']=$param_arr['year_code'].'-01-01';
		}
		if(empty($param_arr['date_end'])){
			$param_arr['date_end']=$param_arr['year_code'].'-12-31';
		}
		$param_arr['p_rqst_type_id']=$t_laporan_global_per_wp->p_rqst_type_id->GetValue();
		$param_arr['rqst_type_code']=$t_laporan_global_per_wp->rqst_type_code->GetValue();
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
    $pdf->AddPage('Landscape', 'Letter');
    $pdf->SetFont('helvetica', '', $_FONTSIZE);
	$pdf->SetRightMargin(5);
	$pdf->SetLeftMargin(5);
	$pdf->SetAutoPageBreak(false,0);

	$pdf->SetFont('helvetica', '',12);
	$pdf->SetWidths(array(200));
	$pdf->ln(1);
    $pdf->RowMultiBorderWithHeight(array("Penerimaan Global per WP"),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(30,200));
	$pdf->ln(4);
	$pdf->RowMultiBorderWithHeight(array("Jenis Pajak",": ".$param_arr['rqst_type_code']),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array("Tanggal",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	
	$query="select * from sikp.f_laporan_global_wp(".$param_arr['p_rqst_type_id'].",'".$param_arr['date_start']."', '".$param_arr['date_end']."')";
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',8);
	$pdf->ln(2);
	$pdf->SetWidths(array(10,55,60,23,25,18,55,23));
	$pdf->SetAligns(Array('C','C','C','C','C','C','C'));
	$pdf->RowMultiBorderWithHeight(array("NO","NAMA WP","ALAMAT","NPWPD","BESARNYA","JML SSPD","NAMA AYAT","KETERANGAN"),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),6);
	$pdf->SetFont('helvetica', '',8);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','R','R','R','L'));
	$jumlah =0;
	$jumlah=0;
	while($dbConn->next_record()){
		$items[] = array('nama_wp' => $dbConn->f("nama_wp"),
					   'alamat_wp' => $dbConn->f("alamat_wp"),
					   'npwpd' => $dbConn->f("npwpd"),
					   'amount' => $dbConn->f("amount"),
					   'tot_sspd' => $dbConn->f("tot_sspd"),
					   'jenis_pajak' => $dbConn->f("jenis_pajak")
						);
		$pdf->RowMultiBorderWithHeight(array($no,$dbConn->f("nama_wp"),$dbConn->f("alamat_wp"),$dbConn->f("npwpd"),'Rp. '.number_format($dbConn->f("amount"), 2, ',', '.'),$dbConn->f("tot_sspd"),$dbConn->f('jenis_pajak'),''),array('LB','LB','LB','LB','LB','LB','LB','LBR'),6);			
		$jumlah+=$dbConn->f("amount");
		$jumlah_wp+=$dbConn->f("tot_sspd");
		$no++;
	}
	$pdf->SetAligns(Array('C','R','R','R','R','L'));
	$pdf->SetWidths(array(148,25,18));
	$pdf->RowMultiBorderWithHeight(array('Jumlah','Rp. '.number_format($jumlah, 2, ',', '.'),number_format($jumlah_wp, 0, ',', '.')),array('LB','LB','LBR'),6);
	$pdf->SetWidths(array(123,50));
	$pdf->SetAligns('L');
	$pdf->ln(4);
	$pdf->RowMultiBorderWithHeight(array('','KASIE VOP'),array('',''),6);
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

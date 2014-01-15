<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-5EE6560A
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pencetakan_bulanan; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
    if($t_laporan_pencetakan_bulanan->cetak_laporan->GetValue()=='T'){
		$param_arr=array();
		$param_arr['year_code']=$t_laporan_pencetakan_bulanan->year_code->GetValue();
		$param_arr['year_period_id']=$t_laporan_pencetakan_bulanan->p_year_period_id->GetValue();
		$param_arr['date_start']=$t_laporan_pencetakan_bulanan->date_start_laporan->GetValue();
		$param_arr['date_end']=$t_laporan_pencetakan_bulanan->date_end_laporan->GetValue();
		if(empty($param_arr['date_start'])){
			$param_arr['date_start']=($param_arr['year_code']-1).'-12-01';
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
    $pdf->RowMultiBorderWithHeight(array("Laporan pencetakan bulanan penerimaan sptpd"),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(40,200));
	$pdf->ln(4);
	$pdf->RowMultiBorderWithHeight(array("DAFTAR SPTPD",": "),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array("TAHUN",": ".$param_arr['year_code']),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	
	$query="select * from sikp.f_laporan_pencetakan_bulanan(1,".$param_arr['year_code'].",'".$param_arr['date_start']."', '".$param_arr['date_end']."')";
	//print_r($query);
	//exit;
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',9);
	$pdf->ln(2);
	$pdf->SetWidths(array(10,24,20,15,40,18,22,25,20,61,61,27));
	$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
	$pdf->SetWidths(array(10,40,35,15,40,18,18,18,18,18,18,18,18,18,18,18,18));
	$pdf->SetFont('arial', '',7);
	$pdf->RowMultiBorderWithHeight(array("NO","NAMA","ALAMAT","NPWPD","DESEMBER THN SEBELUMNYA","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER"),array('LTB','LTB','LBT','LTB','LTB','LTB','LTB','LTB','LTB','TLB','TLB','TLB','TLB','TLB','TLBR'),9);
	$pdf->SetFont('arial', '',8);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
	$jumlah =0;
	$jumlah=0;
	while($dbConn->next_record()){
		$items[]= $item = array('nama' => $dbConn->f("nama"),
					   'alamat' => $dbConn->f("alamat"),
					   'npwpd' => $dbConn->f("npwpd"),
					   'last_desember' => $dbConn->f("last_desember"),
					   'januari' => $dbConn->f("januari"),
					   'februari' => $dbConn->f("februari"),
					   'maret' => $dbConn->f("maret"),
					   'april' => $dbConn->f("april"),
					   'mei' => $dbConn->f("mei"),
					   'juni' => $dbConn->f("juni"),
					   'juli' => $dbConn->f("juli"),
					   'agustus' => $dbConn->f("agustus"),
					   'september' => $dbConn->f("september"),
					   'oktober' => $dbConn->f("oktober"),
					   'november' => $dbConn->f("november")
						);
		$pdf->RowMultiBorderWithHeight(array($no,$item['nama'],$item['alamat'],$item['npwpd'],$item['last_desember'],$item['januari'],$item['februari'],$item['maret'],$item['april'],$item['mei'],$item['juni'],$item['juli'],$item['agustus'],$item['september'],$item['oktober'],$item['november']),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
		$jumlah+=$dbConn->f("amount");
	//	$jumlah_wp+=$dbConn->f("jumlah_wp");
		$no++;
	}
	print_r($items);
	exit;
	$pdf->SetWidths(array(250,70));
	$pdf->ln(8);
	$pdf->RowMultiBorderWithHeight(array("","KASIE VOP"),array('','','','','','',''),6);
	$pdf->Output("","I");
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

<?php
//BindEvents Method @1-C71A1753
function BindEvents()
{
    global $HistoryGrid;
    global $CCSEvents;
    $HistoryGrid->CCSEvents["BeforeShowRow"] = "HistoryGrid_BeforeShowRow";
    $HistoryGrid->CCSEvents["BeforeSelect"] = "HistoryGrid_BeforeSelect";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//HistoryGrid_BeforeShowRow @29-85406CB0
function HistoryGrid_BeforeShowRow(& $sender)
{
    $HistoryGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeShowRow

//Set Row Style @45-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close HistoryGrid_BeforeShowRow @29-D25D4DF5
    return $HistoryGrid_BeforeShowRow;
}
//End Close HistoryGrid_BeforeShowRow

//HistoryGrid_BeforeSelect @29-63E3CC27
function HistoryGrid_BeforeSelect(& $sender)
{
    $HistoryGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeSelect

//Custom Code @46-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close HistoryGrid_BeforeSelect @29-39569808
    return $HistoryGrid_BeforeSelect;
}
//End Close HistoryGrid_BeforeSelect

//Page_BeforeShow @1-8D88517B
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_per_npwpd; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// -------------------------
    // Write your own code here.
    if($t_laporan_per_npwpd->cetak_laporan->GetValue()=='T'){
		$param_arr=array();
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
    $pdf->RowMultiBorderWithHeight(array("LAPORAN PENCETAKAN PENERIMAAN"),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(40,200));
	$pdf->ln(4);
	//$pdf->RowMultiBorderWithHeight(array("DAFTAR SPTPD",": ".$param_arr['vat_code_dtl']),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("TAHUN",": ".$param_arr['year_code']),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	if(empty($param_arr['p_vat_type_id'])){
		$param_arr['p_vat_type_id']='null';
	}
	if(!empty($param_arr['p_vat_type_dtl_id'])){
		$query="select *,to_char(start_period, 'DD-MM-YYYY') as start_period_formated,to_char(end_period, 'DD-MM-YYYY') as end_period_formated,to_char(tanggal, 'DD-MM-YYYY') as date_settle_formated from sikp.f_laporan_harian_sptpd(1,".$param_arr['year_code'].",'".$param_arr['date_start']."', '".$param_arr['date_end']."',".$param_arr['p_vat_type_dtl_id'].") ORDER BY tanggal, jenis ASC";
	}else{
		$query="select *,to_char(start_period, 'DD-MM-YYYY') as start_period_formated,to_char(end_period, 'DD-MM-YYYY') as end_period_formated,to_char(tanggal, 'DD-MM-YYYY') as date_settle_formated from sikp.f_laporan_harian_sptpd(".$param_arr['p_vat_type_id'].",2001,'".$param_arr['date_start']."', '".$param_arr['date_end']."') ORDER BY trunc(tanggal),ayat_code_dtl, jenis ASC";
	}
	//$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',10);
	$pdf->ln(2);
	$pdf->SetWidths(array(10,80,60,40,50,80));
	$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
	$pdf->RowMultiBorderWithHeight(array("NO","NAMA BADAN ","PERIODE TRANSAKSI","TGL PELAPORAN","TOTAL PAJAK","NO.KWITANSI"),array('LTB','LTB','LTB','LTB','LTBR'),6);
	$pdf->SetFont('helvetica', '',10);
	$no =1;
	$pdf->SetAligns(Array('C','L','L','L','L','L','L','C','L','R','R'));
	$jumlah_omzet = 0;
	$jumlah_ketetapan = 0;
	/*while($dbConn->next_record()){
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
	}*/
	$pdf->SetWidths(array(259,40,40));
	$pdf->SetAligns(Array('C','R','R'));
	$pdf->ln(5);
	$pdf->SetWidtHs(array(239,90));
	$pdf->SetAligns(array("C", "C","C","C","C"));
	//$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. UGAS RAHMANSYAH, SAP, MAP)\n(NIP 19640127 199703 1001)"),array("",""),5);
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

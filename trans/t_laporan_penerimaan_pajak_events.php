<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-C97C84C8
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_penerimaan_pajak; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
    if($t_laporan_penerimaan_pajak->cetak_laporan->GetValue()=='T'){
		$year_code=$t_laporan_penerimaan_pajak->year_code->GetValue();
		$year_period_id=$t_laporan_penerimaan_pajak->p_year_period_id->GetValue();
		$date_start=$t_laporan_penerimaan_pajak->date_start_laporan->GetValue();
		$jenisLaporan = CCGetFromGet('jenisLaporan','pdf');
		if(empty($date_start)){
			$date_start=$year_code.'-01-01';
		}
		$date_end=$t_laporan_penerimaan_pajak->date_end_laporan->GetValue();
		if(empty($date_end)){
			$date_end=$year_code.'-12-31';
		}
		$p_rqst_type_id=$t_laporan_penerimaan_pajak->p_rqst_type_id->GetValue();
		$jenis_tahun=$t_laporan_penerimaan_pajak->jenis_tahun->GetValue();
		$rqst_type_code=$t_laporan_penerimaan_pajak->rqst_type_code->GetValue();
		if($jenisLaporan =='excel'){
			GetCetakExcel($p_rqst_type_id,$year_code,$year_period_id,$date_start,$date_end,$jenis_tahun,$rqst_type_code);
		}
		if($jenisLaporan =='pdf'){
			print_laporan($p_rqst_type_id,$year_code,$year_period_id,$date_start,$date_end,$jenis_tahun,$rqst_type_code);
		} 
	}
	
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function print_laporan($p_rqst_type_id,$year_code,$year_period_id,$date_start,$date_end,$jenis_tahun,$rqst_type_code){
	include "../include/fpdf17/mc_table.php";
	$_BORDER = 0;
	$_FONT = 'Times';
	$_FONTSIZE = 8;
    $pdf = new PDF_MC_Table();
    $pdf->AddPage('Portrait', 'Letter');
    $pdf->SetFont('helvetica', '', $_FONTSIZE);
	$pdf->SetRightMargin(5);
	$pdf->SetLeftMargin(5);
	$pdf->SetAutoPageBreak(false,0);

	$pdf->SetFont('helvetica', '',9);
	$pdf->SetWidths(array(200));
	$pdf->ln(1);
    	if($jenis_tahun=='pajak'){
		$pdf->RowMultiBorderWithHeight(array("Laporan Penerimaan Global per Masa Pajak"),array('',''),6);
	}else if($jenis_tahun=='bayar'){
		$pdf->RowMultiBorderWithHeight(array("Laporan Penerimaan Global per Tanggal / Penerimaan"),array('',''),6);
	}
	//$pdf->ln(8);
	$pdf->SetWidths(array(30,200));
	$pdf->ln(4);
	$pdf->RowMultiBorderWithHeight(array("Jenis Pajak",": ".$rqst_type_code),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("Tahun",": ".$year_code),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array("Tanggal",": ".dateToString($date_start)." s/d ".dateToString($date_end)),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	if($jenis_tahun=='pajak'){
		$query="select * from sikp.f_laporan_per_thn_pajak(".$p_rqst_type_id.",".$year_period_id.",'".$date_start."', '".$date_end."')";
	}else if($jenis_tahun=='bayar'){
		$query = "select * from sikp.f_laporan_per_thn_bayar(".$p_rqst_type_id.",2013,'".$date_start."', '".$date_end."')";
	}
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',8);
	$pdf->ln(2);
	$pdf->SetWidths(array(10,40,40,33,37,40));
	$pdf->RowMultiBorderWithHeight(array("NO","BULAN","BESARNYA","JUMLAH WP","JUMLAH SSPD","KETERANGAN"),array('LTB','LTB','LTB','LTB','LTB','LTBR'),6);
	$pdf->SetFont('helvetica', '',8);
	$no =1;
	$pdf->SetAligns(Array('C','L','R','R','R','L'));
	$jumlah =0;
	$jumlah=0;
	while($dbConn->next_record()){
		$items[] = array('bulan_wp' => $dbConn->f("bulan_wp"),
					   'total_amount' => $dbConn->f("total_amount"),
					   'jumlah_wp' => $dbConn->f("jumlah_wp")
						);
		$pdf->RowMultiBorderWithHeight(array($no,$dbConn->f("bulan_wp"),'Rp. '.number_format($dbConn->f("total_amount"), 2, ',', '.'),$dbConn->f("jumlah_wp"),'',''),array('LB','LB','LB','LB','LB','LBR'),6);			
		$jumlah+=$dbConn->f("total_amount");
		$jumlah_wp+=$dbConn->f("jumlah_wp");
		$no++;
	}
	$pdf->SetAligns(Array('C','R','R','R','R','L'));
	$pdf->SetWidths(array(50,40,33,37,40));
	$pdf->RowMultiBorderWithHeight(array('Jumlah','Rp. '.number_format($jumlah, 2, ',', '.'),$jumlah_wp,'',''),array('LB','LB','LB','LB','LBR'),6);
	$pdf->SetWidths(array(123,50));
	$pdf->SetAligns('L');
		$pdf->ln(5);
	$pdf->SetWidtHs(array(130,70));
	$pdf->SetAligns(array("C", "C","C","C","C"));
	//$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. UGAS RAHMANSYAH, SAP, MAP)\n(NIP 19640127 199703 1001)"),array("",""),5);
	$pdf->RowMultiBorderWithHeight(array("","KEPALA SEKSI VERIFIKASI OTORISASI DAN PEMBUKUAN\n\n\n\n\n(Drs. H. Deden Saepulloh, MM.)\n(NIP 19681210 199010 001)"),array("",""),5);
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

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakExcel($p_rqst_type_id,$year_code,$year_period_id,$date_start,$date_end,$jenis_tahun,$rqst_type_code) {
	
	startExcel("LAPORAN_PENERIMAAN_PAJAK.xls");
	
	$output='';
		$output.='<table>
					<tr>';
		$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="th" colspan=6 align="center"><strong>LAPORAN PENERIMAAN GLOBAL PER TANGGAL PENERIMAAN</strong></td> 
                </tr>
				<tr>
				  <td class="th"><strong></strong></td>
                  <td class="th"><strong>JENIS PAJAK</strong></td>
				  <td class="th"><strong>: '.$rqst_type_code.'</strong></td> 
                </tr>
				<tr>
                  <td class="th"><strong></strong></td>
				  <td class="th"><strong>TANGGAL</strong></td> 
				  <td class="th"><strong>: '.dateToString($date_start).' s/d '.dateToString($date_end).'</strong></td> 
                </tr>
				<tr>
				</tr>
              </table>
 
              <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


		$output.='<th>NO</th>';
		$output.='<th>BULAN</th>';
		$output.='<th>BESARNYA</th>';
		$output.='<th>JUMLAH WP</th>';
		$output.='<th>JUMLAH SSPD</th>';
		$output.='<th>KETERANGAN</th>';
		$output.='</tr>';
				
		$no = 1;
		$jumlah = 0;
		$jumlah_wp =0;

		$dbConn = new clsDBConnSIKP();
		if($jenis_tahun=='pajak'){
			$query="select * from sikp.f_laporan_per_thn_pajak(".$p_rqst_type_id.",".$year_period_id.",'".$date_start."', '".$date_end."')";
		}else if($jenis_tahun=='bayar'){
			$query = "select * from sikp.f_laporan_per_thn_bayar(".$p_rqst_type_id.",2013,'".$date_start."', '".$date_end."')";
		}
		$dbConn->query($query);
		while($dbConn->next_record()){
			$items[] = array('bulan_wp' => $dbConn->f("bulan_wp"),
						   'total_amount' => $dbConn->f("total_amount"),
						   'jumlah_wp' => $dbConn->f("jumlah_wp")
							);			

			$output.='<tr>';
				$output.='<td style="font-weight:bold;" align="left">'.$no.'</td>';
				$output.='<td style="font-weight:bold;" align="left">'.strtoupper($dbConn->f("bulan_wp")).'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($dbConn->f("total_amount"), 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($dbConn->f("jumlah_wp"), 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
			$output.='</tr>';

			$jumlah+=$dbConn->f("total_amount");
			$jumlah_wp+=$dbConn->f("jumlah_wp");
			$no++;
		}
		$output.='<tr>';
			$output.='<td style="font-weight:bold;" align="left"></td>';
			$output.='<td style="font-weight:bold;" align="left">JUMLAH</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlah, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlah_wp, 0, ',', '.').'</td>';
			$output.='<td style="font-weight:bold;" align="right"></td>';
			$output.='<td style="font-weight:bold;" align="right"></td>';
		$output.='</tr>';
		$output.='</table></table>';
	
	$output.='<table>';
		$output.='<tr></tr>';
		$output.='<tr></tr>';
		$output.='<tr>';
			$output.='<td colspan=4 style="font-weight:bold;" align="right"></td>';
			$output.='<td colspan=2 style="font-weight:bold;" align="center">KEPALA SEKSI VERIFIKASI OTORISASI DAN</td>';
		$output.='</tr>';
		$output.='<tr>';
			$output.='<td colspan=4 style="font-weight:bold;" align="right"></td>';
			$output.='<td colspan=2 style="font-weight:bold;" align="center">PEMBUKUAN</td>';
		$output.='</tr>';
		$output.='<tr></tr>';
		$output.='<tr></tr>';
		$output.='<tr></tr>';
		$output.='<tr>';
			$output.='<td colspan=4 style="font-weight:bold;" align="right"></td>';
			$output.='<td colspan=2 style="font-weight:bold;" align="center">(Drs. H. Deden Saepulloh, MM.)</td>';
		$output.='</tr>';
		$output.='<tr>';
			$output.='<td colspan=4 style="font-weight:bold;" align="right"></td>';
			$output.='<td colspan=2 style="font-weight:bold;" align="center">(NIP 19681210 199010 001)</td>';
		$output.='</tr>';
	$output.='</table>';

	echo $output;
	exit;
}
?>

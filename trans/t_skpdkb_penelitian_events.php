<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-689FC3B0
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_skpdkb_penelitian; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$cetak_laporan = CCGetFromGet('cetak_laporan');
	global $Label1;
// -------------------------
    // Write your own code here.
		
	$Label1->SetText(view_html());
	
// -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function view_html() {
	
	
	$output = '';	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>DAFTAR SKPDKB PENELITIAN</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
               </table>';
	
	$output .='<table class="report" cellspacing="0" cellpadding="3px" width="100%">
                <tr>';

	$output.='<th>NO</th>';
	$output.='<th>NPWPD</th>';
	$output.='<th>NAMA WP</th>';
	$output.='<th>NO KWITANSI</th>';
	$output.='<th>PERIODE</th>';
	$output.='<th>NILAI TRANSAKSI</th>';
	$output.='</tr>';
	
	$no=1;


	$dbConn = new clsDBConnSIKP();
	
	$query="select receipt_no,wp_name,a.npwd,z.code,a.total_vat_amount from t_vat_setllement a
		left join t_payment_receipt x on a.t_vat_setllement_id=x.t_vat_setllement_id 
		left join t_cust_account y on y.t_cust_account_id = a.t_cust_account_id
		left JOIN p_finance_period z on z.p_finance_period_id = a.p_finance_period_id
		WHERE
		p_settlement_type_id = 2 
		and a.p_vat_type_dtl_id != 14
		;";
	$dbConn->query($query);

	while($dbConn->next_record()){
		$item = array(
						"receipt_no" => $dbConn->f("receipt_no"),
						"npwd" => $dbConn->f("npwd"),
						"wp_name" => $dbConn->f("wp_name"),
						"code" => $dbConn->f("code"),
						"total_vat_amount" => $dbConn->f("total_vat_amount")
						);
		
		$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$item['npwd'].'</td>';
			$output .= '<td align="left">'.$item['wp_name'].'</td>';
			$output .= '<td align="left">'.$item['receipt_no'].'</td>';
			$output .= '<td align="left">'.$item['code'].'</td>';
			$output .= '<td align="right">'.number_format($item['total_vat_amount'],0,",",".").'</td>';
		$output .= '</tr>';
	}
	
	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
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

	$pdf->SetFont('helvetica', '',12);
	$pdf->SetWidths(array(200));
	$pdf->ln(1);
    $pdf->RowMultiBorderWithHeight(array("LAPORAN PIUTANG PAJAK"),array('',''),6);
	//$pdf->ln(8);
	$pdf->SetWidths(array(40,200));
	$pdf->ln(4);
	//$pdf->RowMultiBorderWithHeight(array("DAFTAR SPTPD",": ".$param_arr['vat_code_dtl']),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("TAHUN",": ".$param_arr['year_code']),array('',''),6);
	//$pdf->RowMultiBorderWithHeight(array("TANGGAL",": ".dateToString($param_arr['date_start'])." s/d ".dateToString($param_arr['date_end'])),array('',''),6);
	$dbConn = new clsDBConnSIKP();
	/*echo '<pre>';
	print_r($param_arr);
	exit;*/
	$query="select *,to_char(tgl_tap,'dd-mm-yyyy') as tgl_tap_formated,to_char(tgl_bayar,'dd-mm-yyyy') as tgl_bayar_formated from t_piutang_pajak_penetapan_final where p_vat_type_id=".$param_arr['p_vat_type_id']." and p_year_period_id = ".$param_arr['year_period_id'];
	$dbConn->query($query);
	$items=array();
	$pdf->SetFont('helvetica', '',9);
	$pdf->ln(2);
	$pdf->SetWidths(array(28,43,23,23,35,35,25,35,35,25,20));
	$pdf->SetAligns(Array('C','C','C','C','C','C','C','C','C','C','C'));
	$pdf->RowMultiBorderWithHeight(array(
									"NPWD" ,
									"MASA PAJAK",
									"TGL TAP",
									"NO KOHIR",
									"BESARNYA",
									"REALISASI PIUTANG",
									"TGL BAYAR",									
									"SISA PIUTANG",
									"KETERANGAN",
									"TAHUN"),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),6);
	$pdf->SetFont('helvetica', '',9);
	$no =1;
	$pdf->SetAligns(Array('C','L','C','L','R','R','C','R','R','L','L'));
	$jumlah_omzet = 0;
	$jumlah_ketetapan = 0;
	while($dbConn->next_record()){
		$items[]= $item = array(
						"npwd" => $dbConn->f("npwd"),
						"masa_pajak" => $dbConn->f("masa_pajak"),
						"tgl_tap" => $dbConn->f("tgl_tap_formated"),
						"no_kohir" => $dbConn->f("no_kohir"),
						"realisasi_piutang" => $dbConn->f("realisasi_piutang"),
						"tgl_bayar" => $dbConn->f("tgl_bayar_formated"),
						"nilai_piutang" => $dbConn->f("nilai_piutang"),
						"sisa_piutang" => $dbConn->f("sisa_piutang"),
						"keterangan" => $dbConn->f("keterangan"),
						"p_year_period_id" => $dbConn->f("p_year_period_id"),
						"year_code" => $dbConn->f("year_code")
						);
		
		$pdf->RowMultiBorderWithHeight(array(
									$item["npwd"] ,
									$item["masa_pajak"],
									$item["tgl_tap"],
									$item["no_kohir"],
									'Rp ' . number_format($item["nilai_piutang"], 2, ',', '.'),
									'Rp ' . number_format($item["realisasi_piutang"], 2, ',', '.'),
									$item["tgl_bayar"],									
									'Rp ' . number_format($item["sisa_piutang"], 2, ',', '.'),
									$item["keterangan"],
									$item["year_code"]),array('LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTB','LTBR'),6);
		/*if(!empty($param_arr['p_vat_type_dtl_id'])){
			$pdf->RowMultiBorderWithHeight(array($no,$item['tanggal'],$item['no_order'],$item['nama'],$item['alamat'],$item['npwpd'], 2, ',', '.'),$item['kohir'],$item['start_period'].' - '.$item['end_period'],$item['jenis_pajak'],'Rp '.number_format($item['omzet'], 2, ',', '.'),'Rp '.number_format($item['ketetapan']),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);			
		}else{
			$pdf->RowMultiBorderWithHeight(array($no,$item['tanggal'],$item['ayat_code'].'.'.$item['ayat_code_dtl'],$item['nama'],$item['alamat'],$item['npwpd'],$item['kohir'],$item['start_period'].' - '.$item['end_period'],$item['jenis_pajak'],'Rp '.number_format($item['omzet'], 2, ',', '.'),'Rp '.number_format($item['ketetapan'], 2, ',', '.')),array('LB','LB','LB','LB','LB','LB','LB','LB','LB','LB','LBR'),6);
		}
		$jumlah_omzet += $dbConn->f("omzet");
		$jumlah_ketetapan += $dbConn->f("ketetapan");
		$no++;*/
	}
	/*$pdf->SetWidths(array(259,40,40));
	$pdf->SetAligns(Array('C','R','R'));
	$pdf->RowMultiBorderWithHeight(array('JUMLAH', 'Rp ' . number_format($jumlah_omzet, 2, ',', '.'), 'Rp ' . number_format($jumlah_ketetapan, 2, ',', '.')),array('LB','LB','LBR'),6);
	
	//signature
	$pdf->SetWidths(array(259,80));
	$pdf->SetAligns(Array('C','C'));
	$pdf->RowMultiBorderWithHeight(array('', ''),array('',''),12);
	$pdf->RowMultiBorderWithHeight(array('', 'Bandung' . ', ' . date('d F Y')),array('',''),6);
	$pdf->RowMultiBorderWithHeight(array('', ''),array('',''),36);
	$pdf->SetAligns(Array('C','L'));
	$pdf->RowMultiBorderWithHeight(array('', 'Nama:'),array('','T'),6);
	$pdf->RowMultiBorderWithHeight(array('', 'Jabatan:'),array('',''),6);*/
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

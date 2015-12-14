<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-DABBB821
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_wp_baru_summary; //Compatibility
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

	if($cetak_laporan == 'view_html') {
		$param_arr = array();
		$param_arr['status_pembayaran'] = CCGetFromGet("status_pembayaran", 1);
		$param_arr['p_vat_type_id'] = CCGetFromGet("p_vat_type_id",'');
		$param_arr['p_year_period_id'] = CCGetFromGet("p_year_period_id",'');
		if ($param_arr['status_pembayaran'] == 1){
			$param_arr['status_pembayaran_code']='SUDAH PERNAH BAYAR';
		}else{
			$param_arr['status_pembayaran_code']='BELUM PERNAH BAYAR';
		}
		$Label1->SetText(view_html($param_arr));

	}
	
// -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function view_html($param_arr) {
	$output = '';	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>DAFTAR WP BARU SUMMARY DENGAN STATUS BAYAR : '.$param_arr['status_pembayaran_code'].'</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
               </table>';
	
	$output .='<table class="report" cellspacing="0" cellpadding="3px" width="50%">
                <tr>';

	$output.='<th width="40">NO</th>';
	$output.='<th>BULAN</th>';
	$output.='<th>BESARNYA</th>';
	$output.='</tr>';
	
	$no=1;


	$dbConn = new clsDBConnSIKP();
	
	$query="SELECT case when extract(month from e.active_date) = 1 then 'Januari'
				     when extract(month from e.active_date) = 2 then 'Februari'
				     when extract(month from e.active_date) = 3 then 'Maret'
				     when extract(month from e.active_date) = 4 then 'April'
				     when extract(month from e.active_date) = 5 then 'Mei'
				     when extract(month from e.active_date) = 6 then 'Juni'
				     when extract(month from e.active_date) = 7 then 'Juli'
				     when extract(month from e.active_date) = 8 then 'Agustus'
				     when extract(month from e.active_date) = 9 then 'September'
				     when extract(month from e.active_date) = 10 then 'Oktober'
				     when extract(month from e.active_date) = 11 then 'November'
				     when extract(month from e.active_date) = 12 then 'Desember'	     
				end as bulan, 
			       extract(month from e.active_date) as bulan_num, 
			       extract(year from e.active_date) as tahun,
			       sum(f.payment_amount) as payment_amount
			FROM t_customer_order a 
			LEFT JOIN t_vat_registration B ON A .t_customer_order_id = B.t_customer_order_id 
			LEFT JOIN p_vat_type_dtl d ON b.p_vat_type_dtl_id = d.p_vat_type_dtl_id 
			left join t_cust_account e on e.npwd = b.npwpd
			left join t_payment_receipt f on f.t_cust_account_id = e.t_cust_account_id 
			WHERE p_rqst_type_id IN (1,2,3,4,5)" ;
	if ($param_arr['status_pembayaran'] == 1){
		$query.='AND EXISTS (select 1 from t_payment_receipt where t_cust_account_id = e.t_cust_account_id)';
	}else{
		$query.='and not EXISTS (select 1 from t_payment_receipt where t_cust_account_id = e.t_cust_account_id)';
	}
	if ($param_arr['p_vat_type_id']!=''){
		$query.="and e.p_vat_type_id = ".$param_arr['p_vat_type_id'];
	}
	$query.="and e.npwd is not null 
			and e.active_date between 
					(select start_date from p_year_period where p_year_period_id = ".$param_arr['p_year_period_id'].")
			 	and
					(select end_date from p_year_period where p_year_period_id = ".$param_arr['p_year_period_id'].")
			GROUP BY extract(month from e.active_date), extract(year from e.active_date)
			ORDER BY extract(month from e.active_date) ASC
			";
	//echo	$query; exit;
	$dbConn->query($query);
	$total = 0;
	while($dbConn->next_record()){
		$item = array(
						"bulan" => $dbConn->f("bulan"),
						"payment_amount" => $dbConn->f("payment_amount")
						);
		
		$output .= '<tr>';
			$output .= '<td align="center">'.$no++.'</td>';
			$output .= '<td align="left">'.$item['bulan'].'</td>';
								
			
			$jumlah = $item['payment_amount'];
			$total += $jumlah;

			$output .= '<td align="right">'.number_format($jumlah,0,",",".").'</td>';
		$output .= '</tr>';
	}
	$output .= '<tr>';
		$output .= '<td align="center" colspan=2><b>JUMLAH</b></td>';
		$output .= '<td align="right"><b>'.number_format($total,0,",",".").'</b></td>';
	$output .= '</tr>';
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

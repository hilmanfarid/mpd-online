<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-EB8655B5
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_dan_perkembangan_jml_wp; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-C3A4D5FF
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_laporan_pembayaran_dan_perkembangan_jml_wp; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	
	if($doAction == 'view_excel') {
		startExcel("pembayaran_dan_perkembangan_jumlah_wp_baru.xls");
	}

	$dbConn	= new clsDBConnSIKP();
	$query="select * from f_perkembangan_jumlah_wp_all()";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();
	
	$output = '';

	$output .= '<table border=0 class="Grid">';	
	$output .= '<tr border=0><th colspan = 14 align="center">PERKEMBANGAN JUMLAH WAJIB PAJAK</th></tr>';	
	$output .= '<tr border=0><th colspan = 14 align="center">HOTEL, RESTORAN, HIBURAN DAN PARKIR</th></tr>';
	$output .= '<tr border=0><th colspan = 14 align="center"></th></tr>';
	$output .= '</table>';
	
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';
	
	$output.='<th align="center" rowspan=2>NO</th>';
	$output.='<th align="center" rowspan=2>JENIS PAJAK</th>';
	$output.='<th align="center" colspan=3>PER 31-12-'.(date("Y")-1).'</th>';
	$output.='<th align="center" colspan=3>DAFTAR 01-01-'.date("Y").' s.d. '.date("d-m-Y").'</th>';
	$output.='<th align="center" colspan=3>NON AKTIF 01-01-'.date("Y").' s.d. '.date("d-m-Y").'</th>';
	$output.='<th align="center" colspan=3>PER '.date("d-m-Y").'</th></tr>';

	$output.='<tr><th align="center">NPWPD</th>';
	$output.='<th align="center">NPWPD JABATAN</th>';
	$output.='<th align="center">JUMLAH</th>';
	$output.='<th align="center">NPWPD</th>';
	$output.='<th align="center">NPWPD JABATAN</th>';
	$output.='<th align="center">JUMLAH</th>';
	$output.='<th align="center">NPWPD</th>';
	$output.='<th align="center">NPWPD JABATAN</th>';
	$output.='<th align="center">JUMLAH</th>';
	$output.='<th align="center">NPWPD</th>';
	$output.='<th align="center">NPWPD JABATAN</th>';
	$output.='<th align="center">JUMLAH</th></tr>';

	$total_o_jml_wp_daftar_akhir_tahun_kemarin = 0;
	$total_o_jml_wp_jabatan_akhir_tahun_kemarin= 0;
	$total_o_jml_wp_total_akhir_tahun_kemarin= 0;
	$total_o_jml_wp_daftar_awal_tahun_hingga_sekarang= 0;
	$total_o_jml_wp_jabatan_awal_tahun_hingga_sekarang= 0;
	$total_o_jml_wp_total_awal_tahun_hingga_sekarang= 0;
	$total_o_jml_wp_daftar_non_aktif_awal_tahun_hingga_sekarang= 0;
	$total_o_jml_wp_jabatan_non_aktif_awal_tahun_hingga_sekarang= 0;
	$total_o_jml_wp_total_non_aktif_awal_tahun_hingga_sekarang= 0;
	$total_o_jml_wp_daftar_hingga_sekarang= 0;
	$total_o_jml_wp_jabatan_hingga_sekarang= 0;
	$total_o_jml_wp_total_hingga_sekarang= 0;

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr>';
		if($data[$i]['kategori']=='jenis'){
			$output.='<td align="center" >'.$data[$i]['p_vat_type_id'].'</th>';
		}else{
			$output.='<td align="center" ></th>';
		}
		$output.='<td align="left" >'.$data[$i]['vat_code'].'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_daftar_akhir_tahun_kemarin'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_jabatan_akhir_tahun_kemarin'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_total_akhir_tahun_kemarin'], 0, ',', '.').'</th>';

		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_daftar_awal_tahun_hingga_sekarang'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_jabatan_awal_tahun_hingga_sekarang'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_total_awal_tahun_hingga_sekarang'], 0, ',', '.').'</th>';

		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_daftar_non_aktif_awal_tahun_hingga_sekarang'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_jabatan_non_aktif_awal_tahun_hingga_sekarang'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_total_non_aktif_awal_tahun_hingga_sekarang'], 0, ',', '.').'</th>';

		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_daftar_hingga_sekarang'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_jabatan_hingga_sekarang'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_total_hingga_sekarang'], 0, ',', '.').'</th></tr>';
		
		if($data[$i]['kategori']=='jenis'){
			$total_o_jml_wp_daftar_akhir_tahun_kemarin += $data[$i]['o_jml_wp_daftar_akhir_tahun_kemarin'];
			$total_o_jml_wp_jabatan_akhir_tahun_kemarin += $data[$i]['o_jml_wp_jabatan_akhir_tahun_kemarin'];
			$total_o_jml_wp_total_akhir_tahun_kemarin+= $data[$i]['o_jml_wp_total_akhir_tahun_kemarin'];

			$total_o_jml_wp_daftar_awal_tahun_hingga_sekarang+= $data[$i]['o_jml_wp_daftar_awal_tahun_hingga_sekarang'];
			$total_o_jml_wp_jabatan_awal_tahun_hingga_sekarang+= $data[$i]['o_jml_wp_jabatan_awal_tahun_hingga_sekarang'];
			$total_o_jml_wp_total_awal_tahun_hingga_sekarang+= $data[$i]['o_jml_wp_total_awal_tahun_hingga_sekarang'];

			$total_o_jml_wp_daftar_non_aktif_awal_tahun_hingga_sekarang+= $data[$i]['o_jml_wp_daftar_non_aktif_awal_tahun_hingga_sekarang'];
			$total_o_jml_wp_jabatan_non_aktif_awal_tahun_hingga_sekarang+= $data[$i]['o_jml_wp_jabatan_non_aktif_awal_tahun_hingga_sekarang'];
			$total_o_jml_wp_total_non_aktif_awal_tahun_hingga_sekarang+= $data[$i]['o_jml_wp_total_non_aktif_awal_tahun_hingga_sekarang'];

			$total_o_jml_wp_daftar_hingga_sekarang+= $data[$i]['o_jml_wp_daftar_hingga_sekarang'];
			$total_o_jml_wp_jabatan_hingga_sekarang+= $data[$i]['o_jml_wp_jabatan_hingga_sekarang'];
			$total_o_jml_wp_total_hingga_sekarang+= $data[$i]['o_jml_wp_total_hingga_sekarang'];
		}
	}
	$output.='<td align="center" colspan=2>JUMLAH</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_daftar_akhir_tahun_kemarin, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_jabatan_akhir_tahun_kemarin, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_total_akhir_tahun_kemarin, 0, ',', '.').'</th>';
                                              
	$output.='<td align="right" >'.number_format($total_o_jml_wp_daftar_awal_tahun_hingga_sekarang, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_jabatan_awal_tahun_hingga_sekarang, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_total_awal_tahun_hingga_sekarang, 0, ',', '.').'</th>';
                                              
	$output.='<td align="right" >'.number_format($total_o_jml_wp_daftar_non_aktif_awal_tahun_hingga_sekarang, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_jabatan_non_aktif_awal_tahun_hingga_sekarang, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_total_non_aktif_awal_tahun_hingga_sekarang, 0, ',', '.').'</th>';
                                              
	$output.='<td align="right" >'.number_format($total_o_jml_wp_daftar_hingga_sekarang, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_jabatan_hingga_sekarang, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_total_hingga_sekarang, 0, ',', '.').'</th></tr></table>';

	$output.='</br></br>';

	$dbConn	= new clsDBConnSIKP();
	$query="SELECT * FROM f_pembayaran_wp_baru_all()";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	$output .= '<table border=0 class="Grid">';	
	$output .= '<tr border=0><th colspan = 8 align="center"></th></tr>';
	$output .= '<tr border=0><th colspan = 8 align="center"></th></tr>';
	$output .= '<tr border=0><th colspan = 8 align="center">RINCIAN PEMBAYARAN WAJIB PAJAK BARU PENGUKUHAN TAHUN '.date("Y").'</th></tr>';	
	$output .= '<tr border=0><th colspan = 8 align="center"></th></tr>';
	$output .= '</table>';
	
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" rowspan=2>NO</th>';
	$output.='<th align="center" rowspan=2>JENIS PAJAK</th>';
	$output.='<th align="center" colspan=2>MENDAFTAR SENDIRI</th>';
	$output.='<th align="center" colspan=2>NPWPD JABATAN</th>';
	$output.='<th align="center" colspan=2>JUMLAH</th></tr>';

	$output.='<tr><th align="center">JUMLAH WP</th>';
	$output.='<th align="center">PEMBAYRAN</th>';
	$output.='<th align="center">JUMLAH WP</th>';
	$output.='<th align="center">PEMBAYRAN</th>';
	$output.='<th align="center">JUMLAH WP</th>';
	$output.='<th align="center">PEMBAYARAN</th></tr>';


	$total_o_realisasi_non_npwpd_jabatan = 0;
	$total_o_jml_wp_non_npwpd_jabatan= 0;
	$total_o_realisasi_npwpd_jabatan= 0;
	$total_o_jml_wp_npwpd_jabatan= 0;

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr>';
		if($data[$i]['kategori']=='jenis'){
			$output.='<td align="center" >'.$data[$i]['p_vat_type_id'].'</th>';
		}else{
			$output.='<td align="center" ></th>';
		}
		$output.='<td align="left" >'.$data[$i]['vat_code'].'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_non_npwpd_jabatan'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_realisasi_non_npwpd_jabatan'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_npwpd_jabatan'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_realisasi_npwpd_jabatan'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_npwpd_jabatan']+$data[$i]['o_jml_wp_non_npwpd_jabatan'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_realisasi_npwpd_jabatan']+$data[$i]['o_realisasi_non_npwpd_jabatan'], 0, ',', '.').'</th></tr>';
		
		if($data[$i]['kategori']=='jenis'){
			$total_o_realisasi_non_npwpd_jabatan += $data[$i]['o_realisasi_non_npwpd_jabatan'];
			$total_o_jml_wp_non_npwpd_jabatan += $data[$i]['o_jml_wp_non_npwpd_jabatan'];
			$total_o_realisasi_npwpd_jabatan+= $data[$i]['o_realisasi_npwpd_jabatan'];
			$total_o_jml_wp_npwpd_jabatan+= $data[$i]['o_jml_wp_npwpd_jabatan'];
		}
	}
	$output.='<td align="center" colspan=2>JUMLAH</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_non_npwpd_jabatan, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_realisasi_non_npwpd_jabatan, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_npwpd_jabatan, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_realisasi_npwpd_jabatan, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_npwpd_jabatan+$total_o_jml_wp_non_npwpd_jabatan, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_realisasi_npwpd_jabatan+$total_o_realisasi_non_npwpd_jabatan, 0, ',', '.').'</th></tr></table>';

	$output.='</br></br>';

	$dbConn	= new clsDBConnSIKP();
	$query="SELECT * FROM f_jumlah_wp_belum_bayar_all()";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	$output .= '<table border=0 class="Grid">';	
	$output .= '<tr border=0><th colspan = 5 align="center"></th></tr>';
	$output .= '<tr border=0><th colspan = 5 align="center"></th></tr>';
	$output .= '<tr border=0><th colspan = 5 align="center">RINCIAN JUMLAH WAJIB PAJAK BARU PENGUKUHAN TAHUN '.date("Y").' YANG BELUM BAYAR</th></tr>';	
	$output .= '<tr border=0><th colspan = 5 align="center"></th></tr>';
	$output .= '</table>';
	
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >JENIS PAJAK</th>';
	$output.='<th align="center" >SELURUHNYA</th>';
	$output.='<th align="center" >YANG SUDAH BAYAR</th>';
	$output.='<th align="center" >PERSENTASE</th></tr>';

	$total_o_jml_wp_blum_bayar = 0;
	$total_o_jml_wp_seluruhnya= 0;

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr>';
		if($data[$i]['kategori']=='jenis'){
			$output.='<td align="center" >'.$data[$i]['p_vat_type_id'].'</th>';
		}else{
			$output.='<td align="center" ></th>';
		}
		$output.='<td align="left" >'.$data[$i]['vat_code'].'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_blum_bayar'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_seluruhnya'], 0, ',', '.').'</th>';
		$output.='<td align="right" >'.number_format($data[$i]['o_jml_wp_blum_bayar']/$data[$i]['o_jml_wp_seluruhnya']*100, 2, ',', '.').' %</th></tr>';
		
		if($data[$i]['kategori']=='jenis'){
			$total_o_jml_wp_blum_bayar += $data[$i]['o_jml_wp_blum_bayar'];
			$total_o_jml_wp_seluruhnya += $data[$i]['o_jml_wp_seluruhnya'];
		}
	}
	$output.='<td align="center" colspan=2>JUMLAH</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_blum_bayar, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_seluruhnya, 0, ',', '.').'</th>';
	$output.='<td align="right" >'.number_format($total_o_jml_wp_blum_bayar/$total_o_jml_wp_seluruhnya*100, 2, ',', '.').' %</th></tr></table>';
	
	if($doAction == 'view_excel') {
		echo $output;
		exit;
	}
	$Label1->SetText($output);
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakExcel($param_arr) {
	
	startExcel("rekap_skpdkb_jabatan.xls");
	
	$output = '';
	
	

	echo $output;
	exit;
}
?>

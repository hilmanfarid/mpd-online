<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-288B1073
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_harian_per_ketetapan; //Compatibility
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

//Page_BeforeShow @1-7353B28B
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_harian_per_ketetapan; //Compatibility
//End Page_BeforeShow

//Custom Code @562-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	$tampil = CCGetFromGet('tampil');
	$excel = CCGetFromGet('excel');
	if($tampil=='T'){
		$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");//'15-12-2013';
		$kode_bank		= CCGetFromGet("kode_bank", "");
		// $tgl_penerimaan		= '15-12-2013';

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$query				= "select * from f_rep_lap_harian_per_ketetapan('$tgl_penerimaan','$kode_bank') order by nomor_ayat";
		$tgl_penerimaan		= str_replace("'", "", $tgl_penerimaan);
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data["nomor_ayat"][]		= $dbConn->f("nomor_ayat");
			$data["nama_ayat"][]		= $dbConn->f("nama_ayat");
			$data["nama_jns_pajak"][]	= $dbConn->f("nama_jns_pajak");
			$data["kode_jns_pajak"][]	= $dbConn->f("kode_jns_pajak");
			$data["jns_pajak"][]		= $dbConn->f("jns_pajak");
			$data["type_ayat"][]		= $dbConn->f("type_ayat");
			$data["p_vat_type_id"][]	= $dbConn->f("p_vat_type_id");
			$data["p_vat_type_dtl_id"][]= $dbConn->f("p_vat_type_dtl_id");
			$data["bulan"][]			= $dbConn->f("bulan");
			$data["tahun"][]			= $dbConn->f("tahun");

			$data["jml_sptpd_hari_ini"][]		= $dbConn->f("jml_sptpd_hari_ini");
			$data["jml_jabatan_hari_ini"][]		= $dbConn->f("jml_jabatan_hari_ini");
			$data["jml_pemeriksaan_hari_ini"][]	= $dbConn->f("jml_pemeriksaan_hari_ini");
			$data["jml_piutang_hari_ini"][]		= $dbConn->f("jml_piutang_hari_ini");
			$data["jml_hari_ini"][]				= $dbConn->f("jml_hari_ini");

			$data["jml_sptpd_sd_hari_lalu"][]	= $dbConn->f("jml_sptpd_sd_hari_lalu");
			$data["jml_jabatan_sd_hari_lalu"][]	= $dbConn->f("jml_jabatan_sd_hari_lalu");
			$data["jml_pemeriksaan_sd_hari_lalu"][]	= $dbConn->f("jml_pemeriksaan_sd_hari_lalu");
			$data["jml_piutang_sd_hari_lalu"][]	= $dbConn->f("jml_piutang_sd_hari_lalu");
			$data["jml_sd_hari_lalu"][]			= $dbConn->f("jml_sd_hari_lalu");

			$data["jml_sptpd_sd_hari_ini"][]	= $dbConn->f("jml_sptpd_sd_hari_ini");
			$data["jml_jabatan_sd_hari_ini"][]	= $dbConn->f("jml_jabatan_sd_hari_ini");
			$data["jml_pemeriksaan_sd_hari_ini"][]	= $dbConn->f("jml_pemeriksaan_sd_hari_ini");
			$data["jml_piutang_sd_hari_ini"][]	= $dbConn->f("jml_piutang_sd_hari_ini");
			$data["jml_sd_hari_ini"][]			= $dbConn->f("jml_sd_hari_ini");
		}

		$dbConn->close();
		if($excel=='T'){
			PageCetak($data,$user,$tgl_penerimaan);
		}else{
			$Label1->SetText(PageCetak($data,$user,$tgl_penerimaan));
		}
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function PageCetak($data, $user, $tgl_penerimaan) {
		$excel = CCGetFromGet('excel');
		if($excel == 'T') {
			startExcel("laporan_harian_per_ketetapan.xls");
		}
		
		$kabid = CCGetFromGet('kabid');
		$bphtb_row=array();
		$output='';
		
		$output.='<table>
					<tr>';
		$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="HeaderLeft"></td> 
                  <td class="th"><strong>LAPORAN HARIAN</strong></td> 
                  <td class="HeaderRight"></td>
                </tr>
              </table>
 
              <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


		$output.='<th style="text-align:center;" rowspan=2>NO</th>';
		$output.='<th style="text-align:center;" rowspan=2>AYAT</th>';
		$output.='<th style="text-align:center;" rowspan=2>PAJAK/RETRIBUSI</th>';
		$output.='<th style="text-align:center;" colspan=5>JUMLAH HARI INI</th>';
		$output.='<th style="text-align:center;" colspan=5>JUMLAH S/D HARI YANG LALU</th>';
		$output.='<th style="text-align:center;" colspan=5>JUMLAH S/D HARI INI</th>';
		$output.='</tr>';
		$output.='<tr class="Caption">';
		$output.='<th style="text-align:center;">SPTPD</th>';
		$output.='<th style="text-align:center;">SKPDKB Jabatan</th>';
		$output.='<th style="text-align:center;">SKPDKB Pemeriksaan</th>';
		$output.='<th style="text-align:center;">Piutang</th>';
		$output.='<th style="text-align:center;">JUMLAH</th>';
		$output.='<th style="text-align:center;">SPTPD</th>';
		$output.='<th style="text-align:center;">SKPDKB Jabatan</th>';
		$output.='<th style="text-align:center;">SKPDKB Pemeriksaan</th>';
		$output.='<th style="text-align:center;">Piutang</th>';
		$output.='<th style="text-align:center;">JUMLAH</th>';
		$output.='<th style="text-align:center;">SPTPD</th>';
		$output.='<th style="text-align:center;">SKPDKB Jabatan</th>';
		$output.='<th style="text-align:center;">SKPDKB Pemeriksaan</th>';
		$output.='<th style="text-align:center;">Piutang</th>';
		$output.='<th style="text-align:center;">JUMLAH</th>';
		$output.='</tr>';
				
		$no = 1;
		
		$jumlahperjenis = array();
		$jumlahtotal = 0;
		$jumlahtemp = 0;
		$jumlahperjenis_harilalu = array();
		$jumlahtotal_harilalu = 0;
		$jumlahtemp_harilalu = 0;
		$jumlahperjenis_hariini = array();
		$jumlahtotal_hariini = 0;
		$jumlahtemp_hariini = 0;
		$jml_transaksi_per_jenis_pajak = 0;
		$jml_transaksi_semua_jenis_pajak = 0;
		$jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
		$jml_transaksi_sampai_kemarin_semua_jenis_pajak = 0;
		$jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
		$jml_transaksi_sampai_hari_ini_semua_jenis_pajak = 0;
		
		for ($i = 0; $i < count($data['nomor_ayat']); $i++) {
			//print data
			$output.='<tr>';
			$output.='<td>  
						'.$no.'	
					 </td>
					 <td>
						'.$data["nomor_ayat"][$i].'	
					 </td>
					 <td>
							P. ' . strtoupper($data["nama_ayat"][$i]).'	
					 </td>
					 <td align="right">
							'.number_format($data["jml_sptpd_hari_ini"][$i], 0, ',', '.').'	
					 </td>
					 <td align="right">
							'.number_format($data["jml_jabatan_hari_ini"][$i], 0, ',', '.').'	
					 </td>
					 <td align="right">
							'.number_format($data["jml_pemeriksaan_hari_ini"][$i], 0, ',', '.').'	
					 </td>
					 <td align="right">
							'.number_format($data["jml_piutang_hari_ini"][$i], 0, ',', '.').'	
					 </td>
					 <td align="right">
							'.number_format($data["jml_hari_ini"][$i], 0, ',', '.').'	
					 </td>
					 

					 <td align="right">
					 		'.number_format($data["jml_sptpd_sd_hari_lalu"][$i], 0, ',', '.').'												  
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_jabatan_sd_hari_lalu"][$i], 0, ',', '.').'												  
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_pemeriksaan_sd_hari_lalu"][$i], 0, ',', '.').'												  
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_piutang_sd_hari_lalu"][$i], 0, ',', '.').'												  
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_sd_hari_lalu"][$i], 0, ',', '.').'												  
					 </td>
					 

					 <td align="right">
					 		'.number_format($data["jml_sptpd_sd_hari_ini"][$i], 0, ',', '.').'
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_jabatan_sd_hari_ini"][$i], 0, ',', '.').'
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_pemeriksaan_sd_hari_ini"][$i], 0, ',', '.').'
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_piutang_sd_hari_ini"][$i], 0, ',', '.').'
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_sd_hari_ini"][$i], 0, ',', '.').'
					 </td>';
			$output.='</tr>';
			$no++;

			//hitung jml_hari_ini sampai baris ini
			$jumlahtemp += $data["jml_hari_ini"][$i];
			$jumlahtotal += $data["jml_hari_ini"][$i];
			$jumlahtemp_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtotal_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtemp_hariini += $data["jml_sd_hari_ini"][$i];
			$jumlahtotal_hariini += $data["jml_sd_hari_ini"][$i];
			$jml_transaksi_per_jenis_pajak += $data["jml_transaksi"][$i];
			$jml_transaksi_semua_jenis_pajak += $data["jml_transaksi"][$i];

			$jml_transaksi_sampai_kemarin_per_jenis_pajak += $data["jml_transaksi_sampai_kemarin"][$i];
			$jml_transaksi_sampai_kemarin_semua_jenis_pajak += $data["jml_transaksi_sampai_kemarin"][$i];

			$jml_transaksi_sampai_hari_ini_per_jenis_pajak += $data["jml_transaksi_sampai_hari_ini"][$i];
			$jml_transaksi_sampai_hari_ini_semua_jenis_pajak += $data["jml_transaksi_sampai_hari_ini"][$i];
			
			//cek apakah perlu bikin baris jumlah
			//jika iya, simpan jumlahtemp ke jumlahperjenis, print jumlahtemp, reset jumlahtemp
			$jenis = $data["nama_jns_pajak"][$i];
			$jenissesudah = $data["nama_jns_pajak"][$i + 1];
			if($jenis != $jenissesudah){
				$jumlahperjenis[] = $jumlahtemp;
				$jumlahperjenis_harilalu[] = $jumlahtemp_harilalu;
				$jumlahperjenis_hariini[] = $jumlahtemp_hariini;
				
				$output.='<tr>';
				$output.='<td style="font-weight:bold;" align="center" colspan=3>'.strtoupper($data["nama_jns_pajak"][$i]).'</td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp, 0, ',', '.').'</td>';
				
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp_harilalu, 0, ',', '.').'</td>';
				
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp_hariini, 0, ',', '.').'</td>';
				$output.='</tr>';				

				$jumlahtemp = 0;
				$jumlahtemp_harilalu = 0;
				$jumlahtemp_hariini = 0;
				$jml_transaksi_per_jenis_pajak = 0;
				$jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
				$jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
			}
			
			if($i == count($data['nomor_ayat']) - 1){
				$output.='<tr>';
				$output.='<td style="font-weight:bold;" align="center" colspan=3>JUMLAH TOTAL</td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal, 0, ',', '.').'</td>';

				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal_harilalu, 0, ',', '.').'</td>';

				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right"></td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal_hariini, 0, ',', '.').'</td>';
				$output.='</tr>';
				$jumlahtotal = 0;
				$jumlahtotal_harilalu = 0;
				$jumlahtotal_hariini = 0;
				$jml_transaksi_per_jenis_pajak = 0;
				$jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
				$jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
			}
		}
		$output.='</table></table>';

		if($excel == 'T') {
			echo $output;
			exit;
		}
		return $output;
	}

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}
?>

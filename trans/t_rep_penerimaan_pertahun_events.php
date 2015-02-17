<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-1BEFDF07
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_penerimaan_pertahun; //Compatibility
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

//Page_BeforeShow @1-85A10215
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_penerimaan_pertahun; //Compatibility
//End Page_BeforeShow
	global $Label1;
//Custom Code @569-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

	$doAction = CCGetFromGet('doAction');
	if($doAction == 'view_html') {
		$p_year_period_id	= CCGetFromGet("p_year_period_id", "");
		$p_vat_type_id		= CCGetFromGet("p_vat_type_id", "");
		$tgl_status			= CCGetFromGet("tgl_status", "");
		$p_account_status_id= CCGetFromGet("p_account_status_id", "");
		$status_bayar = CCGetFromGet("status_bayar", "");

		if(empty($p_account_status_id)) $p_account_status_id = "NULL";
		if(empty($status_bayar)) $status_bayar = "NULL";

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$query				= "select * from f_rep_penerimaan_pertahun_sts_new_desc($p_year_period_id, $p_vat_type_id, $tgl_status, $p_account_status_id, $status_bayar);";

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data["jenis_pajak"][]	= $dbConn->f("jenis_pajak");
			$data["tahun"][]		= $dbConn->f("tahun");
			$data["nama"][]			= $dbConn->f("nama");
			$data["alamat"][]		= $dbConn->f("alamat");
			$data["npwpd"][]		= $dbConn->f("npwpd");
			$data["f_12_sts"][]		= $dbConn->f("f_12_sts");
			$data["f_12_amt"][]		= $dbConn->f("f_12_amt");
			$data["f_12_paydate"][]	= $dbConn->f("f_12_paydate");
			$data["f_11_sts"][]		= $dbConn->f("f_11_sts");
			$data["f_11_amt"][]		= $dbConn->f("f_11_amt");
			$data["f_11_paydate"][]	= $dbConn->f("f_11_paydate");
			$data["f_10_sts"][]		= $dbConn->f("f_10_sts");
			$data["f_10_amt"][]		= $dbConn->f("f_10_amt");
			$data["f_10_paydate"][]	= $dbConn->f("f_10_paydate");
			$data["f_09_sts"][]		= $dbConn->f("f_09_sts");
			$data["f_09_amt"][]		= $dbConn->f("f_09_amt");
			$data["f_09_paydate"][]	= $dbConn->f("f_09_paydate");
			$data["f_08_sts"][]		= $dbConn->f("f_08_sts");
			$data["f_08_amt"][]		= $dbConn->f("f_08_amt");
			$data["f_08_paydate"][]	= $dbConn->f("f_08_paydate");
			$data["f_07_sts"][]		= $dbConn->f("f_07_sts");
			$data["f_07_amt"][]		= $dbConn->f("f_07_amt");
			$data["f_07_paydate"][]	= $dbConn->f("f_07_paydate");
			$data["f_06_sts"][]		= $dbConn->f("f_06_sts");
			$data["f_06_amt"][]		= $dbConn->f("f_06_amt");
			$data["f_06_paydate"][]	= $dbConn->f("f_06_paydate");
			$data["f_05_sts"][]		= $dbConn->f("f_05_sts");
			$data["f_05_amt"][]		= $dbConn->f("f_05_amt");
			$data["f_05_paydate"][]	= $dbConn->f("f_05_paydate");
			$data["f_04_sts"][]		= $dbConn->f("f_04_sts");
			$data["f_04_amt"][]		= $dbConn->f("f_04_amt");
			$data["f_04_paydate"][]	= $dbConn->f("f_04_paydate");
			$data["f_03_sts"][]		= $dbConn->f("f_03_sts");
			$data["f_03_amt"][]		= $dbConn->f("f_03_amt");
			$data["f_03_paydate"][]	= $dbConn->f("f_03_paydate");
			$data["f_02_sts"][]		= $dbConn->f("f_02_sts");
			$data["f_02_amt"][]		= $dbConn->f("f_02_amt");
			$data["f_02_paydate"][]	= $dbConn->f("f_02_paydate");
			$data["f_01_sts"][]		= $dbConn->f("f_01_sts");
			$data["f_01_amt"][]		= $dbConn->f("f_01_amt");
			$data["f_01_paydate"][]	= $dbConn->f("f_01_paydate");
		}
		$dbConn->close();

		$Label1->SetText(GetCetakHTML($data));
	}


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
function GetCetakHTML($data) {
	$output = '';
	
	$output .='<table id="table-penerimaan-pertahun" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN PENERIMAAN PERTAHUN</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	
	//$output .= '<h2>LAPORAN REALISASI HARIAN PER JENIS PAJAK </h2>';
	//$output .= '<h2>TANGGAL : '.dateToString($date_start, "-")." s/d ".dateToString($date_end, "-").'</h2> <br/>';

	$output .='<table id="table-penerimaan-pertahun-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


	$output.='<th>NO</th>';
	$output.='<th>NPWPD</th>';
	$output.='<th>NAMA</th>';
	$output.='<th>ALAMAT</th>';
	$output.='<th>REALISASI TGL BAYAR</th>';
	$output.='<th>MASA PAJAK</th>';
	$output.='<th>JUMLAH</th>';
	$output.='<th>KETERANGAN</th>';
	$output.='</tr>';
	
	$jumlahtemp=0;
	$jumlahperayat=0;
	$i2=0;
	
	for ($i = 0; $i < count($data["nama"]); $i++) {
		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_12_amt"][$i]) ? '-' : $data["f_12_paydate"][$i]).'</td>';
			$output.='<td>DESEMBER '.($data["tahun"][0]-1).'</td>';
			$output.='<td align="right">'.number_format($data["f_12_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_12_amt"][$i]) ? $data["f_12_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_01_amt"][$i]) ? '-' : $data["f_01_paydate"][$i]).'</td>';
			$output.='<td>JANUARI '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_01_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_01_amt"][$i]) ? $data["f_01_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_02_amt"][$i]) ? '-' : $data["f_02_paydate"][$i]).'</td>';
			$output.='<td>FEBRUARI '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_02_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_02_amt"][$i]) ? $data["f_02_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_03_amt"][$i]) ? '-' : $data["f_03_paydate"][$i]).'</td>';
			$output.='<td>MARET '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_03_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_03_amt"][$i]) ? $data["f_03_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_04_amt"][$i]) ? '-' : $data["f_04_paydate"][$i]).'</td>';
			$output.='<td>APRIL '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_04_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_04_amt"][$i]) ? $data["f_04_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_05_amt"][$i]) ? '-' : $data["f_05_paydate"][$i]).'</td>';
			$output.='<td>MEI '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_05_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_05_amt"][$i]) ? $data["f_05_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_06_amt"][$i]) ? '-' : $data["f_06_paydate"][$i]).'</td>';
			$output.='<td>JUNI '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_06_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_06_amt"][$i]) ? $data["f_06_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_07_amt"][$i]) ? '-' : $data["f_07_paydate"][$i]).'</td>';
			$output.='<td>JULI '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_07_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_07_amt"][$i]) ? $data["f_07_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_08_amt"][$i]) ? '-' : $data["f_08_paydate"][$i]).'</td>';
			$output.='<td>AGUSTUS '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_08_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_08_amt"][$i]) ? $data["f_08_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_09_amt"][$i]) ? '-' : $data["f_09_paydate"][$i]).'</td>';
			$output.='<td>SEPTEMBER '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_09_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_09_amt"][$i]) ? $data["f_09_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_10_amt"][$i]) ? '-' : $data["f_10_paydate"][$i]).'</td>';
			$output.='<td>OKTOBER '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_10_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_10_amt"][$i]) ? $data["f_10_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;

		$output .= '<tr>';
			$output.='<td>'.($i2+1).'</td>';
			$output.='<td>'.$data["npwpd"][$i].'</td>';
			$output.='<td>'.$data["nama"][$i].'</td>';
			$output.='<td>'.$data["alamat"][$i].'</td>';
			$output.='<td>'.(empty($data["f_11_amt"][$i]) ? '-' : $data["f_11_paydate"][$i]).'</td>';
			$output.='<td>NOVEMBER '.$data["tahun"][0].'</td>';
			$output.='<td align="right">'.number_format($data["f_11_amt"][$i], 2, ',', '.').'</td>';
			$output.='<td>'.(empty($data["f_11_amt"][$i]) ? $data["f_11_paydate"][$i] : '-').'</td>';
		$output .= '</tr>';
		$i2=$i2+1;
		

		/*
		//hitung jumlahperayat sampai baris ini
		$jumlahtemp += $item["jumlah_terima"];
		//$total+= $item["jumlah_terima"];
		//cek apakah perlu bikin baris jumlah
		//jika iya, simpan jumlahtemp ke jumlahperayat, print jumlahtemp, reset jumlahtemp
		$ayat = $item["kode_ayat"];
		$ayatsesudah = $data[$i+1]["kode_ayat"];
		if(($ayat != $ayatsesudah&&count($data)>1)||empty($data[$i+1])){
			$jumlahperayat += $jumlahtemp;
			$output .= '<tr>';
				$output .= '<td align="CENTER" colspan=6>JUMLAH PAJAK '.$item["nama_ayat"].'</td>';
				$output .= '<td align="right">Rp. '.number_format($jumlahtemp, 2, ',', '.').'</td>';
			$output .= '</tr>';
			$jumlahtemp = 0;
			
		}
		$i=$i+1;
		*/
		
	}
	
	$output.='</td></tr></table>';
	$output.='</table>';
	
	return $output;
}

?>

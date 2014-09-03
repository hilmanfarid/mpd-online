<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-F0AE141B
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_harian; //Compatibility
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

//Page_BeforeShow @1-7B518D80
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_harian; //Compatibility
//End Page_BeforeShow

//Custom Code @562-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	$tampil = CCGetFromGet('tampil');
	if($tampil=='T'){
		$Label1->SetText("<table border=1><tr><td>tes</td></tr></table>");
		$tgl_penerimaan		= CCGetFromGet("tgl_penerimaan", "");//'15-12-2013';
		// $tgl_penerimaan		= '15-12-2013';

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$query				= "select * from f_rep_lap_harian_bdhr_mod_1('$tgl_penerimaan') order by nomor_ayat";
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
			$data["jml_hari_ini"][]		= $dbConn->f("jml_hari_ini");
			$data["jml_sd_hari_lalu"][]	= $dbConn->f("jml_sd_hari_lalu");
			$data["jml_sd_hari_ini"][]	= $dbConn->f("jml_sd_hari_ini");
		}

		$dbConn->close();
		$Label1->SetText(PageCetak($data,$user,$tgl_penerimaan));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function PageCetak($data, $user, $tgl_penerimaan) {
		$kabid = CCGetFromGet('kabid');
		$bphtb_row=array();
		$output='';
		if($kabid=='T'){
			$dbConn = new clsDBConnSIKP();
	  		$sql="select(
					select sum(payment_vat_amount) from t_payment_receipt_bphtb pay_bphtb
					where extract(year from pay_bphtb.payment_date ::date) = extract(year from '".$tgl_penerimaan."'::date)
					and trunc(pay_bphtb.payment_date) <= '".$tgl_penerimaan."'::date
					) as sd_hari_ini,
					(
					select sum(payment_vat_amount) from t_payment_receipt_bphtb pay_bphtb
					where trunc(pay_bphtb.payment_date) = '".$tgl_penerimaan."'
					) as hari_ini,
					(
					select sum(payment_vat_amount) from t_payment_receipt_bphtb pay_bphtb
					where extract(year from pay_bphtb.payment_date ::date) = extract(year from '".$tgl_penerimaan."'::date)
					and trunc(pay_bphtb.payment_date) <= '".$tgl_penerimaan."'::date - 1
					) as sd_hari_kemarin;";
	  		$dbConn->query($sql);
	  		while($dbConn->next_record()){
				$bphtb_row['sd_hari_ini'] = $dbConn->f('sd_hari_ini');
				$bphtb_row['sd_hari_kemarin'] = $dbConn->f('sd_hari_kemarin');
				$bphtb_row['hari_ini'] = $dbConn->f('hari_ini');
			}
	  		$dbConn->close();
		}
		$output.='<table>
					<tr>';
		$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  <td class="th"><strong>LAPORAN HARIAN</strong></td> 
                  <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                </tr>
              </table>
 
              <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


		$output.='<th>NO</th>';
		$output.='<th>AYAT</th>';
		$output.='<th>PAJAK/RETRIBUSI</th>';
		$output.='<th>JUMLAH HARI INI</th>';
		$output.='<th>JUMLAH S/D HARI YANG LALU</th>';
		$output.='<th>JUMLAH S/D HARI INI</th>';
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
		
		for ($i = 0; $i < count($data['nomor_ayat']); $i++) {
			//print data
			if($kabid=='T' && $data['nama_ayat'][$i]=='BPHTB'){
				$data["jml_hari_ini"][$i]=$bphtb_row['hari_ini'];
				$data["jml_sd_hari_lalu"][$i]=$bphtb_row['sd_hari_kemarin'];
				$data["jml_sd_hari_ini"][$i]=$bphtb_row['sd_hari_ini'];
			}
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
					 <td>
							'.number_format($data["jml_hari_ini"][$i], 0, ',', '.').'	
					 </td>
					 <td align="right">
					 		'.number_format($data["jml_sd_hari_lalu"][$i], 0, ',', '.').'												  
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
				$output.='<td style="font-weight:bold;">'.number_format($jumlahtemp, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp_harilalu, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtemp_hariini, 0, ',', '.').'</td>';
				$output.='</tr>';				

				$jumlahtemp = 0;
				$jumlahtemp_harilalu = 0;
				$jumlahtemp_hariini = 0;
			}
			
			if($i == count($data['nomor_ayat']) - 1){
				$output.='<tr>';
				$output.='<td style="font-weight:bold;" align="center" colspan=3>JUMLAH TOTAL</td>';
				$output.='<td style="font-weight:bold;">'.number_format($jumlahtotal, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal_harilalu, 0, ',', '.').'</td>';
				$output.='<td style="font-weight:bold;" align="right">'.number_format($jumlahtotal_hariini, 0, ',', '.').'</td>';
				$output.='</tr>';
				$jumlahtotal = 0;
				$jumlahtotal_harilalu = 0;
				$jumlahtotal_hariini = 0;
			}
		}

		/*$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "AYAT", "TBLR", 0, 'C');
		$this->Cell($ltable4*2.2+4, $this->height + 2, "PAJAK/RETRIBUSI", "TBLR", 0, 'C');
		$this->Cell($ltable4*1.1, $this->height + 2, "JUMLAH HARI INI", "TBLR", 0, 'C');
		$this->Cell($ltable*4.04, $this->height + 2, "JUMLAH S/D HARI YANG LALU", "TBLR", 0, 'C');
		$this->Cell($ltable4*1.3-4, $this->height + 2, "JUMLAH S/D HARI INI", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom
		/*$this->SetWidths(array($ltable1, $ltable3, $ltable4*2.2+4, $ltable4*1.1, $ltable*4.04, $ltable4*1.3-4));
		$this->SetAligns(array("C", "L", "L", "R", "R", "R"));
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
		
		for ($i = 0; $i < count($data['nomor_ayat']); $i++) {
			//print data
			if($kabid=='T' && $data['nama_ayat'][$i]=='BPHTB'){
				$data["jml_hari_ini"][$i]=$bphtb_row['hari_ini'];
				$data["jml_sd_hari_lalu"][$i]=$bphtb_row['sd_hari_kemarin'];
				$data["jml_sd_hari_ini"][$i]=$bphtb_row['sd_hari_ini'];
			}
			$this->RowMultiBorderWithHeight(array($no,
												  $data["nomor_ayat"][$i] . " " . $data["kode_jns_trans"][$i],
												  "P. " . strtoupper($data["nama_ayat"][$i]),
												  number_format($data["jml_hari_ini"][$i], 0, ',', '.'),
												  number_format($data["jml_sd_hari_lalu"][$i], 0, ',', '.'),
												  number_format($data["jml_sd_hari_ini"][$i], 0, ',', '.')
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR'
												  )
												  ,$this->height);
			$no++;

			//hitung jml_hari_ini sampai baris ini
			$jumlahtemp += $data["jml_hari_ini"][$i];
			$jumlahtotal += $data["jml_hari_ini"][$i];
			$jumlahtemp_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtotal_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtemp_hariini += $data["jml_sd_hari_ini"][$i];
			$jumlahtotal_hariini += $data["jml_sd_hari_ini"][$i];
			
			//cek apakah perlu bikin baris jumlah
			//jika iya, simpan jumlahtemp ke jumlahperjenis, print jumlahtemp, reset jumlahtemp
			$jenis = $data["nama_jns_pajak"][$i];
			$jenissesudah = $data["nama_jns_pajak"][$i + 1];
			$this->SetFont('Arial', 'B', 10);
			if($jenis != $jenissesudah){
				$jumlahperjenis[] = $jumlahtemp;
				$jumlahperjenis_harilalu[] = $jumlahtemp_harilalu;
				$jumlahperjenis_hariini[] = $jumlahtemp_hariini;
				$this->Cell($ltable1 + $ltable3 + $ltable4*2.2+4, $this->height + 2, "JUMLAH " . strtoupper($data["nama_jns_pajak"][$i]), "TBLR", 0, 'C');
				$this->Cell($ltable4*1.1, $this->height + 2, number_format($jumlahtemp, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable*4.04, $this->height + 2, number_format($jumlahtemp_harilalu, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable4*1.3-4, $this->height + 2, number_format($jumlahtemp_hariini, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Ln();
				$jumlahtemp = 0;
				$jumlahtemp_harilalu = 0;
				$jumlahtemp_hariini = 0;
			}
			
			if($i == count($data['nomor_ayat']) - 1){
				$this->Cell($ltable1 + $ltable3 + $ltable4*2.2+4, $this->height + 2, "JUMLAH TOTAL", "TBLR", 0, 'C');
				$this->Cell($ltable4*1.1, $this->height + 2, number_format($jumlahtotal, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable*4.04, $this->height + 2, number_format($jumlahtotal_harilalu, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Cell($ltable4*1.3-4, $this->height + 2, number_format($jumlahtotal_hariini, 0, ',', '.'), "TBLR", 0, 'R');
				$this->Ln();
				$jumlahtotal = 0;
				$jumlahtotal_harilalu = 0;
				$jumlahtotal_hariini = 0;
			}
			$this->SetFont('Arial', '', 10);
		}

		$this->Ln();
		$this->newLine();
		$this->newLine();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		if($kabid != 'T'){
			$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
			$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y"), "", 0, 'C');
			$this->Ln();
			$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
			$this->Cell($lbody1 + 10, $this->height, "BENDAHARA PENERIMAAN, ", "", 0, 'C');
			$this->Ln();
			$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
			//$this->Cell($lbody1 + 10, $this->height, "KOTA BANDUNG", "", 0, 'C');
			$this->Ln();
			$this->newLine();
			$this->newLine();
			$this->newLine();
			$this->newLine();
			$this->newLine();
			$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
			$this->Cell($lbody1 + 10, $this->height, "(                ABDURACHIM                )", "", 0, 'C');
			$this->Ln();
			$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');
			$this->Cell($lbody1 + 10, $this->height, "NIP. 19590622 198503 1 003", "", 0, 'C');
			$this->Ln();
		}*/
		$output.='</table></table>';
		return $output;
	}
?>

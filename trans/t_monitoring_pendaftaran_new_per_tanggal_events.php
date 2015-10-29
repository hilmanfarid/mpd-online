<?php
include(RelativePath . "/include/create_dynamic_table.php");
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-2C83A54A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_monitoring_pendaftaran_new_per_tanggal; //Compatibility
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

//Page_BeforeShow @1-116013A9
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_monitoring_pendaftaran_new_per_tanggal; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
	$param_arr['date_start_laporan'] = CCGetFromGet('date_start_laporan');
	$param_arr['date_end_laporan'] = CCGetFromGet('date_end_laporan');
	$param_arr['nilai'] = CCGetFromGet('nilai');

	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	if($doAction == 'view_html') {
		$Label1->SetText(GetCetakHTML($param_arr));
	}
	if($doAction == 'view_excel') {
		GetCetakExcel($param_arr);
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($param_arr) {
	
	$output = '';
	$DBConn = new clsDBConnSIKP();
	$SQL = "select replace(replace(f_monitor_tipro_daftar_per_tanggal(1,"
	.$param_arr['nilai'].",'".$param_arr['date_start_laporan']."','".$param_arr['date_end_laporan']."',"
	.$param_arr['p_vat_type_id']."),'(\"',''),'\")','') from dual";	
	//die($SQL);
	$DBConn->query($SQL);
		  
	return create_table_grid ($DBConn, "INFORMASI MONITORING", "", $qs, "Y", $arrJml, "2");
}

function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakExcel($param_arr) {
	
	startExcel("pendaftaran_wp.xls");
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';
	$output .='<table>';
	//$output .= '<tr><td class="th" align="center" colspan=7><h1><strong>KARTU LAPORAN</strong></td> </tr>';
	//$output .= '<tr><td class="th" align="center" colspan=7><h1><strong>REKAPITULASI TARGET/SASARAN MUTU</strong></td> </tr>';
	$output .= '<tr><td class="th" align="center" colspan=8><h1><strong>DAFTAR PERMOHONAN</strong></td></tr>';
	$output .= '<tr><td class="th" align="center" colspan=8><h1><strong>PENDAFTARAN WAJIB PAJAK DAERAH</strong></td></tr>';
	$output .= '</table></br>';
	
	$output .='<table>';
	$output .= '<tr></tr>';
	$output .= '<tr></tr>';
	//$output .= '<tr><td colspan=2>JENIS PAJAK </td><td>: '.$param_arr['vat_code'].'</td></tr>';
	$output .= '<tr><td colspan=2>TANGGAL </td><td>: '.$param_arr['date_start_laporan'].' s.d. '.$param_arr['date_end_laporan'].' </td></tr>';
	//$output .= '<tr><td colspan=2>JENIS TARGET </td><td>: PENERBITAN NPWPD 7 HARI KERJA</td></tr>';
	$output .= '<tr></tr>';
	$output .= '</table></br>';
	$tanggal = CCGetFromGet('date_end_laporan','31-12-2014');
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NAMA WAJIB PAJAK</th>';
	$output.='<th align="center" >NAMA PENANGGUNG PAJAK</th>';
	$output.='<th align="center" >MERK DAGANG</th>';
	$output.='<th align="center" >ALAMAT USAHA</th>';
	$output.='<th align="center" >WILAYAH</th>';
	$output.='<th align="center" >JENIS PAJAK</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	
	$query="SELECT * 
			FROM t_vat_registration a 
			left join p_vat_type_dtl b on a.p_vat_type_dtl_id=b.p_vat_type_dtl_id  
			left join t_customer_order c on a.t_customer_order_id = c. t_customer_order_id
			where trunc(a.creation_date) BETWEEN to_date('".$param_arr['date_start_laporan']."','dd-mm-yyyy') 
				and to_date('".$param_arr['date_end_laporan']."','dd-mm-yyyy')
			and case when ".$param_arr['p_vat_type_id']."=0 then true
					else a.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id =".$param_arr['p_vat_type_id'].")
				end 
			and case when ".$param_arr['nilai']."=0 then true
					else c.p_order_status_id = ".$param_arr['nilai']."
				end ";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['company_owner'].'</td>';
		$output.='<td align="left" >'.$data[$i]['company_brand'].'</td>';
		$output.='<td align="left" >'.$data[$i]['brand_address_name'].'</td>';
		$output.='<td align="left" ></td>';
		$output.='<td align="left" >'.$data[$i]['vat_code'].'</td>';
		$output.='<td align="left" >'.$data[$i]['npwpd'].'</td></tr>';
	}

	$output.='</table>';
	
	$output .='<table width=100% border=0>';

	$output.='<tr></tr>';
	$output.='<tr></tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						 
					</td>
					<td width=50% align="center" colspan=3>
						KEPALA BIDANG 
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						
					</td>
					<td width=50% align="center" colspan=3>
						PAJAK PENDAFTARAN,
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						 
					</td>
					<td width=50% align="center" colspan=3>
						 
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						
					</td>
					<td width=50% align="center" colspan=3>
						
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						
					</td>
					<td width=50% align="center" colspan=3>
						Drs. H. GUN GUN SUMARYANA
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						
					</td>
					<td width=50% align="center" colspan=3>
						Pembina
					</td>
				</tr>';
	$output .= '<tr >
					<td width=50% align="center" colspan=5>
						
					</td>
					<td width=50% align="center" colspan=3>
						NIP. 19700806 199101 1 001
					</td>
				</tr>';


	$output.='</table>';

	echo $output;
	exit;
}

?>

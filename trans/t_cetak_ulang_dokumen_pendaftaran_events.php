<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-A0E71999
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cetak_ulang_dokumen_pendaftaran; //Compatibility
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

//Page_BeforeShow @1-0F09BF27
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cetak_ulang_dokumen_pendaftaran; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	if($doAction == 'view_html') {
		$param_arr['search'] = CCGetFromGet('search');
		$param_arr['tgl'] = CCGetFromGet('tgl');
		/*if ($param_arr['tgl']==''){
			$param_arr['tgl']='';
		}*/
		$Label1->SetText(GetCetakHTML($param_arr));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($param_arr) {
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>DAFTAR PENDAFTARAN WP</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >NAMA WP</th>';
	$output.='<th align="center" >ALAMAT</th>';
	$output.='<th align="center" >OBJEK PAJAK</th>';
	$output.='<th align="center" >ALAMAT</th>';
	$output.='<th align="center" >BAP</th>';
	$output.='<th align="center" >NOTA DINAS</th>';
	$output.='<th align="center" >PENGUKUHAN</th>';
	$output.='<th align="center" >TANDA TERIMA</th>';
	$output.='<th align="center" >KARTU NPWPD</th>';
	$output.='<th align="center" >KARTU NPWPD v2</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select * from t_vat_registration where
	npwpd ilike '%".$param_arr['search']."%'
	or wp_name ilike '%".$param_arr['search']."%'
	or company_brand ilike '%".$param_arr['search']."%'
	ORDER BY wp_name";
		
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['npwpd'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['wp_address_name'].'</td>';
		$output.='<td align="left" >'.$data[$i]['company_brand'].'</td>';
		$output.='<td align="left" >'.$data[$i]['brand_address_name'].'</td>';
		$output.='<td align="center" ><input id="cetak_bap" class="btn_tambah" onclick="cetak_bap('.$data[$i]['t_customer_order_id'].'); return false;" value="cetak_BAP" type="button">';
		$output.='<td align="center" ><input id="cetak_nota_dinas" class="btn_tambah" onClick="cetak_nota_dinas('.$data[$i]['t_customer_order_id'].')" value="cetak_nota_dinas" type="button">';
		$output.='<td align="center" ><input id="cetak_pegukuhan" class="btn_tambah" onclick="cetak_pengukuhan('.$data[$i]['t_customer_order_id'].'); return false;" value="cetak_pengukuhan" type="button">';
		$output.='<td align="center" ><input id="cetak_tanda_terima" class="btn_tambah" onclick="cetak_tanda_terima('.$data[$i]['t_customer_order_id'].'); return false;" value="cetak_tanda_terima" type="button"></td>';
		$output.='<td align="center" ><input id="cetak_kartu_npwpd" class="btn_tambah" onclick="cetak_kartu_npwpd('.$data[$i]['t_customer_order_id'].'); return false;" value="cetak_kartu_npwpd" type="button"></td>';
		$output.='<td align="center" ><input id="cetak_kartu_npwpd_v2" class="btn_tambah" onclick="cetak_kartu_npwpd_v2('.$data[$i]['t_customer_order_id'].'); return false;" value="cetak_kartu_npwpd_v2" type="button"></td>';
		$output.='</tr>';
	}

	$output.='</table>';
	
	return $output;
}
?>

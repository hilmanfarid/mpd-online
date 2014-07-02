<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-8638B313
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_wp_registration_list; //Compatibility
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

//Page_BeforeShow @1-1EEAE262
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_wp_registration_list; //Compatibility
//End Page_BeforeShow

//Custom Code @562-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;
	$tampil = CCGetFromGet('tampil');
	if($tampil=='T'){
		$Label1->SetText("<table border=1><tr><td>tes</td></tr></table>");
		$tgl_penerimaan			= CCGetFromGet("tgl_penerimaan", "");//'15-12-2013';
		$tgl_penerimaan_last	= CCGetFromGet("tgl_penerimaan_last", "");//'15-12-2013';
		$jenis_pajak			= CCGetFromGet("jenis_pajak", 0);;
		// $tgl_penerimaan		= '15-12-2013';

		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		if ($jenis_pajak == 0 || $jenis_pajak == "" ){
			$query				= "select a.*, b.vat_code, c.code as account_status from t_cust_account a
			left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id
			left join p_account_status c on c.p_account_status_id = a.p_account_status_id
			where trunc(registration_date) >= to_date('$tgl_penerimaan')
			AND trunc(registration_date) <= to_date('$tgl_penerimaan_last')
			ORDER BY registration_date ASC";
		}else{
			$query				= "select a.*, b.vat_code, c.code as account_status from t_cust_account a
			left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id
			left join p_account_status c on c.p_account_status_id = a.p_account_status_id
			where trunc(registration_date) >= to_date('$tgl_penerimaan')
			AND trunc(registration_date) <= to_date('$tgl_penerimaan_last')
			AND a.p_vat_type_id = $jenis_pajak
			ORDER BY registration_date ASC";
		}
		//echo $query;
		//exit;

		$tgl_penerimaan		= str_replace("'", "", $tgl_penerimaan);
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data["t_cust_account_id"][]= $dbConn->f("t_cust_account_id");
			$data["t_customer_id"][]	= $dbConn->f("t_customer_id");
			$data["npwd"][]				= $dbConn->f("npwd");
			$data["vat_code"][]			= $dbConn->f("vat_code");
			$data["registration_date"][]= $dbConn->f("registration_date");
			$data["wp_name"][]		= $dbConn->f("wp_name");
			$data["wp_address_name"][]	= $dbConn->f("wp_address_name");
			$data["company_name"][]		= $dbConn->f("company_name");
			$data["address_name"][]		= $dbConn->f("address_name");
			$data["account_status"][]	= $dbConn->f("account_status");
		}

		$dbConn->close();
		$Label1->SetText(PageCetak($data,$user,$tgl_penerimaan,$tgl_penerimaan_last));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function PageCetak($data, $user, $tgl_penerimaan, $tgl_penerimaan_last) {
		$output='';
		
		$output.='<table>
					<tr>';
		$output='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td valign="top">
              <table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  <td class="th"><strong></strong></td> 
                  <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                </tr>
              </table>
 
              <table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


		$output.='<th>NO</th>';
		$output.='<th>AYAT</th>';
		$output.='<th>NPWD</th>';
		$output.='<th>NAMA WP</th>';
		$output.='<th>ALAMAT</th>';
		$output.='<th>TANGGAL REGISTRASI</th>';
		$output.='<th>STATUS WP</th>';
		$output.='</tr>';
				
		$no = 1;
		
		for ($i = 0; $i < count($data['npwd']); $i++) {
			//print data
			$output.='<tr>';
			$output.='<td>'.$no.'</td>
					 <td>'.strtoupper($data["vat_code"][$i]).'</td>
					 <td>'.strtoupper($data["npwd"][$i]).'</td>
					 <td>'.strtoupper($data["wp_name"][$i]).'</td>
					 <td>'.strtoupper($data["wp_address_name"][$i]).'</td>
					 <td>'.$data["registration_date"][$i].'</td>
					 <td>'.strtoupper($data["account_status"][$i]).'</td>';
			$output.='</tr>';
			$no++;
		}

		$output.='</table></table>';
		return $output;
	}
?>

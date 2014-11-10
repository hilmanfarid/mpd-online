<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-A249F415
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list_check_date; //Compatibility
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

//Page_BeforeShow @1-D266F3B0
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list_check_date; //Compatibility
//End Page_BeforeShow

//Custom Code @703-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Label1;

	if(CCGetFromGet("doAction")=="html"){
		$s_keyword		= CCGetFromGet("s_keyword", "");
		$date_start_laporan		= CCGetFromGet("date_start_laporan", "");
		$date_end_laporan		= CCGetFromGet("date_end_laporan", "");
		
		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		
		$query	= "SELECT * FROM t_payment_receipt_bphtb x
			LEFT JOIN t_bphtb_registration y ON y.t_bphtb_registration_id = x.t_bphtb_registration_id
			LEFT JOIN t_customer_order z ON y.t_customer_order_id = z.t_customer_order_id
			WHERE
				check_date IS NOT NULL
			AND wp_name ILIKE '%$s_keyword%'";
			
		if ($date_end_laporan != "" && $date_start_laporan !=""){
			$query .= "AND(check_date BETWEEN to_date ('$date_start_laporan') AND ('$date_end_laporan'))";
		}else{
			if ($date_end_laporan != ""){
				$query .= "AND(check_date <= to_date ('$date_end_laporan') )";
			}
			if ($date_start_laporan != ""){
				$query .= "AND(check_date >= to_date ('$date_start_laporan') )";
			}
		}
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data[]= array(
			"wp_name"	=> $dbConn->f("wp_name"),
			"order_no"	=> $dbConn->f("order_no"),
			"receipt_no"	=> $dbConn->f("receipt_no"),
			"check_date"		=> $dbConn->f("check_date"),
			"wp_address_name"	=> $dbConn->f("wp_address_name"),
			"t_payment_receipt_id"		=> $dbConn->f("t_payment_receipt_id"),
			"t_bphtb_registration_id"		=> $dbConn->f("t_bphtb_registration_id"),
			"bphtb_registration_no"			=> $dbConn->f("bphtb_registration_no"),
			"t_customer_order_id"		=> $dbConn->f("t_customer_order_id"),
			"payment_date"		=> $dbConn->f("payment_date"),
			"payment_vat_amount"		=> $dbConn->f("payment_vat_amount"));
		}
		$dbConn->close();

		$Label1->SetText(GetCetakHTML($data));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetCetakHTML($data) {
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0" width="100%">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                  		<td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                  		<td class="th"><strong>LAPORAN PAJAK BPHTB "BODONG"</strong></td> 
                  		<td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                	</tr>
              		</table>';
	//$output .= '<h2>TANGGAL : '.dateToString($date_start, "-")." s/d ".dateToString($date_end, "-").'</h2> <br/>';

	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px">
                <tr class="Caption">';


	$output.='<th>NO</th>';
	$output.='<th>NAMA WP</th>';
	$output.='<th>ALAMAT WP</th>';
	$output.='<th>TANGGAL CEK</th>';
	$output.='<th>NO. KWITANSI</th>';
	$output.='<th>TANGGAL BAYAR</th>';
	$output.='<th>NO. REGISTRASI</th>';
	$output.='<th>NILAI PAJAK</th>';
	$output.='<th>NO. ORDER</th>';
	$output.='</tr>';
	$i=1;
	foreach($data as $item) {
		$output .= '<tr>';
		$output .= '<td align="center">'.($i).'</td>';
		$output .= '<td align="left">'.$item["wp_name"].'</td>';
		$output .= '<td align="left">'.$item["wp_address_name"].'</td>';
		$output .= '<td align="left">'.$item["check_date"].'</td>';
		$output .= '<td align="left">'.$item["receipt_no"].'</td>';
		$output .= '<td align="left">'.$item["payment_date"].'</td>';
		$output .= '<td align="left">'.$item["bphtb_registration_no"].'</td>';
		$output .= '<td align="right">'.number_format($item["payment_vat_amount"], 2, ',', '.').'</td>';
		$output .= '<td align="left">'.$item["order_no"].'</td>';
		$i++;
	}
	$output.='</table>';
	
	return $output;
}
?>

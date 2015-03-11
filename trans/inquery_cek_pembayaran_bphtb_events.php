<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-3B6F7822
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $inquery_cek_pembayaran_bphtb; //Compatibility
//End Page_OnInitializeView

//Custom Code @294-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-813FD867
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $inquery_cek_pembayaran_bphtb; //Compatibility
//End Page_BeforeShow

//Custom Code @295-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	global $Label1;

	$registration_no = CCGetFromGet('registration_no');
	$output = '';

	if(!empty($registration_no)) {
		
		$query = "SELECT a.registration_no, to_char(a.creation_date, 'DD-MM-YYYY') as creation_date, a.wp_name, a.njop_pbb, 
				a.land_area, a.building_area, a.bphtb_amt_final, b.receipt_no, to_char(b.payment_date, 'DD-MM-YYYY') as payment_date
                            FROM t_bphtb_registration AS a
                            LEFT JOIN t_payment_receipt_bphtb AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
                            WHERE a.registration_no = '".trim($registration_no)."'";
		
		$dbConn	= new clsDBConnSIKP();
		$item = array();
		$item['registration_no'] = '';
		$item['creation_date'] = '';
		$item['wp_name'] = '';
		$item['njop_pbb'] = '';
		$item['land_area'] = '';
		$item['building_area'] = '';
		$item['bphtb_amt_final'] = '';
		$item['receipt_no'] = '';
		$item['payment_date'] = '';

		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$item = $dbConn->Record;
		}
		$dbConn->close();
		
		if(empty($item['receipt_no'])) { //ketika no bayar kosong

			if(empty($item['registration_no'])) { // no registrasi tidak ada
            	$output = '<table class="Record" cellspacing="0" cellpadding="5" style="font-size:15px;padding-left:15px;" border="0">
				<tr>
					<td colspan="3">Nomer Registrasi : <b>'.$registration_no.'</b> <b style="color:#FF0000;">TIDAK DITEMUKAN</b></td>
				</tr>
				</table>';
            }else {
                
            	
				$output = '<table class="Record" cellspacing="0" cellpadding="5" style="font-size:15px;padding-left:15px;" border="0">
				<tr>
					<td colspan="3">Status Pembayaran atas Nomer Registrasi: <b>'.$registration_no.'</b>. <b style="color:#FF0000;">BELUM DIBAYAR</b></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3"><u><b>INFO DETAIL : </b></u></td>
				</tr>
				<tr>
					<td width="150"> Nama WP</td>
					<td width="5">:</td>
					<td>'.$item["wp_name"].'</td>	
				</tr>
				<tr>
					<td> Tanggal Daftar </td>
					<td>:</td>
					<td>'.$item["creation_date"].'</td>	
				</tr>
				<tr>
					<td> NOP </td>
					<td>:</td>
					<td>'.$item["njop_pbb"].'</td>	
				</tr>
				<tr>
					<td> LT/LB (m<sup>2</sup>)</td>
					<td>:</td>
					<td>'.$item["land_area"].' / '.$item["building_area"].'</td>	
				</tr>
				<tr>
					<td> Nilai Pajak </td>
					<td>:</td>
					<td>Rp.'.number_format($item["bphtb_amt_final"], 0, ',', '.').'</td>	
				</tr>
				<tr>
					<td> No Bukti Pembayaran </td>
					<td>:</td>
					<td> - </td>	
				</tr>
				<tr>
					<td> Tanggal Pembayaran </td>
					<td>:</td>
					<td> - </td>	
				</tr>
			</table>';

			}

		}else {
			
			$output = '<table class="Record" cellspacing="0" cellpadding="5" style="font-size:15px;padding-left:15px;" border="0">
				<tr>
					<td colspan="3">Status Pembayaran atas Nomer Registrasi: <b>'.$registration_no.'</b>. <b style="color:#008000;">SUDAH DIBAYAR</b></td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3"><u><b>INFO DETAIL : </b></u></td>
				</tr>
				<tr>
					<td width="150"> Nama WP</td>
					<td width="5">:</td>
					<td>'.$item["wp_name"].'</td>	
				</tr>
				<tr>
					<td> Tanggal Daftar </td>
					<td>:</td>
					<td>'.$item["creation_date"].'</td>	
				</tr>
				<tr>
					<td> NOP </td>
					<td>:</td>
					<td>'.$item["njop_pbb"].'</td>	
				</tr>
				<tr>
					<td> LT/LB (m<sup>2</sup>)</td>
					<td>:</td>
					<td>'.$item["land_area"].' / '.$item["building_area"].'</td>	
				</tr>
				<tr>
					<td> Nilai Pajak </td>
					<td>:</td>
					<td>Rp.'.number_format($item["bphtb_amt_final"], 0, ',', '.').'</td>	
				</tr>
				<tr>
					<td> No Bukti Pembayaran </td>
					<td>:</td>
					<td>'.$item["receipt_no"].'</td>	
				</tr>
				<tr>
					<td> Tanggal Pembayaran </td>
					<td>:</td>
					<td>'.$item["payment_date"].'</td>	
				</tr>
			</table>';

		}

	}
	
	$Label1->SetText('<table style="WIDTH:98%; margin-left:5px;margin-right:5px;" cellspacing="0" cellpadding="0" border="0"><tr><td align="center">
			<table class="grid-table" cellspacing="0" cellpadding="0" border="0">
                  <tr>
                    <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
                    <td class="th"><strong>INFORMASI PEMBAYARAN BPHTB</strong></td> 
                    <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
                  </tr>
                </table>
			
	</td></tr>
	<tr>
		<td>'.$output.'</td>
	</tr>
	</table>');
//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>

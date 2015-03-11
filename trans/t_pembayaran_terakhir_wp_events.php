<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-8FA743FD
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pembayaran_terakhir_wp; //Compatibility
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

//Page_BeforeShow @1-A5EFF2FA
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pembayaran_terakhir_wp; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	if($doAction == 'view_html') {
		$param_arr['npwpd'] = strtoupper(CCGetFromGet('npwpd'));
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
	
	$dbConn	= new clsDBConnSIKP();
	$query="select * from t_payment_receipt where npwd = '".$param_arr['npwpd']."'
		ORDER BY payment_date desc limit 1";
	//echo $query;exit;

	$dbConn->query($query);
	if ($dbConn->next_record()) {
		$data = $dbConn->Record;
		$output ='';
		$output .='<table class="grid-table" cellspacing="0" cellpadding="0" border="0"> 
	                  <tr>
	                    <td class="HeaderLeft"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td> 
	                    <td class="th"><strong>INFORMASI PEMBAYARAN</strong></td> 
	                    <td class="HeaderRight"><img border="0" alt="" src="../Styles/sikp/Images/Spacer.gif"></td>
	                  </tr>
	                </table>';
		$output .= '<table class="Record" cellspacing="0" cellpadding="5" style="font-size:15px;padding-left:15px;" border="0">
				<tr> 
					<td colspan="3">Pembayaran Terakhir untuk NPWPD : <b>'.$param_arr['npwpd'].'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3"><u><b>INFO DETAIL : </b></u></td>
				</tr>'; 
			$output.='<tr>';
				$output.='<td width="150"> NPWPD';
				$output.='</td>';
				$output.='<td> : '.$data['npwd'];
				$output.='</td>';
			$output.='</tr>';
			$output.='<tr>';
				$output.='<td> Periode Pajak';
				$output.='</td>';
				$output.='<td> : '.$data['finance_period_code'];
				$output.='</td>';
			$output.='</tr>';
			$output.='<tr>';
				$output.='<td> Total Pajak';
				$output.='</td>';
				$output.='<td> : Rp. '.number_format($data['payment_vat_amount'], 2, ',', '.');
				$output.='</td>';
			$output.='</tr>';
		$output.='</table>';
	}else{
		$output = '<table class="Record" cellspacing="0" cellpadding="5" style="font-size:15px;padding-left:15px;" border="0">
		<tr>
			<td colspan="3">NPWPD : <b>'.$param_arr['npwpd'].'</b> <b style="color:#FF0000;">TIDAK DITEMUKAN</b></td>
		</tr>
		</table>';
	}
	$dbConn->close();
	return $output;
}
?>

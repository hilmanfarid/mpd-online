<?php
//BindEvents Method @1-A49AC64C
function BindEvents()
{
    global $grafik_pembayaran_form;
    global $CCSEvents;
    $grafik_pembayaran_form->Button2->CCSEvents["OnClick"] = "grafik_pembayaran_form_Button2_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//grafik_pembayaran_form_Button2_OnClick @20-F6DB7EB7
function grafik_pembayaran_form_Button2_OnClick(& $sender)
{
    $grafik_pembayaran_form_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grafik_pembayaran_form; //Compatibility
//End grafik_pembayaran_form_Button2_OnClick

//Custom Code @71-2A29BDB7
// -------------------------
    // Write your own code here.
	$app_user_name = $grafik_pembayaran_form->app_user_name->GetValue();
	$mobile_no = $grafik_pembayaran_form->mobile_no->GetValue();
	$message = $grafik_pembayaran_form->message->GetValue();
	
	$dbConn = new clsDBConnSIKP();
	$query = 	"INSERT INTO t_sms_outbox(
			            npwpd, mobile_no, message, is_sent, date_added, message_type)
			    VALUES ('".$app_user_name."', '".$mobile_no."', '".$message."', 'N', sysdate, 'SMS_BLAST')";
	$dbConn->query($query);
	if ($dbConn->next_record()){
		echo "<script>
				alert ('SMS akan segera dikirim.');
			</script>";
	}else{
		echo "<script>
				alert ('SMS tidak berhasil dikirim.');
			</script>";
	}
	exit;
// -------------------------
//End Custom Code

//Close grafik_pembayaran_form_Button2_OnClick @20-8AF2D859
    return $grafik_pembayaran_form_Button2_OnClick;
}
//End Close grafik_pembayaran_form_Button2_OnClick

//Page_OnInitializeView @1-3B2635FC
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_send_sms_to_app_user; //Compatibility
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
 

?>

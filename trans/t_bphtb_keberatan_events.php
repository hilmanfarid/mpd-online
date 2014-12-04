<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-04ADD081
function BindEvents()
{
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementForm->Button1->CCSEvents["OnClick"] = "t_vat_setllementForm_Button1_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_setllementForm_Button1_OnClick @164-C9D1FC75
function t_vat_setllementForm_Button1_OnClick(& $sender)
{
    $t_vat_setllementForm_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_Button1_OnClick

//Custom Code @165-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();
	$User = CCGetUserLogin();
	$t_bphtb_registration_id = $t_vat_setllementForm->t_bphtb_registration_id->GetValue();
	$alasan = $t_vat_setllementForm->alasan->GetValue();
	$njop_pbb= $t_vat_setllementForm->njop_pbb->GetValue();
	$bphtb_amt_final= $t_vat_setllementForm->bphtb_amt_final->GetValue();
	$bphtb_amt_final_keberatan= $t_vat_setllementForm->bphtb_amt_final_keberatan->GetValue();
	
	$errorMsg = '';

	$sql = "select * from f_insert_bphtb_keberatan(".$t_bphtb_registration_id.
		",19,".$bphtb_amt_final_keberatan.",".$bphtb_amt_final.
		",'".$alasan."','".$User."')";
	//echo $sql;
	//die($sql);
	$dbConn->query($sql);
	$dbConn->next_record();
	$t_bphtb_keberatan_id = $dbConn->f("o_t_bphtb_keberatan_id");
	$t_customer_order_id = $dbConn->f("o_t_customer_order_id");
	$mess = $dbConn->f("o_mess");
	
	$sql = "select sikp.f_first_submit_engine(511,".$t_customer_order_id.",'".CCGetSession('UserLogin')."')";
	$dbConn->query($sql);

	//modified by wiliam
	echo "<script> 
		alert('".$mess."');
		window.opener.location.reload();
		window.close();
	</script>";
	
// -------------------------


//Close t_vat_setllementForm_Button1_OnClick @164-6DBB2532
    //return $t_vat_setllementForm_Button1_OnClick;
}
//End Close t_vat_setllementForm_Button1_OnClick

//Page_OnInitializeView @1-4BE77A0D
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_keberatan; //Compatibility
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
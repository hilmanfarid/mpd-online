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
	$cusAccId = $t_vat_setllementForm->t_cust_account_id->GetValue();
	$Period = $t_vat_setllementForm->p_finance_period_id->GetValue();
	$yearPeriod = $t_vat_setllementForm->p_year_period_id->GetValue();
	$npwd = $t_vat_setllementForm->npwd->GetValue(); 	
	$ms_start = $t_vat_setllementForm->start_period->GetValue();
	$ms_end = $t_vat_setllementForm->end_period->GetValue();
	$kamar = trim($t_vat_setllementForm->qty_room_sold->GetValue());
	$tot = $t_vat_setllementForm->total_trans_amount->GetValue();
	$p_vat_type_dtl_id = $t_vat_setllementForm->p_vat_type_dtl_id->GetValue();
	$p_vat_type_dtl_cls_id = $t_vat_setllementForm->p_vat_type_dtl_cls_id->GetValue();
	$User = CCGetUserLogin();
	
	$errorMsg = '';

	//new fix
	if(!isset($p_vat_type_dtl_cls_id) || $p_vat_type_dtl_cls_id == '') $p_vat_type_dtl_cls_id = 'NULL';
	if(empty($kamar)) $kamar = 0;	

	$sql = "select * from f_vat_settlement_manual_skpdkb($cusAccId,$Period,'$npwd','$ms_start','$ms_end',$kamar,$tot,$p_vat_type_dtl_id,$p_vat_type_dtl_cls_id,'$User')";
	
	$dbConn->query($sql);
	$dbConn->next_record();
	$cust_id = $dbConn->f("o_cust_order_id");
	$mess = $dbConn->f("o_mess");

	//modified by wiliam
	echo "<script> 
		alert('".$mess."');
		window.opener.location.reload();
		window.close();
	</script>";
	
	exit;
	
// -------------------------


//Close t_vat_setllementForm_Button1_OnClick @164-6DBB2532
    return $t_vat_setllementForm_Button1_OnClick;
}
//End Close t_vat_setllementForm_Button1_OnClick

//Page_OnInitializeView @1-F60F4401
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_manual_skpdkb; //Compatibility
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
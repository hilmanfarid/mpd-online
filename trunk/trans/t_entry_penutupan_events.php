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
	$User = CCGetUserLogin();
	$p_account_status_id = $t_vat_setllementForm->p_account_status_id->GetValue();
	$reason_status_id = $t_vat_setllementForm->reason_status_id->GetValue();
	$reason_description = $t_vat_setllementForm->reason_description->GetValue();
	
	$errorMsg = '';

	//new fix
	if(!isset($p_vat_type_dtl_cls_id) || $p_vat_type_dtl_cls_id == '') $p_vat_type_dtl_cls_id = 'NULL';
	if(empty($kamar)) $kamar = 0;	

	$sql = "select * from f_entry_mutasi_status_wp(".$cusAccId.",15,".$p_account_status_id.",".$reason_status_id.",'".$reason_description."','".$User."')";
	//echo $sql;
	//die($sql);
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

//Page_OnInitializeView @1-AEB11E0B
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_entry_penutupan; //Compatibility
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
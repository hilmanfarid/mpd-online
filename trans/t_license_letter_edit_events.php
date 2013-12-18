<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-9D6A8F16
function BindEvents()
{
    global $t_license_letterForm;
    global $CCSEvents;
    $t_license_letterForm->ds->CCSEvents["AfterExecuteInsert"] = "t_license_letterForm_ds_AfterExecuteInsert";
    $t_license_letterForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_license_letterForm_ds_AfterExecuteUpdate";
    $t_license_letterForm->ds->CCSEvents["AfterExecuteDelete"] = "t_license_letterForm_ds_AfterExecuteDelete";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_license_letterForm_ds_AfterExecuteInsert @94-F3D412F8
function t_license_letterForm_ds_AfterExecuteInsert(& $sender)
{
    $t_license_letterForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_license_letterForm; //Compatibility
//End t_license_letterForm_ds_AfterExecuteInsert

//Custom Code @680-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_license_letterForm->t_vat_registration_id->GetValue();
		$code = $t_license_letterForm->rqst_type_code->GetValue();
		$id_req = $t_license_letterForm->p_rqst_type_id->GetValue();
		$id_cus = $t_license_letterForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>"); 
		exit;
// -------------------------
//End Custom Code

//Close t_license_letterForm_ds_AfterExecuteInsert @94-B1F58B8D
    return $t_license_letterForm_ds_AfterExecuteInsert;
}
//End Close t_license_letterForm_ds_AfterExecuteInsert

//t_license_letterForm_ds_AfterExecuteUpdate @94-43401845
function t_license_letterForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_license_letterForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_license_letterForm; //Compatibility
//End t_license_letterForm_ds_AfterExecuteUpdate

//Custom Code @681-2A29BDB7
// -------------------------
    // Write your own code here.
	    $id_vat = $t_license_letterForm->t_vat_registration_id->GetValue();
		$code = $t_license_letterForm->rqst_type_code->GetValue();
		$id_req = $t_license_letterForm->p_rqst_type_id->GetValue();
		$id_cus = $t_license_letterForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_license_letterForm_ds_AfterExecuteUpdate @94-7EDC4A02
    return $t_license_letterForm_ds_AfterExecuteUpdate;
}
//End Close t_license_letterForm_ds_AfterExecuteUpdate

//t_license_letterForm_ds_AfterExecuteDelete @94-4E564EED
function t_license_letterForm_ds_AfterExecuteDelete(& $sender)
{
    $t_license_letterForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_license_letterForm; //Compatibility
//End t_license_letterForm_ds_AfterExecuteDelete

//Custom Code @682-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_license_letterForm->t_vat_registration_id->GetValue();
		$code = $t_license_letterForm->rqst_type_code->GetValue();
		$id_req = $t_license_letterForm->p_rqst_type_id->GetValue();
		$id_cus = $t_license_letterForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_license_letterForm_ds_AfterExecuteDelete @94-E2F8EC73
    return $t_license_letterForm_ds_AfterExecuteDelete;
}
//End Close t_license_letterForm_ds_AfterExecuteDelete

//Page_OnInitializeView @1-AB74CDFE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_license_letter_edit; //Compatibility
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

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-7F7C225D
function BindEvents()
{
    global $t_vat_reg_dtl_ppjForm;
    global $CCSEvents;
    $t_vat_reg_dtl_ppjForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert";
    $t_vat_reg_dtl_ppjForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_ppjForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert @875-228A10DB
function t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjForm; //Compatibility
//End t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert

//Custom Code @897-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_dtl_ppjForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_dtl_ppjForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_dtl_ppjForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_dtl_ppjForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>"); 
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert @875-8062121A
    return $t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert

//t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate @875-1BE7CFD6
function t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjForm; //Compatibility
//End t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate

//Custom Code @898-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_dtl_ppjForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_dtl_ppjForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_dtl_ppjForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_dtl_ppjForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate @875-4F4BD395
    return $t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete @875-7C04795C
function t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjForm; //Compatibility
//End t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete

//Custom Code @899-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_dtl_ppjForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_dtl_ppjForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_dtl_ppjForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_dtl_ppjForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete @875-D36F75E4
    return $t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteDelete

//Page_OnInitializeView @1-E0DBFDA4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppj_non_pln_edit; //Compatibility
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

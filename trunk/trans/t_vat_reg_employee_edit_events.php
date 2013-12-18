<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-8CFD0D9C
function BindEvents()
{
    global $t_vat_reg_employeeForm;
    global $CCSEvents;
    $t_vat_reg_employeeForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_employeeForm_ds_AfterExecuteUpdate";
    $t_vat_reg_employeeForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_employeeForm_ds_AfterExecuteInsert";
    $t_vat_reg_employeeForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_employeeForm_ds_AfterExecuteDelete";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_employeeForm_ds_AfterExecuteUpdate @94-6E4EE4EE
function t_vat_reg_employeeForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_employeeForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeForm; //Compatibility
//End t_vat_reg_employeeForm_ds_AfterExecuteUpdate

//Custom Code @754-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_employeeForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_employeeForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_employeeForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_employeeForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeForm_ds_AfterExecuteUpdate @94-AEDD67F7
    return $t_vat_reg_employeeForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_employeeForm_ds_AfterExecuteUpdate

//t_vat_reg_employeeForm_ds_AfterExecuteInsert @94-730FAFCD
function t_vat_reg_employeeForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_employeeForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeForm; //Compatibility
//End t_vat_reg_employeeForm_ds_AfterExecuteInsert

//Custom Code @755-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_employeeForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_employeeForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_employeeForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_employeeForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>"); 
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeForm_ds_AfterExecuteInsert @94-61F4A678
    return $t_vat_reg_employeeForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_employeeForm_ds_AfterExecuteInsert

//t_vat_reg_employeeForm_ds_AfterExecuteDelete @94-4F742FAB
function t_vat_reg_employeeForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_employeeForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeForm; //Compatibility
//End t_vat_reg_employeeForm_ds_AfterExecuteDelete

//Custom Code @756-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_employeeForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_employeeForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_employeeForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_employeeForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeForm_ds_AfterExecuteDelete @94-32F9C186
    return $t_vat_reg_employeeForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_employeeForm_ds_AfterExecuteDelete

//Page_OnInitializeView @1-B3761EE8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employee_edit; //Compatibility
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

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
		$CustAccId = $t_vat_reg_employeeForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_employeeForm->customer_name->GetValue();
		$CustId = $t_vat_reg_employeeForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
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
		$CustAccId = $t_vat_reg_employeeForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_employeeForm->customer_name->GetValue();
		$CustId = $t_vat_reg_employeeForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
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

//Custom Code @764-2A29BDB7
// -------------------------
    // Write your own code here.
	$id_vat = $t_vat_reg_employeeForm->t_cust_account_id->GetValue();
	$redirectloader = "data_potensi_update.php?t_cust_account_id=".$id_vat;
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

//Page_OnInitializeView @1-9A96D61A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_pegawai_edit; //Compatibility
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

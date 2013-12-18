<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-86B0600F
function BindEvents()
{
    global $t_vat_reg_dtl_ppjForm;
    global $CCSEvents;
    $t_vat_reg_dtl_ppjForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_ppjForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate @94-1BE7CFD6
function t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjForm; //Compatibility
//End t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate

//Custom Code @873-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_ppjForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_ppjForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_ppjForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate @94-4F4BD395
    return $t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert @94-228A10DB
function t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjForm; //Compatibility
//End t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert

//Custom Code @880-2A29BDB7
// -------------------------
    // Write your own code here.
	    $CustAccId = $t_vat_reg_dtl_ppjForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_ppjForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_ppjForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert @94-8062121A
    return $t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_ppjForm_ds_AfterExecuteInsert

//Page_OnInitializeView @1-8565B6F2
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_ppj_edit; //Compatibility
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

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-AED23B12
function BindEvents()
{
    global $t_vat_reg_dtl_hotelForm;
    global $CCSEvents;
    $t_vat_reg_dtl_hotelForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_hotelForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert";
    $t_vat_reg_dtl_hotelForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate @94-9DC486D3
function t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotelForm; //Compatibility
//End t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate

//Custom Code @754-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_hotelForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_hotelForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_hotelForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate @94-B1F36A87
    return $t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_hotelForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert @94-5D62138D
function t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotelForm; //Compatibility
//End t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert

//Custom Code @766-2A29BDB7
// -------------------------
    // Write your own code here.
	    $CustAccId = $t_vat_reg_dtl_hotelForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_hotelForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_hotelForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert @94-7EDAAB08
    return $t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_hotelForm_ds_AfterExecuteInsert

//t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete @94-7DD5AC88
function t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotelForm; //Compatibility
//End t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete

//Custom Code @767-2A29BDB7
// -------------------------
    // Write your own code here.
	$CustAccId = $t_vat_reg_dtl_hotelForm->t_cust_account_id->GetValue();
	$cusName = $t_vat_reg_dtl_hotelForm->customer_name->GetValue();
	$CustId = $t_vat_reg_dtl_hotelForm->t_customer_id->GetValue();
	$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
	echo ("<script language='javascript'>");
    echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
	echo (" window.close(); ");
	echo ("</script>");
	exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete @94-2DD7CCF6
    return $t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_dtl_hotelForm_ds_AfterExecuteDelete

//Page_OnInitializeView @1-E1BB5CBD
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_hotel_edit; //Compatibility
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

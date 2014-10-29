<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-DC582E40
function BindEvents()
{
    global $t_vat_reg_dtl_entertaintmentForm;
    global $CCSEvents;
    $t_vat_reg_dtl_entertaintmentForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert";
    $t_vat_reg_dtl_entertaintmentForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_entertaintmentForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete";
    $t_vat_reg_dtl_entertaintmentForm->CCSEvents["BeforeSelect"] = "t_vat_reg_dtl_entertaintmentForm_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert @94-4CEB7603
function t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_entertaintmentForm; //Compatibility
//End t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert

//Custom Code @823-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_entertaintmentForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_entertaintmentForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_entertaintmentForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert @94-635DD526
    return $t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteInsert

//t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate @94-3C8E22B5
function t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_entertaintmentForm; //Compatibility
//End t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate

//Custom Code @824-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_entertaintmentForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_entertaintmentForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_entertaintmentForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate @94-AC7414A9
    return $t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete @94-47E1C5FD
function t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_entertaintmentForm; //Compatibility
//End t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete

//Custom Code @825-2A29BDB7
// -------------------------
    // Write your own code here.
	$id_vat = $t_vat_reg_dtl_entertaintmentForm->t_cust_account_id->GetValue();
	$redirectloader = "data_potensi_update.php?t_cust_account_id=".$id_vat;
	echo ("<script language='javascript'>");
    echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
	echo (" window.close(); ");
	echo ("</script>");
	exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete @94-3050B2D8
    return $t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_dtl_entertaintmentForm_ds_AfterExecuteDelete

//t_vat_reg_dtl_entertaintmentForm_BeforeSelect @94-563F8B0C
function t_vat_reg_dtl_entertaintmentForm_BeforeSelect(& $sender)
{
    $t_vat_reg_dtl_entertaintmentForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_entertaintmentForm; //Compatibility
//End t_vat_reg_dtl_entertaintmentForm_BeforeSelect

//Custom Code @826-2A29BDB7
// -------------------------
    // Write your own code here.
	$idVat = $t_vat_reg_dtl_entertaintmentForm->t_cust_account_id->GetValue();
	$dbConn = new clsDBConnSIKP();
	$sql = "select a.p_vat_type_dtl_id, b.vat_code as entertaintment_name "
		  ."from t_cust_account a, p_vat_type_dtl b "
		  ."where a.p_vat_type_dtl_id=b.p_vat_type_dtl_id and a.t_cust_account_id = ".$idVat;
	$dbConn->query($sql);
	while ($dbConn->next_record()){
		$EnterId = $dbConn->f("p_vat_type_dtl_id");
		$EnterCode = $dbConn->f("entertaintment_name");
	}
	$t_vat_reg_dtl_entertaintmentForm->entertainment_desc->SetValue($EnterCode);
	$t_vat_reg_dtl_entertaintmentForm->p_entertaintment_type_id->SetValue($EnterId);
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_entertaintmentForm_BeforeSelect @94-A5B9FC65
    return $t_vat_reg_dtl_entertaintmentForm_BeforeSelect;
}
//End Close t_vat_reg_dtl_entertaintmentForm_BeforeSelect

//Page_OnInitializeView @1-1F41FC30
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_entertaintment_edit; //Compatibility
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

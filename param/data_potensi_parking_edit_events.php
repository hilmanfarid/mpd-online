<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-065277D7
function BindEvents()
{
    global $t_vat_reg_dtl_parkingForm;
    global $CCSEvents;
    $t_vat_reg_dtl_parkingForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_parkingForm->CCSEvents["BeforeSelect"] = "t_vat_reg_dtl_parkingForm_BeforeSelect";
    $t_vat_reg_dtl_parkingForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert";
    $t_vat_reg_dtl_parkingForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate @94-C98C938E
function t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_parkingForm; //Compatibility
//End t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate

//Custom Code @818-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_parkingForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_parkingForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_parkingForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate @94-C8838FF1
    return $t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_parkingForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_parkingForm_BeforeSelect @94-E26C9DA8
function t_vat_reg_dtl_parkingForm_BeforeSelect(& $sender)
{
    $t_vat_reg_dtl_parkingForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_parkingForm; //Compatibility
//End t_vat_reg_dtl_parkingForm_BeforeSelect

//Custom Code @822-2A29BDB7
// -------------------------
    // Write your own code here.
	$CustId = $t_vat_reg_dtl_parkingForm->t_cust_account_id->GetValue();
	$dbConn = new clsDBConnSIKP();
	$query = "select a.p_vat_type_dtl_id, b.vat_code as parking_classification_code "
  			 ."from t_cust_account a, p_vat_type_dtl b "
  			 ."where a.p_vat_type_dtl_id = b.p_vat_type_dtl_id "
  			 ."and t_cust_account_id = ".$CustId;
	$dbConn->query($query);
	while($dbConn->next_record()){
		$idd = $dbConn->f("p_vat_type_dtl_id");
		$code = $dbConn->f("parking_classification_code");
	}
	$dbConn->close();

	$t_vat_reg_dtl_parkingForm->p_parking_classification_id->SetValue($idd);
	$t_vat_reg_dtl_parkingForm->classification_desc->SetValue($code);
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_parkingForm_BeforeSelect @94-79EB8A58
    return $t_vat_reg_dtl_parkingForm_BeforeSelect;
}
//End Close t_vat_reg_dtl_parkingForm_BeforeSelect

//t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert @94-8B2F95FB
function t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_parkingForm; //Compatibility
//End t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert

//Custom Code @832-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_parkingForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_parkingForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_parkingForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert @94-07AA4E7E
    return $t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_parkingForm_ds_AfterExecuteInsert

//t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete @94-38834D52
function t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_parkingForm; //Compatibility
//End t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete

//Custom Code @833-2A29BDB7
// -------------------------
    // Write your own code here.
	$id_vat = $t_vat_reg_dtl_parkingForm->t_cust_account_id->GetValue();
	$redirectloader = "data_potensi_update.php?t_cust_account_id=".$id_vat;
	echo ("<script language='javascript'>");
    echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
	echo (" window.close(); ");
	echo ("</script>");
	exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete @94-54A72980
    return $t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_dtl_parkingForm_ds_AfterExecuteDelete

//Page_OnInitializeView @1-8088D55F
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_parking_edit; //Compatibility
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

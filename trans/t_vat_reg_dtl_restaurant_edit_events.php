<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-1BB699B3
function BindEvents()
{
    global $t_vat_reg_dtl_restaurantForm;
    global $CCSEvents;
    $t_vat_reg_dtl_restaurantForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert";
    $t_vat_reg_dtl_restaurantForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_restaurantForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete";
    $t_vat_reg_dtl_restaurantForm->CCSEvents["BeforeSelect"] = "t_vat_reg_dtl_restaurantForm_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert @94-1AE04C27
function t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantForm; //Compatibility
//End t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert

//Custom Code @816-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_dtl_restaurantForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_dtl_restaurantForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_dtl_restaurantForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_dtl_restaurantForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>"); 
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert @94-5E6DE2D0
    return $t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_restaurantForm_ds_AfterExecuteInsert

//t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate @94-3B8F3AC8
function t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantForm; //Compatibility
//End t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate

//Custom Code @817-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_dtl_restaurantForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_dtl_restaurantForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_dtl_restaurantForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_dtl_restaurantForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate @94-9144235F
    return $t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_restaurantForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete @94-FC6E2616
function t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantForm; //Compatibility
//End t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete

//Custom Code @818-2A29BDB7
// -------------------------
    // Write your own code here.
		$id_vat = $t_vat_reg_dtl_restaurantForm->t_vat_registration_id->GetValue();
		$code = $t_vat_reg_dtl_restaurantForm->rqst_type_code->GetValue();
		$id_req = $t_vat_reg_dtl_restaurantForm->p_rqst_type_id->GetValue();
		$id_cus = $t_vat_reg_dtl_restaurantForm->t_customer_order_id->GetValue();
		$redirectloader = "t_vat_reg_dtl.php?t_vat_registration_id=".$id_vat."&rqst_type_code=".$code."&p_rqst_type_id=".$id_req."&t_customer_order_id=".$id_cus."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete @94-0D60852E
    return $t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_dtl_restaurantForm_ds_AfterExecuteDelete

//t_vat_reg_dtl_restaurantForm_BeforeSelect @94-6CF617C9
function t_vat_reg_dtl_restaurantForm_BeforeSelect(& $sender)
{
    $t_vat_reg_dtl_restaurantForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantForm; //Compatibility
//End t_vat_reg_dtl_restaurantForm_BeforeSelect

//Custom Code @819-2A29BDB7
// -------------------------
    // Write your own code here.
	$idVat = $t_vat_reg_dtl_restaurantForm->t_vat_registration_id->GetValue();
	$dbConn = new clsDBConnSIKP();
	$sql = "select a.p_vat_type_dtl_id, b.vat_code as rest_service_type_code "
		  ."from t_vat_registration a, p_vat_type_dtl b "
		  ."where a.p_vat_type_dtl_id=b.p_vat_type_dtl_id(+) and a.t_vat_registration_id = ".$idVat;
	$dbConn->query($sql);
	while ($dbConn->next_record()){
		$restId = $dbConn->f("p_vat_type_dtl_id");
		$restCode = $dbConn->f("rest_service_type_code");
	}
	$t_vat_reg_dtl_restaurantForm->service_type_desc->SetValue($restCode);
	$t_vat_reg_dtl_restaurantForm->p_vat_type_dtl_id->SetValue($restId);
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantForm_BeforeSelect @94-6EBC2391
    return $t_vat_reg_dtl_restaurantForm_BeforeSelect;
}
//End Close t_vat_reg_dtl_restaurantForm_BeforeSelect

//Page_OnInitializeView @1-3F11325A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurant_edit; //Compatibility
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

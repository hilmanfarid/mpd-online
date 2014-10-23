<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-4313BD2F
function BindEvents()
{
    global $t_order_log_kronologisForm;
    global $CCSEvents;
    $t_order_log_kronologisForm->ds->CCSEvents["AfterExecuteInsert"] = "t_order_log_kronologisForm_ds_AfterExecuteInsert";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method


//t_order_log_kronologisForm_ds_AfterExecuteInsert @94-52CD4DFD
function t_order_log_kronologisForm_ds_AfterExecuteInsert(& $sender)
{
    $t_order_log_kronologisForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_order_log_kronologisForm; //Compatibility
//End t_order_log_kronologisForm_ds_AfterExecuteInsert

//Custom Code @755-2A29BDB7
// -------------------------
    // Write your own code here.
		$takenCtl = $t_order_log_kronologisForm->TAKEN_CTL->GetValue();
		$isTaken = $t_order_log_kronologisForm->IS_TAKEN->GetValue();
		$currDocId = $t_order_log_kronologisForm->CURR_DOC_ID->GetValue();
		$currDocTypeId = $t_order_log_kronologisForm->CURR_DOC_TYPE_ID->GetValue();
		$currProcId = $t_order_log_kronologisForm->CURR_PROC_ID->GetValue();
		$currCtlId = $t_order_log_kronologisForm->CURR_CTL_ID->GetValue();
		$userIdDoc = $t_order_log_kronologisForm->USER_ID_DOC->GetValue();
		$userIdDonor = $t_order_log_kronologisForm->USER_ID_DONOR->GetValue();
		$userIdLogin = $t_order_log_kronologisForm->USER_ID_LOGIN->GetValue();
		$userIdTaken = $t_order_log_kronologisForm->USER_ID_TAKEN->GetValue();
		$isCreateDoc = $t_order_log_kronologisForm->IS_CREATE_DOC->GetValue();
		$isManual = $t_order_log_kronologisForm->IS_MANUAL->GetValue();
		$currProcStatus = $t_order_log_kronologisForm->CURR_PROC_STATUS->GetValue();
		$currDocStatus = $t_order_log_kronologisForm->CURR_DOC_STATUS->GetValue();
		$prevDocId = $t_order_log_kronologisForm->PREV_DOC_ID->GetValue();
		$prevTypeDocId = $t_order_log_kronologisForm->PREV_DOC_TYPE_ID->GetValue();
		$prevProcId = $t_order_log_kronologisForm->PREV_PROC_ID->GetValue();
		$prevCtlId = $t_order_log_kronologisForm->PREV_CTL_ID->GetValue();
		$slot1 = $t_order_log_kronologisForm->SLOT_1->GetValue();
		$slot2 = $t_order_log_kronologisForm->SLOT_2->GetValue();
		$slot3 = $t_order_log_kronologisForm->SLOT_3->GetValue();
		$slot4 = $t_order_log_kronologisForm->SLOT_4->GetValue();
		$slot5 = $t_order_log_kronologisForm->SLOT_5->GetValue();
		$msg = $t_order_log_kronologisForm->MESSAGE->GetValue();
		$cusOrderId = $t_order_log_kronologisForm->t_customer_order_id->GetValue();
		$rqstId = $t_order_log_kronologisForm->p_rqst_type_id->GetValue();
		//$vatId = $t_order_log_kronologisForm->t_vat_registration_id->GetValue();

		$redirectloader = "t_order_log_kronologis_ver_penutupan.php?t_customer_order_id=".$cusOrderId
													 ."&p_rqst_type_id=".$rqstId
													 //."&t_vat_registration_id=".$vatId
													 ."&TAKEN_CTL=".$takenCtl
													 ."&IS_TAKEN=".$isTaken
													 ."&CURR_DOC_ID=".$currDocId
													 ."&CURR_DOC_TYPE_ID=".$currDocTypeId
													 ."&CURR_PROC_ID=".$currProcId
													 ."&CURR_CTL_ID=".$currCtlId
													 ."&USER_ID_DOC=".$userIdDoc
													 ."&USER_ID_DONOR=".$userIdDonor
													 ."&USER_ID_LOGIN=".$userIdLogin
													 ."&USER_ID_TAKEN=".$userIdTaken
													 ."&IS_CREATE_DOC=".$isCreateDoc
													 ."&IS_MANUAL=".$isManual
													 ."&CURR_PROC_STATUS=".$currProcStatus
													 ."&CURR_DOC_STATUS=".$currDocStatus
													 ."&PREV_DOC_ID=".$prevDocId
													 ."&PREV_DOC_TYPE_ID=".$prevTypeDocId
													 ."&PREV_PROC_ID=".$prevProcId													
													 ."&PREV_CTL_ID=".$prevCtlId
													 ."&SLOT_1=".$slot1
													 ."&SLOT_2=".$slot2
													 ."&SLOT_3=".$slot3
													 ."&SLOT_4=".$slot4
													 ."&SLOT_5=".$slot5
													 ."&MESSAGE=".$msg."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>"); 
		exit;
// -------------------------
//End Custom Code

//Close t_order_log_kronologisForm_ds_AfterExecuteInsert @94-7A42B966
    return $t_order_log_kronologisForm_ds_AfterExecuteInsert;
}
//End Close t_order_log_kronologisForm_ds_AfterExecuteInsert

//Page_OnInitializeView @1-621BF7A1
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_order_log_kronologis_form_penutupan; //Compatibility
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

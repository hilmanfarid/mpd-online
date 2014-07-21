<?php
//BindEvents Method @1-912CCACA
function BindEvents()
{
    global $t_cust_acc_status_editForm;
    $t_cust_acc_status_editForm->CCSEvents["BeforeShow"] = "t_cust_acc_status_editForm_BeforeShow";
    $t_cust_acc_status_editForm->CCSEvents["AfterInsert"] = "t_cust_acc_status_editForm_AfterInsert";
    $t_cust_acc_status_editForm->CCSEvents["AfterUpdate"] = "t_cust_acc_status_editForm_AfterUpdate";
    $t_cust_acc_status_editForm->ds->CCSEvents["AfterExecuteInsert"] = "t_cust_acc_status_editForm_ds_AfterExecuteInsert";
}
//End BindEvents Method

//t_cust_acc_status_editForm_BeforeShow @3-413CF4E3
function t_cust_acc_status_editForm_BeforeShow(& $sender)
{
    $t_cust_acc_status_editForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_status_editForm; //Compatibility
//End t_cust_acc_status_editForm_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_cust_acc_status_editForm_BeforeShow @3-12C19D09
    return $t_cust_acc_status_editForm_BeforeShow;
}
//End Close t_cust_acc_status_editForm_BeforeShow

//t_cust_acc_status_editForm_AfterInsert @3-7BD42203
function t_cust_acc_status_editForm_AfterInsert(& $sender)
{
    $t_cust_acc_status_editForm_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_status_editForm; //Compatibility
//End t_cust_acc_status_editForm_AfterInsert

//Custom Code @22-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_cust_acc_status_editForm_AfterInsert @3-006343F6
    return $t_cust_acc_status_editForm_AfterInsert;
}
//End Close t_cust_acc_status_editForm_AfterInsert

//t_cust_acc_status_editForm_AfterUpdate @3-AFD76D8D
function t_cust_acc_status_editForm_AfterUpdate(& $sender)
{
    $t_cust_acc_status_editForm_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_status_editForm; //Compatibility
//End t_cust_acc_status_editForm_AfterUpdate

//Custom Code @27-2A29BDB7
// -------------------------

	
    echo "<script> 
		//alert('".$row['msg']."');
		window.opener.location.reload();
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close t_cust_acc_status_editForm_AfterUpdate @3-CF4A8279
    return $t_cust_acc_status_editForm_AfterUpdate;
}
//End Close t_cust_acc_status_editForm_AfterUpdate

//t_cust_acc_status_editForm_ds_AfterExecuteInsert @3-C6C3469A
function t_cust_acc_status_editForm_ds_AfterExecuteInsert(& $sender)
{
    $t_cust_acc_status_editForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_status_editForm; //Compatibility
//End t_cust_acc_status_editForm_ds_AfterExecuteInsert

//Custom Code @51-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->next_record();
	$result = $Component->DataSource->Record;
	$item =json_decode($result[0]);
	echo "<script> 
			alert('".$item->message."');
			window.close();
		</script>";
	exit;
// -------------------------
//End Custom Code

//Close t_cust_acc_status_editForm_ds_AfterExecuteInsert @3-2BD2EF39
    return $t_cust_acc_status_editForm_ds_AfterExecuteInsert;
}
//End Close t_cust_acc_status_editForm_ds_AfterExecuteInsert
?>

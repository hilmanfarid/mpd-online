<?php

//BindEvents Method @1-6EE64A3E
function BindEvents()
{
    global $SELECT_x_receipt_no_x_p_f;
    global $CCSEvents;
    $SELECT_x_receipt_no_x_p_f->CCSEvents["BeforeSelect"] = "SELECT_x_receipt_no_x_p_f_BeforeSelect";
}
//End BindEvents Method

//SELECT_x_receipt_no_x_p_f_BeforeSelect @2-FDDB3403
function SELECT_x_receipt_no_x_p_f_BeforeSelect(& $sender)
{
    $SELECT_x_receipt_no_x_p_f_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SELECT_x_receipt_no_x_p_f; //Compatibility
//End SELECT_x_receipt_no_x_p_f_BeforeSelect

//Custom Code @187-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();
	$cust_acc_id = CCGetFromGet('t_cust_account_id');
	$sql = "select to_char(active_date,'dd-mm-yyyy') as active_date from t_cust_account where t_cust_account_id=".$cust_acc_id;
	$dbConn->query($sql);
	$dbConn->next_record();
	$cust_id = $dbConn->f("active_date");
	$SELECT_x_receipt_no_x_p_f->DataSource->Parameters["expr189"]=$cust_id;
// -------------------------
//End Custom Code

//Close SELECT_x_receipt_no_x_p_f_BeforeSelect @2-7D0B9252
    return $SELECT_x_receipt_no_x_p_f_BeforeSelect;
}
//End Close SELECT_x_receipt_no_x_p_f_BeforeSelect

//Page_BeforeInitialize @1-3933047A
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $getPembayaranBolong; //Compatibility
//End Page_BeforeInitialize

//Custom Code @186-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>

<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-0CE19667
function BindEvents()
{
    global $t_cust_acc_dtl_transGrid;
    global $CCSEvents;
    $t_cust_acc_dtl_transGrid->CCSEvents["BeforeSelect"] = "t_cust_acc_dtl_transGrid_BeforeSelect";
    $t_cust_acc_dtl_transGrid->CCSEvents["BeforeShowRow"] = "t_cust_acc_dtl_transGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_cust_acc_dtl_transGrid_BeforeSelect @2-29BB8904
function t_cust_acc_dtl_transGrid_BeforeSelect(& $sender)
{
    $t_cust_acc_dtl_transGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_transGrid; //Compatibility
//End t_cust_acc_dtl_transGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_cust_acc_dtl_transGrid_BeforeSelect @2-7D7C985A
    return $t_cust_acc_dtl_transGrid_BeforeSelect;
}
//End Close t_cust_acc_dtl_transGrid_BeforeSelect

//t_cust_acc_dtl_transGrid_BeforeShowRow @2-43A864FF
function t_cust_acc_dtl_transGrid_BeforeShowRow(& $sender)
{
    $t_cust_acc_dtl_transGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_transGrid; //Compatibility
//End t_cust_acc_dtl_transGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code



//Close t_cust_acc_dtl_transGrid_BeforeShowRow @2-577C572D
    return $t_cust_acc_dtl_transGrid_BeforeShowRow;
}
//End Close t_cust_acc_dtl_transGrid_BeforeShowRow


//Page_OnInitializeView @1-A34FB560
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_dtl_trans_month; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.

  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

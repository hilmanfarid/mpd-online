<?php
//BindEvents Method @1-D729CD9D
function BindEvents()
{
    global $t_executive_summary_form;
    global $CCSEvents;
    $t_executive_summary_form->CCSEvents["BeforeSelect"] = "t_executive_summary_form_BeforeSelect";
    $t_executive_summary_form->CCSEvents["AfterInsert"] = "t_executive_summary_form_AfterInsert";
    $t_executive_summary_form->CCSEvents["BeforeInsert"] = "t_executive_summary_form_BeforeInsert";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_executive_summary_form_BeforeSelect @25-A60FDDDA
function t_executive_summary_form_BeforeSelect(& $sender)
{
    $t_executive_summary_form_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_executive_summary_form; //Compatibility
//End t_executive_summary_form_BeforeSelect

//Custom Code @45-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_executive_summary_form_BeforeSelect @25-B5E19C7B
    return $t_executive_summary_form_BeforeSelect;
}
//End Close t_executive_summary_form_BeforeSelect

//t_executive_summary_form_AfterInsert @25-FDD789E2
function t_executive_summary_form_AfterInsert(& $sender)
{
    $t_executive_summary_form_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_executive_summary_form; //Compatibility
//End t_executive_summary_form_AfterInsert

//Custom Code @132-2A29BDB7
// -------------------------
    // Write your own code here.
	$t_executive_summary_form->DataSource->next_record();
	$records = $t_executive_summary_form->DataSource->Record;
	if($t_executive_summary_form->DataSource->Errors['ErrorsCount']==0){
		$dbConn = new clsDBConnSIKP();
		$sql="select sikp.f_first_submit_engine(508,".$records['o_t_customer_order_id'].",'".CCGetSession('UserLogin')."')";
		$dbConn->query($sql);
	}
// -------------------------
//End Custom Code

//Close t_executive_summary_form_AfterInsert @25-96DE34DB
    return $t_executive_summary_form_AfterInsert;
}
//End Close t_executive_summary_form_AfterInsert

//t_executive_summary_form_BeforeInsert @25-2B2157E6
function t_executive_summary_form_BeforeInsert(& $sender)
{
    $t_executive_summary_form_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_executive_summary_form; //Compatibility
//End t_executive_summary_form_BeforeInsert

//Custom Code @133-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_executive_summary_form_BeforeInsert @25-40B865D6
    return $t_executive_summary_form_BeforeInsert;
}
//End Close t_executive_summary_form_BeforeInsert

//Page_BeforeShow @1-6B6917AB
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_executive_summary_report; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>

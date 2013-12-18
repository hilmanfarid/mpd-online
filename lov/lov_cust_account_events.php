<?php
//BindEvents Method @1-60C078F8
function BindEvents()
{
    global $LOV_CUST;
    $LOV_CUST->PILIH->CCSEvents["BeforeShow"] = "LOV_CUST_PILIH_BeforeShow";
    $LOV_CUST->CCSEvents["BeforeShowRow"] = "LOV_CUST_BeforeShowRow";
    $LOV_CUST->CCSEvents["BeforeSelect"] = "LOV_CUST_BeforeSelect";
}
//End BindEvents Method

//LOV_CUST_PILIH_BeforeShow @25-D156BB61
function LOV_CUST_PILIH_BeforeShow(& $sender)
{
    $LOV_CUST_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_CUST; //Compatibility
//End LOV_CUST_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_CUST_PILIH_BeforeShow @25-3EE66306
    return $LOV_CUST_PILIH_BeforeShow;
}
//End Close LOV_CUST_PILIH_BeforeShow

//LOV_CUST_BeforeShowRow @2-6EC36981
function LOV_CUST_BeforeShowRow(& $sender)
{
    $LOV_CUST_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_CUST; //Compatibility
//End LOV_CUST_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $LOV_CUST->t_cust_account_id->GetValue() ."#~#".$LOV_CUST->npwd->GetValue();
	$LOV_CUST->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
									 "clickReturn('".$nilai."')\">");
// -------------------------
//End Custom Code

//Close LOV_CUST_BeforeShowRow @2-DE341594
    return $LOV_CUST_BeforeShowRow;
}
//End Close LOV_CUST_BeforeShowRow

//LOV_CUST_BeforeSelect @2-AD106775
function LOV_CUST_BeforeSelect(& $sender)
{
    $LOV_CUST_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_CUST; //Compatibility
//End LOV_CUST_BeforeSelect

//Custom Code @35-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LOV_CUST_BeforeSelect @2-E615C1C3
    return $LOV_CUST_BeforeSelect;
}
//End Close LOV_CUST_BeforeSelect
?>

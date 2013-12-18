<?php
//BindEvents Method @1-89A809A8
function BindEvents()
{
    global $LOV_PERIOD;
    $LOV_PERIOD->PILIH->CCSEvents["BeforeShow"] = "LOV_PERIOD_PILIH_BeforeShow";
    $LOV_PERIOD->CCSEvents["BeforeShowRow"] = "LOV_PERIOD_BeforeShowRow";
    $LOV_PERIOD->CCSEvents["BeforeSelect"] = "LOV_PERIOD_BeforeSelect";
}
//End BindEvents Method

//LOV_PERIOD_PILIH_BeforeShow @25-7A2261C1
function LOV_PERIOD_PILIH_BeforeShow(& $sender)
{
    $LOV_PERIOD_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_PERIOD; //Compatibility
//End LOV_PERIOD_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_PERIOD_PILIH_BeforeShow @25-C95A1D03
    return $LOV_PERIOD_PILIH_BeforeShow;
}
//End Close LOV_PERIOD_PILIH_BeforeShow

//LOV_PERIOD_BeforeShowRow @2-6772A0A6
function LOV_PERIOD_BeforeShowRow(& $sender)
{
    $LOV_PERIOD_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_PERIOD; //Compatibility
//End LOV_PERIOD_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $LOV_PERIOD->p_finance_period_id->GetValue() ."#~#".$LOV_PERIOD->code->GetValue();
	$LOV_PERIOD->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
									 "clickReturn('".$nilai."')\">");
// -------------------------
//End Custom Code

//Close LOV_PERIOD_BeforeShowRow @2-CAEB6358
    return $LOV_PERIOD_BeforeShowRow;
}
//End Close LOV_PERIOD_BeforeShowRow

//LOV_PERIOD_BeforeSelect @2-F07CF476
function LOV_PERIOD_BeforeSelect(& $sender)
{
    $LOV_PERIOD_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_PERIOD; //Compatibility
//End LOV_PERIOD_BeforeSelect

//Custom Code @35-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LOV_PERIOD_BeforeSelect @2-383F42DF
    return $LOV_PERIOD_BeforeSelect;
}
//End Close LOV_PERIOD_BeforeSelect
?>

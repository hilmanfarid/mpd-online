<?php
//BindEvents Method @1-310D7F5D
function BindEvents()
{
    global $LOV_PAJAK;
    $LOV_PAJAK->PILIH->CCSEvents["BeforeShow"] = "LOV_PAJAK_PILIH_BeforeShow";
    $LOV_PAJAK->CCSEvents["BeforeShowRow"] = "LOV_PAJAK_BeforeShowRow";
    $LOV_PAJAK->CCSEvents["BeforeSelect"] = "LOV_PAJAK_BeforeSelect";
}
//End BindEvents Method

//LOV_PAJAK_PILIH_BeforeShow @25-8F561675
function LOV_PAJAK_PILIH_BeforeShow(& $sender)
{
    $LOV_PAJAK_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_PAJAK; //Compatibility
//End LOV_PAJAK_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_PAJAK_PILIH_BeforeShow @25-71285F0C
    return $LOV_PAJAK_PILIH_BeforeShow;
}
//End Close LOV_PAJAK_PILIH_BeforeShow

//LOV_PAJAK_BeforeShowRow @2-09B1378B
function LOV_PAJAK_BeforeShowRow(& $sender)
{
    $LOV_PAJAK_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_PAJAK; //Compatibility
//End LOV_PAJAK_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $LOV_PAJAK->p_reference_list_id->GetValue() ."#~#".$LOV_PAJAK->code->GetValue();
	$LOV_PAJAK->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
									 "clickReturn('".$nilai."')\">");
// -------------------------
//End Custom Code

//Close LOV_PAJAK_BeforeShowRow @2-375E57A2
    return $LOV_PAJAK_BeforeShowRow;
}
//End Close LOV_PAJAK_BeforeShowRow

//LOV_PAJAK_BeforeSelect @2-6F843AC4
function LOV_PAJAK_BeforeSelect(& $sender)
{
    $LOV_PAJAK_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_PAJAK; //Compatibility
//End LOV_PAJAK_BeforeSelect

//Custom Code @35-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LOV_PAJAK_BeforeSelect @2-EFF2C2C5
    return $LOV_PAJAK_BeforeSelect;
}
//End Close LOV_PAJAK_BeforeSelect
?>

<?php
//BindEvents Method @1-4132C1DE
function BindEvents()
{
    global $LOV_REGION;
    $LOV_REGION->PILIH->CCSEvents["BeforeShow"] = "LOV_REGION_PILIH_BeforeShow";
    $LOV_REGION->CCSEvents["BeforeShowRow"] = "LOV_REGION_BeforeShowRow";
    $LOV_REGION->CCSEvents["BeforeSelect"] = "LOV_REGION_BeforeSelect";
}
//End BindEvents Method

//LOV_REGION_PILIH_BeforeShow @25-744B485B
function LOV_REGION_PILIH_BeforeShow(& $sender)
{
    $LOV_REGION_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_REGION; //Compatibility
//End LOV_REGION_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_REGION_PILIH_BeforeShow @25-9474566B
    return $LOV_REGION_PILIH_BeforeShow;
}
//End Close LOV_REGION_PILIH_BeforeShow

//LOV_REGION_BeforeShowRow @2-7B1480EF
function LOV_REGION_BeforeShowRow(& $sender)
{
    $LOV_REGION_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_REGION; //Compatibility
//End LOV_REGION_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $LOV_REGION->t_bphtb_registration_id->GetValue() ."#~#".$LOV_REGION->registration_no->GetValue();
	$LOV_REGION->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
									 "clickReturn('".$nilai."')\">");
// -------------------------
//End Custom Code

//Close LOV_REGION_BeforeShowRow @2-1DDB0EBB
    return $LOV_REGION_BeforeShowRow;
}
//End Close LOV_REGION_BeforeShowRow

//LOV_REGION_BeforeSelect @2-9B6BBFAC
function LOV_REGION_BeforeSelect(& $sender)
{
    $LOV_REGION_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_REGION; //Compatibility
//End LOV_REGION_BeforeSelect

//Custom Code @35-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LOV_REGION_BeforeSelect @2-05804F3E
    return $LOV_REGION_BeforeSelect;
}
//End Close LOV_REGION_BeforeSelect
?>

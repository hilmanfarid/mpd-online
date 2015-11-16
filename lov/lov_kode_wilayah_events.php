<?php
//BindEvents Method @1-AF3B7D12
function BindEvents()
{
    global $LOV_KODE_WILAYAH;
    $LOV_KODE_WILAYAH->PILIH->CCSEvents["BeforeShow"] = "LOV_KODE_WILAYAH_PILIH_BeforeShow";
    $LOV_KODE_WILAYAH->CCSEvents["BeforeShowRow"] = "LOV_KODE_WILAYAH_BeforeShowRow";
    $LOV_KODE_WILAYAH->CCSEvents["BeforeSelect"] = "LOV_KODE_WILAYAH_BeforeSelect";
}
//End BindEvents Method

//LOV_KODE_WILAYAH_PILIH_BeforeShow @25-4573C66B
function LOV_KODE_WILAYAH_PILIH_BeforeShow(& $sender)
{
    $LOV_KODE_WILAYAH_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_KODE_WILAYAH; //Compatibility
//End LOV_KODE_WILAYAH_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_KODE_WILAYAH_PILIH_BeforeShow @25-3ED59742
    return $LOV_KODE_WILAYAH_PILIH_BeforeShow;
}
//End Close LOV_KODE_WILAYAH_PILIH_BeforeShow

//LOV_KODE_WILAYAH_BeforeShowRow @2-6B7762E2
function LOV_KODE_WILAYAH_BeforeShowRow(& $sender)
{
    $LOV_KODE_WILAYAH_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_KODE_WILAYAH; //Compatibility
//End LOV_KODE_WILAYAH_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $LOV_KODE_WILAYAH->p_business_area_id->GetValue() ."#~#".$LOV_KODE_WILAYAH->business_area_name->GetValue();
	$LOV_KODE_WILAYAH->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
									 "clickReturn('".$nilai."')\">");
// -------------------------
//End Custom Code

//Close LOV_KODE_WILAYAH_BeforeShowRow @2-E5862500
    return $LOV_KODE_WILAYAH_BeforeShowRow;
}
//End Close LOV_KODE_WILAYAH_BeforeShowRow

//LOV_KODE_WILAYAH_BeforeSelect @2-B5D7DBF8
function LOV_KODE_WILAYAH_BeforeSelect(& $sender)
{
    $LOV_KODE_WILAYAH_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_KODE_WILAYAH; //Compatibility
//End LOV_KODE_WILAYAH_BeforeSelect

//Custom Code @35-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LOV_KODE_WILAYAH_BeforeSelect @2-3A059DE3
    return $LOV_KODE_WILAYAH_BeforeSelect;
}
//End Close LOV_KODE_WILAYAH_BeforeSelect
?>

<?php
//BindEvents Method @1-CF99508B
function BindEvents()
{
    global $LOV_URUSAN_PEMERINTAH;
    $LOV_URUSAN_PEMERINTAH->PILIH->CCSEvents["BeforeShow"] = "LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow";
    $LOV_URUSAN_PEMERINTAH->CCSEvents["BeforeShowRow"] = "LOV_URUSAN_PEMERINTAH_BeforeShowRow";
    $LOV_URUSAN_PEMERINTAH->CCSEvents["BeforeSelect"] = "LOV_URUSAN_PEMERINTAH_BeforeSelect";
}
//End BindEvents Method

//LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow @25-5949F149
function LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow(& $sender)
{
    $LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_URUSAN_PEMERINTAH; //Compatibility
//End LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow @25-733C9E96
    return $LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow;
}
//End Close LOV_URUSAN_PEMERINTAH_PILIH_BeforeShow

//LOV_URUSAN_PEMERINTAH_BeforeShowRow @2-D93D2959
function LOV_URUSAN_PEMERINTAH_BeforeShowRow(& $sender)
{
    $LOV_URUSAN_PEMERINTAH_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_URUSAN_PEMERINTAH; //Compatibility
//End LOV_URUSAN_PEMERINTAH_BeforeShowRow

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $LOV_URUSAN_PEMERINTAH->organization_name->GetValue() ."#~#".$LOV_URUSAN_PEMERINTAH->organization_code->GetValue();
	$LOV_URUSAN_PEMERINTAH->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
									 "clickReturn('".$nilai."')\">");
// -------------------------
//End Custom Code

//Close LOV_URUSAN_PEMERINTAH_BeforeShowRow @2-A1D6A73F
    return $LOV_URUSAN_PEMERINTAH_BeforeShowRow;
}
//End Close LOV_URUSAN_PEMERINTAH_BeforeShowRow

//LOV_URUSAN_PEMERINTAH_BeforeSelect @2-7CB7573F
function LOV_URUSAN_PEMERINTAH_BeforeSelect(& $sender)
{
    $LOV_URUSAN_PEMERINTAH_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_URUSAN_PEMERINTAH; //Compatibility
//End LOV_URUSAN_PEMERINTAH_BeforeSelect

//Custom Code @33-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LOV_URUSAN_PEMERINTAH_BeforeSelect @2-6EAAD18F
    return $LOV_URUSAN_PEMERINTAH_BeforeSelect;
}
//End Close LOV_URUSAN_PEMERINTAH_BeforeSelect
?>

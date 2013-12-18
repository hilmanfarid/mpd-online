<?php
//BindEvents Method @1-D86927A7
function BindEvents()
{
    global $VIEWDETTRANS;
    $VIEWDETTRANS->CCSEvents["BeforeSelect"] = "VIEWDETTRANS_BeforeSelect";
    $VIEWDETTRANS->CCSEvents["BeforeShowRow"] = "VIEWDETTRANS_BeforeShowRow";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$nilai = $LOV_REGION->p_region_id->GetValue() ."#~#".$LOV_REGION->region_name->GetValue();
//DEL  	$LOV_REGION->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
//DEL  									 "clickReturn('".$nilai."')\">");
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
//DEL  // -------------------------

//VIEWDETTRANS_BeforeSelect @2-9039AFAF
function VIEWDETTRANS_BeforeSelect(& $sender)
{
    $VIEWDETTRANS_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $VIEWDETTRANS; //Compatibility
//End VIEWDETTRANS_BeforeSelect

//Custom Code @39-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close VIEWDETTRANS_BeforeSelect @2-4C874837
    return $VIEWDETTRANS_BeforeSelect;
}
//End Close VIEWDETTRANS_BeforeSelect

//VIEWDETTRANS_BeforeShowRow @2-7DEE88B6
function VIEWDETTRANS_BeforeShowRow(& $sender)
{
    $VIEWDETTRANS_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $VIEWDETTRANS; //Compatibility
//End VIEWDETTRANS_BeforeShowRow

//Custom Code @40-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close VIEWDETTRANS_BeforeShowRow @2-644EB118
    return $VIEWDETTRANS_BeforeShowRow;
}
//End Close VIEWDETTRANS_BeforeShowRow
?>

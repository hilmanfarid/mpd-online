<?php
//BindEvents Method @1-A7AF72D3
function BindEvents()
{
    global $LovGrid;
    $LovGrid->PILIH->CCSEvents["BeforeShow"] = "LovGrid_PILIH_BeforeShow";
    $LovGrid->CCSEvents["BeforeShow"] = "LovGrid_BeforeShow";
    $LovGrid->CCSEvents["BeforeShowRow"] = "LovGrid_BeforeShowRow";
    $LovGrid->CCSEvents["BeforeSelect"] = "LovGrid_BeforeSelect";
}
//End BindEvents Method

//LovGrid_PILIH_BeforeShow @25-9F6D7CF1
function LovGrid_PILIH_BeforeShow(& $sender)
{
    $LovGrid_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LovGrid; //Compatibility
//End LovGrid_PILIH_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LovGrid_PILIH_BeforeShow @25-4E9EBDA5
    return $LovGrid_PILIH_BeforeShow;
}
//End Close LovGrid_PILIH_BeforeShow

//LovGrid_BeforeShow @2-73A61887
function LovGrid_BeforeShow(& $sender)
{
    $LovGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LovGrid; //Compatibility
//End LovGrid_BeforeShow

//Custom Code @47-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LovGrid_BeforeShow @2-34122639
    return $LovGrid_BeforeShow;
}
//End Close LovGrid_BeforeShow

//LovGrid_BeforeShowRow @2-9F5D6AA5
function LovGrid_BeforeShowRow(& $sender)
{
    $LovGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LovGrid; //Compatibility
//End LovGrid_BeforeShowRow

//Custom Code @50-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$nilai = $LovGrid->table_name->GetValue();
  	$LovGrid->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
  									 "clickReturn('".$nilai."')\">");
  // -------------------------


//Close LovGrid_BeforeShowRow @2-C916E311
    return $LovGrid_BeforeShowRow;
}
//End Close LovGrid_BeforeShowRow

//LovGrid_BeforeSelect @2-3336406F
function LovGrid_BeforeSelect(& $sender)
{
    $LovGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LovGrid; //Compatibility
//End LovGrid_BeforeSelect

//Custom Code @62-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close LovGrid_BeforeSelect @2-735D075D
    return $LovGrid_BeforeSelect;
}
//End Close LovGrid_BeforeSelect


?>

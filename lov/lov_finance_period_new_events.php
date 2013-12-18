<?php
//BindEvents Method @1-3F56EC94
function BindEvents()
{
    global $LOV_ORDER;
    $LOV_ORDER->PILIH->CCSEvents["BeforeShow"] = "LOV_ORDER_PILIH_BeforeShow";
    $LOV_ORDER->CCSEvents["BeforeShowRow"] = "LOV_ORDER_BeforeShowRow";
    $LOV_ORDER->CCSEvents["BeforeSelect"] = "LOV_ORDER_BeforeSelect";
}
//End BindEvents Method

//LOV_ORDER_PILIH_BeforeShow @25-1323FD0A
function LOV_ORDER_PILIH_BeforeShow(& $sender)
{
    $LOV_ORDER_PILIH_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_ORDER; //Compatibility
//End LOV_ORDER_PILIH_BeforeShow

//Close LOV_ORDER_PILIH_BeforeShow @25-5BF0AA63
    return $LOV_ORDER_PILIH_BeforeShow;
}
//End Close LOV_ORDER_PILIH_BeforeShow

//LOV_ORDER_BeforeShowRow @2-2D3C9319
function LOV_ORDER_BeforeShowRow(& $sender)
{
    $LOV_ORDER_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_ORDER; //Compatibility
//End LOV_ORDER_BeforeShowRow

  // -------------------------
      // Write your own code here.
	$start_date = $LOV_ORDER->start_date->GetValue();
	$end_date = $LOV_ORDER->end_date->GetValue();

  	$nilai = $LOV_ORDER->p_finance_period_id->GetValue()."#~#".$LOV_ORDER->code->GetValue()."#~#". $start_date . "#~#" . $end_date;
  	$LOV_ORDER->PILIH->SetValue("<input type=button value=PILIH class=btn_tambah onclick=\"" .
  									 "clickReturn('".$nilai."')\">");
  // -------------------------


//Close LOV_ORDER_BeforeShowRow @2-96F2F0BF
    return $LOV_ORDER_BeforeShowRow;
}
//End Close LOV_ORDER_BeforeShowRow

//LOV_ORDER_BeforeSelect @2-D2FA84FE
function LOV_ORDER_BeforeSelect(& $sender)
{
    $LOV_ORDER_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV_ORDER; //Compatibility
//End LOV_ORDER_BeforeSelect

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close LOV_ORDER_BeforeSelect @2-92C6A164
    return $LOV_ORDER_BeforeSelect;
}
//End Close LOV_ORDER_BeforeSelect
?>

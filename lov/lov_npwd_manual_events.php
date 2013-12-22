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

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

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

//Custom Code @32-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
	$t_cust_account_id = $LOV_ORDER->t_cust_account_id->GetValue();
	$npwd = $LOV_ORDER->npwd->GetValue();
	$company_name = $LOV_ORDER->company_name->GetValue();
  	$p_vat_type_id = $LOV_ORDER->p_vat_type_id->GetValue();
	$vat_code = $LOV_ORDER->vat_code->GetValue();
	$p_vat_type_dtl_id = $LOV_ORDER->p_vat_type_dtl_id->GetValue();
	$vat_code_dtl = $LOV_ORDER->vat_code_dtl->GetValue();

	$nilai = "$t_cust_account_id#~#$npwd#~#$company_name#~#$p_vat_type_id#~#$vat_code#~#$p_vat_type_dtl_id#~#$vat_code_dtl";
	//$nilai = "$t_cust_account_id#~#$npwd#~#$p_vat_type_id";
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

//Custom Code @35-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close LOV_ORDER_BeforeSelect @2-92C6A164
    return $LOV_ORDER_BeforeSelect;
}
//End Close LOV_ORDER_BeforeSelect
?>

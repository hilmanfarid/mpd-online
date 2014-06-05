<?php
//BindEvents Method @1-B48F0D21
function BindEvents()
{
    global $t_vat_reg_dtl_restaurantGrid;
    global $t_vat_reg_dtl_hotelGrid1;
    global $v_vat_reg_dtl_entertaintmentGrid;
    global $t_vat_reg_dtl_parkingGrid;
    global $t_vat_reg_dtl_ppjGrid;
    global $t_vat_reg_dtl_ppj_nplGrid;
    global $t_vat_reg_dtl_hotel_srvcGrid;
    global $t_vat_reg_employeeGrid;
    global $t_vat_reg_dtlGrid;
    global $CCSEvents;
    $t_vat_reg_dtl_restaurantGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow";
    $t_vat_reg_dtl_restaurantGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_restaurantGrid_BeforeShowRow";
    $t_vat_reg_dtl_hotelGrid1->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow";
    $t_vat_reg_dtl_hotelGrid1->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_hotelGrid1_BeforeShowRow";
    $v_vat_reg_dtl_entertaintmentGrid->btn_update->CCSEvents["BeforeShow"] = "v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow";
    $v_vat_reg_dtl_entertaintmentGrid->CCSEvents["BeforeShowRow"] = "v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow";
    $t_vat_reg_dtl_parkingGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow";
    $t_vat_reg_dtl_parkingGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_parkingGrid_BeforeShowRow";
    $t_vat_reg_dtl_ppjGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow";
    $t_vat_reg_dtl_ppjGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_ppjGrid_BeforeShowRow";
    $t_vat_reg_dtl_ppj_nplGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow";
    $t_vat_reg_dtl_ppj_nplGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow";
    $t_vat_reg_dtl_hotel_srvcGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow";
    $t_vat_reg_dtl_hotel_srvcGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow";
    $t_vat_reg_employeeGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_employeeGrid_btn_update_BeforeShow";
    $t_vat_reg_employeeGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_employeeGrid_BeforeShowRow";
    $t_vat_reg_employeeGrid->CCSEvents["BeforeSelect"] = "t_vat_reg_employeeGrid_BeforeSelect";
    $t_vat_reg_dtlGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtlGrid_btn_update_BeforeShow";
    $t_vat_reg_dtlGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtlGrid_BeforeShowRow";
    $t_vat_reg_dtlGrid->CCSEvents["BeforeSelect"] = "t_vat_reg_dtlGrid_BeforeSelect";
    $t_vat_reg_dtlGrid->CCSEvents["BeforeShow"] = "t_vat_reg_dtlGrid_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow @1021-76044D87
function t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantGrid; //Compatibility
//End t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow

//Custom Code @1022-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_restaurantGrid->t_cacc_dtl_restaurant_id->GetValue();
	$t_vat_reg_dtl_restaurantGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "restoran(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow @1021-0EED6796
    return $t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow

//t_vat_reg_dtl_restaurantGrid_BeforeShowRow @688-176CD5F1
function t_vat_reg_dtl_restaurantGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtl_restaurantGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantGrid; //Compatibility
//End t_vat_reg_dtl_restaurantGrid_BeforeShowRow

//Set Row Style @701-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @764-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$keyId2 = CCGetFromGet("t_cacc_dtl_restaurant_id", "");
  	$sCode2 = CCGetFromGet("s_keyword", "");
  	global $id2;
  	if (empty($keyId2)) {
  		if (empty($id2)) {
  			$id2 = $t_vat_reg_dtl_restaurantGrid->t_cacc_dtl_restaurant_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_cacc_dtl_restaurant_id", $id2);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  
  	if ($t_vat_reg_dtl_restaurantGrid->t_cacc_dtl_restaurant_id->GetValue() == $keyId2) {
  		$t_vat_reg_dtl_restaurantGrid->ADLink->Visible = true;
  		$t_vat_reg_dtl_restaurantGrid->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$t_vat_reg_dtl_restaurantGrid->ADLink->Visible = false;
  		$t_vat_reg_dtl_restaurantGrid->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
  // -------------------------


//Close t_vat_reg_dtl_restaurantGrid_BeforeShowRow @688-A815B776
    return $t_vat_reg_dtl_restaurantGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_restaurantGrid_BeforeShowRow

//t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow @1023-70B27D59
function t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotelGrid1; //Compatibility
//End t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow

//Custom Code @1024-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_hotelGrid1->t_cacc_dtl_hotel_id->GetValue();
	$t_vat_reg_dtl_hotelGrid1->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "hotel(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow @1023-3D72020D
    return $t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow


//t_vat_reg_dtl_hotelGrid1_BeforeShowRow @790-5A2C1313
function t_vat_reg_dtl_hotelGrid1_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtl_hotelGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotelGrid1; //Compatibility
//End t_vat_reg_dtl_hotelGrid1_BeforeShowRow

//Set Row Style @806-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @807-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$keyId3 = CCGetFromGet("t_cacc_dtl_hotel_id", "");
  	$sCode3 = CCGetFromGet("s_keyword", "");
  	global $id3;
  	if (empty($keyId3)) {
  		if (empty($id3)) {
  			$id3 = $t_vat_reg_dtl_hotelGrid1->t_cacc_dtl_hotel_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_cacc_dtl_hotel_id", $id3);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  
  	if ($t_vat_reg_dtl_hotelGrid1->t_cacc_dtl_hotel_id->GetValue() == $keyId3) {
  		$t_vat_reg_dtl_hotelGrid1->ADLink->Visible = true;
  		$t_vat_reg_dtl_hotelGrid1->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$t_vat_reg_dtl_hotelGrid1->ADLink->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
  // -------------------------


//Close t_vat_reg_dtl_hotelGrid1_BeforeShowRow @790-5249CA44
    return $t_vat_reg_dtl_hotelGrid1_BeforeShowRow;
}
//End Close t_vat_reg_dtl_hotelGrid1_BeforeShowRow

//v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow @1025-4BB0DE43
function v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow(& $sender)
{
    $v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_vat_reg_dtl_entertaintmentGrid; //Compatibility
//End v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow

//Custom Code @1026-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $v_vat_reg_dtl_entertaintmentGrid->t_cacc_dtl_entertaintment_id->GetValue();
	$v_vat_reg_dtl_entertaintmentGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "hiburan(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow @1025-08F777CE
    return $v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow;
}
//End Close v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow

//v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow @814-D988E6E5
function v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow(& $sender)
{
    $v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_vat_reg_dtl_entertaintmentGrid; //Compatibility
//End v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow

//Set Row Style @830-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @831-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$keyId4 = CCGetFromGet("t_cacc_dtl_entertaintment_id", "");
  	$sCode4 = CCGetFromGet("s_keyword", "");
  	global $id4;
  	if (empty($keyId4)) {
  		if (empty($id4)) {
  			$id4 = $v_vat_reg_dtl_entertaintmentGrid->t_cacc_dtl_entertaintment_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_cacc_dtl_entertaintment_id", $id4);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  
  	if ($v_vat_reg_dtl_entertaintmentGrid->t_cacc_dtl_entertaintment_id->GetValue() == $keyId4) {
  		$v_vat_reg_dtl_entertaintmentGrid->ADLink->Visible = true;
  		$v_vat_reg_dtl_entertaintmentGrid->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$v_vat_reg_dtl_entertaintmentGrid->ADLink->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
  // -------------------------


//Close v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow @814-696D5D14
    return $v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow;
}
//End Close v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow

//t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow @891-F16A8FB3
function t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_parkingGrid; //Compatibility
//End t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow

//Custom Code @892-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_parkingGrid->t_acc_dtl_parking_id->GetValue();
	$t_vat_reg_dtl_parkingGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "parkir(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow @891-572ACB38
    return $t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtl_parkingGrid_btn_update_BeforeShow

//t_vat_reg_dtl_parkingGrid_BeforeShowRow @838-F88AFC18
function t_vat_reg_dtl_parkingGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtl_parkingGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_parkingGrid; //Compatibility
//End t_vat_reg_dtl_parkingGrid_BeforeShowRow

//Set Row Style @856-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @857-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$keyId5 = CCGetFromGet("t_acc_dtl_parking_id", "");
  	$sCode5 = CCGetFromGet("s_keyword", "");
  	global $id5;
  	if (empty($keyId5)) {
  		if (empty($id5)) {
  			$id5 = $t_vat_reg_dtl_parkingGrid->t_acc_dtl_parking_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_acc_dtl_parking_id", $id5);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  
  	if ($t_vat_reg_dtl_parkingGrid->t_acc_dtl_parking_id->GetValue() == $keyId5) {
  		$t_vat_reg_dtl_parkingGrid->ADLink->Visible = true;
  		$t_vat_reg_dtl_parkingGrid->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$t_vat_reg_dtl_parkingGrid->ADLink->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
  // -------------------------


//Close t_vat_reg_dtl_parkingGrid_BeforeShowRow @838-4ABA9ACB
    return $t_vat_reg_dtl_parkingGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_parkingGrid_BeforeShowRow

//t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow @1019-03E0D0AE
function t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjGrid; //Compatibility
//End t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow

//Custom Code @1020-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_ppjGrid->t_cacc_dtl_ppj_id->GetValue();
	$t_vat_reg_dtl_ppjGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "ppj(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow @1019-D0E2975C
    return $t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow

//t_vat_reg_dtl_ppjGrid_BeforeShowRow @862-209FAB86
function t_vat_reg_dtl_ppjGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtl_ppjGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjGrid; //Compatibility
//End t_vat_reg_dtl_ppjGrid_BeforeShowRow

//Set Row Style @875-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @876-2A29BDB7
// -------------------------
    // Write your own code here.
		$keyId6 = CCGetFromGet("t_cacc_dtl_ppj_id", "");
  	$sCode6 = CCGetFromGet("s_keyword", "");
  	global $id6;
  	if (empty($keyId6)) {
  		if (empty($id6)) {
  			$id6 = $t_vat_reg_dtl_ppjGrid->t_cacc_dtl_ppj_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_cacc_dtl_ppj_id", $id6);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  
  	if ($t_vat_reg_dtl_ppjGrid->t_cacc_dtl_ppj_id->GetValue() == $keyId6) {
  		$t_vat_reg_dtl_ppjGrid->ADLink->Visible = true;
  		$t_vat_reg_dtl_ppjGrid->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$t_vat_reg_dtl_ppjGrid->ADLink->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
// -------------------------
//End Custom Code


//Close t_vat_reg_dtl_ppjGrid_BeforeShowRow @862-719FAB90
    return $t_vat_reg_dtl_ppjGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_ppjGrid_BeforeShowRow

//t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow @1027-E1D002C7
function t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppj_nplGrid; //Compatibility
//End t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow

//Custom Code @1028-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_ppj_nplGrid->t_cacc_dtl_ppj_pln_id->GetValue();
	$t_vat_reg_dtl_ppj_nplGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "ppjj(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow @1027-57EAF41D
    return $t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow

//t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow @896-FFBC8945
function t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppj_nplGrid; //Compatibility
//End t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow

//Set Row Style @910-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @911-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId7 = CCGetFromGet("t_cacc_dtl_ppj_pln_id", "");
  	$sCode7 = CCGetFromGet("s_keyword", "");
  	global $id7;
  	if (empty($keyId7)) {
  		if (empty($id7)) {
  			$id7 = $t_vat_reg_dtl_ppj_nplGrid->t_cacc_dtl_ppj_pln_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_cacc_dtl_ppj_pln_id", $id7);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  	
  	if ($t_vat_reg_dtl_ppj_nplGrid->t_cacc_dtl_ppj_pln_id->GetValue() == $keyId7) {
  		$t_vat_reg_dtl_ppj_nplGrid->ADLink->Visible = true;
  		$t_vat_reg_dtl_ppj_nplGrid->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$t_vat_reg_dtl_ppj_nplGrid->ADLink->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow @896-D142E91F
    return $t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow

//t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow @1029-C0AB7A5B
function t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotel_srvcGrid; //Compatibility
//End t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow

//Custom Code @1030-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_hotel_srvcGrid->t_cacc_dtl_hotel_srvc_id->GetValue();
	$t_vat_reg_dtl_hotel_srvcGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "hotel_srvc(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow @1029-060A4A74
    return $t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtl_hotel_srvcGrid_btn_update_BeforeShow

//t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow @915-ADD50335
function t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotel_srvcGrid; //Compatibility
//End t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow

//Set Row Style @929-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @930-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	
  	$keyId8 = CCGetFromGet("t_cacc_dtl_hotel_srvc_id", "");
  	$sCode8 = CCGetFromGet("s_keyword", "");
  	global $id8;
  	if (empty($keyId8)) {
  		if (empty($id8)) {
  			$id8 = $t_vat_reg_dtl_hotel_srvcGrid->t_cacc_dtl_hotel_srvc_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_cacc_dtl_hotel_srvc_id", $id8);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  	
  	if ($t_vat_reg_dtl_hotel_srvcGrid->t_cacc_dtl_hotel_srvc_id->GetValue() == $keyId8) {
  		$t_vat_reg_dtl_hotel_srvcGrid->ADLink->Visible = true;
  		$t_vat_reg_dtl_hotel_srvcGrid->DLink->Visible = false;
  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
  	} else {
  		$t_vat_reg_dtl_hotel_srvcGrid->ADLink->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->DLink->Visible = true;
  		$Component->Attributes->SetValue("rowStyle", "class=Row");
  	}
  	
  // -------------------------


//Close t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow @915-948AA3A8
    return $t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow

//t_vat_reg_employeeGrid_btn_update_BeforeShow @1048-BC8372B3
function t_vat_reg_employeeGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_employeeGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeGrid; //Compatibility
//End t_vat_reg_employeeGrid_btn_update_BeforeShow

//Custom Code @1049-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_employeeGrid->t_cust_acc_employee_id->GetValue();
	$t_vat_reg_employeeGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "pegawai(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeGrid_btn_update_BeforeShow @1048-3174233E
    return $t_vat_reg_employeeGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_employeeGrid_btn_update_BeforeShow

//t_vat_reg_employeeGrid_BeforeShowRow @1037-2BB77834
function t_vat_reg_employeeGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_employeeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeGrid; //Compatibility
//End t_vat_reg_employeeGrid_BeforeShowRow

//Set Row Style @1050-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @1051-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId_new = CCGetFromGet("t_cust_acc_employee_id", "");
	$sCode = CCGetFromGet("s_keyword", "");
	global $id_new;
	if (empty($keyId_new)) {
		if (empty($id_new)) {
			$id_new = $t_vat_reg_employeeGrid->t_cust_acc_employee_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_cust_acc_employee_id", $id_new);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_employeeGrid->t_cust_acc_employee_id->GetValue() == $keyId_new) {
		$t_vat_reg_employeeGrid->ADLink->Visible = true;
		$t_vat_reg_employeeGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$t_vat_reg_employeeGrid->ADLink->Visible = false;
		$t_vat_reg_employeeGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeGrid_BeforeShowRow @1037-894C7316
    return $t_vat_reg_employeeGrid_BeforeShowRow;
}
//End Close t_vat_reg_employeeGrid_BeforeShowRow

//t_vat_reg_employeeGrid_BeforeSelect @1037-E8350169
function t_vat_reg_employeeGrid_BeforeSelect(& $sender)
{
    $t_vat_reg_employeeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeGrid; //Compatibility
//End t_vat_reg_employeeGrid_BeforeSelect

//Custom Code @1052-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeGrid_BeforeSelect @1037-F6C666B7
    return $t_vat_reg_employeeGrid_BeforeSelect;
}
//End Close t_vat_reg_employeeGrid_BeforeSelect

//t_vat_reg_dtlGrid_btn_update_BeforeShow @624-78D5B09A
function t_vat_reg_dtlGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtlGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtlGrid; //Compatibility
//End t_vat_reg_dtlGrid_btn_update_BeforeShow

//Custom Code @625-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtlGrid->t_cacc_license_letter_id->GetValue();
	$t_vat_reg_dtlGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "izin2(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtlGrid_btn_update_BeforeShow @624-BFF23C9B
    return $t_vat_reg_dtlGrid_btn_update_BeforeShow;
}
//End Close t_vat_reg_dtlGrid_btn_update_BeforeShow

//t_vat_reg_dtlGrid_BeforeShowRow @2-B08B1D7D
function t_vat_reg_dtlGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_dtlGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtlGrid; //Compatibility
//End t_vat_reg_dtlGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @763-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId = CCGetFromGet("t_cacc_license_letter_id", "");
	$sCode = CCGetFromGet("s_keyword", "");
	global $id;
	if (empty($keyId)) {
		if (empty($id)) {
			$id = $t_vat_reg_dtlGrid->t_cacc_license_letter_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_cacc_license_letter_id", $id);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_dtlGrid->t_cacc_license_letter_id->GetValue() == $keyId) {
		$t_vat_reg_dtlGrid->ADLink->Visible = true;
		$t_vat_reg_dtlGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$t_vat_reg_dtlGrid->ADLink->Visible = false;
		$t_vat_reg_dtlGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close t_vat_reg_dtlGrid_BeforeShowRow @2-65AB372D
    return $t_vat_reg_dtlGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtlGrid_BeforeShowRow

//t_vat_reg_dtlGrid_BeforeSelect @2-1D89733F
function t_vat_reg_dtlGrid_BeforeSelect(& $sender)
{
    $t_vat_reg_dtlGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtlGrid; //Compatibility
//End t_vat_reg_dtlGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_reg_dtlGrid_BeforeSelect @2-72707B76
    return $t_vat_reg_dtlGrid_BeforeSelect;
}
//End Close t_vat_reg_dtlGrid_BeforeSelect

//t_vat_reg_dtlGrid_BeforeShow @2-71BD6E2E
function t_vat_reg_dtlGrid_BeforeShow(& $sender)
{
    $t_vat_reg_dtlGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtlGrid; //Compatibility
//End t_vat_reg_dtlGrid_BeforeShow

//Custom Code @1066-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_reg_dtlGrid_BeforeShow @2-80193CEC
    return $t_vat_reg_dtlGrid_BeforeShow;
}
//End Close t_vat_reg_dtlGrid_BeforeShow

//Page_BeforeShow @1-17111D96
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_update; //Compatibility
//End Page_BeforeShow

//Custom Code @884-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	global $t_vat_setllementSearch;
  	global $t_vat_reg_dtl_restaurantGrid;
  	global $t_vat_reg_dtl_hotelGrid1;
  	global $v_vat_reg_dtl_entertaintmentGrid;
  	global $t_vat_reg_dtl_parkingGrid;
  	global $t_vat_reg_dtl_ppjGrid;
  	global $t_vat_reg_dtl_ppj_nplGrid;
  	global $t_vat_reg_dtl_hotel_srvcGrid;
  	
	$t_cust_account_id = CCGetFromGet("t_cust_account_id","");
	$dbConn = new clsDBConnSIKP();
	$sql = "select p_vat_type_id from t_cust_account where t_cust_account_id = ".$t_cust_account_id;
	$dbConn->query($sql);
	while($dbConn->next_record()){
		$id_req = $dbConn->f("p_vat_type_id");
	}

  	if ($id_req == "1"){
  		$t_vat_reg_dtl_restaurantGrid->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->Visible = true;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = true;
  	}else if($id_req == "2"){
  		$t_vat_reg_dtl_restaurantGrid->Visible = true;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else if($id_req == "3"){
  		$t_vat_reg_dtl_restaurantGrid->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = true;
  		$t_vat_reg_dtl_parkingGrid->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else if($id_req == "4"){
  		$t_vat_reg_dtl_restaurantGrid->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->Visible = true;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else if($id_req == "5"){
  		$t_vat_reg_dtl_restaurantGrid->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->Visible = true;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = true;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else{
  		alert("Jenis Permohonan Tidak Diketahui");
  	}
  // -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>

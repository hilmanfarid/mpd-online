<?php
//BindEvents Method @1-F3E24C1F
function BindEvents()
{
    global $t_vat_reg_dtlGrid;
    global $t_vat_reg_dtl_restaurantGrid;
    global $t_vat_reg_dtl_hotelGrid1;
    global $v_vat_reg_dtl_entertaintmentGrid;
    global $t_vat_reg_dtl_parkingGrid;
    global $t_vat_reg_dtl_ppjGrid;
    global $t_vat_reg_dtl_ppj_nplGrid;
    global $CCSEvents;
    $t_vat_reg_dtlGrid->btn_update->CCSEvents["BeforeShow"] = "t_vat_reg_dtlGrid_btn_update_BeforeShow";
    $t_vat_reg_dtlGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtlGrid_BeforeShowRow";
    $t_vat_reg_dtlGrid->CCSEvents["BeforeSelect"] = "t_vat_reg_dtlGrid_BeforeSelect";
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
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

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
	$nilai = $t_vat_reg_dtlGrid->t_license_letter_id->GetValue();
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
	$keyId = CCGetFromGet("t_license_letter_id", "");
	$sCode = CCGetFromGet("s_keyword", "");
	global $id;
	if (empty($keyId)) {
		if (empty($id)) {
			$id = $t_vat_reg_dtlGrid->t_license_letter_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_license_letter_id", $id);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_dtlGrid->t_license_letter_id->GetValue() == $keyId) {
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
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_reg_dtlGrid_BeforeSelect @2-72707B76
    return $t_vat_reg_dtlGrid_BeforeSelect;
}
//End Close t_vat_reg_dtlGrid_BeforeSelect

//t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow @887-76044D87
function t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_restaurantGrid; //Compatibility
//End t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow

//Custom Code @888-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_restaurantGrid->t_vat_reg_dtl_restaurant_id->GetValue();
	$t_vat_reg_dtl_restaurantGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "rest2(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantGrid_btn_update_BeforeShow @887-0EED6796
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
	$keyId2 = CCGetFromGet("t_vat_reg_dtl_restaurant_id", "");
	$sCode2 = CCGetFromGet("s_keyword", "");
	global $id2;
	if (empty($keyId2)) {
		if (empty($id2)) {
			$id2 = $t_vat_reg_dtl_restaurantGrid->t_vat_reg_dtl_restaurant_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_dtl_restaurant_id", $id2);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_dtl_restaurantGrid->t_vat_reg_dtl_restaurant_id->GetValue() == $keyId2) {
		$t_vat_reg_dtl_restaurantGrid->ADLink->Visible = true;
		$t_vat_reg_dtl_restaurantGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$t_vat_reg_dtl_restaurantGrid->ADLink->Visible = false;
		$t_vat_reg_dtl_restaurantGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_restaurantGrid_BeforeShowRow @688-A815B776
    return $t_vat_reg_dtl_restaurantGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_restaurantGrid_BeforeShowRow

//t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow @885-70B27D59
function t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotelGrid1; //Compatibility
//End t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow

//Custom Code @886-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_hotelGrid1->t_vat_reg_dtl_hotel_id->GetValue();
	$t_vat_reg_dtl_hotelGrid1->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "hotel2(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotelGrid1_btn_update_BeforeShow @885-3D72020D
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
	$keyId3 = CCGetFromGet("t_vat_reg_dtl_hotel_id", "");
	$sCode3 = CCGetFromGet("s_keyword", "");
	global $id3;
	if (empty($keyId3)) {
		if (empty($id3)) {
			$id3 = $t_vat_reg_dtl_hotelGrid1->t_vat_reg_dtl_hotel_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_dtl_hotel_id", $id3);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_dtl_hotelGrid1->t_vat_reg_dtl_hotel_id->GetValue() == $keyId3) {
		$t_vat_reg_dtl_hotelGrid1->ADLink->Visible = true;
		$t_vat_reg_dtl_hotelGrid1->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$t_vat_reg_dtl_hotelGrid1->ADLink->Visible = false;
		$t_vat_reg_dtl_hotelGrid1->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotelGrid1_BeforeShowRow @790-5249CA44
    return $t_vat_reg_dtl_hotelGrid1_BeforeShowRow;
}
//End Close t_vat_reg_dtl_hotelGrid1_BeforeShowRow

//v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow @889-4BB0DE43
function v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow(& $sender)
{
    $v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_vat_reg_dtl_entertaintmentGrid; //Compatibility
//End v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow

//Custom Code @890-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $v_vat_reg_dtl_entertaintmentGrid->t_vat_reg_dtl_entertaintment_id->GetValue();
	$v_vat_reg_dtl_entertaintmentGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "hiburan2(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close v_vat_reg_dtl_entertaintmentGrid_btn_update_BeforeShow @889-08F777CE
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
	$keyId4 = CCGetFromGet("t_vat_reg_dtl_entertaintment_id", "");
	$sCode4 = CCGetFromGet("s_keyword", "");
	global $id4;
	if (empty($keyId4)) {
		if (empty($id4)) {
			$id4 = $v_vat_reg_dtl_entertaintmentGrid->t_vat_reg_dtl_entertaintment_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_dtl_entertaintment_id", $id4);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($v_vat_reg_dtl_entertaintmentGrid->t_vat_reg_dtl_entertaintment_id->GetValue() == $keyId4) {
		$v_vat_reg_dtl_entertaintmentGrid->ADLink->Visible = true;
		$v_vat_reg_dtl_entertaintmentGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$v_vat_reg_dtl_entertaintmentGrid->ADLink->Visible = false;
		$v_vat_reg_dtl_entertaintmentGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

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
	$nilai = $t_vat_reg_dtl_parkingGrid->t_vat_reg_dtl_parking_id->GetValue();
	$t_vat_reg_dtl_parkingGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "parkir2(".$nilai.")\">");
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
	$keyId5 = CCGetFromGet("t_vat_reg_dtl_parking_id", "");
	$sCode5 = CCGetFromGet("s_keyword", "");
	global $id5;
	if (empty($keyId5)) {
		if (empty($id5)) {
			$id5 = $t_vat_reg_dtl_parkingGrid->t_vat_reg_dtl_parking_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_dtl_parking_id", $id5);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_dtl_parkingGrid->t_vat_reg_dtl_parking_id->GetValue() == $keyId5) {
		$t_vat_reg_dtl_parkingGrid->ADLink->Visible = true;
		$t_vat_reg_dtl_parkingGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$t_vat_reg_dtl_parkingGrid->ADLink->Visible = false;
		$t_vat_reg_dtl_parkingGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_parkingGrid_BeforeShowRow @838-4ABA9ACB
    return $t_vat_reg_dtl_parkingGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_parkingGrid_BeforeShowRow

//t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow @893-03E0D0AE
function t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppjGrid; //Compatibility
//End t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow

//Custom Code @894-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_ppjGrid->t_vat_reg_dtl_ppj_id->GetValue();
	$t_vat_reg_dtl_ppjGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "ppj2(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppjGrid_btn_update_BeforeShow @893-D0E2975C
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
	$keyId6 = CCGetFromGet("t_vat_reg_dtl_ppj_id", "");
	$sCode6 = CCGetFromGet("s_keyword", "");
	global $id6;
	if (empty($keyId6)) {
		if (empty($id6)) {
			$id6 = $t_vat_reg_dtl_ppjGrid->t_vat_reg_dtl_ppj_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_dtl_ppj_id", $id6);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_dtl_ppjGrid->t_vat_reg_dtl_ppj_id->GetValue() == $keyId6) {
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

//t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow @908-E1D002C7
function t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow(& $sender)
{
    $t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ppj_nplGrid; //Compatibility
//End t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow

//Custom Code @909-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_reg_dtl_ppj_nplGrid->t_vat_reg_dtl_ppj_npl_id->GetValue();
	$t_vat_reg_dtl_ppj_nplGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "ppj_npl2(".$nilai.")\">");
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_ppj_nplGrid_btn_update_BeforeShow @908-57EAF41D
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
	
	$keyId7 = CCGetFromGet("t_vat_reg_dtl_ppj_npl_id", "");
	$sCode7 = CCGetFromGet("s_keyword", "");
	global $id7;
	if (empty($keyId7)) {
		if (empty($id7)) {
			$id7 = $t_vat_reg_dtl_ppj_nplGrid->t_vat_reg_dtl_ppj_npl_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_dtl_ppj_npl_id", $id7);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}
	
	if ($t_vat_reg_dtl_ppj_nplGrid->t_vat_reg_dtl_ppj_npl_id->GetValue() == $keyId7) {
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

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	
//DEL  	$keyId7 = CCGetFromGet("t_vat_reg_dtl_ppj_npl_id", "");
//DEL  	$sCode7 = CCGetFromGet("s_keyword", "");
//DEL  	global $id7;
//DEL  	if (empty($keyId7)) {
//DEL  		if (empty($id7)) {
//DEL  			$id7 = $t_vat_reg_dtl_ppj_nplGrid->t_vat_reg_dtl_ppj_npl_id->GetValue();
//DEL  		}
//DEL  		global $FileName;
//DEL  		global $PathToCurrentPage;
//DEL  		$param = CCGetQueryString("QueryString", "");
//DEL  		$param = CCAddParam($param, "t_vat_reg_dtl_ppj_npl_id", $id7);
//DEL  		
//DEL  		$Redirect = $FileName."?".$param;
//DEL  		//die($Redirect);
//DEL  		header("Location: ".$Redirect);
//DEL  		return;
//DEL  	}
//DEL  	
//DEL  	if ($t_vat_reg_dtl_ppj_nplGrid->t_vat_reg_dtl_ppj_npl_id->GetValue() == $keyId7) {
//DEL  		$t_vat_reg_dtl_ppj_nplGrid->ADLink->Visible = true;
//DEL  		$t_vat_reg_dtl_ppj_nplGrid->DLink->Visible = false;
//DEL  		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
//DEL  	} else {
//DEL  		$t_vat_reg_dtl_ppj_nplGrid->ADLink->Visible = false;
//DEL  		$t_vat_reg_dtl_ppj_nplGrid->DLink->Visible = true;
//DEL  		$Component->Attributes->SetValue("rowStyle", "class=Row");
//DEL  	}
//DEL  	
//DEL  // -------------------------


//Close t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow @896-D142E91F
    return $t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow

//Page_BeforeShow @1-D11E49AC
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl2; //Compatibility
//End Page_BeforeShow

//Custom Code @884-2A29BDB7
// -------------------------
    // Write your own code here.
	global $t_vat_reg_dtlSearch;
	global $t_vat_reg_dtlGrid;
	global $t_vat_reg_dtl_restaurantGrid;
	global $t_vat_reg_dtl_hotelGrid1;
	global $v_vat_reg_dtl_entertaintmentGrid;
	global $t_vat_reg_dtl_parkingGrid;
	global $t_vat_reg_dtl_ppjGrid;
	global $t_vat_reg_dtl_ppj_nplGrid;

	$id_req = CCGetFromGet("p_rqst_type_id","");
	if ($id_req == "1"){
		$t_vat_reg_dtlSearch->Visible = true;
		$t_vat_reg_dtlGrid->Visible = true;
		$t_vat_reg_dtl_restaurantGrid->Visible = false;
		$t_vat_reg_dtl_hotelGrid1->Visible = true;
		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
		$t_vat_reg_dtl_parkingGrid->Visible = false;
		$t_vat_reg_dtl_ppjGrid->Visible = false;
		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
	}else if($id_req == "2"){
		$t_vat_reg_dtlSearch->Visible = true;
		$t_vat_reg_dtlGrid->Visible = true;
		$t_vat_reg_dtl_restaurantGrid->Visible = true;
		$t_vat_reg_dtl_hotelGrid1->Visible = false;
		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
		$t_vat_reg_dtl_parkingGrid->Visible = false;
		$t_vat_reg_dtl_ppjGrid->Visible = false;
		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
	}else if($id_req == "3"){
		$t_vat_reg_dtlSearch->Visible = true;
		$t_vat_reg_dtlGrid->Visible = true;
		$t_vat_reg_dtl_restaurantGrid->Visible = false;
		$t_vat_reg_dtl_hotelGrid1->Visible = false;
		$v_vat_reg_dtl_entertaintmentGrid->Visible = true;
		$t_vat_reg_dtl_parkingGrid->Visible = false;
		$t_vat_reg_dtl_ppjGrid->Visible = false;
		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
	}else if($id_req == "4"){
		$t_vat_reg_dtlSearch->Visible = true;
		$t_vat_reg_dtlGrid->Visible = true;
		$t_vat_reg_dtl_restaurantGrid->Visible = false;
		$t_vat_reg_dtl_hotelGrid1->Visible = false;
		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
		$t_vat_reg_dtl_parkingGrid->Visible = true;
		$t_vat_reg_dtl_ppjGrid->Visible = false;
		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
	}else if($id_req == "5"){
		$t_vat_reg_dtlSearch->Visible = true;
		$t_vat_reg_dtlGrid->Visible = true;
		$t_vat_reg_dtl_restaurantGrid->Visible = false;
		$t_vat_reg_dtl_hotelGrid1->Visible = false;
		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
		$t_vat_reg_dtl_parkingGrid->Visible = false;
		$t_vat_reg_dtl_ppjGrid->Visible = true;
		$t_vat_reg_dtl_ppj_nplGrid->Visible = true;
	}else{
		alert("Jenis Permohonan Tidak Diketahui");
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>

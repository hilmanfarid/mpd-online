<?php
//BindEvents Method @1-AE871426
function BindEvents()
{
    global $t_vat_reg_dtlGrid;
    global $t_vat_reg_dtl_restaurantGrid;
    global $t_vat_reg_dtl_hotelGrid1;
    global $v_vat_reg_dtl_entertaintmentGrid;
    global $t_vat_reg_dtl_parkingGrid;
    global $t_vat_reg_dtl_ppjGrid;
    global $t_vat_reg_dtl_ppj_nplGrid;
    global $t_vat_reg_dtl_hotel_srvcGrid;
    global $t_vat_reg_employeeGrid;
    global $CCSEvents;
    $t_vat_reg_dtlGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtlGrid_BeforeShowRow";
    $t_vat_reg_dtlGrid->CCSEvents["BeforeSelect"] = "t_vat_reg_dtlGrid_BeforeSelect";
    $t_vat_reg_dtl_restaurantGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_restaurantGrid_BeforeShowRow";
    $t_vat_reg_dtl_hotelGrid1->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_hotelGrid1_BeforeShowRow";
    $v_vat_reg_dtl_entertaintmentGrid->CCSEvents["BeforeShowRow"] = "v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow";
    $t_vat_reg_dtl_parkingGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_parkingGrid_BeforeShowRow";
    $t_vat_reg_dtl_ppjGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_ppjGrid_BeforeShowRow";
    $t_vat_reg_dtl_ppj_nplGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow";
    $t_vat_reg_dtl_hotel_srvcGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_dtl_hotel_srvcGrid_BeforeShowRow";
    $t_vat_reg_employeeGrid->CCSEvents["BeforeShowRow"] = "t_vat_reg_employeeGrid_BeforeShowRow";
    $t_vat_reg_employeeGrid->CCSEvents["BeforeSelect"] = "t_vat_reg_employeeGrid_BeforeSelect";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

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
// -------------------------
//End Custom Code

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
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_vat_reg_dtlGrid_BeforeSelect @2-72707B76
    return $t_vat_reg_dtlGrid_BeforeSelect;
}
//End Close t_vat_reg_dtlGrid_BeforeSelect

  // -------------------------
      // Write your own code here.
  	//$nilai = $t_vat_reg_dtl_restaurantGrid->t_vat_reg_dtl_restaurant_id->GetValue();
  	//$t_vat_reg_dtl_restaurantGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "rest2(".$nilai.")\">");
  // -------------------------

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


//Close t_vat_reg_dtl_restaurantGrid_BeforeShowRow @688-A815B776
    return $t_vat_reg_dtl_restaurantGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_restaurantGrid_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	//$nilai = $t_vat_reg_dtl_hotelGrid1->t_vat_reg_dtl_hotel_id->GetValue();
  	//$t_vat_reg_dtl_hotelGrid1->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "hotel2(".$nilai.")\">");
  // -------------------------

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


//Close t_vat_reg_dtl_hotelGrid1_BeforeShowRow @790-5249CA44
    return $t_vat_reg_dtl_hotelGrid1_BeforeShowRow;
}
//End Close t_vat_reg_dtl_hotelGrid1_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	//$nilai = $v_vat_reg_dtl_entertaintmentGrid->t_vat_reg_dtl_entertaintment_id->GetValue();
  	//$v_vat_reg_dtl_entertaintmentGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "hiburan2(".$nilai.")\">");
  // -------------------------

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


//Close v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow @814-696D5D14
    return $v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow;
}
//End Close v_vat_reg_dtl_entertaintmentGrid_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	//$nilai = $t_vat_reg_dtl_parkingGrid->t_vat_reg_dtl_parking_id->GetValue();
  	//$t_vat_reg_dtl_parkingGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "parkir2(".$nilai.")\">");
  // -------------------------

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


//Close t_vat_reg_dtl_parkingGrid_BeforeShowRow @838-4ABA9ACB
    return $t_vat_reg_dtl_parkingGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_parkingGrid_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	//$nilai = $t_vat_reg_dtl_ppjGrid->t_vat_reg_dtl_ppj_id->GetValue();
  	//$t_vat_reg_dtl_ppjGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "ppj2(".$nilai.")\">");
  // -------------------------

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
// -------------------------
//End Custom Code

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


//Close t_vat_reg_dtl_ppjGrid_BeforeShowRow @862-719FAB90
    return $t_vat_reg_dtl_ppjGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_ppjGrid_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	//$nilai = $t_vat_reg_dtl_ppj_nplGrid->t_vat_reg_dtl_ppj_npl_id->GetValue();
  	//$t_vat_reg_dtl_ppj_nplGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "ppj_npl2(".$nilai.")\">");
  // -------------------------

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
// -------------------------
//End Custom Code

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


//Close t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow @896-D142E91F
    return $t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow;
}
//End Close t_vat_reg_dtl_ppj_nplGrid_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	//$nilai = $t_vat_reg_dtl_hotel_srvcGrid->t_vat_reg_dtl_hotel_srvc_id->GetValue();
  	//$t_vat_reg_dtl_hotel_srvcGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    //									 "srvc2(".$nilai.")\">");
  // -------------------------

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
  	
  	$keyId8 = CCGetFromGet("t_vat_reg_dtl_hotel_srvc_id", "");
  	$sCode8 = CCGetFromGet("s_keyword", "");
  	global $id8;
  	if (empty($keyId8)) {
  		if (empty($id8)) {
  			$id8 = $t_vat_reg_dtl_hotel_srvcGrid->t_vat_reg_dtl_hotel_srvc_id->GetValue();
  		}
  		global $FileName;
  		global $PathToCurrentPage;
  		$param = CCGetQueryString("QueryString", "");
  		$param = CCAddParam($param, "t_vat_reg_dtl_hotel_srvc_id", $id8);
  		
  		$Redirect = $FileName."?".$param;
  		//die($Redirect);
  		header("Location: ".$Redirect);
  		return;
  	}
  	
  	if ($t_vat_reg_dtl_hotel_srvcGrid->t_vat_reg_dtl_hotel_srvc_id->GetValue() == $keyId8) {
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

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$nilai = $t_vat_reg_employeeGrid->t_vat_reg_employee_id->GetValue();
//DEL  	$t_vat_reg_employeeGrid->btn_update->SetValue("<input type='button' value='EDIT' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
//DEL    									 "pegawai2(".$nilai.")\">");
//DEL  // -------------------------

//t_vat_reg_employeeGrid_BeforeShowRow @952-2BB77834
function t_vat_reg_employeeGrid_BeforeShowRow(& $sender)
{
    $t_vat_reg_employeeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeGrid; //Compatibility
//End t_vat_reg_employeeGrid_BeforeShowRow

//Set Row Style @967-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @968-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId_new = CCGetFromGet("t_vat_reg_employee_id", "");
	$sCode = CCGetFromGet("s_keyword", "");
	global $id_new;
	if (empty($keyId_new)) {
		if (empty($id_new)) {
			$id_new = $t_vat_reg_employeeGrid->t_vat_reg_employee_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "t_vat_reg_employee_id", $id_new);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($t_vat_reg_employeeGrid->t_vat_reg_employee_id->GetValue() == $keyId_new) {
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

//Close t_vat_reg_employeeGrid_BeforeShowRow @952-894C7316
    return $t_vat_reg_employeeGrid_BeforeShowRow;
}
//End Close t_vat_reg_employeeGrid_BeforeShowRow

//t_vat_reg_employeeGrid_BeforeSelect @952-E8350169
function t_vat_reg_employeeGrid_BeforeSelect(& $sender)
{
    $t_vat_reg_employeeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_employeeGrid; //Compatibility
//End t_vat_reg_employeeGrid_BeforeSelect

//Custom Code @969-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_reg_employeeGrid_BeforeSelect @952-F6C666B7
    return $t_vat_reg_employeeGrid_BeforeSelect;
}
//End Close t_vat_reg_employeeGrid_BeforeSelect

//Page_BeforeShow @1-4568C802
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_ro_ver; //Compatibility
//End Page_BeforeShow

//Custom Code @884-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

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
  	global $t_vat_reg_dtl_hotel_srvcGrid;
  
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
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = true;
  	}else if($id_req == "2"){
  		$t_vat_reg_dtlSearch->Visible = true;
  		$t_vat_reg_dtlGrid->Visible = true;
  		$t_vat_reg_dtl_restaurantGrid->Visible = true;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else if($id_req == "3"){
  		$t_vat_reg_dtlSearch->Visible = true;
  		$t_vat_reg_dtlGrid->Visible = true;
  		$t_vat_reg_dtl_restaurantGrid->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = true;
  		$t_vat_reg_dtl_parkingGrid->Visible = false;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else if($id_req == "4"){
  		$t_vat_reg_dtlSearch->Visible = true;
  		$t_vat_reg_dtlGrid->Visible = true;
  		$t_vat_reg_dtl_restaurantGrid->Visible = false;
  		$t_vat_reg_dtl_hotelGrid1->Visible = false;
  		$v_vat_reg_dtl_entertaintmentGrid->Visible = false;
  		$t_vat_reg_dtl_parkingGrid->Visible = true;
  		$t_vat_reg_dtl_ppjGrid->Visible = false;
  		$t_vat_reg_dtl_ppj_nplGrid->Visible = false;
  		$t_vat_reg_dtl_hotel_srvcGrid->Visible = false;
  	}else if($id_req == "5"){
  		$t_vat_reg_dtlSearch->Visible = true;
  		$t_vat_reg_dtlGrid->Visible = true;
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

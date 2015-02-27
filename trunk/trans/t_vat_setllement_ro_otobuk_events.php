<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-32878279
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementGrid->cetak1->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak1_BeforeShow";
    $t_vat_setllementGrid->cetak_stpd->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_stpd_BeforeShow";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementForm->Button1->CCSEvents["OnClick"] = "t_vat_setllementForm_Button1_OnClick";
    $t_vat_setllementForm->Button2->CCSEvents["OnClick"] = "t_vat_setllementForm_Button2_OnClick";
    $t_vat_setllementForm->CCSEvents["BeforeShow"] = "t_vat_setllementForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_cetak1_BeforeShow @339-41CE1079
function t_vat_setllementGrid_cetak1_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_cetak1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_cetak1_BeforeShow

//Custom Code @340-2A29BDB7
// -------------------------
    // Write your own code here.
	$CustId = CCGetFromGet("CURR_DOC_ID","");
	$ReqId = $t_vat_setllementGrid->p_rqst_type_id->GetValue();
	$vatId = $t_vat_setllementGrid->t_vat_setllement_id->GetValue();
	$dbConn = new clsDBConnSIKP();
	$sql="select p_settlement_type_id from t_vat_setllement where t_customer_order_id = ".$CustId;
	$dbConn->query($sql);
	$dbConn->next_record();
	$nilai = $dbConn->f("p_settlement_type_id");
	$dbConn->close();
	
	if ($nilai == 1){
		$t_vat_setllementGrid->cetak1->SetValue("<input type='button' value='CETAK' style='WIDTH: 55px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "return cetak1(".$vatId.",".$ReqId.")\">");
	}else if($nilai == 2 or $nilai == 4){
		$t_vat_setllementGrid->cetak1->SetValue("<input type='button' value='CETAK' style='WIDTH: 55px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "return cetak2(".$vatId.")\">");
	}else{
		$t_vat_setllementGrid->cetak1->SetValue("<input type='button' value='CETAK' style='WIDTH: 55px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "return cetak3(".$vatId.")\">");
	}
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_cetak1_BeforeShow @339-14E61B23
    return $t_vat_setllementGrid_cetak1_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak1_BeforeShow

//t_vat_setllementGrid_cetak_stpd_BeforeShow @341-776ADE96
function t_vat_setllementGrid_cetak_stpd_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_cetak_stpd_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_cetak_stpd_BeforeShow

//Custom Code @342-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_vat_setllementGrid->t_vat_setllement_id->GetValue();
	$dbConn = new clsDBConnSIKP();
	$sql ="select count(*)as ada from t_vat_penalty where t_vat_setllement_id = ".$nilai;
	$dbConn->query($sql);
	$dbConn->next_record();
	$ada = $dbConn->f("ada");	
	$dbConn->close();
	if ($ada > 0){
		$t_vat_setllementGrid->cetak_stpd->SetValue("<input type='button' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
	  									 "cetakStpd(".$nilai.")\">");
	}else{
		$t_vat_setllementGrid->cetak_stpd->SetValue("");
	}	
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_cetak_stpd_BeforeShow @341-625FE229
    return $t_vat_setllementGrid_cetak_stpd_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak_stpd_BeforeShow

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

// Start Bdr
	global $t_vat_setllementForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_id->GetValue();
		$t_vat_setllementForm->DataSource->Parameters["urlt_vat_setllement_id"] = $selected_id;
        $t_vat_setllementForm->DataSource->Prepare();
        $t_vat_setllementForm->EditMode = $t_vat_setllementForm->DataSource->AllParametersSet;
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_vat_setllement_id->GetValue()== $selected_id) {
      	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
          $Style = $styles[1];
          $is_show_form=1;
      }	
  // End Bdr  
    if (count($styles)) {
        //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	 $Component->DLink->SetValue($img_radio); // Bdr

//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementForm_Button1_OnClick @336-C9D1FC75
function t_vat_setllementForm_Button1_OnClick(& $sender)
{
    $t_vat_setllementForm_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_Button1_OnClick

//Custom Code @337-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn1 = new clsDBConnSIKP();
	$Idorder = $t_vat_setllementForm->t_customer_order_id->GetValue();
	$cari = "select f_generate_kohir(".$Idorder.") from dual";
	$dbConn1->query($cari);
	while($dbConn1->next_record()){
		$kode = $dbConn1->f("f_generate_kohir");
	}

	$t_vat_setllementForm->no_kohir->SetValue($kode);

	$i_vat_setllement_id = $t_vat_setllementForm->t_vat_setllement_id->GetValue();
	$i_no_kohir = $t_vat_setllementForm->no_kohir->GetValue();
	
	
	$sql_update_kohir = "select f_update_no_kohir_vat_settlement(".$i_vat_setllement_id.",'".$i_no_kohir."') from dual";
	$dbConn1->query($sql_update_kohir);
	return;
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_Button1_OnClick @336-6DBB2532
    return $t_vat_setllementForm_Button1_OnClick;
}
//End Close t_vat_setllementForm_Button1_OnClick

//t_vat_setllementForm_Button2_OnClick @358-08A3AA5F
function t_vat_setllementForm_Button2_OnClick(& $sender)
{
    $t_vat_setllementForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_Button2_OnClick

//Custom Code @361-2A29BDB7
// -------------------------
    $no_kohir = $t_vat_setllementForm->no_kohir->GetValue();
	
	if(!empty($no_kohir)) {
		//empty statement		
	}else {
	
		$dbConn1 = new clsDBConnSIKP();
		$Idorder = $t_vat_setllementForm->t_customer_order_id->GetValue();
		$cari = "select f_generate_kohir(".$Idorder.") from dual";
		$dbConn1->query($cari);
		while($dbConn1->next_record()){
			$kode = $dbConn1->f("f_generate_kohir");
		}

		$t_vat_setllementForm->no_kohir->SetValue($kode);

		$i_vat_setllement_id = $t_vat_setllementForm->t_vat_setllement_id->GetValue();
		$i_no_kohir = $t_vat_setllementForm->no_kohir->GetValue();
	
	
		$sql_update_kohir = "select f_update_no_kohir_vat_settlement(".$i_vat_setllement_id.",'".$i_no_kohir."','".CCGetUserLogin()."') from dual";
		$dbConn1->query($sql_update_kohir);
		
	}
	
	//update anomali 
	$dbConn2 = new clsDBConnSIKP();
	$is_anomali = $t_vat_setllementForm->is_anomali->GetValue();
	$i_vat_setllement_id = $t_vat_setllementForm->t_vat_setllement_id->GetValue();
	$sql_update_anomali = "UPDATE t_vat_setllement SET
							is_anomali = '".$is_anomali."'
							WHERE t_vat_setllement_id = ".$i_vat_setllement_id;
	
	$dbConn2->query($sql_update_anomali);
	//end update

	$payment_key = $t_vat_setllementForm->payment_key->GetFormattedValue();
	if(empty($payment_key)) {
		echo "<script>
			alert('Tidak dapat cetak. No Pembayaran masih kosong');
		</script>";
		
	}else {
		$urlref = "http://202.154.24.4:81/mpd-wp/client/ws.php?type=json&module=bds&class=t_vat_settlement&method=printNoBayar&no_bayar=".$payment_key;
		echo "
  			<script>
  				window.open('".$urlref."', '_blank', 'location=yes,height=500,width=800,scrollbars=yes,status=yes');
  			</script>
  		";
	}
	return;
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_Button2_OnClick @358-F4594333
    return $t_vat_setllementForm_Button2_OnClick;
}
//End Close t_vat_setllementForm_Button2_OnClick

//t_vat_setllementForm_BeforeShow @23-FE2321F2
function t_vat_setllementForm_BeforeShow(& $sender)
{
    $t_vat_setllementForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeShow

//Custom Code @357-2A29BDB7
// -------------------------
    $no_kohir = $t_vat_setllementForm->no_kohir->GetValue();
	if(!empty($no_kohir)) {
		$t_vat_setllementForm->Button1->Visible = false;
	}


	$dbConn = new clsDBConnSIKP();
	$Idorder = $t_vat_setllementForm->t_customer_order_id->GetValue();
	$cari = "select payment_key from t_vat_setllement where t_customer_order_id = ".$Idorder;
	$dbConn->query($cari);
	while($dbConn->next_record()){
		$kode = $dbConn->f("payment_key");
	}

	$t_vat_setllementForm->payment_key->SetValue($kode);

	// -------------------------
//End Custom Code

//Close t_vat_setllementForm_BeforeShow @23-08204CD1
    return $t_vat_setllementForm_BeforeShow;
}
//End Close t_vat_setllementForm_BeforeShow


//Page_OnInitializeView @1-4199983C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_otobuk; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-B2BEA7A9
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_otobuk; //Compatibility
//End Page_BeforeShow

//Custom Code @193-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

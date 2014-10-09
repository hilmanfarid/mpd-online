<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-BC32BDF1
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementForm->Button_Hapus->CCSEvents["OnClick"] = "t_vat_setllementForm_Button_Hapus_OnClick";
    $t_vat_setllementForm->Button2->CCSEvents["OnClick"] = "t_vat_setllementForm_Button2_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

//Set Row Style @315-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

// Start Bdr
    global $t_vat_setllementForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_cust_acc_status_modif_id->GetValue();
        $t_vat_setllementForm->DataSource->Parameters["urlt_cust_acc_status_modif_id"] = $selected_id;
        $t_vat_setllementForm->DataSource->Prepare();
        $t_vat_setllementForm->EditMode = $t_vat_setllementForm->DataSource->AllParametersSet;
        
   }
// End Bdr 

      $styles = array("Row", "AltRow");
  	// Start Bdr    
          $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
          $Style = $styles[0];
          
          if ($Component->DataSource->t_cust_acc_status_modif_id->GetValue()== $selected_id) {
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

	 $Component->DLink->SetValue($img_radio); // Bdr
//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//t_vat_setllementForm_Button_Hapus_OnClick @379-02345DE3
function t_vat_setllementForm_Button_Hapus_OnClick(& $sender)
{
    $t_vat_setllementForm_Button_Hapus_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_Button_Hapus_OnClick

//Custom Code @409-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();

	$id=$t_vat_setllementForm->t_cust_acc_status_modif_id->GetValue();
	$User = CCGetUserLogin();

	$sql = "select f_del_mutasi_status_wp(".$id.",'".$User."')from dual";
	die($sql);
	$dbConn->query($sql);	

// -------------------------
//End Custom Code

//Close t_vat_setllementForm_Button_Hapus_OnClick @379-6E23C139
    return $t_vat_setllementForm_Button_Hapus_OnClick;
}
//End Close t_vat_setllementForm_Button_Hapus_OnClick

//t_vat_setllementForm_Button2_OnClick @381-08A3AA5F
function t_vat_setllementForm_Button2_OnClick(& $sender)
{
    $t_vat_setllementForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_Button2_OnClick

//Custom Code @382-2A29BDB7
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

//Close t_vat_setllementForm_Button2_OnClick @381-F4594333
    return $t_vat_setllementForm_Button2_OnClick;
}
//End Close t_vat_setllementForm_Button2_OnClick

//Page_OnInitializeView @1-8570DC4B
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penutupan_wp; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	 global $selected_id;
          $selected_id = -1;
          $selected_id=CCGetFromGet("t_cust_acc_status_modif_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-A07BE6E0
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penutupan_wp; //Compatibility
//End Page_BeforeShow

//Custom Code @260-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

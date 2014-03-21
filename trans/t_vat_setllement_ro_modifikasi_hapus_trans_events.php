<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-FDFEAE1D
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $CCSEvents;
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	//$nilai1 = CCGetFromGet("CURR_DOC_ID","");
//DEL  	$nilai1 = $t_vat_setllementGrid->t_customer_order_id->GetValue();
//DEL  	$t_vat_setllementGrid->cetak->SetValue("<input type='button' value='CETAK SSPD' style='WIDTH: 75px; HEIGHT: 22px' class='Button' onclick=\"" .
//DEL    									 "return cetak_sspd(".$nilai1.")\">");
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$nilai = $t_vat_setllementGrid->t_vat_setllement_id->GetValue();
//DEL  
//DEL  	$dbConn = new clsDBConnSIKP();
//DEL  	$sql ="select count(*)as ada from t_vat_penalty where t_vat_setllement_id = ".$nilai;
//DEL  	$dbConn->query($sql);
//DEL  	$dbConn->next_record();
//DEL  	$ada = $dbConn->f("ada");	
//DEL  	$dbConn->close();
//DEL  	if ($ada > 0){
//DEL  	//$nilai2 = $t_vat_setllementGrid->p_vat_type_id->GetValue();
//DEL  	$t_vat_setllementGrid->cetak_sptpd->SetValue("<input type='button' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
//DEL    									 "cetakStpd(".$nilai.")\">");
//DEL  	}else{
//DEL  	$t_vat_setllementGrid->cetak_sptpd->SetValue("");	
//DEL  	}
//DEL  	/*
//DEL  	$action_button = CCGetFromGet("action_button","");
//DEL  	$action_button2 = CCGetFromGet("action_button2","");
//DEL  	if($action_button=='flag_payment' && $action_button2!='cetak_register'){
//DEL  		$dbConn = new clsDBConnSIKP();
//DEL  		$sql="select sikp.f_payment_manual(".CCGetFromGet('t_customer_order_id').",'".CCGetSession('UserLogin')."')";
//DEL  		$dbConn->query($sql);
//DEL  		$dbConn->next_record();
//DEL  		echo "
//DEL  		<script>
//DEL  		alert('".$dbConn->f('f_payment_manual')."');
//DEL  		</script>
//DEL  		";
//DEL  		$dbConn->close();	
//DEL  	}else if($action_button2=='cetak_register'){
//DEL  		$dbConn = new clsDBConnSIKP();
//DEL  		$sql="select sikp.f_print_register(".CCGetFromGet('t_customer_order_id').",'".CCGetSession('UserLogin')."')";
//DEL  		$dbConn->query($sql);
//DEL  		$dbConn->next_record();
//DEL  		print_laporan($dbConn->f('f_print_register'));
//DEL  		$dbConn->close();
//DEL  	}
//DEL  	*/
//DEL  // -------------------------

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

// Start Bdr
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_id->GetValue();
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

//t_vat_setllementGrid_BeforeShow @2-27F9F7A4
function t_vat_setllementGrid_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShow

//Custom Code @316-2A29BDB7
// -------------------------
    if(CCGetFromGet("s_keyword") == "") {
		$t_vat_setllementGrid->Visible = false;
	}else {
		$t_vat_setllementGrid->Visible = true;
	}
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_BeforeShow @2-542B3DA4
    return $t_vat_setllementGrid_BeforeShow;
}
//End Close t_vat_setllementGrid_BeforeShow


//Page_OnInitializeView @1-3B6532F9
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_modifikasi_hapus_trans; //Compatibility
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

//Page_BeforeShow @1-6C34B98C
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_modifikasi_hapus_trans; //Compatibility
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

function print_laporan($param_arr){
	include "../include/fpdf17/mc_table.php";
	$_BORDER = 0;
	$_FONT = 'Times';
	$_FONTSIZE = 10;
    $pdf = new PDF_MC_Table();
	$size = $pdf->_getpagesize('Legal');
	$size[1]=6;
	$pdf->DefPageSize = $size;
	$pdf->CurPageSize = $size;
    $pdf->AddPage('Landscape',array(150,40));
    $pdf->SetFont('helvetica', '', $_FONTSIZE);
	$pdf->SetRightMargin(5);
	$pdf->SetLeftMargin(5);
	$pdf->SetAutoPageBreak(false,0);

	$pdf->SetFont('helvetica', '',12);
	$pdf->SetWidths(array(200));
	$pdf->ln(1);
	$items = explode('#',$param_arr);
	foreach($items as $item){
    	$pdf->RowMultiBorderWithHeight(array($item),array('',''),6);
	}
	//$pdf->ln(8);
	$handle = printer_open("HP Deskjet 930c");
	$pdf->Output("","I");
	echo 'tes';
	exit;	
}
?>

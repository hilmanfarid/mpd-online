<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-32DE8FD8
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $CCSEvents;
    $t_vat_setllementGrid->cetak->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_BeforeShow";
    $t_vat_setllementGrid->cetak_sptpd->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_sptpd_BeforeShow";
    $t_vat_setllementGrid->cetak_sptpd2->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_sptpd2_BeforeShow";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_cetak_BeforeShow @224-89B763DE
function t_vat_setllementGrid_cetak_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_cetak_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_cetak_BeforeShow

//Custom Code @225-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
     // Write your own code here.
  	//$nilai1 = CCGetFromGet("CURR_DOC_ID","");
  	$nilai1 = $t_vat_setllementGrid->t_customer_order_id->GetValue();
  	$t_vat_setllementGrid->cetak->SetValue("<input type='button' value='CETAK SSPD' style='WIDTH: 75px; HEIGHT: 22px' class='Button' onclick=\"" .
    									 "return cetak_sspd(".$nilai1.")\">");
  // -------------------------


//Close t_vat_setllementGrid_cetak_BeforeShow @224-6B3874F7
    return $t_vat_setllementGrid_cetak_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak_BeforeShow

//t_vat_setllementGrid_cetak_sptpd_BeforeShow @300-21C2B684
function t_vat_setllementGrid_cetak_sptpd_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_cetak_sptpd_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_cetak_sptpd_BeforeShow

//Custom Code @301-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//DEL  // -------------------------
//DEL      // Write your own code here.
  	$nilai = $t_vat_setllementGrid->t_vat_setllement_id->GetValue();
  
  	$dbConn = new clsDBConnSIKP();
  	$sql ="select count(*)as ada from t_vat_penalty where t_vat_setllement_id = ".$nilai;
  	$dbConn->query($sql);
  	$dbConn->next_record();
  	$ada = $dbConn->f("ada");	
  	$dbConn->close();
  	if ($ada > 0){
  	//$nilai2 = $t_vat_setllementGrid->p_vat_type_id->GetValue();
  	$t_vat_setllementGrid->cetak_sptpd->SetValue("<input type='button' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\""  .
    									 "cetakStpd(".$nilai.",'tgl_tap')\">");
	$t_vat_setllementGrid->cetak_sptpd2->SetValue("<input type='button' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    									 "cetakStpd(".$nilai.",'tgl_bayar')\">");
  	}else{
  	$t_vat_setllementGrid->cetak_sptpd->SetValue("");
	$t_vat_setllementGrid->cetak_sptpd2->SetValue("");	
  	}
  	/*
  	$action_button = CCGetFromGet("action_button","");
  	$action_button2 = CCGetFromGet("action_button2","");
  	if($action_button=='flag_payment' && $action_button2!='cetak_register'){
  		$dbConn = new clsDBConnSIKP();
  		$sql="select sikp.f_payment_manual(".CCGetFromGet('t_customer_order_id').",'".CCGetSession('UserLogin')."')";
  		$dbConn->query($sql);
  		$dbConn->next_record();
  		echo "
  		<script>
  		alert('".$dbConn->f('f_payment_manual')."');
  		</script>
  		";
  		$dbConn->close();	
  	}else if($action_button2=='cetak_register'){
  		$dbConn = new clsDBConnSIKP();
  		$sql="select sikp.f_print_register(".CCGetFromGet('t_customer_order_id').",'".CCGetSession('UserLogin')."')";
  		$dbConn->query($sql);
  		$dbConn->next_record();
  		print_laporan($dbConn->f('f_print_register'));
  		$dbConn->close();
  	}
  	*/
  // -------------------------


//Close t_vat_setllementGrid_cetak_sptpd_BeforeShow @300-BF0BB7F2
    return $t_vat_setllementGrid_cetak_sptpd_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak_sptpd_BeforeShow

//t_vat_setllementGrid_cetak_sptpd2_BeforeShow @314-A1F37F87
function t_vat_setllementGrid_cetak_sptpd2_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_cetak_sptpd2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_cetak_sptpd2_BeforeShow

//Custom Code @315-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_cetak_sptpd2_BeforeShow @314-1839F9B4
    return $t_vat_setllementGrid_cetak_sptpd2_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak_sptpd2_BeforeShow

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

// Start Bdr
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_id->GetValue();
   }
// End Bdr  

//DEL      $styles = array("Row", "AltRow");
//DEL  	// Start Bdr    
//DEL        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
//DEL        $Style = $styles[0];
//DEL        
//DEL        if ($Component->DataSource->t_vat_setllement_id->GetValue()== $selected_id) {
//DEL        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
//DEL            $Style = $styles[1];
//DEL            $is_show_form=1;
//DEL        }	
//DEL    // End Bdr  
//DEL      if (count($styles)) {
//DEL          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
//DEL          if (strlen($Style) && !strpos($Style, "="))
//DEL              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
//DEL          $Component->Attributes->SetValue("rowStyle", $Style);
//DEL      }

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
// -------------------------
//End Custom Code

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
//DEL  // -------------------------


//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect


//Page_OnInitializeView @1-B27A45F4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_new; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	  global $selected_id;
//DEL        $selected_id = -1;
//DEL        $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
//DEL  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-95E0D60F
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_new; //Compatibility
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

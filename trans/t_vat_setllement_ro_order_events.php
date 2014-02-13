<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
$no_kohir = CCGetFromGet('s_keyword');
	if(!empty($no_kohir)){
		$dbConn = new clsDBConnSIKP();
  		$sql="select t_customer_order_id from t_vat_setllement where no_kohir='".$no_kohir."'";
  		$dbConn->query($sql);
  		$dbConn->next_record();
		$_POST['t_customer_order_id']=$_GET['t_customer_order_id'] = $dbConn->f('t_customer_order_id');
  		$dbConn->close();		
	}else{
		$_POST['t_customer_order_id']=$_GET['t_customer_order_id'] = CCGetFromGet('CURR_DOC_ID');
	}
//exit;
//BindEvents Method @1-1720D2CA
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementGrid->cetak_sptpd->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_sptpd_BeforeShow";
    $t_vat_setllementGrid->cetak->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_BeforeShow";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementForm->no_kohir->CCSEvents["BeforeShow"] = "t_vat_setllementForm_no_kohir_BeforeShow";
    $t_vat_setllementForm->CCSEvents["BeforeShow"] = "t_vat_setllementForm_BeforeShow";
    $t_vat_setllementForm->CCSEvents["BeforeSelect"] = "t_vat_setllementForm_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

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

  // -------------------------
      // Write your own code here.
	$pajak = $t_vat_setllementGrid->total_vat_amount->GetValue();
	$denda = $t_vat_setllementGrid->total_penalty_amount->GetValue();
	$totaltotal = $pajak + $denda;
	$t_vat_setllementGrid->total_total->SetValue($totaltotal);
  	$nilai = $t_vat_setllementGrid->t_vat_setllement_id->GetValue();
  	$nilai2 = $t_vat_setllementGrid->p_vat_type_id->GetValue();

  	$t_vat_setllementGrid->cetak_sptpd->SetValue("<input type='button' style='display:none;' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    									 "cetakSptpd(".$nilai.",".$nilai2.")\">");
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
  		/*echo "
  			<script>
  				window.open('../services/print_string.php?input_number=".$dbConn->f('f_print_register')."', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
  			</script>
  		";*/
  		$dbConn->close();
  		exit;
  	}
  // -------------------------


//Close t_vat_setllementGrid_cetak_sptpd_BeforeShow @300-BF0BB7F2
    return $t_vat_setllementGrid_cetak_sptpd_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak_sptpd_BeforeShow

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
  	$nilai1 = CCGetFromGet("CURR_DOC_ID","");
  	$t_vat_setllementGrid->cetak->SetValue("<input type='button' style='display:none;' value='CETAK SSPD' style='WIDTH: 75px; HEIGHT: 22px' class='Button' onclick=\"" .
    									 "return cetak_sspd(".$nilai1.")\">");
  // -------------------------


//Close t_vat_setllementGrid_cetak_BeforeShow @224-6B3874F7
    return $t_vat_setllementGrid_cetak_BeforeShow;
}
//End Close t_vat_setllementGrid_cetak_BeforeShow

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

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$dbConn1 = new clsDBConnSIKP();
//DEL  	$Idorder = $t_vat_setllementForm->t_customer_order_id->GetValue();
//DEL  	$cari = "select f_generate_kohir(".$Idorder.") from dual";
//DEL  	$dbConn1->query($cari);
//DEL  	while($dbConn1->next_record()){
//DEL  		$kode = $dbConn1->f("f_generate_kohir");
//DEL  	}
//DEL  
//DEL  	$t_vat_setllementForm->no_kohir->SetValue($kode);
//DEL  	return;
//DEL  // -------------------------

//t_vat_setllementForm_no_kohir_BeforeShow @315-2DA5C188
function t_vat_setllementForm_no_kohir_BeforeShow(& $sender)
{
    $t_vat_setllementForm_no_kohir_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_no_kohir_BeforeShow

//Custom Code @354-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_no_kohir_BeforeShow @315-752B465F
    return $t_vat_setllementForm_no_kohir_BeforeShow;
}
//End Close t_vat_setllementForm_no_kohir_BeforeShow

//t_vat_setllementForm_BeforeShow @23-FE2321F2
function t_vat_setllementForm_BeforeShow(& $sender)
{
    $t_vat_setllementForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeShow
	global $t_vat_setllementGrid;
//Custom Code @380-2A29BDB7
// -------------------------
    // Write your own code here.
	$pajak = $t_vat_setllementGrid->total_vat_amount->GetValue();
	$denda = $t_vat_setllementGrid->total_penalty_amount->GetValue();
	$totaltotal = $pajak + $denda;
	$t_vat_setllementForm->total_total->SetValue($totaltotal);
  	$nilai = $t_vat_setllementGrid->t_vat_setllement_id->GetValue();
  	$nilai2 = $t_vat_setllementGrid->p_vat_type_id->GetValue();

  	$t_vat_setllementGrid->cetak_sptpd->SetValue("<input type='button' style='display:none;' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
    									 "cetakSptpd(".$nilai.",".$nilai2.")\">");
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
  		/*echo "
  			<script>
  				window.open('../services/print_string.php?input_number=".$dbConn->f('f_print_register')."', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
  			</script>
  		";*/
  		$dbConn->close();
  		exit;
  	}
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_BeforeShow @23-08204CD1
    return $t_vat_setllementForm_BeforeShow;
}
//End Close t_vat_setllementForm_BeforeShow

//t_vat_setllementForm_BeforeSelect @23-46687DEC
function t_vat_setllementForm_BeforeSelect(& $sender)
{
    $t_vat_setllementForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeSelect

//Custom Code @381-2A29BDB7
// -------------------------
    // Write your own code here.
	//$_SESSION['thisFormParam']='';
	if(!empty($_POST['t_customer_order_id'])||!empty($_GET['t_customer_order_id'])){
		$t_vat_setllementForm->EditMode=true;
		$t_vat_setllementForm->Visible=true;
	}else{
		$t_vat_setllementForm->Visible=false;
	}
	     // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_BeforeSelect @23-489DCACD
    return $t_vat_setllementForm_BeforeSelect;
}
//End Close t_vat_setllementForm_BeforeSelect

//Page_OnInitializeView @1-5CDF5FF6
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_order; //Compatibility
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
        $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-C29182E4
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_order; //Compatibility
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

//Page_BeforeInitialize @1-13040122
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro_order; //Compatibility
//End Page_BeforeInitialize

//Custom Code @384-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

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
	$pdf->Output("","I");
	echo 'tes';
	exit;	
}
?>

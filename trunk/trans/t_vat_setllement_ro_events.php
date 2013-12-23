<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-EC40708D
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $CCSEvents;
    $t_vat_setllementGrid->cetak_sptpd->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_sptpd_BeforeShow";
    $t_vat_setllementGrid->cetak->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_cetak_BeforeShow";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
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
		//print_laporan($dbConn->f('f_print_register'));
		echo "
			<script>
				window.open('../services/print_string.php?input_number=".$dbConn->f('f_print_register')."', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
			</script>
		";
		$dbConn->close();
		exit;
	}
// -------------------------
//End Custom Code

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
	$nilai1 = CCGetFromGet("CURR_DOC_ID","");
	$t_vat_setllementGrid->cetak->SetValue("<input type='button' style='display:none;' value='CETAK SSPD' style='WIDTH: 75px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "return cetak_sspd(".$nilai1.")\">");
// -------------------------
//End Custom Code

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


//Page_OnInitializeView @1-EFFF9779
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro; //Compatibility
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

//Page_BeforeShow @1-93381E3D
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ro; //Compatibility
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
	$pdf->Output("","I");
	echo 'tes';
	exit;	
}
?>

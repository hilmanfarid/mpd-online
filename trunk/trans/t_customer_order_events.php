<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-D3804A87
function BindEvents()
{
    global $t_customer_orderGrid;
    global $t_customer_orderForm;
    global $CCSEvents;
    $t_customer_orderGrid->cetak->CCSEvents["BeforeShow"] = "t_customer_orderGrid_cetak_BeforeShow";
    $t_customer_orderGrid->CCSEvents["BeforeShowRow"] = "t_customer_orderGrid_BeforeShowRow";
    $t_customer_orderGrid->CCSEvents["BeforeSelect"] = "t_customer_orderGrid_BeforeSelect";
    $t_customer_orderForm->Button1->CCSEvents["OnClick"] = "t_customer_orderForm_Button1_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_customer_orderGrid_cetak_BeforeShow @624-A8ED04B1
function t_customer_orderGrid_cetak_BeforeShow(& $sender)
{
    $t_customer_orderGrid_cetak_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_orderGrid; //Compatibility
//End t_customer_orderGrid_cetak_BeforeShow

//Custom Code @625-2A29BDB7
// -------------------------
    // Write your own code here.
	$nilai = $t_customer_orderGrid->p_rqst_type_id->GetValue();
	$nilai2 = $t_customer_orderGrid->t_customer_order_id->GetValue();
	$t_customer_orderGrid->cetak->SetValue("<input type='button' value='CETAK' style='WIDTH: 57px; HEIGHT: 22px' class='Button' onclick=\"" .
  									 "cetak(".$nilai.",".$nilai2.")\">");
// -------------------------
//End Custom Code

//Close t_customer_orderGrid_cetak_BeforeShow @624-B3C68BFC
    return $t_customer_orderGrid_cetak_BeforeShow;
}
//End Close t_customer_orderGrid_cetak_BeforeShow

//t_customer_orderGrid_BeforeShowRow @2-85661EE4
function t_customer_orderGrid_BeforeShowRow(& $sender)
{
    $t_customer_orderGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_orderGrid; //Compatibility
//End t_customer_orderGrid_BeforeShowRow

// Start Bdr
    global $t_customer_orderForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_customer_order_id->GetValue();
        $t_customer_orderForm->DataSource->Parameters["urlt_customer_order_id"] = $selected_id;
        $t_customer_orderForm->DataSource->Prepare();
        $t_customer_orderForm->EditMode = $t_customer_orderForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_customer_order_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    

    if (count($styles)) {
//        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	$Component->DLink->SetValue($img_radio); // Bdr
//Custom Code @622-2A29BDB7
// -------------------------
    // Write your own code here.
	$CusId = $t_customer_orderGrid->t_customer_order_id->GetValue();
	$VatId = $t_customer_orderGrid->t_vat_registration_id->GetValue();
	$ReqId = $t_customer_orderGrid->p_rqst_type_id->GetValue();
	$dbConn = new clsDBConnSIKP();

	$sql = "select f_check_wp(".$CusId.",".$ReqId.",".$VatId.")as btn_cetak, "
		  ."f_check_wp_doc(".$CusId.")as btn_submit from dual;";
	$dbConn->query($sql);
	$dbConn->next_record();
	$btn_cetak = $dbConn->f("btn_cetak");
	$btn_submit = $dbConn->f("btn_submit");
	$dbConn->close();

	if ($btn_cetak > 0){
		$t_customer_orderGrid->cetak->Visible = true;
	}else{
		$t_customer_orderGrid->cetak->Visible = false;
	}

// -------------------------
//End Custom Code
	

//Close t_customer_orderGrid_BeforeShowRow @2-B7EA7255
    return $t_customer_orderGrid_BeforeShowRow;
}
//End Close t_customer_orderGrid_BeforeShowRow

//t_customer_orderGrid_BeforeSelect @2-6FA3AEA2
function t_customer_orderGrid_BeforeSelect(& $sender)
{
    $t_customer_orderGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_orderGrid; //Compatibility
//End t_customer_orderGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_customer_orderGrid_BeforeSelect @2-3EB0FE50
    return $t_customer_orderGrid_BeforeSelect;
}
//End Close t_customer_orderGrid_BeforeSelect

//t_customer_orderForm_Button1_OnClick @629-BB38E4FA
function t_customer_orderForm_Button1_OnClick(& $sender)
{
    $t_customer_orderForm_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_orderForm; //Compatibility
//End t_customer_orderForm_Button1_OnClick

//Custom Code @630-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConnect = new clsDBConnSIKP();
	$CustId = $t_customer_orderForm->t_customer_order_id->GetValue();
	$sql = "select o_result_code, o_result_msg from f_first_submit_engine(500,".$CustId.",'".CCGetUserLogin()."')";
	//die($sql);
	$dbConnect->query($sql);
	while($dbConnect->next_record()){
		$errCode = $dbConnect->f("o_result_code");
		$errMsg = $dbConnect->f("o_result_msg");
	}

	echo "<meta http-equiv='refresh' content='0;url=t_customer_order.php?pesan=".$errMsg."'/>";
	exit;
// -------------------------
//End Custom Code

//Close t_customer_orderForm_Button1_OnClick @629-9E6FF49A
    return $t_customer_orderForm_Button1_OnClick;
}
//End Close t_customer_orderForm_Button1_OnClick

//Page_OnInitializeView @1-F7A504BF
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_order; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_customer_order_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

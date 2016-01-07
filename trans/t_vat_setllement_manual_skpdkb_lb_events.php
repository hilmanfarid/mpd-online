<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-04ADD081
function BindEvents()
{
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementForm->Button1->CCSEvents["OnClick"] = "t_vat_setllementForm_Button1_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_setllementForm_Button1_OnClick @164-C9D1FC75
function t_vat_setllementForm_Button1_OnClick(& $sender)
{
    $t_vat_setllementForm_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_Button1_OnClick

//Custom Code @165-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();
	$cusAccId = $t_vat_setllementForm->t_cust_account_id->GetValue();
	$Period = $t_vat_setllementForm->p_finance_period_id->GetValue();
	$yearPeriod = $t_vat_setllementForm->p_year_period_id->GetValue();
	$npwd = $t_vat_setllementForm->npwd->GetValue(); 	
	$ms_start = $t_vat_setllementForm->start_period->GetValue();
	$ms_end = $t_vat_setllementForm->end_period->GetValue();
	$kamar = trim($t_vat_setllementForm->qty_room_sold->GetValue());
	$tot = $t_vat_setllementForm->total_trans_amount->GetValue();
	$p_vat_type_dtl_id = $t_vat_setllementForm->p_vat_type_dtl_id->GetValue();
	$p_vat_type_dtl_cls_id = $t_vat_setllementForm->p_vat_type_dtl_cls_id->GetValue();
	$mode_denda =$t_vat_setllementForm->mode_denda->GetValue();
	$User = CCGetUserLogin();
	
	$errorMsg = '';

	//new fix
	if(!isset($p_vat_type_dtl_cls_id) || $p_vat_type_dtl_cls_id == '') $p_vat_type_dtl_cls_id = 'NULL';
	if(empty($kamar)) $kamar = 0;	

	$sql = "select * from f_vat_settlement_manual_skpdkb_lb($cusAccId,$Period,'$npwd','$ms_start','$ms_end',$kamar,$tot,$p_vat_type_dtl_id,$p_vat_type_dtl_cls_id,'$User')";
	//echo $sql;exit;
	//die($sql);
	$dbConn->query($sql);
	$dbConn->next_record();
	$cust_id = $dbConn->f("o_cust_order_id");
	$mess = $dbConn->f("o_mess");

	//modified by wiliam
	/*echo "<script> 
		alert('".$mess."');
		window.opener.location.reload();
		window.close();
	</script>";
	
	exit;*/
	if(!$cust_id == 0 && !$cust_id == ""){
		
		$sql2 = "select * from f_first_submit_engine_2step(
		501,
		$cust_id,
		'$User')";

		//die($sql2);
		$dbConn->query($sql2);
		$dbConn->next_record();
		$o_result_code = $dbConn->f("o_result_code");

		if($o_result_code == 0){
			echo '<script language="javascript">';
			echo 'alert("'.$mess.'");';
			echo '</script>';
		}
		else{
			$mess = $dbConn->f("o_result_msg");
			echo '<script language="javascript">';
			echo 'alert("'.$mess.'");';
			echo '</script>';
		}
	}
	else{
	    $mess = str_replace('"','',$mess);
		echo '<script language="javascript">';
		echo 'alert("'.$mess.'");';
		echo '</script>';
		
	}
	
	if(!$cust_id == 0 && !$cust_id == ""){
		$dbConn2 = new clsDBConnSIKP();
		$sqlPayment = "select t_vat_setllement_id from t_vat_setllement where t_customer_order_id = ".$cust_id;
		$dbConn2->query($sqlPayment);
		$dbConn2->next_record();
		$t_vat_setllement_id = $dbConn2->f("t_vat_setllement_id");
	  	
		echo '<script language="javascript">';
		echo "window.open('../report/cetak_formulir_skpdkb_lb.php?t_vat_setllement_id=".$t_vat_setllement_id."','No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes')";
		echo '</script>';
		
	}
	return;
	
// -------------------------


//Close t_vat_setllementForm_Button1_OnClick @164-6DBB2532
    return $t_vat_setllementForm_Button1_OnClick;
}
//End Close t_vat_setllementForm_Button1_OnClick

//Page_OnInitializeView @1-C012089D
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_manual_skpdkb_lb; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView
?>
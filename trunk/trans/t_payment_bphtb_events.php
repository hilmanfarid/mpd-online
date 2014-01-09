<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-723A91CE
function BindEvents()
{
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementForm->Button1->CCSEvents["OnClick"] = "t_vat_setllementForm_Button1_OnClick";
    $t_vat_setllementForm->CCSEvents["BeforeShow"] = "t_vat_setllementForm_BeforeShow";
    $t_vat_setllementForm->CCSEvents["AfterInsert"] = "t_vat_setllementForm_AfterInsert";
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

	/* $dbConn = new clsDBConnSIKP();
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
	$User = CCGetUserLogin();
	
	if(!isset($kamar) || $kamar == '') $kamar = 'NULL';
	
	//new fix
	if(!isset($p_vat_type_dtl_cls_id) || $p_vat_type_dtl_cls_id == '') $p_vat_type_dtl_cls_id = 'NULL';

	$sql = "select * from f_vat_settlement_manual_new($cusAccId,$Period,'$npwd','$ms_start','$ms_end',$kamar,$tot,$p_vat_type_dtl_id,$p_vat_type_dtl_cls_id,'$User')";

	//die($sql);
	$dbConn->query($sql);
	$dbConn->next_record();
	$cust_id = $dbConn->f("o_cust_order_id");
	$mess = $dbConn->f("o_mess");


	if(!$cust_id == 0 && !$cust_id == ""){
		$sql2 = "select * from f_first_submit_engine(
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
		echo '<script language="javascript">';
		echo 'alert("'.$mess.'");';
		echo '</script>';	
	}
	
	return;
	*/
	
// -------------------------


//Close t_vat_setllementForm_Button1_OnClick @164-6DBB2532
    return $t_vat_setllementForm_Button1_OnClick;
}
//End Close t_vat_setllementForm_Button1_OnClick

//t_vat_setllementForm_BeforeShow @23-FE2321F2
function t_vat_setllementForm_BeforeShow(& $sender)
{
    $t_vat_setllementForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeShow
	$t_vat_setllementForm->BtnBayar->Visible = false;
//Custom Code @179-2A29BDB7
// -------------------------
    // Write your own code here.
	$no_registrasi = CCGetFromGet('no_registrasi');
	if(!empty($no_registrasi)) {
				
		
		$dbConn = new clsDBConnSIKP();
		$sql = "select o_ret_code from f_inquery_bphtb('$no_registrasi', null)";

		$dbConn->query($sql);
		$dbConn->next_record();
		$long_code = $dbConn->f("o_ret_code");
		
		if(substr($long_code, 0, 2) != "00") {
			$t_vat_setllementForm->Label1->SetValue('<span style="color:red;"> '.$long_code.' </span>');		
			
		}else {
			//$t_vat_setllementForm->LabelBayar->SetValue('<input type="submit" name="BtnBayar" id="BtnBayar" value="Bayar" class="btn_tambah"/>');
			
			$t_vat_setllementForm->BtnBayar->Visible = true;

			$pieces = explode("@",$long_code);
			$pieces1st = explode("|", $pieces[0]);
			$pieces2nd = str_replace("|", "\n", $pieces[1]);

			$t_vat_setllementForm->bit48->SetValue($pieces[0]);
			$t_vat_setllementForm->nilai_pembayaran->SetValue($pieces1st[7]);
			$t_vat_setllementForm->TextArea1->SetValue($pieces2nd);
			$t_vat_setllementForm->no_reg->SetValue($no_registrasi);
			
		
		}
	}

// -------------------------
//End Custom Code

//Close t_vat_setllementForm_BeforeShow @23-08204CD1
    return $t_vat_setllementForm_BeforeShow;
}
//End Close t_vat_setllementForm_BeforeShow

//t_vat_setllementForm_AfterInsert @23-89E44639
function t_vat_setllementForm_AfterInsert(& $sender)
{
    $t_vat_setllementForm_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_AfterInsert

//Custom Code @186-2A29BDB7
// -------------------------
    // Write your own code here.
	$msg = pg_fetch_array($t_vat_setllementForm->DataSource->result_pembayaran);
	if(substr($msg['o_ret_code'], 0, 2) != "00") {	

		echo "<script> alert('".$msg['o_ret_code']."'); 
			location.href = 't_payment_bphtb.php';
		</script>";

	}else {
		$t_vat_setllementForm->Label1->SetValue('<span style="color:blue;"> Pembayaran Berhasil Dilakukan </span>');
		
		$pieces = explode("@",$msg['o_ret_code']);
		$pieces2nd = str_replace("|", "\n", $pieces[1]);
		$t_vat_setllementForm->TextArea1->SetValue($pieces2nd);
		$t_vat_setllementForm->BtnBayar->Visible = false;
	}
	exit;
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_AfterInsert @23-8871F8C1
    return $t_vat_setllementForm_AfterInsert;
}
//End Close t_vat_setllementForm_AfterInsert

//Page_OnInitializeView @1-670B03DE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_payment_bphtb; //Compatibility
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

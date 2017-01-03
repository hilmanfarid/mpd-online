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
	$t_ppat_id = $t_vat_setllementForm->t_ppat_id->GetValue();
	$ppat_name = $t_vat_setllementForm->ppat_name->GetValue();
	$address_name = $t_vat_setllementForm->address_name->GetValue();
	$p_finance_period_id = $t_vat_setllementForm->p_finance_period_id->GetValue(); 	
	$p_finance_period_id_ajb = $t_vat_setllementForm->p_finance_period_id_ajb->GetValue(); 	
	$no_sk = $t_vat_setllementForm->no_sk->GetValue();
	$sanksi_ajb = $t_vat_setllementForm->sanksi_ajb->GetValue();
	$User = CCGetUserLogin();

	if($User==''){
		echo '<script language="javascript">';
		echo 'alert("Harap Login terlebih dahulu");';
		echo '</script>';	
		return;
	}
	
	if($sanksi_ajb=='' && $p_finance_period_id == ''){
		echo '<script language="javascript">';
		echo 'alert("Harap isi Denda atas Pelaporan Bulan atau Denda atas AJB atau isi keduanya.");';
		echo '</script>';	
		return;
	}

	if($sanksi_ajb!='' && $p_finance_period_id_ajb == ''){
		echo '<script language="javascript">';
		echo 'alert("Jika mengisi denda AJB, harap isi Tahun dan Bulan denda AJB.");';
		echo '</script>';	
		return;
	}
	
	$sql = "select * from f_vat_settlement_ppat('$t_ppat_id', '$ppat_name', '$address_name',
			'$no_sk', '$p_finance_period_id', '$sanksi_ajb','$User', '$p_finance_period_id_ajb')";
	//die($sql);
	$dbConn->query($sql);
	$dbConn->next_record();
	$cust_id = $dbConn->f("o_cust_order_id");
	$cust_id_ajb = $dbConn->f("o_cust_order_id_ajb");
	$mess = $dbConn->f("o_mess");

    $mess = str_replace('"','',$mess);
	echo '<script language="javascript">';
	echo 'alert("'.$mess.'");';
	echo 'location.href="t_vat_setllement_ppat.php";';
	if ($cust_id!=''){
		echo 'window.open("../report/cetak_formulir_surat_tagihan_denda_profesi.php?t_customer_order_id="+'.$cust_id.', "_blank", "location=yes,height=570,width=520,scrollbars=yes,status=yes");';
	}
	if ($cust_id_ajb!=''){
		echo 'window.open("../report/cetak_formulir_surat_tagihan_denda_profesi.php?t_customer_order_id="+'.$cust_id_ajb.', "_blank", "location=yes,height=570,width=520,scrollbars=yes,status=yes");';
	}
	echo '</script>';	
	
	return;
// -------------------------


//Close t_vat_setllementForm_Button1_OnClick @164-6DBB2532
    return $t_vat_setllementForm_Button1_OnClick;
}
//End Close t_vat_setllementForm_Button1_OnClick

//Page_OnInitializeView @1-A2ECDF40
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ppat; //Compatibility
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

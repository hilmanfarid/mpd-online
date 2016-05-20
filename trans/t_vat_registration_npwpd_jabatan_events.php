<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-CA067F8B
function BindEvents()
{
    global $t_ppatForm;
    global $CCSEvents;
    $t_ppatForm->Button_Insert->CCSEvents["OnClick"] = "t_ppatForm_Button_Insert_OnClick";
    $t_ppatForm->CCSEvents["AfterInsert"] = "t_ppatForm_AfterInsert";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_ppatForm_Button_Insert_OnClick @24-49025B89
function t_ppatForm_Button_Insert_OnClick(& $sender)
{
    $t_ppatForm_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_ppatForm; //Compatibility
//End t_ppatForm_Button_Insert_OnClick

//Custom Code @374-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();
	$company_brand = $t_ppatForm->company_brand->GetValue();
	$p_rqst_type_id = $t_ppatForm->p_rqst_type_id->GetValue();
	$p_vat_type_dtl_id = $t_ppatForm->p_vat_type_dtl_id->GetValue();
	$brand_address_name = $t_ppatForm->brand_address_name->GetValue();
	$brand_address_no = $t_ppatForm->brand_address_no->GetValue();
	$brand_address_rt = $t_ppatForm->brand_address_rt->GetValue();
	$brand_address_rw = $t_ppatForm->brand_address_rw->GetValue();
	$company_additional_addr = $t_ppatForm->company_additional_addr->GetValue();
	$brand_p_region_id = $t_ppatForm->brand_p_region_id->GetValue();
	$brand_p_region_id_kec = $t_ppatForm->brand_p_region_id_kec->GetValue();
	$brand_p_region_id_kel = $t_ppatForm->brand_p_region_id_kel->GetValue();
	$brand_phone_no = $t_ppatForm->brand_phone_no->GetValue();
	$brand_mobile_no = $t_ppatForm->brand_mobile_no->GetValue();
	$brand_fax_no = $t_ppatForm->brand_fax_no->GetValue();
	$brand_zip_code = $t_ppatForm->brand_zip_code->GetValue();
	$user = $t_ppatForm->created_by->GetValue();

	$sql = "select * from f_insert_vat_reg_npwpd_jabatan(
			'$user', 
			'$company_brand',
			'$company_additional_addr',
			'$brand_address_name',
			'$brand_address_no',
			'$brand_address_rt',
			'$brand_address_rw',
			$brand_p_region_id_kel,
			$brand_p_region_id_kec,
			$brand_p_region_id,
			'$brand_phone_no',
			'$brand_mobile_no',
			'$brand_fax_no',
			'$brand_zip_code',
			$p_rqst_type_id,
			$p_vat_type_dtl_id
			)";
	//die($sql);
	$dbConn->query($sql);
	$dbConn->next_record();
	$cust_id = $dbConn->f("v_customer_order_id");
	$mess = $dbConn->f("o_result_msg");

	if($cust_id != 0 && $cust_id != ""){
		echo '<script language="javascript">';
		echo "window.open('../report/cetak_surat_pengukuhan_npwpd_jabatan.php?CURR_DOC_ID=$cust_id', 
				'pengukuhan', 'height=,width=,left=0,top=0');";
		echo "window.open('../report/cetak_form_pemutakhiran_data_npwpd_jabatan.php?t_customer_order_id=$cust_id', 
				'pemutakhiran', 'height=,width=,left=0,top=0');";
		echo '</script>';
		
	}else{
		$mess = str_replace('"','',$mess);
		echo '<script language="javascript">';
		echo 'alert("'.$mess.'");';
		echo '</script>';
	}
	echo '<script language="javascript">';
	echo "location.href='t_vat_registration_npwpd_jabatan.php';";
	echo '</script>';
	return;
// -------------------------
//End Custom Code

//Close t_ppatForm_Button_Insert_OnClick @24-EE087F7F
    return $t_ppatForm_Button_Insert_OnClick;
}
//End Close t_ppatForm_Button_Insert_OnClick

//t_ppatForm_AfterInsert @23-78D50125
function t_ppatForm_AfterInsert(& $sender)
{
    $t_ppatForm_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_ppatForm; //Compatibility
//End t_ppatForm_AfterInsert

//Custom Code @372-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_ppatForm_AfterInsert @23-E47C114D
    return $t_ppatForm_AfterInsert;
}
//End Close t_ppatForm_AfterInsert

  // -------------------------
      // Write your own code here.
  // -------------------------

//Page_OnInitializeView @1-D73082D9
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registration_npwpd_jabatan; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-00874D2C
function BindEvents()
{
    global $t_vat_registrationForm;
    global $CCSEvents;
    $t_vat_registrationForm->Button2->CCSEvents["OnClick"] = "t_vat_registrationForm_Button2_OnClick";
    $t_vat_registrationForm->Button4->CCSEvents["OnClick"] = "t_vat_registrationForm_Button4_OnClick";
    $t_vat_registrationForm->CCSEvents["BeforeSelect"] = "t_vat_registrationForm_BeforeSelect";
    $t_vat_registrationForm->CCSEvents["BeforeInsert"] = "t_vat_registrationForm_BeforeInsert";
    $t_vat_registrationForm->CCSEvents["BeforeShow"] = "t_vat_registrationForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_registrationForm_Button2_OnClick @901-6D694650
function t_vat_registrationForm_Button2_OnClick(& $sender)
{
    $t_vat_registrationForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_Button2_OnClick

//Custom Code @902-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_registrationForm_Button2_OnClick @901-30B4EE07
    return $t_vat_registrationForm_Button2_OnClick;
}
//End Close t_vat_registrationForm_Button2_OnClick

//t_vat_registrationForm_Button4_OnClick @908-EAAC2AFD
function t_vat_registrationForm_Button4_OnClick(& $sender)
{
    $t_vat_registrationForm_Button4_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_Button4_OnClick

//Custom Code @909-2A29BDB7
// -------------------------
    // Write your own code here.
	$CusId = CCGetFromGet("CURR_DOC_ID","");
	$dbConn = new clsDBConnSIKP();
	$sql = "select f_gen_npwpd(".$CusId.")as npwpd from dual";
	$dbConn->query($sql);
	while($dbConn->next_record()){
		$val = $dbConn->f("npwpd");
	}
	$t_vat_registrationForm->npwpd->SetValue($val);
	return;
// -------------------------
//End Custom Code

//Close t_vat_registrationForm_Button4_OnClick @908-D8012444
    return $t_vat_registrationForm_Button4_OnClick;
}
//End Close t_vat_registrationForm_Button4_OnClick

//t_vat_registrationForm_BeforeSelect @629-ECCFF8E4
function t_vat_registrationForm_BeforeSelect(& $sender)
{
    $t_vat_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_BeforeSelect

//Custom Code @686-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_registrationForm_BeforeSelect @629-D64E68A4
    return $t_vat_registrationForm_BeforeSelect;
}
//End Close t_vat_registrationForm_BeforeSelect

//t_vat_registrationForm_BeforeInsert @629-C938729D
function t_vat_registrationForm_BeforeInsert(& $sender)
{
    $t_vat_registrationForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_BeforeInsert

//Custom Code @687-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_registrationForm_BeforeInsert @629-23179109
    return $t_vat_registrationForm_BeforeInsert;
}
//End Close t_vat_registrationForm_BeforeInsert

//t_vat_registrationForm_BeforeShow @629-A2455680
function t_vat_registrationForm_BeforeShow(& $sender)
{
    $t_vat_registrationForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_BeforeShow

//Custom Code @874-2A29BDB7
// -------------------------
    // Write your own code here.
	$npwd = $t_vat_registrationForm->Hidden1->GetValue();
	$regLett = $t_vat_registrationForm->Hidden2->GetValue();

	if(($regLett == "") && ($npwd == "")){
		$t_vat_registrationForm->Button2->Visible = false;
		$t_vat_registrationForm->Button3->Visible = false;
		$t_vat_registrationForm->Button5->Visible = false;
		$t_vat_registrationForm->Button6->Visible = false;
		$t_vat_registrationForm->Button4->Visible = true;
		$t_vat_registrationForm->Button_Update->Visible = true;
	}else{
		$t_vat_registrationForm->Button2->Visible = true;
		$t_vat_registrationForm->Button3->Visible = true;
		$t_vat_registrationForm->Button5->Visible = true;
		$t_vat_registrationForm->Button4->Visible = false;
		$t_vat_registrationForm->Button6->Visible = true;
		$t_vat_registrationForm->Button_Update->Visible = false;
	}

	$id = $t_vat_registrationForm->p_rqst_type_id->GetValue();
	if($id == 1){
  		$t_vat_registrationForm->Label1->setValue("Kelas Hotel");
  		$t_vat_registrationForm->p_hotel_grade_id->Visible = true;
  		$t_vat_registrationForm->p_rest_service_type_id->Visible = false;
  		$t_vat_registrationForm->p_entertaintment_type_id->Visible = false;
  		$t_vat_registrationForm->p_parking_classification_id->Visible = false;
  	}else if($id == 2){
  		$t_vat_registrationForm->Label1->setValue("Jenis Pelayanan");
  		$t_vat_registrationForm->p_hotel_grade_id->Visible = false;
  		$t_vat_registrationForm->p_rest_service_type_id->Visible = true;
  		$t_vat_registrationForm->p_entertaintment_type_id->Visible = false;
  		$t_vat_registrationForm->p_parking_classification_id->Visible = false;
  	}else if($id == 3){
  		$t_vat_registrationForm->Label1->setValue("Jenis Hiburan");
  		$t_vat_registrationForm->p_hotel_grade_id->Visible = false;
  		$t_vat_registrationForm->p_rest_service_type_id->Visible = false;
  		$t_vat_registrationForm->p_entertaintment_type_id->Visible = true;
  		$t_vat_registrationForm->p_parking_classification_id->Visible = false;
  	}else if($id == 4){
  		$t_vat_registrationForm->Label1->setValue("Klasifikasi Temapat Parkir");
  		$t_vat_registrationForm->p_hotel_grade_id->Visible = false;
  		$t_vat_registrationForm->p_rest_service_type_id->Visible = false;
  		$t_vat_registrationForm->p_entertaintment_type_id->Visible = false;
  		$t_vat_registrationForm->p_parking_classification_id->Visible = true;
  	}else{
  		$t_vat_registrationForm->Label1->setValue("");
  		$t_vat_registrationForm->p_hotel_grade_id->Visible = false;
  		$t_vat_registrationForm->p_rest_service_type_id->Visible = false;
  		$t_vat_registrationForm->p_entertaintment_type_id->Visible = false;
  		$t_vat_registrationForm->p_parking_classification_id->Visible = false;
  	}
	$t_vat_registrationForm->Label3->SetValue("Verifikasi Berhasil");
// -------------------------
//End Custom Code

//Close t_vat_registrationForm_BeforeShow @629-82B670AF
    return $t_vat_registrationForm_BeforeShow;
}
//End Close t_vat_registrationForm_BeforeShow

//Page_OnInitializeView @1-4A5AFED0
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_order_ro_kasi; //Compatibility
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

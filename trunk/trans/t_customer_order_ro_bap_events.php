<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-51BB903E
function BindEvents()
{
    global $t_vat_registrationForm;
    global $CCSEvents;
    $t_vat_registrationForm->Button2->CCSEvents["OnClick"] = "t_vat_registrationForm_Button2_OnClick";
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
	/*
	if($t_vat_registrationForm->Hidden1->GetValue() == ""){
		$t_vat_registrationForm->Button2->Visible = false;
		$t_vat_registrationForm->Button_Update->Visible = true;
		$t_vat_registrationForm->Button3->Visible = true;
	}else{
		$t_vat_registrationForm->Button2->Visible = true;
		$t_vat_registrationForm->Button_Update->Visible = false;
		$t_vat_registrationForm->Button3->Visible = false;
	}
	*/
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

//Page_OnInitializeView @1-A17701D5
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_order_ro_bap; //Compatibility
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

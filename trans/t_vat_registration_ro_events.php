<?php
//BindEvents Method @1-3378C58B
function BindEvents()
{
    global $t_vat_registrationForm;
    $t_vat_registrationForm->CCSEvents["BeforeSelect"] = "t_vat_registrationForm_BeforeSelect";
    $t_vat_registrationForm->CCSEvents["BeforeInsert"] = "t_vat_registrationForm_BeforeInsert";
}
//End BindEvents Method

//t_vat_registrationForm_BeforeSelect @94-ECCFF8E4
function t_vat_registrationForm_BeforeSelect(& $sender)
{
    $t_vat_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_BeforeSelect

  // -------------------------
      // Write your own code here.
  	//kalau update hilangkan kode verifikasi
  	$vatId = $t_vat_registrationForm->t_vat_registration_id->GetValue();
  	if (empty($vatId)){
  		$t_vat_registrationForm->validation_code->Visible = true;
  		$t_vat_registrationForm->Label3->SetValue("");
  	}else{
  		$t_vat_registrationForm->validation_code->Visible = false;
  		$t_vat_registrationForm->Label3->SetValue("Verifikasi Berhasil");
  	}
  
  	$msg = CCGetFromGet("msg");
  	if ($msg == "berhasil"){
  		$t_vat_registrationForm->validation_code->Visible = false;
  		$t_vat_registrationForm->Label3->SetValue("Verifikasi Berhasil");
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
  // -------------------------


//Close t_vat_registrationForm_BeforeSelect @94-D64E68A4
    return $t_vat_registrationForm_BeforeSelect;
}
//End Close t_vat_registrationForm_BeforeSelect

//t_vat_registrationForm_BeforeInsert @94-C938729D
function t_vat_registrationForm_BeforeInsert(& $sender)
{
    $t_vat_registrationForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_BeforeInsert

//Close t_vat_registrationForm_BeforeInsert @94-23179109
    return $t_vat_registrationForm_BeforeInsert;
}
//End Close t_vat_registrationForm_BeforeInsert


?>

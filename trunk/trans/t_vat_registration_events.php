<?php
//BindEvents Method @1-F5D25BAD
function BindEvents()
{
    global $t_vat_registrationForm;
    $t_vat_registrationForm->Button1->CCSEvents["OnClick"] = "t_vat_registrationForm_Button1_OnClick";
    $t_vat_registrationForm->CCSEvents["BeforeSelect"] = "t_vat_registrationForm_BeforeSelect";
    $t_vat_registrationForm->CCSEvents["BeforeInsert"] = "t_vat_registrationForm_BeforeInsert";
}
//End BindEvents Method

//t_vat_registrationForm_Button1_OnClick @851-C3337326
function t_vat_registrationForm_Button1_OnClick(& $sender)
{
    $t_vat_registrationForm_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_Button1_OnClick

  // -------------------------
      // Write your own code here.
  	$dbConn1 = new clsDBConnSIKP();
  	$order = $t_vat_registrationForm->order_no->GetValue();
  	$mobile = $t_vat_registrationForm->mobile_no_owner->GetValue();
  	$cari = "select t_customer_order_id from t_customer_order where order_no = '".$order."'";
  	$dbConn1->query($cari);
  	while($dbConn1->next_record()){
  		$kode = $dbConn1->f("t_customer_order_id");
  	}
  	
  	$sql_url = "select f_send_sms('".$mobile."','Kode Verifikasi Anda : ".$kode."')from dual";
  	$dbConn1->query($sql_url);
  	/*
  	$sql_url = "select value from p_global_param where code = 'SMSG_URL'";
  	$dbConn1->query($sql_url);
  	while($dbConn1->next_record()){
  		$val = $dbConn1->f("value");
  	}
  		
  	$ch = curl_init();
  	$url = $val."recipient=".$mobile."&messagetype=SMS:TEXT&messagedata=Kode+Verifikasi+Anda:+".$kode."";	
  
  	curl_setopt($ch, CURLOPT_URL,$url);
  	curl_setopt($ch, CURLOPT_POST, 1);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('body' => json_encode($postdata))));
  
  
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  	$server_output = curl_exec ($ch);
  
  	curl_close ($ch);
  	*/
  
  	$sql = "INSERT INTO verifikasi(id_verifikasi,order_no,code) VALUES "
  		  ."(generate_id('sikp','verifikasi','id_verifikasi'),'".$order."','".$kode."')";
  	$dbConn1->query($sql);	
  	$dbConn1->close;
  
  	$t_vat_registrationForm->pesan->SetValue("Data Telah Terkirim");
  	return;
  // -------------------------


//Close t_vat_registrationForm_Button1_OnClick @851-A9568806
    return $t_vat_registrationForm_Button1_OnClick;
}
//End Close t_vat_registrationForm_Button1_OnClick

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

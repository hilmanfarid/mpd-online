<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-56E163DA
function BindEvents()
{
    global $t_vat_registrationForm;
    global $CCSEvents;
    $t_vat_registrationForm->Button2->CCSEvents["OnClick"] = "t_vat_registrationForm_Button2_OnClick";
    $t_vat_registrationForm->Button7->CCSEvents["OnClick"] = "t_vat_registrationForm_Button7_OnClick";
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

//Close t_vat_registrationForm_Button2_OnClick @901-30B4EE07
    return $t_vat_registrationForm_Button2_OnClick;
}
//End Close t_vat_registrationForm_Button2_OnClick

//t_vat_registrationForm_Button7_OnClick @961-44F61F8B
function t_vat_registrationForm_Button7_OnClick(& $sender)
{
    $t_vat_registrationForm_Button7_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_Button7_OnClick
	$sql = "select f_update_acc_status(".$t_vat_registrationForm->t_cust_account_id->Value.",3,'TUTUP SEMENTARA POSISI PIUTANG',sysdate, '".CCGetUserLogin()."')";
	$dbConn = new clsDBConnSIKP();
	if($dbConn->query($sql)){
		$dbConn->next_record();
		if($dbConn->Record['o_result_msg'] != 'OK'){
			$t_vat_registrationForm->Errors->addError($dbConn->Record['o_result_msg']);
		}
	}else{
		$t_vat_registrationForm->Errors->addError('Gagal update status');
	}
//Close t_vat_registrationForm_Button7_OnClick @961-41E34245
    return $t_vat_registrationForm_Button7_OnClick;
}
//End Close t_vat_registrationForm_Button7_OnClick

//t_vat_registrationForm_BeforeSelect @629-ECCFF8E4
function t_vat_registrationForm_BeforeSelect(& $sender)
{
    $t_vat_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_registrationForm; //Compatibility
//End t_vat_registrationForm_BeforeSelect

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

//Close t_vat_registrationForm_BeforeShow @629-82B670AF
    return $t_vat_registrationForm_BeforeShow;
}
//End Close t_vat_registrationForm_BeforeShow

//Page_OnInitializeView @1-77BEFB12
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penutupan_wp_ver_piutang; //Compatibility
//End Page_OnInitializeView

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

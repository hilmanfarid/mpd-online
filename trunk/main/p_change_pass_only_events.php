<?php

//BindEvents Method @1-3519CBF2
function BindEvents()
{
    global $p_pass_byadminForm;
    global $CCSEvents;
    $p_pass_byadminForm->Button_Ubah->CCSEvents["OnClick"] = "p_pass_byadminForm_Button_Ubah_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_pass_byadminForm_Button_Ubah_OnClick @26-5F167668
function p_pass_byadminForm_Button_Ubah_OnClick(& $sender)
{
    $p_pass_byadminForm_Button_Ubah_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_pass_byadminForm; //Compatibility
//End p_pass_byadminForm_Button_Ubah_OnClick

//Custom Code @104-2A29BDB7
// -------------------------
    // Write your own code here.
	global $FileName;
	global $PathToCurrentPage;
	$param = CCGetQueryString("QueryString", "");
		
	$dbConn = new clsDBConnSIKP();
	$old_pwd = $p_pass_byadminForm->o_user_pwd->GetValue();
	$new_pwd1 = $p_pass_byadminForm->n_user_pwd1->GetValue();
	$new_pwd2 = $p_pass_byadminForm->n_user_pwd2->GetValue();
	$idUser = $p_pass_byadminForm->p_app_user_id->GetValue();
	$sql = "select * from f_change_pass(".$idUser.",'".$old_pwd."','".$new_pwd1."','".$new_pwd2."')";
	$dbConn->query($sql);
	$dbConn->next_record();
	$mess = $dbConn->f("f_change_pass");
	$dbConn->close();

	echo '<script language="javascript">';
	echo 'alert("'.$mess.'");';
	echo '</script>';

	$p_pass_byadminForm->o_user_pwd->SetValue("");
	$p_pass_byadminForm->n_user_pwd1->SetValue("");
	$p_pass_byadminForm->n_user_pwd2->SetValue("");
	return;
// -------------------------
//End Custom Code

//Close p_pass_byadminForm_Button_Ubah_OnClick @26-C74BD412
    return $p_pass_byadminForm_Button_Ubah_OnClick;
}
//End Close p_pass_byadminForm_Button_Ubah_OnClick

//Page_OnInitializeView @1-1C894BF2
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_change_pass_only; //Compatibility
//End Page_OnInitializeView

//Custom Code @100-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView
?>
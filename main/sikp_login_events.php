<?php
//BindEvents Method @1-81DF6FB1
function BindEvents()
{
    global $Login;
    $Login->Button_DoLogin->CCSEvents["OnClick"] = "Login_Button_DoLogin_OnClick";
    $Login->Button_DoLogin1->CCSEvents["OnClick"] = "Login_Button_DoLogin1_OnClick";
}
//End BindEvents Method

//Login_Button_DoLogin_OnClick @3-1454CF55
function Login_Button_DoLogin_OnClick(& $sender)
{
    $Login_Button_DoLogin_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Login; //Compatibility
//End Login_Button_DoLogin_OnClick

//Login @4-DE10C29C
    global $CCSLocales;
    global $Redirect;
    if ( !CCLoginUser( $Container->login->Value, md5($Container->password->Value))) {
        $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
        $Container->Errors->addError(md5($Container->password->Value));
        $Container->password->SetValue("");
        $Login_Button_DoLogin_OnClick = 0;
    } else {
        global $Redirect;
        $Redirect = CCGetParam("ret_link", $Redirect);
        $Login_Button_DoLogin_OnClick = 1;
    }
//End Login

//Close Login_Button_DoLogin_OnClick @3-0EB5DCFE
    return $Login_Button_DoLogin_OnClick;
}
//End Close Login_Button_DoLogin_OnClick

//Login_Button_DoLogin1_OnClick @8-AA26E903
function Login_Button_DoLogin1_OnClick(& $sender)
{
    $Login_Button_DoLogin1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Login; //Compatibility
//End Login_Button_DoLogin1_OnClick

//Login @9-DE10C29C
    global $CCSLocales;
    global $Redirect;
    if ( !CCLoginUser( $Container->login->Value, md5($Container->password->Value))) {
        $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
        $Container->Errors->addError(md5($Container->password->Value));
        $Container->password->SetValue("");
        $Login_Button_DoLogin_OnClick = 0;
    } else {
        global $Redirect;
        $Redirect = CCGetParam("ret_link", $Redirect);
        $Login_Button_DoLogin_OnClick = 1;
    }
//End Login

//Close Login_Button_DoLogin1_OnClick @8-58EB7BC1
    return $Login_Button_DoLogin1_OnClick;
}
//End Close Login_Button_DoLogin1_OnClick


?>

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
// -------------------------
//End Custom Code

//Close t_vat_registrationForm_BeforeShow @629-82B670AF
    return $t_vat_registrationForm_BeforeShow;
}
//End Close t_vat_registrationForm_BeforeShow

//Page_OnInitializeView @1-A331F224
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penutupan_wp_ver_print; //Compatibility
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

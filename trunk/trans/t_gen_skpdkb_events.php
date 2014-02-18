<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-87633E62
function BindEvents()
{
    global $t_gen_skpdkbForm;
    global $CCSEvents;
    $t_gen_skpdkbForm->Button2->CCSEvents["OnClick"] = "t_gen_skpdkbForm_Button2_OnClick";
    $t_gen_skpdkbForm->Button3->CCSEvents["OnClick"] = "t_gen_skpdkbForm_Button3_OnClick";
    $t_gen_skpdkbForm->Button4->CCSEvents["OnClick"] = "t_gen_skpdkbForm_Button4_OnClick";
    $t_gen_skpdkbForm->CCSEvents["BeforeInsert"] = "t_gen_skpdkbForm_BeforeInsert";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_gen_skpdkbForm_Button2_OnClick @901-9851B541
function t_gen_skpdkbForm_Button2_OnClick(& $sender)
{
    $t_gen_skpdkbForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_gen_skpdkbForm; //Compatibility
//End t_gen_skpdkbForm_Button2_OnClick

//Custom Code @902-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_gen_skpdkbForm_Button2_OnClick @901-84085F4C
    return $t_gen_skpdkbForm_Button2_OnClick;
}
//End Close t_gen_skpdkbForm_Button2_OnClick

//t_gen_skpdkbForm_Button3_OnClick @913-7A9DE849
function t_gen_skpdkbForm_Button3_OnClick(& $sender)
{
    $t_gen_skpdkbForm_Button3_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_gen_skpdkbForm; //Compatibility
//End t_gen_skpdkbForm_Button3_OnClick

//Custom Code @914-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_gen_skpdkbForm_Button3_OnClick @913-4586808C
    return $t_gen_skpdkbForm_Button3_OnClick;
}
//End Close t_gen_skpdkbForm_Button3_OnClick

//t_gen_skpdkbForm_Button4_OnClick @915-BB6B71B2
function t_gen_skpdkbForm_Button4_OnClick(& $sender)
{
    $t_gen_skpdkbForm_Button4_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_gen_skpdkbForm; //Compatibility
//End t_gen_skpdkbForm_Button4_OnClick

//Custom Code @916-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_gen_skpdkbForm_Button4_OnClick @915-6CBD950F
    return $t_gen_skpdkbForm_Button4_OnClick;
}
//End Close t_gen_skpdkbForm_Button4_OnClick

//t_gen_skpdkbForm_BeforeInsert @629-961ADB07
function t_gen_skpdkbForm_BeforeInsert(& $sender)
{
    $t_gen_skpdkbForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_gen_skpdkbForm; //Compatibility
//End t_gen_skpdkbForm_BeforeInsert

//Custom Code @687-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_gen_skpdkbForm_BeforeInsert @629-BEDBC7B0
    return $t_gen_skpdkbForm_BeforeInsert;
}
//End Close t_gen_skpdkbForm_BeforeInsert

//Page_OnInitializeView @1-B393CE91
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_gen_skpdkb; //Compatibility
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

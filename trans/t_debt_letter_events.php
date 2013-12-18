<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-D6D8B2BA
function BindEvents()
{
    global $t_debt_letterForm;
    global $CCSEvents;
    $t_debt_letterForm->Button2->CCSEvents["OnClick"] = "t_debt_letterForm_Button2_OnClick";
    $t_debt_letterForm->Button3->CCSEvents["OnClick"] = "t_debt_letterForm_Button3_OnClick";
    $t_debt_letterForm->Button4->CCSEvents["OnClick"] = "t_debt_letterForm_Button4_OnClick";
    $t_debt_letterForm->CCSEvents["BeforeInsert"] = "t_debt_letterForm_BeforeInsert";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_debt_letterForm_Button2_OnClick @901-0D2781FB
function t_debt_letterForm_Button2_OnClick(& $sender)
{
    $t_debt_letterForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letterForm; //Compatibility
//End t_debt_letterForm_Button2_OnClick

//Custom Code @902-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_debt_letterForm_Button2_OnClick @901-89FC3954
    return $t_debt_letterForm_Button2_OnClick;
}
//End Close t_debt_letterForm_Button2_OnClick

//t_debt_letterForm_Button3_OnClick @913-4C828A4B
function t_debt_letterForm_Button3_OnClick(& $sender)
{
    $t_debt_letterForm_Button3_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letterForm; //Compatibility
//End t_debt_letterForm_Button3_OnClick

//Custom Code @914-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_debt_letterForm_Button3_OnClick @913-4872E694
    return $t_debt_letterForm_Button3_OnClick;
}
//End Close t_debt_letterForm_Button3_OnClick

//t_debt_letterForm_Button4_OnClick @915-5388BE1A
function t_debt_letterForm_Button4_OnClick(& $sender)
{
    $t_debt_letterForm_Button4_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letterForm; //Compatibility
//End t_debt_letterForm_Button4_OnClick

//Custom Code @916-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_debt_letterForm_Button4_OnClick @915-6149F317
    return $t_debt_letterForm_Button4_OnClick;
}
//End Close t_debt_letterForm_Button4_OnClick

//t_debt_letterForm_BeforeInsert @629-F36A124F
function t_debt_letterForm_BeforeInsert(& $sender)
{
    $t_debt_letterForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letterForm; //Compatibility
//End t_debt_letterForm_BeforeInsert

//Custom Code @687-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_debt_letterForm_BeforeInsert @629-C9BCD777
    return $t_debt_letterForm_BeforeInsert;
}
//End Close t_debt_letterForm_BeforeInsert

//Page_OnInitializeView @1-6BD4F425
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letter; //Compatibility
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

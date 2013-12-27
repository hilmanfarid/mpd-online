<?php
//BindEvents Method @1-A6F5B247
function BindEvents()
{
    global $t_bphtb_registrationForm;
    $t_bphtb_registrationForm->Button2->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button2_OnClick";
    $t_bphtb_registrationForm->Button3->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button3_OnClick";
    $t_bphtb_registrationForm->CCSEvents["BeforeSelect"] = "t_bphtb_registrationForm_BeforeSelect";
    $t_bphtb_registrationForm->CCSEvents["BeforeInsert"] = "t_bphtb_registrationForm_BeforeInsert";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteDelete"] = "t_bphtb_registrationForm_ds_AfterExecuteDelete";
}
//End BindEvents Method

//t_bphtb_registrationForm_Button2_OnClick @71-41066659
function t_bphtb_registrationForm_Button2_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button2_OnClick

//Custom Code @72-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button2_OnClick @71-DE281A2F
    return $t_bphtb_registrationForm_Button2_OnClick;
}
//End Close t_bphtb_registrationForm_Button2_OnClick

//t_bphtb_registrationForm_Button3_OnClick @73-6F1B2C91
function t_bphtb_registrationForm_Button3_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button3_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button3_OnClick

//Custom Code @74-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button3_OnClick @73-1FA6C5EF
    return $t_bphtb_registrationForm_Button3_OnClick;
}
//End Close t_bphtb_registrationForm_Button3_OnClick

//t_bphtb_registrationForm_BeforeSelect @2-50B4A263
function t_bphtb_registrationForm_BeforeSelect(& $sender)
{
    $t_bphtb_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeSelect

//Custom Code @77-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeSelect @2-EE18DB4A
    return $t_bphtb_registrationForm_BeforeSelect;
}
//End Close t_bphtb_registrationForm_BeforeSelect

//t_bphtb_registrationForm_BeforeInsert @2-DD9A285F
function t_bphtb_registrationForm_BeforeInsert(& $sender)
{
    $t_bphtb_registrationForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeInsert

//Custom Code @78-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeInsert @2-1B4122E7
    return $t_bphtb_registrationForm_BeforeInsert;
}
//End Close t_bphtb_registrationForm_BeforeInsert

//t_bphtb_registrationForm_ds_AfterExecuteDelete @2-5B1BB40B
function t_bphtb_registrationForm_ds_AfterExecuteDelete(& $sender)
{
    $t_bphtb_registrationForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_AfterExecuteDelete

//Custom Code @79-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_AfterExecuteDelete @2-1AE8B690
    return $t_bphtb_registrationForm_ds_AfterExecuteDelete;
}
//End Close t_bphtb_registrationForm_ds_AfterExecuteDelete
?>

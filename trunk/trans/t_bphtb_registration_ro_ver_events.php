s<?php
//BindEvents Method @1-ECC4C064
function BindEvents()
{
    global $t_bphtb_registrationForm;
    $t_bphtb_registrationForm->Button2->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button2_OnClick";
    $t_bphtb_registrationForm->Button3->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button3_OnClick";
    $t_bphtb_registrationForm->CCSEvents["BeforeSelect"] = "t_bphtb_registrationForm_BeforeSelect";
    $t_bphtb_registrationForm->CCSEvents["BeforeInsert"] = "t_bphtb_registrationForm_BeforeInsert";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteDelete"] = "t_bphtb_registrationForm_ds_AfterExecuteDelete";
    $t_bphtb_registrationForm->CCSEvents["BeforeShow"] = "t_bphtb_registrationForm_BeforeShow";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteSelect"] = "t_bphtb_registrationForm_ds_AfterExecuteSelect";
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

//t_bphtb_registrationForm_BeforeShow @2-8B0D3CFC
function t_bphtb_registrationForm_BeforeShow(& $sender)
{
    $t_bphtb_registrationForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeShow

//Custom Code @140-2A29BDB7
// -------------------------
	$pemeriksa = $t_bphtb_registrationForm->verificated_by->GetValue();
    if( empty($pemeriksa) ) {
		$t_bphtb_registrationForm->verificated_by->SetValue( CCGetUserLogin() );
	}
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeShow @2-4D732B32
    return $t_bphtb_registrationForm_BeforeShow;
}
//End Close t_bphtb_registrationForm_BeforeShow

//t_bphtb_registrationForm_ds_AfterExecuteSelect @2-624E9AA7
function t_bphtb_registrationForm_ds_AfterExecuteSelect(& $sender)
{
    $t_bphtb_registrationForm_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_AfterExecuteSelect

//Custom Code @141-2A29BDB7
// -------------------------
	
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_AfterExecuteSelect @2-BCBC28C3
    return $t_bphtb_registrationForm_ds_AfterExecuteSelect;
}
//End Close t_bphtb_registrationForm_ds_AfterExecuteSelect
?>

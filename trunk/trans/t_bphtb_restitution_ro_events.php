<?php
//BindEvents Method @1-5DA8036F
function BindEvents()
{
    global $t_bphtb_registrationForm;
    global $t_bphtb_registrationForm1;
    global $CCSEvents;
    $t_bphtb_registrationForm->CCSEvents["BeforeSelect"] = "t_bphtb_registrationForm_BeforeSelect";
    $t_bphtb_registrationForm->CCSEvents["BeforeInsert"] = "t_bphtb_registrationForm_BeforeInsert";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteDelete"] = "t_bphtb_registrationForm_ds_AfterExecuteDelete";
    $t_bphtb_registrationForm->CCSEvents["AfterUpdate"] = "t_bphtb_registrationForm_AfterUpdate";
    $t_bphtb_registrationForm1->CCSEvents["BeforeSelect"] = "t_bphtb_registrationForm1_BeforeSelect";
    $t_bphtb_registrationForm1->CCSEvents["BeforeInsert"] = "t_bphtb_registrationForm1_BeforeInsert";
    $t_bphtb_registrationForm1->ds->CCSEvents["AfterExecuteDelete"] = "t_bphtb_registrationForm1_ds_AfterExecuteDelete";
    $t_bphtb_registrationForm1->CCSEvents["AfterUpdate"] = "t_bphtb_registrationForm1_AfterUpdate";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_bphtb_registrationForm_BeforeSelect @94-50B4A263
function t_bphtb_registrationForm_BeforeSelect(& $sender)
{
    $t_bphtb_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeSelect

//Custom Code @842-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeSelect @94-EE18DB4A
    return $t_bphtb_registrationForm_BeforeSelect;
}
//End Close t_bphtb_registrationForm_BeforeSelect

//t_bphtb_registrationForm_BeforeInsert @94-DD9A285F
function t_bphtb_registrationForm_BeforeInsert(& $sender)
{
    $t_bphtb_registrationForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeInsert

//Custom Code @853-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeInsert @94-1B4122E7
    return $t_bphtb_registrationForm_BeforeInsert;
}
//End Close t_bphtb_registrationForm_BeforeInsert

//t_bphtb_registrationForm_ds_AfterExecuteDelete @94-5B1BB40B
function t_bphtb_registrationForm_ds_AfterExecuteDelete(& $sender)
{
    $t_bphtb_registrationForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_AfterExecuteDelete

//Custom Code @954-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_AfterExecuteDelete @94-1AE8B690
    return $t_bphtb_registrationForm_ds_AfterExecuteDelete;
}
//End Close t_bphtb_registrationForm_ds_AfterExecuteDelete

//t_bphtb_registrationForm_AfterUpdate @94-437D2A61
function t_bphtb_registrationForm_AfterUpdate(& $sender)
{
    $t_bphtb_registrationForm_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_AfterUpdate

//Custom Code @1004-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_AfterUpdate @94-7E1ED9EB
    return $t_bphtb_registrationForm_AfterUpdate;
}
//End Close t_bphtb_registrationForm_AfterUpdate

//t_bphtb_registrationForm1_BeforeSelect @1016-43FC6256
function t_bphtb_registrationForm1_BeforeSelect(& $sender)
{
    $t_bphtb_registrationForm1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm1; //Compatibility
//End t_bphtb_registrationForm1_BeforeSelect

//Custom Code @1076-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm1_BeforeSelect @1016-D0511C6D
    return $t_bphtb_registrationForm1_BeforeSelect;
}
//End Close t_bphtb_registrationForm1_BeforeSelect

//t_bphtb_registrationForm1_BeforeInsert @1016-9C753A59
function t_bphtb_registrationForm1_BeforeInsert(& $sender)
{
    $t_bphtb_registrationForm1_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm1; //Compatibility
//End t_bphtb_registrationForm1_BeforeInsert

//Custom Code @1077-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm1_BeforeInsert @1016-2508E5C0
    return $t_bphtb_registrationForm1_BeforeInsert;
}
//End Close t_bphtb_registrationForm1_BeforeInsert

//t_bphtb_registrationForm1_ds_AfterExecuteDelete @1016-EE6EDA98
function t_bphtb_registrationForm1_ds_AfterExecuteDelete(& $sender)
{
    $t_bphtb_registrationForm1_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm1; //Compatibility
//End t_bphtb_registrationForm1_ds_AfterExecuteDelete

//Custom Code @1078-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm1_ds_AfterExecuteDelete @1016-63F841A3
    return $t_bphtb_registrationForm1_ds_AfterExecuteDelete;
}
//End Close t_bphtb_registrationForm1_ds_AfterExecuteDelete

//t_bphtb_registrationForm1_AfterUpdate @1016-E49A9452
function t_bphtb_registrationForm1_AfterUpdate(& $sender)
{
    $t_bphtb_registrationForm1_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm1; //Compatibility
//End t_bphtb_registrationForm1_AfterUpdate

//Custom Code @1080-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm1_AfterUpdate @1016-59AE250C
    return $t_bphtb_registrationForm1_AfterUpdate;
}
//End Close t_bphtb_registrationForm1_AfterUpdate

//Page_BeforeShow @1-80A4CC4A
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_restitution_ro; //Compatibility
//End Page_BeforeShow

//Custom Code @1003-2A29BDB7
// -------------------------
    // Write your own code here.
	global $t_bphtb_registrationForm;
	$del_button = CCGetFromGet('allow_delete');
	if($del_button=='F'){
		$t_bphtb_registrationForm->DeleteAllowed = false;
		$t_bphtb_registrationForm->Button3->Visible =true;
	}else{
		//$t_bphtb_registrationForm->Button3->Visible =false;
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>

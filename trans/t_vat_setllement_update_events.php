<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-28A436B5
function BindEvents()
{
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_setllementForm_ds_AfterExecuteUpdate";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementForm_ds_AfterExecuteUpdate @23-CA3D51DA
function t_vat_setllementForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_setllementForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_ds_AfterExecuteUpdate

//Custom Code @344-2A29BDB7
// -------------------------
    // Write your own code here.
	$id_vat = $t_vat_setllementForm->t_vat_setllement_id->GetValue();
		$redirectloader = "t_vat_setllement_edit_ro.php?t_vat_setllement_id=".$id_vat."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>"); 
		exit;
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_ds_AfterExecuteUpdate @23-21827B74
    return $t_vat_setllementForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_setllementForm_ds_AfterExecuteUpdate

//Page_OnInitializeView @1-5919F3AD
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_update; //Compatibility
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

//Page_BeforeShow @1-7E836056
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_update; //Compatibility
//End Page_BeforeShow

//Custom Code @260-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>

<?php
//BindEvents Method @1-4E79BD85
function BindEvents()
{
    global $formPerubahanAyat;
    $formPerubahanAyat->CCSEvents["BeforeShow"] = "formPerubahanAyat_BeforeShow";
    $formPerubahanAyat->CCSEvents["AfterInsert"] = "formPerubahanAyat_AfterInsert";
    $formPerubahanAyat->CCSEvents["AfterUpdate"] = "formPerubahanAyat_AfterUpdate";
}
//End BindEvents Method

//formPerubahanAyat_BeforeShow @3-FBC1B94E
function formPerubahanAyat_BeforeShow(& $sender)
{
    $formPerubahanAyat_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanAyat; //Compatibility
//End formPerubahanAyat_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close formPerubahanAyat_BeforeShow @3-66FB22B2
    return $formPerubahanAyat_BeforeShow;
}
//End Close formPerubahanAyat_BeforeShow

//formPerubahanAyat_AfterInsert @3-2FE2A060
function formPerubahanAyat_AfterInsert(& $sender)
{
    $formPerubahanAyat_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanAyat; //Compatibility
//End formPerubahanAyat_AfterInsert

//Custom Code @22-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close formPerubahanAyat_AfterInsert @3-5CA4134D
    return $formPerubahanAyat_AfterInsert;
}
//End Close formPerubahanAyat_AfterInsert

//formPerubahanAyat_AfterUpdate @3-5F694DBD
function formPerubahanAyat_AfterUpdate(& $sender)
{
    $formPerubahanAyat_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanAyat; //Compatibility
//End formPerubahanAyat_AfterUpdate

//Custom Code @27-2A29BDB7
// -------------------------
    if($row = pg_fetch_array($formPerubahanAyat->DataSource->itemResult)) {
	
	}
	
    echo "<script> 
		alert('".$row['msg']."');
		window.opener.location.reload();
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close formPerubahanAyat_AfterUpdate @3-938DD2C2
    return $formPerubahanAyat_AfterUpdate;
}
//End Close formPerubahanAyat_AfterUpdate
?>

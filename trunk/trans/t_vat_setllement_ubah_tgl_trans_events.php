<?php
//BindEvents Method @1-0A614B1E
function BindEvents()
{
    global $formPerubahanTglTrans;
    $formPerubahanTglTrans->CCSEvents["BeforeShow"] = "formPerubahanTglTrans_BeforeShow";
    $formPerubahanTglTrans->CCSEvents["AfterInsert"] = "formPerubahanTglTrans_AfterInsert";
    $formPerubahanTglTrans->CCSEvents["AfterUpdate"] = "formPerubahanTglTrans_AfterUpdate";
}
//End BindEvents Method

//formPerubahanTglTrans_BeforeShow @3-B5C69F25
function formPerubahanTglTrans_BeforeShow(& $sender)
{
    $formPerubahanTglTrans_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanTglTrans; //Compatibility
//End formPerubahanTglTrans_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close formPerubahanTglTrans_BeforeShow @3-17BA78FB
    return $formPerubahanTglTrans_BeforeShow;
}
//End Close formPerubahanTglTrans_BeforeShow

//formPerubahanTglTrans_AfterInsert @3-3C332754
function formPerubahanTglTrans_AfterInsert(& $sender)
{
    $formPerubahanTglTrans_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanTglTrans; //Compatibility
//End formPerubahanTglTrans_AfterInsert

//Custom Code @22-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close formPerubahanTglTrans_AfterInsert @3-53D5AB23
    return $formPerubahanTglTrans_AfterInsert;
}
//End Close formPerubahanTglTrans_AfterInsert

//formPerubahanTglTrans_AfterUpdate @3-43E6B0C2
function formPerubahanTglTrans_AfterUpdate(& $sender)
{
    $formPerubahanTglTrans_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanTglTrans; //Compatibility
//End formPerubahanTglTrans_AfterUpdate

//Custom Code @27-2A29BDB7
// -------------------------
    if($row = pg_fetch_array($formPerubahanTglTrans->DataSource->itemResult)) {
	
	}
	
    echo "<script> 
		alert('".$row['msg']."');
		window.opener.location.reload();
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close formPerubahanTglTrans_AfterUpdate @3-9CFC6AAC
    return $formPerubahanTglTrans_AfterUpdate;
}
//End Close formPerubahanTglTrans_AfterUpdate


?>

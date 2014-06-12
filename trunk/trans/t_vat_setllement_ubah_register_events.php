<?php
//BindEvents Method @1-944FCDA3
function BindEvents()
{
    global $LOV;
    $LOV->CCSEvents["BeforeShow"] = "LOV_BeforeShow";
    $LOV->CCSEvents["AfterInsert"] = "LOV_AfterInsert";
}
//End BindEvents Method

//LOV_BeforeShow @3-EE802C40
function LOV_BeforeShow(& $sender)
{
    $LOV_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV; //Compatibility
//End LOV_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_BeforeShow @3-91C2A156
    return $LOV_BeforeShow;
}
//End Close LOV_BeforeShow

//LOV_AfterInsert @3-6AD01061
function LOV_AfterInsert(& $sender)
{
    $LOV_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV; //Compatibility
//End LOV_AfterInsert

//Custom Code @22-2A29BDB7
// -------------------------
    if($row = pg_fetch_array($LOV->DataSource->itemResult)) {
	
	}
	
    echo "<script> 
		alert('".$row['msg']."');
		window.opener.location.reload();
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close LOV_AfterInsert @3-FB340CAF
    return $LOV_AfterInsert;
}
//End Close LOV_AfterInsert


?>

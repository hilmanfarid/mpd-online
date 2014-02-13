<?php
//BindEvents Method @1-EE4B851D
function BindEvents()
{
    global $LOV;
    $LOV->CCSEvents["BeforeShow"] = "LOV_BeforeShow";
    $LOV->CCSEvents["AfterInsert"] = "LOV_AfterInsert";
    $LOV->ds->CCSEvents["AfterExecuteInsert"] = "LOV_ds_AfterExecuteInsert";
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
	$i_vat_setllement = CCGetFromGet('i_vat_setllement');
	$ubah = CCGetFromGet('ubah');
	$in_flag_numeric = CCGetFromGet('in_flag_numeric');
	$is_desc = CCGetFromGet('is_desc');
	if($ubah=='T'){
		$user				= CCGetUserLogin();
		$data				= array();
		$dbConn				= new clsDBConnSIKP();
		$query				= "select f_update_increasing_amt($i_vat_setllement,$in_flag_numeric,'$is_desc','$user') as msg";
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			echo "<script> 
			alert('".$dbConn->f('msg')."');
			window.close();
		</script>";
		exit;
		}
		
	}
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
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_AfterInsert @3-FB340CAF
    return $LOV_AfterInsert;
}
//End Close LOV_AfterInsert

//LOV_ds_AfterExecuteInsert @3-5363249A
function LOV_ds_AfterExecuteInsert(& $sender)
{
    $LOV_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV; //Compatibility
//End LOV_ds_AfterExecuteInsert

//Custom Code @25-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_ds_AfterExecuteInsert @3-56621A91
    return $LOV_ds_AfterExecuteInsert;
}
//End Close LOV_ds_AfterExecuteInsert


?>

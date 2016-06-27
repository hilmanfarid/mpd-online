<?php
//BindEvents Method @1-7A92143C
function BindEvents()
{
    global $LOV;
    $LOV->Button1->CCSEvents["OnClick"] = "LOV_Button1_OnClick";
    $LOV->CCSEvents["BeforeShow"] = "LOV_BeforeShow";
    $LOV->CCSEvents["AfterInsert"] = "LOV_AfterInsert";
    $LOV->CCSEvents["AfterUpdate"] = "LOV_AfterUpdate";
}
//End BindEvents Method

//LOV_Button1_OnClick @16-1EC49D4D
function LOV_Button1_OnClick(& $sender)
{
    $LOV_Button1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV; //Compatibility
//End LOV_Button1_OnClick

//Custom Code @24-2A29BDB7
// -------------------------
    // Write your own code here.
	$t_bphtb_registration_id= CCGetFromGet("t_bphtb_registration_id");
	$alasan= $LOV->alasan->GetValue();
	$user = CCGetUserLogin();
	$dbConn	= new clsDBConnSIKP();
	if($t_bphtb_registration_id != "" && $alasan != "" && $user != ""){ 
		$query="select f_unflag_bphtb from 
			f_unflag_bphtb(".$t_bphtb_registration_id.",'".$alasan."','".$user."')";
		//echo $query;exit;
		$dbConn->query($query);
		$dbConn->next_record();
		$result = $dbConn->f("f_unflag_bphtb");
	}else{
		$result = "id bphtb, alasan atau user login tidak boleh kosong";
	}


    echo "<script> 
		alert('".$result."');
		window.opener.location.reload();
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close LOV_Button1_OnClick @16-408DE5C8
    return $LOV_Button1_OnClick;
}
//End Close LOV_Button1_OnClick

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
	
	

	
// -------------------------
//End Custom Code

//Close LOV_AfterInsert @3-FB340CAF
    return $LOV_AfterInsert;
}
//End Close LOV_AfterInsert

//LOV_AfterUpdate @3-A657E919
function LOV_AfterUpdate(& $sender)
{
    $LOV_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV; //Compatibility
//End LOV_AfterUpdate

//Custom Code @23-2A29BDB7
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

//Close LOV_AfterUpdate @3-341DCD20
    return $LOV_AfterUpdate;
}
//End Close LOV_AfterUpdate


?>

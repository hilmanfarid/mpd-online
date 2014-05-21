<?php
//BindEvents Method @1-1C9B4D79
function BindEvents()
{
    global $formPerubahanMasaPajak;
    $formPerubahanMasaPajak->CCSEvents["AfterInsert"] = "formPerubahanMasaPajak_AfterInsert";
    $formPerubahanMasaPajak->CCSEvents["AfterUpdate"] = "formPerubahanMasaPajak_AfterUpdate";
    $formPerubahanMasaPajak->CCSEvents["BeforeShow"] = "formPerubahanMasaPajak_BeforeShow";
}
//End BindEvents Method

//formPerubahanMasaPajak_AfterInsert @3-D1A6D800
function formPerubahanMasaPajak_AfterInsert(& $sender)
{
    $formPerubahanMasaPajak_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanMasaPajak; //Compatibility
//End formPerubahanMasaPajak_AfterInsert

//Custom Code @59-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close formPerubahanMasaPajak_AfterInsert @3-E9FCC43D
    return $formPerubahanMasaPajak_AfterInsert;
}
//End Close formPerubahanMasaPajak_AfterInsert

//formPerubahanMasaPajak_AfterUpdate @3-26554FE8
function formPerubahanMasaPajak_AfterUpdate(& $sender)
{
    $formPerubahanMasaPajak_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanMasaPajak; //Compatibility
//End formPerubahanMasaPajak_AfterUpdate

//Custom Code @60-2A29BDB7
// -------------------------
    echo "<script> 
		alert('Update Data Berhasil');
		window.opener.location.reload();
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close formPerubahanMasaPajak_AfterUpdate @3-26D505B2
    return $formPerubahanMasaPajak_AfterUpdate;
}
//End Close formPerubahanMasaPajak_AfterUpdate

//formPerubahanMasaPajak_BeforeShow @3-575B3810
function formPerubahanMasaPajak_BeforeShow(& $sender)
{
    $formPerubahanMasaPajak_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formPerubahanMasaPajak; //Compatibility
//End formPerubahanMasaPajak_BeforeShow

//Custom Code @61-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close formPerubahanMasaPajak_BeforeShow @3-EEE3630F
    return $formPerubahanMasaPajak_BeforeShow;
}
//End Close formPerubahanMasaPajak_BeforeShow

//DEL  // -------------------------
//DEL      if($row = pg_fetch_array($formPerubahanMasaPajak->DataSource->itemResult)) {
//DEL  	
//DEL  	}
//DEL  	
//DEL      echo "<script> 
//DEL  		alert('".$row['msg']."');
//DEL  		window.opener.location.reload();
//DEL  		window.close();
//DEL  	</script>";
//DEL  	exit;
//DEL  // -------------------------

?>

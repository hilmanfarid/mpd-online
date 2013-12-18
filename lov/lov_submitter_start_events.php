<?php
//BindEvents Method @1-4D464E96
function BindEvents()
{
    global $V_SUBMITTER;
    $V_SUBMITTER->Button_Update->CCSEvents["OnClick"] = "V_SUBMITTER_Button_Update_OnClick";
    $V_SUBMITTER->CCSEvents["BeforeSelect"] = "V_SUBMITTER_BeforeSelect";
}
//End BindEvents Method

//V_SUBMITTER_Button_Update_OnClick @85-D898E8CB
function V_SUBMITTER_Button_Update_OnClick(& $sender)
{
    $V_SUBMITTER_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $V_SUBMITTER; //Compatibility
//End V_SUBMITTER_Button_Update_OnClick

//Custom Code @101-2A29BDB7
// -------------------------
    // Write your own code here.

	global $ais_create_doc;
	global $ais_manual;
	global $auser_id_doc;
	global $auser_id_donor;
	global $auser_id_login;
	global $auser_id_taken;
	global $acurr_ctl_id;
	global $acurr_doc_type_id;
	global $acurr_proc_id;
	global $acurr_doc_id;
	global $acurr_doc_status;
	global $acurr_proc_status;
	global $aprev_ctl_id;
	global $aprev_doc_type_id;
	global $aprev_proc_id;
	global $aprev_doc_id;
	global $ainteractive_msg;
	global $aslot_1;
	global $aslot_2;
	global $aslot_3;
	global $aslot_4;
	global $aslot_5; 

	global $o_submitter_id;
    global $o_error_message;
	global $o_result_msg;
	global $o_warning;	

	$o_submitter_id = null;
	$o_error_message = "";
	$o_result_msg = "";
	$o_warning = ""; 
    $btn_call =  CCGetFromGet("execute", "");
	if(empty($btn_call)){
	
		$ais_create_doc 	= "'".CCGetFromGet("IS_CREATE_DOC", "N") ."'"; 
		$ais_manual			=  "'".CCGetFromGet("IS_MANUAL", "N")."'";  	
		$auser_id_doc 		= CCGetFromGet("USER_ID_DOC", "null");
		$auser_id_doc = (empty($auser_id_doc) ? "null" : $auser_id_doc);
		$auser_id_donor 	= CCGetFromGet("USER_ID_DONOR", "null");
		$auser_id_donor = (empty($auser_id_donor) ? "null" : $auser_id_donor);
		$auser_id_login 	= CCGetUserID();
		$auser_id_taken 	= CCGetFromGet("USER_ID_TAKEN", "null");  
		if ($auser_id_taken == "null") {
			$auser_id_taken = $auser_id_login;
		}  
		$acurr_ctl_id 		= CCGetFromGet("CURR_CTL_ID", "null");
		$acurr_ctl_id       = (empty($acurr_ctl_id) ? "null" : $acurr_ctl_id);

		$acurr_doc_type_id	= CCGetFromGet("CURR_DOC_TYPE_ID", "null");
        $acurr_doc_type_id	= (empty($acurr_doc_type_id) ? "null" : $acurr_doc_type_id);

		$acurr_proc_id 		= CCGetFromGet("CURR_PROC_ID", "null");
		$acurr_proc_id      = (empty($acurr_proc_id) ? "null" : $acurr_proc_id);

		$acurr_doc_id 		= CCGetFromGet("CURR_DOC_ID", "null");
		$acurr_doc_id       = (empty($acurr_doc_id) ? "null" : $acurr_doc_id);

		$acurr_doc_status 	= CCGetFromGet("CURR_DOC_STATUS", "null");
		$acurr_doc_status   = ($acurr_doc_status=="null" ? "null" : "'".$acurr_doc_status."'");

		$acurr_proc_status 	= CCGetFromGet("CURR_PROC_STATUS", "0");
		$acurr_proc_status  = ($acurr_proc_status=="null" ? "null" : "'".$acurr_proc_status."'");

		$aprev_ctl_id 		= CCGetFromGet("PREV_CTL_ID", "null");
		$aprev_ctl_id       = (empty($aprev_ctl_id) ? "null" : $aprev_ctl_id);

		$aprev_doc_type_id 	= CCGetFromGet("PREV_DOC_TYPE_ID", "null");
		$aprev_doc_type_id = (empty($aprev_doc_type_id) ? "null" : $aprev_doc_type_id);

		$aprev_proc_id 		= CCGetFromGet("PREV_PROC_ID", "null");
		$aprev_proc_id      = (empty($aprev_proc_id) ? "null" : $aprev_proc_id);

		$aprev_doc_id 		= CCGetFromGet("PREV_DOC_ID", "null"); 
		$aprev_doc_id       = (empty($aprev_doc_id) ? "null" : $aprev_doc_id);

		$ainteractive_msg	= $V_SUBMITTER->INTERACTIVE_MESSAGE->GetValue();  
		$ainteractive_msg = (empty($ainteractive_msg) ? "null" : "'".$ainteractive_msg."'");

		$aslot_1 			= CCGetFromGet("SLOT_1", "null");
		$aslot_1            = ($aslot_1=="null" ? "null" : "'".$aslot_1."'");
		$aslot_2 			= CCGetFromGet("SLOT_2", "null");
		$aslot_2            = ($aslot_2=="null" ? "null" : "'".$aslot_2."'");
		$aslot_3 			= CCGetFromGet("SLOT_3", "null");
		$aslot_3            = ($aslot_3=="null" ? "null" : "'".$aslot_3."'");
		$aslot_4 			= CCGetFromGet("SLOT_4", "null");
		$aslot_4            = ($aslot_4=="null" ? "null" : "'".$aslot_4."'");
		$aslot_5 			= CCGetFromGet("SLOT_5", "null");
		$aslot_5            = ($aslot_=="null" ? "null" : "'".$aslot_5."'");
		$submit = $o_submitter_id;
		
		$dbConn = new clsDBConnSIKP();
		$SeQuery = "select seq_submitter_id.nextval as seq from dual";
		$dbConn->query($SeQuery);
		while($dbConn->next_record()){
			$o_submitter_id = $dbConn->f("seq");
		}
		
		$s = "begin " 
		. "pack_workflow_mpd.submit_engine("
		. $o_submitter_id.", "
		. $ais_create_doc.", "
		. $ais_manual.", "
		. $auser_id_doc.", "
		. $auser_id_donor.", "
		. $auser_id_login.", "
		. $auser_id_taken.", "
		. $acurr_ctl_id.", "
		. $acurr_doc_type_id.", "
		. $acurr_proc_id.", "
		. $acurr_doc_id.", " 
		. $acurr_doc_status.", "
		. $acurr_proc_status.", "
		. $aprev_ctl_id.", "
		. $aprev_doc_type_id.", "
		. $aprev_proc_id.", "
		. $aprev_doc_id.", "
		. $ainteractive_msg.", "
		. $aslot_1.", "
		. $aslot_2.", " 
		. $aslot_3.", "
		. $aslot_4.", "
		. $aslot_5."); end;";
		
		//die($s);
		$dbConn->query($s);
		$arr = "";
				
		if (empty($arr)) {
			$errQuery = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
			$dbConn->query($errQuery);
			while($dbConn->next_record()){
				$o_error_message = $dbConn->f("error_message");
				$o_result_msg = $dbConn->f("return_message");
				$o_warning = $dbConn->f("warning");
			}
			
		}else{
			print_r($arr);
		}

		$V_SUBMITTER->SUBMITTER_ID->SetValue($o_submitter_id);
		$V_SUBMITTER->ERROR_MESSAGE->SetValue($o_error_message);
		$V_SUBMITTER->RETURN_MESSAGE->SetValue($o_result_msg);
		$V_SUBMITTER->WARNING->SetValue($o_warning);

		if ($V_SUBMITTER->RETURN_MESSAGE->GetValue()!="0") { 
			global $redirectloader;
			  
			if (CCGetFromGet("CURR_PROC_ID",  "") == "1")  {
					$redirectloader = "../workflow/workflow_summary.php?ELEMENT_ID=" .  
						"10" . CCGetFromGet("CURR_DOC_TYPE_ID",NULL) . "0" . "2" . "0" . $auser_id_login .  
						"&P_W_DOC_TYPE_ID=" . CCGetFromGet("CURR_DOC_TYPE_ID",NULL) . 
						"&P_W_PROC_ID=" . "2" . 
						"&PROFILE_TYPE=INBOX&P_APP_USER_ID=" . $auser_id_login .  
						"&sumworkflowDir=Asc&sumworkflowPageSize=50";
			} else {
					$redirectloader = "../workflow/workflow_summary.php?ELEMENT_ID=" . 
						"20" . CCGetFromGet("CURR_DOC_TYPE_ID", NULL) . "0" . CCGetFromGet("CURR_PROC_ID", NULL) . "0" . $auser_id_login . 
						"&P_W_DOC_TYPE_ID=" . CCGetFromGet("CURR_DOC_TYPE_ID", NULL) . 
						"&P_W_PROC_ID=" . CCGetFromGet("CURR_PROC_ID", NULL) . 
						"&PROFILE_TYPE=OUTBOX&P_APP_USER_ID=" . $auser_id_login .  
						"&sumworkflowDir=Asc&sumworkflowPageSize=50"; 
			}

			// refresh parent by javascript 
			echo ("<script language='javascript'>");
            echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
			echo ("</script>");   
			
		}
		// end  refresh background summary inbox 
		

		// redirect for new $o_submitter_id 
        //global $qs;
		$qs = CCGetQueryString("QueryString", ""); 
        $qs = CCRemoveParam($qs, "submitter_id");
	    $qs = CCRemoveParam($qs, "Button_Submit");
        $qs = CCAddParam($qs, "submitter_id", $o_submitter_id);
		$qs = CCAddParam($qs, "ERROR_MESSAGE", $o_error_message);
		$qs = CCAddParam($qs, "RETURN_MESSAGE", $o_result_msg);
		$qs = CCAddParam($qs, "WARNING", $o_warning);
		$qs = CCAddParam($qs, "execute", "1");
		global $FileName;
		$qs = $FileName."?" . $qs;

		echo("<script language='javascript'>");
		echo("location.href='".$qs."';");
		echo("</script>");
		exit;
		return;

	}
// -------------------------
//End Custom Code

//Close V_SUBMITTER_Button_Update_OnClick @85-2F1F3775
    return $V_SUBMITTER_Button_Update_OnClick;
}
//End Close V_SUBMITTER_Button_Update_OnClick

//V_SUBMITTER_BeforeSelect @82-107F4267
function V_SUBMITTER_BeforeSelect(& $sender)
{
    $V_SUBMITTER_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $V_SUBMITTER; //Compatibility
//End V_SUBMITTER_BeforeSelect

//Custom Code @111-2A29BDB7
// -------------------------
    // Write your own code here.
	//$V_SUBMITTER->EditMode = true;
	//$V_SUBMITTER->ReadAllowed = true;
	$dbConnect = new clsDBConnSIKP();
	
	$vcurr_proc_id = CCGetFromGet("CURR_PROC_ID", "null");
	$vcurr_doc_type_id = CCGetFromGet("CURR_DOC_TYPE_ID", "null");
	$query = "select f_get_next_info($vcurr_proc_id,$vcurr_doc_type_id)as task from dual";
	$dbConnect->query($query);
	while($dbConnect->next_record()){
		$ntask = $dbConnect->f("task");
	}
	$V_SUBMITTER->NTASK->SetValue($ntask);
// -------------------------
//End Custom Code

//Close V_SUBMITTER_BeforeSelect @82-F71BE1D2
    return $V_SUBMITTER_BeforeSelect;
}
//End Close V_SUBMITTER_BeforeSelect
?>

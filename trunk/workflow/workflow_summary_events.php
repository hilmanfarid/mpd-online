<?php
// Start Bdr    
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    
//BindEvents Method @1-676FBE24
function BindEvents()
{
    global $sumworkflow;
    global $Task;
    global $CCSEvents;
    $sumworkflow->CCSEvents["BeforeShowRow"] = "sumworkflow_BeforeShowRow";
    $Task->Buka->CCSEvents["BeforeShow"] = "Task_Buka_BeforeShow";
    $Task->EVENT_COLORING->CCSEvents["BeforeShow"] = "Task_EVENT_COLORING_BeforeShow";
    $Task->CCSEvents["BeforeShowRow"] = "Task_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//sumworkflow_BeforeShowRow @476-0A815D54
function sumworkflow_BeforeShowRow(& $sender)
{
    $sumworkflow_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sumworkflow; //Compatibility
//End sumworkflow_BeforeShowRow

//Set Row Style @484-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @492-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId = CCGetFromGet("ELEMENT_ID", "");
	global $id;
	if (empty($keyId)) {
		if (empty($id)) {
			$id = $sumworkflow->ELEMENT_ID->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "ELEMENT_ID", $id);
					
		$Redirect = $FileName."?".$param;
		
		header("Location: ".$Redirect);
		return;
	}
	
	if ($sumworkflow->ELEMENT_ID->GetValue() == $keyId) {					
		$sumworkflow->ADLink->Visible = true;
		$sumworkflow->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");		
	} else {				
		$sumworkflow->ADLink->Visible = false;
		$sumworkflow->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");

	}

	$strstype = $sumworkflow->STYPE->Value;
	
	if  ($strstype != "PROFILE") { 							     		 
			 
			 $img_link = $sumworkflow->ADLink->page = "workflow_summary.php?" . CCGetQueryString("QueryString", "");;  
		      $sumworkflow->SCOUNT->Text = "(" . $sumworkflow->SCOUNT->GetFormattedValue() . ")";  

			 if (strpos($sumworkflow->STYPE->Value,"INBOX")) { 			 			
				$sumworkflow->DISPLAY_NAME->Text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='../workflow/" . $img_link . "'><img id='Imgbox' src='../images/inboxme.gif' name='Imgbox' border='0'></a>&nbsp;" . $sumworkflow->DISPLAY_NAME->GetFormattedValue();  
		     }elseif(strpos($sumworkflow->STYPE->Value,"OUTBOX")) { 			 	
				$sumworkflow->DISPLAY_NAME->Text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='../workflow/" . $img_link . "'><img id='Imgbox' src='../images/outboxme.gif' name='Imgbox' border='0'></a>&nbsp;" . $sumworkflow->DISPLAY_NAME->GetFormattedValue();  
		     }elseif(strpos($sumworkflow->STYPE->Value,"REJECT")) { 			 	
				$sumworkflow->DISPLAY_NAME->Text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='../workflow/" . $img_link . "'><img id='Imgbox' src='../images/rejectme.gif' name='Imgbox' border='0'></a>&nbsp;" . $sumworkflow->DISPLAY_NAME->GetFormattedValue();  
		     }elseif(strpos($sumworkflow->STYPE->Value,"FINISH")) { 				
				$sumworkflow->DISPLAY_NAME->Text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='../workflow/" . $img_link . "'><img id='Imgbox' src='../images/finishme.gif' name='Imgbox' border='0'></a>&nbsp;" . $sumworkflow->DISPLAY_NAME->GetFormattedValue();   
			 }else{			 	  
				$sumworkflow->DISPLAY_NAME->Text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='../workflow/" . $img_link . "'><img id='Imgbox' src='../images/inboxme.gif' name='Imgbox' border='0'></a>&nbsp;" . $sumworkflow->DISPLAY_NAME->GetFormattedValue();  			 				 
			}
		}else{ 
		     $sumworkflow->SCOUNT->Text = " "; 
			 $sumworkflow->DLink->Visible = false;
			 $sumworkflow->ADLink->Visible = false;  
		} 

// -------------------------
//End Custom Code

//Close sumworkflow_BeforeShowRow @476-CED3F132
    return $sumworkflow_BeforeShowRow;
}
//End Close sumworkflow_BeforeShowRow

//Task_Buka_BeforeShow @58-D83E3B9D
function Task_Buka_BeforeShow(& $sender)
{
    $Task_Buka_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Task; //Compatibility
//End Task_Buka_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
	global $open_iframe; 
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
	global $profile; 
	global $filenm;
	global $paramstr;
	global $openform;
	global $paramtr2;
	global $qs;

    $Task->Buka->Attributes->SetValue("read","Terima");
	$profile = $Task->PROFILE_TYPE->GetFormattedValue();	 
	if ($Task->IS_READ->GetFormattedValue() == "Y") { 
			 $Task->Buka->Attributes->SetValue("read","Buka");
	}; 
	$ais_create_doc 	= "N"; 
	$ais_manual			= "N";  
	$auser_id_login 	= CCGetUserID();
	$auser_id_doc 		= $Task->P_APP_USER_ID_DONOR->GetFormattedValue();	
	$auser_id_donor 	= $Task->P_APP_USER_ID_DONOR->GetFormattedValue();		
	$auser_id_taken 	= $Task->P_APP_USER_ID_TAKEOVER->GetFormattedValue();   
	$acurr_ctl_id 		= $Task->T_CTL_ID->GetFormattedValue();   
	$acurr_doc_type_id	= $Task->P_W_DOC_TYPE_ID->GetFormattedValue();    
	$acurr_proc_id 		= $Task->P_W_PROC_ID->GetFormattedValue();    
	$acurr_doc_id 		= $Task->DOC_ID->GetFormattedValue();
	$acurr_doc_status 	= $Task->DOC_STS->GetFormattedValue();  
	$acurr_proc_status 	= $Task->PROC_STS->GetFormattedValue();     
	$aprev_ctl_id 		= $Task->PREV_CTL_ID->GetFormattedValue();
	$aprev_doc_type_id 	= $Task->PREV_DOC_TYPE_ID->GetFormattedValue();
	$aprev_proc_id 		= $Task->PREV_PROC_ID->GetFormattedValue();
	$aprev_doc_id 		= $Task->PREV_DOC_ID->GetFormattedValue();
	$ainteractive_msg	= $Task->MESSAGE->GetFormattedValue(); 
	$aslot_1 			= $Task->SLOT_1->GetFormattedValue();
	$aslot_2 			= $Task->SLOT_2->GetFormattedValue();
	$aslot_3 			= $Task->SLOT_3->GetFormattedValue();
	$aslot_4 			= $Task->SLOT_4->GetFormattedValue();
	$aslot_5 			= $Task->SLOT_5->GetFormattedValue();
  
	if ($profile != "INBOX") { 
       $Task->Buka->Attributes->SetValue("read","View");
	}; 

	$filenm = $Task->FILENAME->GetFormattedValue();             

	if (!strpos($filenm, "?")) {
		$filenm = $filenm . "?buka=yes";
    } else {
	    $filenm = $filenm . "buka=yes";
	};
 
  	$paramstr = "&FILENM=" . $Task->FILENAME->GetFormattedValue() . 
						"&CURR_DOC_ID=" . $acurr_doc_id . 
						"&CURR_DOC_TYPE_ID=" . $acurr_doc_type_id .
						"&CURR_PROC_ID=" . $acurr_proc_id . 
						"&CURR_CTL_ID=" . $acurr_ctl_id .
						"&USER_ID_DOC=" . $auser_id_doc .
						"&USER_ID_DONOR=" . $auser_id_donor .
						"&USER_ID_LOGIN=" . $auser_id_login .
						"&USER_ID_TAKEN=" . $auser_id_taken .
						"&IS_CREATE_DOC=" . $ais_create_doc .
						"&IS_MANUAL=" . $ais_manual .
						"&CURR_PROC_STATUS=" . $acurr_proc_status .
						"&CURR_DOC_STATUS=" . $acurr_doc_status .
						"&PREV_DOC_ID=" . $aprev_doc_id .
						"&PREV_DOC_TYPE_ID=" . $aprev_doc_type_id .
						"&PREV_PROC_ID=" . $aprev_proc_id .
						"&PREV_CTL_ID=" . $aprev_ctl_id . 
						"&SLOT_1=" . $aslot_1 .
						"&SLOT_2=" . $aslot_2 .
						"&SLOT_3=" . $aslot_3 .
						"&SLOT_4=" . $aslot_4 .
						"&SLOT_5=" . $aslot_5 .  
						"&MESSAGE=" . $ainteractive_msg;		
	
	        $openform = $filenm . $paramstr;  
						
		    if ($profile == "INBOX") {
			
                if (CCGetFromGet("IS_TAKEN","") == "") {    
						//--------------------------------------------------------------------
						// PEMBERIAN VARIABEL
						//--------------------------------------------------------------------					    					    
						$qs = CCGetQueryString("QueryString", ""); 						
						$qs  = CCRemoveParam($qs, "IS_TAKEN");
					    $qs =  CCRemoveParam($qs, "TAKEN_CTL");
						if ($qs == "") {
							$qs= "?"; 
						};					      
						//------------------------------- 
						global $FileName;                          
						$qs  = $FileName . "?buka=yes&" . $qs . "&TAKEN_CTL=" . $acurr_ctl_id . "&IS_TAKEN=Y" . $paramstr; 				
						$openform =  "javascript:location.href='" . $qs . "'; return false;";
						$Task->Buka->Attributes->SetValue('taskbuka', $openform);  
						 
			  	}else{
 
					if ((CCGetFromGet("IS_TAKEN","") != "") && (CCGetFromGet("TAKEN_CTL","") != "")) { 

					    //--------------------------------------------------------------------
						// CALL FUNGSI UPDATE TAKEN DATE DAN IS_READ   
						//--------------------------------------------------------------------
			 			//$dbh = new PDO('pgsql:host=localhost;dbname=sikp_db;port=5444', "sikp", "sikp"); 
						$dbConn =new clsDBConnSIKP();
						$qs = "begin "
						      . " pack_task_profile.taken_task ( " . CCGetFromGet("TAKEN_CTL","") . ", '" . CCGetUserLogin() ."'," . (empty($acurr_doc_type_id) ? "null" : $acurr_doc_type_id) . " ); "  
						      . "end;";	 
                        //$stmt = $dbh->exec($qs);
						//$dbh = null;
						 $dbConn->query($qs);
						 $dbh = null;
						//--------------------------------------------------------------------
						// OPEN FORM 
						//--------------------------------------------------------------------
						
						if (CCGetFromGet("TAKEN_CTL","") == CCGetFromGet("CURR_CTL_ID","")) {  								
								$paramtr2 = "&FILENM=" . CCGetFromGet("FILENM","") .	
									"&TAKEN_CTL=&IS_TAKEN=" . 
									"&CURR_DOC_ID=" . CCGetFromGet("CURR_DOC_ID","") .
									"&CURR_DOC_TYPE_ID=" .CCGetFromGet("CURR_DOC_TYPE_ID","") .
									"&CURR_PROC_ID=" . CCGetFromGet("CURR_PROC_ID","") .
									"&CURR_CTL_ID=" . CCGetFromGet("CURR_CTL_ID","") .
									"&USER_ID_DOC=" . CCGetFromGet("USER_ID_DOC","") .
									"&USER_ID_DONOR=" . CCGetFromGet("USER_ID_DONOR","") .
									"&USER_ID_LOGIN=" . CCGetFromGet("USER_ID_LOGIN","") .
									"&USER_ID_TAKEN=" . CCGetFromGet("USER_ID_TAKEN","") .
									"&IS_CREATE_DOC=" . CCGetFromGet("IS_CREATE_DOC","") .
									"&IS_MANUAL=" . CCGetFromGet("IS_MANUAL","") .
									"&CURR_PROC_STATUS=" . CCGetFromGet("CURR_PROC_STATUS","") .
									"&CURR_DOC_STATUS=" . CCGetFromGet("CURR_DOC_STATUS","") .
									"&PREV_DOC_ID=" . CCGetFromGet("PREV_DOC_ID","") .
									"&PREV_DOC_TYPE_ID=" . CCGetFromGet("PREV_DOC_TYPE_ID","") .
									"&PREV_PROC_ID=" . CCGetFromGet("PREV_PROC_ID","") .
									"&PREV_CTL_ID=" . CCGetFromGet("PREV_CTL_ID","") . 
									"&SLOT_1=" . CCGetFromGet("SLOT_1","") .
									"&SLOT_2=" . CCGetFromGet("SLOT_2","") .
									"&SLOT_3=" . CCGetFromGet("SLOT_3","") .
									"&SLOT_4=" . CCGetFromGet("SLOT_4","") .
									"&SLOT_5=" . CCGetFromGet("SLOT_5","") .  
									"&MESSAGE=" . CCGetFromGet("MESSAGE","");

								$filenm = CCGetFromGet("FILENM",""); 
								if ($filenm != "") {
									if (!strpos($filenm, "?")) {
										$filenm = $filenm . "?buka=yes";
								    } else {
									    $filenm = $filenm . "buka=yes";
									};	 

									$openform = $filenm  . $paramtr2;  
									echo("<script language='javascript'>");
									echo("location.href='".$openform."';");
									echo("</script>");
									exit;
									return; 
								}else{
									echo("Form tidak ditemukan!");
									die(); 
								};

						}; 
					}else{
				   		$openform = "javascript:alert('Error open form'); return false;";
						$Task->Buka->Attributes->SetValue('taskbuka', $openform);						
					}; 
			   };
           }else{
		   	   $openform = $openform . "&TAKEN_CTL=&IS_TAKEN=&IS_VIEW_ONLY=Y"; 
		       //$openform =  "javascript:view_task('" . $openform . "'); return false;" ; 
			   $openform =  "javascript:location.href='" . $openform . "'; return false;" ; 
			   $Task->Buka->Attributes->SetValue('taskbuka', $openform);	 
           };
// -------------------------
//End Custom Code

//Close Task_Buka_BeforeShow @58-D8913CA3
    return $Task_Buka_BeforeShow;
}
//End Close Task_Buka_BeforeShow

//Task_EVENT_COLORING_BeforeShow @120-95B7402D
function Task_EVENT_COLORING_BeforeShow(& $sender)
{
    $Task_EVENT_COLORING_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Task; //Compatibility
//End Task_EVENT_COLORING_BeforeShow

//Custom Code @122-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Task_EVENT_COLORING_BeforeShow @120-8CE4C015
    return $Task_EVENT_COLORING_BeforeShow;
}
//End Close Task_EVENT_COLORING_BeforeShow

//Task_BeforeShowRow @16-80E07037
function Task_BeforeShowRow(& $sender)
{
    $Task_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Task; //Compatibility
//End Task_BeforeShowRow

//Custom Code @136-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Task_BeforeShowRow @16-CB52C7B0
    return $Task_BeforeShowRow;
}
//End Close Task_BeforeShowRow

//Page_OnInitializeView @1-74641E63
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $workflow_summary; //Compatibility
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


?>

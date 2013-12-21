<?php
//BindEvents Method @1-D2B2E2E6
function BindEvents()
{
    global $workavailable;
    global $workavailable_wp;
    global $HistoryGrid;
    global $CCSEvents;
    $workavailable->CCSEvents["BeforeShowRow"] = "workavailable_BeforeShowRow";
    $workavailable->CCSEvents["BeforeShow"] = "workavailable_BeforeShow";
    $workavailable_wp->CCSEvents["BeforeShowRow"] = "workavailable_wp_BeforeShowRow";
    $HistoryGrid->CCSEvents["BeforeShowRow"] = "HistoryGrid_BeforeShowRow";
    $HistoryGrid->CCSEvents["BeforeSelect"] = "HistoryGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//workavailable_BeforeShowRow @4-1B430263
function workavailable_BeforeShowRow(& $sender)
{
    $workavailable_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $workavailable; //Compatibility
//End workavailable_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	$url = $workavailable->SURL->GetValue();
  	$new_url = str_replace("~#","&",$url);
  	$workavailable->WORKFLOW_NAME->SetLink($new_url);
  	$workavailable->INBOX->SetLink($new_url);
  
  	$jum = $workavailable->INBOX->GetValue();
  
  	$jumlah = $jumlah + $jum;
  
  	$workavailable->JUMLAH->SetValue($jumlah);
  
  // -------------------------


//Close workavailable_BeforeShowRow @4-E31BD942
    return $workavailable_BeforeShowRow;
}
//End Close workavailable_BeforeShowRow

//workavailable_BeforeShow @4-6F307522
function workavailable_BeforeShow(& $sender)
{
    $workavailable_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $workavailable; //Compatibility
//End workavailable_BeforeShow

//Close workavailable_BeforeShow @4-E241EF8D
    return $workavailable_BeforeShow;
}
//End Close workavailable_BeforeShow

//workavailable_wp_BeforeShowRow @102-4690EEFF
function workavailable_wp_BeforeShowRow(& $sender)
{
    $workavailable_wp_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $workavailable_wp; //Compatibility
//End workavailable_wp_BeforeShowRow

  // -------------------------
      // Write your own code here.
  	$url = $workavailable_wp->SURL->GetValue();
  	$new_url = str_replace("~#","&",$url);
  	$workavailable_wp->WORKFLOW_NAME->SetLink($new_url);
  	$workavailable_wp->INBOX->SetLink($new_url);
  
  	$jum = $workavailable_wp->INBOX->GetValue();
  
  	$jumlah = $jumlah + $jum;
  
  	$workavailable_wp->JUMLAH->SetValue($jumlah);
  
  // -------------------------


//Close workavailable_wp_BeforeShowRow @102-68FFC74B
    return $workavailable_wp_BeforeShowRow;
}
//End Close workavailable_wp_BeforeShowRow

//HistoryGrid_BeforeShowRow @2-85406CB0
function HistoryGrid_BeforeShowRow(& $sender)
{
    $HistoryGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeShowRow

//Close HistoryGrid_BeforeShowRow @2-D25D4DF5
    return $HistoryGrid_BeforeShowRow;
}
//End Close HistoryGrid_BeforeShowRow

//HistoryGrid_BeforeSelect @2-63E3CC27
function HistoryGrid_BeforeSelect(& $sender)
{
    $HistoryGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeSelect

//Close HistoryGrid_BeforeSelect @2-39569808
    return $HistoryGrid_BeforeSelect;
}
//End Close HistoryGrid_BeforeSelect

//Page_OnInitializeView @1-B426ABF7
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sikp_home; //Compatibility
//End Page_OnInitializeView

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-4CC90172
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sikp_home; //Compatibility
//End Page_BeforeShow

  // -------------------------
      // Write your own code here.
  	global $workavailable;
  	global $workavailable_wp;
  	global $HistoryGrid;
  
  	$user = CCGetUserLogin();
  
  	$dbConn = new clsDBConnSIKP();
  	$sql = "select count(*)as wp from p_app_user where is_employee = 'N' and app_user_name = '".$user."'";
  	$dbConn->query($sql);
  	$dbConn->next_record();
  	$wp = $dbConn->f("wp");
  	$dbConn->close();
  
  	if ($wp > 0){
  		$workavailable_wp->Visible = true;
  		$workavailable->Visible = false;
  		$HistoryGrid->Visible = true;
  	}else{
  		$workavailable_wp->Visible = false;
  		$workavailable->Visible = true;
  		$HistoryGrid->Visible = false;
  	}
  // -------------------------


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>

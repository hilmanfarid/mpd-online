<?php
//BindEvents Method @1-AE0CDC85
function BindEvents()
{
    global $p_workflowGrid;
    global $p_wf_procmasterGrid;
    global $p_wf_procmasterGrid2;
    $p_workflowGrid->CCSEvents["BeforeShowRow"] = "p_workflowGrid_BeforeShowRow";
    $p_workflowGrid->CCSEvents["BeforeSelect"] = "p_workflowGrid_BeforeSelect";
    $p_wf_procmasterGrid->CCSEvents["BeforeShowRow"] = "p_wf_procmasterGrid_BeforeShowRow";
    $p_wf_procmasterGrid2->CCSEvents["BeforeShowRow"] = "p_wf_procmasterGrid2_BeforeShowRow";
}
//End BindEvents Method

//p_workflowGrid_BeforeShowRow @2-D3C8D6E2
function p_workflowGrid_BeforeShowRow(& $sender)
{
    $p_workflowGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_workflowGrid; //Compatibility
//End p_workflowGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @763-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId = CCGetFromGet("p_workflow_id", "");
	$sCode = CCGetFromGet("s_keyword", "");
	global $id;
	if (empty($keyId)) {
		if (empty($id)) {
			$id = $p_workflowGrid->p_workflow_id->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "p_workflow_id", $id);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($p_workflowGrid->p_workflow_id->GetValue() == $keyId) {
		$p_workflowGrid->ADLink->Visible = true;
		$p_workflowGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$p_workflowGrid->ADLink->Visible = false;
		$p_workflowGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close p_workflowGrid_BeforeShowRow @2-5C5BD5D5
    return $p_workflowGrid_BeforeShowRow;
}
//End Close p_workflowGrid_BeforeShowRow

//p_workflowGrid_BeforeSelect @2-DBE103D7
function p_workflowGrid_BeforeSelect(& $sender)
{
    $p_workflowGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_workflowGrid; //Compatibility
//End p_workflowGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_workflowGrid_BeforeSelect @2-81214195
    return $p_workflowGrid_BeforeSelect;
}
//End Close p_workflowGrid_BeforeSelect

//p_wf_procmasterGrid_BeforeShowRow @688-A626EB0E
function p_wf_procmasterGrid_BeforeShowRow(& $sender)
{
    $p_wf_procmasterGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_wf_procmasterGrid; //Compatibility
//End p_wf_procmasterGrid_BeforeShowRow

//Set Row Style @701-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @764-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId2 = CCGetFromGet("p_procedure_id_prev", "");
	global $id2;
	if (empty($keyId2)) {
		if (empty($id2)) {
			$id2 = $p_wf_procmasterGrid->p_procedure_id_prev->GetValue();
		}
		global $FileName;
		global $PathToCurrentPage;
		$param = CCGetQueryString("QueryString", "");
		$param = CCAddParam($param, "p_procedure_id_prev", $id2);
		
		$Redirect = $FileName."?".$param;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
	}

	if ($p_wf_procmasterGrid->p_procedure_id_prev->GetValue() == $keyId2) {
		$p_wf_procmasterGrid->ADLink->Visible = true;
		$p_wf_procmasterGrid->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$p_wf_procmasterGrid->ADLink->Visible = false;
		$p_wf_procmasterGrid->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}
// -------------------------
//End Custom Code

//Close p_wf_procmasterGrid_BeforeShowRow @688-DE62238F
    return $p_wf_procmasterGrid_BeforeShowRow;
}
//End Close p_wf_procmasterGrid_BeforeShowRow

//p_wf_procmasterGrid2_BeforeShowRow @709-2902074B
function p_wf_procmasterGrid2_BeforeShowRow(& $sender)
{
    $p_wf_procmasterGrid2_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_wf_procmasterGrid2; //Compatibility
//End p_wf_procmasterGrid2_BeforeShowRow

//Set Row Style @722-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @765-2A29BDB7
// -------------------------
    // Write your own code here.
	$keyId4 = CCGetFromGet("p_w_chart_proc_id_next", "");
	global $id4;
	if (empty($keyId4)) {
		if (empty($id4)) {
			$id4 = $p_wf_procmasterGrid2->p_w_chart_proc_id_next->GetValue();
		}
		
		global $FileName;
		global $PathToCurrentPage;
		$param2 = CCGetQueryString("QueryString", "");
		$param2 = CCAddParam($param, "p_w_chart_proc_id_next", $id4);
		
		$Redirect = $FileName."?".$param2;
		//die($Redirect);
		header("Location: ".$Redirect);
		return;
		
	}

	if ($p_wf_procmasterGrid2->p_w_chart_proc_id_next->GetValue() == $keyId4) {
		$p_wf_procmasterGrid2->ADLink->Visible = true;
		$p_wf_procmasterGrid2->DLink->Visible = false;
		$Component->Attributes->SetValue("rowStyle", "class=AltRow");
	} else {
		$p_wf_procmasterGrid2->ADLink->Visible = false;
		$p_wf_procmasterGrid2->DLink->Visible = true;
		$Component->Attributes->SetValue("rowStyle", "class=Row");
	}

// -------------------------
//End Custom Code

//Close p_wf_procmasterGrid2_BeforeShowRow @709-21B0C98D
    return $p_wf_procmasterGrid2_BeforeShowRow;
}
//End Close p_wf_procmasterGrid2_BeforeShowRow


?>

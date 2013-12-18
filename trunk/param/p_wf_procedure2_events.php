<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-07E6BD78
function BindEvents()
{
    global $p_workflowGrid;
    global $p_wf_procmasterGrid;
    global $p_wf_procmasterGrid2;
    global $CCSEvents;
    $p_workflowGrid->CCSEvents["BeforeShowRow"] = "p_workflowGrid_BeforeShowRow";
    $p_workflowGrid->CCSEvents["BeforeSelect"] = "p_workflowGrid_BeforeSelect";
    $p_wf_procmasterGrid->CCSEvents["BeforeShowRow"] = "p_wf_procmasterGrid_BeforeShowRow";
    $p_wf_procmasterGrid->CCSEvents["BeforeSelect"] = "p_wf_procmasterGrid_BeforeSelect";
    $p_wf_procmasterGrid2->CCSEvents["BeforeShowRow"] = "p_wf_procmasterGrid2_BeforeShowRow";
    $p_wf_procmasterGrid2->CCSEvents["BeforeSelect"] = "p_wf_procmasterGrid2_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
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

// Start Bdr
    global $selected_id;
    global $add_flag;
    global $is_show_form;
	if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_workflow_id->GetValue();
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_workflow_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    

    if (count($styles)) {
//        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
    $Component->DLink->SetValue($img_radio); // Bdr

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

//start asep

	//global $selected_id;
    global $add_flag;
    global $is_show_form;
	/*
	if ($selected_id2<0 && $add_flag!="ADD") {
    	$selected_id2 = $Component->DataSource->p_workflow_id->GetValue();
   }
   */
//end asep

//Set Row Style @701-982C9472
    $styles = array("Row", "AltRow");
	//start asep    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->prev_procedure_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
	//end asep    
    if (count($styles)) {
        //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	$Component->DLink2->SetValue($img_radio); // asep

//Close p_wf_procmasterGrid_BeforeShowRow @688-DE62238F
    return $p_wf_procmasterGrid_BeforeShowRow;
}
//End Close p_wf_procmasterGrid_BeforeShowRow

//p_wf_procmasterGrid_BeforeSelect @688-F35B580B
function p_wf_procmasterGrid_BeforeSelect(& $sender)
{
    $p_wf_procmasterGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_wf_procmasterGrid; //Compatibility
//End p_wf_procmasterGrid_BeforeSelect

//Custom Code @702-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_wf_procmasterGrid_BeforeSelect @688-B023DAC3
    return $p_wf_procmasterGrid_BeforeSelect;
}
//End Close p_wf_procmasterGrid_BeforeSelect

//p_wf_procmasterGrid2_BeforeShowRow @709-2902074B
function p_wf_procmasterGrid2_BeforeShowRow(& $sender)
{
    $p_wf_procmasterGrid2_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_wf_procmasterGrid2; //Compatibility
//End p_wf_procmasterGrid2_BeforeShowRow

//start asep

	global $selected_id;
    global $add_flag;
    global $is_show_form;
//end asep

//Set Row Style @722-982C9472
    $styles = array("Row", "AltRow");
		//start asep    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_wf_procedure_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
	//end asep    
    if (count($styles)) {
        //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
 $Component->DLink3->SetValue($img_radio); // asep

//Close p_wf_procmasterGrid2_BeforeShowRow @709-21B0C98D
    return $p_wf_procmasterGrid2_BeforeShowRow;
}
//End Close p_wf_procmasterGrid2_BeforeShowRow

//p_wf_procmasterGrid2_BeforeSelect @709-B85FAFCC
function p_wf_procmasterGrid2_BeforeSelect(& $sender)
{
    $p_wf_procmasterGrid2_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_wf_procmasterGrid2; //Compatibility
//End p_wf_procmasterGrid2_BeforeSelect

//Custom Code @723-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_wf_procmasterGrid2_BeforeSelect @709-6DA3A81A
    return $p_wf_procmasterGrid2_BeforeSelect;
}
//End Close p_wf_procmasterGrid2_BeforeSelect

//Page_OnInitializeView @1-766D6342
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_wf_procedure2; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_workflow_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

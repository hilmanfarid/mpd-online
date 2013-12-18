<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-ADBC0B0C
function BindEvents()
{
    global $p_job_positionGrid;
    global $CCSEvents;
    $p_job_positionGrid->CCSEvents["BeforeShowRow"] = "p_job_positionGrid_BeforeShowRow";
    $p_job_positionGrid->CCSEvents["BeforeSelect"] = "p_job_positionGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_job_positionGrid_BeforeShowRow @2-CE7806BF
function p_job_positionGrid_BeforeShowRow(& $sender)
{
    $p_job_positionGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_job_positionGrid; //Compatibility
//End p_job_positionGrid_BeforeShowRow

// Start Bdr
    global $p_job_positionForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_job_position_id->GetValue();
        $p_job_positionForm->DataSource->Parameters["urlp_job_position_id"] = $selected_id;
        $p_job_positionForm->DataSource->Prepare();
        $p_job_positionForm->EditMode = $p_job_positionForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_job_position_id->GetValue()== $selected_id) {
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

//Close p_job_positionGrid_BeforeShowRow @2-3493AAD3
    return $p_job_positionGrid_BeforeShowRow;
}
//End Close p_job_positionGrid_BeforeShowRow

//p_job_positionGrid_BeforeSelect @2-6CBE516B
function p_job_positionGrid_BeforeSelect(& $sender)
{
    $p_job_positionGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_job_positionGrid; //Compatibility
//End p_job_positionGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_job_positionGrid_BeforeSelect @2-94EDBF47
    return $p_job_positionGrid_BeforeSelect;
}
//End Close p_job_positionGrid_BeforeSelect

//Page_OnInitializeView @1-E493C136
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_job_position; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_job_position_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

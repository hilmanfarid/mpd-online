<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-052676A4
function BindEvents()
{
    global $p_procedureGrid;
    global $CCSEvents;
    $p_procedureGrid->CCSEvents["BeforeShowRow"] = "p_procedureGrid_BeforeShowRow";
    $p_procedureGrid->CCSEvents["BeforeSelect"] = "p_procedureGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_procedureGrid_BeforeShowRow @2-C9A4E1DB
function p_procedureGrid_BeforeShowRow(& $sender)
{
    $p_procedureGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedureGrid; //Compatibility
//End p_procedureGrid_BeforeShowRow

// Start Bdr
    global $p_procedureForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_procedure_id->GetValue();
        $p_procedureForm->DataSource->Parameters["urlp_procedure_id"] = $selected_id;
        $p_procedureForm->DataSource->Prepare();
        $p_procedureForm->EditMode = $p_procedureForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_procedure_id->GetValue()== $selected_id) {
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

//Close p_procedureGrid_BeforeShowRow @2-CADF116C
    return $p_procedureGrid_BeforeShowRow;
}
//End Close p_procedureGrid_BeforeShowRow

//p_procedureGrid_BeforeSelect @2-868B2248
function p_procedureGrid_BeforeSelect(& $sender)
{
    $p_procedureGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedureGrid; //Compatibility
//End p_procedureGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_procedureGrid_BeforeSelect @2-0C4D76DF
    return $p_procedureGrid_BeforeSelect;
}
//End Close p_procedureGrid_BeforeSelect

//Page_OnInitializeView @1-7E214F88
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_procedure_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

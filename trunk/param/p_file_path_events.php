<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-28B8C46D
function BindEvents()
{
    global $p_file_pathGrid;
    global $CCSEvents;
    $p_file_pathGrid->CCSEvents["BeforeShowRow"] = "p_file_pathGrid_BeforeShowRow";
    $p_file_pathGrid->CCSEvents["BeforeSelect"] = "p_file_pathGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_file_pathGrid_BeforeShowRow @2-565D0AA6
function p_file_pathGrid_BeforeShowRow(& $sender)
{
    $p_file_pathGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_file_pathGrid; //Compatibility
//End p_file_pathGrid_BeforeShowRow

// Start Bdr
    global $p_file_pathForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_file_path_id->GetValue();
        $p_file_pathForm->DataSource->Parameters["urlp_file_path_id"] = $selected_id;
        $p_file_pathForm->DataSource->Prepare();
        $p_file_pathForm->EditMode = $p_file_pathForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_file_path_id->GetValue()== $selected_id) {
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

//Close p_file_pathGrid_BeforeShowRow @2-DC254CAB
    return $p_file_pathGrid_BeforeShowRow;
}
//End Close p_file_pathGrid_BeforeShowRow

//p_file_pathGrid_BeforeSelect @2-647DE240
function p_file_pathGrid_BeforeSelect(& $sender)
{
    $p_file_pathGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_file_pathGrid; //Compatibility
//End p_file_pathGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_file_pathGrid_BeforeSelect @2-9ADFF400
    return $p_file_pathGrid_BeforeSelect;
}
//End Close p_file_pathGrid_BeforeSelect

//Page_OnInitializeView @1-E958DB6A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_file_path; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_file_path_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

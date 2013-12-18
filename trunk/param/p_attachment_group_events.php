<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-F8EB3826
function BindEvents()
{
    global $p_attachment_groupGrid;
    global $CCSEvents;
    $p_attachment_groupGrid->CCSEvents["BeforeShowRow"] = "p_attachment_groupGrid_BeforeShowRow";
    $p_attachment_groupGrid->CCSEvents["BeforeSelect"] = "p_attachment_groupGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_attachment_groupGrid_BeforeShowRow @2-716985F2
function p_attachment_groupGrid_BeforeShowRow(& $sender)
{
    $p_attachment_groupGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_attachment_groupGrid; //Compatibility
//End p_attachment_groupGrid_BeforeShowRow

// Start Bdr
    global $p_attachment_groupForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_attachment_group_id->GetValue();
        $p_attachment_groupForm->DataSource->Parameters["urlp_attachment_group_id"] = $selected_id;
        $p_attachment_groupForm->DataSource->Prepare();
        $p_attachment_groupForm->EditMode = $p_attachment_groupForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_attachment_group_id->GetValue()== $selected_id) {
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

//Close p_attachment_groupGrid_BeforeShowRow @2-FA82AF1D
    return $p_attachment_groupGrid_BeforeShowRow;
}
//End Close p_attachment_groupGrid_BeforeShowRow

//p_attachment_groupGrid_BeforeSelect @2-A50D6AA3
function p_attachment_groupGrid_BeforeSelect(& $sender)
{
    $p_attachment_groupGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_attachment_groupGrid; //Compatibility
//End p_attachment_groupGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_attachment_groupGrid_BeforeSelect @2-E40CEE30
    return $p_attachment_groupGrid_BeforeSelect;
}
//End Close p_attachment_groupGrid_BeforeSelect

//Page_OnInitializeView @1-AD3FD9D7
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_attachment_group; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_attachment_group_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

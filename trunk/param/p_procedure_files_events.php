<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-2CEE3B62
function BindEvents()
{
    global $p_procedure_filesGrid;
    global $p_procedure_filesForm;
    global $CCSEvents;
    $p_procedure_filesGrid->CCSEvents["BeforeShowRow"] = "p_procedure_filesGrid_BeforeShowRow";
    $p_procedure_filesGrid->CCSEvents["BeforeShow"] = "p_procedure_filesGrid_BeforeShow";
    $p_procedure_filesGrid->CCSEvents["BeforeSelect"] = "p_procedure_filesGrid_BeforeSelect";
    $p_procedure_filesForm->CCSEvents["BeforeShow"] = "p_procedure_filesForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_procedure_filesGrid_BeforeShowRow @2-BD5AD2BE
function p_procedure_filesGrid_BeforeShowRow(& $sender)
{
    $p_procedure_filesGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_filesGrid; //Compatibility
//End p_procedure_filesGrid_BeforeShowRow

// Start Bdr
    global $p_procedure_filesForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_procedure_files_id->GetValue();
        $p_procedure_filesForm->DataSource->Parameters["urlp_procedure_files_id"] = $selected_id;
        $p_procedure_filesForm->DataSource->Prepare();
        $p_procedure_filesForm->EditMode = $p_procedure_filesForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_procedure_files_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    

    if (count($styles)) {
        //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
$Component->DLink->SetValue($img_radio);  // Bdr

//Close p_procedure_filesGrid_BeforeShowRow @2-9F9406E8
    return $p_procedure_filesGrid_BeforeShowRow;
}
//End Close p_procedure_filesGrid_BeforeShowRow

//p_procedure_filesGrid_BeforeShow @2-0092F826
function p_procedure_filesGrid_BeforeShow(& $sender)
{
    $p_procedure_filesGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_filesGrid; //Compatibility
//End p_procedure_filesGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_procedure_filesGrid_BeforeShow @2-BF3ADA9A
    return $p_procedure_filesGrid_BeforeShow;
}
//End Close p_procedure_filesGrid_BeforeShow

//p_procedure_filesGrid_BeforeSelect @2-CA9463E6
function p_procedure_filesGrid_BeforeSelect(& $sender)
{
    $p_procedure_filesGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_filesGrid; //Compatibility
//End p_procedure_filesGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_procedure_filesGrid_BeforeSelect @2-427CDD68
    return $p_procedure_filesGrid_BeforeSelect;
}
//End Close p_procedure_filesGrid_BeforeSelect

//p_procedure_filesForm_BeforeShow @23-53B32342
function p_procedure_filesForm_BeforeShow(& $sender)
{
    $p_procedure_filesForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_filesForm; //Compatibility
//End p_procedure_filesForm_BeforeShow

//Custom Code @128-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_procedure_filesForm_BeforeShow @23-E331ABEF
    return $p_procedure_filesForm_BeforeShow;
}
//End Close p_procedure_filesForm_BeforeShow

//Page_OnInitializeView @1-E755D1CC
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_procedure_files; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_procedure_files_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-EA7A9A0F
function BindEvents()
{
    global $p_global_paramGrid;
    global $CCSEvents;
    $p_global_paramGrid->CCSEvents["BeforeShowRow"] = "p_global_paramGrid_BeforeShowRow";
    $p_global_paramGrid->CCSEvents["BeforeSelect"] = "p_global_paramGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_global_paramGrid_BeforeShowRow @3-6F446A93
function p_global_paramGrid_BeforeShowRow(& $sender)
{
    $p_global_paramGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_global_paramGrid; //Compatibility
//End p_global_paramGrid_BeforeShowRow

// Start Bdr
    global $p_global_paramForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_global_param_id->GetValue();
        $p_global_paramForm->DataSource->Parameters["urlp_global_param_id"] = $selected_id;
        $p_global_paramForm->DataSource->Prepare();
        $p_global_paramForm->EditMode = $p_global_paramForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr
//Set Row Style @11-982C9472
    $styles = array("Row", "AltRow");
		// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_global_param_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    
    if (count($styles)) {
       // $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
$Component->DLink->SetValue($img_radio);  // Bdr

//Close p_global_paramGrid_BeforeShowRow @3-A3BC8E3F
    return $p_global_paramGrid_BeforeShowRow;
}
//End Close p_global_paramGrid_BeforeShowRow

//p_global_paramGrid_BeforeSelect @3-BED27600
function p_global_paramGrid_BeforeSelect(& $sender)
{
    $p_global_paramGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_global_paramGrid; //Compatibility
//End p_global_paramGrid_BeforeSelect

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_global_paramGrid_BeforeSelect @3-6910DB4C
    return $p_global_paramGrid_BeforeSelect;
}
//End Close p_global_paramGrid_BeforeSelect

//Page_OnInitializeView @1-733A3E80
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_global_param; //Compatibility
//End Page_OnInitializeView

//Custom Code @51-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_global_param_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

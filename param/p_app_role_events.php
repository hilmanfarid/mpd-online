<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-748A8D29
function BindEvents()
{
    global $p_app_roleGrid;
    global $p_app_roleForm;
    global $CCSEvents;
    $p_app_roleGrid->CCSEvents["BeforeShowRow"] = "p_app_roleGrid_BeforeShowRow";
    $p_app_roleGrid->CCSEvents["BeforeShow"] = "p_app_roleGrid_BeforeShow";
    $p_app_roleGrid->CCSEvents["BeforeSelect"] = "p_app_roleGrid_BeforeSelect";
    $p_app_roleForm->CCSEvents["BeforeShow"] = "p_app_roleForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_app_roleGrid_BeforeShowRow @2-5BEBBB72
function p_app_roleGrid_BeforeShowRow(& $sender)
{
    $p_app_roleGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_roleGrid; //Compatibility
//End p_app_roleGrid_BeforeShowRow
// Start Bdr
    global $p_app_roleForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_app_role_id->GetValue();
        $p_app_roleForm->DataSource->Parameters["urlp_app_role_id"] = $selected_id;
        $p_app_roleForm->DataSource->Prepare();
        $p_app_roleForm->EditMode = $p_app_roleForm->DataSource->AllParametersSet;
        
   }
// End Bdr    
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_app_role_id->GetValue()== $selected_id) {
    	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
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
  
//Close p_app_roleGrid_BeforeShowRow @2-FC853FBA
    return $p_app_roleGrid_BeforeShowRow;
}
//End Close p_app_roleGrid_BeforeShowRow

//p_app_roleGrid_BeforeShow @2-8D22FCA1
function p_app_roleGrid_BeforeShow(& $sender)
{
    $p_app_roleGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_roleGrid; //Compatibility
//End p_app_roleGrid_BeforeShow

//Custom Code @94-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_app_roleGrid_BeforeShow @2-321E5053
    return $p_app_roleGrid_BeforeShow;
}
//End Close p_app_roleGrid_BeforeShow

//p_app_roleGrid_BeforeSelect @2-11A8F98F
function p_app_roleGrid_BeforeSelect(& $sender)
{
    $p_app_roleGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_roleGrid; //Compatibility
//End p_app_roleGrid_BeforeSelect

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_app_roleGrid_BeforeSelect @2-55295675
    return $p_app_roleGrid_BeforeSelect;
}
//End Close p_app_roleGrid_BeforeSelect

//p_app_roleForm_BeforeShow @23-5B7BEC50
function p_app_roleForm_BeforeShow(& $sender)
{
    $p_app_roleForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_roleForm; //Compatibility
//End p_app_roleForm_BeforeShow

//Custom Code @91-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_app_roleForm_BeforeShow @23-6E152126
    return $p_app_roleForm_BeforeShow;
}
//End Close p_app_roleForm_BeforeShow

//Page_OnInitializeView @1-5960267F
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_role; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_app_role_id", $selected_id);
    
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

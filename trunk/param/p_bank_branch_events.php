<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-7F2EBFD6
function BindEvents()
{
    global $p_app_user_roleGrid;
    global $CCSEvents;
    $p_app_user_roleGrid->CCSEvents["BeforeShowRow"] = "p_app_user_roleGrid_BeforeShowRow";
    $p_app_user_roleGrid->CCSEvents["BeforeSelect"] = "p_app_user_roleGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_app_user_roleGrid_BeforeShowRow @3-2383D6AA
function p_app_user_roleGrid_BeforeShowRow(& $sender)
{
    $p_app_user_roleGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_user_roleGrid; //Compatibility
//End p_app_user_roleGrid_BeforeShowRow
// Start Bdr
    global $p_app_user_roleForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_bank_branch_id->GetValue();
        $p_app_user_roleForm->DataSource->Parameters["urlp_bank_branch_id"] = $selected_id;
        $p_app_user_roleForm->DataSource->Prepare();
        $p_app_user_roleForm->EditMode = $p_app_user_roleForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr
//Set Row Style @11-982C9472
    $styles = array("Row", "AltRow");
		// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_bank_branch_id->GetValue()== $selected_id) {
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
//Close p_app_user_roleGrid_BeforeShowRow @3-7D327951
    return $p_app_user_roleGrid_BeforeShowRow;
}
//End Close p_app_user_roleGrid_BeforeShowRow

//p_app_user_roleGrid_BeforeSelect @3-17D867AD
function p_app_user_roleGrid_BeforeSelect(& $sender)
{
    $p_app_user_roleGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_user_roleGrid; //Compatibility
//End p_app_user_roleGrid_BeforeSelect

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_app_user_roleGrid_BeforeSelect @3-5C7970A1
    return $p_app_user_roleGrid_BeforeSelect;
}
//End Close p_app_user_roleGrid_BeforeSelect

//Page_OnInitializeView @1-8614B984
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_bank_branch; //Compatibility
//End Page_OnInitializeView

//Custom Code @51-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_bank_branch_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-3FD6163F
function BindEvents()
{
    global $p_app_role_menuGrid;
    global $CCSEvents;
    $p_app_role_menuGrid->CCSEvents["BeforeShowRow"] = "p_app_role_menuGrid_BeforeShowRow";
    $p_app_role_menuGrid->CCSEvents["BeforeSelect"] = "p_app_role_menuGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_app_role_menuGrid_BeforeShowRow @3-208B0CD1
function p_app_role_menuGrid_BeforeShowRow(& $sender)
{
    $p_app_role_menuGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_role_menuGrid; //Compatibility
//End p_app_role_menuGrid_BeforeShowRow

// Start Bdr
    global $p_app_role_menuForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_app_role_menu_id->GetValue();
        $p_app_role_menuForm->DataSource->Parameters["urlp_app_role_menu_id"] = $selected_id;
        $p_app_role_menuForm->DataSource->Prepare();
        $p_app_role_menuForm->EditMode = $p_app_role_menuForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr
//Set Row Style @11-982C9472
    $styles = array("Row", "AltRow");
		// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->p_app_role_menu_id->GetValue()== $selected_id) {
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

//Close p_app_role_menuGrid_BeforeShowRow @3-55096F62
    return $p_app_role_menuGrid_BeforeShowRow;
}
//End Close p_app_role_menuGrid_BeforeShowRow

//p_app_role_menuGrid_BeforeSelect @3-05314145
function p_app_role_menuGrid_BeforeSelect(& $sender)
{
    $p_app_role_menuGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_role_menuGrid; //Compatibility
//End p_app_role_menuGrid_BeforeSelect

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_app_role_menuGrid_BeforeSelect @3-65D7DD99
    return $p_app_role_menuGrid_BeforeSelect;
}
//End Close p_app_role_menuGrid_BeforeSelect

//Page_OnInitializeView @1-810401E3
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_role_menu; //Compatibility
//End Page_OnInitializeView

//Custom Code @51-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_app_role_menu_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

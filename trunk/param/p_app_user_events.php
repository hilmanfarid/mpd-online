<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-90979993
function BindEvents()
{
    global $p_app_userGrid;
    global $CCSEvents;
    $p_app_userGrid->CCSEvents["BeforeShowRow"] = "p_app_userGrid_BeforeShowRow";
    $p_app_userGrid->CCSEvents["BeforeSelect"] = "p_app_userGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_app_userGrid_BeforeShowRow @2-071F6067
function p_app_userGrid_BeforeShowRow(& $sender)
{
    $p_app_userGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_userGrid; //Compatibility
//End p_app_userGrid_BeforeShowRow
// Start Bdr
    global $p_app_userForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_app_user_id->GetValue();
        $p_app_userForm->DataSource->Parameters["urlp_app_user_id"] = $selected_id;
        $p_app_userForm->DataSource->Prepare();
        $p_app_userForm->EditMode = $p_app_userForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_app_user_id->GetValue()== $selected_id) {
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

//Close p_app_userGrid_BeforeShowRow @2-4062BA40
    return $p_app_userGrid_BeforeShowRow;
}
//End Close p_app_userGrid_BeforeShowRow

//p_app_userGrid_BeforeSelect @2-6EFA87A6
function p_app_userGrid_BeforeSelect(& $sender)
{
    $p_app_userGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_userGrid; //Compatibility
//End p_app_userGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_app_userGrid_BeforeSelect @2-D42FB6C4
    return $p_app_userGrid_BeforeSelect;
}
//End Close p_app_userGrid_BeforeSelect

//Page_OnInitializeView @1-846F565A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_app_user; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_app_user_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

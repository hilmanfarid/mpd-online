<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-20D183B5
function BindEvents()
{
    global $t_customer_userGrid;
    global $t_customer_userForm;
    global $CCSEvents;
    $t_customer_userGrid->CCSEvents["BeforeShowRow"] = "t_customer_userGrid_BeforeShowRow";
    $t_customer_userGrid->CCSEvents["BeforeShow"] = "t_customer_userGrid_BeforeShow";
    $t_customer_userGrid->CCSEvents["BeforeSelect"] = "t_customer_userGrid_BeforeSelect";
    $t_customer_userForm->CCSEvents["BeforeShow"] = "t_customer_userForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_customer_userGrid_BeforeShowRow @2-5549748C
function t_customer_userGrid_BeforeShowRow(& $sender)
{
    $t_customer_userGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_userGrid; //Compatibility
//End t_customer_userGrid_BeforeShowRow

// Start Bdr
    global $t_customer_userForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_customer_user_id->GetValue();
        $t_customer_userForm->DataSource->Parameters["urlt_customer_user_id"] = $selected_id;
        $t_customer_userForm->DataSource->Prepare();
        $t_customer_userForm->EditMode = $t_customer_userForm->DataSource->AllParametersSet;
        
   }
// End Bdr    
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_customer_user_id->GetValue()== $selected_id) {
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

//Close t_customer_userGrid_BeforeShowRow @2-D78A2698
    return $t_customer_userGrid_BeforeShowRow;
}
//End Close t_customer_userGrid_BeforeShowRow

//t_customer_userGrid_BeforeShow @2-3AC7DBEC
function t_customer_userGrid_BeforeShow(& $sender)
{
    $t_customer_userGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_userGrid; //Compatibility
//End t_customer_userGrid_BeforeShow

//Custom Code @94-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_customer_userGrid_BeforeShow @2-7791AEF4
    return $t_customer_userGrid_BeforeShow;
}
//End Close t_customer_userGrid_BeforeShow

//t_customer_userGrid_BeforeSelect @2-073AA3C1
function t_customer_userGrid_BeforeSelect(& $sender)
{
    $t_customer_userGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_userGrid; //Compatibility
//End t_customer_userGrid_BeforeSelect

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_customer_userGrid_BeforeSelect @2-EE6AE6CF
    return $t_customer_userGrid_BeforeSelect;
}
//End Close t_customer_userGrid_BeforeSelect

//t_customer_userForm_BeforeShow @23-93BEAE32
function t_customer_userForm_BeforeShow(& $sender)
{
    $t_customer_userForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_userForm; //Compatibility
//End t_customer_userForm_BeforeShow

//Custom Code @91-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_customer_userForm_BeforeShow @23-2B9ADF81
    return $t_customer_userForm_BeforeShow;
}
//End Close t_customer_userForm_BeforeShow

//Page_OnInitializeView @1-6AFA79CB
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_user; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_customer_user_id", $selected_id);
    
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

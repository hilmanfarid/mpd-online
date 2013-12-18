<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-523D79D0
function BindEvents()
{
    global $p_budget_accountGrid;
    global $CCSEvents;
    $p_budget_accountGrid->CCSEvents["BeforeShowRow"] = "p_budget_accountGrid_BeforeShowRow";
    $p_budget_accountGrid->CCSEvents["BeforeSelect"] = "p_budget_accountGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_budget_accountGrid_BeforeShowRow @2-3BD5DA4A
function p_budget_accountGrid_BeforeShowRow(& $sender)
{
    $p_budget_accountGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_budget_accountGrid; //Compatibility
//End p_budget_accountGrid_BeforeShowRow

// Start Bdr
    global $p_budget_accountForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_budget_account_id->GetValue();
        $p_budget_accountForm->DataSource->Parameters["urlp_budget_account_id"] = $selected_id;
        $p_budget_accountForm->DataSource->Prepare();
        $p_budget_accountForm->EditMode = $p_budget_accountForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_budget_account_id->GetValue()== $selected_id) {
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

//Close p_budget_accountGrid_BeforeShowRow @2-120CCF4F
    return $p_budget_accountGrid_BeforeShowRow;
}
//End Close p_budget_accountGrid_BeforeShowRow

//p_budget_accountGrid_BeforeSelect @2-68A2605A
function p_budget_accountGrid_BeforeSelect(& $sender)
{
    $p_budget_accountGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_budget_accountGrid; //Compatibility
//End p_budget_accountGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_budget_accountGrid_BeforeSelect @2-D2B88F77
    return $p_budget_accountGrid_BeforeSelect;
}
//End Close p_budget_accountGrid_BeforeSelect

//Page_OnInitializeView @1-1F4467F8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_budget_account; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_budget_account_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-9153FFCD
function BindEvents()
{
    global $p_organization_typeGrid;
    global $CCSEvents;
    $p_organization_typeGrid->CCSEvents["BeforeShowRow"] = "p_organization_typeGrid_BeforeShowRow";
    $p_organization_typeGrid->CCSEvents["BeforeSelect"] = "p_organization_typeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_organization_typeGrid_BeforeShowRow @2-D1604649
function p_organization_typeGrid_BeforeShowRow(& $sender)
{
    $p_organization_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_organization_typeGrid; //Compatibility
//End p_organization_typeGrid_BeforeShowRow

// Start Bdr
    global $p_organization_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_organization_type_id->GetValue();
        $p_organization_typeForm->DataSource->Parameters["urlp_organization_type_id"] = $selected_id;
        $p_organization_typeForm->DataSource->Prepare();
        $p_organization_typeForm->EditMode = $p_organization_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_organization_type_id->GetValue()== $selected_id) {
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

//Close p_organization_typeGrid_BeforeShowRow @2-807AD100
    return $p_organization_typeGrid_BeforeShowRow;
}
//End Close p_organization_typeGrid_BeforeShowRow

//p_organization_typeGrid_BeforeSelect @2-40D9F998
function p_organization_typeGrid_BeforeSelect(& $sender)
{
    $p_organization_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_organization_typeGrid; //Compatibility
//End p_organization_typeGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_organization_typeGrid_BeforeSelect @2-76285BBB
    return $p_organization_typeGrid_BeforeSelect;
}
//End Close p_organization_typeGrid_BeforeSelect

//Page_OnInitializeView @1-216B86EA
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_budget_organ; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_organization_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

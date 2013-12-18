<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-4CC580B5
function BindEvents()
{
    global $p_organizationGrid;
    global $CCSEvents;
    $p_organizationGrid->CCSEvents["BeforeShowRow"] = "p_organizationGrid_BeforeShowRow";
    $p_organizationGrid->CCSEvents["BeforeSelect"] = "p_organizationGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_organizationGrid_BeforeShowRow @2-BA72E269
function p_organizationGrid_BeforeShowRow(& $sender)
{
    $p_organizationGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_organizationGrid; //Compatibility
//End p_organizationGrid_BeforeShowRow

// Start Bdr
    global $p_organizationForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_organization_id->GetValue();
        $p_organizationForm->DataSource->Parameters["urlp_organization_id"] = $selected_id;
        $p_organizationForm->DataSource->Prepare();
        $p_organizationForm->EditMode = $p_organizationForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_organization_id->GetValue()== $selected_id) {
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

//Close p_organizationGrid_BeforeShowRow @2-8BA6AC2E
    return $p_organizationGrid_BeforeShowRow;
}
//End Close p_organizationGrid_BeforeShowRow

//p_organizationGrid_BeforeSelect @2-866EAE47
function p_organizationGrid_BeforeSelect(& $sender)
{
    $p_organizationGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_organizationGrid; //Compatibility
//End p_organizationGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_organizationGrid_BeforeSelect @2-718A5474
    return $p_organizationGrid_BeforeSelect;
}
//End Close p_organizationGrid_BeforeSelect

//Page_OnInitializeView @1-69A24B71
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_organization; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_organization_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

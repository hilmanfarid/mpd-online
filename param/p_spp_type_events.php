<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-22FA6355
function BindEvents()
{
    global $p_spp_typeGrid;
    global $CCSEvents;
    $p_spp_typeGrid->CCSEvents["BeforeShowRow"] = "p_spp_typeGrid_BeforeShowRow";
    $p_spp_typeGrid->CCSEvents["BeforeSelect"] = "p_spp_typeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_spp_typeGrid_BeforeShowRow @2-7DC24261
function p_spp_typeGrid_BeforeShowRow(& $sender)
{
    $p_spp_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_spp_typeGrid; //Compatibility
//End p_spp_typeGrid_BeforeShowRow

// Start Bdr
    global $p_spp_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_spp_type_id->GetValue();
        $p_spp_typeForm->DataSource->Parameters["urlp_spp_type_id"] = $selected_id;
        $p_spp_typeForm->DataSource->Prepare();
        $p_spp_typeForm->EditMode = $p_spp_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_spp_type_id->GetValue()== $selected_id) {
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

//Close p_spp_typeGrid_BeforeShowRow @2-F4214D77
    return $p_spp_typeGrid_BeforeShowRow;
}
//End Close p_spp_typeGrid_BeforeShowRow

//p_spp_typeGrid_BeforeSelect @2-4CD2990A
function p_spp_typeGrid_BeforeSelect(& $sender)
{
    $p_spp_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_spp_typeGrid; //Compatibility
//End p_spp_typeGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_spp_typeGrid_BeforeSelect @2-9C66B638
    return $p_spp_typeGrid_BeforeSelect;
}
//End Close p_spp_typeGrid_BeforeSelect

//Page_OnInitializeView @1-C7D71D93
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_spp_type; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_spp_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

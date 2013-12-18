<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-F397ADBF
function BindEvents()
{
    global $t_customerGrid;
    global $CCSEvents;
    $t_customerGrid->CCSEvents["BeforeShowRow"] = "t_customerGrid_BeforeShowRow";
    $t_customerGrid->CCSEvents["BeforeSelect"] = "t_customerGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_customerGrid_BeforeShowRow @2-75C38576
function t_customerGrid_BeforeShowRow(& $sender)
{
    $t_customerGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerGrid; //Compatibility
//End t_customerGrid_BeforeShowRow

// Start Bdr
    global $t_customer_updateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_customer_id->GetValue();
        $t_customer_updateForm->DataSource->Parameters["urlt_customer_id"] = $selected_id;
        $t_customer_updateForm->DataSource->Prepare();
        $t_customer_updateForm->EditMode = $t_customer_updateForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_customer_id->GetValue()== $selected_id) {
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

//Close t_customerGrid_BeforeShowRow @2-7E840202
    return $t_customerGrid_BeforeShowRow;
}
//End Close t_customerGrid_BeforeShowRow

//t_customerGrid_BeforeSelect @2-95E5E7C8
function t_customerGrid_BeforeSelect(& $sender)
{
    $t_customerGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerGrid; //Compatibility
//End t_customerGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_customerGrid_BeforeSelect @2-5CE02F23
    return $t_customerGrid_BeforeSelect;
}
//End Close t_customerGrid_BeforeSelect

//Page_OnInitializeView @1-2C5F6246
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_customer_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

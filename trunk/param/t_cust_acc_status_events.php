<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-D8E9268E
function BindEvents()
{
    global $t_cust_acc_statusGrid;
    global $CCSEvents;
    $t_cust_acc_statusGrid->CCSEvents["BeforeShowRow"] = "t_cust_acc_statusGrid_BeforeShowRow";
    $t_cust_acc_statusGrid->CCSEvents["BeforeSelect"] = "t_cust_acc_statusGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_cust_acc_statusGrid_BeforeShowRow @2-A600967D
function t_cust_acc_statusGrid_BeforeShowRow(& $sender)
{
    $t_cust_acc_statusGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_statusGrid; //Compatibility
//End t_cust_acc_statusGrid_BeforeShowRow

// Start Bdr
    global $t_cust_acc_statusForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_cust_acc_status_id->GetValue();
        $t_cust_acc_statusForm->DataSource->Parameters["urlt_cust_acc_status_id"] = $selected_id;
        $t_cust_acc_statusForm->DataSource->Prepare();
        $t_cust_acc_statusForm->EditMode = $t_cust_acc_statusForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_cust_acc_status_id->GetValue()== $selected_id) {
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

//Close t_cust_acc_statusGrid_BeforeShowRow @2-FDC49CFC
    return $t_cust_acc_statusGrid_BeforeShowRow;
}
//End Close t_cust_acc_statusGrid_BeforeShowRow

//t_cust_acc_statusGrid_BeforeSelect @2-089EF854
function t_cust_acc_statusGrid_BeforeSelect(& $sender)
{
    $t_cust_acc_statusGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_statusGrid; //Compatibility
//End t_cust_acc_statusGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_cust_acc_statusGrid_BeforeSelect @2-CFFB1634
    return $t_cust_acc_statusGrid_BeforeSelect;
}
//End Close t_cust_acc_statusGrid_BeforeSelect

//Page_OnInitializeView @1-6CB579AE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_acc_status; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_cust_acc_status_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-5216A774
function BindEvents()
{
    global $pengumumanGrid;
    global $CCSEvents;
    $pengumumanGrid->CCSEvents["BeforeShowRow"] = "pengumumanGrid_BeforeShowRow";
    $pengumumanGrid->CCSEvents["BeforeSelect"] = "pengumumanGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//pengumumanGrid_BeforeShowRow @3-4BB840E9
function pengumumanGrid_BeforeShowRow(& $sender)
{
    $pengumumanGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pengumumanGrid; //Compatibility
//End pengumumanGrid_BeforeShowRow

// Start Bdr
    global $pengumumanForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_w_broadcast_ctl_id->GetValue();
        $pengumumanForm->DataSource->Parameters["urlt_w_broadcast_ctl_id"] = $selected_id;
        $pengumumanForm->DataSource->Prepare();
        $pengumumanForm->EditMode = $pengumumanForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr
//Set Row Style @11-982C9472
    $styles = array("Row", "AltRow");
		// Start Bdr    
    $Style = $styles[0];
    
    if ($Component->DataSource->t_w_broadcast_ctl_id->GetValue()== $selected_id) {
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

//Close pengumumanGrid_BeforeShowRow @3-8407EE1B
    return $pengumumanGrid_BeforeShowRow;
}
//End Close pengumumanGrid_BeforeShowRow

//pengumumanGrid_BeforeSelect @3-52D07ACF
function pengumumanGrid_BeforeSelect(& $sender)
{
    $pengumumanGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pengumumanGrid; //Compatibility
//End pengumumanGrid_BeforeSelect

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close pengumumanGrid_BeforeSelect @3-D031553D
    return $pengumumanGrid_BeforeSelect;
}
//End Close pengumumanGrid_BeforeSelect

//Page_OnInitializeView @1-BE5E0B1E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_w_broadcast_ctl; //Compatibility
//End Page_OnInitializeView

//Custom Code @51-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_w_broadcast_ctl_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-37F2F49F
function BindEvents()
{
    global $p_journal_periodGrid;
    global $CCSEvents;
    $p_journal_periodGrid->CCSEvents["BeforeShowRow"] = "p_journal_periodGrid_BeforeShowRow";
    $p_journal_periodGrid->CCSEvents["BeforeShow"] = "p_journal_periodGrid_BeforeShow";
    $p_journal_periodGrid->CCSEvents["BeforeSelect"] = "p_journal_periodGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_journal_periodGrid_BeforeShowRow @2-BFB26F43
function p_journal_periodGrid_BeforeShowRow(& $sender)
{
    $p_journal_periodGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_journal_periodGrid; //Compatibility
//End p_journal_periodGrid_BeforeShowRow

	global $p_journal_periodForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_journal_period_id->GetValue();
        $p_journal_periodForm->DataSource->Parameters["urlp_journal_period_id"] = $selected_id;
        $p_journal_periodForm->DataSource->Prepare();
        $p_journal_periodForm->EditMode = $p_journal_periodForm->DataSource->AllParametersSet;
        
   }
//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->p_journal_period_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr   
    if (count($styles)) {
 //       $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	$Component->DLink->SetValue($img_radio);

//Close p_journal_periodGrid_BeforeShowRow @2-54EF30F1
    return $p_journal_periodGrid_BeforeShowRow;
}
//End Close p_journal_periodGrid_BeforeShowRow

//p_journal_periodGrid_BeforeShow @2-D58D7B57
function p_journal_periodGrid_BeforeShow(& $sender)
{
    $p_journal_periodGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_journal_periodGrid; //Compatibility
//End p_journal_periodGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_journal_periodGrid_BeforeShow @2-FB7FC6A3
    return $p_journal_periodGrid_BeforeShow;
}
//End Close p_journal_periodGrid_BeforeShow

//p_journal_periodGrid_BeforeSelect @2-CA63354F
function p_journal_periodGrid_BeforeSelect(& $sender)
{
    $p_journal_periodGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_journal_periodGrid; //Compatibility
//End p_journal_periodGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_journal_periodGrid_BeforeSelect @2-58F948D8
    return $p_journal_periodGrid_BeforeSelect;
}
//End Close p_journal_periodGrid_BeforeSelect

//Page_OnInitializeView @1-2FCF910C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_journal_period; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
  global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("p_journal_period_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

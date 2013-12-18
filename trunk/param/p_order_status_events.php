<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-CAE9DD3C
function BindEvents()
{
    global $p_order_statusGrid;
    global $CCSEvents;
    $p_order_statusGrid->CCSEvents["BeforeShowRow"] = "p_order_statusGrid_BeforeShowRow";
    $p_order_statusGrid->CCSEvents["BeforeSelect"] = "p_order_statusGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_order_statusGrid_BeforeShowRow @2-46CA5588
function p_order_statusGrid_BeforeShowRow(& $sender)
{
    $p_order_statusGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_order_statusGrid; //Compatibility
//End p_order_statusGrid_BeforeShowRow

// Start Bdr
    global $p_order_statusForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_order_status_id->GetValue();
        $p_order_statusForm->DataSource->Parameters["urlp_order_status_id"] = $selected_id;
        $p_order_statusForm->DataSource->Prepare();
        $p_order_statusForm->EditMode = $p_order_statusForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	  // Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_order_status_id->GetValue()== $selected_id) {
      	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
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
    $Component->DLink->SetValue($img_radio); // Bdr

//Close p_order_statusGrid_BeforeShowRow @2-B2E2C335
    return $p_order_statusGrid_BeforeShowRow;
}
//End Close p_order_statusGrid_BeforeShowRow

//p_order_statusGrid_BeforeSelect @2-5B042A0F
function p_order_statusGrid_BeforeSelect(& $sender)
{
    $p_order_statusGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_order_statusGrid; //Compatibility
//End p_order_statusGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	 $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------

//Close p_order_statusGrid_BeforeSelect @2-36568D97
    return $p_order_statusGrid_BeforeSelect;
}
//End Close p_order_statusGrid_BeforeSelect

//Page_OnInitializeView @1-F4356DFE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_order_status; //Compatibility
//End Page_OnInitializeView

//Custom Code @139-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_order_status_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

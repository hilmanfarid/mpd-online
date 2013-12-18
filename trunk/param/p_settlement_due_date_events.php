<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-B31B1B0E
function BindEvents()
{
    global $p_settlement_due_dateGrid;
    global $CCSEvents;
    $p_settlement_due_dateGrid->CCSEvents["BeforeShowRow"] = "p_settlement_due_dateGrid_BeforeShowRow";
    $p_settlement_due_dateGrid->CCSEvents["BeforeSelect"] = "p_settlement_due_dateGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_settlement_due_dateGrid_BeforeShowRow @2-BE0D7F87
function p_settlement_due_dateGrid_BeforeShowRow(& $sender)
{
    $p_settlement_due_dateGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_settlement_due_dateGrid; //Compatibility
//End p_settlement_due_dateGrid_BeforeShowRow
global $p_settlement_due_dateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_settlement_due_date_id->GetValue();
        $p_settlement_due_dateForm->DataSource->Parameters["urlp_settlement_due_date_id"] = $selected_id;
        $p_settlement_due_dateForm->DataSource->Prepare();
        $p_settlement_due_dateForm->EditMode = $p_settlement_due_dateForm->DataSource->AllParametersSet;
        
   }
      $styles = array("Row", "AltRow");
  	// Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_settlement_due_date_id->GetValue()== $selected_id) {
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

	$Component->DLink->SetValue($img_radio);
//Close p_settlement_due_dateGrid_BeforeShowRow @2-720C4A3B
    return $p_settlement_due_dateGrid_BeforeShowRow;
}
//End Close p_settlement_due_dateGrid_BeforeShowRow

//p_settlement_due_dateGrid_BeforeSelect @2-07877183
function p_settlement_due_dateGrid_BeforeSelect(& $sender)
{
    $p_settlement_due_dateGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_settlement_due_dateGrid; //Compatibility
//End p_settlement_due_dateGrid_BeforeSelect
  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------
//Close p_settlement_due_dateGrid_BeforeSelect @2-62B32EE8
    return $p_settlement_due_dateGrid_BeforeSelect;
}
//End Close p_settlement_due_dateGrid_BeforeSelect

//Page_OnInitializeView @1-6F0D1A31
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_settlement_due_date; //Compatibility
//End Page_OnInitializeView

  // -------------------------
    global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_settlement_due_date_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

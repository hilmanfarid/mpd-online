<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-C7E238F3
function BindEvents()
{
    global $p_finance_periodGrid;
    global $CCSEvents;
    $p_finance_periodGrid->CCSEvents["BeforeShowRow"] = "p_finance_periodGrid_BeforeShowRow";
    $p_finance_periodGrid->CCSEvents["BeforeSelect"] = "p_finance_periodGrid_BeforeSelect";
    $p_finance_periodGrid->CCSEvents["BeforeShow"] = "p_finance_periodGrid_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_finance_periodGrid_BeforeShowRow @2-B8540BE1
function p_finance_periodGrid_BeforeShowRow(& $sender)
{
    $p_finance_periodGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_finance_periodGrid; //Compatibility
//End p_finance_periodGrid_BeforeShowRow
global $p_finance_periodForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
        $p_finance_periodForm->DataSource->Parameters["urlp_finance_period_id"] = $selected_id;
        $p_finance_periodForm->DataSource->Prepare();
        $p_finance_periodForm->EditMode = $p_finance_periodForm->DataSource->AllParametersSet;
        
   }
      $styles = array("Row", "AltRow");
  	// Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_finance_period_id->GetValue()== $selected_id) {
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
//Close p_finance_periodGrid_BeforeShowRow @2-8FBBD82E
    return $p_finance_periodGrid_BeforeShowRow;
}
//End Close p_finance_periodGrid_BeforeShowRow

//p_finance_periodGrid_BeforeSelect @2-45189581
function p_finance_periodGrid_BeforeSelect(& $sender)
{
    $p_finance_periodGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_finance_periodGrid; //Compatibility
//End p_finance_periodGrid_BeforeSelect
  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------
//Close p_finance_periodGrid_BeforeSelect @2-B7D841F2
    return $p_finance_periodGrid_BeforeSelect;
}
//End Close p_finance_periodGrid_BeforeSelect

//p_finance_periodGrid_BeforeShow @2-B82EB472
function p_finance_periodGrid_BeforeShow(& $sender)
{
    $p_finance_periodGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_finance_periodGrid; //Compatibility
//End p_finance_periodGrid_BeforeShow

//Close p_finance_periodGrid_BeforeShow @2-36CAD4B5
    return $p_finance_periodGrid_BeforeShow;
}
//End Close p_finance_periodGrid_BeforeShow

//Page_OnInitializeView @1-4DDB14F9
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_finance_period; //Compatibility
//End Page_OnInitializeView

  // -------------------------
    global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_finance_period_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

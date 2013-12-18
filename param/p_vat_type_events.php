<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-F650DAC6
function BindEvents()
{
    global $p_vat_typeGrid;
    global $CCSEvents;
    $p_vat_typeGrid->CCSEvents["BeforeSelect"] = "p_vat_typeGrid_BeforeSelect";
    $p_vat_typeGrid->CCSEvents["BeforeShowRow"] = "p_vat_typeGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_vat_typeGrid_BeforeSelect @2-6F6B98F2
function p_vat_typeGrid_BeforeSelect(& $sender)
{
    $p_vat_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_typeGrid; //Compatibility
//End p_vat_typeGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close p_vat_typeGrid_BeforeSelect @2-25597128
    return $p_vat_typeGrid_BeforeSelect;
}
//End Close p_vat_typeGrid_BeforeSelect

//p_vat_typeGrid_BeforeShowRow @2-1EBFA0DD
function p_vat_typeGrid_BeforeShowRow(& $sender)
{
    $p_vat_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_typeGrid; //Compatibility
//End p_vat_typeGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Start Bdr
    global $p_vat_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_vat_type_id->GetValue();
        $p_vat_typeForm->DataSource->Parameters["urlp_vat_type_id"] = $selected_id;
        $p_vat_typeForm->DataSource->Prepare();
        $p_vat_typeForm->EditMode = $p_vat_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_vat_type_id->GetValue()== $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;
        }	
    // End Bdr  
      if (count($styles)) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	 $Component->DLink->SetValue($img_radio); // Bdr

//Close p_vat_typeGrid_BeforeShowRow @2-E92F62D4
    return $p_vat_typeGrid_BeforeShowRow;
}
//End Close p_vat_typeGrid_BeforeShowRow

//Page_OnInitializeView @1-E9541973
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_type; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_vat_type_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

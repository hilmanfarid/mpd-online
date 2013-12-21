<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-895CA5BD
function BindEvents()
{
    global $p_vat_type_dtlGrid;
    global $CCSEvents;
    $p_vat_type_dtlGrid->CCSEvents["BeforeSelect"] = "p_vat_type_dtlGrid_BeforeSelect";
    $p_vat_type_dtlGrid->CCSEvents["BeforeShowRow"] = "p_vat_type_dtlGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_vat_type_dtlGrid_BeforeSelect @2-42FC3AAB
function p_vat_type_dtlGrid_BeforeSelect(& $sender)
{
    $p_vat_type_dtlGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_type_dtlGrid; //Compatibility
//End p_vat_type_dtlGrid_BeforeSelect

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close p_vat_type_dtlGrid_BeforeSelect @2-B3306FBE
    return $p_vat_type_dtlGrid_BeforeSelect;
}
//End Close p_vat_type_dtlGrid_BeforeSelect

//p_vat_type_dtlGrid_BeforeShowRow @2-D66F8DCC
function p_vat_type_dtlGrid_BeforeShowRow(& $sender)
{
    $p_vat_type_dtlGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_type_dtlGrid; //Compatibility
//End p_vat_type_dtlGrid_BeforeShowRow

// Start Bdr
    global $p_vat_type_dtlForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_vat_type_dtl_id->GetValue();
        $p_vat_type_dtlForm->DataSource->Parameters["urlp_vat_type_dtl_id"] = $selected_id;
        $p_vat_type_dtlForm->DataSource->Prepare();
        $p_vat_type_dtlForm->EditMode = $p_vat_type_dtlForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_vat_type_dtl_id->GetValue()== $selected_id) {
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

//Close p_vat_type_dtlGrid_BeforeShowRow @2-F0D53DBB
    return $p_vat_type_dtlGrid_BeforeShowRow;
}
//End Close p_vat_type_dtlGrid_BeforeShowRow

//Page_OnInitializeView @1-8CC32FE7
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_type_dtl; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_vat_type_dtl_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

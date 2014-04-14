<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-796F838F
function BindEvents()
{
    global $p_vat_groupGrid;
    global $CCSEvents;
    $p_vat_groupGrid->CCSEvents["BeforeSelect"] = "p_vat_groupGrid_BeforeSelect";
    $p_vat_groupGrid->CCSEvents["BeforeShowRow"] = "p_vat_groupGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_vat_groupGrid_BeforeSelect @2-C1F57B46
function p_vat_groupGrid_BeforeSelect(& $sender)
{
    $p_vat_groupGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_groupGrid; //Compatibility
//End p_vat_groupGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close p_vat_groupGrid_BeforeSelect @2-7F7EB55F
    return $p_vat_groupGrid_BeforeSelect;
}
//End Close p_vat_groupGrid_BeforeSelect

//p_vat_groupGrid_BeforeShowRow @2-4969604B
function p_vat_groupGrid_BeforeShowRow(& $sender)
{
    $p_vat_groupGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_groupGrid; //Compatibility
//End p_vat_groupGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Start Bdr
    global $p_vat_groupForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_vat_group_id->GetValue();
        $p_vat_groupForm->DataSource->Parameters["urlp_vat_group_id"] = $selected_id;
        $p_vat_groupForm->DataSource->Prepare();
        $p_vat_groupForm->EditMode = $p_vat_groupForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_vat_group_id->GetValue()== $selected_id) {
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

//Close p_vat_groupGrid_BeforeShowRow @2-2714A18F
    return $p_vat_groupGrid_BeforeShowRow;
}
//End Close p_vat_groupGrid_BeforeShowRow

//Page_OnInitializeView @1-6D8C0C88
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_group; //Compatibility
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
        $selected_id=CCGetFromGet("p_vat_group_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

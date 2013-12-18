<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-EB7F7489
function BindEvents()
{
    global $p_vat_penaltyGrid;
    global $p_vat_penaltyForm;
    global $CCSEvents;
    $p_vat_penaltyGrid->CCSEvents["BeforeSelect"] = "p_vat_penaltyGrid_BeforeSelect";
    $p_vat_penaltyGrid->CCSEvents["BeforeShowRow"] = "p_vat_penaltyGrid_BeforeShowRow";
    $p_vat_penaltyForm->CCSEvents["BeforeShow"] = "p_vat_penaltyForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_vat_penaltyGrid_BeforeSelect @2-1DBB54A1
function p_vat_penaltyGrid_BeforeSelect(& $sender)
{
    $p_vat_penaltyGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_penaltyGrid; //Compatibility
//End p_vat_penaltyGrid_BeforeSelect

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close p_vat_penaltyGrid_BeforeSelect @2-D9739518
    return $p_vat_penaltyGrid_BeforeSelect;
}
//End Close p_vat_penaltyGrid_BeforeSelect

//p_vat_penaltyGrid_BeforeShowRow @2-9E778D46
function p_vat_penaltyGrid_BeforeShowRow(& $sender)
{
    $p_vat_penaltyGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_penaltyGrid; //Compatibility
//End p_vat_penaltyGrid_BeforeShowRow

// Start Bdr
    global $p_vat_penaltyForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_vat_penalty_id->GetValue();
        $p_vat_penaltyForm->DataSource->Parameters["urlp_vat_penalty_id"] = $selected_id;
        $p_vat_penaltyForm->DataSource->Prepare();
        $p_vat_penaltyForm->EditMode = $p_vat_penaltyForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_vat_penalty_id->GetValue()== $selected_id) {
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

//Close p_vat_penaltyGrid_BeforeShowRow @2-CF0A789C
    return $p_vat_penaltyGrid_BeforeShowRow;
}
//End Close p_vat_penaltyGrid_BeforeShowRow

//p_vat_penaltyForm_BeforeShow @23-D654B64F
function p_vat_penaltyForm_BeforeShow(& $sender)
{
    $p_vat_penaltyForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_penaltyForm; //Compatibility
//End p_vat_penaltyForm_BeforeShow
	
//Close p_vat_penaltyForm_BeforeShow @23-02A09FBF
    return $p_vat_penaltyForm_BeforeShow;
}
//End Close p_vat_penaltyForm_BeforeShow

//Page_OnInitializeView @1-F3FD00CA
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_vat_penalty; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_vat_penalty_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

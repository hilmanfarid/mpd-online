<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-BFE85277
function BindEvents()
{
    global $p_parking_classificationGrid;
    global $CCSEvents;
    $p_parking_classificationGrid->CCSEvents["BeforeShowRow"] = "p_parking_classificationGrid_BeforeShowRow";
    $p_parking_classificationGrid->CCSEvents["BeforeSelect"] = "p_parking_classificationGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_parking_classificationGrid_BeforeShowRow @2-2B428E7F
function p_parking_classificationGrid_BeforeShowRow(& $sender)
{
    $p_parking_classificationGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_parking_classificationGrid; //Compatibility
//End p_parking_classificationGrid_BeforeShowRow

// Start Bdr
    global $p_parking_classificationForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_parking_classification_id->GetValue();
        $p_parking_classificationForm->DataSource->Parameters["urlp_parking_classification_id"] = $selected_id;
        $p_parking_classificationForm->DataSource->Prepare();
        $p_parking_classificationForm->EditMode = $p_parking_classificationForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_parking_classification_id->GetValue()== $selected_id) {
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
//End Set Row Style
	 $Component->DLink->SetValue($img_radio); // Bdr

//Close p_parking_classificationGrid_BeforeShowRow @2-EA4A5C77
    return $p_parking_classificationGrid_BeforeShowRow;
}
//End Close p_parking_classificationGrid_BeforeShowRow

//p_parking_classificationGrid_BeforeSelect @2-1A6E5574
function p_parking_classificationGrid_BeforeSelect(& $sender)
{
    $p_parking_classificationGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_parking_classificationGrid; //Compatibility
//End p_parking_classificationGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_parking_classificationGrid_BeforeSelect @2-F685DEAA
    return $p_parking_classificationGrid_BeforeSelect;
}
//End Close p_parking_classificationGrid_BeforeSelect

//Page_OnInitializeView @1-F4626456
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_parking_classification; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_parking_classification_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

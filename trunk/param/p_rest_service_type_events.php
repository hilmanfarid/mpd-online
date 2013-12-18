<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-B3AABC72
function BindEvents()
{
    global $p_rest_service_typeGrid;
    global $CCSEvents;
    $p_rest_service_typeGrid->CCSEvents["BeforeShowRow"] = "p_rest_service_typeGrid_BeforeShowRow";
    $p_rest_service_typeGrid->CCSEvents["BeforeSelect"] = "p_rest_service_typeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_rest_service_typeGrid_BeforeShowRow @2-B679FA2A
function p_rest_service_typeGrid_BeforeShowRow(& $sender)
{
    $p_rest_service_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_rest_service_typeGrid; //Compatibility
//End p_rest_service_typeGrid_BeforeShowRow

// Start Bdr
    global $p_rest_service_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_rest_service_type_id->GetValue();
        $p_rest_service_typeForm->DataSource->Parameters["urlp_rest_service_type_id"] = $selected_id;
        $p_rest_service_typeForm->DataSource->Prepare();
        $p_rest_service_typeForm->EditMode = $p_rest_service_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_rest_service_type_id->GetValue()== $selected_id) {
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

//Close p_rest_service_typeGrid_BeforeShowRow @2-3FB07948
    return $p_rest_service_typeGrid_BeforeShowRow;
}
//End Close p_rest_service_typeGrid_BeforeShowRow

//p_rest_service_typeGrid_BeforeSelect @2-3CB289E2
function p_rest_service_typeGrid_BeforeSelect(& $sender)
{
    $p_rest_service_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_rest_service_typeGrid; //Compatibility
//End p_rest_service_typeGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_rest_service_typeGrid_BeforeSelect @2-6CE10588
    return $p_rest_service_typeGrid_BeforeSelect;
}
//End Close p_rest_service_typeGrid_BeforeSelect

//Page_OnInitializeView @1-C425479E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_rest_service_type; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_rest_service_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

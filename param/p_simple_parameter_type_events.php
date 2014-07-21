<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-EB4B9ED8
function BindEvents()
{
    global $p_simple_parameter_typeGrid;
    global $CCSEvents;
    $p_simple_parameter_typeGrid->CCSEvents["BeforeSelect"] = "p_simple_parameter_typeGrid_BeforeSelect";
    $p_simple_parameter_typeGrid->CCSEvents["BeforeShowRow"] = "p_simple_parameter_typeGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_simple_parameter_typeGrid_BeforeSelect @2-4434E58E
function p_simple_parameter_typeGrid_BeforeSelect(& $sender)
{
    $p_simple_parameter_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_simple_parameter_typeGrid; //Compatibility
//End p_simple_parameter_typeGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close p_simple_parameter_typeGrid_BeforeSelect @2-545D4496
    return $p_simple_parameter_typeGrid_BeforeSelect;
}
//End Close p_simple_parameter_typeGrid_BeforeSelect

//p_simple_parameter_typeGrid_BeforeShowRow @2-900EF8C4
function p_simple_parameter_typeGrid_BeforeShowRow(& $sender)
{
    $p_simple_parameter_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_simple_parameter_typeGrid; //Compatibility
//End p_simple_parameter_typeGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Start Bdr
    global $p_simple_parameter_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_simple_parameter_type_id->GetValue();
        $p_simple_parameter_typeForm->DataSource->Parameters["urlp_simple_parameter_type_id"] = $selected_id;
        $p_simple_parameter_typeForm->DataSource->Prepare();
        $p_simple_parameter_typeForm->EditMode = $p_simple_parameter_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_simple_parameter_type_id->GetValue()== $selected_id) {
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

//Close p_simple_parameter_typeGrid_BeforeShowRow @2-C587F86A
    return $p_simple_parameter_typeGrid_BeforeShowRow;
}
//End Close p_simple_parameter_typeGrid_BeforeShowRow

//Page_OnInitializeView @1-0341523C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_simple_parameter_type; //Compatibility
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
        $selected_id=CCGetFromGet("p_simple_parameter_type_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

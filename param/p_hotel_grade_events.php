<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-BB8C42AE
function BindEvents()
{
    global $p_hotel_gradeGrid;
    global $CCSEvents;
    $p_hotel_gradeGrid->CCSEvents["BeforeShowRow"] = "p_hotel_gradeGrid_BeforeShowRow";
    $p_hotel_gradeGrid->CCSEvents["BeforeSelect"] = "p_hotel_gradeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_hotel_gradeGrid_BeforeShowRow @2-04AD6CC4
function p_hotel_gradeGrid_BeforeShowRow(& $sender)
{
    $p_hotel_gradeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_hotel_gradeGrid; //Compatibility
//End p_hotel_gradeGrid_BeforeShowRow

// Start Bdr
    global $p_hotel_gradeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_hotel_grade_id->GetValue();
        $p_hotel_gradeForm->DataSource->Parameters["urlp_hotel_grade_id"] = $selected_id;
        $p_hotel_gradeForm->DataSource->Prepare();
        $p_hotel_gradeForm->EditMode = $p_hotel_gradeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_hotel_grade_id->GetValue()== $selected_id) {
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

//Close p_hotel_gradeGrid_BeforeShowRow @2-9A23E65C
    return $p_hotel_gradeGrid_BeforeShowRow;
}
//End Close p_hotel_gradeGrid_BeforeShowRow

//p_hotel_gradeGrid_BeforeSelect @2-079D6485
function p_hotel_gradeGrid_BeforeSelect(& $sender)
{
    $p_hotel_gradeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_hotel_gradeGrid; //Compatibility
//End p_hotel_gradeGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_hotel_gradeGrid_BeforeSelect @2-F5CB7AAF
    return $p_hotel_gradeGrid_BeforeSelect;
}
//End Close p_hotel_gradeGrid_BeforeSelect

//Page_OnInitializeView @1-EA44A3DE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_hotel_grade; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_hotel_grade_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

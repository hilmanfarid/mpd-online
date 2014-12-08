<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-524F4A1D
function BindEvents()
{
    global $t_ppatGrid;
    global $CCSEvents;
    $t_ppatGrid->CCSEvents["BeforeSelect"] = "t_ppatGrid_BeforeSelect";
    $t_ppatGrid->CCSEvents["BeforeShowRow"] = "t_ppatGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_ppatGrid_BeforeSelect @2-2236C6D0
function t_ppatGrid_BeforeSelect(& $sender)
{
    $t_ppatGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_ppatGrid; //Compatibility
//End t_ppatGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_ppatGrid_BeforeSelect @2-D9B5983D
    return $t_ppatGrid_BeforeSelect;
}
//End Close t_ppatGrid_BeforeSelect

//t_ppatGrid_BeforeShowRow @2-5A3DCF3B
function t_ppatGrid_BeforeShowRow(& $sender)
{
    $t_ppatGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_ppatGrid; //Compatibility
//End t_ppatGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Start Bdr
    global $t_ppatForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_bphtb_lembar_kendali_id->GetValue();
        $t_ppatForm->DataSource->Parameters["urlt_bphtb_lembar_kendali_id"] = $selected_id;
        $t_ppatForm->DataSource->Prepare();
        $t_ppatForm->EditMode = $t_ppatForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->t_bphtb_lembar_kendali_id->GetValue()== $selected_id) {
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

//Close t_ppatGrid_BeforeShowRow @2-840E6AD6
    return $t_ppatGrid_BeforeShowRow;
}
//End Close t_ppatGrid_BeforeShowRow

//Page_OnInitializeView @1-88831248
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_lembar_kendali; //Compatibility
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
        $selected_id=CCGetFromGet("t_bphtb_lembar_kendali_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

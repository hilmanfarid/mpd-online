<?php
//BindEvents Method @1-A40C609E
function BindEvents()
{
    global $t_customer_updateGrid;
    global $CCSEvents;
    $t_customer_updateGrid->CCSEvents["BeforeShowRow"] = "t_customer_updateGrid_BeforeShowRow";
    $t_customer_updateGrid->CCSEvents["BeforeSelect"] = "t_customer_updateGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_customer_updateGrid_BeforeShowRow @2-1A0C071B
function t_customer_updateGrid_BeforeShowRow(& $sender)
{
    $t_customer_updateGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_updateGrid; //Compatibility
//End t_customer_updateGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

// Start Bdr
    global $t_customer_updateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_customer_id->GetValue();
        $t_customer_updateForm->DataSource->Parameters["urlt_customer_id"] = $selected_id;
        $t_customer_updateForm->DataSource->Prepare();
        $t_customer_updateForm->EditMode = $t_customer_updateForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

      $styles = array("Row", "AltRow");
  // Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_customer_id->GetValue()== $selected_id) {
      	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
          $Style = $styles[1];
          $is_show_form=1;
      }	
  // End Bdr    
  
      if (count($styles)) {
  //        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

    $Component->DLink->SetValue($img_radio); // Bdr

//Close t_customer_updateGrid_BeforeShowRow @2-4AA4B12B
    return $t_customer_updateGrid_BeforeShowRow;
}
//End Close t_customer_updateGrid_BeforeShowRow

//t_customer_updateGrid_BeforeSelect @2-F97A9CB7
function t_customer_updateGrid_BeforeSelect(& $sender)
{
    $t_customer_updateGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_updateGrid; //Compatibility
//End t_customer_updateGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_customer_updateGrid_BeforeSelect @2-128AFA4A
    return $t_customer_updateGrid_BeforeSelect;
}
//End Close t_customer_updateGrid_BeforeSelect

//Page_OnInitializeView @1-5D7DE98F
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_update; //Compatibility
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
      $selected_id=CCGetFromGet("t_customer_id", $selected_id);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-289E2A17
function BindEvents()
{
    global $t_cust_order_legal_docGrid;
    global $CCSEvents;
    $t_cust_order_legal_docGrid->CCSEvents["BeforeShowRow"] = "t_cust_order_legal_docGrid_BeforeShowRow";
    $t_cust_order_legal_docGrid->CCSEvents["BeforeSelect"] = "t_cust_order_legal_docGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_cust_order_legal_docGrid_BeforeShowRow @2-A1499A7C
function t_cust_order_legal_docGrid_BeforeShowRow(& $sender)
{
    $t_cust_order_legal_docGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_order_legal_docGrid; //Compatibility
//End t_cust_order_legal_docGrid_BeforeShowRow

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
    global $t_cust_order_legal_docForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_cust_order_legal_doc_id->GetValue();
        $t_cust_order_legal_docForm->DataSource->Parameters["urlt_cust_order_legal_doc_id"] = $selected_id;
        $t_cust_order_legal_docForm->DataSource->Prepare();
        $t_cust_order_legal_docForm->EditMode = $t_cust_order_legal_docForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

      $styles = array("Row", "AltRow");
  // Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_cust_order_legal_doc_id->GetValue()== $selected_id) {
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

//Close t_cust_order_legal_docGrid_BeforeShowRow @2-55753697
    return $t_cust_order_legal_docGrid_BeforeShowRow;
}
//End Close t_cust_order_legal_docGrid_BeforeShowRow

//t_cust_order_legal_docGrid_BeforeSelect @2-F5794C06
function t_cust_order_legal_docGrid_BeforeSelect(& $sender)
{
    $t_cust_order_legal_docGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_order_legal_docGrid; //Compatibility
//End t_cust_order_legal_docGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_cust_order_legal_docGrid_BeforeSelect @2-198E2899
    return $t_cust_order_legal_docGrid_BeforeSelect;
}
//End Close t_cust_order_legal_docGrid_BeforeSelect

//Page_OnInitializeView @1-47619327
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_order_legal_doc_ro_ver_executive_summary_kadis; //Compatibility
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
      $selected_id=CCGetFromGet("t_cust_order_legal_doc_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-17D3544B
function BindEvents()
{
    global $t_custAccountGrid;
    global $t_cust_account_updateForm;
    global $CCSEvents;
    $t_custAccountGrid->CCSEvents["BeforeShowRow"] = "t_custAccountGrid_BeforeShowRow";
    $t_custAccountGrid->CCSEvents["BeforeSelect"] = "t_custAccountGrid_BeforeSelect";
    $t_cust_account_updateForm->CCSEvents["BeforeSelect"] = "t_cust_account_updateForm_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_custAccountGrid_BeforeShowRow @2-89E3060F
function t_custAccountGrid_BeforeShowRow(& $sender)
{
    $t_custAccountGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_custAccountGrid; //Compatibility
//End t_custAccountGrid_BeforeShowRow

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
    global $t_cust_account_updateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_cust_account_id->GetValue();
        $t_cust_account_updateForm->DataSource->Parameters["urlt_cust_account_id"] = $selected_id;
        $t_cust_account_updateForm->DataSource->Prepare();
        $t_cust_account_updateForm->EditMode = $t_cust_account_updateForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

      $styles = array("Row", "AltRow");
  // Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_cust_account_id->GetValue()== $selected_id) {
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

//Close t_custAccountGrid_BeforeShowRow @2-2A4E10AA
    return $t_custAccountGrid_BeforeShowRow;
}
//End Close t_custAccountGrid_BeforeShowRow

//t_custAccountGrid_BeforeSelect @2-F5F352F2
function t_custAccountGrid_BeforeSelect(& $sender)
{
    $t_custAccountGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_custAccountGrid; //Compatibility
//End t_custAccountGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_custAccountGrid_BeforeSelect @2-48A5AED5
    return $t_custAccountGrid_BeforeSelect;
}
//End Close t_custAccountGrid_BeforeSelect

//t_cust_account_updateForm_BeforeSelect @94-F45578FF
function t_cust_account_updateForm_BeforeSelect(& $sender)
{
    $t_cust_account_updateForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_account_updateForm; //Compatibility
//End t_cust_account_updateForm_BeforeSelect

//Custom Code @618-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_cust_account_updateForm_BeforeSelect @94-BFFFA0C9
    return $t_cust_account_updateForm_BeforeSelect;
}
//End Close t_cust_account_updateForm_BeforeSelect

//Page_OnInitializeView @1-FC3F9B5F
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_account_update; //Compatibility
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
      $selected_id=CCGetFromGet("t_cust_account_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

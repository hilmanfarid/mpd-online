<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-EE0EF25A
function BindEvents()
{
    global $v_t_revenue_targetGrid;
    global $CCSEvents;
    $v_t_revenue_targetGrid->CCSEvents["BeforeShowRow"] = "v_t_revenue_targetGrid_BeforeShowRow";
    $v_t_revenue_targetGrid->CCSEvents["BeforeShow"] = "v_t_revenue_targetGrid_BeforeShow";
    $v_t_revenue_targetGrid->CCSEvents["BeforeSelect"] = "v_t_revenue_targetGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//v_t_revenue_targetGrid_BeforeShowRow @2-3E1D8604
function v_t_revenue_targetGrid_BeforeShowRow(& $sender)
{
    $v_t_revenue_targetGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_t_revenue_targetGrid; //Compatibility
//End v_t_revenue_targetGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style	

	global $v_t_revenue_targetForm;	
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_revenue_target_id->GetValue();
        $v_t_revenue_targetForm->DataSource->Parameters["urlt_revenue_target_id"] = $selected_id;
        $v_t_revenue_targetForm->DataSource->Prepare();
        $v_t_revenue_targetForm->EditMode = $v_t_revenue_targetForm->DataSource->AllParametersSet;
        
   }
      $styles = array("Row", "AltRow");
  	// Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_revenue_target_id->GetValue()== $selected_id) {
      	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
          $Style = $styles[1];
          $is_show_form=1;
      }	
  // End Bdr   
      if (count($styles)) {
   //       $Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	$Component->DLink->SetValue($img_radio);

//Close v_t_revenue_targetGrid_BeforeShowRow @2-D4F874B5
    return $v_t_revenue_targetGrid_BeforeShowRow;
}
//End Close v_t_revenue_targetGrid_BeforeShowRow

//v_t_revenue_targetGrid_BeforeShow @2-158486F6
function v_t_revenue_targetGrid_BeforeShow(& $sender)
{
    $v_t_revenue_targetGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_t_revenue_targetGrid; //Compatibility
//End v_t_revenue_targetGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close v_t_revenue_targetGrid_BeforeShow @2-A7CCA650
    return $v_t_revenue_targetGrid_BeforeShow;
}
//End Close v_t_revenue_targetGrid_BeforeShow

//v_t_revenue_targetGrid_BeforeSelect @2-79892822
function v_t_revenue_targetGrid_BeforeSelect(& $sender)
{
    $v_t_revenue_targetGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_t_revenue_targetGrid; //Compatibility
//End v_t_revenue_targetGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close v_t_revenue_targetGrid_BeforeSelect @2-2ADAC74D
    return $v_t_revenue_targetGrid_BeforeSelect;
}
//End Close v_t_revenue_targetGrid_BeforeSelect

//Page_OnInitializeView @1-DF00DDE8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_revenue_target; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
    global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("t_revenue_target_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

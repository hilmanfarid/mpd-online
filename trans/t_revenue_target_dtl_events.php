<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-C86F383E
function BindEvents()
{
    global $v_t_revenue_target_dtlGrid;
    global $CCSEvents;
    $v_t_revenue_target_dtlGrid->CCSEvents["BeforeShowRow"] = "v_t_revenue_target_dtlGrid_BeforeShowRow";
    $v_t_revenue_target_dtlGrid->CCSEvents["BeforeShow"] = "v_t_revenue_target_dtlGrid_BeforeShow";
    $v_t_revenue_target_dtlGrid->CCSEvents["BeforeSelect"] = "v_t_revenue_target_dtlGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//v_t_revenue_target_dtlGrid_BeforeShowRow @2-A722278F
function v_t_revenue_target_dtlGrid_BeforeShowRow(& $sender)
{
    $v_t_revenue_target_dtlGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_t_revenue_target_dtlGrid; //Compatibility
//End v_t_revenue_target_dtlGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style	

	global $v_t_revenue_target_dtlForm;	
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_revenue_target_dtl_id->GetValue();
        $v_t_revenue_target_dtlForm->DataSource->Parameters["urlt_revenue_target_dtl_id"] = $selected_id;
        $v_t_revenue_target_dtlForm->DataSource->Prepare();
        $v_t_revenue_target_dtlForm->EditMode = $v_t_revenue_target_dtlForm->DataSource->AllParametersSet;
        
   }
      $styles = array("Row", "AltRow");
  	// Start Bdr    
      $img_radio= "<img border='0' src='../images/radio.gif'>";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_revenue_target_dtl_id->GetValue()== $selected_id) {
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

//Close v_t_revenue_target_dtlGrid_BeforeShowRow @2-FDF56DD6
    return $v_t_revenue_target_dtlGrid_BeforeShowRow;
}
//End Close v_t_revenue_target_dtlGrid_BeforeShowRow

//v_t_revenue_target_dtlGrid_BeforeShow @2-ED85C6ED
function v_t_revenue_target_dtlGrid_BeforeShow(& $sender)
{
    $v_t_revenue_target_dtlGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_t_revenue_target_dtlGrid; //Compatibility
//End v_t_revenue_target_dtlGrid_BeforeShow

//Custom Code @95-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close v_t_revenue_target_dtlGrid_BeforeShow @2-07063100
    return $v_t_revenue_target_dtlGrid_BeforeShow;
}
//End Close v_t_revenue_target_dtlGrid_BeforeShow

//v_t_revenue_target_dtlGrid_BeforeSelect @2-821AFF78
function v_t_revenue_target_dtlGrid_BeforeSelect(& $sender)
{
    $v_t_revenue_target_dtlGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $v_t_revenue_target_dtlGrid; //Compatibility
//End v_t_revenue_target_dtlGrid_BeforeSelect

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close v_t_revenue_target_dtlGrid_BeforeSelect @2-FE0A3C34
    return $v_t_revenue_target_dtlGrid_BeforeSelect;
}
//End Close v_t_revenue_target_dtlGrid_BeforeSelect

//Page_OnInitializeView @1-61497A17
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_revenue_target_dtl; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
    global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("t_revenue_target_dtl_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

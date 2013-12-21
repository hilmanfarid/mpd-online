<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-5CD3D3D0
function BindEvents()
{
    global $p_regionGrid;
    global $p_regionForm;
    global $CCSEvents;
    $p_regionGrid->CCSEvents["BeforeShowRow"] = "p_regionGrid_BeforeShowRow";
    $p_regionGrid->CCSEvents["BeforeShow"] = "p_regionGrid_BeforeShow";
    $p_regionGrid->CCSEvents["BeforeSelect"] = "p_regionGrid_BeforeSelect";
    $p_regionForm->CCSEvents["BeforeShow"] = "p_regionForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_regionGrid_BeforeShowRow @2-84F30CDA
function p_regionGrid_BeforeShowRow(& $sender)
{
    $p_regionGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_regionGrid; //Compatibility
//End p_regionGrid_BeforeShowRow

// Start Bdr
    global $p_regionForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_region_id->GetValue();
        $p_regionForm->DataSource->Parameters["urlp_region_id"] = $selected_id;
        $p_regionForm->DataSource->Prepare();
        $p_regionForm->EditMode = $p_regionForm->DataSource->AllParametersSet;
        
   }

   
    $img_radio= "<img border='0' src='../images/radio.gif'>";
// End Bdr

      $styles = array("Row", "AltRow");
  	// Start Bdr    
      $Style = $styles[0];
      
      if ($Component->DataSource->p_region_id->GetValue()== $selected_id) {
      	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
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

$Component->DLink->SetValue($img_radio);  // Bdr

//Close p_regionGrid_BeforeShowRow @2-D02E35F3
    return $p_regionGrid_BeforeShowRow;
}
//End Close p_regionGrid_BeforeShowRow

//p_regionGrid_BeforeShow @2-2D752E10
function p_regionGrid_BeforeShow(& $sender)
{
    $p_regionGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_regionGrid; //Compatibility
//End p_regionGrid_BeforeShow

//Close p_regionGrid_BeforeShow @2-9EDA0BDE
    return $p_regionGrid_BeforeShow;
}
//End Close p_regionGrid_BeforeShow

//p_regionGrid_BeforeSelect @2-065FF440
function p_regionGrid_BeforeSelect(& $sender)
{
    $p_regionGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_regionGrid; //Compatibility
//End p_regionGrid_BeforeSelect

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close p_regionGrid_BeforeSelect @2-27BD94CB
    return $p_regionGrid_BeforeSelect;
}
//End Close p_regionGrid_BeforeSelect

//p_regionForm_BeforeShow @23-F348C47A
function p_regionForm_BeforeShow(& $sender)
{
    $p_regionForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_regionForm; //Compatibility
//End p_regionForm_BeforeShow

//Close p_regionForm_BeforeShow @23-C2D17AAB
    return $p_regionForm_BeforeShow;
}
//End Close p_regionForm_BeforeShow

//Page_OnInitializeView @1-B7437F52
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_region; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
  	global $selected_id;
      global $add_flag;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_region_id", $selected_id);
      $add_flag=CCGetFromGet("FLAG", "NONE");
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

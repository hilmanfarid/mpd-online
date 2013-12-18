<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-44282129
function BindEvents()
{
    global $p_rqst_type_doc_type_mapGrid;
    global $CCSEvents;
    $p_rqst_type_doc_type_mapGrid->CCSEvents["BeforeShowRow"] = "p_rqst_type_doc_type_mapGrid_BeforeShowRow";
    $p_rqst_type_doc_type_mapGrid->CCSEvents["BeforeSelect"] = "p_rqst_type_doc_type_mapGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_rqst_type_doc_type_mapGrid_BeforeShowRow @2-AA9BCDC0
function p_rqst_type_doc_type_mapGrid_BeforeShowRow(& $sender)
{
    $p_rqst_type_doc_type_mapGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_rqst_type_doc_type_mapGrid; //Compatibility
//End p_rqst_type_doc_type_mapGrid_BeforeShowRow
// Start Bdr
    global $p_rqst_type_doc_type_mapForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_rqst_type_doc_type_map_id->GetValue();
        $p_rqst_type_doc_type_mapForm->DataSource->Parameters["urlp_rqst_type_doc_type_map_id"] = $selected_id;
        $p_rqst_type_doc_type_mapForm->DataSource->Prepare();
        $p_rqst_type_doc_type_mapForm->EditMode = $p_rqst_type_doc_type_mapForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

      $styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_rqst_type_doc_type_map_id->GetValue()== $selected_id) {
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
//Close p_rqst_type_doc_type_mapGrid_BeforeShowRow @2-0A1F14CC
    return $p_rqst_type_doc_type_mapGrid_BeforeShowRow;
}
//End Close p_rqst_type_doc_type_mapGrid_BeforeShowRow

//p_rqst_type_doc_type_mapGrid_BeforeSelect @2-2D855CFC
function p_rqst_type_doc_type_mapGrid_BeforeSelect(& $sender)
{
    $p_rqst_type_doc_type_mapGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_rqst_type_doc_type_mapGrid; //Compatibility
//End p_rqst_type_doc_type_mapGrid_BeforeSelect
  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------
//Close p_rqst_type_doc_type_mapGrid_BeforeSelect @2-76247BA0
    return $p_rqst_type_doc_type_mapGrid_BeforeSelect;
}
//End Close p_rqst_type_doc_type_mapGrid_BeforeSelect

//Page_OnInitializeView @1-C34FE934
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_rqst_type_doc_type_map; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_rqst_type_doc_type_map_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

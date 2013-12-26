<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-38C08D62
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $CCSEvents;
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

// Start Bdr
    global $t_vat_setllementForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_id->GetValue();
        $t_vat_setllementForm->DataSource->Parameters["urlt_vat_setllement_id"] = $selected_id;
        $t_vat_setllementForm->DataSource->Prepare();
        $t_vat_setllementForm->EditMode = $t_vat_setllementForm->DataSource->AllParametersSet;
        
   }
// End Bdr 

      $styles = array("Row", "AltRow");
  	// Start Bdr    
          $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
          $Style = $styles[0];
          
          if ($Component->DataSource->t_vat_setllement_id->GetValue()== $selected_id) {
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
//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//Page_OnInitializeView @1-EC33A83E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_edit_st4; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
  	 global $selected_id;
          $selected_id = -1;
          $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-727D752C
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_edit_st4; //Compatibility
//End Page_BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>

<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-0F60190A
function BindEvents()
{
    global $p_legal_doc_typeGrid;
    global $CCSEvents;
    $p_legal_doc_typeGrid->CCSEvents["BeforeShowRow"] = "p_legal_doc_typeGrid_BeforeShowRow";
    $p_legal_doc_typeGrid->CCSEvents["BeforeSelect"] = "p_legal_doc_typeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_legal_doc_typeGrid_BeforeShowRow @2-57B5ECC0
function p_legal_doc_typeGrid_BeforeShowRow(& $sender)
{
    $p_legal_doc_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_legal_doc_typeGrid; //Compatibility
//End p_legal_doc_typeGrid_BeforeShowRow

// Start Bdr
    global $p_legal_doc_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_legal_doc_type_id->GetValue();
        $p_legal_doc_typeForm->DataSource->Parameters["urlp_legal_doc_type_id"] = $selected_id;
        $p_legal_doc_typeForm->DataSource->Prepare();
        $p_legal_doc_typeForm->EditMode = $p_legal_doc_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_legal_doc_type_id->GetValue()== $selected_id) {
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

//Close p_legal_doc_typeGrid_BeforeShowRow @2-F9E799CC
    return $p_legal_doc_typeGrid_BeforeShowRow;
}
//End Close p_legal_doc_typeGrid_BeforeShowRow

//p_legal_doc_typeGrid_BeforeSelect @2-73886E6C
function p_legal_doc_typeGrid_BeforeSelect(& $sender)
{
    $p_legal_doc_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_legal_doc_typeGrid; //Compatibility
//End p_legal_doc_typeGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_legal_doc_typeGrid_BeforeSelect @2-37D833B2
    return $p_legal_doc_typeGrid_BeforeSelect;
}
//End Close p_legal_doc_typeGrid_BeforeSelect

//Page_OnInitializeView @1-153D27DE
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_legal_doc_type; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_legal_doc_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

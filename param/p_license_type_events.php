<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-BE860C02
function BindEvents()
{
    global $p_license_typeGrid;
    global $CCSEvents;
    $p_license_typeGrid->CCSEvents["BeforeShowRow"] = "p_license_typeGrid_BeforeShowRow";
    $p_license_typeGrid->CCSEvents["BeforeSelect"] = "p_license_typeGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_license_typeGrid_BeforeShowRow @2-A6B0489F
function p_license_typeGrid_BeforeShowRow(& $sender)
{
    $p_license_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_license_typeGrid; //Compatibility
//End p_license_typeGrid_BeforeShowRow

// Start Bdr
    global $p_license_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->p_license_type_id->GetValue();
        $p_license_typeForm->DataSource->Parameters["urlp_license_type_id"] = $selected_id;
        $p_license_typeForm->DataSource->Prepare();
        $p_license_typeForm->EditMode = $p_license_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->p_license_type_id->GetValue()== $selected_id) {
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

//Close p_license_typeGrid_BeforeShowRow @2-8D71374F
    return $p_license_typeGrid_BeforeShowRow;
}
//End Close p_license_typeGrid_BeforeShowRow

//p_license_typeGrid_BeforeSelect @2-6F5E507E
function p_license_typeGrid_BeforeSelect(& $sender)
{
    $p_license_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_license_typeGrid; //Compatibility
//End p_license_typeGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close p_license_typeGrid_BeforeSelect @2-10A42A31
    return $p_license_typeGrid_BeforeSelect;
}
//End Close p_license_typeGrid_BeforeSelect

//Page_OnInitializeView @1-7DF06809
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_license_type; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_license_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

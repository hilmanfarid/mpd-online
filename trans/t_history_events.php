<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-449B2F5F
function BindEvents()
{
    global $p_room_typeGrid;
    global $CCSEvents;
    $p_room_typeGrid->CCSEvents["BeforeSelect"] = "p_room_typeGrid_BeforeSelect";
    $p_room_typeGrid->CCSEvents["BeforeShowRow"] = "p_room_typeGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//p_room_typeGrid_BeforeSelect @2-5B1DD27B
function p_room_typeGrid_BeforeSelect(& $sender)
{
    $p_room_typeGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_room_typeGrid; //Compatibility
//End p_room_typeGrid_BeforeSelect

//Custom Code @150-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_room_typeGrid_BeforeSelect @2-51123DE8
    return $p_room_typeGrid_BeforeSelect;
}
//End Close p_room_typeGrid_BeforeSelect

//p_room_typeGrid_BeforeShowRow @2-2B645EEE
function p_room_typeGrid_BeforeShowRow(& $sender)
{
    $p_room_typeGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_room_typeGrid; //Compatibility
//End p_room_typeGrid_BeforeShowRow

// Start Bdr
    global $p_room_typeForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	//$selected_id = $Component->DataSource->p_room_type_id->GetValue();
        //$p_room_typeForm->DataSource->Parameters["urlp_room_type_id"] = $selected_id;
        //$p_room_typeForm->DataSource->Prepare();
        //$p_room_typeForm->EditMode = $p_room_typeForm->DataSource->AllParametersSet;
        
   }
// End Bdr  

//DEL      $styles = array("Row", "AltRow");
//DEL  	// Start Bdr    
//DEL        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
//DEL        $Style = $styles[0];
//DEL        
//DEL        if ($Component->DataSource->p_room_type_id->GetValue()== $selected_id) {
//DEL        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
//DEL            $Style = $styles[1];
//DEL            $is_show_form=1;
//DEL        }	
//DEL    // End Bdr  
//DEL      if (count($styles)) {
//DEL          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
//DEL          if (strlen($Style) && !strpos($Style, "="))
//DEL              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
//DEL          $Component->Attributes->SetValue("rowStyle", $Style);
//DEL      }

//Set Row Style @151-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style	 $Component->DLink->SetValue($img_radio); // Bdr

//Close p_room_typeGrid_BeforeShowRow @2-723FEB28
    return $p_room_typeGrid_BeforeShowRow;
}
//End Close p_room_typeGrid_BeforeShowRow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
//DEL  // -------------------------

//Page_OnInitializeView @1-F3290273
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_history; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	  global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("p_room_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>

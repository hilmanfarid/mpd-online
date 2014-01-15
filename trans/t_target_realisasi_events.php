<?php
//BindEvents Method @1-BA4EF0F3
function BindEvents()
{
    global $t_target_realisasiGrid;
    global $CCSEvents;
    $t_target_realisasiGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid_BeforeShowRow";
    $t_target_realisasiGrid->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_target_realisasiGrid_BeforeShowRow @2-52730172
function t_target_realisasiGrid_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeShowRow

//Custom Code @725-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

global $selected_id;

		if ($selected_id<0) {
    		$selected_id = $Component->DataSource->p_year_period_id->GetValue();
   		}

		$styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_year_period_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;

			$pid = $Component->DataSource->p_year_period_id->GetValue();
			$Component->p_year_period_id2->SetValue($pid);
        }	
    // End Bdr  
      if (count($styles)) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	 $Component->DLink->SetValue($img_radio); // Bdr
	 $target = $Component->DataSource->target_amt->GetValue();
	 $realisasi = $Component->DataSource->realisasi_amt->GetValue();
	 if(!empty($target)) {
	 	$percent = number_format($realisasi / $target * 100, 2, ".", ",");
	 }else {
		$percent = 0;
	 }
	 $Component->percentage->SetValue("$percent %");
//Close t_target_realisasiGrid_BeforeShowRow @2-DFE61ABB
    return $t_target_realisasiGrid_BeforeShowRow;
}
//End Close t_target_realisasiGrid_BeforeShowRow

//t_target_realisasiGrid_BeforeSelect @2-EC247A5A
function t_target_realisasiGrid_BeforeSelect(& $sender)
{
    $t_target_realisasiGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeSelect

//Custom Code @735-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Write your own code here.
  	$Component->DataSource->Parameters["p_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);
// -------------------------
//Close t_target_realisasiGrid_BeforeSelect @2-EF6BE882
    return $t_target_realisasiGrid_BeforeSelect;
}
//End Close t_target_realisasiGrid_BeforeSelect

//Page_OnInitializeView @1-6D8B7EE4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi; //Compatibility
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
        $selected_id=CCGetFromGet("p_year_period_id", $selected_id);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

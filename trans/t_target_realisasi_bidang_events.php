<?php
//BindEvents Method @1-55747131
function BindEvents()
{
    global $t_target_realisasi_jenisGrid;
    global $CCSEvents;
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid_BeforeSelect";
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_target_realisasi_jenisGrid_BeforeSelect @2-B5A8F962
function t_target_realisasi_jenisGrid_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenisGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid; //Compatibility
//End t_target_realisasi_jenisGrid_BeforeSelect

//Custom Code @693-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
// Write your own code here.
  	$Component->DataSource->Parameters["p_vat_group_id"] = CCGetFromGet("p_vat_group_id", NULL);
// -------------------------
//Close t_target_realisasi_jenisGrid_BeforeSelect @2-10124532
    return $t_target_realisasi_jenisGrid_BeforeSelect;
}
//End Close t_target_realisasi_jenisGrid_BeforeSelect

//t_target_realisasi_jenisGrid_BeforeShowRow @2-D46661EC
function t_target_realisasi_jenisGrid_BeforeShowRow(& $sender)
{
    $t_target_realisasi_jenisGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid; //Compatibility
//End t_target_realisasi_jenisGrid_BeforeShowRow

//Custom Code @694-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
		global $selected_id;

		if ($selected_id<0) {
    		$selected_id = $Component->DataSource->p_vat_group_id->GetValue();
   		}

		$styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_vat_group_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;

			$tid = $Component->DataSource->p_vat_group_id->GetValue();
			$Component->p_vat_group_id->SetValue($tid);
			$pid = $Component->DataSource->p_year_period_id->GetValue();
			$vat_id = $Component->DataSource->p_vat_group_id->GetValue();
			$Component->p_year_period_id2->SetValue($pid);
			$Component->p_vat_group_id2->SetValue($vat_id);
        }	
    // End Bdr
	  $pid_t = $Component->DataSource->p_vat_group_id->GetValue();  
      if (count($styles) && $pid!=999) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }
	 $Component->DLink->SetValue($img_radio); // Bdr
	 $target = $Component->DataSource->target_amount->GetValue();
	 $realisasi = $Component->DataSource->realisasi_amt->GetValue();
	 if(!empty($target)){
	 	$percent = number_format($realisasi / $target * 100, 2, ".", ",");
		$selisih = number_format($realisasi - $target , 2, ".", ",");
		if($percent >= 100) {
			$percent_selisih = $percent;
		}else{
			$percent_selisih = number_format($percent-100, 2, ".", ",");
		}
	 }else {
		$percent = 0;
		$selisih = 0;
		$percent_selisih = 0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $Component->selisih->SetValue("$selisih");
	 $Component->percentage_selisih->SetValue("$percent_selisih %");
	 
//Close t_target_realisasi_jenisGrid_BeforeShowRow @2-1478D09A
    return $t_target_realisasi_jenisGrid_BeforeShowRow;
}
//End Close t_target_realisasi_jenisGrid_BeforeShowRow

//Page_OnInitializeView @1-7378EABC
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_bidang; //Compatibility
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
        $selected_id = CCGetFromGet("p_vat_group_id", $selected_id);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

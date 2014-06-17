<?php
//BindEvents Method @1-9BA18295
function BindEvents()
{
    global $t_target_realisasi_jenisGrid;
    global $t_target_realisasi_jenisGrid1;
    global $CCSEvents;
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid_BeforeSelect";
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid_BeforeShowRow";
    $t_target_realisasi_jenisGrid1->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid1_BeforeSelect";
    $t_target_realisasi_jenisGrid1->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid1_BeforeShowRow";
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
  	$Component->DataSource->Parameters["t_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
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
    		$selected_id = $Component->DataSource->t_revenue_target_id->GetValue();
   		}

		$styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->t_revenue_target_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;

			$tid = $Component->DataSource->t_revenue_target_id->GetValue();
			$Component->t_revenue_target_id->SetValue($tid);
			$pid = $Component->DataSource->p_year_period_id->GetValue();
			//print_r($Component->DataSource->p_year_period_id->GetValue());
			$vat_id = $Component->DataSource->p_vat_type_id->GetValue();
			$p_vat_group_id = $Component->p_vat_group_id->GetValue();
			$Component->p_year_period_id2->SetValue($pid);
			$Component->p_vat_type_id2->SetValue($vat_id);
			$Component->p_vat_group_id->SetValue($p_vat_group_id);
        }	
    // End Bdr
	  $pid_t = $Component->DataSource->t_revenue_target_id->GetValue();  
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
	 }else{
	 	$percent =0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $sum_realisasi = $t_target_realisasi_jenisGrid->realisasi_amt_sum->GetValue();
	 $t_target_realisasi_jenisGrid->realisasi_amt_sum->SetValue($sum_realisasi+$realisasi);
	 $sum_target = $t_target_realisasi_jenisGrid->target_amount_sum->GetValue();
	 $t_target_realisasi_jenisGrid->target_amount_sum->SetValue($sum_target+$target);
	 $sum_percentage = $t_target_realisasi_jenisGrid->percentage_sum->GetValue();
	 if($sum_target > 0)
	 $t_target_realisasi_jenisGrid->percentage_sum->SetValue(number_format($sum_realisasi / $sum_target  * 100, 2, ".", ","));
//Close t_target_realisasi_jenisGrid_BeforeShowRow @2-1478D09A
    return $t_target_realisasi_jenisGrid_BeforeShowRow;
}
//End Close t_target_realisasi_jenisGrid_BeforeShowRow

//t_target_realisasi_jenisGrid1_BeforeSelect @880-8252B760
function t_target_realisasi_jenisGrid1_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenisGrid1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid1; //Compatibility
//End t_target_realisasi_jenisGrid1_BeforeSelect

//Custom Code @900-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid1_BeforeSelect @880-8E71EFFD
    return $t_target_realisasi_jenisGrid1_BeforeSelect;
}
//End Close t_target_realisasi_jenisGrid1_BeforeSelect

//t_target_realisasi_jenisGrid1_BeforeShowRow @880-4D7EED50
function t_target_realisasi_jenisGrid1_BeforeShowRow(& $sender)
{
    $t_target_realisasi_jenisGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid1; //Compatibility
//End t_target_realisasi_jenisGrid1_BeforeShowRow

//Custom Code @901-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid1_BeforeShowRow @880-1F3D6C11
    return $t_target_realisasi_jenisGrid1_BeforeShowRow;
}
//End Close t_target_realisasi_jenisGrid1_BeforeShowRow

//Page_OnInitializeView @1-A136A530
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_view; //Compatibility
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
        $selected_id = CCGetFromGet("t_revenue_target_id", $selected_id);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

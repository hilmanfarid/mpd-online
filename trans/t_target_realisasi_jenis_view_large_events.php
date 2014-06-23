<?php
//BindEvents Method @1-79F38E79
function BindEvents()
{
    global $t_target_realisasi_jenisGrid;
    global $t_target_realisasi_jenisGrid1;
    global $CCSEvents;
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid_BeforeSelect";
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid_BeforeShowRow";
    $t_target_realisasi_jenisGrid->ds->CCSEvents["BeforeExecuteSelect"] = "t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect";
    $t_target_realisasi_jenisGrid->ds->CCSEvents["BeforeBuildSelect"] = "t_target_realisasi_jenisGrid_ds_BeforeBuildSelect";
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
		/*
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
	*/
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

//t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect @2-7E782143
function t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect(& $sender)
{
    $t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid; //Compatibility
//End t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect

//Custom Code @906-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code
   
//Close t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect @2-9262F2FE
    return $t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect;
}
//End Close t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect

//t_target_realisasi_jenisGrid_ds_BeforeBuildSelect @2-F9C26FF5
function t_target_realisasi_jenisGrid_ds_BeforeBuildSelect(& $sender)
{
    $t_target_realisasi_jenisGrid_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid; //Compatibility
//End t_target_realisasi_jenisGrid_ds_BeforeBuildSelect

//Custom Code @907-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid_ds_BeforeBuildSelect @2-22CE013E
    return $t_target_realisasi_jenisGrid_ds_BeforeBuildSelect;
}
//End Close t_target_realisasi_jenisGrid_ds_BeforeBuildSelect

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
	$target = $t_target_realisasi_jenisGrid1->DataSource->target_amount->GetValue();
	 $realisasi = $t_target_realisasi_jenisGrid1->DataSource->realisasi_amt->GetValue();
	 if(!empty($target)){
	 	$percent = number_format($realisasi / $target * 100, 2, ".", ",");
	 }else{
	 	$percent =0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $sum_realisasi = $t_target_realisasi_jenisGrid1->realisasi_amt_sum->GetValue();
	 $t_target_realisasi_jenisGrid1->realisasi_amt_sum->SetValue($sum_realisasi+$realisasi);
	 $sum_target = $t_target_realisasi_jenisGrid1->target_amount_sum->GetValue();
	 $t_target_realisasi_jenisGrid1->target_amount_sum->SetValue($sum_target+$target);
	 $sum_percentage = $t_target_realisasi_jenisGrid1->percentage_sum->GetValue();
	 if($sum_target > 0)
	 $t_target_realisasi_jenisGrid1->percentage_sum->SetValue(number_format($sum_realisasi / $sum_target  * 100, 2, ".", ","));

//Close t_target_realisasi_jenisGrid1_BeforeShowRow @880-1F3D6C11
    return $t_target_realisasi_jenisGrid1_BeforeShowRow;
}
//End Close t_target_realisasi_jenisGrid1_BeforeShowRow

//Page_OnInitializeView @1-56D03452
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_view_large; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
// -------------------------
      // Write your own code here.
  	  global $selected_id;
	  global $t_target_realisasi_jenisGrid;
	  global $t_target_realisasi_jenisGrid1;
        $selected_id = -1;
        $selected_id = CCGetFromGet("t_revenue_target_id", $selected_id);
		$dbConn = new clsDBConnSIKP();
	$sql = "select p_year_period_id from p_year_period 
	where year_code = (select extract(year from sysdate))";
	$dbConn->query($sql);
	$item = 0;
	while($dbConn->next_record()){
		$item = $dbConn->f("p_year_period_id");
	}
	$t_target_realisasi_jenisGrid->p_year_period_id2->SetValue($item);
	$t_target_realisasi_jenisGrid1->p_year_period_id2->SetValue($item);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

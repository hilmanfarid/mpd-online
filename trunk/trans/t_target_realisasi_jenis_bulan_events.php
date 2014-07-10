<?php
//BindEvents Method @1-22EBE8A2
function BindEvents()
{
    global $t_target_realisasi_jenis_bulanForm;
    global $t_target_realisasiGrid;
    global $t_target_realisasiGrid1;
    global $CCSEvents;
    $t_target_realisasi_jenis_bulanForm->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenis_bulanForm_BeforeSelect";
    $t_target_realisasiGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid_BeforeShowRow";
    $t_target_realisasiGrid->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid_BeforeSelect";
    $t_target_realisasiGrid1->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid1_BeforeShowRow";
    $t_target_realisasiGrid1->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid1_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_target_realisasi_jenis_bulanForm_BeforeSelect @726-FC201116
function t_target_realisasi_jenis_bulanForm_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenis_bulanForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulanForm; //Compatibility
//End t_target_realisasi_jenis_bulanForm_BeforeSelect

//Custom Code @890-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$t_target_realisasi_jenis_bulanForm->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_target_revenue_id", NULL);
//Close t_target_realisasi_jenis_bulanForm_BeforeSelect @726-D1C09105
    return $t_target_realisasi_jenis_bulanForm_BeforeSelect;
}
//End Close t_target_realisasi_jenis_bulanForm_BeforeSelect

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
	global $selected_id;
    // Write your own code here.
	/*if ($selected_id<0) {
    		$selected_id = $Component->DataSource->p_year_period_id->GetValue();
   		}*/
	$img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        if ($Component->DataSource->p_finance_period_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;
			$Component->DLink->Parameters=CCRemoveParam($Component->DLink->Parameters,'p_finance_period_id');
			//$pid = $Component->DataSource->p_year_period_id->GetValue();
			//$Component->p_year_period_id2->SetValue($pid);
        }	
    // End Bdr  
      if (count($styles)) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	 $Component->DLink->SetValue($img_radio); // Bdr




	 $target = $Component->DataSource->target_amount->GetValue();
	 $realisasi = $Component->DataSource->realisasi_amt->GetValue();
	 //$penalty = $Component->DataSource->penalty_amt->GetValue();
	 $penalty1 = $Component->DataSource->denda_pokok->GetValue();
	 $penalty = $Component->DataSource->denda_piutang->GetValue();


	 $debt = $Component->DataSource->debt_amt->GetValue();
	 if(!empty($target)) {
	 	$percent = number_format(($realisasi+$penalty+$penalty1+$debt) / $target * 100, 2, ".", ",");
	 }else {
		$percent = 0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $Component->total_amt->SetValue($realisasi+$penalty+$penalty1+$debt);
	 $sum_realisasi = $t_target_realisasiGrid->realisasi_amt_sum->GetValue();
	 $t_target_realisasiGrid->realisasi_amt_sum->SetValue($sum_realisasi+$realisasi);
	 $sum_target = $t_target_realisasiGrid->target_amount_sum->GetValue();
	 $t_target_realisasiGrid->target_amount_sum->SetValue($sum_target+$target);

	 //$sum_penalty_amt = $t_target_realisasiGrid->penalty_amt_sum->GetValue();
	 $sum_penalty_amt = $t_target_realisasiGrid->penalty_amt_sum->GetValue();
	 $sum_penalty_amt1 = $t_target_realisasiGrid->penalty_amt_sum1->GetValue();
	 //$t_target_realisasiGrid->penalty_amt_sum->SetValue($sum_penalty_amt+$penalty);
	 $t_target_realisasiGrid->penalty_amt_sum->SetValue($sum_penalty_amt+$penalty);
	 $t_target_realisasiGrid->penalty_amt_sum1->SetValue($sum_penalty_amt1+$penalty1);


	 $sum_debt = $t_target_realisasiGrid->debt_amt_sum->GetValue();
	 $t_target_realisasiGrid->debt_amt_sum->SetValue($sum_debt+$debt);
	 
	 $sum_total = $t_target_realisasiGrid->total_amt_sum->GetValue();
	 $t_target_realisasiGrid->total_amt_sum->SetValue($sum_total+$realisasi+$penalty+$penalty1+$debt);

	 $sum_percentage = $t_target_realisasiGrid->percentage_sum->GetValue();
	 if($sum_total > 0)
	 $t_target_realisasiGrid->percentage_sum->SetValue(($sum_realisasi+$realisasi+$sum_debt+$debt) / ($sum_target+$target)  * 100);
// -------------------------
//End Custom Code

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

//Close t_target_realisasiGrid_BeforeSelect @2-EF6BE882
    return $t_target_realisasiGrid_BeforeSelect;
}
//End Close t_target_realisasiGrid_BeforeSelect

//t_target_realisasiGrid1_BeforeShowRow @900-32B589EA
function t_target_realisasiGrid1_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid1; //Compatibility
//End t_target_realisasiGrid1_BeforeShowRow

//Custom Code @915-2A29BDB7
// -------------------------
	global $selected_id;
	 $target = $Component->DataSource->target_amount->GetValue();
	 $realisasi = $Component->DataSource->realisasi_amt->GetValue();
	 //$penalty = $Component->DataSource->penalty_amt->GetValue();
	 $debt = $Component->DataSource->debt_amt->GetValue();
	 if(!empty($target)) {
	 	$percent = number_format(($realisasi+$debt) / $target * 100, 2, ".", ",");
	 }else {
		$percent = 0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $Component->total_amt->SetValue($realisasi+$penalty+$debt);
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid1_BeforeShowRow @900-539FE285
    return $t_target_realisasiGrid1_BeforeShowRow;
}
//End Close t_target_realisasiGrid1_BeforeShowRow

//t_target_realisasiGrid1_BeforeSelect @900-7031395B
function t_target_realisasiGrid1_BeforeSelect(& $sender)
{
    $t_target_realisasiGrid1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid1; //Compatibility
//End t_target_realisasiGrid1_BeforeSelect

//Custom Code @916-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid1_BeforeSelect @900-45EF25DC
    return $t_target_realisasiGrid1_BeforeSelect;
}
//End Close t_target_realisasiGrid1_BeforeSelect

//Page_OnInitializeView @1-3CE31887
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulan; //Compatibility
//End Page_OnInitializeView

//Custom Code @899-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_finance_period_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

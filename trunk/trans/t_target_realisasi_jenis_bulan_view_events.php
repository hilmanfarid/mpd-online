<?php
//BindEvents Method @1-54E8F3AB
function BindEvents()
{
    global $t_target_realisasiGrid;
    global $t_target_realisasiGrid1;
    global $CCSEvents;
    $t_target_realisasiGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid_BeforeShowRow";
    $t_target_realisasiGrid->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid_BeforeSelect";
    $t_target_realisasiGrid1->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid1_BeforeShowRow";
    $t_target_realisasiGrid1->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid1_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

	/*$nilai_penerimaan = $Component->DataSource->payment_vat_amount->GetValue();

	$sum_penerimaan = $t_penerimaan_skpd_viewGrid->total_penerimaan->GetValue();
	$t_penerimaan_skpd_viewGrid->total_penerimaan->SetValue($sum_penerimaan + $nilai_penerimaan);
	*/

//t_target_realisasiGrid_BeforeShowRow @2-52730172
function t_target_realisasiGrid_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeShowRow

//Custom Code @114-2A29BDB7
// -------------------------
	global $selected_id;
	global $ayat;
	$temp="<h1>TARGET DAN REALISASI BULANAN PAJAK ";
	//$ayat->
	
	$p_vat_type_id		= CCGetFromGet("p_vat_type_id",6);
	$p_year_period_id		= CCGetFromGet("p_year_period_id",16);
	switch ($p_vat_type_id) {
	  case 1:
	  	$temp.="HOTEL<span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></H1>";
	    $ayat->SetText($temp);
	    break;
	  case 2:
	    $temp.="RESTORAN<span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></h1>";
	    $ayat->SetText($temp);
	    break;
	  case 3:
	    $temp.="HIBURAN<span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></h1>";
	    $ayat->SetText($temp);
	    break;
	  case 4:
	    $temp.="PARKIR<span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></h1>";
	    $ayat->SetText($temp);
	    break;
	  case 5:
	    $temp.="PPJ<span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></h1>";
	    $ayat->SetText($temp);
	    break;
	  case 6:
	  	$temp.="BPHTB <span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></H1>";
	    $ayat->SetText($temp);
	    break;
	  default:
	    $temp.="BPHTB <span STYLE='DISPLAY:NONE;' id='tanggal_kemaren'></span></h1>";
	    $ayat->SetText($temp);
	}

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

//Custom Code @115-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid_BeforeSelect @2-EF6BE882
    return $t_target_realisasiGrid_BeforeSelect;
}
//End Close t_target_realisasiGrid_BeforeSelect

//t_target_realisasiGrid1_BeforeShowRow @119-32B589EA
function t_target_realisasiGrid1_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid1; //Compatibility
//End t_target_realisasiGrid1_BeforeShowRow

//Custom Code @131-2A29BDB7
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

//Close t_target_realisasiGrid1_BeforeShowRow @119-539FE285
    return $t_target_realisasiGrid1_BeforeShowRow;
}
//End Close t_target_realisasiGrid1_BeforeShowRow

//t_target_realisasiGrid1_BeforeSelect @119-7031395B
function t_target_realisasiGrid1_BeforeSelect(& $sender)
{
    $t_target_realisasiGrid1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid1; //Compatibility
//End t_target_realisasiGrid1_BeforeSelect

//Custom Code @132-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid1_BeforeSelect @119-45EF25DC
    return $t_target_realisasiGrid1_BeforeSelect;
}
//End Close t_target_realisasiGrid1_BeforeSelect

//Page_OnInitializeView @1-09DB6C45
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulan_view; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>

<?php
//BindEvents Method @1-4A712FF7
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
    $t_target_realisasiGrid1->CCSEvents["BeforeShow"] = "t_target_realisasiGrid1_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
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
	global $selected_id;
//Custom Code @725-2A29BDB7
// -------------------------
    // Write your own code here.
	$img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        if ($Component->DataSource->p_vat_type_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;
			$Component->DLink->Parameters=CCRemoveParam($Component->DLink->Parameters,'p_vat_type_id');
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
	 $penalty = $Component->DataSource->penalty_amt->GetValue();
	 $debt = $Component->DataSource->debt_amt->GetValue();
	 if(!empty($target)) {
	 	$percent = number_format(($realisasi+$penalty+$debt) / $target * 100, 2, ".", ",");
	 }else {
		$percent = 0;
	 }
	 $Component->percentage->SetValue("$percent %");
	 $Component->total_amt->SetValue($realisasi+$penalty+$debt);
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

//t_target_realisasiGrid1_BeforeShowRow @927-32B589EA
function t_target_realisasiGrid1_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid1; //Compatibility
//End t_target_realisasiGrid1_BeforeShowRow

//Custom Code @915-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid1_BeforeShowRow @927-539FE285
    return $t_target_realisasiGrid1_BeforeShowRow;
}
//End Close t_target_realisasiGrid1_BeforeShowRow

//t_target_realisasiGrid1_BeforeSelect @927-7031395B
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

//Close t_target_realisasiGrid1_BeforeSelect @927-45EF25DC
    return $t_target_realisasiGrid1_BeforeSelect;
}
//End Close t_target_realisasiGrid1_BeforeSelect

//t_target_realisasiGrid1_BeforeShow @927-968F5A76
function t_target_realisasiGrid1_BeforeShow(& $sender)
{
    $t_target_realisasiGrid1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid1; //Compatibility
//End t_target_realisasiGrid1_BeforeShow

//Custom Code @928-2A29BDB7
// -------------------------
    // Write your own code here.
	$jenis_pajak = CCGetFromGet('p_vat_type_id');
	if(empty($jenis_pajak)){
		$t_target_realisasiGrid1->Visible = false;
	}else{
		$t_target_realisasiGrid1->Visible = true;
	}
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid1_BeforeShow @927-578CA802
    return $t_target_realisasiGrid1_BeforeShow;
}
//End Close t_target_realisasiGrid1_BeforeShow

//Page_OnInitializeView @1-D351C65A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulan_detil; //Compatibility
//End Page_OnInitializeView

//Custom Code @900-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_vat_type_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_AfterInitialize @1-3A28A7E4
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulan_detil; //Compatibility
//End Page_AfterInitialize

//Custom Code @929-2A29BDB7
// -------------------------
    // Write your own code here.
	global $t_target_realisasiGrid1;
		$jenis_pajak = CCGetFromGet('p_vat_type_id');
	if(empty($jenis_pajak)){
		$t_target_realisasiGrid1->Visible = false;
	}else{
		$t_target_realisasiGrid1->Visible = true;
	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>

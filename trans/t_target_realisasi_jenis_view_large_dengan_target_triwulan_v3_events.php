<?php
//BindEvents Method @1-971A7F06
function BindEvents()
{
    global $t_target_realisasi_jenisGrid;
    global $t_target_realisasiGrid;
    global $t_target_realisasi_triwulanGrid1;
    global $t_target_realisasi_jenisGrid1;
    global $CCSEvents;
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid_BeforeSelect";
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid_BeforeShowRow";
    $t_target_realisasi_jenisGrid->ds->CCSEvents["BeforeExecuteSelect"] = "t_target_realisasi_jenisGrid_ds_BeforeExecuteSelect";
    $t_target_realisasi_jenisGrid->ds->CCSEvents["BeforeBuildSelect"] = "t_target_realisasi_jenisGrid_ds_BeforeBuildSelect";
    $t_target_realisasiGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid_BeforeShowRow";
    $t_target_realisasiGrid->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid_BeforeSelect";
    $t_target_realisasiGrid->CCSEvents["BeforeShow"] = "t_target_realisasiGrid_BeforeShow";
    $t_target_realisasi_triwulanGrid1->CCSEvents["BeforeShowRow"] = "t_target_realisasi_triwulanGrid1_BeforeShowRow";
    $t_target_realisasi_triwulanGrid1->CCSEvents["BeforeSelect"] = "t_target_realisasi_triwulanGrid1_BeforeSelect";
    $t_target_realisasi_triwulanGrid1->CCSEvents["BeforeShow"] = "t_target_realisasi_triwulanGrid1_BeforeShow";
    $t_target_realisasi_jenisGrid1->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid1_BeforeSelect";
    $t_target_realisasi_jenisGrid1->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid1_BeforeShowRow";
    $t_target_realisasi_jenisGrid1->ds->CCSEvents["BeforeExecuteSelect"] = "t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect";
    $t_target_realisasi_jenisGrid1->ds->CCSEvents["BeforeBuildSelect"] = "t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
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

	 $sum_realisasi = $t_target_realisasi_jenisGrid->realisasi_amt_sum->GetValue();
	 $t_target_realisasi_jenisGrid->realisasi_amt_sum->SetValue($sum_realisasi+$realisasi);
	 $sum_target = $t_target_realisasi_jenisGrid->target_amount_sum->GetValue();
	 $t_target_realisasi_jenisGrid->target_amount_sum->SetValue($sum_target+$target);
	 $sum_percentage = $t_target_realisasi_jenisGrid->percentage_sum->GetValue();
	 if($sum_target > 0) {
	 	$sum_realisasi = $t_target_realisasi_jenisGrid->realisasi_amt_sum->GetValue();
		$sum_target = $t_target_realisasi_jenisGrid->target_amount_sum->GetValue();
		$sum_percentage_temp = $sum_realisasi / $sum_target  * 100;
	 	$t_target_realisasi_jenisGrid->percentage_sum->SetValue(number_format($sum_percentage_temp, 2, ".", ","));
	 }
	 $t_target_realisasi_jenisGrid->selisih_sum->SetValue(number_format($sum_realisasi-$sum_target, 2, ".", ","));
	 if($sum_percentage_temp >= 100) {
	 	$t_target_realisasi_jenisGrid->percentage_selisih_sum->SetValue(number_format($sum_percentage_temp, 2, ".", ","));
	 }else{
		$t_target_realisasi_jenisGrid->percentage_selisih_sum->SetValue(number_format($sum_percentage_temp - 100, 2, ".", ","));
	 }


	 //ambil data untuk yang triwulan
	 $dbConn			= new clsDBConnSIKP();
	 
	 global $t_target_realisasi_jenisGrid1;
	 $query = "SELECT q_start,q_end from 
				(select to_char(dy,'Q') as QTR,
							 date(
								 date_trunc('month',dy)-(2*interval '1 month')
							 ) as Q_start,
							 dy as Q_end
					from (
							select date(dy+((rn*3) * interval '1 month'))-1 as dy
								from (
											select rn, date(date_trunc('year',current_date)) as dy
											from generate_series(1,4) gs(rn)
											) x
								) y
				) 
				where trunc(sysdate) between q_start and q_end";
		
	 $dbConn->query($query);
	 $dbConn->next_record();
	 $q_start =$dbConn->f("q_start");
	 $q_end = $dbConn->f("q_end");

	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 1){
		$query = "select o_target,o_target_sebelumnya,
			f_get_realisasi(1, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(1)";

		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_hotel->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_hotel->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 2){
	 	$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(2, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(2)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_resto->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_resto->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 3){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(3, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(3)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_hiburan->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_hiburan->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 4){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(4, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(4)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_parkir->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_parkir->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 5){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(5, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(5)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_ppj->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_ppj->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 6){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(6, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(6)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_bphtb->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_bphtb->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 8){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(8, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(8)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_pbb->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_pbb->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 9){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(9, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(9)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_reklame->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_reklame->SetValue($dbConn->f("realisasi"));
	 }
	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 10){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(10, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(10)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_pat->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_pat->SetValue($dbConn->f("realisasi"));
	 }


	 if ($t_target_realisasi_jenisGrid->p_vat_type_id->GetValue() == 999){
		$query = "select o_target,o_target_sebelumnya ,
			f_get_realisasi(7, to_date('".$q_start."'), to_date('".$q_end."')) as realisasi 
			from f_get_target_triwulan_berjalan_per_jenis_pajak_v2(999)";
		$dbConn->query($query);
		$dbConn->next_record();
		$t_target_realisasi_jenisGrid1->target_amount_denda->SetValue($dbConn->f("o_target"));
		$t_target_realisasi_jenisGrid1->realisasi_amt_denda->SetValue($dbConn->f("realisasi"));

		//jumlah target
		$t_target_realisasi_jenisGrid1->target_amount_sum->SetValue(
			$t_target_realisasi_jenisGrid1->target_amount_hotel->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_resto->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_hiburan->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_parkir->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_ppj->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_bphtb->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_denda->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_pbb->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_reklame->GetValue()+
			$t_target_realisasi_jenisGrid1->target_amount_pat->GetValue()
		);
		
		//jumlah realisasi
		$t_target_realisasi_jenisGrid1->realisasi_amt_sum->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_hotel->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_resto->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_hiburan->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_parkir->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_ppj->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_bphtb->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_denda->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_pbb->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_reklame->GetValue()+
			$t_target_realisasi_jenisGrid1->realisasi_amt_pat->GetValue()
		);

		//hitung persentase
		$t_target_realisasi_jenisGrid1->percentage_hotel->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_hotel->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_hotel->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_resto->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_resto->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_resto->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_hiburan->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_hiburan->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_hiburan->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_parkir->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_parkir->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_parkir->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_ppj->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_ppj->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_ppj->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_bphtb->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_bphtb->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_bphtb->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_pbb->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_pbb->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_pbb->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_reklame->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_reklame->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_reklame->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_pat->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_pat->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_pat->GetValue()*100
		);

		$t_target_realisasi_jenisGrid1->percentage_denda->SetValue(0);

		//hitung persentase keseluruhan
		$t_target_realisasi_jenisGrid1->percentage_sum->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_sum->GetValue()/
			$t_target_realisasi_jenisGrid1->target_amount_sum->GetValue()*100
		);

		//hitung selisih
		$t_target_realisasi_jenisGrid1->selisih_hotel->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_hotel->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_hotel->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_resto->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_resto->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_resto->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_hiburan->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_hiburan->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_hiburan->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_parkir->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_parkir->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_parkir->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_ppj->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_ppj->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_ppj->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_bphtb->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_bphtb->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_bphtb->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_pbb->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_pbb->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_pbb->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_reklame->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_reklame->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_reklame->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_pat->SetValue(
			$t_target_realisasi_jenisGrid1->realisasi_amt_pat->GetValue()-
			$t_target_realisasi_jenisGrid1->target_amount_pat->GetValue()
		);

		$t_target_realisasi_jenisGrid1->selisih_denda->SetValue(0);

		//hitung selisih keseluruhan
		$t_target_realisasi_jenisGrid1->selisih_sum->SetValue(
			$t_target_realisasi_jenisGrid1->selisih_hotel->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_resto->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_hiburan->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_parkir->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_ppj->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_bphtb->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_denda->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_pbb->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_reklame->GetValue()+
			$t_target_realisasi_jenisGrid1->selisih_pat->GetValue()
		);

		//hitung persentase selisih
		$t_target_realisasi_jenisGrid1->percentage_selisih_hotel->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_hotel->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_resto->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_resto->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_hiburan->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_hiburan->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_parkir->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_parkir->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_ppj->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_ppj->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_bphtb->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_bphtb->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_pbb->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_pbb->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_reklame->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_reklame->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_pat->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_pat->GetValue()-100
		);

		$t_target_realisasi_jenisGrid1->percentage_selisih_denda->SetValue(0);

		//hitung persentase selisih keseluruhan
		$t_target_realisasi_jenisGrid1->percentage_selisih_sum->SetValue(
			$t_target_realisasi_jenisGrid1->percentage_sum->GetValue()-100
		);
	 }

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

//t_target_realisasiGrid_BeforeShowRow @909-52730172
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
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid_BeforeShowRow @909-DFE61ABB
    return $t_target_realisasiGrid_BeforeShowRow;
}
//End Close t_target_realisasiGrid_BeforeShowRow

//t_target_realisasiGrid_BeforeSelect @909-EC247A5A
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

//Close t_target_realisasiGrid_BeforeSelect @909-EF6BE882
    return $t_target_realisasiGrid_BeforeSelect;
}
//End Close t_target_realisasiGrid_BeforeSelect

//t_target_realisasiGrid_BeforeShow @909-AEC772FC
function t_target_realisasiGrid_BeforeShow(& $sender)
{
    $t_target_realisasiGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeShow

//Custom Code @915-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasiGrid_BeforeShow @909-68623F9F
    return $t_target_realisasiGrid_BeforeShow;
}
//End Close t_target_realisasiGrid_BeforeShow

//t_target_realisasi_triwulanGrid1_BeforeShowRow @928-7B334C67
function t_target_realisasi_triwulanGrid1_BeforeShowRow(& $sender)
{
    $t_target_realisasi_triwulanGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_triwulanGrid1; //Compatibility
//End t_target_realisasi_triwulanGrid1_BeforeShowRow

//Custom Code @940-2A29BDB7
// -------------------------
    // Write your own code here.
	$target_triwulan_1 = $Component->DataSource->target_triwulan_1->GetValue();
	$target_triwulan_2 = $Component->DataSource->target_triwulan_2->GetValue();
	$target_triwulan_3 = $Component->DataSource->target_triwulan_3->GetValue();
	$target_triwulan_4 = $Component->DataSource->target_triwulan_4->GetValue();
	$realisasi_triwulan_1 = $Component->DataSource->realisasi_triwulan_1->GetValue();
	$realisasi_triwulan_2 = $Component->DataSource->realisasi_triwulan_2->GetValue();
	$realisasi_triwulan_3 = $Component->DataSource->realisasi_triwulan_3->GetValue();
	$realisasi_triwulan_4 = $Component->DataSource->realisasi_triwulan_4->GetValue();

	 if(!empty($target_triwulan_1) && 
	 !empty($target_triwulan_2) && 
	 !empty($target_triwulan_3) && 
	 !empty($target_triwulan_4)) 
	 {
	 	$percentage_triwulan_1 = number_format($realisasi_triwulan_1 / $target_triwulan_1 * 100, 2, ".", ",");
		$percentage_triwulan_2 = number_format($realisasi_triwulan_2 / $target_triwulan_2 * 100, 2, ".", ",");
		$percentage_triwulan_3 = number_format($realisasi_triwulan_3 / $target_triwulan_3 * 100, 2, ".", ",");
		$percentage_triwulan_4 = number_format($realisasi_triwulan_4 / $target_triwulan_4 * 100, 2, ".", ",");
		$selisih_triwulan_1 = number_format($realisasi_triwulan_1 - $target_triwulan_1 , 2, ".", ",");
		$selisih_triwulan_2 = number_format($realisasi_triwulan_2 - $target_triwulan_2 , 2, ".", ",");
		$selisih_triwulan_3 = number_format($realisasi_triwulan_3 - $target_triwulan_3 , 2, ".", ",");
		$selisih_triwulan_4 = number_format($realisasi_triwulan_4 - $target_triwulan_4 , 2, ".", ",");
		if($percentage_triwulan_1 >= 100) {
			$percentage_selisih_triwulan_1 = $percentage_triwulan_1;
		}else{
			$percentage_selisih_triwulan_1 = number_format($percentage_triwulan_1-100, 2, ".", ",");
		}
		if($percentage_triwulan_2 >= 100) {
			$percentage_selisih_triwulan_2 = $percentage_triwulan_2;
		}else{
			$percentage_selisih_triwulan_2 = number_format($percentage_triwulan_2-100, 2, ".", ",");
		}
		if($percentage_triwulan_3 >= 100) {
			$percentage_selisih_triwulan_3 = $percentage_triwulan_3;
		}else{
			$percentage_selisih_triwulan_3 = number_format($percentage_triwulan_3-100, 2, ".", ",");
		}
		if($percentage_triwulan_4 >= 100) {
			$percentage_selisih_triwulan_4 = $percentage_triwulan_4;
		}else{
			$percentage_selisih_triwulan_4 = number_format($percentage_triwulan_4-100, 2, ".", ",");
		}
	 }else {
		$percentage_triwulan_1 = 0;
		$percentage_triwulan_2 = 0;
		$percentage_triwulan_3 = 0;
		$percentage_triwulan_4 = 0;
		$selisih_triwulan_1 = 0;
		$selisih_triwulan_2 = 0;
		$selisih_triwulan_3 = 0;
		$selisih_triwulan_4 = 0;
		$percentage_selisih_triwulan_1 = 0;
		$percentage_selisih_triwulan_2 = 0;
		$percentage_selisih_triwulan_3 = 0;
		$percentage_selisih_triwulan_4 = 0;
	 }
	 $Component->percentage_triwulan_1->SetValue("$percentage_triwulan_1 %");
	 $Component->percentage_triwulan_2->SetValue("$percentage_triwulan_2 %");
	 $Component->percentage_triwulan_3->SetValue("$percentage_triwulan_3 %");
	 $Component->percentage_triwulan_4->SetValue("$percentage_triwulan_4 %");
	 $Component->selisih_triwulan_1->SetValue("$selisih_triwulan_1");
	 $Component->selisih_triwulan_2->SetValue("$selisih_triwulan_2");
	 $Component->selisih_triwulan_3->SetValue("$selisih_triwulan_3");
	 $Component->selisih_triwulan_4->SetValue("$selisih_triwulan_4");
	 $Component->percentage_selisih_triwulan_1->SetValue("$percentage_selisih_triwulan_1 %");
	 $Component->percentage_selisih_triwulan_2->SetValue("$percentage_selisih_triwulan_2 %");
	 $Component->percentage_selisih_triwulan_3->SetValue("$percentage_selisih_triwulan_3 %");
	 $Component->percentage_selisih_triwulan_4->SetValue("$percentage_selisih_triwulan_4 %");
	
// -------------------------
//End Custom Code

//Close t_target_realisasi_triwulanGrid1_BeforeShowRow @928-34E17A4C
    return $t_target_realisasi_triwulanGrid1_BeforeShowRow;
}
//End Close t_target_realisasi_triwulanGrid1_BeforeShowRow

//t_target_realisasi_triwulanGrid1_BeforeSelect @928-9547512F
function t_target_realisasi_triwulanGrid1_BeforeSelect(& $sender)
{
    $t_target_realisasi_triwulanGrid1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_triwulanGrid1; //Compatibility
//End t_target_realisasi_triwulanGrid1_BeforeSelect

//Custom Code @941-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasi_triwulanGrid1_BeforeSelect @928-E63D2047
    return $t_target_realisasi_triwulanGrid1_BeforeSelect;
}
//End Close t_target_realisasi_triwulanGrid1_BeforeSelect

//t_target_realisasi_triwulanGrid1_BeforeShow @928-B0AC78B3
function t_target_realisasi_triwulanGrid1_BeforeShow(& $sender)
{
    $t_target_realisasi_triwulanGrid1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_triwulanGrid1; //Compatibility
//End t_target_realisasi_triwulanGrid1_BeforeShow

//Custom Code @942-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasi_triwulanGrid1_BeforeShow @928-39652D95
    return $t_target_realisasi_triwulanGrid1_BeforeShow;
}
//End Close t_target_realisasi_triwulanGrid1_BeforeShow

//t_target_realisasi_jenisGrid1_BeforeSelect @964-8252B760
function t_target_realisasi_jenisGrid1_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenisGrid1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid1; //Compatibility
//End t_target_realisasi_jenisGrid1_BeforeSelect

//Custom Code @987-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid1_BeforeSelect @964-8E71EFFD
    return $t_target_realisasi_jenisGrid1_BeforeSelect;
}
//End Close t_target_realisasi_jenisGrid1_BeforeSelect

//t_target_realisasi_jenisGrid1_BeforeShowRow @964-4D7EED50
function t_target_realisasi_jenisGrid1_BeforeShowRow(& $sender)
{
    $t_target_realisasi_jenisGrid1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid1; //Compatibility
//End t_target_realisasi_jenisGrid1_BeforeShowRow

//Custom Code @988-2A29BDB7
// -------------------------
    // Write your own code here.
	 /*$target = $t_target_realisasi_jenisGrid1->target_amount->GetValue();
	 $realisasi = $t_target_realisasi_jenisGrid1->realisasi_amt->GetValue();

	 $sum_realisasi = $t_target_realisasi_jenisGrid1->realisasi_amt_sum->GetValue();
	 $t_target_realisasi_jenisGrid1->realisasi_amt_sum->SetValue($sum_realisasi+$realisasi);
	 $sum_target = $t_target_realisasi_jenisGrid1->target_amount_sum->GetValue();
	 $t_target_realisasi_jenisGrid1->target_amount_sum->SetValue($sum_target+$target);
	 $sum_percentage = $t_target_realisasi_jenisGrid1->percentage_sum->GetValue();
	 if($sum_target > 0) {
	 	$sum_realisasi = $t_target_realisasi_jenisGrid1->realisasi_amt_sum->GetValue();
		$sum_target = $t_target_realisasi_jenisGrid1->target_amount_sum->GetValue();
		$sum_percentage_temp = $sum_realisasi / $sum_target  * 100;
	 	$t_target_realisasi_jenisGrid1->percentage_sum->SetValue(number_format($sum_percentage_temp, 2, ".", ","));
	 }
	 $t_target_realisasi_jenisGrid1->selisih_sum->SetValue(number_format($sum_realisasi-$sum_target, 2, ".", ","));
	 if($sum_percentage_temp >= 100) {
	 	$t_target_realisasi_jenisGrid1->percentage_selisih_sum->SetValue(number_format($sum_percentage_temp, 2, ".", ","));
	 }else{
		$t_target_realisasi_jenisGrid1->percentage_selisih_sum->SetValue(number_format($sum_percentage_temp - 100, 2, ".", ","));
	 }*/
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid1_BeforeShowRow @964-1F3D6C11
    return $t_target_realisasi_jenisGrid1_BeforeShowRow;
}
//End Close t_target_realisasi_jenisGrid1_BeforeShowRow

//t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect @964-E4640A06
function t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect(& $sender)
{
    $t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid1; //Compatibility
//End t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect

//Custom Code @989-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect @964-8BCF0599
    return $t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect;
}
//End Close t_target_realisasi_jenisGrid1_ds_BeforeExecuteSelect

//t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect @964-C9B1ADAE
function t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect(& $sender)
{
    $t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid1; //Compatibility
//End t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect

//Custom Code @990-2A29BDB7
// -------------------------
    
// -------------------------
//End Custom Code

//Close t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect @964-82C53C00
    return $t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect;
}
//End Close t_target_realisasi_jenisGrid1_ds_BeforeBuildSelect

//DEL  // -------------------------
//DEL      
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      
//DEL  // -------------------------

//Page_OnInitializeView @1-48AF61B8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_view_large_dengan_target_triwulan_v3; //Compatibility
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
	CCSetSession("p_year_period_id2",$item);
	$t_target_realisasi_jenisGrid->p_year_period_id2->SetValue($item);
	//$t_target_realisasi_jenisGrid1->p_year_period_id2->SetValue($item);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-A546DF00
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_view_large_dengan_target_triwulan_v3; //Compatibility
//End Page_BeforeShow

//Custom Code @914-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>

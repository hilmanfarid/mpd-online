<?php
// Start Bdr    
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
// End Bdr    

//BindEvents Method @1-9143D078
function BindEvents()
{
    global $t_vat_setllement_dtlGrid;
    global $CCSEvents;
    $t_vat_setllement_dtlGrid->CCSEvents["BeforeShow"] = "t_vat_setllement_dtlGrid_BeforeShow";
    $t_vat_setllement_dtlGrid->CCSEvents["BeforeSelect"] = "t_vat_setllement_dtlGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

// End Bdr

//DEL      $styles = array("Row", "AltRow");
//DEL  	// Start Bdr    
//DEL      $Style = $styles[0];
//DEL      
//DEL      if ($Component->DataSource->t_vat_setllement_dtl_id->GetValue()== $selected_id) {
//DEL      	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
//DEL          $Style = $styles[1];
//DEL          $is_show_form=1;
//DEL      }	
//DEL  // End Bdr    
//DEL  
//DEL      if (count($styles)) {
//DEL          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
//DEL          if (strlen($Style) && !strpos($Style, "="))
//DEL              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
//DEL          $Component->Attributes->SetValue("rowStyle", $Style);
//DEL      }


//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$t_vat_setllement_dtlGrid->jumlah_service->SetValue(
//DEL  		$t_vat_setllement_dtlGrid->jumlah_service->GetValue()+
//DEL  		$t_vat_setllement_dtlGrid->service_charge->GetValue()
//DEL  	);
//DEL  	$t_vat_setllement_dtlGrid->jumlah_pajak->SetValue(
//DEL  		$t_vat_setllement_dtlGrid->jumlah_pajak->GetValue()+
//DEL  		$t_vat_setllement_dtlGrid->vat_charge->GetValue()
//DEL  	);
//DEL  // -------------------------


//t_vat_setllement_dtlGrid_BeforeShow @2-38B720AD
function t_vat_setllement_dtlGrid_BeforeShow(& $sender)
{
    $t_vat_setllement_dtlGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtlGrid; //Compatibility
//End t_vat_setllement_dtlGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
	//global $Label1;
	$param_arr['t_vat_setllement_id'] = CCGetFromGet('t_vat_setllement_id');
	$t_vat_setllement_dtlGrid->Label1->SetText(GetCetakHTML($param_arr));

//End Custom Code

//Close t_vat_setllement_dtlGrid_BeforeShow @2-CACF216C
    return $t_vat_setllement_dtlGrid_BeforeShow;
}
//End Close t_vat_setllement_dtlGrid_BeforeShow

//t_vat_setllement_dtlGrid_BeforeSelect @2-A6437597
function t_vat_setllement_dtlGrid_BeforeSelect(& $sender)
{
    $t_vat_setllement_dtlGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtlGrid; //Compatibility
//End t_vat_setllement_dtlGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_vat_setllement_dtlGrid_BeforeSelect @2-2AF5C532
    return $t_vat_setllement_dtlGrid_BeforeSelect;
}
//End Close t_vat_setllement_dtlGrid_BeforeSelect

//Page_OnInitializeView @1-940ABFC1
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_dtl_ro_otobuk_tapping; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
    global $add_flag;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_vat_setllement_dtl_id", $selected_id);
    $add_flag=CCGetFromGet("FLAG", "NONE");
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

function GetCetakHTML($param_arr) {
	
	$output = '';
	
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr class="Caption">';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >TANGGAL</th>';
	$output.='<th align="center" >JUMLAH RECEIPT</th>';
	$output.='<th align="center" >SUB TOTAL</th>';
	$output.='<th align="center" >CHARGE</th>';
	$output.='<th align="center" >TAX</th>';
	$output.='<th align="center" >TOTAL</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="select npwd,to_char(start_period,'mm')as bulan,
				to_char(start_period,'yyyy') as tahun 
			from t_vat_setllement 
			where t_vat_setllement_id = ".$param_arr['t_vat_setllement_id'];
	
	//echo $query;exit;
	$dbConn->query($query);
	$dbConn->next_record();
	$data = $dbConn->Record;
	
	$dbConn->close();

	$ws_data = file_get_contents("http://45.118.112.226/dashboard/page/print/print_data_monthly_npwpd.php?bulan=".$data['bulan']."&tahun=".$data['tahun']."&npwpd=".$data['npwd']);
	$ws_data = json_decode($ws_data);
	$ws_data = $ws_data->items;
	//print_r($ws_data[1]->no);exit;
	$total_jml_receipt=0;
	$total_sub_total=0;
	$total_charge=0;
	$total_tax=0;
	$total_total=0;
	for ($i = 0; $i < count($ws_data); $i++) {
		$output.='<tr><td align="center" >'.$ws_data[$i]->no.'</td>';
		$output.='<td align="left" >'.$ws_data[$i]->tanggal.'</td>';
		$output.='<td align="right" >'.$ws_data[$i]->jml_receipt.'</td>';
		$output.='<td align="right" >'.number_format($ws_data[$i]->sub_total, 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($ws_data[$i]->charge, 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($ws_data[$i]->tax, 2, ',', '.').'</td>';
		$output.='<td align="right" >'.number_format($ws_data[$i]->total, 2, ',', '.').'</td>';
		$output.='</tr>';
		$total_jml_receipt=$total_jml_receipt+$ws_data[$i]->jml_receipt;
		$total_sub_total=$total_sub_total+$ws_data[$i]->sub_total;
		$total_charge=$total_charge+$ws_data[$i]->charge;
		$total_tax=$total_tax+$ws_data[$i]->tax;
		$total_total=$total_total+$ws_data[$i]->total;
	}
	$output.='<tr><td align="center" colspan=2>TOTAL</td>';
	$output.='<td align="right" >'.$total_jml_receipt.'</td>';
	$output.='<td align="right" >'.number_format($total_sub_total, 2, ',', '.').'</td>';
	$output.='<td align="right" >'.number_format($total_charge, 2, ',', '.').'</td>';
	$output.='<td align="right" >'.number_format($total_tax, 2, ',', '.').'</td>';
	$output.='<td align="right" >'.number_format($total_total, 2, ',', '.').'</td>';
	$output.='</tr>';

	$output.='</table>';
	
	return $output;
}
?>

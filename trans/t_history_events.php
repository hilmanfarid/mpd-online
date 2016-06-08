<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-DA5540AF
function BindEvents()
{
    global $p_room_typeGrid;
    global $CCSEvents;
    $p_room_typeGrid->CCSEvents["BeforeSelect"] = "p_room_typeGrid_BeforeSelect";
    $p_room_typeGrid->CCSEvents["BeforeShowRow"] = "p_room_typeGrid_BeforeShowRow";
    $p_room_typeGrid->ds->CCSEvents["BeforeBuildSelect"] = "p_room_typeGrid_ds_BeforeBuildSelect";
    $p_room_typeGrid->ds->CCSEvents["BeforeExecuteSelect"] = "p_room_typeGrid_ds_BeforeExecuteSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
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

//p_room_typeGrid_ds_BeforeBuildSelect @2-79D0A5AE
function p_room_typeGrid_ds_BeforeBuildSelect(& $sender)
{
    $p_room_typeGrid_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_room_typeGrid; //Compatibility
//End p_room_typeGrid_ds_BeforeBuildSelect

//Custom Code @177-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close p_room_typeGrid_ds_BeforeBuildSelect @2-0F07845F
    return $p_room_typeGrid_ds_BeforeBuildSelect;
}
//End Close p_room_typeGrid_ds_BeforeBuildSelect

//p_room_typeGrid_ds_BeforeExecuteSelect @2-18B85772
function p_room_typeGrid_ds_BeforeExecuteSelect(& $sender)
{
    $p_room_typeGrid_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $p_room_typeGrid; //Compatibility
//End p_room_typeGrid_ds_BeforeExecuteSelect

//Custom Code @178-2A29BDB7
// -------------------------
    // Write your own code here.
	if ( CCGetFromGet('s_keyword','') ==  '' && 
		 CCGetFromGet('p_vat_type_id','') ==  '' &&
		 CCGetFromGet('date_start_laporan','') ==  '' &&
		 CCGetFromGet('date_end_laporan','') ==  ''){
		
		$p_room_typeGrid->Visible=false;	
	
		$p_room_typeGrid->DataSource->SQL = 'select 1';
		$p_room_typeGrid->DataSource->CountSQL= 'select 1';
		$p_room_typeGrid->DataSource->Where= '';
		$p_room_typeGrid->DataSource->Order= '';
		return false;
	}else{
		$p_room_typeGrid->Visible=true;
		if ( CCGetFromGet('date_end_laporan','') !=  '' ){
			$p_room_typeGrid->DataSource->SQL .= " and (trunc(modification_date) <= '".CCGetFromGet('date_end_laporan','')."')";
		}
		if ( CCGetFromGet('date_start_laporan','') !=  '' ){
			$p_room_typeGrid->DataSource->SQL .= " and (trunc(modification_date) >= '".CCGetFromGet('date_start_laporan','')."')";
		}
		
		if ( CCGetFromGet('p_vat_type_id','') !=  '' ){
			$p_room_typeGrid->DataSource->SQL .= " and (h.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id = ".CCGetFromGet('p_vat_type_id','')."))";
		}

		$p_room_typeGrid->DataSource->SQL .= " order by modification_date desc";
	}
	//$p_room_typeGrid->DataSource->SQL .= 'asdasda';
	//echo $p_room_typeGrid->DataSource->SQL;		
	//echo $p_room_typeGrid->DataSource->Where;
	//exit; 
// -------------------------
//End Custom Code

//Close p_room_typeGrid_ds_BeforeExecuteSelect @2-7356F27E
    return $p_room_typeGrid_ds_BeforeExecuteSelect;
}
//End Close p_room_typeGrid_ds_BeforeExecuteSelect

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

//Page_BeforeShow @1-0BC6A8F6
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_history; //Compatibility
//End Page_BeforeShow

//Custom Code @184-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	//global $Label1;
	$param_arr['s_keyword'] = CCGetFromGet('s_keyword');
	$param_arr['vat_code'] = CCGetFromGet('vat_code');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
	$param_arr['date_start_laporan'] = CCGetFromGet('date_start_laporan');
	$param_arr['date_end_laporan'] = CCGetFromGet('date_end_laporan');
	if($doAction == 'view_excel') {
		GetCetakExcel($param_arr);
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
function startExcel($filename = "laporan.xls") {
    
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
}

function GetCetakExcel($param_arr) {
	
	startExcel("history.xls");
	
	$output = '';
	
	$output .='<table id="table-piutang" class="grid-table-container" border="0" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top">';

	$output .='<table class="grid-table" border="0" cellspacing="0" cellpadding="0" width="900">
                	<tr>
                  		<td class="th"><strong>HISTORY</strong></td> 
                	</tr>
              		</table>';
	
	$output .='<table id="table-piutang-detil" class="Grid" border="1" cellspacing="0" cellpadding="3px" width="100%">
                <tr >';

	$output.='<th align="center" >NO</th>';
	$output.='<th align="center" >NPWPD</th>';
	$output.='<th align="center" >PERIODE</th>';
	$output.='<th align="center" >TANGAL TAP</th>';
	$output.='<th align="center" >Execute By</th>';
	$output.='<th align="center" >Modification Type</th>';
	$output.='<th align="center" >Modification Date</th>';
	$output.='<th align="center" >Reason</th>';
	$output.='</tr>';
	
	$dbConn	= new clsDBConnSIKP();
	$query="SELECT h.*, p.code, t.code as type_code
			FROM h_vat_setllement h
			LEFT JOIN p_finance_period p on p.p_finance_period_id = h.p_finance_period_id
			LEFT JOIN p_settlement_type t on t.p_settlement_type_id = h.p_settlement_type_id
			WHERE h.npwd LIKE '%".$param_arr['s_keyword']."%'";

	if ( $param_arr['date_end_laporan'] !=  '' ){
		$query .= " and (trunc(modification_date) <= '".$param_arr['date_end_laporan']."')";
	}
	if ( $param_arr['date_start_laporan'] !=  '' ){
		$query .= " and (trunc(modification_date) >= '".$param_arr['date_start_laporan']."')";
	}
	
	if ( $param_arr['p_vat_type_id'] !=  '' ){
		$query .= " and (h.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id = ".$param_arr['p_vat_type_id']."))";
	}

	$query .= " order by modification_date desc";
	//echo $query;exit;
	$data = array();
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$data[] = $dbConn->Record;
	}
	$dbConn->close();

	for ($i = 0; $i < count($data); $i++) {
		$output.='<tr><td align="center" >'.($i+1).'</td>';
		$output.='<td align="left" >'.$data[$i]['npwd'].'</td>';
		$output.='<td align="left" >'.$data[$i]['code'].'</td>';
		$output.='<td align="left" >'.$data[$i]['type_code'].'</td>';
		$output.='<td align="left" >'.$data[$i]['settlement_date'].'</td>';
		$output.='<td align="left" >'.$data[$i]['modified_by'].'</td>';
		$output.='<td align="left" >'.$data[$i]['modification_type'].'</td>';
		$output.='<td align="left" >'.$data[$i]['alasan'].'</td>';
		$output.='<td align="left" >'.$data[$i]['payment_date'].'</td>';
		$output.='</tr>';
	}

	$output.='</table>';

	echo $output;
	exit;
}
?>

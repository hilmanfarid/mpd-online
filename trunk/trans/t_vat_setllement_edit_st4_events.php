<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-62922174
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementForm->update_denda->CCSEvents["OnClick"] = "t_vat_setllementForm_update_denda_OnClick";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

//Set Row Style @315-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

// Start Bdr
    global $t_vat_setllementForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_vat_setllement_id->GetValue();
        $t_vat_setllementForm->DataSource->Parameters["urlt_vat_setllement_id"] = $selected_id;
        $t_vat_setllementForm->DataSource->Prepare();
        $t_vat_setllementForm->EditMode = $t_vat_setllementForm->DataSource->AllParametersSet;
        
   }
// End Bdr 

      $styles = array("Row", "AltRow");
  	// Start Bdr    
          $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
          $Style = $styles[0];
          
          if ($Component->DataSource->t_vat_setllement_id->GetValue()== $selected_id) {
          	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
              $Style = $styles[1];
              $is_show_form=1;
          }	
      // End Bdr  
      if (count($styles)) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	 $Component->DLink->SetValue($img_radio); // Bdr
//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//t_vat_setllementForm_update_denda_OnClick @397-0030E755
function t_vat_setllementForm_update_denda_OnClick(& $sender)
{
    $t_vat_setllementForm_update_denda_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_update_denda_OnClick

//Custom Code @398-2A29BDB7
// -------------------------
    // Write your own code here.
	$dbConn = new clsDBConnSIKP();	
	$selected_id=$t_vat_setllementForm->t_vat_setllement_id->GetValue();
	//echo $selected_id." ".CCGETUserLogin();exit; 
	$query = "select f_hitung_ulang_denda as hasil from 
		f_hitung_ulang_denda(".$selected_id.",'".CCGETUserLogin()."')";
	//echo $query;exit;
	$dbConn->query($query);
	$dbConn->next_record();
	$hasil = $dbConn->f("hasil");
	if ($hasil=="OK"){
		echo "<script>
				alert ('Denda berhasil diperbaharui');
			</script>";
	}else{
		echo "<script>
				alert ('Denda gagal diperbaharui'".$hasil.");
			</script>";
	}
	return;
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_update_denda_OnClick @397-F71BE8B5
    return $t_vat_setllementForm_update_denda_OnClick;
}
//End Close t_vat_setllementForm_update_denda_OnClick

//DEL  // -------------------------
//DEL      
//DEL  // -------------------------

//Page_OnInitializeView @1-EC33A83E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_edit_st4; //Compatibility
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
          $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-727D752C
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_edit_st4; //Compatibility
//End Page_BeforeShow

//Custom Code @260-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
		global $selected_id;
		$selected_id = CCGetFromGet("t_vat_setllement_id", $selected_id);
		$flag_delete = CCGetFromGet("flag_delete", "");
		if($flag_delete == "true"){
			$dbConn = new clsDBConnSIKP();
			$dbConn->query("select f_del_vat_setllement($selected_id, 0, 'x')");
			$dbConn->close();
			header("Location: t_vat_setllement_edit_st4.php");
		}
		$doAction = CCGetFromGet('doAction');
		if($doAction == 'cetak_excel') {
			print_excel();
		}
		
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

function print_excel() {
	
	startExcel("laporan_SKPD-SKPDKB_JABATAN");
	echo "<div><h3> LAPORAN PENCETAKAN SKPD - SKPDKB JABATAN</h3></div>";
		
	$no =1;

	echo "<table border='1'>";
	echo "<tr>
		<th>NO</th>
		<th>NPWPD</th>	
		<th>NAMA WP</th>
		<th>JENIS PAJAK</th>
		<th>PERIODE</th>
		<th>TOTAL PAJAK</th>
		<th>DENDA</th>
	</tr>";

	$user				= CCGetUserLogin();
	$data				= array();
	$dbConn				= new clsDBConnSIKP();
	$keyword = CCGetFromGet('s_keyword');
	$periode = CCGetFromGet('s_periode');

	$query = "SELECT * 
		FROM v_vat_setllement_skpd_kb_jabatan a
		left join p_finance_period x on x.p_finance_period_id=a.p_finance_period_id
		WHERE ( upper(a.npwd) LIKE '%".$keyword."%'
		OR upper(a.wp_name) LIKE '%".$keyword."%'
		OR upper(a.settlement_type) LIKE '%".$keyword."%'
		OR upper(a.finance_period_code) LIKE '%".$keyword."%' )
		and (
		 f_search_finance_period(a.finance_period_code) ilike '%".$periode."%'
		) 
		ORDER BY x.start_date, a.jenis_pajak, a.wp_name";
	$dbConn->query($query);

	$jumlah_pajak = 0;
	$jumlah_denda = 0;

	while ($dbConn->next_record()) {
		$data[]=$item =  array(
		"npwd"	=> $dbConn->f("npwd"),
		"wp_name"	=> $dbConn->f("wp_name"),
		"jenis_pajak"	=> $dbConn->f("jenis_pajak"),
		"finance_period_code"		=> $dbConn->f("finance_period_code"),
		"total_vat_amount"	=> $dbConn->f("total_vat_amount"),
		"total_penalty_amount"		=> $dbConn->f("total_penalty_amount"));
		
		echo "<tr>
			<td>".$no."</td>
			<td>".$item['npwd']."</td>
			<td>".$item['wp_name']."</td>
			<td>".$item['jenis_pajak']."</td>
			<td>".$item['finance_period_code']."&nbsp;</td>
			<td align='right'>".number_format($item['total_vat_amount'], 2, ',', '.')."</td>
			<td align='right'>".number_format($item['total_penalty_amount'],2,',', '.')."</td>
		</tr>";


		$jumlah_pajak += $dbConn->f("total_vat_amount");
		$jumlah_denda += $dbConn->f("total_penalty_amount");
		$no++;
	}
	
	

	echo '<tr>
		<td colspan="5" align="center"> <b>JUMLAH </b></td>
		<td align="right"> <b>'.number_format($jumlah_pajak, 2, ",", ".").' </b></td>
		<td align="right"> <b>'.number_format($jumlah_denda, 2, ",", ".").' </b></td>
	</tr>';
	echo "</table>";
	exit;
}

?>

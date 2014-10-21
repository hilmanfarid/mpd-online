<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-F5F17B71
function BindEvents()
{
    global $t_customerGrid;
    global $t_customerSearch;
    global $CCSEvents;
    $t_customerGrid->CCSEvents["BeforeShowRow"] = "t_customerGrid_BeforeShowRow";
    $t_customerGrid->CCSEvents["BeforeSelect"] = "t_customerGrid_BeforeSelect";
    $t_customerSearch->CCSEvents["BeforeShow"] = "t_customerSearch_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_customerGrid_BeforeShowRow @2-75C38576
function t_customerGrid_BeforeShowRow(& $sender)
{
    $t_customerGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerGrid; //Compatibility
//End t_customerGrid_BeforeShowRow

// Start Bdr
    global $t_customer_updateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;
	
    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_customer_id->GetValue();
        $t_customer_updateForm->DataSource->Parameters["urlt_customer_id"] = $selected_id;
        $t_customer_updateForm->DataSource->Prepare();
        $t_customer_updateForm->EditMode = $t_customer_updateForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_customer_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    

    if (count($styles)) {
//        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
    $Component->DLink->SetValue($img_radio); // Bdr

//Close t_customerGrid_BeforeShowRow @2-7E840202
    return $t_customerGrid_BeforeShowRow;
}
//End Close t_customerGrid_BeforeShowRow

//t_customerGrid_BeforeSelect @2-95E5E7C8
function t_customerGrid_BeforeSelect(& $sender)
{
    $t_customerGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerGrid; //Compatibility
//End t_customerGrid_BeforeSelect
	$p_vat_type_id = CCGetFromGet('p_vat_type_id');
	$p_vat_type_dtl_id = CCGetFromGet('p_vat_type_dtl_id');
	/*if(empty($p_vat_type_id)){
		$t_customerGrid->DataSource->Parameters["urlp_vat_type_id"]='%%';
	}*/
	if(empty($p_vat_type_dtl_id)){
		$t_customerGrid->DataSource->Parameters["urlp_vat_type_dtl_id"]='';
	}else{
		$t_customerGrid->DataSource->Parameters["urlp_vat_type_dtl_id"]=' AND b.p_vat_type_dtl_id ='.$p_vat_type_dtl_id;
	}
	/*
			select *
			from t_customer a 
			where (upper(a.company_owner) like upper('%{s_keyword}%') 
			       or upper(a.address_name_owner) like upper('%{s_keyword}%')
			       )
	       and exists (select 1 from t_cust_account x
	                   where x.t_customer_id = a.t_customer_id 
	                        and upper(x.npwd) like upper('%{s_npwd}%')
	                        and upper(x.wp_name) like upper('%{s_wp_name}%')
	                        and upper(x.company_name) like upper('%{s_company_name}%')
	                        and upper(x.company_brand) like upper('%{s_company_brand}%')
                  		)
	*/
//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_customerGrid_BeforeSelect @2-5CE02F23
    return $t_customerGrid_BeforeSelect;
}
//End Close t_customerGrid_BeforeSelect

//t_customerSearch_BeforeShow @3-383CCE23
function t_customerSearch_BeforeShow(& $sender)
{
    $t_customerSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerSearch; //Compatibility
//End t_customerSearch_BeforeShow

//Custom Code @532-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_customerSearch_BeforeShow @3-A3C577C3
    return $t_customerSearch_BeforeShow;
}
//End Close t_customerSearch_BeforeShow

//Page_OnInitializeView @1-5ABEFA57
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_report; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_customer_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-3DE84F02
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_report; //Compatibility
//End Page_BeforeShow

//Custom Code @538-2A29BDB7
// -------------------------
    if(CCGetFromGet('view_report') == 'cetak_excel') {
		$param_arr=array();
		$param_arr['s_npwd'] = CCGetFromGet('s_npwd');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
		$param_arr['p_vat_type_dtl_id'] = CCGetFromGet('p_vat_type_dtl_id');
		$param_arr['s_wp_name'] = CCGetFromGet('s_wp_name');
		$param_arr['s_company_name'] = CCGetFromGet('s_company_name');
		$param_arr['s_company_brand'] = CCGetFromGet('s_company_brand');
		$param_arr['s_keyword'] = CCGetFromGet('s_keyword');
		print_excel($param_arr);
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

function print_excel($param_arr) {

	startExcel("daftar_wajib_pajak".date('Y-m-d'));
	echo '<div align="center"><h3> DAFTAR WAJIB PAJAK</h3></div>';	
		
	echo '<table border="1">';
	echo '<tr>
		<th>NO</th>
		<th>NAMA PEMILIK/PENGELOLA</th>
		<th>NPWD</th>
		<th>ALAMAT</th>
		<th>JENIS PAJAK</th>
		<th>AYAT PAJAK</th>
		<th>NO SELULAR</th>
		<th>EMAIL</th>
	</tr>';
	
	
	$dbConn = new clsDBConnSIKP();
	
	$query="select a.*, b.npwd, c.vat_code, d.vat_code as detail_pajak_code
			FROM t_customer a
			LEFT JOIN t_cust_account b ON a.t_customer_id = b.t_customer_id
			LEFT JOIN p_vat_type c ON b.p_vat_type_id = c.p_vat_type_id
			LEFT JOIN p_vat_type_dtl d ON b.p_vat_type_dtl_id = d.p_vat_type_dtl_id

			WHERE upper(a.company_owner) like upper('%".$param_arr['s_keyword']."%') 
			       and upper(a.address_name_owner) like upper('%".$param_arr['s_keyword']."%')
			       and upper(b.npwd) like upper('%".$param_arr['s_npwd']."%')
			       and upper(b.wp_name) like upper('%".$param_arr['s_wp_name']."%')
			       and upper(b.company_name) like upper('%".$param_arr['s_company_name']."%')
			       and upper(b.company_brand) like upper('%".$param_arr['s_company_brand']."%')
				   and b.p_vat_type_id like '%".$param_arr['p_vat_type_id']."%'
				   and b.p_vat_type_dtl_id like '%".$param_arr['p_vat_type_dtl_id']."%'
				   and b.p_account_status_id = 1
				   ";
	$dbConn->query($query);
	
	$no = 1;
	while($dbConn->next_record()){
		echo '<tr>';
		echo '<td valign="top" align="center">'.$no++.'</td>';
		echo '<td valign="top" >'.$dbConn->f("company_owner").'</td>';
		echo '<td valign="top" align="center">'.$dbConn->f("npwd").'</td>';
		echo '<td valign="top" >'.$dbConn->f("address_name_owner")." No ".$dbConn->f("address_no_owner")." RT/RW : ".$dbConn->f("address_rt_owner")."/".$dbConn->f("address_rw_owner").'</td>';
		echo '<td valign="top" >'.$dbConn->f("vat_code").'</td>';
		echo '<td valign="top" >'.$dbConn->f("detail_pajak_code").'</td>';
		echo '<td valign="top" >'.$dbConn->f("mobile_no_owner").'</td>';
		echo '<td valign="top" >'.$dbConn->f("email_address").'</td>';
		echo '</tr>';
	}

	echo '</table>';
	exit;
}
?>

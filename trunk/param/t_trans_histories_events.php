<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-06DE6343
function BindEvents()
{
    global $HistoryGrid;
    global $CCSEvents;
    $HistoryGrid->CCSEvents["BeforeShowRow"] = "HistoryGrid_BeforeShowRow";
    $HistoryGrid->CCSEvents["BeforeSelect"] = "HistoryGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//HistoryGrid_BeforeShowRow @2-85406CB0
function HistoryGrid_BeforeShowRow(& $sender)
{
    $HistoryGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close HistoryGrid_BeforeShowRow @2-D25D4DF5
    return $HistoryGrid_BeforeShowRow;
}
//End Close HistoryGrid_BeforeShowRow

//HistoryGrid_BeforeSelect @2-63E3CC27
function HistoryGrid_BeforeSelect(& $sender)
{
    $HistoryGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $HistoryGrid; //Compatibility
//End HistoryGrid_BeforeSelect

//Custom Code @121-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close HistoryGrid_BeforeSelect @2-39569808
    return $HistoryGrid_BeforeSelect;
}
//End Close HistoryGrid_BeforeSelect

//Page_OnInitializeView @1-3FFC46DC
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_trans_histories; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-58AAF389
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_trans_histories; //Compatibility
//End Page_BeforeShow

//Custom Code @146-2A29BDB7
// -------------------------
    // Write your own code here.
	if(CCGetFromGet('view_report') == 'cetak_excel') {
		$param_arr=array();
		$param_arr['t_cust_acc_id'] = CCGetFromGet('t_cust_acc_id','');
		if ($param_arr['t_cust_acc_id'] != ''){
			print_excel($param_arr);
		}else{
			exit;
		}
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

	startExcel("HISTORY_TRANSAKSI_WAJIB_PAJAK_".date('Y-m-d'));
	echo '<div align="center"><h3> DAFTAR WAJIB PAJAK</h3></div>';	
		
	echo '<table border="1">';
	echo '<tr>
		<th>NO</th>
		<th>NPWPD</th>
		<th>Nama Badan</th>
		<th>Jenis Ketetapan</th>
		<th>Periode Pelaporan</th>
		<th>Periode Transaksi</th>
		<th>Tgl. Pelaporan</th>
		<th>Total Transaksi</th>
		<th>Total Pajak</th>
		<th>Denda</th>
		<th>No. Kwitansi</th>
		<th>Tgl. Pembayaran</th>
		<th>Nilai Pembayaran</th>
	</tr>';
	
	
	$dbConn = new clsDBConnSIKP();
	
	$query= " Select c.npwd , 
				   a.t_vat_setllement_id,	
				   c.t_cust_account_id,
			       c.company_name, 
			       b.code as Periode_pelaporan, 
			       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
			       a.total_trans_amount as total_transaksi,
			       a.total_vat_amount as total_pajak ,
				   a.total_penalty_amount as total_denda,
			       to_char(d.receipt_no) as kuitansi_pembayaran,
			       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
			       d.payment_amount,
			       c.t_cust_account_id ,
			       b.p_finance_period_id ,
			       to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,
			       to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan,
				   e.code as type_code
			from t_vat_setllement a ,
			     p_finance_period b,
			     t_cust_account c,
			     t_payment_receipt d,
				 p_settlement_type e
			where a.p_finance_period_id = b.p_finance_period_id
			      and a.t_cust_account_id = c.t_cust_account_id
				  and a.t_cust_account_id = ".$param_arr['t_cust_acc_id']."
			      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
				  and a.p_settlement_type_id = e.p_settlement_type_id
			order by c.npwd , b.start_date desc,
			  a.t_vat_setllement_id";

	$dbConn->query($query);
	
	$no = 1;
	while($dbConn->next_record()){
		echo '<tr>';
		echo '<td valign="top" align="center">'.$no++.'</td>';
		echo '<td valign="top" >'.$dbConn->f("npwd").'</td>';
		echo '<td valign="top" >'.$dbConn->f("company_name").'</td>';
		echo '<td valign="top" >'.$dbConn->f("type_code").'</td>';
		echo '<td valign="top" >'.$dbConn->f("Periode_pelaporan").'</td>';
		echo '<td valign="top" >'.$dbConn->f("periode_awal_laporan").' s.d. '.$dbConn->f("periode_akhir_laporan").'</td>';
		echo '<td valign="top">'.$dbConn->f("tgl_pelaporan").'&nbsp;</td>';
		echo '<td valign="top">'.$dbConn->f("total_transaksi").'</td>';
		echo '<td valign="top">'.$dbConn->f("total_pajak").'</td>';
		echo '<td valign="top">'.$dbConn->f("total_denda").'</td>';
		echo '<td valign="top">'.$dbConn->f("kuitansi_pembayaran").'&nbsp;</td>';
		echo '<td valign="top">'.$dbConn->f("tgl_pembayaran").'&nbsp;</td>';
		echo '<td valign="top">'.$dbConn->f("payment_amount").'</td>';
		echo '</tr>';
	}

	echo '</table>';
	exit;
}
?>

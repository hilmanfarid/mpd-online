<?php

//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeInitialize @1-8D041093
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letter_view_excel; //Compatibility
//End Page_BeforeInitialize

//Custom Code @65-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

	if(isset($_POST["t_customer_order_id"]) && isset($_POST["p_vat_type_id"])){
		$t_customer_order_id = $_POST["t_customer_order_id"];
		$p_vat_type_id = $_POST["p_vat_type_id"];
		$p_account_status_array = $_POST["p_account_status_array"];
		header("Location: ../report/view_daftar_surat_teguran_pdf.php?t_customer_order_id=$t_customer_order_id&p_vat_type_id=$p_vat_type_id&p_account_status_array=$p_account_status_array");
		exit;
	}

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_BeforeShow @1-A3E02737
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letter_view_excel; //Compatibility
//End Page_BeforeShow

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
	$cetak_excel = CCGetFromGet("cetak_excel", 0);
	$t_customer_order_id = CCGetFromGet("t_customer_order_id", 0);
	$p_vat_type_id = CCGetFromGet("p_vat_type_id", 0);
	$param_arr=array();
	if ($cetak_excel == 1){
		$param_arr['p_vat_type_id']=$p_vat_type_id;
		$param_arr['t_customer_order_id']=$t_customer_order_id;
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
	$dbConn = new clsDBConnSIKP();
	$query = "select upper(vat_code)as vat_code from p_vat_type where p_vat_type_id = ".$param_arr['p_vat_type_id'];
	
	$vat_code='';
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$vat_code = $dbConn->f("vat_code");
	}
	$query="select 'SURAT_TEGURAN_'||sequence_no||'_'||replace('".$vat_code."',' ','_')||'_PERIODE_'||replace(code,' ','_') AS judul
		from t_debt_letter a
		left join p_finance_period x on a.p_finance_period_id=x.p_finance_period_id
		where t_customer_order_id=".$param_arr['t_customer_order_id'];
	$judul='';
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$judul = $dbConn->f("judul");
	}

	startExcel("LAPORAN_".$judul.".xls");
	echo "<div><h3> DAFTAR SURAT TEGURAN PAJAK ".$vat_code." </h3></div>";	
	echo "<div><b>Tanggal cetak : ".date('d-M-Y')."</b></div><br/>";	
	$no =1;
	

	echo "<table border='1'>";
	echo "<tr>
		<th>NO</th>
		<th>NPWPD</th>	
		<th>NAMA</th>
		<th>ALAMAT</th>
		<th>JATUH TEMPO</th>
		<th>MASA PAJAK</th>
		<th>BESARNYA</th>
		<th>KETERANGAN</th>
	</tr>";

	$query = "select * from f_debt_letter_list(".$param_arr['t_customer_order_id'].") as a 
		  LEFT JOIN t_cust_account as b ON a.t_cust_account_id = b.t_cust_account_id
		  WHERE a.p_vat_type_id = ".$param_arr['p_vat_type_id']." AND b.p_vat_type_dtl_id NOT IN (11, 15, 17, 21, 27, 30, 41, 42, 43)";

	$dbConn->query($query);
	while($dbConn->next_record()){		
		$items[]= $item = array(
		   'npwd' => $dbConn->f("npwd"),
		   'company_name' => $dbConn->f("company_name"),
		   'wp_name' => $dbConn->f("wp_name"),
		   'address_name' => $dbConn->f("address_name"),
		   'wp_address_name' => $dbConn->f("wp_address_name"),
		   'wp_address_no' => $dbConn->f("wp_address_no"),
		   'vat_code' => $dbConn->f("vat_code"),
		   'due_date' => $dbConn->f("due_date"),
		   'start_date' => $dbConn->f("start_date"),
		   'end_date' => $dbConn->f("end_date"),
		   'debt_amount' => $dbConn->f("debt_amount"),
		   'description' => $dbConn->f("description")
		);

		if ($item['company_name']=='-' || empty($item['company_name'])){
			$item['company_name']=$item['wp_name'];
		}
		if ($item['address_name']=='-' || empty($item['address_name'])){
			$item['address_name']=$item['wp_address_name'].' '.$item['wp_address_no'];
		}
		echo "<tr>
			<td>".$no."</td>
			<td>".$item['npwd']."</td>
			<td>".$item['company_name']."</td>
			<td>".$item['address_name']."</td>
			<td>".$item['due_date']."</td>
			<td>".$item['start_date']." s.d. ".$item['end_date']."</td>
			<td align='right'>".number_format($item['debt_amount'], 2, ',', '.')."</td>
			<td>".$item['description']."</td>
		</tr>";
		$no++;
	}
	echo "</table>";
	exit;
}
?>

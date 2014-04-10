<?php
//BindEvents Method @1-EF623785
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_OnInitializeView @1-C3D34600
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_idx_kepatuhan_wp; //Compatibility
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

//Page_BeforeShow @1-D8B5B5CE
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_idx_kepatuhan_wp; //Compatibility
//End Page_BeforeShow
	global $Label1;
	global $t_rep_idx_kepatuhan_wpSearch;
//Custom Code @566-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
	$doAction = CCGetFromGet('doAction');
	
	$data = array();
	$param_arr = array();
				
	$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
	$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
	$param_arr['status'] = CCGetFromGet('status');

	$param_arr['tahun_periode'] = CCGetFromGet('tahun_periode');
	$param_arr['jenis_pajak'] = CCGetFromGet('jenis_pajak');
	$param_arr['status_text'] = CCGetFromGet('status_text');
	
	$t_rep_idx_kepatuhan_wpSearch->p_year_period_id->SetValue($param_arr['p_year_period_id']);
	$t_rep_idx_kepatuhan_wpSearch->year_code->SetValue($param_arr['tahun_periode']);
	
	$t_rep_idx_kepatuhan_wpSearch->p_vat_type_id->SetValue($param_arr['p_vat_type_id']);
	$t_rep_idx_kepatuhan_wpSearch->vat_code->SetValue($param_arr['jenis_pajak']);
	
	$t_rep_idx_kepatuhan_wpSearch->ListBox1->SetValue($param_arr['status']);

	if($doAction == 'download_excel') {
		
		if(!empty($param_arr['p_year_period_id']) and !empty($param_arr['p_vat_type_id']) and !empty($param_arr['status'])) {
			print_excel($param_arr);
		
		}else {
			/* Tampilkan Alert */
			echo '<script> alert("Semua Filter Harus Diisi"); </script>';
		}
	} else {
		
		//do nothing 
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


function print_excel($param_arr) {
	
	startExcel("index_kepatuhan_wp_".$param_arr['tahun_periode']."_".str_replace(' ','',$param_arr['jenis_pajak']));
	echo "<div><h3> INDEX KEPATUHAN WAJIB PAJAK </h3></div>";	
	echo "<div><b>TAHUN PAJAK : ".$param_arr['tahun_periode']."</b></div>";	
	echo "<div><b>JENIS PAJAK : ".$param_arr['jenis_pajak']."</b></div>";
	echo "<div><b>STATUS : ".$param_arr['status_text']."</b></div><br/>";

	$arrBatas = array();
	$arrBatas = getBatasPembayaran($param_arr['p_year_period_id'], $param_arr['p_vat_type_id'], $param_arr['status']);
	
	$dbConn = new clsDBConnSIKP();
		
	//BESAR
	echo '
		<br/> <h4> <u>I. RANKING BESAR </u></h4> 
		<table border="1">
			<tr>
				<th width="25">NO</th>
				<th width="150">NAMA WP </th>
				<th width="300">ALAMAT</th>
				<th width="150">NPWPD</th>
				<th width="150">RATA-RATA <br/> TGL BAYAR</th>
				<th width="150">RATA-RATA <br/> PEMBAYARAN</th>
			</tr>';
	$query = "select * from f_rep_index_kepatuhan(".$param_arr['p_year_period_id'].", ".$param_arr['p_vat_type_id'].", ".$param_arr['status'].") where rata_rata_pembayaran > ".$arrBatas['batas_atas']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
	$dbConn->query($query);
	$no = 1;
	while ($dbConn->next_record()) {
		//$result['batas_tengah'] = $dbConn->f('batas_tengah');
		echo '<tr>';
		echo '<td>'.$no++.'</td>';
		echo '<td>'.$dbConn->f('nama').'</td>';
		echo '<td>'.$dbConn->f('alamat').'</td>';
		echo '<td>'.$dbConn->f('npwpd').'</td>';
		echo '<td align="right">'.$dbConn->f('rata_rata_tgl_byr').'</td>';
		echo '<td align="right">'.$dbConn->f('rata_rata_pembayaran').'</td>';
		echo '</tr>';
	}
	echo '</table>';
	$dbConn->close();

	//MENENGAH
	$dbConn = new clsDBConnSIKP();
	echo '
		<br/><br/> <h4><u>II. RANKING MENENGAH </u></h4> 
		<table border="1">
			<tr>
				<th width="25">NO</th>
				<th width="150">NAMA WP </th>
				<th width="300">ALAMAT</th>
				<th width="150">NPWPD</th>
				<th width="150">RATA-RATA <br/> TGL BAYAR</th>
				<th width="150">RATA-RATA <br/> PEMBAYARAN</th>
			</tr>';
	$query = "select * from f_rep_index_kepatuhan(".$param_arr['p_year_period_id'].", ".$param_arr['p_vat_type_id'].", ".$param_arr['status'].") where rata_rata_pembayaran <= ".$arrBatas['batas_atas']." and rata_rata_pembayaran >= ".$arrBatas['batas_tengah']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
	$dbConn->query($query);
	$no = 1;
	while ($dbConn->next_record()) {
		//$result['batas_tengah'] = $dbConn->f('batas_tengah');
		echo '<tr>';
		echo '<td>'.$no++.'</td>';
		echo '<td>'.$dbConn->f('nama').'</td>';
		echo '<td>'.$dbConn->f('alamat').'</td>';
		echo '<td>'.$dbConn->f('npwpd').'</td>';
		echo '<td align="right">'.$dbConn->f('rata_rata_tgl_byr').'</td>';
		echo '<td align="right">'.$dbConn->f('rata_rata_pembayaran').'</td>';
		echo '</tr>';
	}
	echo '</table>';
	$dbConn->close();

	//KECIL
	$dbConn = new clsDBConnSIKP();
	echo '
		<br/><br/> <h4> <u>III. RANKING KECIL </u></h4> 
		<table border="1">
			<tr>
				<th width="25">NO</th>
				<th width="150">NAMA WP </th>
				<th width="300">ALAMAT</th>
				<th width="150">NPWPD</th>
				<th width="150">RATA-RATA <br/> TGL BAYAR</th>
				<th width="150">RATA-RATA <br/> PEMBAYARAN</th>
			</tr>';
	$query = "select * from f_rep_index_kepatuhan(".$param_arr['p_year_period_id'].", ".$param_arr['p_vat_type_id'].", ".$param_arr['status'].") where rata_rata_pembayaran < ".$arrBatas['batas_tengah']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
	$dbConn->query($query);
	$no = 1;
	while ($dbConn->next_record()) {
		//$result['batas_tengah'] = $dbConn->f('batas_tengah');
		echo '<tr>';
		echo '<td>'.$no++.'</td>';
		echo '<td>'.$dbConn->f('nama').'</td>';
		echo '<td>'.$dbConn->f('alamat').'</td>';
		echo '<td>'.$dbConn->f('npwpd').'</td>';
		echo '<td align="right">'.$dbConn->f('rata_rata_tgl_byr').'</td>';
		echo '<td align="right">'.$dbConn->f('rata_rata_pembayaran').'</td>';
		echo '</tr>';
	}
	echo '</table>';
	$dbConn->close();
	
	exit;
}

function getBatasPembayaran($p_year_period_id, $p_vat_type_id, $flag) {
	$dbConn = new clsDBConnSIKP();
	$jumlah_total = 0;
	$result = array();

	$query = "select max(rata_rata_pembayaran), max(rata_rata_pembayaran) / 3 , max(rata_rata_pembayaran) - (max(rata_rata_pembayaran) / 3) as batas_atas, max(rata_rata_pembayaran) - (max(rata_rata_pembayaran) / 3) - (max(rata_rata_pembayaran) / 3) batas_tengah from f_rep_index_kepatuhan(".$p_year_period_id.", ".$p_vat_type_id.", ".$flag.")";
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$result['batas_tengah'] = $dbConn->f('batas_tengah');
		$result['batas_atas'] = $dbConn->f('batas_atas');
	}

	$dbConn->close();
	return $result;
}
?>

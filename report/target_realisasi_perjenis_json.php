<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "target_realisasi_perjenis_json.php");
include_once(RelativePath . "/Common.php");

$data = array();
$p_vat_type_id = CCGetFromGet("p_vat_type_id", "");

if (empty($p_vat_type_id)) {
    echo "Data Tidak Ditemukan";
    exit;
}else {
    
    $p_year_period_id = '';
    $dbConn	= new clsDBConnSIKP();
	$query	= "select p_year_period_id from p_year_period where year_code =".date("Y");
	$dbConn->query($query);
	while ($dbConn->next_record()) {
		$p_year_period_id = $dbConn->f("p_year_period_id");
	}
	$dbConn->close();
	
	$dbConn2	= new clsDBConnSIKP();
    $sql = "SELECT
        	MAX(p_finance_period_id) as p_finance_period_id,
        	MAX(p_year_period_id) as p_year_period_id,
        	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,
        	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,
        	MAX(p_vat_type_id) as p_vat_type_id,
        	MAX(bulan) as bulan,
        	ROUND(SUM (target_amount)) as target_amount,
        	ROUND(SUM (realisasi_amt)) as realisasi_amt,
        	MAX (penalty_amt) as penalty_amt,
        	ROUND(SUM (debt_amt)) as debt_amt,
        	MAX (denda_pokok) as denda_pokok,
        	MAX (denda_piutang) as denda_piutang
        FROM
        	f_target_vs_real_monthly_new3_mark_ii(
        	$p_year_period_id,$p_vat_type_id
        	)
        GROUP BY p_finance_period_id        
        ORDER BY MAX(start_date) ASC";

    $dbConn2->query($sql);
    while ($dbConn2->next_record()) {
        $data['Target'][] = $dbConn2->f("target_amount");
        $data['Realisasi'][] = $dbConn2->f("realisasi_amt") + $dbConn2->f("debt_amt") + $dbConn2->f("denda_pokok") + $dbConn2->f("denda_piutang");
    }
	$dbConn2->close();
	
	echo json_encode($data);
    session_write_close();
    exit;
}
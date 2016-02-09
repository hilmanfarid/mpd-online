<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");

$npwpd = CCGetFromGet("npwpd", "");

$dbConn = new clsDBConnSIKP();

$query="select * from t_payment_receipt a
		left join t_cust_account b on a.npwd=b.npwd
		left join t_customer c on b.t_customer_id = c.t_customer_id
		where a.npwd = upper('".$npwpd."')
		ORDER BY payment_date desc limit 1";

$dbConn->query($query);
if ($dbConn->next_record()) {
	$json = array('items'=>array(),'items_piutang'=>array(),'message'=>'data ditemukan','success'=>'success');
	$item = array(
		'npwd' => $dbConn->f("npwd"),
		'payment_vat_amount' => $dbConn->f("payment_vat_amount"),
		'finance_period_code' => $dbConn->f("finance_period_code"),
		'merk_dagang' => $dbConn->f("company_brand"),
		'alamat_merk_dagang' => $dbConn->f("brand_address_name")." ".$dbConn->f("brand_address_no"),
		'pemilik' => $dbConn->f("company_owner"),
		'alamat_pemilik' => $dbConn->f("address_name_owner")." ".$dbConn->f("address_no_owner")
		);
	$json['items']=$item;
	
	$dbConn2 = new clsDBConnSIKP();
	$query2="select a.npwd as npwd_2, * from t_vat_setllement a
			left join t_cust_account b on a.npwd=b.npwd
			left join t_customer c on b.t_customer_id = c.t_customer_id
			left join t_payment_receipt d on d.t_vat_setllement_id = a.t_vat_setllement_id
			left join p_finance_period e on e.p_finance_period_id = a.p_finance_period_id
			where a.npwd = upper('".$npwpd."')
			and d.payment_date is null
			ORDER BY a.start_period desc";

	$dbConn2->query($query2);
	//$item_piutang []= array();
	while ($dbConn2->next_record()) {
		$item_piutang [] = array(
		'npwd' => $dbConn2->f("npwd_2"),
		'payment_vat_amount' => $dbConn2->f("total_vat_amount"),
		'finance_period_code' => $dbConn2->f("code"),
		'merk_dagang' => $dbConn2->f("company_brand"),
		'alamat_merk_dagang' => $dbConn2->f("brand_address_name")." ".$dbConn->f("brand_address_no"),
		'pemilik' => $dbConn2->f("company_owner"),
		'alamat_pemilik' => $dbConn2->f("address_name_owner")." ".$dbConn->f("address_no_owner")
		);
	}
	
	$json['items_piutang']=$item_piutang;
	//echo '<pre>';
	print_r( ($json));
	/*$myXMLData =
	"<?xml version='1.0' encoding='UTF-8'?>
	<pembayaran_wp>
		<npwd>".$dbConn->f("npwd")."</npwd>
		<payment_vat_amount>".$dbConn->f("payment_vat_amount")."</payment_vat_amount>
		<finance_period_code>".$dbConn->f("finance_period_code")."</finance_period_code>
		<merk_dagang>".$dbConn->f("company_brand")."</merk_dagang>
		<alamat_merk_dagang>".$dbConn->f("brand_address_name")." ".$dbConn->f("brand_address_no")."</alamat_merk_dagang>
		<pemilik>".$dbConn->f("company_owner")."</pemilik>
		<alamat_pemilik>".$dbConn->f("address_name_owner")." ".$dbConn->f("address_no_owner")."</alamat_pemilik>
	</pembayaran_wp>";
	print_r($myXMLData);*/
}else{
	$json = array('items'=>array(),'message'=>'data tidak ditemukan','success'=>'fail');
	/*$myXMLData =
	"<?xml version='1.0' encoding='UTF-8'?>
	<pembayaran_wp>
		<npwd></npwd>
		<payment_vat_amount></payment_vat_amount>
		<finance_period_code></finance_period_code>
	</pembayaran_wp>";
	print_r($myXMLData);*/
	print_r( ($json));
}
$dbConn->close();


?>

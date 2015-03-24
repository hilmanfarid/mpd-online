<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf.php");
include_once(RelativePath . "/Common.php");

$registration_no = CCGetFromGet("registration_no", "");

$dbConn = new clsDBConnSIKP();

$query="SELECT a.registration_no, to_char(a.creation_date, 'DD-MM-YYYY') as creation_date, a.wp_name, a.njop_pbb, 
		a.land_area, a.building_area, a.bphtb_amt_final, b.receipt_no, to_char(b.payment_date, 'DD-MM-YYYY') as payment_date
					FROM t_bphtb_registration AS a
					LEFT JOIN t_payment_receipt_bphtb AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
					WHERE a.registration_no = '".trim($registration_no)."' 
					OR b.receipt_no = '".trim($registration_no)."'";

$dbConn->query($query);
$data=array();
if ($dbConn->next_record()) {
	/*$json = array('items'=>array(),'message'=>'data ditemukan','success'=>'success');
	$item = array(
		'registration_no' => $dbConn->f("registration_no"),
		'creation_date' => $dbConn->f("creation_date"),
		'njop_pbb' => $dbConn->f("njop_pbb"),
		'land_area' => $dbConn->f("land_area"),
		'building_area' => $dbConn->f("building_area"),
		'bphtb_amt_final' => $dbConn->f("bphtb_amt_final"),
		'receipt_no' => $dbConn->f("receipt_no"),
		'payment_date' => $dbConn->f("payment_date"),
		'wp_name' => $dbConn->f("wp_name")
		);
	$json['items']=$item;
	print_r( ($json));*/
	$myXMLData =
	"<?xml version='1.0' encoding='UTF-8'?>
	<pembayaran_bphtb>
		<registration_no>".$dbConn->f("registration_no")."</registration_no>
		<creation_date>".$dbConn->f("creation_date")."</creation_date>
		<njop_pbb>".$dbConn->f("njop_pbb")."</njop_pbb>
		<land_area>".$dbConn->f("land_area")."</land_area>
		<building_area>".$dbConn->f("building_area")."</building_area>
		<bphtb_amt_final>".$dbConn->f("bphtb_amt_final")."</bphtb_amt_final>
		<receipt_no>".$dbConn->f("receipt_no")."</receipt_no>
		<wp_name>".$dbConn->f("wp_name")."</wp_name>
	</pembayaran_bphtb>";
	print_r($myXMLData);
}else{
	$myXMLData =
	"<?xml version='1.0' encoding='UTF-8'?>
	<pembayaran_bphtb>
		<registration_no></registration_no>
		<creation_date></creation_date>
		<njop_pbb></njop_pbb>
		<land_area></land_area>
		<building_area></building_area>
		<bphtb_amt_final></bphtb_amt_final>
		<receipt_no></receipt_no>
		<wp_name></wp_name>
	</pembayaran_bphtb>";
	print_r($myXMLData);
}
$dbConn->close();


?>

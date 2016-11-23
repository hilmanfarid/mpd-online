<?php
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");

$dbConn = new clsDBConnSIKP();
try{
	echo "<pre>";
	//PAT
	$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/pat/pokok/'.date("d-m-Y"));
	$ws_data = json_decode($ws_data);
	//print_r(str_replace('.','',$ws_data->nilai));exit;
	$pat = str_replace('.','',$ws_data->nilai);	
	if($pat!='' && $pat>0){
		$sql = " select * from f_insert_jaktap(51, $pat)";
		$dbConn->query($sql);
		
		$dbConn->next_record();
		$rec = $dbConn->Record;
		print_r($rec);
		echo "\n";
	}
	
	//REKLAME
	$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/reklame/pokok/'.date("d-m-Y"));
	$ws_data = json_decode($ws_data);
	$reklame = str_replace('.','',$ws_data->nilai);
	if($reklame!='' && $reklame>0){
		$sql = " select * from f_insert_jaktap(45, $reklame)";
		$dbConn->query($sql);
		
		$dbConn->next_record();
		$rec = $dbConn->Record;
		print_r($rec);
		echo "\n";
	}
	
	//PBB
	$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/pbb/pokok/'.date("d-m-Y"));
	$ws_data = json_decode($ws_data);
	$pbb = str_replace('.','',$ws_data->nilai);
	
	if($pbb!='' && $pbb>0){
		$sql = " select * from f_insert_jaktap(52, $pbb)";
		$dbConn->query($sql);

		$dbConn->next_record();
		$rec = $dbConn->Record;
		print_r($rec);
		echo "\n";
	}
	
}catch(Exception $e){
	$dbConn->close();
	pg_close($dbConn->Provider->Link_ID);
	continue;
}
$dbConn->close();
pg_close($dbConn->Provider->Link_ID);
echo "========================================\n";
?>
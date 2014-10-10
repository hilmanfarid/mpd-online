<?php
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$searchTerm = $_GET['searchTerm'];
if(!$sidx) $sidx =1;
if ($searchTerm=="") {
	$searchTerm="%";
} else {
	$searchTerm = "%" . $searchTerm . "%";
}

$dbConn = new clsDBConnSIKP();

// connect to the database
$result = $dbConn->query("SELECT count(*) as count FROM p_private_question WHERE question_pwd ilike '$searchTerm'");
$dbConn->next_record();
$row = $dbConn->Record;
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if($total_pages!=0) $SQL = "SELECT * FROM p_private_question WHERE question_pwd ilike '$searchTerm' ORDER BY $sidx $sord OFFSET $start LIMIT $limit";
else $SQL = "SELECT * FROM p_private_question WHERE question_pwd ilike '$searchTerm'";
$dbConn->query( $SQL );
$response->page = $page;
$response->total = $total_pages;
$response->records = $count;
$i=0;
while($dbConn->next_record()){
/*	
    $response->rows[$i]['id']=$row[id];
    $response->rows[$i]['cell']=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
*/
    $response->rows[$i]=$dbConn->Record;
    //$response->rows[$i]=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
    $i++;
}        
echo json_encode($response);

?>

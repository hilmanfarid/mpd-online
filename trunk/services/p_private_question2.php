<?php
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
$page = $_POST['current']; // get the requested page
$limit = $_POST['rowCount']; // get how many rows we want to have into the grid
$sidx = $_POST['sidx']; // get index row - i.e. user click to sort
$sord = $_POST['sord']; // get the direction
$searchTerm = $_POST['searchPhrase'];
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
$response->current = $page;
$response->total = $total_pages;
$response->rowCount = $count;
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

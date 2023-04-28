<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$item_ids = json_decode($_GET['items'], true);
$items = array();
for ($i = 0; $i < count($item_ids); $i++){
    $item_id = $item_ids[$i];
    $query = "SELECT * FROM itemTable WHERE item_id=" . $item_id;
	$result = submitSelectQuery($query)[0];
    array_push($items, $result);
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($items);
?>
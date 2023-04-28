<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$item_firesale_id = json_decode($_GET['sale_item'], true);
$items = array();
for ($i = 0; $i < count($item_firesale_id); $i++){
    $item_id = $item_firesale_id[$i];
    $query = "SELECT itemsaletable.sale_price, itemtable.item_name, itemtable.item_price, itemtable.item_id, itemtable.image_name FROM itemsaletable INNER JOIN itemtable ON itemsaletable.item_id = itemtable.item_id WHERE itemtable.item_id = ".$item_id;
	$result = submitSelectQuery($query)[0];
    array_push($items, $result);
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($items);
?>
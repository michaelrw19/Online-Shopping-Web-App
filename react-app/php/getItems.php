<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$query = "SELECT itemtable.item_name, itemtable.item_price, itemtable.image_name FROM itemtable LEFT JOIN itemsaletable ON itemtable.item_id = itemsaletable.item_id WHERE itemsaletable.item_id IS NULL AND itemtable.item_id <> 1;";
$items = submitSelectQuery($query);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($items);
?>
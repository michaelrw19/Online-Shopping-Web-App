<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";

$items = array();

if(isset($_GET['items'])){
    $item_ids = json_decode($_GET['items'], true);


    for ($i = 0; $i < count($item_ids); $i++){
        $item_id = $item_ids[$i];
        $query = "SELECT * FROM itemTable WHERE item_id=" . $item_id;
        $result = submitSelectQuery($query)[0]["item_price"];
        array_push($items, $result);
    }
}

if(isset($_GET['sale_item'])){
    $item_firesale_id = json_decode($_GET['sale_item'], true);

    for ($i = 0; $i < count($item_firesale_id); $i++){
        $item_id = $item_firesale_id[$i];
        $query = "SELECT itemsaletable.sale_price FROM itemsaletable INNER JOIN itemtable ON itemsaletable.item_id = itemtable.item_id WHERE itemtable.item_id = ".$item_id;
        $result = submitSelectQuery($query)[0]["sale_price"];
        array_push($items, $result);
    } 
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($items);

?>

<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    include_once "submitQuery.php";
    $query = "SELECT itemtable.item_name, itemtable.item_price, itemtable.image_name, itemsaletable.sale_price FROM itemtable INNER JOIN itemsaletable ON itemsaletable.item_id = itemtable.item_id;";
    $items = submitSelectQuery($query);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($items);
?>
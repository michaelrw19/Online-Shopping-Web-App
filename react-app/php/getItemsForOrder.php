<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$user = $_GET['user'];

$query = "SELECT purchasedItemTable.order_id as order_id, COUNT(purchasedItemTable.purchased_item_id) AS num, itemTable.item_name as item_name FROM itemTable, purchasedItemTable WHERE itemTable.item_id = purchasedItemTable.item_id AND purchasedItemTable.item_id != 1 AND purchasedItemTable.user_id=" . $user . " GROUP BY item_name, order_id";
$result = submitSelectQuery($query);

echo json_encode($result);
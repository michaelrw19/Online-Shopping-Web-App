<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$name = $_GET['name'];
$query = "SELECT item_id FROM itemTable WHERE item_name='" . $name . "'";
$result = submitSelectQuery($query);
$item = $result[0]['item_id'];
echo $item;
?>
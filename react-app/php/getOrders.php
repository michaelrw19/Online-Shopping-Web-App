<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$id = $_GET['id'];
$criteria = $_GET['criteria'];

$startQ = "SELECT orderTable.order_id, orderTable.date_received, orderTable.total_price, paymentTable.card_number, tripTable.destination_code FROM orderTable, paymentTable, tripTable WHERE tripTable.trip_id = orderTable.trip_id AND paymentTable.payment_id = orderTable.payment_id AND orderTable.user_id=";
$endQ = " ORDER BY orderTable.order_id DESC";
if ($criteria == ""){
    $query = $startQ . $id . $endQ;
    $result = submitSelectQuery($query);
}
else {
    $query = $startQ . $id . " AND order_id=" . $criteria  . $endQ;
    $result = submitSelectQuery($query);
}
echo json_encode($result);
?>
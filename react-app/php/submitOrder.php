<?php
function rand_float($st_num=0,$end_num=1,$mul=1000000)
{
if ($st_num>$end_num) return false;
return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
}

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
include_once "dbConnection.php";
include_once "Models.php";

$payment = $_GET['payment'];
$total = $_GET['total'];
$user_id = $_GET['user'];
$postal = $_GET['postal'];
$date = date('Y-m-d');
$pay_id = $_GET['payment_id'];
$items = $_GET['items'];
$items_sale = $_GET['items_sale'];

if ($pay_id == "new"){
    $query = "SELECT * FROM paymentTable WHERE card_number='". $payment . "'";
    $result = submitSelectQuery($query);
    $payment_id = $result[0]['payment_id'];
}
else {
    $payment_id = $pay_id;
}

$tripidQuery = "SELECT * from tripTable where destination_code='" . $postal . "'";
$tripids = submitSelectQuery($tripidQuery);
if (count($tripids) > 0){
    $tripid = $tripids[0]['trip_id'];
}
else {
    $trip = new Trip('L5P1B2', strtoupper($postal), rand_float(10, 100, 3), rand(1,2), rand_float(10, 100, 3));
    $trip->insert();
    $tripidQuery = "SELECT MAX(trip_id) FROM tripTable";
    $result = submitSelectQuery($tripidQuery);
    $tripid = $result[0]['MAX(trip_id)'];
}

$receipt = new Shopping(rand(1,2), $total);
$receipt->insert();

$query = "SELECT MAX(receipt_id) FROM shoppingTable";
$result = submitSelectQuery($query);
$receiptid = $result[0]['MAX(receipt_id)'];

$order = new Order($date, $date, $total, $payment_id, $user_id, $tripid, $receiptid);
$order->insert();
$query = "SELECT MAX(order_id) FROM orderTable";
$result = submitSelectQuery($query);
echo $result[0]["MAX(order_id)"];

if(!empty($items)){
    foreach($items as $item_id) {
        $purchasedItem = new PurchasedItem($item_id, $user_id, $result[0]["MAX(order_id)"]);
        $purchasedItem->insert();
    }
}
if(!empty($items_sale)){
    foreach($items_sale as $item_id) {
        $purchasedItem = new PurchasedItem($item_id, $user_id, $result[0]["MAX(order_id)"]);
        $purchasedItem->insert();
    }
}
?>
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
include_once "dbConnection.php";
include_once "Models.php";

$info = json_decode($_GET['info'],true);
$payment = $info['payment'];
if($payment == "new"){
    $card_num = $info['card_num'];
    $card_name = $info['card_name'];
    $card_expiry = $info['card_expiry'];
    $cvv = $info['cvv'];

    $user_id = $_GET['user'];

    $date = "20" . $card_expiry[3] . $card_expiry[4] . "-" . $card_expiry[0] . $card_expiry[1] . "-01";
    $query = "SELECT * from paymentTable where card_number = '" . $card_num . "'";
    $result = submitSelectQuery($query);
    if (count($result) == 0){
        $payment = new Payment($user_id, $card_name, $card_num, $date, $cvv);
        $payment->insert();
    }
    echo '************'. substr($card_num, 12);
}
else {
    $query = "SELECT * FROM paymentTable WHERE payment_id='" . $payment . "'";
    $card = submitSelectQuery($query)[0];

    echo '************'. substr($card['card_number'], 12);
}
?>
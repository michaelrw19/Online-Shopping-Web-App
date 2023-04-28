<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$user_id = $_GET['user_id'];
$query = "SELECT * FROM paymentTable WHERE user_id='" . $user_id ."'";
$result = submitSelectQuery($query);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);
?>
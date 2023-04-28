<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "databaseFunctions.php";

$login_id = $_GET['loginID'];
$password = $_GET['loginPassword'];

checkUserCredentials($login_id, $password);
?>

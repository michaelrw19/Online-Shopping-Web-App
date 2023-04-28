<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "databaseFunctions.php";

$full_name = $_POST['registerName'];
$telephone = $_POST['registerPhone'];
$email = $_POST['registerEmail'];
$home_address = $_POST['registerAddress'];
$login_id = $_POST['registerID'];
$user_password = $_POST['registerPassword'];

createNewUser($full_name, $telephone, $email, $home_address, $login_id, $user_password);
?>

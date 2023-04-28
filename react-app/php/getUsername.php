<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include_once "submitQuery.php";
$id = $_GET['id'];
$query = "SELECT * FROM userTable WHERE user_id=" . $id;
$result = submitSelectQuery($query);
$username = $result[0]['login_id'];
echo $username;
?>
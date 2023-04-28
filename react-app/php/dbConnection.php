<?php
// Jenny Su 500962385
// Tiffany Tran 500886609
// Kevin Tran 500967982
// Michael Widianto 501033366

/* Dont forget to change these stuff */
$hostname = "localhost:3307";
$username = "root";
$password = "cps630Lab2,3";
$database = "project";

$connect = new mysqli(
  $hostname,
  $username,
  $password,
  $database
);
if(mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

?>
<?php
session_start();
include("../../connection/config.php");
//Not tested
$id = $_POST["hidden_edit"];
$name = $_POST["name"];
$email = $_POST["email"];
$fname = $_POST["fname"];

$query = "UPDATE `account` SET `username` = '$name', `email` = '$email', `phone_num` = '$phone', `fname` = '$fname' WHERE `account`.`user_id` = $id";
$result = $mysqli->query($query);

var_dump($result);
header("location: accountCrud.php");
?>
<?php
session_start();
include("../../connection/config.php");

$query = "DELETE FROM `account` WHERE `account`.`user_id` = " . $_POST["hidden_delete"];
$result = $mysqli->query($query);
header("location: accountCrud.php");
?>
<?php
session_start();
include("../connection/config.php");
var_dump($_POST);
$id = $_POST["hidden_edit"];
$aname = $_POST["activity_name"];
$aloc = $_POST["activity_loc"];
$acat = $_POST["activity_cat"];
$acon = $_POST["activity_con"];
$aprice = $_POST["activity_price"];

$query = "UPDATE `activity` SET `content` = '$acon', `name` = '$aname', `location` = '$aloc', `price` = '$aprice', `categories` = '$acat' WHERE `activity`.`activity_id` = $id";
$result = $mysqli->query($query);

var_dump($result);
header("location: activityCrud.php");
?>
<?php
session_start();
include("../../connection/config.php");
// BAĞLANTILI OLDUĞU TABLOLARI SİL
$query = "DELETE FROM `activity` WHERE `activity`.`activity_id` = " . $_POST["hidden_delete"];
$result = $mysqli->query($query);
header("location: activityCrud.php");
?>
<?php
session_start();
include("../../connection/config.php");

$id = $_POST["hidden_edit"];
$amp = $_POST["amp"];
$type = $_POST["type"];
$sdate = $_POST["sdate"];
$edate = $_POST["edate"];

$s=date("Y-m-d H:i:s",strtotime($sdate));
$e=date("Y-m-d H:i:s",strtotime($edate));

$query = "UPDATE `reservation_hotel` SET `reservation_type` = '$type', `amount_of_people` = '$amp', `start_date` = '$s', `end_date` = '$e' WHERE `reservation_hotel`.`reservation_id` = $id";
$result = $mysqli->query($query);

var_dump($result);
header("location: displayHotelRes.php");
?>
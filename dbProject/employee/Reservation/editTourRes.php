<?php
session_start();
include("../../connection/config.php");

$id = $_POST["hidden_edit"];
$amp = $_POST["amp"];


$query = "UPDATE `reservation_tour` SET `amount_of_people` = '$amp' WHERE `reservation_tour`.`reservation_id` = $id";
$result = $mysqli->query($query);

var_dump($result);
header("location: displayTourRes.php");
?>
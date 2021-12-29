<?php
session_start();
include("../connection/config.php");
$query = "DELETE FROM `tour` WHERE `tour`.`tour_id` = " . $_POST["hidden_delete"];
$result = $mysqli->query($query);

var_dump($query);
header("location: tourCrud.php");
?>
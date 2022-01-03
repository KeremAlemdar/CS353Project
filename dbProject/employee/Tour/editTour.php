<?php
session_start();
include("../../connection/config.php");
var_dump($_POST);

$id = $_POST["hidden_edit"];
$tname = $_POST["tour_name"];
$tinf = $_POST["tour_inf"];
$tsta = $_POST["tour_sta"];
$std_date=date("Y-m-d H:i:s",strtotime($tsta));
$tend = $_POST["tour_end"];
$end_date=date("Y-m-d H:i:s",strtotime($tend));

$query =  "UPDATE `tour` SET `start_date` = '$std_date', `end_date` = '$end_date', `tour_information` = '$tinf', `tour_name` = '$tname' WHERE `tour`.`tour_id` = $id";
$result = $mysqli->query($query);

header("location: tourCrud.php");
?>
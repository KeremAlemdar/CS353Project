<?php 
session_start();

$id = $_POST["hidden_select"];
$amp = $_POST["amp"];

$_SESSION["employee_tour_select"] = $id;
$_SESSION["employee_tour_select_amp"] = $amp;

header("location: tourCrud.php");
?>
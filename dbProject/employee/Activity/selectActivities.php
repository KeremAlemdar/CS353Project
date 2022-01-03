<?php 
session_start();

$id = $_GET["id"];

$array = $_SESSION["employee_activity_select_array"];

array_push($array, $id);

$_SESSION["employee_activity_select_array"] = $array;

header("location: activityCrud.php");
?>
<?php 
session_start();

$id = $_GET["id"];

$_SESSION["employee_tour_select"] = $id;

header("location: tourCrud.php");
?>
<?php 
session_start();

$id = $_GET["id"];

$_SESSION["employee_room_select"] = $id;

header("location: ./hotelCrud.php");
?>
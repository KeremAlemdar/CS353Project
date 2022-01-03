<?php 
session_start();

$sdate = $_POST["sdate"];
$edate = $_POST["edate"];
$hidden_hotel_id = $_POST["hidden_hotel_id"];
$hidden_select = $_POST["hidden_select"];

$_SESSION["employee_room_select"] = $hidden_select;
$_SESSION["employee_hotel_select"] = $hidden_hotel_id;
$_SESSION["employee_hotel_select_sdate"] = date("Y-m-d H:i:s",strtotime($sdate)); 
$_SESSION["employee_hotel_select_edate"] = date("Y-m-d H:i:s",strtotime($edate));  

header("location: ./hotelCrud.php");
?>
<?php
session_start();
include("../connection/config.php");

$aname = $_POST["activity_name"];
$aloc = $_POST["activity_loc"];
$acat = $_POST["activity_cat"];
$acon = $_POST["activity_con"];
$aprice = $_POST["activity_price"];

$query = "INSERT INTO `activity` (`activity_id`, `content`, `name`, `location`, `price`, `categories`, `image`) VALUES (NULL, '$acon', '$aname', '$aloc', '$aprice', '$acat', NULL)";

$result = $mysqli->query($query);


header("location: activityCrud.php");

?>
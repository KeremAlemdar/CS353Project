<?php
session_start();
include("../connection/config.php");

var_dump($_POST);

$aname = $_POST["aname"];
$aloc = $_POST["aloc"];
$acat = $_POST["acat"];
$acon = $_POST["acon"];
$aprice = $_POST["aprice"];

$query = "INSERT INTO `activity` (`activity_id`, `content`, `name`, `location`, `price`, `categories`, `image`) VALUES (NULL, '$acon', '$aname', '$aloc', '$aprice', '$acat', NULL)";

$result = $mysqli->query($query);

var_dump($result);

header("location: employeeHome.php");
//GIVE SUCESSFUL MESSAGE
?>
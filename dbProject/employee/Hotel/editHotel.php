<?php
session_start();
include("../../connection/config.php");

$id = $_POST["hidden_edit"];
$name = $_POST["name"];
$city = $_POST["city"];
$star = $_POST["star"];
$details = $_POST["details"];
$image = $_POST["image"];

$query = "UPDATE `hotel` SET `name` = '$name', `city` = '$city', `star` = '$star', `details` = '$details', `image` = '$image' WHERE `hotel`.`hotel_id` = $id";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: hotelCrud.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}
?>
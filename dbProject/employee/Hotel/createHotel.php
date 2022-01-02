<?php
session_start();
include("../../connection/config.php");

$id = $_POST["hidden_edit"];
$name = $_POST["name"];
$city = $_POST["city"];
$star = $_POST["star"];
$details = $_POST["details"];
$image = $_POST["image"];

$query = "INSERT INTO `hotel` (`hotel_id`, `name`, `city`, `star`, `details`, `image`) VALUES (NULL, '$name', '$city', '$star', '$details', '$image')";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: hotelCrud.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}

?>
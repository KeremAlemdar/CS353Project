<?php
session_start();
include("../../connection/config.php");

$hotel_id = $_POST["hidden_create"];
$amp = $_POST["amp"];
$price = $_POST["price"];
$type = $_POST["type"];


$query = "INSERT INTO `hotel_room` (`room_id`, `amount_of_people`, `type`, `price`, `hotel_id`) VALUES (NULL, '$amp', '$type', '$price', '$hotel_id')";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: listRooms.php?id=". $hotel_id);
}
else {
    echo("Error description: " . $mysqli -> error);
}

?>
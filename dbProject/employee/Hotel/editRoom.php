<?php
session_start();
include("../../connection/config.php");

$hotel_id = $_POST["hidden_hotel_id"];
$room_id = $_POST["hidden_edit"];
$amp = $_POST["amp"];
$price = $_POST["price"];
$type = $_POST["type"];


$query = "UPDATE `hotel_room` SET `amount_of_people` = '$amp', `type` = '$type', `price` = '$price' WHERE `hotel_room`.`room_id` = '$room_id';";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: listRooms.php?id=". $hotel_id);
}
else {
    echo("Error description: " . $mysqli -> error);
}

?>
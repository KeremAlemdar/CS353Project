<?php
session_start();
include("../../connection/config.php");
$query = "DELETE FROM `hotel_room` WHERE `room_id` = ". $_POST["hidden_delete"];
$result = $mysqli->query($query);


if ($result) {
    echo "Success";
    header("location: hotelCrud.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}
?>
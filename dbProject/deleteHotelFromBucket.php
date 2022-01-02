<?php
include("./connection/checkSession.php");
$hotel_id =  isset($_POST['hotel_id']) ? $_POST['hotel_id'] : "";
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1; // FOR TEST PURPOSES
$query = "DELETE FROM `hotel_bucket` WHERE `hotel_bucket`.`user_id` = $user_id AND `hotel_bucket`.`hotel_id` = $hotel_id";
if ($result = $mysqli->query($query)) {
    header("Location: paymentPage.php");
} else {
    header("Location: paymentPage.php?error=cannotDelete");
}

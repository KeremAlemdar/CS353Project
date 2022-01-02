<?php
include("./connection/checkSession.php");

$previous = $_SESSION['previous'];
$hotel_id = "";
$numberOfGuest = "";
if (isset($_POST['hotel_id'])) {
    $hotel_id = $_POST['hotel_id'];
    $numberOfGuest = $_POST['numberOfGuest'];
}
// $user_id = $_SESSION['uid'];
$user_id = 1;
$tour_id = $_GET['tour_id'];
$date = date("Y/m/d");

$query = "INSERT INTO `hotel_bucket` (`user_id`, `hotel_id`, `count`) VALUES (" . $user_id . "," . $hotel_id . "," . $numberOfGuest . ")";
$result = $mysqli->query($query);
if ($result = $mysqli->query($query)) {
    header("Location: paymentPage.php");
    // echo "added";
} else {
    header("Location:" . $previous . "&error=cannotAdd");
    // echo "failed";
}

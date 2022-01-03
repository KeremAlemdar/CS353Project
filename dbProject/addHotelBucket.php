<?php
include("./connection/checkSession.php");

$date = date("Y/m/d");
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : $date;
$end_date =  isset($_GET['end_date']) ? $_GET['end_date'] : $date;

$previous = $_SESSION['previous'];
$hotel_id = "";
$numberOfGuest = "";
if (isset($_POST['hotel_id'])) {
    $hotel_id = $_POST['hotel_id'];
    $numberOfGuest = $_POST['numberOfGuest'];
}
// $user_id = $_SESSION['uid'];
$user_id = 1;
$date = date("Y/m/d");

$query = "INSERT INTO `hotel_bucket` (`user_id`, `hotel_id`, `count`) VALUES ('$user_id','$hotel_id','$numberOfGuest')";
echo $query;
if ($result = $mysqli->query($query)) {
    header("Location: paymentPage.php");
    // echo "added";
} else {
    header("Location:" . $previous . "&error=cannotAdd");
    // echo "failed";
}

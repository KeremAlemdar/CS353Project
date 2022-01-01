<?php
include("./connection/checkSession.php");

$previous = $_SESSION['previous'];
$activities = "";
$activity_selected = false;
$number_of_tour = $_POST['numberOfTour'];
if (isset($_POST['activities'])) {
    $activities = $_POST['activities'];
    $numberOfActivity = $_POST['numberOfActivity'];
    $activity_selected = true;
}
// $user_id = $_SESSION['uid'];
$user_id = 1;
$tour_id = $_GET['tour_id'];
$date = date("Y/m/d");
if ($activity_selected) {


    $query = "INSERT INTO `tour_bucket` (`user_id`, `tour_id`, `count`) VALUES (" . $user_id . "," . $tour_id . "," . $number_of_tour . ")";
    $result = $mysqli->query($query);
    for ($i = 0; $i < sizeof($activities); $i++) {
        $query = "INSERT INTO `tour_activity_bucket` (`user_id`, `tour_id`, `activity_id`,`count`) VALUES (" . $user_id . "," . $tour_id . "," . $activities[$i] . "," . $numberOfActivity[$i] . ")";
        // echo $query;
        if ($result = $mysqli->query($query)) {
            header("Location: paymentPage.php");
            // echo "added";
        } else {
            header("Location:" . $previous . "&error=cannotAdd");
            // echo "failed";
        }
    }
} else {
    $query = "INSERT INTO `tour_bucket` (`user_id`, `tour_id`) VALUES (" . $user_id . "," . $tour_id . ")";
    if ($result = $mysqli->query($query)) {
        header("Location: paymentPage.php");
        // echo "added";
    } else {
        header("Location:" . $previous . "&error=cannotAdd");
        // echo "failed";
    }
}

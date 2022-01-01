<?php
include("./connection/checkSession.php");

$previous = $_SESSION['previous'];
$activities = "";
$activity_selected = false;
if (isset($_POST['activities'])) {
    $activities = $_POST['activities'];
    $activity_selected = true;
    // echo 'Seçtiğiniz activitiler: <br/>';

    // foreach ($activities as $activity) {
    //     echo ' * ' . $activity . ' <br/>';
    // }
}
// $user_id = $_SESSION['uid'];
$user_id = 1;
$tour_id = $_GET['tour_id'];
$date = date("Y/m/d");

if($activity_selected) {
    $query = "INSERT INTO `tour_bucket` (`user_id`, `tour_id`) VALUES (" . $user_id . "," . $tour_id . ")";
    $result = $mysqli->query($query);
    foreach ($activities as $activity) {
        $query = "INSERT INTO `tour_activity_bucket` (`user_id`, `tour_id`, `activity_id`) VALUES (" . $user_id . "," . $tour_id . "," . $activity . ")";
        echo $query;
        if ($result = $mysqli->query($query)) {
            header("Location: paymentPage.php");
            echo "added";
        } else {
            header("Location:".$previous."&error=cannotAdd");
            echo "failed";
        }
    }
}
else {
    $query = "INSERT INTO `tour_bucket` (`user_id`, `tour_id`) VALUES (" . $user_id . "," . $tour_id . ")";
    if ($result = $mysqli->query($query)) {
        header("Location: paymentPage.php");
        echo "added";
    } else {
        header("Location:".$previous."&error=cannotAdd");
        echo "failed";
    }
}


<?php
include("./connection/checkSession.php");
$tour_id =  isset($_POST['tour_id']) ? $_POST['tour_id'] : "";
$activity_id =  isset($_POST['activity_id']) ? $_POST['activity_id'] : "";
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$query = "DELETE FROM `reservation_tour_activity` WHERE `reservation_tour_activity`.`user_id` = $user_id AND `reservation_tour_activity`.`tour_id` = $tour_id AND `reservation_tour_activity`.`activity_id` = $activity_id";
echo $query;
if ($result = $mysqli->query($query)) {
    header("Location: profilePage.php");
} else {
    header("Location: profilePage.php?error=cannotDelete");
}
?>
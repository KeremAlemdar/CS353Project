<?php
include("./connection/checkSession.php");
$tour_id = $_POST['tour_id'];
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1; // FOR TEST PURPOSES
$query = "DELETE FROM `tour_bucket` WHERE `tour_bucket`.`user_id` = $user_id AND `tour_bucket`.`tour_id` = $tour_id";
echo $query;
if ($result = $mysqli->query($query)) {
    header("Location: paymentPage.php");
} else {
    header("Location: paymentPage.php?error=cannotDelete");
}
?>
<?php
include("./connection/checkSession.php");
$flight_id =  isset($_POST['flight_id']) ? $_POST['flight_id'] : "";
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$query = "DELETE FROM `flight_bucket` WHERE `flight_bucket`.`user_id` = $user_id AND `flight_bucket`.`flight_id` = $flight_id";
if ($result = $mysqli->query($query)) {
    header("Location: paymentPage.php");
} else {
    header("Location: paymentPage.php?error=cannotDelete");
}

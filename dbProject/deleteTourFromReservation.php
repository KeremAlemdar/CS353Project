<?php
include("./connection/checkSession.php");
$tour_id =  isset($_POST['tour_id']) ? $_POST['tour_id'] : "";
$reservation_id =  isset($_POST['reservation_id']) ? $_POST['reservation_id'] : "";
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1; // FOR TEST PURPOSES
$query = "DELETE FROM `reservation_tour` WHERE `reservation_tour`.`reservation_id` = $reservation_id AND `reservation_tour`.`tour_id` = $tour_id";
echo $query;
if ($result = $mysqli->query($query)) {
    $query = "DELETE FROM `reservation_tour_activity` WHERE `reservation_tour_activity`.`user_id` = $user_id AND `reservation_tour_activity`.`tour_id` = $tour_id";
    echo $query;
    if ($result = $mysqli->query($query)) {
        $query = "DELETE FROM `customer_reserve` WHERE `customer_reserve`.`reservation_id` = $reservation_id";
        echo $query;
        if ($result = $mysqli->query($query)) {
            $query = "DELETE FROM `reservation` WHERE `reservation`.`reservation_id` = $reservation_id";
            echo $query;
            if ($result = $mysqli->query($query)) {
                // echo "basarili";
                header("Location: profilePage.php");
            } else {
                // echo "basarisiz1";
                header("Location: profilePage.php?error=cannotDelete");
            }
        } else {
            $query = "DELETE FROM `employee_reserve` WHERE `customer_reserve`.`reservation_id` = $reservation_id";
            if ($result = $mysqli->query($query)) {
                $query = "DELETE FROM `reservation` WHERE `reservation`.`reservation_id` = $reservation_id";
                echo $query;
                if ($result = $mysqli->query($query)) {
                    // echo "basarili";
                    header("Location: profilePage.php");
                } else {
                    // echo "basarisiz1";
                    header("Location: profilePage.php?error=cannotDelete");
                }
            }
        }
    } else {
        // echo "basarisiz2";
        header("Location: profilePage.php?error=cannotDelete");
    }
} else {
    // echo "basarisiz3";
    header("Location: profilePage.php?error=cannotDelete");
}

<?php
include("./connection/checkSession.php");
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1;
$query = "SELECT * FROM `tour_bucket` WHERE `user_id`= 1";
$tours = $mysqli->query($query);
$empty = false;
if ($tours->num_rows == 0) {
    $empty = true;
}
while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
    echo "patates";
    $query = "INSERT INTO reservation (reservation_id) VALUES (null)";
    $mysqli->query($query);
    $reservation_id = $mysqli->insert_id;
    $tour_id = $tuple[0];
    $count = $tuple[2];
    $query = "INSERT INTO customer_reserve (reservation_id,customer_id) VALUES ($reservation_id,$user_id)";
    if ($mysqli->query($query)) {
        echo "basarili1";
    } else {
        echo "basarisiz1";
    }
    $query = "INSERT INTO reservation_tour (reservation_id,tour_id,amount_of_people) VALUES ($reservation_id,$tour_id,$count)";
    $mysqli->query($query);

    $query = "DELETE FROM `tour_bucket` WHERE `tour_bucket`.`user_id` = $user_id AND `tour_bucket`.`tour_id` = $tour_id";
    if ($result = $mysqli->query($query)) {
        $query = "DELETE FROM `tour_activity_bucket` WHERE `tour_activity_bucket`.`user_id` = $user_id AND `tour_activity_bucket`.`tour_id` = $tour_id";
        if ($result = $mysqli->query($query)) {
            header("Location: profilePage.php");
        } else {
            // header("Location: paymentPage.php?error=cannotDelete");
        }
    } else {
        // header("Location: paymentPage.php?error=cannotDelete");
    }
}

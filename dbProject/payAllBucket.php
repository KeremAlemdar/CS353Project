<?php
include("./connection/checkSession.php");
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1;
$query = "SELECT * FROM `tour_bucket` WHERE `user_id`= 1";
$date = date("Y/m/d");

// PAY TOURS
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
    $tour_id = $tuple[1];
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
            // header("Location: profilePage.php");
        } else {
            // header("Location: paymentPage.php?error=cannotDelete");
        }
    } else {
        // header("Location: paymentPage.php?error=cannotDelete");
    }
}

$query = "SELECT * FROM `hotel_bucket` WHERE `user_id`= 1";

$date = date("Y/m/d");
// PAY HOTELS
$hotels = $mysqli->query($query);
$empty = false;
if ($hotels->num_rows == 0) {
    $empty = true;
}
while ($tuple = $hotels->fetch_array(MYSQLI_NUM)) {
    echo "patates";
    $query = "INSERT INTO reservation (reservation_id) VALUES (null)";
    $mysqli->query($query);
    $reservation_id = $mysqli->insert_id;
    $hotel_id = $tuple[1];
    $count = $tuple[2];
    $query = "INSERT INTO customer_reserve (reservation_id,customer_id) VALUES ($reservation_id,$user_id)";
    if ($mysqli->query($query)) {
        echo "basarili1";
    } else {
        echo "basarisiz1";
    }
    $query = "INSERT INTO reservation_hotel (reservation_id,hotel_id,amount_of_people,start_date,end_date) VALUES ($reservation_id,$hotel_id,$count,$date,$date)";
    $mysqli->query($query);

    $query = "DELETE FROM `hotel_bucket` WHERE `hotel_bucket`.`user_id` = $user_id AND `hotel_bucket`.`hotel_id` = $hotel_id";
    if ($result = $mysqli->query($query)) {
            header("Location: profilePage.php");
            // header("Location: paymentPage.php?error=cannotDelete");
    } else {
        // header("Location: paymentPage.php?error=cannotDelete");
    }
}

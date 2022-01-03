<?php
include("./connection/checkSession.php");
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1;
$query = "SELECT * FROM `tour_bucket` WHERE `user_id`= 1";
$date = date("Y/m/d");

$hotel_success = false;
$tour_success = false;
$plane_success = false;
// PAY TOURS
$tours = $mysqli->query($query);
$empty = false;
if ($tours->num_rows == 0) {
    $empty = true;
}
while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
    $query = "INSERT INTO reservation (reservation_id) VALUES (null)";
    $mysqli->query($query);
    $reservation_id = $mysqli->insert_id;
    $tour_id = $tuple[1];
    $count = $tuple[2];
    $query = "INSERT INTO customer_reserve (reservation_id,customer_id,acceptance_status) VALUES ($reservation_id,$user_id,2)";
    if ($mysqli->query($query)) {
        echo "basarili1";
    } else {
        echo "basarisiz1";
    }
    $query = "INSERT INTO reservation_tour (reservation_id,tour_id,amount_of_people) VALUES ($reservation_id,$tour_id,$count)";
    echo $query;
    if($mysqli->query($query)){
        echo "reservation_tour successs";
    }
    else {
        echo "reservation_tour fail";
    }

    $query = "SELECT * FROM `tour_activity_bucket` WHERE `tour_activity_bucket`.`user_id` = $user_id AND `tour_activity_bucket`.`tour_id` = $tour_id";
    $result = $mysqli->query($query);
    while ($activity = $result->fetch_array(MYSQLI_NUM)) {
        $activity_id = $activity[2];
        $count = $activity[3];
        $query = "INSERT INTO reservation_tour_activity (user_id,tour_id,activity_id,count) VALUES ($user_id,$tour_id,$activity_id,$count)";
        if ($mysqli->query($query)) {
            echo "insertion success";
        } else {
            echo "insertion fail";
        }
    }

    $query = "DELETE FROM `tour_bucket` WHERE `tour_bucket`.`user_id` = $user_id AND `tour_bucket`.`tour_id` = $tour_id";
    if ($result = $mysqli->query($query)) {
        $query = "DELETE FROM `tour_activity_bucket` WHERE `tour_activity_bucket`.`user_id` = $user_id AND `tour_activity_bucket`.`tour_id` = $tour_id";
        if ($result = $mysqli->query($query)) {
            $tour_success = true;
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
        $hotel_success = true;
        // header("Location: paymentPage.php?error=cannotDelete");
    } else {
        // header("Location: paymentPage.php?error=cannotDelete");
    }
}
// header("Location: profilePage.php");

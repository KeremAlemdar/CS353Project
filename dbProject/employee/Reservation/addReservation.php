<?php
session_start();
include("../../connection/config.php");
include("../../connection/checkSession.php");

$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

$customerID = $_SESSION["employee_account_select"];
$roomID = $_SESSION["employee_room_select"];
$tourID = $_SESSION["employee_tour_select"];
$activity_arr = $_SESSION["employee_activity_select_array"];


if ($customerID == 0) {
    echo "Customer is not set <br></br>";
    echo "<a href=\"MakeReservation.php\"> Back </a> ";
    exit();
}

//Create New reservation

    $query = "INSERT INTO reservation (reservation_id) VALUES (null)";
    $mysqli->query($query);
    $reservation_id = $mysqli->insert_id;
    $count = $tuple[2];



    $query = "INSERT INTO employee_reserve (reservation_id,customer_id) VALUES ($reservation_id,$user_id)";
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


?>
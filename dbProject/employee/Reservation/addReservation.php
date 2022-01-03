<?php
session_start();
include("../../connection/config.php");
include("../../connection/checkSession.php");

$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

$customerID = $_SESSION["employee_account_select"];
$roomID = $_SESSION["employee_room_select"];
$tourID = $_SESSION["employee_tour_select"];
$tourAmp = $_SESSION["employee_tour_select_amp"];
$activity_arr = $_SESSION["employee_activity_select_array"];


if ($customerID == 0) {
    echo "Customer is not set <br></br>";
    echo "<a href=\"MakeReservation.php\"> Back </a> ";
}else {

    //Create New reservation

    $query = "INSERT INTO reservation (reservation_id) VALUES (null)";
    $mysqli->query($query);
    $reservation_id = $mysqli->insert_id;

    //Insert into employee's reservation table
    
    $query = "INSERT INTO `employee_reserve` (`reservation_id`, `employee_id`, `customer_id`) VALUES ('$reservation_id', '$user_id', '$customerID')";
    if (!$mysqli->query($query)) {
        $mysqli->error;
    } 


    //Insert tour reservation
    if ($tourID != 0) {
    $query = "INSERT INTO reservation_tour (reservation_id,tour_id,amount_of_people) VALUES ($reservation_id,$tourID,$tourAmp)";
    if (!$mysqli->query($query)) {
        $mysqli->error;
    } 
    }


    //Insert hotel reservation
    if ($roomID != 0) {

        $sql = "SELECT * FROM `hotel_room` WHERE `room_id` = " . $_SESSION["employee_room_select"];
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();

        $reservation_type = $row["type"];
        $end = $_SESSION["employee_hotel_select_edate"];
        $start = $_SESSION["employee_hotel_select_sdate"];
        $hotelID = $_SESSION["employee_hotel_select"] ;

        $query = "INSERT INTO reservation_hotel (reservation_id,hotel_id,reservation_type,amount_of_people,start_date,end_date) VALUES ($reservation_id,$hotelID,'$reservation_type',$tourAmp,'$start','$end')";
        echo $query;
        $mysqli->query($query);
    }


    //Insert tour activities
 
    if (count($activity_arr )!= 0 ) {
        foreach ($activity_arr as $activityID) {
            $query = "INSERT INTO reservation_tour_activity (user_id,tour_id,activity_id,count) VALUES ($user_id,$tourID,$activityID,$tourAmp)";
            $mysqli->query($query);
        }
    }


}


header( "location: ../employeeHome.php");


?>
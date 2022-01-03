<?php
include("./connection/checkSession.php");

$rate =  isset($_POST['rate']) ? $_POST['rate'] : "empty";
$evaluation =  isset($_POST['review']) ? $_POST['review'] : "empty";
$hotelId =  isset($_POST['hotelId']) ? $_POST['hotelId'] : "empty";
$query = "INSERT INTO hotel_evaluation (evalutaion_id, hotel_id, rate, evaluation) VALUES ( null, '$hotelId', '$rate', '$evaluation' )";
echo $query;
if($mysqli->query($query)){
    //header("Location: hotelDisplay.php?id=$hotelId");
    echo "basarili";
}
else {
    echo "basarisiz";
}

$query = "UPDATE `Hotel` SET people_rated = people_rated+1 WHERE `hotel_id` = $hotelId";
echo $query;
if($mysqli->query($query)){
    //header("Location: hotelDisplay.php?id=$hotelId");
    echo "basarili";
}
else {
}

$query = "UPDATE `Hotel` SET total_rate = total_rate+$rate WHERE `hotel_id` = $hotelId";
if($mysqli->query($query)){
    header("Location: hotelDisplay.php?id=$hotelId");
    echo "basarili";
}
else {
}

// $result = $mysqli->query($query);
// $hotel_result = $result->fetch_array(MYSQLI_NUM);
// $people_rated = $hotel_result[0];
// $total_rate = $hotel_result[1];

// echo $people_rated;
// echo $total_rate;
// echo "<br></br>";
// echo $evaluation;

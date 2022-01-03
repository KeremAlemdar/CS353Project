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

$query = "SELECT people_rated, total_rate FROM Hotel WHERE hotel_id = '$hotelId'";
$result = $mysqli->query($query);
$hotel_result = $result->fetch_assoc();
$people_rated = $hotel_result[0];
$total_rate = $hotel_result[1];

echo $people_rated;
echo $total_rate;
echo "<br></br>";
echo $evaluation;

?>
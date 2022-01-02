<?php
include("./connection/checkSession.php");

$rate =  isset($_POST['rate']) ? $_POST['rate'] : "empty";
$evaluation =  isset($_POST['review']) ? $_POST['review'] : "empty";
$hotelId =  isset($_POST['hotelId']) ? $_POST['hotelId'] : "empty";
$query = "INSERT INTO hotel_evaluation (evalutaion_id, hotel_id, rate, evaluation) VALUES ( null, '$hotelId', '$rate', '$evaluation' )";
echo $query;
if($mysqli->query($query)){
    echo "basarili";
}
else {
    echo "basarisiz";
}
echo $rate;
echo "<br></br>";
echo $evaluation;

?>
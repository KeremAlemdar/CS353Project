<?php
include("./connection/checkSession.php");

$rate =  isset($_POST['rate']) ? $_POST['rate'] : "empty";
$evaluation =  isset($_POST['review']) ? $_POST['review'] : "empty";
$tour_id =  isset($_POST['tour_id']) ? $_POST['tour_id'] : "empty";
$query = "INSERT INTO evaluate_tour (evalutaion_id, tour_id, rate, evaluation) VALUES ( null, '$tour_id', '$rate', '$evaluation' )";
echo $query;
if($mysqli->query($query)){
    header("Location: tourDisplay.php?id=$tour_id");
    echo "basarili";
}
else {
    echo "basarisiz";
}
echo $rate;
echo "<br></br>";
echo $evaluation;

?>
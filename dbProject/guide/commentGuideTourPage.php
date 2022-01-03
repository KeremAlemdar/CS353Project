<?php
include("../connection/checkSession.php");

$rate =  isset($_POST['rate']) ? $_POST['rate'] : "empty";
$evaluation =  isset($_POST['review']) ? $_POST['review'] : "empty";
$tour_id =  isset($_POST['tour_id']) ? $_POST['tour_id'] : "empty";
$guide_id = $_SESSION['user_id'];

$query = "INSERT INTO guide_evaluate_tour (evalutaion_id, guide_id, tour_id, rate, evaluation) VALUES ( null, '$guide_id', '$tour_id', '$rate', '$evaluation' )";
//echo $query;
if($mysqli->query($query)){
    header("Location: guideHome.php?id=$guide_id");
    //echo "basarili";
}
else {
    //echo "basarisiz";
}
//echo $rate;
//echo "<br></br>";
//echo $evaluation;

?>
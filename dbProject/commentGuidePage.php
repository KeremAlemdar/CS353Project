<?php
include("./connection/checkSession.php");

$rate =  isset($_POST['rate']) ? $_POST['rate'] : "empty";
$evaluation =  isset($_POST['review']) ? $_POST['review'] : "empty";
$guide_id =  isset($_POST['guide_id']) ? $_POST['guide_id'] : "empty";
$query = "INSERT INTO evaluate_guide (evalutaion_id, guide_id, rate, evaluation) VALUES ( null, '$guide_id', '$rate', '$evaluation' )";
//echo $query;
if($mysqli->query($query)){
    header("Location: pastReservationsPage.php");
    echo "basarili";
}
else {
    echo "basarisiz";
}
echo $rate;
echo "<br></br>";
echo $evaluation;

?>
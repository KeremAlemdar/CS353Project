<?php
include("../connection/checkSession.php");

$rate =  isset($_POST['rate']) ? $_POST['rate'] : "empty";
$evaluation =  isset($_POST['review']) ? $_POST['review'] : "empty";
$tour_id =  isset($_POST['tour_id']) ? $_POST['tour_id'] : "empty";
// $user_id = $_SESSION['uid'];
$guide_id = 2; // FOR TEST PURPOSES

$query = "UPDATE `tour_guide` SET acceptance_status = '0' WHERE `guide_id` = $guide_id AND `tour_id` = $tour_id";
echo $query;
if($mysqli->query($query)){
    // header("Location: guideHome.php?id=$guide_id");
    echo "basarili";
}
else {
    //echo "basarisiz";
}
$query = "UPDATE `tour_guide` SET reason = '$evaluation' WHERE `guide_id` = $guide_id AND `tour_id` = $tour_id";
echo $query;
if($mysqli->query($query)){
    header("Location: guideHome.php?id=$guide_id");
    echo "basarili";
}
else {
    //echo "basarisiz";
}
//echo $rate;
//echo "<br></br>";
//echo $evaluation;

?>
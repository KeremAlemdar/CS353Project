<?php
session_start();
include("../../connection/config.php");
var_dump($_POST);

$id = $_POST["hidden_edit"];
$tname = $_POST["tour_name"];
$tinf = $_POST["tour_inf"];
$tsta = $_POST["tour_sta"];
$std_date=date("Y-m-d H:i:s",strtotime($tsta));
$tend = $_POST["tour_end"];
$end_date=date("Y-m-d H:i:s",strtotime($tsta));
$cost = $_POST["cost"];

$query =  "INSERT INTO `tour` (`tour_id`, `start_date`, `end_date`, `tour_information`, `image`, `tour_name`, `cost`) VALUES (NULL, '$std_date', '$end_date', '$tinf', 'tour1.jpg', '$tname', '$cost')";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: tourCrud.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}


?>
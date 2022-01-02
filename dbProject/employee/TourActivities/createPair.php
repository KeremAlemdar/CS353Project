<?php
session_start();
include("../../connection/config.php");

$aid = $_POST["aid"];
$tid = $_POST["tid"];
$date = $_POST["date"];
$f_date = date("Y-m-d H:i:s",strtotime($date));
$query = "INSERT INTO `tour_activity` (`activity_id`, `tour_id`, `date`) VALUES ('$aid', '$tid', '$f_date')";

$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: tourActivities.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}

?>
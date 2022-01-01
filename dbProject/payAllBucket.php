<?php
include("./connection/checkSession.php");
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = 1;
$query = "SELECT * FROM `tour_bucket` WHERE `user_id`= 1";
$tours = $mysqli->query($query);
$empty = false;
if ($tours->num_rows == 0) {
    $empty = true;
}
while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
    echo "patates";
    $query = "INSERT INTO reservation";
    $reservationAdding = $mysqli->query($query);
    echo $reservationAdding;
}
?>
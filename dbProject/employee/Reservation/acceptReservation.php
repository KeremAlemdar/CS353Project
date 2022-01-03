<?php
include("../../connection/checkSession.php");
include("../employeeNavbar.php");
$reservation_id = $_GET['reservation_id'];
$customer_id = $_GET['id'];

$query = "UPDATE `customer_reserve` SET acceptance_status = 1 WHERE `customer_id` = $customer_id AND `reservation_id` = $reservation_id";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: reservationAccept.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}
?>
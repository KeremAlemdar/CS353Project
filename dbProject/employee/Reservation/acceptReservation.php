<?php
include("../../connection/checkSession.php");
include("../employeeNavbar.php");

$reservation_id =  isset($_POST['hidden_reservation_id']) ? $_POST['hidden_reservation_id'] : "";
$customer_id =  isset($_POST['hidden_user_id']) ? $_POST['hidden_user_id'] : "";
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
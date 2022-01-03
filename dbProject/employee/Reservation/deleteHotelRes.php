<?php
include("../../connection/checkSession.php");
include("../employeeNavbar.php");
$uid = $_POST['hidden_user_id'];
$resid = $_POST['hidden_reservation_id'];

$query = "DELETE FROM `reservation_hotel` WHERE `reservation_hotel`.`reservation_id` = $resid";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: displayHotelRes.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}
?>
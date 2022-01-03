<?php
include("./connection/checkSession.php");
$reservation_id =  isset($_POST['reservation_id']) ? $_POST['reservation_id'] : "";

$query1 = "DELETE FROM `customer_reserve` WHERE `customer_reserve`.`reservation_id` = $reservation_id";
$query2 = "DELETE FROM `employee_reserve` WHERE `employee_reserve`.`reservation_id` = $reservation_id";
$query3 = "DELETE FROM `reservation_hotel` WHERE `reservation_hotel`.`reservation_id` = $reservation_id";
$query4 = "DELETE FROM `reservation` WHERE `reservation`.`reservation_id` = $reservation_id";

echo $query1;
echo "<br></br>";
echo $query2;
echo "<br></br>";
echo $query3;

if (($result1 = $mysqli->query($query1)) || ($result2 = $mysqli->query($query2)) && ($result3 = $mysqli->query($query3)) && ($result4 = $mysqli->query($query4))) {
    header("Location: profilePage.php");
} 
else {
    header("Location: profilePage.php?error=cannotDelete");
}
?>
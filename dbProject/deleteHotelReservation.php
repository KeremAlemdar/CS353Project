<?php
include("./connection/checkSession.php");
$hotel_id =  isset($_POST['hotel_id']) ? $_POST['hotel_id'] : "";

$query1 = "DELETE FROM `reserve` WHERE `reserve`.`reservation_id` = $hotel_id and `customer_id` = " . 1 . "";
$query2 = "DELETE FROM `Reservation` WHERE `Reservation`.`reservation_id` = $hotel_id";
$query3 = "DELETE FROM `reservation_hotelR` WHERE `reservation_hotelR`.`reservation_id` = $hotel_id";
echo $query1;
echo "<br></br>";
echo $query2;
echo "<br></br>";
echo $query3;
if (($result1 = $mysqli->query($query1)) && ($result2 = $mysqli->query($query2)) && ($result3 = $mysqli->query($query3))) {
    header("Location: profilePage.php");
} 
else {
    header("Location: profilePage.php?error=cannotDelete");
}
?>
<?php
include("./connection/checkSession.php");
$ticket_id =  isset($_POST['ticket_id']) ? $_POST['ticket_id'] : "";
echo $ticket_id;
$query = "DELETE FROM `flight_ticket` WHERE `ticket_id` = $ticket_id";
if ($result = $mysqli->query($query)) {
    header("Location: profilePage.php");
} else {
    header("Location: profilePage.php?error=cannotDelete");
}
?>
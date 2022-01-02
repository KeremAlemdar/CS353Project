<?php
session_start();
include("../../connection/config.php");
$query = "DELETE FROM `tour_activity` WHERE `tour_activity`.`activity_id` =". $_POST["hidden_delete_tid"] ." AND `tour_activity`.`tour_id` =" . $_POST["hidden_delete_aid"];
$result = $mysqli->query($query);

header("location: tourActivities.php");
?>
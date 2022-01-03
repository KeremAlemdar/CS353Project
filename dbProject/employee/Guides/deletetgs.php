<?php
include("../../connection/checkSession.php");
include("../employeeNavbar.php");
$g_id = $_GET['guideid'];
$t_id = $_GET['tourid'];

$query = "DELETE FROM `tour_guide` WHERE `tour_guide`.`tour_id` = $t_id AND `tour_guide`.`guide_id` = $g_id";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: ../employeeHome.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}
?>
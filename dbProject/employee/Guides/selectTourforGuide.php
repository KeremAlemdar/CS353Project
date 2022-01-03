<?php
include("../../connection/checkSession.php");
include("../employeeNavbar.php");
$g_id = $_GET['g_id'];
$t_id = $_GET['t_id'];

$query = "INSERT INTO `tour_guide` (`tour_id`, `guide_id`, `acceptance_status`) VALUES ('$t_id', '$g_id', '2')";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: ../employeeHome.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}
?>
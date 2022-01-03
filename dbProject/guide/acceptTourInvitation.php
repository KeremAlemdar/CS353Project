<?php
include("../connection/checkSession.php");
$tour_id =  isset($_GET['id']) ? $_GET['id'] : "";
echo $tour_id;

// $user_id = $_SESSION['uid'];
$user_id = 2; // FOR TEST PURPOSES
$query = "UPDATE `tour_guide` SET acceptance_status = '1' WHERE `guide_id` = $user_id AND `tour_id` = $tour_id";
if ($result = $mysqli->query($query)) {
    header("Location: tourInvitations.php");
    // echo "added";
} else {
    header("Location: tourInvitations.php?error=cannotAdd");
    // echo "failed";
}
?>

<?php
include("./connection/checkSession.php");

$previous = $_SESSION['previous'];
$activities = "";
if (isset($_POST['activities'])) {
    $activities = $_POST['activities'];

    echo 'Seçtiğiniz activitiler: <br/>';

    foreach ($activities as $activity) {
        echo ' * ' . $activity . ' <br/>';
    }
} else {
    echo 'Hiç activitiy seçmediniz.';
}
// $user_id = $_SESSION['uid'];
$user_id = 1;
$tour_id = $_GET['tour_id'];
$date = date("Y/m/d");
echo $date;
// $query = "INSERT INTO `tour_bucket` (`user_id`, `tour_id`, `activity_id`) VALUES ('1', '1', '1')";
// if ($result = $mysqli->query($query)) {
//             echo "added";
//         } else {
//             echo "failed";
//         }
$query = "INSERT INTO `tour_bucket` (`user_id`, `tour_id`) VALUES (" . $user_id . "," . $tour_id . ")";
$result = $mysqli->query($query);
foreach ($activities as $activity) {
    $query = "INSERT INTO `tour_activity_bucket` (`user_id`, `tour_id`, `activity_id`) VALUES (" . $user_id . "," . $tour_id . "," . $activity . ")";
    echo $query;
    if ($result = $mysqli->query($query)) {
        header("Location: paymentPage.php");
        echo "added";
    } else {
        header("Location:".$previous."&error=cannotAdd");
        echo "failed";
    }
}

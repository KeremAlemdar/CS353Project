<?php
include("./connection/checkSession.php");
$activities = "";
if(isset($_POST['activities'])) {
    $activities = $_POST['activities'];
 
    echo 'Seçtiğiniz activitiler: <br/>';
 
    foreach($activities as $activity) {
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
foreach($activities as $activity) {
    $query = "insert into bucket values('$user_id','$tour_id','$activity')";
    echo $query;
    if ($result = $mysqli->query($query)) {
        echo "added";
    } else {
        echo "failed";
    }
}
?>
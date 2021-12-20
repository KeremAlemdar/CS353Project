<?php
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : "";
$end_date =  isset($_POST['end_date']) ? $_POST['end_date'] : "";
$searchKey =  isset($_POST['searchKey']) ? $_POST['searchKey'] : "";
if(empty($start_date) && empty($end_date) && empty($searchKey)) {
    echo 'values  null';
}
else {
    echo $start_date;
    echo $end_date;
    echo $searchKey;
}
if(empty($start_date) && empty($end_date)) {
    $query = "select * from tour where tour_information LIKE %searchKey%";
}
else if(empty($start_date)) {
    $query = "select * from tour where tour_information LIKE %searchKey% 
    and tour.end_date = end_date";
}
else if(empty($end_date)) {
    $query = "select * from tour where tour_information LIKE %searchKey%
    and tour.start_date = start_date";
}
else {
    $query = "select * from tour where tour_information LIKE %searchKey%
    and tour.start_date = start_date and tour.end_date = end_date";
}
$result = $mysqli->query($query);
var_dump($result);
?>
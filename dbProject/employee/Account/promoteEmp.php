<?php

session_start();
include("../../connection/config.php");


$id = $_GET["id"];
$status = $_GET["status"];

$query = "INSERT INTO `employee` (`employee_id`) VALUES ('$id')";
$result = $mysqli->query($query);



if (strcmp($status , "Customer") == 0) {
    $query = "DELETE FROM `customer` WHERE `customer`.`customer_id` = $id";
}
elseif (strcmp($status, "Guide") == 0) {
    $query = "DELETE FROM `guide` WHERE `guide`.`guide_id` = $id";
}

$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: accountCrud.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}

?>


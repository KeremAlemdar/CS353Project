<?php

session_start();
include("../../connection/config.php");


$id = $_GET["id"];
$status = $_GET["status"];

$query = "INSERT INTO `guide` (`guide_id`) VALUES ('$id')";
$result = $mysqli->query($query);



if (strcmp($status , "Customer") == 0) {
    $query = "DELETE FROM `customer` WHERE `customer`.`customer_id` = $id";
}
elseif (strcmp($status, "Employee") == 0) {
    $query = "DELETE FROM `employee` WHERE `employee`.`employee_id` = $id";
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
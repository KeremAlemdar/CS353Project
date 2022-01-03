<?php

session_start();
include("../../connection/config.php");


$id = $_GET["id"];

$query = "INSERT INTO `guide` (`guide_id`) VALUES ('$id')";
$result = $mysqli->query($query);

if ($result) {
    echo "Success";
    header("location: accountCrud.php");
}
else {
    echo("Error description: " . $mysqli -> error);
}

?>


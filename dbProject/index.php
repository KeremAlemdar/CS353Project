<?php
include("checkSession.php");
$return = "start";
if (isset($_GET["msg"]))
$return = $_GET["msg"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TEST</title>
    </head>
    <body>
        <div>deneme</div>
        <a href='./login.php'>Login</a>
        <a href='./mainPage.php'>MainPage</a>
        <a href='./categories.php'>Categories</a>
        <a href='./tour.php'>Tour</a>
        <a href='./tourListing.php'>TourListing</a>
        <a href='./tourDetails.php?id=1'>TourDetails</a>
        <a href='./vacation.php'>Vacation</a>
        <a href='./vacationDetails.php'>VacationDetails</a>
    </body>
</html>
<?php
include("./connection/checkSession.php");
$return = "start";
if (isset($_GET["msg"]))
$return = $_GET["msg"];
?>
<!DOCTYPE html>
<html>
    <head>
    <style>
        .links {
            display: flex;
            font-size: 20px;
        }
        .links div {
            margin-left: 2.5%;
            margin-right: 2.5%;
        }

    </style>
        <title>TEST</title>
    </head>
    <body
        <div class="persons">
        <div class="person">
        <div><h1>İsmet</h1></div>
        <div class="links">
        <div><a href='./login.php'>Login</a></div>
        </div>
        </div>
        <div class="person">
        <div><h1>Kerem</h1></div>
        <div class="links">
        <div><a href='./tour.php'>TourListing</a></div>
        <div><a href='./tourDetails.php?id=1'>TourDetails</a></div>
        <div><a href='./paymentPage.php'>Payment</a></div>
        <div><a href='./deneme.php'>FontAwesome</a></div>
        </div>
        </div>
        <div class="person">
        <div><h1>Eylül</h1></div>
        <div class="links">
        </div>
        </div>
        <div class="person">
        <div><h1>İsmet</h1></div>
        <div class="links">
        </div>
        </div>
        <div class="person">
        <div><h1>Diğerleri</h1></div>
        <div class="links">
        <div><a href='./mainPage.php'>MainPage</a></div>
        <div><a href='./categories.php'>Categories</a></div>
        <div><a href='./vacation.php'>Vacation</a></div>
        <div><a href='./vacationDetails.php'>VacationDetails</a></div>
        </div>
        </div>
        </div>

    </body>
</html>
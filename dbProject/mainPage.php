<?php
// include("./components/categories.php");
include("./components/navbar.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Main Page</title>
    <style>
        .all {
            display: flex;
            justify-content: center;
        }
        .types>* {
            flex: 40%; /* increase number of items in a row */
            margin-left: 2.5%;
            margin-right: 2.5%;
            margin-top: 2.5%;
        }
        .types {
            width: 80%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .menuItem {
            width: 40%;
            height: auto;
        }

        img {
            width: 100%;
            height: 100%;
        }
        .header {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="all">
    <div class="types">
        <div class="menuItem">
            <div class="image">
                <a href='THERE WILL BE PLANE LIST PAGE'>
                    <img src='./img/planes.png' />
                </a>
            </div>
            <div class="header">
                <h1>
                    Plane
                </h1>
            </div>
        </div>
        <div class="menuItem">
            <div class="image">
                <a href='./tour.php'>
                    <img src='./img/tour.png' />
                </a>
            </div>
            <div class="header">
                <h1>
                    Tour
                </h1>
            </div>
        </div>
        <div class="menuItem">
            <div class="image">
                <a href='./hotelListPage.php'>
                    <img src='./img/hotel.jpg' />
                </a>
            </div>
            <div class="header">
                <h1>
                    Hotel
                </h1>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
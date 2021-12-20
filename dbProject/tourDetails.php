<?php
include("./connection/checkSession.php");
include("./components/navbar.php");
# Tour(tour_id, start_date, end_date, tour_information)
# Tour_Activity (activity_id, tour_id, date)
# Activity (activity_id, content, name, location, price, categories)

$tour_id = $_GET["id"];
$query = "select * from tour where tour_id=$tour_id";
$result = $mysqli->query($query);
$query = "select * from tour_activity natural join activity where tour_id=$tour_id";
$activities = $mysqli->query($query);
#ACTIVITIES
# activity_id, tour_id, date, content, name, location, price, categories
?>

<!DOCTYPE html>
<html>
    <head>
    <style>

        .tour {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .tour_dates{
            display: flex;
            justify-content: space-between;
            width: 6.5%;
        }
        .tour_details {

        }
        .activities {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .activity {
            width: 10%;
            justify-content: center;
            margin-left: 2.5%;
            margin-right: 2.5%;
        }
        .information {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .activity img {
            width: 100%;
            height: 100%;
        }
        .tour img {
            width: 35%;
        }
    </style>
        <title>Tour Name</title>
    </head>
    <body>
        <div>
            <?php 
            while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
                echo "
                <div class='all'>
                <div class='tour'>
                <div><h1>There will be tour name</h1></div>
                <div class='tour_dates'>
                <div>" . $tuple[1] . "</div>
                <div>-</div>
                <div>" . $tuple[2] . "</div>
                </div>
                <div><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiQc9dZn33Wnk-j0sXZ19f8NiMZpJys7nTlA&usqp=CAU'/></div>

                <div><h2>Tour Details</h2></div>
                <div class='tour_details'>" . $tuple[3] . "</div>
                </div>
                </div>
                ";
            }
            echo "<div>
            <div><h1>Activities</h1></div>
            <div class='activities'>";
            while ($tuple = $activities->fetch_array(MYSQLI_NUM)) {
                // <div><img src=" . $tuple[resim] . "/></div>

                echo "
                <div class='activity'>
                <div><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiQc9dZn33Wnk-j0sXZ19f8NiMZpJys7nTlA&usqp=CAU'/></div>
                <div class='information'>
                    <div>" . $tuple[4] . "</div>
                    <div>" . $tuple[6] . "</div>
                </div>
                <div>" . $tuple[2] . "</div>
                </div>
                ";
            }
            echo "</div></div>"
            ?>            
        </div>
    </body>
</html>

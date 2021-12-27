<?php
include("./connection/checkSession.php");
include("./components/navbar.php");
# Tour(tour_id, start_date, end_date, tour_information, image)
# Tour_Activity (activity_id, tour_id, date, image)
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

        .tour_dates {
            display: flex;
            justify-content: space-between;
            width: 6.5%;
        }

        .tour_details {}

        .activities {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .activity {
            width: 10%;
            /* increase activity size */
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
        .button {
            display: flex;
            justify-content: right;
        }
        .input {
            font-size: 30px;
        }
    </style>
    <title>Tour Name</title>
</head>

<body>
    <div>
    <form class="form" action='addBucket.php?tour_id=<?php echo $tour_id?>' method="post">
        <div class="button"><input class="input" type="submit" value="Add To Bucket"></div>
        <div class="inside_form">
        
        <?php
        while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
            echo "
                <div class='all'>
                <div class='tour'>
                <div><h1>".$tuple[5]."</h1></div>
            <div></div>
                <div class='tour_dates'>
                <div>" . $tuple[1] . "</div>
                <div></div>
                <div>" . $tuple[2] . "</div>
                </div>
                <div><img src='./img/" . $tuple[4] . "'/></div>
                <div><h2>Tour Details</h2></div>
                <div class='tour_details'>" . $tuple[3] . "</div>
                </div>
                </div>
                ";
        }
        echo "<div>
        <div><h1>Activities</h1></div>
        <div><h2>Check activities you want to add</h2></div>
        <div class='activities'>";
            ?>
            <?php
        while ($tuple = $activities->fetch_array(MYSQLI_NUM)) {
            // <div><img src=" . $tuple[resim] . "/></div>
            ?>
              <label><input type="checkbox" name="activities[]" value=<?php echo $tuple[0] ?> /> <?php echo $tuple[0]?></label><br />
            <?php
              echo "
                <div class='activity'>
                <div><img src='./img/" . $tuple[8] . "'/></div>
                <div class='information'>
                    <div>" . $tuple[4] . "</div>
                    <div>" . $tuple[6] . "</div>
                </div>
                <div>" . $tuple[2] . "</div>
                </div>
                ";
        }
        echo "</div></div>";
        ?>
</div>
        </form>
    </div>
</body>

</html>
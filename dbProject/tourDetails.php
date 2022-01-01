<?php
include("./connection/checkSession.php");
include("./components/navbar.php");
# Tour(tour_id, start_date, end_date, tour_information, image)
# Tour_Activity (activity_id, tour_id, date, image)
# Activity (activity_id, content, name, location, price, categories)
$page_url   = 'http';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $page_url .= 's';
}
$current = $page_url . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$_SESSION['previous'] = $current;

$error = isset($_GET['error']) ? $_GET['error'] : "";
if ($error == "cannotAdd") {
    echo "<script type='text/javascript'>
    alert('It is already in your bucket');
    window.location.href='./paymentPage.php';
    </script>";
}
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

        .tour .tour_dates {
            display: flex;
            justify-content: right;
        }

        .tour_details {
            border: 2px solid black;
        }

        .tour img {
            width: 100%;
        }

        .tour .tour_name_bar {
            display: flex;
            justify-content: space-between;
        }

        .tour .tour_img {
            display: flex;
            justify-content: right;
        }

        .tour_name {
            display: flex;
        }

        .tour_upper {
            display: flex;
            flex-direction: column;
            justify-content: right;
        }

        .tour_lower {
            text-align: center;
        }

        .activities {
            display: flex;
            justify-content: center;
            border: 2px solid black;
            flex-wrap: wrap;
        }

        .activity {
            width: 20%;
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

        .button {}

        .input {
            height: 50%;
            font-size: 18px;
            background-color: blue;
            color: white;
            display: flex;
            align-items: center;
        }

        .page {
            display: flex;
            justify-content: center;
        }

        .inner_page {
            width: 70%;
        }
    </style>
    <title>Tour Name</title>
</head>

<body>
    <div class="outer_page">
        <div class="page">
            <div class="inner_page">
                <form class="form" action='addTourBucket.php?tour_id=<?php echo $tour_id ?>' method="post">
                    <div class="inside_form">
                        <?php
                        while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
                        ?>
                            <div class='all'>
                                <div class='tour'>
                                    <div class="tour_upper">
                                        <div class="tour_name_bar">
                                            <div class="tour_name">
                                                <h1><?php echo $tuple[5] ?></h1>
                                            </div>
                                            <div class="button">
                                                <input class="input" type="submit" value="Reserve">
                                            </div>
                                        </div>
                                        <div class='tour_dates'>
                                            <div>
                                                <?php echo $tuple[1] ?>
                                            </div>
                                            <div>
                                                <?php echo "-" ?>
                                            </div>
                                            <div>
                                                <?php echo $tuple[2] ?>
                                            </div>
                                        </div>
                                        <div class="tour_img">
                                            <img src='./img/<?php echo $tuple[4] ?>' />
                                        </div>
                                    </div>
                                    <div class="tour_lower">
                                        <div class='tour_details'>
                                            <div>
                                                <h2>Tour Details</h2>
                                            </div>
                                            <div>
                                                <?php echo $tuple[3] ?>
                                            </div>
                                            <div>
                                                <label>Enter number of people &nbsp
                                                    <input type="number" name="numberOfTour" value=1 />
                                                </label>
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div>
                            <h1>Activities</h1>
                        </div>
                        <div>
                            <h2>Check activities you want to add</h2>
                        </div>
                        <div class='activities'>
                            <?php
                            while ($tuple = $activities->fetch_array(MYSQLI_NUM)) {
                                // <div><img src=" . $tuple[resim] . "/></div>
                            ?>
                                <div class='activity'>
                                    <div>
                                        <img src='./img/<?php echo $tuple[8] ?>' />
                                    </div>
                                    <div class='information'>
                                        <div>
                                            <?php echo $tuple[4] ?>
                                        </div>
                                        <div>
                                            <?php echo $tuple[6] ?>
                                        </div>
                                    </div>
                                    <div><?php echo $tuple[2] ?>
                                    </div>
                                </div>
                                <label>
                                    <input type="hidden" name="activities[]" value=<?php echo $tuple[0] ?> />
                                </label>
                                <br />
                                <label>Enter number of people &nbsp
                                    <input type="number" name="numberOfActivity[]" value=0 />
                                </label>
                                <br />
                            <?php
                            }
                            ?>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
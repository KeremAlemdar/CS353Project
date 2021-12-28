<?php
include("./components/navbar.php");
include("./connection/checkSession.php");
$user_id =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$error =  isset($_GET['error']) ? $_GET['error'] : "";
if ($error == "cannotDelete") {
    echo "<script type='text/javascript'>
    alert('Problem occured in deletion');
    window.location.href='./paymentPage.php';
    </script>";
}


$user_id = 1; // FOR TEST PURPOSES
// $query = "select * from ((tour natural join tour_bucket) natural join activity) where user_id =" . $user_id . "";

$query = "SELECT DISTINCT `tour`.* FROM `tour` LEFT JOIN `tour_bucket` ON `tour_bucket`.`tour_id` = `tour`.`tour_id` WHERE `user_id`= 1";
$tours = $mysqli->query($query);
$empty = false;
if ($tours->num_rows == 0) {
    $empty = true;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .all {
            width: 80%;
        }

        .page {
            display: flex;
            justify-content: center;
        }

        .page_header {}

        .buckets {
            border: 1px solid black;
            display: flex;
            flex-direction: row;
        }

        /* HOTEL CSS */
        .hotel_bucket {
            border: 1px solid black;
            width: 33%;
        }

        .tour_all_bucket {
            width: 33%;
            display: flex;
            flex-direction: column;
        }

        /* TOUR CSS */
        .tour_bucket {
            border: 1px solid black;
        }

        .tour {
            margin: 2.5%;
            display: flex;
            flex-direction: row;
            border: 1.5px solid black;
        }

        .tour_all {
            display: flex;
            flex-direction: column;
        }

        .tour_all .tour_img {
            width: 100%;
            height: 100%;
        }

        .tour_all .tour_img img {
            width: 100%;
            height: 100%;
        }

        .tour_all .tour_information {
            display: flex;
            flex-direction: row;
        }

        .tour .tour_button {
            display: flex;
        }

        .activities {}

        .activity {
            width: 80%;
            margin: 2.5%;
            display: flex;
            justify-content: space-between;
            border: 1.5px solid black;
        }

        .activity_all {
            width: 40%;
            display: flex;
            flex-direction: column;
        }

        .activity_all .activity_img {
            width: 100%;
            height: 100%;
        }

        .activity_all .activity_img img {
            width: 100%;
            height: 100%;
        }

        .activity_all .activity_information {}

        .activity .activity_button {
            display: flex;
        }

        /* PLANE CSS */
        .plane_bucket {
            width: 33%;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="all">
            <div class="page_header">
                <h1>Your Bucket</h1>
            </div>
            <div class="buckets">
                <div class="hotel_bucket">
                    <div class="hotel_bucket_header">
                        <h1>Hotels in your bucket</h1>
                    </div>
                </div>
                <div class="tour_all_bucket">
                    <?php
                    if ($empty) {
                    ?>
                        <div class="tour_bucket_header">
                            <h1>Your tour bucket is empty</h1>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="tour_bucket_header">
                            <h1>Tours in your bucket</h1>
                        </div>
                        <div class="tour_bucket">
                            <div class="tours">
                                <?php
                                while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
                                ?>
                                    <form class="form" action='deleteTourFromBucket.php' method="post">
                                        <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tuple[0] ?>>
                                        <div class="tour">
                                            <div class="tour_all">
                                                <div class="tour_information">
                                                    <h1>
                                                        <?php echo $tuple[5] ?>
                                                    </h1>
                                                </div>
                                                <div class="tour_img">
                                                    <a href='./tourDetails.php?id=<?php echo $tuple[0] ?>'>
                                                        <img src='./img/<?php echo $tuple[4] ?>' />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="tour_button">
                                                <input class="input" type="submit" value="Remove">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="activities">

                                        <?php
                                        $query = "SELECT `A`.* FROM `activity` AS `A` , `tour` AS `T` ,`tour_activity_bucket` AS `TB` 
                    WHERE `TB`.`tour_id` = `T`.`tour_id` AND `TB`.`activity_id` = `A`.`activity_id` AND user_id = 1";
                                        $activities = $mysqli->query($query);
                                        if ($activities->num_rows > 0) {
                                        ?>
                                            <div>
                                                <h1>Activities in <?php echo $tuple[5] ?>
                                                </h1>
                                            </div>
                                        <?php
                                        }
                                        while ($activity_tuple = $activities->fetch_array(MYSQLI_NUM)) {
                                        ?>
                                            <form class="form" action='deleteActivityFromBucket.php' method="post">
                                                <input type="hidden" id="activity_id" name="activity_id" value=<?php echo $activity_tuple[0] ?>>
                                                <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tuple[0] ?>>
                                                <div class="activity">
                                                    <div class="activity_all">
                                                        <div class="activity_img">
                                                            <img src='./img/<?php echo $activity_tuple[6] ?>' />
                                                        </div>
                                                        <div class="activity_information">
                                                            <div>
                                                                <?php echo $activity_tuple[2] ?>

                                                            </div>
                                                            <div>
                                                                <?php echo $tuple[4] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="activity_button">
                                                        <input class="input" type="submit" value="Remove">
                                                    </div>
                                                </div>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="plane_bucket">

                </div>
            </div>
        </div>
    </div>
</body>

</html>
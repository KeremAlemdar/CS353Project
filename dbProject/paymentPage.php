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
            width: 70%;
            display: flex;
            justify-content: center;
        }

        .tours {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .tours>* {
            flex: 40%;
            /* increase number of items in a row */
        }

        .tour {
            border: 2px solid black;
            display: flex;
            width: 40%;
            height: auto;
            /* 40% dı, 2 liyken kücülmeyi çözmek için auto yaptım*/
        }

        .information {
            margin-left: 2.5%;
            margin-right: 2.5%;
            width: 45%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        img {
            width: 100%;
            height: 100%;
        }

        .img {
            width: 50%;
            height: 100%;
        }

        .decline {
            width: 60%;
            display: flex;
            justify-content: space-between;

        }

        .delete {
            width: 20%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .empty {
            font-size: 40px;
            display: flex;
            justify-content: center;
            margin-top: 10%;
        }

        .form {
            display: flex;
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
    </style>
</head>

<body>
    <?php
    if ($empty) {
    ?>
        <div class="empty">Your bucket is empty</div>
    <?php
    }
    ?>

    <?php
    while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
    ?>
        <form class="form" action='deleteTourFromBucket.php.php' method="post">
            <div>
                <input class="input" type="submit" value="Remove">
            </div>
            <div>
                <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tuple[0] ?>>
            </div>
            <div class="tour">
                <div class="img">
                    <a href='./tourDetails.php?id=<?php echo $tuple[0] ?>'>
                        <img src='./img/<?php echo $tuple[4] ?>' />
                    </a>
                </div>
                <div class="information">
                    <h1>
                        <?php echo $tuple[5] ?>
                    </h1>
                    <h1>
                        <?php echo $tuple[3] ?>
                    </h1>
                </div>
            </div>
            <?php
            $query = "SELECT `A`.* FROM `activity` AS `A` , `tour` AS `T` ,`tour_bucket` AS `TB` 
WHERE `TB`.`tour_id` = `T`.`tour_id` AND `TB`.`activity_id` = `A`.`activity_id` AND user_id = 1";
            $activities = $mysqli->query($query);
            while ($tuple = $activities->fetch_array(MYSQLI_NUM)) {
            ?>
                <form class="form" action='deleteActivityFromBucket.php.php' method="post">
                    <div class="activities">
                        <div class='activity'>
                            <div>
                                <img src='./img/<?php echo $tuple[6] ?>' />
                            </div>
                            <div class='information'>
                                <div>
                                    <?php echo $tuple[2] ?>
                                </div>
                                <div>
                                    <?php echo $tuple[4] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="input" type="submit" value="Remove">
                    </div>

                </form>
            <?php
            }
            ?>
        </form>
    <?php
    }
    ?>
</body>

</html>
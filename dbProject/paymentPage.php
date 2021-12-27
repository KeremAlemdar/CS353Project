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
        .fullActivity {
            width: 80%;
        }

        .tour .information {
            border: 3px solid red;
        }

        .tour img {
            width: 100%;
            border: 3px solid blue;
            height: auto;
        }

        .tour .imagepart {
            width: 65%;
            height: auto;
        }

        .activity img {
            width: 20%;
            height: auto;
        }

        .tour {
            display: flex;
            border: 3px solid black;
        }

        .activities {
            margin-left: 5%;
        }

        .activity_form {
            display: flex;
        }

        .activity_form .button {
            display: flex;
            align-items: center;
        }

        .activity_link_button {
            display: flex;
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
        <div class="fullActivity">
            <form class="form" action='deleteTourFromBucket.php.php' method="post">
                <div class="activity_form">

                    <div>
                        <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tuple[0] ?>>
                    </div>
                    <div class="tour">
                        <div class="imagepart">
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
                    <div class="button">
                        <input class="input" type="submit" value="Remove">
                    </div>
                </div>
                <?php
                $query = "SELECT `A`.* FROM `activity` AS `A` , `tour` AS `T` ,`tour_bucket` AS `TB` 
WHERE `TB`.`tour_id` = `T`.`tour_id` AND `TB`.`activity_id` = `A`.`activity_id` AND user_id = 1";
                $activities = $mysqli->query($query);

                while ($tuple = $activities->fetch_array(MYSQLI_NUM)) {
                ?>
                    <div class="activities">
                        <form class="form" action='deleteActivityFromBucket.php.php' method="post">
                            <div class="activity_link_button">
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
                                <div class="activity_button">
                                    <input class="input" type="submit" value="Remove">
                                </div>
                            </div>
                        </form>
                    </div>

                <?php
                }
                ?>

            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>
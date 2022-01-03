<?php
session_start();
include("./connection/checkSession.php");
include('./components/navbar.php');

$user_id = $_SESSION['user_id'];

//USER
$query = "SELECT fname, email, phone_num FROM account WHERE user_id = " . $user_id . "";
$result = $mysqli->query($query);
$user_info = $result->fetch_array(MYSQLI_NUM);

//HOTEL
$date = date("Y/m/d");
$query = "SELECT * FROM reservation NATURAL JOIN customer_reserve NATURAL JOIN reservation_hotel NATURAL JOIN Hotel WHERE customer_id = $user_id AND end_date < '$date' AND acceptance_status = 1";
$hotel_id_result = $mysqli->query($query);

$hotel_empty = false;
if ($hotel_id_result->num_rows == 0) {
    $$hotel_empty = true;
}

$query = "SELECT * FROM reservation NATURAL JOIN employee_reserve NATURAL JOIN reservation_hotel NATURAL JOIN Hotel WHERE customer_id = $user_id AND end_date < '$date'";
$hotel_id_result_employee = $mysqli->query($query);
$hotel_empty_employee = false;
if ($hotel_id_result_employee->num_rows > 0) {
    $hotel_empty_employee = true;
}

//TOUR

$query = "SELECT * FROM reservation NATURAL JOIN customer_reserve NATURAL JOIN reservation_tour NATURAL JOIN tour WHERE customer_id = $user_id AND end_date < '$date' AND acceptance_status = 1";
$tour_id_result = $mysqli->query($query);

$tour_empty = false;
if ($tour_id_result->num_rows == 0) {
    $tour_empty = true;
}

$query = "SELECT * FROM reservation NATURAL JOIN employee_reserve NATURAL JOIN reservation_tour NATURAL JOIN tour WHERE customer_id = $user_id AND end_date < '$date'";
$tour_id_result_employee = $mysqli->query($query);

$tour_empty_employee = false;
if ($tour_id_result_employee->num_rows == 0) {
    $tour_empty_employee = true;
}

//GUIDE

$query = "SELECT guide_id, fname, tour_name FROM reservation_tour NATURAL JOIN tour NATURAL JOIN tour_guide, account, customer_reserve 
WHERE tour_guide.acceptance_status = 1 AND account.user_id = tour_guide.guide_id 
AND customer_reserve.reservation_id = reservation_tour.reservation_id AND customer_reserve.customer_id = $user_id";

$guide_result = $mysqli->query($query);

$guide_exists = false;
if ($guide_result->num_rows > 0) {
    $guide_exists = true;
}
?>




<!DOCTYPE html>
<html>

<head>

    <style>
        .page {}

        .profile {
            display: flex;
            flex-direction: row;
            border: solid black;
            align-items: center;
        }

        .profile .profile_icon {
            width: 5%;
            height: 5%;
        }

        img {
            width: 100%;
            height: 100%;
        }

        .profile .profile_information {}

        .profile .profile_button {
            display: flex;
            align-items: center;
        }

        .profile_page_button {
            display: flex;
            align-items: center;
        }

        .reservations {
            display: flex;
            flex-direction: row;
            justify-content: center;
            border: 3px solid black;
        }

        .reservations .hotels {
            border: 2px solid black;
            width: 50%;
        }

        .reservations .tours {
            border: 2px solid black;
            width: 50%;
        }

        .reservations .flights {
            border: 2px solid black;
            width: 50%;
        }



        .hotel {
            width: 100%;
            display: flex;
            flex-direction: row;
            border: 3px solid black;
            align-items: center;
        }

        .hotel .hotel_img {
            align-items: center;
            width: 30%;
            height: 30%;
        }

        .hotel_button {
            width: 5%;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }

        .tour {
            width: 100%;
            display: flex;
            flex-direction: row;
            border: 3px solid black;
            align-items: center;
        }

        .guide {
            width: 100%;
            display: flex;
            flex-direction: row;
            border: 3px solid black;
            align-items: center;
        }

        .tour .tour_img {
            align-items: center;
            width: 30%;
            height: 30%;
        }

        .tour_button {
            width: 5%;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }


        .input {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 10px 25px;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }

        .edit,
        .past_reservations {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 10px 25px;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }
    </style>

</head>



<body>
    <div class="page">
        <div class="profile_page_button">

            <a href="ProfilePage.php">
                <input class="past_reservations" type="submit" value="Go Back To Profile Page">
            </a>
        </div>
    </div>
    <br>
    <div class="reservations">
        <div class="hotels" style="background-color:#aaa;">
            <h2>Hotel Reservations</h2>
            <?php
            if ($hotel_empty_employee && $hotel_empty) {
            ?>
                <div class="hotel">
                    <h3>You have no past hotel reservations</h3>
                </div>
            <?php
            }
            while ( $tuple = $hotel_id_result->fetch_array(MYSQLI_NUM)) {

            ?>

                <div>
                    <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                </div>
                <div class="hotel">
                    <div class="hotel_img">
                        <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                            <img src='./img/<?php echo $tuple[13] ?>' />
                        </a>
                    </div>
                    <div class="hotels">
                        <div>
                            <h2>
                                <?php echo $tuple[9], ",  ",  $tuple[10] ?>
                            </h2>
                        </div>
                        <div>
                            <h3>
                                <?php
                                echo " First day: ", $tuple[7];
                                echo "<br></br>";
                                echo " Last day: ", $tuple[8];
                                echo "<br></br>";
                                echo $tuple[6], " customers"; ?>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div class="hotel_button">
                            <a href='./hotelCommentAndRatePage.php?id=<?php echo $tuple[0] ?>'>
                                <input class="input" type="submit" value="Comment and Rate">
                            </a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>
            <?php
            while ( $tuple = $hotel_id_result_employee->fetch_array(MYSQLI_NUM)) {
            ?>
                <div>
                    <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                </div>
                <div class="hotel">
                    <div class="hotel_img">
                        <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                            <img src='./img/<?php echo $tuple[13] ?>' />
                        </a>
                    </div>
                    <div class="hotels">
                        <div>
                            <h2>
                                <?php echo $tuple[9], ",  ",  $tuple[10] ?>
                            </h2>
                        </div>
                        <div>
                            <h3>
                                <?php
                                echo " First day: ", $tuple[7];
                                echo "<br></br>";
                                echo " Last day: ", $tuple[8];
                                echo "<br></br>";
                                echo $tuple[6], " customers"; ?>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div class="hotel_button">
                            <a href='./hotelCommentAndRatePage.php?id=<?php echo $tuple[0] ?>'>
                                <input class="input" type="submit" value="Comment and Rate">
                            </a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>
        </div>
        <div class="tours" style="background-color:#aaa;">
            <h2>Tour Reservations</h2>
            <?php
            if ($tour_empty_employee && $tour_empty) {
            ?>
                <div class="tour">
                    <h3>You have no past tour reservations</h3>
                </div>
            <?php
            }
            while ($tuple = $tour_id_result->fetch_array(MYSQLI_NUM)) {

            ?>

                <div>
                    <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                </div>
                <div class="tour">
                    <div class="tour_img">
                        <a href='./tourDetails.php?id=<?php echo $tuple[0] ?>'>
                            <img src='./img/<?php echo $tuple[9] ?>' />
                        </a>
                    </div>
                    <div class="tours">
                        <div>
                            <h2>
                                <?php echo $tuple[10]  ?>
                            </h2>
                        </div>
                        <div>
                            <h3>
                                <?php
                                echo " First day: ", $tuple[6];
                                echo "<br></br>";
                                echo " Last day: ", $tuple[7];
                                echo "<br></br>";
                                echo $tuple[5], " customers"; ?>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div class="tour_button">
                            <a href='./tourCommentAndRatePage.php?id=<?php echo $tuple[0] ?>'>
                                <input class="input" type="submit" value="Comment and Rate">
                            </a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>
            <?php
            while ($tuple = $tour_id_result_employee->fetch_array(MYSQLI_NUM)) {

            ?>
                <div>
                    <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                </div>
                <div class="tour">
                    <div class="tour_img">
                        <a href='./tourDetails.php?id=<?php echo $tuple[0] ?>'>
                            <img src='./img/<?php echo $tuple[9] ?>' />
                        </a>
                    </div>
                    <div class="tours">
                        <div>
                            <h2>
                                <?php echo $tuple[10]  ?>
                            </h2>
                        </div>
                        <div>
                            <h3>
                                <?php
                                echo " First day: ", $tuple[6];
                                echo "<br></br>";
                                echo " Last day: ", $tuple[7];
                                echo "<br></br>";
                                echo $tuple[5], " customers"; ?>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div class="tour_button">
                            <a href='./tourCommentAndRatePage.php?id=<?php echo $tuple[0] ?>'>
                                <input class="input" type="submit" value="Comment and Rate">
                            </a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>
        </div>
        <div class="guides" style="background-color:#aaa;">
            <h2>Guides</h2>
            <?php
            if (!$guide_exists) {
            ?>
                <div class="tour">
                    <h3>You have no past guides</h3>
                </div>
            <?php
            }
            while ($guide_exists && $tuple = $guide_result->fetch_array(MYSQLI_NUM)) {

            ?>
                <div>
                    <input type="hidden" id="guide_id" name="guide_id" value=<?php echo $tuple[0] ?>>
                </div>
                <div class="guide">

                    <div class="guides">
                        <div>
                            <h2>
                                <?php echo "Guide: ", $tuple[1]  ?>
                            </h2>
                            <h2>
                                <?php echo "Tour name: ", $tuple[2]  ?>
                            </h2>
                        </div>

                    </div>
                    <div>
                        <div class="guide_button">
                            <a href='./guideCommentAndRatePage.php?id=<?php echo $tuple[0] ?>'>
                                <input class="input" type="submit" value="Comment and Rate">
                            </a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>
        </div>
    </div>
    </div>

</body>

</html>
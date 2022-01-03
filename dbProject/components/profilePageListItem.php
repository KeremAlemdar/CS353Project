<?php
include("./connection/checkSession.php");
//$user_id = $_SESSION['user_id'];
$user_id = 1;

$date = date("Y/m/d");
//USER
$query = "SELECT fname, email, phone_num FROM account WHERE user_id = " . 1 . "";
$result = $mysqli->query($query);
$user_info = $result->fetch_array(MYSQLI_NUM);

//HOTEL
$query = "SELECT * FROM customer_reserve NATURAL JOIN reservation_hotel NATURAL JOIN Hotel WHERE customer_id = 1 AND end_date > '$date' AND acceptance_status = 1";

$hotel_id_result = $mysqli->query($query);

$query = "SELECT * FROM employee_reserve NATURAL JOIN reservation_hotel NATURAL JOIN Hotel WHERE customer_id = 1 AND end_date > '$date'";
$hotel_id_result_employee = $mysqli->query($query);
$hotel_exists = false;
if ($hotel_id_result_employee->num_rows > 0) {
    $hotel_exists = true;
}
if ($hotel_id_result->num_rows > 0) {
    $hotel_exists = true;
}

//TOUR
$query = "SELECT * FROM customer_reserve NATURAL JOIN reservation_tour NATURAL JOIN tour WHERE customer_id = 1 AND end_date > '$date'";
$tours = $mysqli->query($query);

$tour_empty = false;
if ($tours->num_rows == 0) {
    $tour_empty = true;
}

$query = "SELECT * FROM employee_reserve NATURAL JOIN reservation_tour NATURAL JOIN tour WHERE customer_id = 1 AND end_date > '$date'";
$tours_employee = $mysqli->query($query);
if ($tours_employee->num_rows == 0) {
    $tour_empty = true;
}


//FLIGHT
$query = "SELECT * 
FROM flight_ticket, 
(SELECT dep.city as dep_city, arr.city as arr_city, departure_time, arrival_time, flight_id
FROM airport AS dep, airport AS arr, flight 
WHERE flight.departure_airport = dep.airport_id AND flight.arrival_airport = arr.airport_id
) AS res 
WHERE flight_ticket.customer_id = 1 AND res.flight_id = flight_ticket.flight_id";
$flight_result = $mysqli->query($query);

$flight_empty = true;
if ($flight_result->num_rows > 0) {
    $flight_empty = false;
}
?>

<!DOCTYPE html>
<html>

<head>

    <style>
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


        .profile .profile_button {
            display: flex;
            align-items: center;
        }

        .past_reservations_button {
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

        .input,
        .edit,
        .past_reservations {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 10px 25px;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }

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
            width: 5%;
            display: flex;
            align-items: center;
            margin-right: 15%;
            margin-left: 5%;
        }

        .number_of_tour {
            display: flex;
            flex-direction: column;
        }

        .number_of_tour .numberOf {
            display: flex;
        }

        .number_of_tour .price {
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
            margin-right: 1%;
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

        .activity_information .price {
            display: flex;
        }

        .activity .activity_button {
            display: flex;
            width: 5%;
            display: flex;
            align-items: center;
            margin-right: 20%;
        }

        .activity .number_of_activity {
            display: flex;
        }

        /* .number_of_tour .input {
            margin-left: 5%;
        } */
    </style>

</head>



<body>
    <div class="page">
        <div class="profile">
            <div class="profile_icon">
                <img src='./img/user_icon.png' />
            </div>
            <div class="profile_information">

                <h4>
                    <?php echo "Name: ", $user_info[0] ?>
                </h4>


                <h4>
                    <?php echo "E-mail: ", $user_info[1] ?>
                </h4>


                <h4>
                    <?php echo "Phone: ", $user_info[2] ?>
                </h4>

            </div>
            
            <div class="past_reservations_button">
                <div class="profile_reservation_inner">

                    <a href="pastReservationsPage.php">
                        <input class="past_reservations" type="submit" value="Past Reservations">
                    </a>
                </div>
            </div>
        </div>
        <div class="reservations">
            <div class="hotels" style="background-color:#aaa;">
                <h2>Hotel Reservations</h2>
                <?php
                if ($hotel_empty && $hotel_empty_employee) {
                ?>
                    <div class="hotel">
                        <h3>You have no hotel reservations</h3>
                    </div>
                <?php
                }
                while (!$hotel_empty && $tuple = $hotel_id_result->fetch_array(MYSQLI_NUM)) {
                ?>
                    <form class="form" action='deleteHotelReservation.php' method="post">
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
                                    <input class="input" type="submit" value="Cancel Reservation">
                                </div>
                            </div>

                        </div>
                    </form>
                <?php
                }
                ?>
                <?php
                while (!$hotel_empty_employee && $tuple = $hotel_id_result_employee->fetch_array(MYSQLI_NUM)) {
                ?>
                    <form class="form" action='deleteHotelReservation.php' method="post">
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
                                    <input class="input" type="submit" value="Cancel Reservation">
                                </div>
                            </div>

                        </div>
                    </form>
                <?php
                }
                ?>
                <?php
                while ($hotel_exists && $tuple = $hotel_id_result_employee->fetch_array(MYSQLI_NUM)) {
                ?>
                    <form class="form" action='deleteHotelReservation.php' method="post">
                        <div>
                            <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                        </div>
                        <div class="hotel">
                            <div class="hotel_img">
                                <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                                    <img src='./img/<?php echo $tuple[12] ?>' />
                                </a>
                            </div>
                            <div class="hotels">
                                <div>
                                    <h2>
                                        <?php echo $tuple[8], ",  ",  $tuple[9] ?>
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
                                <div class="hotel_button">
                                    <input class="input" type="submit" value="Cancel Reservation">
                                </div>
                            </div>

                        </div>
                    </form>
                <?php
                }
                ?>
            </div>
            <div class="tours" style="background-color:#aaa;">
                <h2>Tour Reservations</h2>
                <div class="tour_all_bucket">
                    <?php
                    if ($tour_empty && $tour_empty_employee) {
                    ?>
                        <div class="tour_bucket_header">
                            <h1>No upcoming tours</h1>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="tour_bucket_header">
                            <h1>Upcoming Tours</h1>
                        </div>
                        <div class="tour_bucket">
                            <div class="tours">
                                <?php
                                while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
                                ?>
                                    <form class="form" action='deleteTourFromReservation.php' method="post">
                                        <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tuple[0] ?>>
                                        <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                                        <div class="tour">
                                            <div class="tour_all">
                                                <div class="tour_information">
                                                    <h1>
                                                        <?php echo $tuple[10] ?>
                                                    </h1>
                                                </div>
                                                <div class="tour_img">
                                                    <a href='./tourDetails.php?id=<?php echo $tuple[0] ?>'>
                                                        <img src='./img/<?php echo $tuple[9] ?>' />
                                                    </a>
                                                </div>
                                                <div class="number_of_tour">
                                                    <div class="price">
                                                        <div>
                                                            <h2>Price:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[11] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2>$<h2>
                                                        </div>
                                                    </div>
                                                    <div class="numberOf">
                                                        <div>
                                                            <h2><?php echo $tuple[4] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo "&nbsp" ?>customers<h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tour_button">
                                                <input class="input" type="submit" value="Cancel Reservation">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="activities">

                                        <?php
                                        $tour_id = $tuple[0];
                                        $query = "SELECT `A`.*,`TB`.* FROM `activity` AS `A` , `tour` AS `T` ,`reservation_tour_activity` AS `TB` 
                    WHERE `TB`.`tour_id` = `T`.`tour_id` AND `TB`.`activity_id` = `A`.`activity_id` AND user_id = $user_id AND `T`.`tour_id` = $tour_id";
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
                                            <form class="form" action='deleteActivityFromReservation.php' method="post">
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
                                                            <div class="price">
                                                                <div>
                                                                    Price:
                                                                </div>
                                                                <div>
                                                                    <?php echo $activity_tuple[4] ?>
                                                                </div>
                                                                <div>
                                                                    $
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="number_of_activity">
                                                        <div>
                                                            <p>Number of people:
                                                            <p>
                                                        </div>
                                                        <div>
                                                            <p><?php echo $activity_tuple[10] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="activity_button">
                                                        <input class="input" type="submit" value="Cancel Reservation">
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
                                <?php
                                while ($tuple = $tours_employee->fetch_array(MYSQLI_NUM)) {
                                ?>
                                    <form class="form" action='deleteTourFromReservation.php' method="post">
                                        <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tuple[0] ?>>
                                        <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                                        <div class="tour">
                                            <div class="tour_all">
                                                <div class="tour_information">
                                                    <h1>
                                                        <?php echo $tuple[9] ?>
                                                    </h1>
                                                </div>
                                                <div class="tour_img">
                                                    <a href='./tourDetails.php?id=<?php echo $tuple[0] ?>'>
                                                        <img src='./img/<?php echo $tuple[8] ?>' />
                                                    </a>
                                                </div>
                                                <div class="number_of_tour">
                                                    <div class="price">
                                                        <div>
                                                            <h2>Price:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[10] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2>$<h2>
                                                        </div>
                                                    </div>
                                                    <div class="numberOf">
                                                        <div>
                                                            <h2><?php echo $tuple[4] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo "&nbsp" ?>customers<h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tour_button">
                                                <input class="input" type="submit" value="Cancel Reservation">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="activities">

                                        <?php
                                        $tour_id = $tuple[0];
                                        $query = "SELECT `A`.*,`TB`.* FROM `activity` AS `A` , `tour` AS `T` ,`reservation_tour_activity` AS `TB` 
                    WHERE `TB`.`tour_id` = `T`.`tour_id` AND `TB`.`activity_id` = `A`.`activity_id` AND user_id = $user_id AND `T`.`tour_id` = $tour_id";
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
                                            <form class="form" action='deleteActivityFromReservation.php' method="post">
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
                                                            <div class="price">
                                                                <div>
                                                                    Price:
                                                                </div>
                                                                <div>
                                                                    <?php echo $activity_tuple[4] ?>
                                                                </div>
                                                                <div>
                                                                    $
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="number_of_activity">
                                                        <div>
                                                            <p>Number of people:
                                                            <p>
                                                        </div>
                                                        <div>
                                                            <p><?php echo $activity_tuple[10] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="activity_button">
                                                        <input class="input" type="submit" value="Cancel Reservation">
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
            </div>
            <div class="flights" style="background-color:#aaa;">
                <h2>Flight Tickets</h2>
                <?php
                if ($flight_empty) {
                ?>
                    <div class="hotel">
                        <h3>You have no Ticket</h3>
                    </div>
                    <?php
                } else {
                    while ($tuple = $flight_result->fetch_array(MYSQLI_NUM)) {
                    ?>
                        <form class="form" action='cancelTicket.php' method="post">
                            <div>
                                <input type="hidden" id="ticket_id" name="ticket_id" value=<?php echo $tuple[0] ?>>
                            </div>
                            <div class="hotel">
                                <div style="display: flex; align-items:center; justify-content:center;" class="hotel_img">
                                    <img style="width: 200px;" src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/PC.png?crop=false&width=108&height=92&fallback=default1.png&_v=e574f35253dcd377492e2002db829c55" alt="asd">
                                </div>
                                <div class="hotels">
                                    <div>
                                        <h3>
                                            <?php
                                            echo " Departure Date: ", $tuple[6];
                                            echo "<br></br>";
                                            echo " Departure City: ", $tuple[4];
                                            echo "<br></br>";
                                            echo " Arrival Date: ", $tuple[7];
                                            echo "<br></br>";
                                            echo " Arrival City: ", $tuple[5];
                                            echo "<br></br>";
                                            echo $tuple[3], " customers"; ?>
                                        </h3>
                                    </div>
                                </div>
                                <div>
                                    <?php if ($date < date_format(date_create($tuple[6]), 'Y/m/d')) { ?>
                                        <div class="hotel_button">
                                            <input class="input" type="submit" value="Cancel Reservation">
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>
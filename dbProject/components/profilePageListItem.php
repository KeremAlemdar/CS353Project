<?php
include("./connection/checkSession.php");
//$user_id = $_SESSION['user_id'];

$date = date("Y/m/d");
//USER
$query = "SELECT fname, email, phone_num FROM account WHERE user_id = " . 1 . "";
$result = $mysqli->query($query);
$user_info = $result->fetch_array(MYSQLI_NUM);

//HOTEL
$query = "SELECT * FROM reservation NATURAL JOIN customer_reserve NATURAL JOIN reservation_hotel NATURAL JOIN Hotel WHERE customer_id = 1 AND end_date > '$date'";
$hotel_id_result = $mysqli->query($query);
$employee_reserve = false;

// ??????
if ($hotel_id_result->num_rows == 0) {
    $query = "SELECT * FROM reservation NATURAL JOIN employee_reserve NATURAL JOIN reservation_hotel NATURAL JOIN Hotel WHERE customer_id = 1 AND end_date > '$date'";
    $hotel_id_result = $mysqli->query($query);
    if ($hotel_id_result->num_rows > 0){
        $employee_reserve = true;
    }
}

$hotel_exists = false;
if ($hotel_id_result->num_rows > 0) {
    $hotel_exists = true;
    
}

//TOUR
/*
$query = "SELECT tour_id, start_date, end_date, tour_information, image, tour_name, reservation_id FROM reservation NATURAL JOIN reservation_tour NATURAL JOIN customer_reserve WHERE customer_id = " . 1 . "";
$tour_id_result = $mysqli->query($query);

if ($tour_id_result->num_rows == 0) {
    $query = "SELECT tour_id, start_date, end_date, tour_information, image, tour_name, reservation_id FROM reservation NATURAL JOIN reservation_tour NATURAL JOIN employee_reserve WHERE customer_id = " . 1 . "";
    $tour_id_result = $mysqli->query($query);
}
$tour_exists = false;
if ($tour_id_result->num_rows > 0) {
    $tour_exists = true;
    $tour_id = $tour_id_result->fetch_array(MYSQLI_NUM);
    $query = "SELECT * from tour WHERE tour_id = " . $tour_id[0] . "";
    $tour_info = $mysqli->query($query);
}
*/
//FLIGHT

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

        
        
        .input, .edit, .past_reservations {
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
            <div class="profile_button">
                <div class="profile_button_inner">
                <a href="editInformationPage.php">
                        <input class="edit" type="submit" value="Edit User Information">
                    </a>
                </div>
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
                if (!$hotel_exists) {
                ?>
                    <div class="hotel">
                        <h3>You have no hotel reservations</h3>
                    </div>
                <?php
                }
                while ($hotel_exists && $tuple = $hotel_id_result->fetch_array(MYSQLI_NUM)) {
                ?>
                    <form class="form" action='deleteHotelReservation.php' method="post">
                        <div>
                            <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $tuple[1] ?>>
                        </div>
                        <div class="hotel">
                            <div class="hotel_img">
                                <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                                    <img src='./img/<?php echo $tuple[11] ?>' />
                                </a>
                            </div>
                            <div class="hotels">
                                <div>
                                    <h2>
                                        <?php echo $tuple[7], ",  ",  $tuple[8] ?>
                                    </h2>
                                </div>
                                <div>
                                    <h3>
                                        <?php
                                        echo " First day: ", $tuple[5];
                                        echo "<br></br>";
                                        echo " Last day: ", $tuple[6];
                                        echo "<br></br>";
                                        echo $tuple[4], " customers"; ?>
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
                
            </div>
            <div class="flights" style="background-color:#aaa;">
                <h2>Flight Reservations</h2>
                <p>Selectable rows</p>
            </div>
        </div>
    </div>

</body>

</html>
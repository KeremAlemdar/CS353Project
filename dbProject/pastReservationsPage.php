<?php
session_start();
include("./connection/checkSession.php");
include('./components/navbar.php');

//$user_id = $_SESSION['user_id'];

//USER
$query = "SELECT fname, email, phone_num FROM account WHERE user_id = " . 1 . "";
$result = $mysqli->query($query);
$user_info = $result->fetch_array(MYSQLI_NUM);

//HOTEL
$query = "SELECT hotel_id, start_date, end_date, amount_of_people, reservation_id FROM reservation NATURAL JOIN reservation_hotel NATURAL JOIN customer_reserve WHERE customer_id = " . 1 . "";
$hotel_id_result = $mysqli->query($query);

if ($hotel_id_result->num_rows == 0) {
    $query = "SELECT hotel_id, start_date, end_date, amount_of_people, reservation_id FROM reservation NATURAL JOIN reservation_hotel NATURAL JOIN employee_reserve WHERE customer_id = " . 1 . "";
    $hotel_id_result = $mysqli->query($query);
}
$hotel_exists = false;
if ($hotel_id_result->num_rows > 0) {
    $hotel_exists = true;
    $hotel_id = $hotel_id_result->fetch_array(MYSQLI_NUM);
    $query = "SELECT * from Hotel WHERE hotel_id = " . $hotel_id[0] . "";
    $hotel_info = $mysqli->query($query);
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
//GUIDE

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

        .input {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 10px 25px;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }
        
        .edit, .past_reservations {
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
                if (!$hotel_exists) {
                ?>
                    <div class="hotel">
                        <h3>You have no past hotel reservations</h3>
                    </div>
                <?php
                }
                while ($hotel_exists && $tuple = $hotel_info->fetch_array(MYSQLI_NUM)) {
                ?>
                    
                        <div>
                            <input type="hidden" id="reservation_id" name="reservation_id" value=<?php echo $hotel_id[4] ?>>
                        </div>
                        <div class="hotel">
                            <div class="hotel_img">
                                <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                                    <img src='./img/<?php echo $tuple[5] ?>' />
                                </a>
                            </div>
                            <div class="hotels">
                                <div>
                                    <h2>
                                        <?php echo $tuple[1], ",  ",  $tuple[2] ?>
                                    </h2>
                                </div>
                                <div>
                                    <h3>
                                        <?php
                                        echo " First day: ", $hotel_id[1];
                                        echo "<br></br>";
                                        echo " Last day: ", $hotel_id[2];
                                        echo "<br></br>";
                                        echo $hotel_id[3], " customers"; ?>
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
                
            </div>
            <div class="flights" style="background-color:#aaa;">
                <h2>Guides</h2>
                <p>Selectable rows</p>
            </div>
        </div>
    </div>

</body>

</html>
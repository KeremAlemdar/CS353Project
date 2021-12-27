<?php
include("./connection/checkSession.php");
//$user_id = $_SESSION['user_id'];
$query = "SELECT fname, email, phone_num FROM account WHERE user_id = " . 1 . "";
$result = $mysqli->query($query);
$query = "SELECT hotel_id FROM Reservation NATURAL JOIN reservation_hotelR NATURAL JOIN reserve WHERE user_id = " . 1 . "";
$hotel_id_result = $mysqli->query($query);
$hotel_id = $hotel_id_result->fetch_array(MYSQLI_NUM);
$query = "SELECT * from Hotel WHERE hotel_id = " . $hotel_id[0] . "";
$hotel_info = $mysqli->query($query);
?>




<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            box-sizing: border-box;
        }
        .user_detail_row {
            display: table;
            width: 100%;
            /* height: 200px;*/
            border: solid;
            border-color: black;
        }
        .user_details {
            position: left;
        }

        .reservations{
            display: flex;
            flex-direction: row;
            justify-content: center;
            border: 3px solid black;
        }
        .hotels {
            width: 50%;
        }

        .tours {
            width: 50%;
        }


        img {
            width: 100%;
            height: 100%;
        }


        .hotel {
            border: 2px solid black;
            width: 100%;
            display: flex;
            height: auto; /* 40% dı, 2 liyken kücülmeyi çözmek için auto yaptım*/
        }

        .hotel .img {
            width: 40%;
        }

        .hotel .information {
            margin-left: 2.5%;
            margin-right: 2.5%;
            width: 40%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .hotel .button_part {
            width: 10%;            
            display: flex;
            align-items: center;
        }
        .hotel .submit_button {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 10px 25px;
            display: flex;
            align-items: center;

        }
    </style>
</head>



<body>
    <div class="user_detail_row">
        <div class="user_details">
            <?php
            $user_info = $result->fetch_array(MYSQLI_NUM);
            ?>
            <div class="user_info">
                <h4>
                    <?php echo "Name: ", $user_info[0] ?>
                </h4>
                <h4>
                    <?php echo "e-mail: ", $user_info[1] ?>
                </h4>
                <h4>
                    <?php echo "Phone: ", $user_info[2] ?>
                </h4>
                <button> Edit User Information </button>
            </div>

        </div>
    </div>
    <div class="reservations">
        <div class="hotels" style="background-color:#aaa;">
            <h2>Hotel Reservations</h2>
            <?php
            while ($tuple = $hotel_info->fetch_array(MYSQLI_NUM)) {
                # Tour(tour_id, start_date, end_date, tour_information, image)
            ?>
                <div class="hotel">
                    <div class="img">
                        <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                            <img src='./img/<?php echo $tuple[5] ?>' />
                        </a>
                    </div>
                    <div class="information">
                        <h2>
                            <?php echo $tuple[1], "  ",  $tuple[2] ?>
                        </h2>
                        <h3>
                            <?php echo $tuple[3], " STAR HOTEL " ?>
                        </h3>

                    </div>
                    <div class="button_part">
                        <input class="submit_button" type="submit" value="Cancel Reservation">
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="tours" style="background-color:#bbb;">

            <h2>Tour Reservations</h2>
            <p>Selectable rows</p>
        </div>
    </div>
</body>

</html>


<!-- <div class="all">
        <div class="tours">
            <?php
            while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
                # Tour(tour_id, start_date, end_date, tour_information, image)
            ?>
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
            }
            ?>
        </div>
    </div>  -->
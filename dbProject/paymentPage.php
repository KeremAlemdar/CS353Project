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

$total_tour_cost = 0;
$total_flights_cost = 0;
$total_hotel_cost = 0;
$user_id = 1; // FOR TEST PURPOSES
// $query = "select * from ((tour natural join tour_bucket) natural join activity) where user_id =" . $user_id . "";
$query = "SELECT DISTINCT * FROM `hotel` LEFT JOIN `hotel_bucket` ON `hotel_bucket`.`hotel_id` = `hotel`.`hotel_id` WHERE `user_id`= 1";
$hotels = $mysqli->query($query);
$hotel_empty = false;
if ($hotels->num_rows == 0) {
    $hotel_empty = true;
}

$query = "SELECT DISTINCT * FROM `tour` LEFT JOIN `tour_bucket` ON `tour_bucket`.`tour_id` = `tour`.`tour_id` WHERE `user_id`= 1";
$tours = $mysqli->query($query);
$empty = false;
if ($tours->num_rows == 0) {
    $empty = true;
}

$query = "SELECT DISTINCT * FROM `flight` LEFT JOIN `flight_bucket` ON `flight_bucket`.`flight_id` = `flight`.`flight_id` WHERE `user_id`= 1";
$flights = $mysqli->query($query);
$flights_empty = false;
if ($flights->num_rows == 0) {
    $flights_empty = true;
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

        .number_of_hotel {
            display: flex;
            flex-direction: column;
        }

        .number_of_hotel .numberOf {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .number_of_hotel .price {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        /* HOTEL CSS */
        .hotel_bucket {
            border: 1px solid black;
        }

        .hotel {
            margin: 2.5%;
            display: flex;
            flex-direction: row;
            border: 1.5px solid black;
        }

        .hotel_all {
            display: flex;
            flex-direction: column;
        }

        .hotel_all .hotel_img {
            width: 100%;
            height: 100%;
        }

        .hotel_all .hotel_img img {
            width: 100%;
            height: 100%;
        }

        .hotel_all .hotel_information {
            display: flex;
            flex-direction: row;
        }

        .hotel .hotel_button {
            display: flex;
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
            margin-left: 1%;
        }

        /* PLANE CSS */
        .plane_bucket {
            width: 33%;
        }

        .number_of_tour {
            display: flex;
            flex-direction: column;
        }

        .number_of_tour .numberOf {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .number_of_tour .price {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        price .number_of_tour .input {
            margin-left: 5%;
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .payment {
            display: flex;
            flex-direction: column;
        }

        .payment input {
            padding: 20px;
            width: 80%;
        }

        .payment div {
            margin: 1%;
        }

        .payment button {
            width: 15%;
            padding: 20px;
        }

        .all_model {
            display: flex;
            justify-content: center;
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
                    <?php
                    if ($hotel_empty) {
                    ?>
                        <div class="hotel_bucket_header">
                            <h1>Your hotel bucket is empty</h1>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="hotel_bucket_header">
                            <h1>Hotels in your bucket</h1>
                        </div>
                        <div class="hotel_bucket">
                            <div class="hotels">
                                <?php
                                while ($tuple = $hotels->fetch_array(MYSQLI_NUM)) {
                                    $total_hotel_cost = $total_hotel_cost + $tuple[6] * $tuple[8];
                                ?>
                                    <form class="form" action='deleteHotelFromBucket.php' method="post">
                                        <input type="hidden" id="hotel_id" name="hotel_id" value=<?php echo $tuple[0] ?>>
                                        <div class="hotel">
                                            <div class="hotel_all">
                                                <div class="hotel_information">
                                                    <h1>
                                                        <?php echo $tuple[1] ?>
                                                    </h1>
                                                </div>
                                                <div class="hotel_img">
                                                    <a href='./hotelDetails.php?id=<?php echo $tuple[0] ?>'>
                                                        <img src='./img/<?php echo $tuple[5] ?>' />
                                                    </a>
                                                </div>
                                                <div class="number_of_hotel">
                                                    <div class="price">
                                                        <div>
                                                            <h2>Price:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[6] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2>$<h2>
                                                        </div>
                                                    </div>
                                                    <div class="numberOf">
                                                        <div>
                                                            <h2>Number of people:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[8] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hotel_button">
                                                <input class="input" type="submit" value="Remove">
                                            </div>
                                        </div>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
                                    $total_tour_cost = $total_tour_cost + $tuple[6] * $tuple[9];
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
                                                <div class="number_of_tour">
                                                    <div class="price">
                                                        <div>
                                                            <h2>Price:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[6] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2>$<h2>
                                                        </div>
                                                    </div>
                                                    <div class="numberOf">
                                                        <div>
                                                            <h2>Number of people:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[9] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tour_button">
                                                <input class="input" type="submit" value="Remove">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="activities">

                                        <?php
                                        $query = "SELECT `A`.*,`TB`.* FROM `activity` AS `A` , `tour` AS `T` ,`tour_activity_bucket` AS `TB` 
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
                                            $total_tour_cost = $total_tour_cost + ($activity_tuple[10] * $activity_tuple[4]);
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
                                                    <div class="number_of_tour">
                                                        <div>
                                                            <p>Number of people:
                                                            <p>
                                                        </div>
                                                        <div>
                                                            <p><?php echo $activity_tuple[10] ?></p>
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
                    <?php
                    if ($flights_empty) {
                    ?>
                        <div class="hotel_bucket_header">
                            <h1>Your flights bucket is empty</h1>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="hotel_bucket_header">
                            <h1>Flights in your bucket</h1>
                        </div>
                        <div class="hotel_bucket">
                            <div class="hotels">
                                <?php
                                while ($tuple = $flights->fetch_array(MYSQLI_NUM)) {
                                    $total_flights_cost = $total_flights_cost + $tuple[5] * $tuple[8];
                                ?>
                                    <form class="form" action='deleteFlightBucket.php' method="post">
                                        <input type="hidden" id="flight_id" name="flight_id" value=<?php echo $tuple[0] ?>>
                                        <div class="hotel">
                                            <div class="hotel_all">
                                                <div class="hotel_information">
                                                    <h1>
                                                        <?php echo $tuple[1] ?>
                                                    </h1>
                                                </div>
                                                <div class="hotel_img">
                                                    <img style="width: 50px;" src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/PC.png?crop=false&width=108&height=92&fallback=default1.png&_v=e574f35253dcd377492e2002db829c55" alt="asd">
                                                    </a>
                                                </div>
                                                <div class="number_of_hotel">
                                                    <div class="price">
                                                        <div>
                                                            <h2>Price:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[5] ?></h2>
                                                        </div>
                                                        <div>
                                                            <h2>$<h2>
                                                        </div>
                                                    </div>
                                                    <div class="numberOf">
                                                        <div>
                                                            <h2>Number of people:<h2>
                                                        </div>
                                                        <div>
                                                            <h2><?php echo $tuple[8] ?></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hotel_button">
                                                <input class="input" type="submit" value="Remove">
                                            </div>
                                        </div>
                                    </form>
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
            <div class="payment">
                <h1>Payment</h1>
                <button id="myBtn">Make Payment</button>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <form class="form" action='payAllBucket.php' method="post">

                        <div class="all_model">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="payment">
                                    <div>
                                        <input type="text" placeholder="Card Number"></input>
                                    </div>
                                    <div>
                                        <input type="text" placeholder="Expire Date"></input>
                                    </div>
                                    <div>
                                        <input type="text" placeholder="CVC"></input>
                                    </div>
                                    <div>
                                        <h1>Subtotal: <?php echo $total_hotel_cost + $total_flights_cost + $total_tour_cost ?></h1>
                                    </div>
                                    <div>
                                        <input type="submit" value="Pay"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
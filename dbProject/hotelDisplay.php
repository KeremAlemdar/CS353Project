<?php
include("./connection/checkSession.php");
include("./components/navbar.php");

$hotel_id = $_GET["id"];
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date =  isset($_GET['end_date']) ? $_GET['end_date'] : null;

$query = "select * from Hotel where hotel_id=$hotel_id";
$result = $mysqli->query($query);
$hotel = $result->fetch_array(MYSQLI_NUM);
$query = "select * from hotel_evaluation where hotel_id=$hotel_id";
$evaluation = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .all_page {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hotel_name {
            display: flex;
            flex-direction: column;
            border: solid;
            border-color: black;
            width: 50%;
            text-align: center;

        }

        .hotel_img {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
        }

        .hotel_comments {
            border: solid;
            border-color: black;
            text-align: center;
            width: 50%;
            height: auto;
        }

        .hotel_comments .comments {
            margin: 3px;
            border: solid;
            border-color: black;
            display: flex;

        }

        .star {
            width: 100%;
            display: flex;
            justify-content: left;
        }

        .comment {
            display: flex;
            justify-content: left;
        }

        .form .submit_button {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 10px 25px;
            display: flex;
            align-items: center;
            margin-right: 10%;
        }

        .form {
            display: flex;
        }
    </style>
    <title> <?php echo $hotel[1] ?></title>
</head>

<body>
    <div class="all_page">
        <form class="form" action='addHotelBucket.php' method='post'>
            <div class="numberOfGuest">
                <input type="number" id="numberOfGuest" name="numberOfGuest" placeholder="Number of guest" value="1">
            </div>
            <div>
                <?php if ($start_date == null || $end_date == null) { ?>
                    <input type="hidden" id="hotel_id" name="hotel_id" value=<?php echo $hotel_id ?>>
                    <input type='date' placeholder="Start Date" id="start_date" name='start_date'>
                    <input type='date' placeholder="End Date" id="end_date" name='end_date'>
                <?php } else { ?>            
                    <input type="hidden" id="start_date" name="start_date" value=<?php echo $start_date ?>>
                    <input type="hidden" id="end_date" name="end_date" value=<?php echo $end_date ?>>
                <?php } ?>
            </div>
            <div>
                <input class="submit_button" type="submit" value="Add to bucket">
            </div>
            <br><br>

        </form>
        <div class="hotel_name">
            <h1>
                <?php echo $hotel[1] ?>
            </h1>
            <h1>
                <?php if ($hotel[7] == 0) {
                    echo  " NO HOTEL RATE ";
                } else {
                    echo  "HOTEL RATE ", $hotel[8] / $hotel[7], "STARS ";
                } ?>
            </h1>
            <h1>
                <?php echo $hotel[3], " STAR HOTEL " ?>
            </h1>

            <h2>
                <?php echo $hotel[6], " $ per person per night" ?>
            </h2>

            <div class="hotel_img">
                <img src='./img/<?php echo $hotel[5] ?>' />
            </div>
            <div>
                <h3>
                    <?php echo $hotel[4] ?>
                </h3>
            </div>
        </div>
        <div class="hotel_comments">
            <h1>Comments and Rates</h1>
            <?php
            while ($tuple = $evaluation->fetch_array(MYSQLI_NUM)) {
            ?>
                <div class="comments">
                    <div>
                        <div class="star">
                            <?php
                            $counter = 0;
                            while ($counter != $tuple[3]) {
                            ?>
                                <i class="fa fa-star fa-2x" data-index=$counter style="color: yellow;"></i>

                            <?php
                                $counter = $counter + 1;
                            }
                            ?>
                        </div>
                        <div class="comment">
                            <h3>
                                <?php echo $tuple[4] ?>
                            </h3>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
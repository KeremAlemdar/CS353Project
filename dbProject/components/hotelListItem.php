<?php
$date = date("Y/m/d");
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date =  isset($_GET['end_date']) ? $_GET['end_date'] : null;
$searchKey =  isset($_GET['searchKey']) ? $_GET['searchKey'] : "";
$rate =  isset($_GET['rate']) ? $_GET['rate'] : "";

$query = "";
if (empty($rate)) {
    $query = "select * from Hotel where name LIKE '%" . $searchKey . "%' or details LIKE '%" . $searchKey . "%' or city LIKE '%" . $searchKey . "%'";
} else {
    $query = "select * from Hotel where star >= $rate AND name LIKE '%" . $searchKey . "%' or details LIKE '%" . $searchKey . "%' or city LIKE '%" . $searchKey . "%'";
}
$result = $mysqli->query($query);

?>
<!DOCTYPE html>
<html>

<head>
    <style>
        .all {
            display: flex;
            justify-content: center;
        }

        .tours {
            width: 80%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            flex-direction: column;
        }

        .tours>* {
            margin-left: auto;
            margin-right: auto;
            margin-top: 2.5%;
        }

        .tour {
            border: 2px solid black;
            display: flex;
            width: 80%;
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
    </style>
</head>

<body>
    <div class="all">
        <div class="tours">
            <?php
            while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
                # Tour(tour_id, start_date, end_date, tour_information, image)
            ?>
                <div class="tour">
                    <div class="img">
                        <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>&start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>'>
                            <img src='./img/<?php echo $tuple[5] ?>' />
                        </a>
                    </div>
                    <div class="information">
                        <h1>
                            <?php echo $tuple[1] ?>
                        </h1>

                        <h1>
                            <?php echo $tuple[2] ?>
                        </h1>
                        <h1>
                            <?php if ($tuple[7] == 0) {
                                echo  " NO HOTEL RATE ";
                            } else {
                                echo  "HOTEL RATE ", $tuple[8] / $tuple[7], "STARS ";
                            } ?>
                        </h1>

                        <h1>
                            <?php echo $tuple[6], " $ per person and per night" ?>
                        </h1>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
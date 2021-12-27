<?php

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : "";
$end_date =  isset($_POST['end_date']) ? $_POST['end_date'] : "";
$searchKey =  isset($_POST['searchKey']) ? $_POST['searchKey'] : "";
$query = "";
if (empty($start_date) && empty($end_date)) {
    if (empty($searchKey)) {
        $query = "select * from Hotel";
    } else {
        $query = "select * from Hotel where name LIKE '%" . $searchKey . "%'";
    }
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
                        <a href='./hotelDisplay.php?id=<?php echo $tuple[0] ?>'>
                            <img src='./img/tour1.jpg' />
                        </a>
                    </div>
                    <div class="information">
                        <h1>
                            <?php echo $tuple[1] ?>
                        </h1>
                        <h1>
                            <?php echo $tuple[2] ?>
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
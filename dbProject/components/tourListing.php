<?php

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : "";
$end_date =  isset($_POST['end_date']) ? $_POST['end_date'] : "";
$searchKey =  isset($_POST['searchKey']) ? $_POST['searchKey'] : "";
// if(empty($start_date) && empty($end_date) && empty($searchKey)) {
//     echo 'values  null';
// }
// else {
//     echo $start_date;
//     echo $end_date;
//     echo $searchKey;
// }
if (empty($start_date) && empty($end_date)) {
    if (empty($searchKey)) {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city";

        // $query = "select * from tour natural join tour_city natural join city";
    } else {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where
        (tour_information LIKE '%" .$searchKey."%' or tour_name LIKE '%" .$searchKey."%' or city_name LIKE '%" .$searchKey."%')";

        // $query = "select * from tour where tour_information LIKE '%" . $searchKey . "%' or tour_name LIKE '%" .$searchKey . "%' or city_name LIKE '%" .$searchKey . "%'";
    }
} else if (empty($start_date)) {
    if (empty($searchKey)) {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where tour.end_date <= '".$end_date."'";

    //     $query = "select * from tour natural join tour_city natural join city where
    // tour.end_date <= '" . $end_date . "'";
    } else {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where tour.end_date <= '".$end_date."' and
        (tour_information LIKE '%" .$searchKey."%' or tour_name LIKE '%" .$searchKey."%' or city_name LIKE '%" .$searchKey."%')";

    //     $query = "select * from tour natural join tour_city natural join city where tour_information LIKE '%" . $searchKey . "%' or tour_name LIKE '%" .$searchKey . "%' or city_name LIKE '%" .$searchKey . "%'
    // and tour.end_date <= '" . $end_date . "'";
    }
} else if (empty($end_date)) {
    if (empty($searchKey)) {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where tour.start_date >= '".$start_date."'";

    //     $query = "select * from tour natural join tour_city natural join city where
    // tour.start_date >= '" . $start_date . "'";
    } else {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where tour.start_date >= '".$start_date."' and
        (tour_information LIKE '%" .$searchKey."%' or tour_name LIKE '%" .$searchKey."%' or city_name LIKE '%" .$searchKey."%')";

    //     $query = "select * from tour natural join tour_city natural join city where tour_information LIKE '%" . $searchKey . "%' or tour_name LIKE '%" .$searchKey . "%' or city_name LIKE '%" .$searchKey . "%'
    // and tour.start_date >= '" . $start_date . "'";
    }
} else {
    if (empty($searchKey)) {
    //     $query = "select * from tour natural join tour_city natural join city where
    // tour.start_date >= '" . $start_date . "' and tour.end_date <= '" . $end_date . "'";
    $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where tour.start_date >= '".$start_date."' and tour.end_date <= '".$end_date."'";
    } else {
        $query = "select DISTINCT(tour_id),start_date,end_date,tour_information,image,tour_name from tour natural join tour_city natural join city 
        where tour.start_date >= '".$start_date."' and tour.end_date <= '".$end_date."' and
        (tour_information LIKE '%" .$searchKey."%' or tour_name LIKE '%" .$searchKey."%' or city_name LIKE '%" .$searchKey."%')";

    //     $query = "select * from tour natural join tour_city natural join city where tour_information LIKE '%" . $searchKey . "%' or tour_name LIKE '%" .$searchKey . "%' or city_name LIKE '%" .$searchKey . "%'
    // and tour.start_date >= '" . $start_date . "' and tour.end_date <= '" . $end_date . "'";
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
        }

        .tours>* {
            flex: 40%;
            /* increase number of items in a row */
            margin-left: 2.5%;
            margin-right: 2.5%;
            margin-top: 2.5%;
        }

        .tour {
            border: 2px solid black;
            display: flex;
            width: 40%;
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

        .dates {
            display: flex;
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
                        <div clasS="dates">
                            <div>
                                <h1>
                                    <?php echo $tuple[1] ?>
                                </h1>
                            </div>
                            <div>
                                <h1>
                                    <?php echo "&nbsp - &nbsp" ?>
                                </h1>
                            </div>
                            <div>
                                <h1>
                                    <?php echo $tuple[2] ?>
                                </h1>
                            </div>

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
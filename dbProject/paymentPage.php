<?php
include("./components/navbar.php");
include("./connection/checkSession.php");
$user_id =  isset($_GET['user_id']) ? $_GET['user_id'] : "";


$user_id = 1; // FOR TEST PURPOSES
$query = "select * from tour natural join tour_bucket where user_id =" . $user_id . "";
echo $query;
$tours = $mysqli->query($query);
$tours2= $tours;
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .all {
            width: 70%;
            display: flex;
            justify-content: center;
        }

        .tours {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .tours>* {
            flex: 40%;
            /* increase number of items in a row */
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
        .decline {
            width: 60%;
            display: flex;
            justify-content: space-between;

        }
        .delete {
            width: 20%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="decline">
        <div class="all">
            <div class="tours">
                <?php
                while ($tuple = $tours->fetch_array(MYSQLI_NUM)) {
                    # TourBucket(tour_id, start_date, end_date, tour_information, 
                    # image, tour_name, user_id)
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
        </div>
        <div class="delete">
            <div><Button class="fa fa-times">&nbsp &nbspDELETE</Button></div>
        </div>
    </div>
</body>

</html>
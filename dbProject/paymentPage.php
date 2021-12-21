<?php
include("./components/navbar.php");
include("./connection/checkSession.php");
$user_id =  isset($_GET['user_id']) ? $_GET['user_id'] : "";


$user_id = 1; // FOR TEST PURPOSES
$query = "select * from tour natural join bucket where user_id =". $user_id ."";
echo $query;
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
            flex: 40%; /* increase number of items in a row */
            margin-left: 2.5%;
            margin-right: 2.5%;
            margin-top: 2.5%;
        }

        .tour {
            border: 2px solid black;
            display: flex;
            width: 40%;
            height: auto; /* 40% dı, 2 liyken kücülmeyi çözmek için auto yaptım*/
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
</body>

</html>
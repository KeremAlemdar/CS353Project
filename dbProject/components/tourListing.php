<?php
$query = "select * from tour";
$result = $mysqli->query($query);

$vacations = array(["Tour Name", "Tour Details", "https://mediap.flypgs.com/awh/1448/724//files/Ekstrem_Sporlar/snowboard-nasil-yapilir.jpg"], ["Tour Name", "Tour Details", "https://img-s3.onedio.com/id-57b3130021be6020752eb878/rev-0/w-620/f-jpg/s-9e53ab9b71056fa5e92f995123cfe53dee70e0a2.jpg"], ["Tour Name", "Tour Details", "https://mediap.flypgs.com/awh/1448/724//files/Ekstrem_Sporlar/snowboard-nasil-yapilir.jpg"], ["Tour Name", "Tour Details", "https://img-s3.onedio.com/id-57b3130021be6020752eb878/rev-0/w-620/f-jpg/s-9e53ab9b71056fa5e92f995123cfe53dee70e0a2.jpg"]);
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
            height: 40%;
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
<?php
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
            width: 65%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;

        }

        .tours>* {
            flex: 40%;
        }

        .tour {
            margin-top: 2.5%;
            margin-left: 2.5%;
            margin-right: 2.5%;
            border: 2px solid black;
            display: flex;
        }

        img {
            width: 400px;
            height: 300px;
        }
    </style>
</head>

<body>
    <div class="all">
        <div class="tours">
            <?php
            for ($vacation = 0; $vacation < 4; $vacation++) {
            ?>
                <div class="tour">
                    <div>
                        <a href='./index.php?vacationName=asd'>
                            <img src='<?php echo $vacations[$vacation][2] ?>' />
                        </a>
                    </div>
                    <div>
                        <h1>
                            <?php echo $vacations[$vacation][0] ?>
                            <?php echo $vacations[$vacation][1] ?>
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
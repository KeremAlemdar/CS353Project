<?php
include("./connection/checkSession.php");
include("./components/navbarHotel.php");

$hotel_id = $_GET["id"];
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
    
        .hotel_comments .comments{
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
    </style>
    <title> <?php echo $hotel[1] ?></title>
</head>

<body>
    <div class="all_page">
        <div class="hotel_name" >
            <h1><?php echo $hotel[1] ?></h1>
            <h1><?php echo $hotel[3], " STAR HOTEL " ?></h1>
            <div class="hotel_img">
                <img src='./img/<?php echo $hotel[5] ?>' />
            </div>
            <div> <h3><?php echo $hotel[4] ?></h3></div>
        </div>
        <div class="hotel_comments" >
            <h1>Comments and Rates</h1>
            <?php
                while ($tuple = $evaluation->fetch_array(MYSQLI_NUM)) {
            ?>
            <div class="comments">
            <div>
                <div class="star">
                    <?php 
                        $counter = 0;
                        while($counter != $tuple[3]){
                    ?>
                            <i class="fa fa-star fa-2x" data-index=$counter style="color: yellow;"></i>
                            
                    <?php
                        $counter = $counter + 1;
                        }
                    ?>
                </div>
                <div class="comment"><h3><?php echo $tuple[4] ?></h3></div>
                
            </div>
            </div>
            
            <?php
                }
                ?>
        </div>





    </div>
</body>

</html>
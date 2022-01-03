<?php
include("../connection/checkSession.php");
include("guide_navbar.php");
$guide_id = $_SESSION['user_id'];

$tour_id = $_GET["id"];
//$tour_id = 1;
$query = "select image, tour_name from tour where tour_id=$tour_id";
$result = $mysqli->query($query);
$tour = $result->fetch_array(MYSQLI_NUM);
$tour_name = $tour[1];
$tour_image = $tour[0];

$page_url   = 'http';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $page_url .= 's';
}
$current = $page_url . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$rateId =  isset($_GET['rate']) ? $_GET['rate'] : "empty";
$firstTime = true;
if ($rateId !== "empty") {
    $firstTime = false;
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .all_page {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .evaluated_tour {
            display: flex;
            flex-direction: column;
            border: solid;
            border-color: black;
            width: 50%;
            text-align: center;
        }

        .submit_button {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            position: "center";
            padding: 10px 25px;

        }

        .submit_button:active {
            transform: translateY(2px);
        }
        .tour_img {
        }
        .tour_img img {
            width: 100%;
            height: 100%;
        }
    </style>
    <title> <?php echo $tour[1], " Evaluation" ?></title>
</head>

<body style="text-align:center; margin: 0px;">
    <div class="all_page">
        <div class="evaluated_tour">
            <h1><?php echo $tour_name ?></h1>
            <div class="tour_img">
                <img src='../img/<?php echo $tour_image ?>' />
            </div>

        </div>
        <br>
        <div class="evaluation">
            <form class="form" action='declineTourInvitation.php' method="post">
                <input type="hidden" id="current" name="current" value=<?php echo $current ?>>
                <input type="hidden" id="tour_id" name="tour_id" value=<?php echo $tour_id ?>>
                <br>
                <div>
                    <h1>State the reason why you've declined</h1>
                </div>
                <div align-items="center" style="background: #aaa; padding: 10px;">
                    <textarea name="review" rows="5" cols="120">
                </textarea>
                </div>
                <input class="submit_button" type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>
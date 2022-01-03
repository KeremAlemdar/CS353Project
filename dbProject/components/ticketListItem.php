<?php

if(isset($_GET['updated'])){
    echo '<script language="javascript">';
    echo 'alert("Bucket Updated")';
    echo '</script>';
    header("Location: ticketListPage.php");
}
if(isset($_GET['bought'])){
    echo '<script language="javascript">';
    echo 'alert("Flight Added")';
    echo '</script>';
    // header("Location: ticketListPage.php");
}

if (isset($_POST['flightId'])) {
    $flightID = $_POST['flightId'];
    $numOfPeople = $_POST['numOfPeople'];
    $query = "select * from flight_bucket where user_id = 1 and flight_id = '$flightID'";
    $check = $mysqli->query($query);
    if($check->num_rows == 1){
        $query = "update flight_bucket set count='$numOfPeople' where user_id = 1 and flight_id = '$flightID'";
        $mysqli->query($query);
        header("Location: ticketListPage.php?updated=true");
    } else {
        $query = "insert into flight_bucket values(1, '$flightID','$numOfPeople')";
        $asd = $mysqli->query($query);
        header("Location: ticketListPage.php?bought=true");
    }
}

if (empty($_POST['departureCity']) && empty($_POST['departureDate']) && empty($_POST['arrivalCity'])) {
} else if (empty($_POST['departureCity'])) {
    echo '<script language="javascript">';
    echo 'alert("Chose Departure City")';
    echo '</script>';
} else if (empty($_POST['departureDate'])) {
    echo '<script language="javascript">';
    echo 'alert("Chose Departure Time ")';
    echo '</script>';
} else if (empty($_POST['arrivalCity'])) {
    echo '<script language="javascript">';
    echo 'alert("Chose Ariival City")';
    echo '</script>';
} else {
    $arrivalCity = $_POST['arrivalCity'];
    $departureDate = $_POST['departureDate'];
    $departureCity = $_POST['departureCity'];
    $query = "select airport_id from Airport where city='$departureCity'";
    $result = $mysqli->query($query);
    $departureId = $result->fetch_array();

    $query = "select airport_id from Airport where city='$arrivalCity'";
    $result = $mysqli->query($query);
    $arrivalId = $result->fetch_array();

    $departureId =  $departureId[0];
    $arrivalId = $arrivalId[0];
    $query = "select * from Flight where cast(`departure_time` as DATE) = cast('$departureDate' as DATE) and departure_airport='$departureId' and arrival_airport='$arrivalId'";

    $result = $mysqli->query($query);
}

?>

<!DOCTYPE html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .outer-div {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ticketsContainer {
        width: 1300px;
        height: 200px;
        text-align: center;
    }

    .ticketItem {
        border-radius: 5px;
        border-width: 2px;
        border: solid;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
        margin-bottom: 40px;
    }

    .informations {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 80%;
        border-right: solid;
        border-width: 1px;
    }

    .departure {
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-items: center;
        height: 50%;
        width: 80%;
        margin: auto;
    }

    .arrival {
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-items: center;
        height: 50%;
        width: 80%;
        margin: auto;
    }

    .price {
        height: 100%;
        width: 20%;
        text-align: center;
        display: flex;
        align-items: flex-end;
    }
</style>
</head>
</style>

<div class="outer-div">
    <div class="ticketsContainer">
        <?php
        if (empty($result)) {
            echo '<h1> Select Date and Cities </h1>';
        } else if($result->num_rows == 0) {
            echo '<h1> Flight Not Found </h1>';
        } else {
            while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
        ?>
                <div class="ticketItem">
                    <div class="informations">
                        <div class="departure">
                            <img src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/PC.png?crop=false&width=108&height=92&fallback=default1.png&_v=e574f35253dcd377492e2002db829c55" alt="asd">
                            <div style="display: flex; flex-direction:row;">
                                <h3><?php echo date_format(date_create($tuple[1]), 'H:i') ?> <br /> <?php echo $_POST['departureCity'] ?></h3>
                                <span style="margin:auto">------------------------</span>
                                <h3><?php echo date_format(date_create($tuple[2]), 'H:i') ?> <br /> <?php echo $_POST['arrivalCity'] ?></h3>
                            </div>
                            <h2><?php $interval = date_create($tuple[2])->diff(date_create($tuple[1]));
                                echo  "" . $interval->h . "H"; ?></h2>
                        </div>
                    </div>
                    <div class="price">
                        <div style="margin-left: auto; margin-right: auto; margin-bottom:30px">
                            <h1>$<?php echo $tuple[5] ?></h1>
                            <h3> Enter number of people</h3>
                            <form action="ticketListPage.php" method="post">
                                <input type="text" name="numOfPeople" id="numOfPeople">
                                <input type="hidden" name="flightId" value="<?php echo $tuple[0] ?>">
                                <input style="margin-top: 2%;" type="submit" value="Add To Bucket">
                            </form>
                        </div>

                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>

</html>
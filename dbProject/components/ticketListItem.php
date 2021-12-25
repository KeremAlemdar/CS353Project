<?php

$departureDate = isset($_POST['departureDate']) ? $_POST['departureDate'] : "";
$departureCity =  isset($_POST['departureCity']) ? $_POST['departureCity'] : "";
$arrivalCity =  isset($_POST['arrivalCity']) ? $_POST['arrivalCity'] : "";

if (empty($departureCity)) {
    echo "alert('Chose Departure City ')";
} else if (empty($departureDate)) {
    echo "alert('Chose Departure Time ')";
} else if (empty($arrivalCity)) {
    echo "alert('Chose Ariival City ')";
} else {
    $query = "select airport_id from Airport where city='Ankara'";
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
echo 'asbd';
$departureDate = "";
$departureCity =  "";
$arrivalCity = "";
?>

<!DOCTYPE html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .ticketsContainer {
        width: 1300px;
        height: 200px;
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

<div class="ticketsContainer">
    <?php
    if (empty($result)) {
        echo '<h1> Select </h1>';
    } else {
        while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
    ?>
            <div class="ticketItem">
                <div class="informations">
                    <div class="departure">
                        <img src="https://content.r9cdn.net/rimg/provider-logos/airlines/v/PC.png?crop=false&width=108&height=92&fallback=default1.png&_v=e574f35253dcd377492e2002db829c55" alt="asd">
                        <div style="display: flex; flex-direction:row;">
                            <h3>13:30 <br /> ESB</h3>
                            <span style="margin:auto">------------------------</span>
                            <h3>13:30 <br /> ESB</h3>
                        </div>
                        <h2>1:30 Hour</h2>
                    </div>
                </div>
                <div class="price">
                    <div style="margin-left: auto; margin-right: auto; margin-bottom:30px">
                        <h1>120 dolar işareti</h1>
                        <button> BUY </button>
                    </div>

                </div>
            </div>
    <?php }
    } ?>
</div>

</html>
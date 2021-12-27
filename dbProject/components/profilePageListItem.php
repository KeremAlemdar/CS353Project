<?php
$user_id = $_SESSION['user_id'];
$query = "select fname, email, phone_num from account where user_id = " . $user_id . "";
?>

<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            box-sizing: border-box;
        }

        .user_detail_row {
            display: table;
            width: 100%;
            /* height: 200px;*/
            border: solid;
            border-color: black;
        }

        .col {
            float: left;
            width: 50%;
        }

        .user_details {
            position: left;
        }

        .row:after {
            display: table;
        }
    </style>
</head>



<body>
    <div class="user_detail_row">
        <div class="user_details">
            <?php
            while ($information = $result->fetch_array(MYSQLI_NUM)) {
            ?>
            <div class="user_info">
                <h4>
                    <?php echo "Name: " + $information[0] ?>
                </h4>
                <h4>
                    <?php echo "e-mail: " + $information[1] ?>
                </h4>
                <h4>
                    <?php echo "Phone: " + $information[2] ?>
                </h4>
            </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col" style="background-color:#aaa;">
            <h2>Hotel Reservations</h2>
            <p>Selectable rows</p>
        </div>
        <div class="col" style="background-color:#bbb;">
            <h2>Tour Reservations</h2>
            <p>Selectable rows</p>
        </div>
    </div>
</body>

</html>
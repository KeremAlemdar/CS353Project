<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tours</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
    /* Add a black background color to the top navigation */
    .topnav {
      background-color: #435d7d;
      overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
      background-color: #04AA6D;
      color: white;
    }
  </style>
  <link rel="stylesheet" href="./crud.css">
  <?php

  include("../connection/checkSession.php");
  $query = "SELECT SUM(price * amount_of_people) AS sumtot FROM hotel NATURAL JOIN reservation_hotel 
  WHERE hotel_id IN (SELECT hotel_id FROM `reservation_hotel` WHERE `start_date` BETWEEN '2018-01-01' AND '2022-01-02' 
  AND MONTH(`start_date`) NOT BETWEEN 3 AND 11) AND city = 'Ankara'";
  $result = $mysqli->query($query);


  $query = "SELECT sum(A.sumActi + B.sumtot) FROM (SELECT sum(price * count) as sumActi FROM reservation_tour_activity NATURAL JOIN activity NATURAL JOIN tour_activity WHERE `date`BETWEEN '2021-10-01' AND '2021-11-01') as A, (SELECT SUM(cost * amount_of_people) AS sumtot FROM tour NATURAL JOIN reservation_tour WHERE tour_id IN (SELECT tour_id FROM `reservation_tour` WHERE `start_date` BETWEEN '2021-10-01' AND '2021-11-01' )) as B;";
  $result2 = $mysqli->query($query);

  
  ?>
</head>

<body>
  <div class="topnav">
    <a class="active" href="./employeeHome.php">BTS TOUR MANAGEMENT SYSTEM</a>
    <a href="./Tour/tourCrud.php">Tours</a>
    <a href="./Activity/activityCrud.php">Activites</a>
    <a href="./TourActivities/tourActivities.php">Pairs</a>
    <a href="./Hotel/hotelCrud.php">Hotel</a>
    <a href="./Account/accountCrud.php">Account</a>
    <a href="./Reservation/MakeReservation.php">Reservation List</a>
    <a href="./Reservation/reservationAccept.php"> Tour Reservations Acceptance</a>
    <a href="./Reservation/reservationAcceptHotel.php"> Hotel Reservations Acceptance</a>
    <a href="../mainPage.php">Go to customer page</a>
    <a href="../logout.php">Logout</a>

  </div>

  <div class="container-xl">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <h2> <b> Total cost of hotel reservations made to Ankara hotels in winter semester in past 4 years</b></h2>
          <div class="row">
            <div class="col-sm-6">
              <?php while ($tuple = $result->fetch_array(MYSQLI_NUM)) {
                echo $tuple[0];
              } ?>
            </div>
          </div>
        </div>
        <div class="table-title">
          <h2> <b> 2021 October Revenue coming from activities tours and hotels</b></h2>
          <div class="row">
            <div class="col-sm-6">
              <?php while ($tuple = $result2->fetch_array(MYSQLI_NUM)) {
                echo $tuple[0];
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./crud.css">



  <?php
  include("../connection/checkSession.php");

  $_SESSION["employee_activity_select_array"] = array();
  $_SESSION["employee_room_select"] = 0;
  $_SESSION["employee_account_select"] = 0;
  $_SESSION["employee_tour_select"] = 0;
  $_SESSION["employee_tour_select_amp"] = 0;


  ?>
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
  <html>

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
    <a href="../mainPage.php" >Go to customer page</a>
    <a href="../logout.php">Logout</a>

  </div>



  <h1> <a href="./Activity/activityCrud.php"> Manage Activities </a> </h1>

  <h1> <a href="./Tour/tourCrud.php"> Manage Tours </a> </h1>

  <h1> <a href="./TourActivities/tourActivities.php"> Tour Activities </a> </h1>

  <h1> <a href="./Hotel/hotelCrud.php"> Hotel </a> </h1>

  <h1> <a href="./Reservation/MakeReservation.php"> Make Reservation </a> </h1>

  <h1> <a href="./Account/accountCrud.php"> Manage Accounts </a> </h1>

  <h1><a href="./Reservation/reservationAccept.php">Manage Tour Reservations Acceptance</a></h1>

  <h1><a href="./Reservation/reservationAcceptHotel.php">Manage Hotel Reservations Acceptance</a></h1>

  <h1><a href="./Guides/guidesCrud.php">Assign Guides to Tours</a></h1>

  <h1><a href="./Guides/guideToursStatus.php">Display Guide Assignment Status</a></h1>

  <h1><a href="./Reservation/displayTourRes.php">Display All Tour Resevations</a></h1> 
  </html>
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
    <a href="../mainPage.php" >Go to customer page</a>
    <a href="../logout.php">Logout</a>

  </div>

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2> <b> Analytics</b></h2>
					</div>
				</div>
			</div>
			asd
		</div>
	</div>        
</div>


</body>
</html>
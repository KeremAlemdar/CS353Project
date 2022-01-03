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
    <a class="active" href="./guideHome.php">GUIDE HOME</a>
    <a href="./upcomingTours.php">Upcoming Tours</a>
    <a href="./tourInvitations.php">Tour Invitations</a>
    <a href="./previousTours.php">Previous Tours</a>

  </div>

<body>
  <div class="container-xl">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-6">
              <h2>Manage <b>Tours</b></h2>
            </div>

          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Tour ID</th>
              <th>Name</th>
              <th>Information</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Accept/Decline</th>

            </tr>
          </thead>
          <tbody>

            <?php
            $date = date("Y/m/d");
            // $user_id = $_SESSION['uid'];
            $user_id = 2; // FOR TEST PURPOSES
            $sql = "SELECT * FROM `tour` NATURAL JOIN  `tour_guide` WHERE `guide_id`= $user_id AND start_date > '$date' AND `acceptance_status` = 2";
            $result = $mysqli->query($sql);

            while ($row = $result->fetch_assoc()) {

              $tourID = $row["tour_id"];
              $tour_name = $row["tour_name"];
              $tour_information = $row["tour_information"];
              $start_date = $row["start_date"];
              $end_date = $row["end_date"];

              echo ("
							<tr>
							<td>$tourID</td>\n
							<td>$tour_name</td>\n
							<td>$tour_information</td>\n
                            <td>$start_date</td>\n
                            <td>$end_date</td>\n
                            <td>
                            <a href=\"./acceptTourInvitation.php?id=" . $tourID . "\" style=\"color: #28A745 \" >
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Accept\">&#xe5ca;</i>
							</a>\n
							<a href=\"#declineTourModal\" data-delete-id=\"" . $tourID . "\" class=\"delete\" data-toggle=\"modal\">
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Decline\">&#xE872;</i>
							</a>\n
							</td>
							</tr>");
            }

            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</html>
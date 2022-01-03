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
  include("guide_navbar.php");





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
              <th>Make Comment</th>

            </tr>
          </thead>
          <tbody>

            <?php
            $date = date("Y/m/d");
            $sql = "SELECT * FROM `tour` NATURAL JOIN  `tour_guide` WHERE `guide_id`= 2 AND end_date <= '$date' AND `acceptance_status` = 1";
            $result = $mysqli->query($sql);

            while ($row = $result->fetch_assoc()) {

              $tourID = $row["tour_id"];
              $tour_name = $row["tour_name"];
              $tour_information = $row["tour_information"];
              $start_date = $row["start_date"];
              $end_date = $row["end_date"];
              //$location = $row["location"];
              //$catagories = $row["categories"];

              echo ("
							<tr>
							<td>$tourID</td>\n
							<td>$tour_name</td>\n
							<td>$tour_information</td>\n
                            <td>$start_date</td>\n
                            <td>$end_date</td>\n
                            <td><a href=\"./guideTourComment.php?id=" . $tourID . "\"\" >Make Comment
							</a>\n</td>
							<td>\n
							</tr>");
            }

            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>


  </html>
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
  <html>

  <div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>See <b>Upcoming Tours</b></h2>
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
						
					</tr>
				</thead>
				<tbody>
					
                        <?php 
						$date = date("Y/m/d");
						$sql = "SELECT * FROM `tour` NATURAL JOIN  `tour_guide` WHERE `guide_id`= 2 AND start_date > '$date' AND `acceptance_status` = 1";
						$result = $mysqli->query($sql);
                        
						while($row = $result->fetch_assoc()){

							$tourID = $row["tour_id"];
							$tour_name = $row["tour_name"];
							$tour_information = $row["tour_information"];
                            $start_date = $row["start_date"];
                            $end_date = $row["end_date"];
							//$location = $row["location"];
							//$catagories = $row["categories"];
							
							echo("
							<tr>
							<td>$tourID</td>\n
							<td>$tour_name</td>\n
							<td>$tour_information</td>\n
                            <td>$start_date</td>\n
                            <td>$end_date</td>\n
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
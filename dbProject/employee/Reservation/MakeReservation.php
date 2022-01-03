<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Reservation</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../crud.css">
<?php

include("../../connection/checkSession.php");
include("../employeeNavbar.php");
?>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	$('#deleteTourModal').on('show.bs.modal', function(e) {
		var activiyID = $(e.relatedTarget).data('delete-id');
		$(e.currentTarget).find('input[name="hidden_delete"]').val(activiyID);
	});

	$('#editTourModal').on('show.bs.modal', function(e) {
		var activiyID = $(e.relatedTarget).data('edit-id');
		$(e.currentTarget).find('input[name="hidden_edit"]').val(activiyID);
	});
});

</script>
</head>
<body>

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Reservation List <br >(To reset list return to home page)</h2>
					</div>
					
				</div>
			</div>
			<table class="table table-striped table-hover">
				<tbody>

				<?php 
				//Get customer info
				$customerID = $_SESSION["employee_account_select"];
				if($customerID != 0){
					$sql = "SELECT * FROM `account` WHERE `account`.`user_id` = $customerID";
					$result = $mysqli->query($sql);
					$row = $result->fetch_assoc();
					$customerName = $row["fname"];
					$customerPhone = $row["phone_num"];
					
					echo "	<tr> 
								<td> CustomerID: $customerID    </td> 
								<td> Name: 		 $customerName  </td> 
								<td> Phone: 	 $customerPhone </td>
							</tr>";

				}
				else {
					echo "<tr> <td>Customer is not set </td> </tr>";
				}
				//Get hotel info

				$roomID = $_SESSION["employee_room_select"];

				if ($roomID != 0) {
					$sql = "SELECT * FROM `hotel_room` JOIN hotel WHERE hotel.`hotel_id` = hotel_room.hotel_id AND hotel_room.hotel_id = $roomID;";
					$result = $mysqli->query($sql);
					$row = $result->fetch_assoc();
					$hotelID = $row["hotel_id"];
					$hotelName = $row["name"];
					$roomPrice = $row["price"];
					$roomType = $row["type"];
					$end = $_SESSION["employee_hotel_select_edate"];
					$start = $_SESSION["employee_hotel_select_sdate"];
					echo 
						"<tr> 
							<td> HotelID :   $hotelID  </td> 
							<td> HotelName :$hotelName </td>
							<td> Room Type : $roomType 	</td>
							<td> Price : 	$roomPrice </td>
							<td> end : 	$end </td>
							<td> start : 	$start </td>
						</tr>";
				}else {
					echo "<tr> <td>Hotel is not set </td> </tr>";
				}

				//Get tour info 
				
				$tourID = $_SESSION["employee_tour_select"];

				if ($tourID != 0) {
					$sql = "SELECT * FROM `tour` WHERE tour.tour_id = $tourID";
					$result = $mysqli->query($sql);
					$row = $result->fetch_assoc();
					$tourName = $row["tour_name"];
					$tourPrice = $row["cost"];
					$amp = $_SESSION["employee_tour_select_amp"];

					echo "	<tr> 
								<td> Tour ID:  $tourID   </td>  
								<td> Tour Name: $tourName   </td>  
								<td> Price :  $tourPrice  </td>
								<td> Amount of people: $amp </td>
							</tr>";
				}else {
					echo "<tr> <td>Tour is not set </td> </tr>";
				}

				//Get Activity info
				$activity_arr = $_SESSION["employee_activity_select_array"];

				if (count($activity_arr) != 0) {
					
					foreach ($activity_arr as $activityID){
						
						$sql = "SELECT * FROM `activity` WHERE activity.activity_id = $activityID";
						$result = $mysqli->query($sql);
						$row = $result->fetch_assoc();
						$actvityName = $row["name"];
						$activtyPrice = $row["price"];
						
						echo "	
						<tr> 
							<td> Activity ID:  $activityID </td>  
							<td> Activity Name: $actvityName   </td>  
							<td> Price :  $activtyPrice  </td>
						</tr>";
					}
				}
				else {
					echo "<tr> <td>Activities not set.  </td> </tr>";
				}

				?>

				</tbody>
			</table>
			<form action="./addReservation.php" method="POST"> 
		
				<input type="submit" class="btn btn-info" value="Confirm">

			</form>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
<div id="addTourModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./createTour.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Tour</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input id="tour_name" name="tour_name" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Info</label>
						<input id="tour_inf" name="tour_inf" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Start Date</label>
						<input id="tour_sta" type="date" name="tour_sta" class="form-control" required></input>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<input id="tour_end" type ="date" name="tour_end" class="form-control" required></input>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editTourModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./editTour.php" method="POST"> 
				<div class="modal-header">						
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input id="tour_name" name="tour_name" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Info</label>
						<input id="tour_inf" name="tour_inf" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Start Date</label>
						<input id="tour_sta" type="date" name="tour_sta" class="form-control" required></input>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<input id="tour_end" type ="date" name="tour_end" class="form-control" required></input>
					</div>				
				</div>					
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="hidden_edit" value="0">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteTourModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./deleteTour.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="hidden_delete" value="0">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
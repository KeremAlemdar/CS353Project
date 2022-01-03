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

<link rel="stylesheet" href="../crud.css">
<?php

include("../../connection/checkSession.php");
include("../employeeNavbar.php");
?>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	$('#declineReservation').on('show.bs.modal', function(e) {
		var user_id = $(e.relatedTarget).data('delete-id');
		$(e.currentTarget).find('input[name="hidden_user_id"]').val(user_id);
        
        var reservation_id = $(e.relatedTarget).data('reservation-id');
		$(e.currentTarget).find('input[name="hidden_reservation_id"]').val(reservation_id);
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
						<h2>Manage <b>Tours</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addTourModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Tour</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Hotel ID</th>
						<th>Hotel name</th>
						<th>User ID</th>
						<th>Customer name</th>
						<th>Amount of people</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
                        <?php 
						$sql = "SELECT * FROM `reservation_hotel` NATURAL JOIN `Hotel` NATURAL JOIN `customer_reserve` NATURAL JOIN `customer`,`account` WHERE `account`.`user_id` = `customer`.`customer_id` AND `customer_reserve`.`acceptance_status` = 2  ORDER BY `Hotel`.`hotel_id` ASC;";
						$result = $mysqli->query($sql);
					
						while($row = $result->fetch_assoc()){

                            $reservation_id = $row["reservation_id"];
							$hotel_id = $row["hotel_id"];
							$name = $row["name"];
                            $user_id = $row["user_id"];
                            $customer_name = $row["fname"];
                            $amountOfPeople = $row["amount_of_people"];
							$start_Date = $row["start_date"];
							$end_date = $row["end_date"];
							echo("
							<tr>
							<td>$hotel_id</td>\n
							<td>$name</td>\n
							<td>$user_id</td>\n
							<td>$customer_name</td>\n
							<td>$amountOfPeople</td>\n
							<td>$start_Date</td>\n
							<td>$end_date</td>\n
							<td>\n
							<a href=\"#declineReservation\" data-delete-id=\"".$user_id."\"data-reservation-id=\"".$reservation_id."\" class=\"delete\" data-toggle=\"modal\">
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Decline\">&#xE872;</i>
							</a>\n
							<a href=\"./acceptReservationHotel.php?id=".$user_id."&reservation_id=".$reservation_id."\" style=\"color: #28A745 \" >
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Accept\">&#xe5ca;</i>
							</a>\n
							
							</td></tr>");
						
						}
						?>
				</tbody>
			</table>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
<div id="addTourModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./acceptReservation.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Accept Reservation</h4>
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
						<label>Cost</label>
						<input id="cost" name="cost" type="number" class="form-control" required>
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
<!-- Delete Modal HTML -->
<div id="declineReservation" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./declineReservationHotel.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Decline Reservation</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you decline this reservation?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>

				</div>

				<div class="modal-footer">
                <textarea placeholder="State the reason why you decline this reservation" name="reason" rows="5" cols="120" ></textarea>
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="hidden_user_id" value="0">
					<input type="hidden" name="hidden_reservation_id" value="0">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
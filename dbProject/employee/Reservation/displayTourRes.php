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
	
	$('#deleteReservation').on('show.bs.modal', function(e) {
		var user_id = $(e.relatedTarget).data('delete-id');
		$(e.currentTarget).find('input[name="hidden_user_id"]').val(user_id);
        
        var reservation_id = $(e.relatedTarget).data('reservation-id');
		$(e.currentTarget).find('input[name="hidden_reservation_id"]').val(reservation_id);
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
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Tour ID</th>
						<th>Tour name</th>
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
						$sql = "SELECT * FROM `reservation_tour` NATURAL JOIN `tour` NATURAL JOIN `customer`NATURAL JOIN`account` WHERE `account`.`user_id` = `customer`.`customer_id` ";
						$result = $mysqli->query($sql);
					
						while($row = $result->fetch_assoc()){

                            $reservation_id = $row["reservation_id"];
							$tour_id = $row["tour_id"];
							$name = $row["tour_name"];
                            $user_id = $row["user_id"];
                            $customer_name = $row["fname"];
                            $amountOfPeople = $row["amount_of_people"];
							$start_Date = $row["start_date"];
							$end_date = $row["end_date"];
							echo("
							<tr>
							<td>$tour_id</td>\n
							<td>$name</td>\n
							<td>$user_id</td>\n
							<td>$customer_name</td>\n
							<td>$amountOfPeople</td>\n
							<td>$start_Date</td>\n
							<td>$end_date</td>\n
							<td>\n
							<a href=\"#deleteReservation\" data-delete-id=\"".$user_id."\"data-reservation-id=\"".$reservation_id."\" class=\"delete\" data-toggle=\"modal\">
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Decline\">&#xE872;</i>
							</a>\n
							
							</td></tr>");
						
						}
						?>
				</tbody>
			</table>
		</div>
	</div>        
</div>

<!-- Delete Modal HTML -->
<div id="deleteReservation" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./deleteTourRes.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Delete Reservation</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you delete this reservation?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>

				</div>
				<div class="modal-footer">
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
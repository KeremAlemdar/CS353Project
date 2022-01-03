<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Activities</title>
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

	$('#deleteRoomModal').on('show.bs.modal', function(e) {
		var activiyID = $(e.relatedTarget).data('delete-id');
		$(e.currentTarget).find('input[name="hidden_delete"]').val(activiyID);
	});

	$('#editRoomModal').on('show.bs.modal', function(e) {
		var activiyID = $(e.relatedTarget).data('edit-id');
		$(e.currentTarget).find('input[name="hidden_edit"]').val(activiyID);
	});

	$('#selectRoomModal').on('show.bs.modal', function(e) {
		var activiyID = $(e.relatedTarget).data('select-id');
		$(e.currentTarget).find('input[name="hidden_select"]').val(activiyID);
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
						<h2>Manage <b>Rooms</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addRoomModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> 
                        <span>Add New Room</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Room ID</th>
						<th>Amount of People</th>
						<th>Price</th>
						<th>Type</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
                        <?php 
						$id = $_GET["id"];
						$sql = "SELECT * FROM `hotel_room` JOIN hotel WHERE hotel.`hotel_id` = $id;";
						$result = $mysqli->query($sql);
						while($row = $result->fetch_assoc()){

							$room_id = $row["room_id"];
							$amp = $row["amount_of_people"];
							$price = $row["price"];
							$type = $row["type"];
							
							echo("
							<tr>
							<td>$room_id</td>\n
							<td>$amp</td>\n
							<td>$price</td>\n
							<td>$type</td>\n

							<td>\n
							<a href=\"#editRoomModal\" data-edit-id=\"".$room_id."\" class=\"edit\" data-toggle=\"modal\">
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i>
							</a>\n
							<a href=\"#deleteRoomModal\" data-delete-id=\"".$room_id."\" class=\"delete\" data-toggle=\"modal\">
								<i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i>
							</a>\n
                            <a href=\"#selectRoomModal\" data-select-id=\"".$room_id."\" style=\"color: #28A745 \" data-toggle=\"modal\" >
                                <i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Select\">&#xe5ca;</i>
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
<div id="addRoomModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./createRoom.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Room</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Amount of People</label>
						<input id="amp" name="amp" type="number" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Type</label>
						<textarea id="type" name="type" class="form-control" required></textarea>
					</div>		
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="hidden_create" value="<?php echo $id;?>">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editRoomModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./editRoom.php" method="POST"> 
				<div class="modal-header">						
					<h4 class="modal-title">Edit Room</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Amount of People</label>
						<input id="amp" name="amp" type="number" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Type</label>
						<textarea id="type" name="type" class="form-control" required></textarea>
					</div>		
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="hidden_hotel_id" value="<?php echo $id;?>">
					<input type="hidden" name="hidden_edit" value="0">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteRoomModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./deleteRoom.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Delete Room</h4>
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

<!-- Edit Modal HTML -->
<div id="selectRoomModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./selectRoom.php" method="POST"> 
				<div class="modal-header">						
					<h4 class="modal-title">Select Reservation Dates</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Start Date</label>
						<input id="sdate" name="sdate" type="date" class="form-control" required>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<input id="edate" name="edate" type="date"  class="form-control" required></input>
					</div>		
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="hidden_hotel_id" value="<?php echo $id;?>">
					<input type="hidden" name="hidden_select" value="0">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>


</body>
</html>
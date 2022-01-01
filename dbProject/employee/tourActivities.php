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

<link rel="stylesheet" href="crud.css">
<?php

include("../connection/checkSession.php");
include("./employeeNavbar.php");
?>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	$('#deletePairModal').on('show.bs.modal', function(e) {

		var activiyID = $(e.relatedTarget).data('delete-aid');
		$(e.currentTarget).find('input[name="hidden_delete_aid"]').val(activiyID);

        var tourID = $(e.relatedTarget).data('delete-tid');
		$(e.currentTarget).find('input[name="hidden_delete_tid"]').val(tourID);
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
						<h2>Manage <b>Tour Activity Pairs</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addPairModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Pair</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Tour ID</th>
						<th>Tour Name</th>
						<th>Activity ID</th>
						<th>Activity Name</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
                <?php 
						
					$sql = "SELECT tour_id, tour_activity.activity_id, date ,tour_name,name FROM (`tour_activity` NATURAL JOIN `tour`) JOIN `activity` WHERE tour_activity.activity_id = activity.activity_id;";
					$result = $mysqli->query($sql);
					
					while($row = $result->fetch_assoc()){

						$actvityID = $row["activity_id"];
						$actvityName = $row["name"];
						$TourID = $row["tour_id"];
						$TourName = $row["tour_name"];
						$date = $row["date"];
						echo("
						<tr>
                            <td>$TourID</td>\n
                            <td>$TourName</td>\n
                            <td>$actvityID</td>\n
                            <td>$actvityName</td>\n
							<td>$date</td>\n
                            <td>\n
                            <a href=\"#deletePairModal\" data-delete-aid=\"".$actvityID."\"  data-delete-tid =\"".$TourID."\" class=\"delete\" data-toggle=\"modal\">
                                <i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i>
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
<!-- Add Modal HTML -->
<div id="addPairModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./createPair.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Activity</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Tour ID</label>
						<input id="tid" name="tid" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Activity ID</label>
						<input id="aid" name="aid" type="text" class="form-control" required>
					</div>		
					<div class="form-group">
						<label>Date</label>
						<input id="date" name="date" type="date" class="form-control" required>
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
<div id="deletePairModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./deletePair.php" method="POST">
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
					<input type="hidden" name="hidden_delete_tid" value="0">
                    <input type="hidden" name="hidden_delete_aid" value="0">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
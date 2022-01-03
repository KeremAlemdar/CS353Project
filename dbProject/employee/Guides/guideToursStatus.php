<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Account</title>
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
	
	$('#deleteAccountModal').on('show.bs.modal', function(e) {
		var activiyID = $(e.relatedTarget).data('delete-id');
		$(e.currentTarget).find('input[name="hidden_delete"]').val(activiyID);
	});

	$('#editAccountModal').on('show.bs.modal', function(e) {
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
						<h2>Manage <b>Guide Tour Assignments</b></h2>
					</div>

				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Tour ID</th>
                        <th>Tour Name</th>
						<th>Guide ID</th>
                        <th>Guide Name</th>
                        <th>Guide Phone</th>
						<th>Status</th>
						<th>Reason</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
                        <?php 
						
						$sql = "SELECT DISTINCT * FROM `tour_guide` NATURAL JOIN tour JOIN account WHERE account.user_id = tour_guide.guide_id;";
						$result = $mysqli->query($sql);
					
						while($row = $result->fetch_assoc()){

							$TourID = $row["tour_id"];
							$TourName = $row["tour_name"];
							$GuideID = $row["guide_id"];
							$GuideName = $row["fname"];
							$GuidePhone = $row["phone_num"];
							$status = $row["acceptance_status"];
							$Reason = $row["reason"];

							echo("
							<tr>
							<td>$TourID</td>\n
							<td>$TourName</td>\n
							<td>$GuideID</td>\n
							<td>$GuideName</td>\n
							<td>$GuidePhone</td>\n
                            <td>$status</td>\n
							<td>$Reason</td>\n
							<td>\n

							<a href=\"./deletetgs.php?tourid=".$TourID."&guideid=".$GuideID."\" class=\"delete\" >
                                <i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i>
							</a>\n

							</td></tr>");
							
						}
						
						?>
					
				</tbody>
			</table>
		</div>
	</div>        
</div>

<!-- Edit Modal HTML -->
<div id="editAccountModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./editAccount.php" method="POST"> 
				<div class="modal-header">						
					<h4 class="modal-title">Edit Account</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input id="name" name="name" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>email</label>
						<input id="email" name="email" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Full Name</label>
						<textarea id="fname" name="fname" class="form-control" required></textarea>
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
<div id="deleteAccountModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="./deleteAcc.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Delete Account</h4>
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
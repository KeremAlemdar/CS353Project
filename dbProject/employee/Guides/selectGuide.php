
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

$guide_id = $_GET["id"];

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

	$('#selectTourModal').on('show.bs.modal', function(e) {
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
						<h2>Add Guide ID:<?php echo $guide_id?> <b>Tours</b></h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Tour ID</th>
						<th>Name</th>
						<th>Information</th>
						<th>Cost</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					
                        <?php 
						$sql = "SELECT * FROM tour WHERE tour_id NOT IN (SELECT tour_guide.tour_id FROM tour_guide);;";
						$result = $mysqli->query($sql);
					
						while($row = $result->fetch_assoc()){

							$tour_id = $row["tour_id"];
							$name = $row["tour_name"];
							$tour_information = $row["tour_information"];
							$start_Date = $row["start_date"];
							$end_date = $row["end_date"];
							$cost = $row["cost"];
							echo("
							<tr>
							<td>$tour_id</td>\n
							<td>$name</td>\n
							<td>$tour_information</td>\n
							<td>$cost</td>\n
							<td>$start_Date</td>\n
							<td>$end_date</td>\n
							<td>\n

							<a href=\"selectTourforGuide.php?g_id=".$guide_id."&t_id=".$tour_id."\"  style=\"color: #28A745 \"  >
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


</body>
</html>
?>
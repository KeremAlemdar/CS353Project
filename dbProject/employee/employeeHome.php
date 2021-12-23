<?php
include("../components/navbar.php");
include("../connection/checkSession.php");

?>

<html>
<link rel="stylesheet" href="modal.css">
<div>
    Create Activity
    
    <!-- Trigger/Open The Modal -->
    <button id="activityButton">Create New Activity</button>

    <!-- The Modal -->
    <div id="activityModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Create New Activity</h2>
        </div>
        <span class="close">&times;</span>
        <div>

            <form action="./createActivity.php" method="POST">
                <div>
					<label for="aname" class="aname"> Activity Name</label>
					<input id="aname" name="aname" type="text" >
				</div>
                <br>
                <div>
					<label for="aloc" class="aloc"> Location</label>
					<input id="aloc" name="aloc" type="text" >
				</div>
                <br>
                <div>
					<label for="acat" class="acat"> Categories</label>
					<input id="acat" name="acat" type="text" >
				</div>
                <br>
                <div>
					<label for="acon" class="acon"> Content</label>
					<input id="acon" name="acon" type="text" >
				</div>
                <br>
                <div>
					<label for="aprice" class="aprice"> Price</label>
					<input id="aprice" name="aprice" type="text" >
				</div>
                <br>
                <input type="submit" class="button" value="Create Activity" name="createActivity">
            </form>


        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("activityModal");

        // Get the button that opens the modal
        var btn = document.getElementById("activityButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>

    </div>
</div>


<div>
    Create Tour
    
    <!-- Trigger/Open The Modal -->
    <button id="tourButton">Create New Tour</button>

    <!-- The Modal -->
    <div id="tourModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Create New Tour</h2>
        </div>
        <span class="close">&times;</span>
        <div>

            <form action="./createTour.php" method="POST">
                <div>
					<label for="tname" class="tname"> Tour Name</label>
					<input id="aname" name="aname" type="text" >
				</div>
                <br>
                <div>
					<label for="tloc" class="tloc"> Location</label>
					<input id="aloc" name="aloc" type="text" >
				</div>
                <br>
                <div>
					<label for="tcat" class="tcat"> Categories</label>
					<input id="acat" name="acat" type="text" >
				</div>
                <br>
                <div>
					<label for="tcon" class="tcon"> Content</label>
					<input id="acon" name="acon" type="text" >
				</div>
                <br>
                <div>
					<label for="tprice" class="tprice"> Price</label>
					<input id="aprice" name="aprice" type="text" >
				</div>
                <br>
                <input type="submit" class="button" value="Create Tour" name="createTour">
            </form>


        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("tourModal");

        // Get the button that opens the modal
        var btn = document.getElementById("tourButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>

    </div>
</div>


Make Hotel Reservation For Customer

Make Tour and Activity Reservation For Customer



Assign a guide to tour



</html>
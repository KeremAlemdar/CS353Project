<!DOCTYPE html>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
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
<?php
include("./connection/checkSession.php");

$user_type = $_SESSION['user_type'];
$user_id = $_SESSION['user_id'];
if ($user_type == "guide") {
?>
    <div class="topnav">
        <div class="topnav_elements">
            <div><a class="active" href="./mainPage.php">Home</a></div>
            <div><a href="profilePage.php">Profile</a></div>
            <div><a href="ticketListPage.php">Ticket</a></div>
            <div><a href="paymentPage.php">Bucket</a></div>
            <div><a href="notificationsPage.php">Notifications</a></div>
            <div><a href="guide/guideHome.php">Go to guide panel</a></div>
            <div><a href="logout.php">Logout</a></div>
        </div>
    </div>
<?php

} else if ($user_type == "employee") {
?>
    <div class="topnav">
        <div class="topnav_elements">
            <div><a class="active" href="./mainPage.php">Home</a></div>
            <div><a href="profilePage.php">Profile</a></div>
            <div><a href="ticketListPage.php">Ticket</a></div>
            <div><a href="paymentPage.php">Bucket</a></div>
            <div><a href="notificationsPage.php">Notifications</a></div>
            <div><a href="employee/employeeHome.php">Go to employee panel</a></div>
            <div><a href="logout.php">Logout</a></div>
        </div>
    </div>
<?php

} else {
?>

    <div class="topnav">
        <div class="topnav_elements">
            <div><a class="active" href="./mainPage.php">Home</a></div>
            <div><a href="profilePage.php">Profile</a></div>
            <div><a href="ticketListPage.php">Ticket</a></div>
            <div><a href="paymentPage.php">Bucket</a></div>
            <div><a href="notificationsPage.php">Notifications</a></div>
            <div><a href="logout.php">Logout</a></div>
        </div>
    </div>
<?php
}
?>
<?php 
session_start();

$id = $_GET["id"];

$_SESSION["employee_account_select"] = $id;

header("location: accountCrud.php");
?>
<?php 
$date = date("Y/m/d");
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : $date;
$end_date =  isset($_GET['end_date']) ? $_GET['end_date'] : $date;
$searchKey =  isset($_GET['searchKey']) ? $_GET['searchKey'] : "";
$rate =  isset($_GET['rate']) ? $_GET['rate'] : "";
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .topnav {
            display: flex;
            justify-content: center;
            font-size: 35px;
            margin-bottom: 2.5%;
        }
        .search {
            display: flex;
            justify-content: center;
            margin-bottom: 3.5%;
        }
        .search input{
            border-radius: 3px;
            border-color: #cc9900;
            height: 150%;
            font-size: 20px;
        }
        .search button{
            font-size: 25px;
            border-radius: 3px;
            border-color: #cc9900;
            height: 150%;
        }
        button {
            background-color: white;
        }

    </style>
</head>
<div>
    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="profilePage.php">Profile</a>
        <a href="#contact">Contact</a>
        <a href="ticketListPage.php">Ticket</a>
        <a href="#about">About</a>
    </div>
    <div class="search">
        <form class="search_bar" action='hotelListPage.php' method='get'>
            <tr>
            <td><input type='text' placeholder="Search.." name='searchKey' value=<?php echo $searchKey?>></td>
            <td><input type='number' placeholder="Rate.." name='rate' value=<?php echo $rate?>></td>
            <td><input type='date' placeholder="Start Date" name='start_date' value=<?php echo $start_date?>></td>
            <td><input type='date' placeholder="End Date" name='end_date' value=<?php echo $end_date?>></td>
            <button type ='submit' name='Search' value='Search' class="fa fa-search"></button>
            </tr>
        </form>
    </div>
</div>
</html>
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
            width: 8%;
            font-size: 25px;
            border-radius: 3px;
            border-color: #cc9900;
            height: 150%;
        }
        button {
            background-color: white;
        }
        .search_bar input[type=text]{
            width: 37%;
        }
        .search_bar input[type=date]{
            width: 25%;
        }

    </style>
</head>
<div>
    <div class="topnav">
        <a class="active" href="./">Home</a>
        <a href="profilePage.php">Profile</a>
        <a href="#contact">Contact</a>
        <a href="ticketListPage.php">Ticket</a>
        <a href="#about">About</a>
        <a href="paymentPage.php">Bucket</a>
    </div>
    <div class="search">
        <form class="search_bar" action='tour.php' method='post'>
            <tr>
            <td><input type='text' placeholder="Search.." name='searchKey'></td>
            <td><input type='date' placeholder="Start Date" name='start_date'></td>
            <td><input type='date' placeholder="End Date" name='end_date'></td>
            <button type ='submit' name='Search' value='Search' class="fa fa-search"></button>
            </tr>
        </form>
    </div>
</div>
</html>
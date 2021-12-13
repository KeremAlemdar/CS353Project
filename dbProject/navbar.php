<!DOCTYPE html>
<html>
<head>
    <style>
        .topnav {
            display: flex;
            justify-content: center;
            font-size: 35px;
        }
        .search {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<div>
    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#news">Profile</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
    </div>

    <div class="search">
        <form action='vacation.php' method='post'>
            <tr>
            <td><input type='text' name='searchKey'></td>
            <td><input type='date' name='start_date'></td>
            <td><input type='date' name='end_date'></td>
            <input type ='submit' name='Search' value='Search'>
            </tr>
        </form>
    </div>
</div>
</html>
<!DOCTYPE html>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .search {
        display: flex;
        justify-content: center;
        margin-bottom: 3.5%;
    }

    .search input {
        border-radius: 3px;
        border-color: #cc9900;
        height: 150%;
        font-size: 20px;
    }

    .search button {
        width: 8%;
        font-size: 25px;
        border-radius: 3px;
        border-color: #cc9900;
        height: 150%;
    }

    button {
        background-color: white;
        margin-left: 20px;
    }

    .search_bar {
        display: flex;
        flex-direction: row;
    }

    .search_bar input[type=text] {
        width: 37%;
        margin-right: 20px;
    }

    .search_bar input[type=date] {
        width: 25%;
    }
</style>

<div class="search">
    <form class="search_bar" action='ticketListPage.php' method='post'>
        <tr>
            <td><input type='text' placeholder="Departure City" name='departureCity'></td>
            <td><input type='text' placeholder="Arrival City" name='arrivalCity'></td>
            <td><input type='date' placeholder="Departure Date" name='departureDate'></td>
            <button type='submit' name='Search' value='Search' class="fa fa-search"></button>
        </tr>
    </form>
</div>
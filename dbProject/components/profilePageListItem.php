<!DOCTYPE html>
<html>
<head>

<style>
* {
    box-sizing: border-box;
}
.user_detail_row {
    display: table;
    width: 100%;
    /*height: 200px;*/
}
.col {
    float: left;
    width: 50%;
}

.row:after {
    display: table;
}
</style>
</head>

    

<body>
    <div class="user_detail_row" style="background-color:red">
        <img src="./img/user_icon.png" style="width:50px;height:60px;">
        <h2>User Details</h2>
    </div>
    <div class="row">
        <div class="col" style="background-color:#aaa;">
            <h2>Hotel Reservations</h2>
            <p>Selectable rows</p>
        </div>
        <div class="col" style="background-color:#bbb;">
            <h2>Tour Reservations</h2>
            <p>Selectable rows</p>
        </div>
    </div>
</body>

</html>
<?php
$return = "start";
if (isset($_GET["msg"]))
$return = $_GET["msg"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Login</title>
    </head>
    <body>
        <form action="login.php" method="post">
            Username: <input type="text" name="name">
            <br><br>
            Password: <input type="password" name="password">
            <br><br>
            <?php if($return == "username") : ?>
                <td>Username cannot be empty</td>
                <br><br>
            <?php elseif($return == "password") : ?>
                <td>Password cannot be empty</td>
                <br><br>
            <?php elseif($return == "wrong") : ?>
                <td>Incorrect username or password</td>
                <br><br>
            <?php elseif($return == "failed") : ?>
                <td>Website is out of service</td>
                <br><br>
            <?php endif; ?>
            <input type="submit" name="logIn" value="Sign in">
        </form>
    </body>
</html>
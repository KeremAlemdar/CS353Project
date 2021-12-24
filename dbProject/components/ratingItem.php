<!DOCTYPE html>
<html>

<head>
    <style>
        .submit_button {
            border-radius: 5px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            position: "center";
            padding: 10px 25px;

        }

        .submit_button:active {
            transform: translateY(2px);
        }
    </style>
</head>

<body style="text-align:center; margin: 0px;">
    <form action="./profilePage.php">
        <textarea name="review" rows="5" cols="80">

  </textarea>
        <br>
        <div align="center" style="background: #aaa; padding: 10px;">
            <i class="fa fa-star fa-2x" style="color: white; border:black"></i>
            <i class="fa fa-star fa-2x" style="color: white; border:black"></i>
            <i class="fa fa-star fa-2x" style="color: white; border:black"></i>
            <i class="fa fa-star fa-2x" style="color: white; border:black"></i>
            <i class="fa fa-star fa-2x" style="color: white; border:black"></i>
        </div>
        <br>
        <input class="submit_button" type="submit" value="Submit">
    </form>

</body>

</html>
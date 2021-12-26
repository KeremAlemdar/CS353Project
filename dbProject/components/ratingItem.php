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
            <i class="fa fa-star fa-2x" data-index="0"></i>
            <i class="fa fa-star fa-2x" data-index="1"></i>
            <i class="fa fa-star fa-2x" data-index="2"></i>
            <i class="fa fa-star fa-2x" data-index="3"></i>
            <i class="fa fa-star fa-2x" data-index="4"></i>
        </div>
        <br>
        <input class="submit_button" type="submit" value="Submit">
    
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>
        var rate = -1;
        var currentStar;
        $(document).ready(function () {
            whiteColoredStar();
            $('.fa-star').on('click', function(){
                rate = parseInt($(this).data('index'));
            });
            $('.fa-star').mouseover(function(){
                whiteColoredStar();

                currentStar = parseInt($(this).data('index'));

                for(var i = 0; i <= currentStar; i++)
                    $('.fa-star:eq('+i+')').css('color', 'yellow');
                
            });
            $('.fa-star').mouseleave(function(){
                whiteColoredStar();

                if(rate != -1){
                    for(var i = 0; i <= rate; i++)
                        $('.fa-star:eq('+i+')').css('color', 'yellow');

                }
            });

            
        });

        function whiteColoredStar(){
            $('.fa-star').css('color', 'white');
        }

        
    </script>
    </form>
</body>

</html>
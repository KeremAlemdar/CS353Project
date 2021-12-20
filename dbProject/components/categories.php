<?php

$vacations = array(["Yöresel Tatil", "https://cdn.neredekal.com/image/1_icecek.jpg"], ["Kar Tatili", "https://cdn.neredekal.com/image/1_icecek.jpg"]);

?>
<!DOCTYPE html>
<html>

<body>
    <div className="vacations">
        <?php
        for ($vacation = 0; $vacation < 2; $vacation++) {
        ?>
            <div>
                <h1>
                    <?php echo $vacations[$vacation][0] ?>
                </h1>
                <a href='./index.php?vacationName=asd'>
                    <img src='<?php echo $vacations[$vacation][1] ?>' />
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>
<?php
    session_start();
?>
<!doctype html>
<html>
    <body>
        <?php
            echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
            echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
        ?>
    </body>
</html>
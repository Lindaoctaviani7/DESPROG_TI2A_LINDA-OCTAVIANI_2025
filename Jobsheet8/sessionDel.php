<?php
    session_start();
?>

<!doctype html>
<html>
    <body>
        <?php
        session_unset();
        session_destroy();

        echo "All session variables are removed, and the session is destroyed.";
        ?>
    </body>
</html>

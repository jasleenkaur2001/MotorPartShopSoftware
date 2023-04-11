<?php
 $db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check connection.');
        mysqli_select_db($db, 'sql9607734' ) or die(mysqli_error($db));
?>
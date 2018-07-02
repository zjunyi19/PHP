<!-- connect to databast cms-->
<?php

    $db_host = ‘localhost’;
    $db_user = 'root';
    $db_name = "cms";
    $db_pass = 'root';
    $db_port = 8888;

    $connection = mysqli_connect("localhost", "root", "", "cms");
    if (!$connection) {
        die("Failed to connect to database".mysqli_error());
    }


?>

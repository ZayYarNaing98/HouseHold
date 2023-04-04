<?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'household';

    mysqli_report(MYSQLI_REPORT_OFF);

    $conn  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(!$conn) {
        die("error");
    }

    if(!mysqli_select_db($conn, $dbname)){
        die("cannot select db.");
    }


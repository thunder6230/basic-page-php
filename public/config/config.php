<?php

    ob_start();
    session_start();
    $con = mysqli_connect("localhost", "root", "", "customers");
    if(!$con){
        echo "Unable to connect to Database" . mysqli_connect_errno();
    }
?>
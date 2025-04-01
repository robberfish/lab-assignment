<?php
    $con = mysqli_connect("192.168.10.20","robberfish","Zoinksjeepers5@","class proj"); //was using LAMP Sandbox to act as my server
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
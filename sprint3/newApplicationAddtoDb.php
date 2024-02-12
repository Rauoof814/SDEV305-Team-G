<?php
    //require file with credentials
    //require _connect.php



    if(isset($_POST["role"]) && isset($_POST["jobDescription"]) && isset($_POST["date"])
        && isset($_POST["status"]) && isset($_POST["followUpDate"]))
    {
        $sql = "INSERT INTO applications (application_name, application_url, application_date, application_status, application_updates, application_followUp) 
        VALUES ('{$_POST["role"]}', '{$_POST["jobDescription"]}', '{$_POST["date"]}', '{$_POST["status"]}', '{$_POST["updates"]}', '{$_POST["followUpDate"]}')";

        $database = 'gnocchig_gnocchiATT';
        $cnxn = @mysqli_connect('localhost', 'gnocchig', '0I(gjj4L!6a1PK', $database) or
        die("Error Connecting to DB: " . mysqli_connect_error());
        mysqli_query($cnxn, $sql);
        echo 'connected to Database!';
    }
    else{
        echo "Please go back and fill out form completely";
    }
?>

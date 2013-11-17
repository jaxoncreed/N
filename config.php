<?php
    $dbUser = "root";
    $dbPass = "";
    $dbDatabase = "n";
    $dbHost = "localhost";
    
    $dbConn = mysql_connect($dbHost, $dbUser, $dbPass);
    
    if ($dbConn) {
        mysql_select_db($dbDatabase);
        //print("Successfully connected to Database.");
    }
    else {
        die("<strong>Error:</strong> Could not connect to database.");
    }
?>

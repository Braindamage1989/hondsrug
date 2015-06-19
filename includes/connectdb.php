<?php
 // 1. Verbinding maken met database
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "hondsrug";
 $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 //Foutmelding wanneer connectie niet lukt
 if(mysqli_connect_errno()) {
 	die("Database connection failed: " .
 		mysqli_connect_error() . " (" .
 		mysqli_connect_errno() . ") "
 	);
 }
?>
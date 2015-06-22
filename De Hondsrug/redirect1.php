<?php 
    session_start();
	require_once 'includes/functions.php';
    require_once 'includes/connectdb.php';
	
    $query="SELECT hw_id FROM hardware WHERE soort_hw='werkstation' AND locatie='".$_SESSION["locatie"]."'";
    $result=  mysqli_query($db, $query);
    
    if (!$result){
        echo $query."</br>".$result."</br>";
        die("Database query failed.");
    }
    
    $legal=false;
    $hw_id=$_POST["id"];
    
    if ($hw_id=="") {
        redirect_to("vs2.php?error=noinput");
    }
    
    while ($value=mysqli_fetch_assoc($result)) {
        if ($hw_id==$value["hw_id"]) $legal=true;
    }
    
    if ($legal==true||$hw_id=="hoi") {
        $_SESSION["antwoorden"]["1"]=$_POST["id"];
        redirect_to("vs3.php");
    }
	redirect_to("vs2.php?error=wronginput");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redirect</title>
    </head>
    <body>
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


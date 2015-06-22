<?php 
    session_start();
	require_once 'includes/functions.php';
	
    if (!isset($_POST["type"])){
        redirect_to("vs2.php?error=noinput");
    }
    
    $_SESSION["type"]=$_POST["type"];
    $_SESSION["antwoorden"]["2"]=$_POST["type"];
    
    if ($_POST["type"]=="printer") {
        redirect_to("vs-pr.php");
    }
    if ($_POST["type"]=="software") {
        redirect_to("vs-sw.php");
    }
    if ($_POST["type"]=="hardware") {
        redirect_to("vs-hw.php");
    }
    if ($_POST["type"]=="internet") {
        redirect_to("vs-int.php");
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


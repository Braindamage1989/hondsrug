<?php
    session_start();
	require_once 'includes/functions.php';
	
    
    if (isset($_POST["bool"])) {
        if ($_SESSION["bool"]="") {
            redirect_to("vs-pr.php?error=noinput");
        }
        $_SESSION["antwoorden"]["3"]=$_POST["bool"];
        $bool=$_POST["bool"];
        if ($bool=="true") {
            redirect_to("vs-pr-true.php");
        }
        redirect_to("vs-pr2.php");
    }
    
    if (isset($_POST["printer"])) {
        $_SESSION["antwoorden"]["4"]=$_POST["printer"];
        redirect_to("vs-pr-false.php");
    }
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>redirect</title>
    </head>
</html>
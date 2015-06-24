<?php
    session_start();
	require_once 'includes/functions.php';
	
    if (isset($_POST["bool"])) {
        $_SESSION["antwoorden"]["5"]=$_POST["bool"];
        $bool=$_POST["bool"];
        if ($bool=="true") {
            redirect_to("vs-int-true.php");
        }
        redirect_to("vs-int-false.php");
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
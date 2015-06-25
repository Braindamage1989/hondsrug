<?php
    session_start();
	require_once 'includes/functions.php';
    
    if (!$_POST["bool"]) {
        redirect_to("vs-int.php?error=noinput");
    }
	
    if (isset($_POST["bool"])) {
        $_SESSION["antwoorden"]["5"]=$_POST["bool"];
        $bool=$_POST["bool"];
        if ($bool=="true") {
            redirect_to("vs-int-true.php");
        }
        redirect_to("vs-int-false.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>redirect</title>
    </head>
</html>
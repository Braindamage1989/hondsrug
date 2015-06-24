<?php
    session_start();
	require_once 'includes/functions.php';
	
    if (!isset($_POST["type"])){
        redirect_to("vs-hw.php?error=noinput");
    }
    
    if (isset($_POST["problem"])) {
        $_SESSION["antwoorden"]["9"]=$_POST["problem"];
        $bool=$_POST["problem"];
        if ($bool=="anders") {
            redirect_to("vs-hw-anders.php");
        }
        redirect_to("vs-hw_end.php");
    }
?>
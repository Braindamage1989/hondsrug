<?php 
    session_start();
	require_once 'includes/functions.php';
	
    
    if (!isset($_POST["locatie"])){
        redirect_to("vragenscript.php?error=noinput");
    }
    
    $_SESSION["locatie"]=$_POST["locatie"];
    $_SESSION["antwoorden"]["0"]=$_POST["locatie"];
        
    if ($_POST["locatie"]=="Anders") {
        redirect_to("vs-anders.php");
    }
	redirect_to("vs2.php");
?>
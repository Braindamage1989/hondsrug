<?php
    session_start();
	require_once 'includes/functions.php';
    require_once 'includes/connectdb.php';
    
    
    if (isset($_POST["software"])) {
        $_SESSION["antwoorden"]["6"]=$_POST["software"];
        redirect_to("vs-sw2.php");
    }
    
    elseif (!isset($_POST["software"])){
        redirect_to("vs-sw.php?error=noinput");
    }
    
    if (isset($_POST["probleem"])) {
        $_SESSION["antwoorden"]["7"]=$_POST["probleem"];
        if ($_POST["probleem"]=='internet') {
            redirect_to("vs-int.php");
        }
        redirect_to("vs-sw3.php");
    }
    elseif (!isset($_POST["probleem"])){
        redirect_to("vs-sw2.php?error=noinput");
    }
    
    if (isset($_POST["ander"])) {
        $query="SELECT serverlicentie FROM software WHERE sw_id='". $_SESSION["antwoorden"]["6"]."'";
        $result=  mysqli_query($db, $query);
        $licentie=  mysqli_fetch_assoc($result)["serverlicentie"];
        if (!$licentie) {
            echo $query.'</br>'.$result;
            die("Database query failed.");
        }
    
        $_SESSION["antwoorden"]["8"]=$_POST["ander"];
        if ($licentie=="0") {
            redirect_to("vs-sw-local.php");
        }
        redirect_to("vs-sw-server.php");
    }
    elseif (!isset($_POST["ander"])){
        redirect_to("vs-sw3.php?error=noinput");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>redirect</title>
    </head>
</html>
<?php
    session_start();
	require_once 'includes/functions.php';
    require_once 'includes/connectdb.php';
    
    
    if (isset($_POST["software"])) {
        if ($_POST["software"]=="") {
            redirect_to("vs-sw.php?error=noinput");
        }
        $_SESSION["antwoorden"]["6"]=$_POST["software"];
        redirect_to("vs-sw2.php");
    }
    
    if (isset($_POST["probleem"])) {
        if ($_POST["probleem"]=="") {
            redirect_to("vs-sw2.php?error=noinput");
        }
        $_SESSION["antwoorden"]["7"]=$_POST["probleem"];
        if ($_POST["probleem"]=='internet') {
            $_SESSION["redirect"]=true;
            redirect_to("vs-int.php");
        }
        redirect_to("vs-sw3.php");
    }
    
    if (isset($_POST["ander"])) {
        if ($_POST["ander"]=="") {
            redirect_to("vs-sw3.php?error=noinput");
        }
        $query="SELECT serverlicentie FROM software WHERE sw_id='". $_SESSION["antwoorden"]["6"]."'";
        $result=  mysqli_query($db, $query);
        $licentie=  mysqli_fetch_assoc($result)["serverlicentie"];
        if (!$result) {
            echo $query."<br />".$licentie."<br />";
            die("Database query failed.");
        }
    
        $_SESSION["antwoorden"]["8"]=$_POST["ander"];
        if ($licentie=="0") {
            redirect_to("vs-sw-local.php");
        }
        redirect_to("vs-sw-server.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>redirect</title>
    </head>
</html>
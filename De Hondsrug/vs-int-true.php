<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>

<div class="titel2">
    <div class="container">
        <h1>Vragenscript</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        Bedankt voor het melden van uw incident. Deze is door gegeven en zal snel weer vergeten worden. Tot ziens...
        </br>
        Incident netwerkkaart kapot
        </div>
    </div>
<?php 
    require_once 'includes/footer.html'; 
?>

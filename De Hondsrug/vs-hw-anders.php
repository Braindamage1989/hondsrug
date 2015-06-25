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
        We kunnen uw probleem helaas niet vaststellen.<br />
        Neem a.u.b. contact op met de helpdesk voor verdere afhandeling.<br /> 
        Alvast zeer bedankt voor het melden.<br />
        </div>
    </div>
<?php 
    require_once 'includes/footer.html'; 
?>

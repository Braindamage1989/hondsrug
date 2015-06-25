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
        <div id="end">
            Bedankt voor het melden. Als u niet voldoende bent geinformeerd kunt u de servicedesk bellen.
            </br>
            Incident = werkt niet op werk station
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>

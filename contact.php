<?php
    session_start();
    
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="titel2">
    <div class="container">
        <h1>Contact</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
    Hoofdvestiging & centrale administratie<br />
    Winkelprinsstraat 43, Assen<br />
    Postbus 26, 9402 VH Assen<br />
    (0592) 657979<br />
    (0592) 617469 (Fax)<br />
    <br />
    E-mail<br />
    info@sg-dehondsrug.nl of gebruik het <a href="contact-form.php">e-mail formulier</a><br />
    </div>
</div>
        
<?php 
    require_once 'includes/footer.html'; 
?>
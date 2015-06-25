<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>
<?php
    if(isset($_GET["error"])&&$_GET["error"]=="noinput") {
        $error="U heeft geen optie geselecteerd</br>
            Selecteer een optie:</br></br>";
    }
    elseif (isset($_GET["error"])&&$_GET["error"]=="wronginput") {
        $error="U heeft een ongeldige optie geselecteerd</br>
            Selecteer een geldige optie:</br></br>";
    }
?>

<div class="titel2">
    <div class="container">
        <h1>Vragenscript</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        <div class='vragenscript'>
        <div id="form">
            <form action="redirect-sw.php" name="form" method="post">
                Waar loopt u tegen aan?
                </br>
                <input type="radio" name='probleem' value="start_niet">Het programma start niet op</input>
                </br>
                <input type="radio" name='probleem' value="loopt_vast">Het programma loopt vast</input>
                </br>
                <input type="radio" name='probleem' value="internet">Er is geen internet verbinding</input>
                </br>
                <input type="radio" name='probleem' value="anders">Anders</input>
                </br>
                <input type="radio" name='probleem' value="" hidden="" checked=""></input>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
            </form>
        </div>
                    </div>
                </div>
        </div>
<?php 
    require_once 'includes/footer.html'; 
?>

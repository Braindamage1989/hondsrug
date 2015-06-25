<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
    
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
            <form action="redirect-pr.php" name="form" method="post">
                Als u probeert vanaf een ander werkstation te printen, lukt dit dan?
                </br>
                <input type="radio" name='bool' value="true">Ja, dit lukt.</input>
                </br>
                <input type="radio" name='bool' value="false">Nee, dit lukt niet.</input>
                </br>
                <input type="radio" name='bool' value="" hidden="" checked=""></input>
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

<?php 
    session_start();
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
                Werkt De aplicatie wel op een ander werk station?
                </br>
                <input type="radio" name='ander' value="true">Ja, dit werkt</input>
                </br>
                <input type="radio" name='ander' value="false">Nee, dit werkt niet</input>
                </br>
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

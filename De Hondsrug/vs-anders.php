<?php 
    session_start();
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
        <div>
            <div class='vragenscript'>
                <div id="form">
                    <form action="vs-anders-end.php" name="form" method="post">
                        Waarmee ervaart u een probleem?
                        </br>
                        <input type='radio' name='probleem' value="website">De website</input>
                        </br>
                        <input type='radio' name='probleem' value="studievoortgang">De studievoortgang</input>
                        </br >
                        <input type='radio' name='probleem' value="anders">Anders</input>
                        </br>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                        <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
                    </div>
                         </form>
                </div>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>

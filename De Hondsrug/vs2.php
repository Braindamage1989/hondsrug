<?php 
    session_start();
    require 'includes/connectdb.php';
    require_once 'includes/header.php';

    if(isset($_GET["error"])&&$_GET["error"]=="noinput") {
        $error="U heeft niks ingevoerd.</br>
           Voer hieronder de ID-code van uw werkstation in.</br></br>";
    }
    elseif (isset($_GET["error"])&&$_GET["error"]=="wronginput") {
        $error="De door u ingevoerde ID-code is niet geldig of van uw aangegeven locatie.</br>
            Voer de juiste ID-code in.</br></br>";
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
                        <form action="redirect1.php" name="form" method="post">
                            Wat is de ID van uw werkstation?
                            </br>
                            <input type="text" name='id' value="" placeholder="Voer hier het WS-ID in"></input>
                            </br>
                            </br>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                            <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
                    
                         </form>
                        </div>
                </div>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>

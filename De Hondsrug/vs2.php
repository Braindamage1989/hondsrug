<?php session_start(); ?>
<?php
    if(isset($_GET["error"])&&$_GET["error"]=="noinput") {
        $error="U heeft niks ingevoerd.</br>
           Voer hieronder de ID-code van uw werkstation in.</br></br>";
    }
    elseif (isset($_GET["error"])&&$_GET["error"]=="wronginput") {
        $error="De door u ingevoerde ID-code is niet geldig of van uw aangegeven locatie.</br>
            Voer de juiste ID-code in.</br></br>";
    }
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vs2</title>
    </head>
    <body>
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        <div id="form">
            <form action="redirect1.php" name="form" method="post">
                Wat is de ID van uw werkstation?
                </br>
                <input type="text" name='id' value="" placeholder="Voer hier het WS-ID in"></input>
                </br>
                <input type="submit" name="submit" value="Return" />
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

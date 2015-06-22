<?php session_start(); ?>
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
            <form action="redirect2.php" name="form" method="post">
                Waarmee heeft u een probleem?
                </br>
                <input type="radio" name='type' value="software">Software</input>
                </br>
                <input type="radio" name='type' value="werkstation">Werkstation</input>
                </br>
                <input type="radio" name='type' value="printer">Printer/Plotter</input>
                </br>
                <input type="radio" name='type' value="internet">Internet</input>
                </br>
                <input type="submit" name="submit" value="Return" />
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

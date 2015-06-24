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
        <title>Vragenscript - Hardware</title>
    </head>
    <body>
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        <div id="form">
            <form action="redirect-hw.php" name="form" method="post">
                Kies de beste beschrijving van uw probleem:
                </br>
                <input type="radio" name='problem' value="opstart">Het werkstation wil niet opstarten.</input>
                </br>
                <input type="radio" name='problem' value="afsluiten">Het werkstation sluit zichzelf automatisch af.</input>
                </br>
                <input type="radio" name='problem' value="beeldscherm">Het beeldscherm werkt niet.</input>
                </br>
                <input type="radio" name='problem' value="muis/toetsenbord">De muis en/of toetsenbord doet het niet.</input>
                </br>
                <input type="radio" name='problem' value="anders">Anders</input>
                </br>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>


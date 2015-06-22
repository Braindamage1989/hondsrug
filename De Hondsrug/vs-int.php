<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vragenscript - Internet</title>
    </head>
    <body>
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        <div id="form">
            <form action="redirect-sw0.php" name="form" method="post">
                Wat is de naam van de applicatie?
                </br>
                <input type="text" name='id' value="" placeholder="Voer hier het WS-ID in"></input>
                </br>
                <input type="submit" name="submit" value="Return" />
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

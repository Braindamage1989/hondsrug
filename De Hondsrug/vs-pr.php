<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vragenscript - Printer</title>
    </head>
    <body>
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        <div id="form">
            <form action="redirect-pr.php" name="form" method="post">
                Als u probeert vanaf een ander werkstation te printen, lukt dit dan?
                </br>
                <input type="radio" name='bool' value="true">Ja, dit lukt.</input>
                </br>
                <input type="radio" name='bool' value="false">Nee, dit lukt niet.</input>
                </br>
                <input type="submit" name="submit" value="Return" />
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

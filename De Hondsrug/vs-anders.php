<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="form">
            <form action="vs-anders-end.php" name="form" method="post">
                Waarmee ervaart u een probleem?
                </br>
                <input type='radio' name='probleem' value="Anloo">De website</input>
                </br>
                <input type='radio' name='probleem' value="Borger">De studievoortgang</input>
                </br >
                <input type='radio' name='probleem' value="Anders">Anders</input>
                </br>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

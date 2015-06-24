<?php session_start(); ?>

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
            <form action="redirect-sw.php" name="form" method="post">
                Werkt De aplicatie wel op een ander werk station?
                </br>
                <input type="radio" name='ander' value="true">Ja, dit werkt</input>
                </br>
                <input type="radio" name='ander' value="false">Nee, dit werkt niet</input>
                </br>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

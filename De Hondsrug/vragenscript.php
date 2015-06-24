<?php 
    session_start();
    require 'includes/connectdb.php';
?>
<?php
    $_SESSION=[];

    $query="SELECT hw_id FROM hardware WHERE soort_hw='werkstation'";
    $result=  mysqli_query($db, $query);

    if (!$result)   {
        echo $result;
        die("Database query failed.");
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
        <title>Vragenscript</title>
    </head>
    <body>
        <div id="form">
            <form action="redirect0.php" name="form" method="post">
                Op welke locatie bevind u zich?
                </br>
                <select name="locatie">
                    <option value="Anloo">Anloo</option>
                    <option value="Borger">Borger</option>
                    <option value="Gasselte">Gasselte</option>
                    <option value="Gieten">Gieten</option>
                    <option value="Gieterveen">Gieterveen</option>
                    <option value="Grolloo">Grolloo</option>
                    <option value="Hoofkantoor">Hoofdkantoor</option>
                    <option value="Anders">Anders</option>
                </select>
                </br>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>



                    
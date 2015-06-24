<?php 
    session_start();
    require_once 'includes/connectdb.php';
?>

<?php
    
    $query="SELECT DISTINCT sw.sw_id, sw.uitgebreidde_naam "
            . "FROM software sw "
            . "JOIN geinstalleerde_software gs ON gs.sw_id=sw.sw_id "
            . "JOIN hardware hw ON hw.hw_id=gs.hw_id "
            . "WHERE hw.hw_id='".$_SESSION["antwoorden"]["1"]."' "
            . "OR hw.hw_id IN "
                . "(SELECT hw.hw_id "
                . "FROM hardware hw "
                . "WHERE hw.soort_hw='server' "
                . "AND hw.locatie='".$_SESSION["locatie"]."')";
    $result=  mysqli_query($db, $query);
    if (!$result) {
        echo $query.'</br>'.$result;
        die("Database query failed.");
    }
?>

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
        <title>Vragenscript - Software</title>
    </head>
    <body>
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        <div id="form">
            <form action="redirect-sw.php" name="form" method="post">
                Wat is de naam van de applicatie?
                </br>
                <select name="software">
                    <?php
                        while ($array=  mysqli_fetch_assoc($result)) {
                            echo "<option value='".$array["sw_id"]."'>".$array["uitgebreidde_naam"]."</option>";
                        }
                    ?>
                </select>
                </br>
                <input type="submit" name="submit" value="Return" />
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>

<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
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
        <div class='vragenscript'>
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
                <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
            </form>
        </div>
                    </div>
                </div>
        </div>
<?php 
    require_once 'includes/footer.html'; 
?>

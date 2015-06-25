<?php 
    session_start();
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
    
    if(isset($_GET["error"])&&$_GET["error"]=="noinput") {
        $error="U heeft geen optie geselecteerd</br>
            Selecteer een optie:</br></br>";
    }
    elseif (isset($_GET["error"])&&$_GET["error"]=="wronginput") {
        $error="U heeft een ongeldige optie geselecteerd</br>
            Selecteer een geldige optie:</br></br>";
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
            <form action="redirect2.php" name="form" method="post">
                Waarmee heeft u een probleem?
                </br>
                <input type="radio" name='type' value="software">Software</input>
                </br>
                <input type="radio" name='type' value="hardware">Werkstation</input>
                </br>
                <input type="radio" name='type' value="printer">Printer/Plotter</input>
                </br>
                <input type="radio" name='type' value="internet">Internet</input>
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

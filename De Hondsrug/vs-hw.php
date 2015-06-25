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
                <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
                    </div>
                         </form>
                </div>
        </div>
<?php 
    require_once 'includes/footer.html'; 
?>


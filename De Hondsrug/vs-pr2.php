<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>
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
<?php
    
    $query="SELECT hw_id "
            . "FROM hardware "
            . "WHERE (soort_hw='printer' "
            . "OR soort_hw='plotter') "
            . "AND locatie='".$_SESSION["locatie"]."'";
    $result=  mysqli_query($db, $query);
    if (!$result){
        echo $query."</br>".$result."</br>";
        die("Database query failed.");
    }
    
    while ($value=  mysqli_fetch_assoc($result)) {
        $array[]=$value["hw_id"];
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
        <div id='form'>
            <form action="redirect-pr.php" name="form" method="post">
                Wat is de ID-code van de printer/plotter?</br>
                <select name="printer">
                    <?php
                        foreach ($array as $value) {
                            echo "<option value='".$value."'>".$value."</option>";
                        }    
                    ?>
                    </br>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                    <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
                </select>
            </form>
        </div>
                    </div>
                </div>
        </div>
<?php 
    require_once 'includes/footer.html'; 
?>

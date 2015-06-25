<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
    
    if (!isset($_POST["probleem"])) {
        redirect_to("vs-anders.php?error=noinput");        
    }
    
     $_SESSION["antwoorden"]["10"]=$_POST["probleem"];
?>
<?php  
    $needed_answers=[0,10];
    $locatie="anders";
    $hw_id="";
    $beschrijving=$_SESSION["antwoorden"]["10"];
    $sw_id="";
    $user_id=$_SESSION["id"];
    if ($_SESSION["antwoorden"]["0"]==true) $impact=1; else $impact=2;
    
   $query="INSERT INTO `de hondsrug`.`incidenten` "
               . "(`id`, `omschrijving`, `workaround`, `datum`, `starttijd`, `eindtijd`, `hw_id`, `sw_id`, `urgentie`, `impact`, `status`, `soort`, `toegekend_aan`, `melder`) "
           . "VALUES "
               . "(NULL, '".$beschrijving."', 'gfs', '".date("d-m-Y")."', '".date("H:i:s")."', NULL, '".$hw_id."', '".$sw_id."', '1', '".$impact."', '1', 'vragenscript', '1', '".$user_id."');";
    $result=  mysqli_query($db, $query);
    if (!$result) {
        echo $query.'<br />'.$result;
        die('Database query failed.');
    }
    
    $inc_id=  mysqli_insert_id($db);
    
    $query="SELECT id FROM gegeven_antwoord ORDER BY id DESC LIMIT 1";
    $result=  mysqli_query($db, $query);
    $ant_id=  mysqli_fetch_assoc($result)["id"];
    if (!$result) {
        echo $query;
        die('Database query failed.');
    }
    
    foreach ($needed_answers as $vrg_id) {
        $ant_id++;
        $query="INSERT INTO `de hondsrug`.`gegeven_antwoord` (id,vrg_id,inc_id,gegeven_antwoord) VALUES (".$ant_id.", '".$vrg_id."', '".$inc_id."', '".$_SESSION["antwoorden"][$vrg_id]."')";
        $result=  mysqli_query($db, $query);
        if (!$result) {
            echo $query;
            die('Database query failed.');
        }
    }
    
?>

<div class="titel2">
    <div class="container">
        <h1>Vragenscript</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <?php
        // put your code here
        ?>
        Bedankt voor het doorgeven van dit probleem.</br>
        Uw probleem is doorgegeven en zal zo snel mogelijk behandeld worden.</br>
        <br />
        Mocht u toch graag verder geholpen worden, neemt u dan contact op met de helpdesk<br />
        Voor de contactgegevens kunt u naar de contact <a href="contact.php">pagina gaan</a>.
</div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>

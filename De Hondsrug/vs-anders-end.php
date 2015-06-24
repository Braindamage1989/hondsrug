<?php
    session_start();
    
    if (!isset($_POST["probleem"])) {
        redirect_to("vs-anders.php?error=noinput");        
    }
    
     $_SESSION["antwoorden"]["10"]=$_POST["probleem"];
?>
<?php  
    require_once 'includes/connnectdb.php';
    
    $needed_answers=[0,10];    
    
   $query="INSERT INTO `hondsrug`.`incidenten` "
               . "(`id`, `omschrijving`, `workaround`, `datum`, `starttijd`, `eindtijd`, `hw_id`, `sw_id`, `urgentie`, `impact`, `status`, `soort`, `toegekend_aan`, `melder`) "
           . "VALUES "
               . "(NULL, 'fjsdfdsa', 'gfs', '00-00-000', '00:00:00', NULL, 'HFK003', NULL, '1', '1', '1', 'asdfh', '1', '2');";
    $result=  mysqli_query($db, $query);
    if (!$result) {
        echo $query.'<br />'.$result;
        die('Database query failed.');
    }
    
    echo 'vvv Pay Attention!! vvv';
    //get inc_id !!
    $inc_id="";
    
    foreach ($needed_answer as $vrg_id) {
        $query="INSERT INTO `hondsrug`.`gegeven_antwoorden` (id,vrg_id,inc_id,gegeven_antwoord) VALUES (NULL, ".$vrg_id.", ".$inc_id.", ".$_SESSION["antwoorden"][$vrg_id].")";
        $result=  mysqli_query($db, $query);
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
        <title>Vragenscript - finish</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        Bedankt voor het doorgeven van dit probleem.</br>
        Uw probleem is doorgegeven en zal zo snel mogelijk behandelt worden.</br>
    </body>
</html>

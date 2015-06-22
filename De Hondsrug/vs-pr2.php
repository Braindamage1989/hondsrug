<?php 
    session_start();
    require_once 'includes/connectdb.php';
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
        <diff id='form'>
            <form action="redirect-pr.php" name="form" method="post">
                Wat is de ID-code van de printer/plotter?</br>
                <select name="printer">
                    <?php
                        foreach ($array as $value) {
                            echo "<option value='".$value."'>".$value."</option>";
                        }    
                    ?>
                    <input type="submit" name="submit" value="Return" />
                    <input type="submit" name="submit" value="Submit" />
                </select>
            </form>
        </diff>
    </body>
</html>

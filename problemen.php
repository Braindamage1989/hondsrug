<?php
    session_start();

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $query_problemen = "SELECT * FROM problemen";
    $result_problemen = mysqli_query($db, $query_problemen);
    
    /*
    $query_incidenten = "SELECT * FROM incidenten_probleem";
    $result_incidenten = mysqli_query($db, $query_incidenten);
    
    while($row = mysqli_fetch_assoc($result_gebruikers)) :
        $array_gebruikers[$row['id']] .= $row['voornaam']." ".$row['achternaam'];
    endwhile;
    */
    
    if(isset($_POST['inline'])):
        $_SESSION['ids'] = $_POST['id'];
        header('Location: incidenten_inline.php');
        exit;
    endif;
    
    if(isset($_POST['toevoegen'])):
        header('Location: incident_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        foreach($_POST['id'] as $k => $v) :
            $update = "UPDATE incidenten SET status='9' WHERE id='$v'";
            mysqli_query($db, $update);
        endforeach;
    endif;
?>
 <div class="titel2">
    <div class="container">
        <h1>Problemen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <form action="" method="POST">
                <table class="table">
                    <tr>
                        <td></td>
                        <td><b>ID</b></td>
                        <td><b>Omschrijving</b></td>
                        <td><b>Known Error</b></td>
                        <td><b>Toegekend aan</b></td>
                        <td><b>Workaround</b></td>
                        <td><b>Status</b></td>
                        <td><b>Incidentnummers</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result_problemen)):
                    ?>
                        <tr>
                    <?php
                            foreach($row as $k => $v):
                                echo "<td>$v</td>";
                            endforeach;

                            echo "<td>";

                            $query_incidenten = "SELECT inc_id FROM incidenten_probleem WHERE pro_id=".$row['id']."";
                            $result_incidenten = mysqli_query($db, $query_incidenten);

                            while($incidenten = mysqli_fetch_assoc($result_incidenten)):
                                $aantal = count($incidenten);
                                foreach($incidenten as $k => $v):
                                        echo "$v,";
                                endforeach;
                            endwhile;

                            echo "</td>";
                    ?>
                        </tr>
                    <?php
                        endwhile;
                    ?>
                </table>
        </div>
        <div class='col-md-1'>
            <div class='submenu'>
                <input type="submit" name="toevoegen" value="Toevoegen" class="btn btn-primary"/>
                <input type="submit" name="inline" value="Bewerk" class="btn btn-default"/>
                <input type="submit" name="verwijderen" value="Verwijderen" class="btn btn-default"/>
                <br />Klik op omschrijving om details van incident te tonen/bewerken
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>
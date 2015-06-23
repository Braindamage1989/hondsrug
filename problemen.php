<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $query_problemen = "SELECT * FROM problemen WHERE status !=9";
    $result_problemen = mysqli_query($db, $query_problemen);
    
    /*
    $query_incidenten = "SELECT * FROM incidenten_probleem";
    $result_incidenten = mysqli_query($db, $query_incidenten);
    */
    
    $query_gebruikers = "SELECT id, voornaam, achternaam FROM gebruikers";
    $result_gebruikers = mysqli_query($db, $query_gebruikers);
    
    while($row = mysqli_fetch_assoc($result_gebruikers)) :
        $array_gebruikers[$row['id']] .= $row['voornaam']." ".$row['achternaam'];
    endwhile;
    
    if(isset($_POST['toevoegen'])):
        header('Location: probleem_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        foreach($_POST['id'] as $k => $v) :
            $update = "UPDATE problemen SET status='9' WHERE id='$v'";
            mysqli_query($db, $update);
        endforeach;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
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
                    echo "<td><input type=\"checkbox\" name=\"id[]\" value=\"".$row['id']."\"></td>\n";
                    foreach($row as $k => $v):
                        if($k == 'omschrijving'):
                            echo "<td><a href=\"probleem_detail.php?id=".$row['id']."\">$v</a>";
                        elseif($k == 'toegekend_aan') :
                            echo "<td>$array_gebruikers[$v]</td>";
                        elseif($k == 'status') :
                            if($v == 1):
                                echo "<td>Open</td>";
                            elseif ($v == 3):
                                echo "<td>In behandeling</td>";
                            elseif ($v == 5):
                                echo "<td>Afgesloten</td>";
                            endif;
                        elseif($k == 'known_error') :
                            if($v == 0):
                                echo "<td>Nee</td>";
                            elseif ($v == 1):
                                echo "<td>Ja</td>";
                            endif;
                        else:
                            echo "<td>$v</td>";
                        endif;
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
        <input type="submit" name="toevoegen" value="Toevoegen" />
        <input type="submit" name="verwijderen" value="Verwijderen" />
        <br />Klik op omschrijving om details van incident te tonen/bewerken
    </form>
</body>
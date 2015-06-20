<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $query_all = "SELECT id, omschrijving, datum, starttijd, hw_id, sw_id, toegekend_aan, melder FROM incidenten WHERE status != '9'";
    $result_all = mysqli_query($db, $query_all);
    
    // kan weg
    $query_one = "SELECT id, omschrijving, datum, starttijd, hw_id, sw_id, toegekend_aan, melder FROM incidenten LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    $query_prioriteit = "SELECT id, urgentie, impact FROM incidenten WHERE status != '9'";
    $result_prioriteit = mysqli_query($db, $query_prioriteit);
    
    while($row = mysqli_fetch_assoc($result_prioriteit)) :
        $prioriteit = $row['urgentie'] * $row['impact'];
        if($prioriteit == 1) :
            $prioriteit = "Zeer laag";
        elseif($prioriteit == 2):
            $prioriteit = "Laag";
        elseif($prioriteit == 3):
            $prioriteit = "Gemiddeld";
        elseif($prioriteit == 6):
            $prioriteit = "Hoog";
        elseif($prioriteit == 9):
            $prioriteit = "Zeer hoog";
        endif;
        $array_prioriteit[$row['id']] .= $prioriteit;
    endwhile;
    
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
<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td></td>
                <?php
                    // veranderen naar statisch
                    foreach($titles as $k => $v):
                        echo "<td><b>$k</b></td>\n";
                    endforeach;
                ?>
                <td><b>Prioriteit</b></td>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result_all)):
            ?>
                <tr>
            <?php
                    foreach($row as $k => $v):
                        if($k == 'id'):
                            echo "<td><input type=\"checkbox\" name=\"id[]\" value=\"$v\"></td>\n";
                        endif;
                        echo "<td>$v</td>\n";
                    endforeach;
                    
                    foreach($array_prioriteit as $k => $v):
                        if($row['id'] == $k) :
                            echo "<td>$v</td>";
                        endif;
                    endforeach;
            ?>
                </tr>
            <?php
                endwhile;
            ?>
            
        </table>
        <input type="submit" name="toevoegen" value="Toevoegen" />
        <input type="submit" name="inline" value="Bewerk" />
        <input type="submit" name="detail" value="Toon details" />
        <input type="submit" name="verwijderen" value="Verwijderen" />
    </form>
</body>
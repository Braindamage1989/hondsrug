<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    error_reporting(0);

    require_once 'includes/connectdb.php';
    require_once 'includes/header-tool.php';
    
    $melding = "";
    
    $query_all = "SELECT id, omschrijving, soort, datum, starttijd, hw_id, sw_id, toegekend_aan, melder, status FROM incidenten WHERE status != '9'";
    $result_all = mysqli_query($db, $query_all);
    
    $query_prioriteit = "SELECT id, urgentie, impact FROM incidenten WHERE status != '9'";
    $result_prioriteit = mysqli_query($db, $query_prioriteit);
    
    $query_gebruikers = "SELECT id, voornaam, achternaam, functie FROM gebruikers";
    $result_gebruikers = mysqli_query($db, $query_gebruikers);
    
    while($row = mysqli_fetch_assoc($result_prioriteit)) :
        $prioriteit = $row['urgentie'] * $row['impact'];
        if($prioriteit == 1) :
            $prioriteit = "Zeer laag";
        elseif($prioriteit == 2):
            $prioriteit = "Laag";
        elseif($prioriteit == 3):
            $prioriteit = "Gemiddeld";
        elseif($prioriteit == 4):
            $prioriteit = "Gemiddeld";
        elseif($prioriteit == 6):
            $prioriteit = "Hoog";
        elseif($prioriteit == 9):
            $prioriteit = "Zeer hoog";
        endif;
        $array_prioriteit[$row['id']] .= $prioriteit;
    endwhile;
    
    while($row = mysqli_fetch_assoc($result_gebruikers)) :
        $array_gebruikers[$row['id']] .= $row['voornaam']." ".$row['achternaam'];
    endwhile;
    
    if(isset($_POST['inline'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            $_SESSION['ids'] = $_POST['id'];
            header('Location: incidenten_inline.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['toevoegen'])):
        header('Location: incident_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            foreach($_POST['id'] as $k => $v) :
                $update = "UPDATE incidenten SET status='9' WHERE id='$v'";
                mysqli_query($db, $update);
                header('Location: incidenten.php');
                exit;
            endforeach;
        endif;
    endif;
?>
 <div class="titel2">
    <div class="container">
        <h1>Incidenten</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <tr>
                        <td></td>
                        <td><b>Omschrijving</b></td>
                        <td><b>Soort</b></td>
                        <td><b>Datum</b></td>
                        <td><b>Starttijd</b></td>
                        <td><b>Hardware ID</b></td>
                        <td><b>Software ID</b></td>
                        <td><b>Toegekend aan</b></td>
                        <td><b>Melder</b></td>
                        <td><b>Status</b></td>
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
                            elseif ($k == 'omschrijving') :
                                echo "<td><a href=\"incident_detail.php?id=".$row['id']."\">$v</a>";
                            elseif($k == 'melder') :
                                echo "<td>$array_gebruikers[$v]</td>";
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
                            elseif($k == 'datum'):
                                $timestamp = explode("-", $v);
                                echo "<td>$timestamp[2]-$timestamp[1]-$timestamp[0]</td>\n";
                            elseif($k == starttijd) :
                                $time = explode(":", $v);
                                $second = explode(".",$time[2]);
                                echo "<td>$time[0]:$time[1]:$second[0]</td>\n";
                            else:
                                echo "<td>$v</td>\n";
                            endif;
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
        </div>
        <div class='col-md-1'>
            <div class='submenu'>
                <input type="submit" name="toevoegen" value="Toevoegen" class="btn btn-primary"/>
                <input type="submit" name="inline" value="Bewerk" class="btn btn-default"/>
                <input type="submit" name="verwijderen" value="Verwijderen" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>
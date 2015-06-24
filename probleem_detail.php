<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    error_reporting(0);
    
    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $query_problemen = "SELECT * FROM problemen WHERE id=".$_GET['id']."";
    $result_problemen = mysqli_query($db, $query_problemen);
    $record = mysqli_fetch_assoc($result_problemen);
    
    $query_alle_incidenten = "SELECT id FROM incidenten";
    $result_alle_incidenten = mysqli_query($db, $query_alle_incidenten);
    
    $query_incidenten = "SELECT id, inc_id FROM incidenten_probleem WHERE pro_id=".$_GET['id']."";
    $result_incidenten = mysqli_query($db, $query_incidenten);
    
    $qry_dropdown_gebruikers = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_gebruikers = mysqli_query($db, $qry_dropdown_gebruikers);
    
    $qry_dropdown_status = "SELECT status FROM problemen WHERE id=".$_GET['id']."";
    $dropdown_status = mysqli_query($db, $qry_dropdown_status);
    
    while($gebruikers = mysqli_fetch_assoc($dropdown_gebruikers)):
        $array_gebruikers[$gebruikers['id']] .= $gebruikers['voornaam']." ".$gebruikers['achternaam'];
    endwhile;
    
    while($incidenten = mysqli_fetch_assoc($result_incidenten)):
        $incidentnummers[$incidenten['inc_id']] .= $incidenten['inc_id'];
    endwhile;
    
    while($alle_incidenten = mysqli_fetch_assoc($result_alle_incidenten)):
        $alle_incidentnummers[$alle_incidenten['id']] .= $alle_incidenten['id'];
    endwhile;
    
    while($status = mysqli_fetch_assoc($dropdown_status)):
        $array_status[] .= $status['status'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
        $update = "UPDATE problemen SET omschrijving='".$_POST['omschrijving']."',known_error='".$_POST['known_error']."',"
            . "toegekend_aan='".$_POST['toegekend_aan']."',workaround='".$_POST['workaround']."',status='".$_POST['status']."' "
            . "WHERE id=".$_GET['id']."";
        mysqli_query($db, $update);
        
        foreach($_POST['db_incidenten'] as $key => $value):
            $update_inc = "UPDATE incidenten_probleem SET inc_id='".$value."' WHERE pro_id=".$_GET['id']."";
            mysqli_query($db, $update_inc);
        endforeach;
        header('Location: problemen.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: problemen.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Omschrijving probleem</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-9">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Omschrijving</b></td>
                        <td><b>Known Error</b></td>
                        <td><b>Toegekend aan</b></td>
                        <td><b>Workaround</b></td>
                        <td><b>Status</b></td>
                        <td><b>Incidentnummers</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="id" readonly="readonly" value="<?php echo $record['id']; ?>"/></td>
                        <td><input type="text" name="omschrijving" value="<?php echo $record['omschrijving']; ?>"/></td>
                        <td><select name="known_error">
                            <?php
                                if($record['toegekend_aan'] == 0) :
                                    echo "<option value=\"0\" selected>Nee</option>\n";
                                else:
                                    echo "<option value=\"0\">Nee</option>\n";
                                endif;
                                if($record['toegekend_aan'] == 1) :
                                    echo "<option value=\"1\" selected>Ja</option>\n";
                                else:
                                    echo "<option value=\"1\">Ja</option>\n";
                                endif;
                            ?>
                        </select></td>
                        <td><select name="toegekend_aan">
                            <?php
                                foreach($array_gebruikers as $key => $value) :
                                    if($record['toegekend_aan'] == $key) :
                                        echo "<option value=\"".$key."\" selected>".$value."</option>\n";
                                    else:
                                        echo "<option value=\"".$key."\">".$value."</option>\n";
                                    endif;
                                endforeach;
                            ?>
                        </select></td>
                        <td><input type="text" name="workaround" value="<?php echo $record['workaround']; ?>"/></td>
                        <td>
                            <select name="status">
                                <?php
                                foreach($array_status as $key => $value) :
                                    if($value == $record['status']) :
                                        if($record['status'] == 1) :
                                            echo "<option value=\"1\" selected>Open</option>";
                                        else:
                                            echo "<option value=\"1\">Open</option>";
                                        endif;
                                        if($record['status'] == 3) :
                                            echo "<option value=\"3\" selected>In behandeling</option>";
                                        else:
                                            echo "<option value=\"3\">In behandeling</option>";
                                        endif;
                                        if($record['status'] == 5) :
                                            echo "<option value=\"5\" selected>Afgesloten</option>";
                                        else:
                                            echo "<option value=\"5\">Afgesloten</option>";
                                        endif;
                                        if($record['status'] == 9) :
                                            echo "<option value=\"9\" selected>Verwijderd</option>";
                                        else:
                                            echo "<option value=\"9\">Verwijderd</option>";
                                        endif;
                                    endif;
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td><select name="db_incidenten[]" multiple>
                            <?php
                                foreach($alle_incidentnummers as $key => $value) :
                                    if($value == $incidentnummers[$key]) :
                                        echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                                    else:
                                        echo "<option value=\"".$value."\">".$value."</option>\n";
                                    endif;
                                endforeach;
                            ?>
                        </select></td>
                    </tr>
                </table>
            </div>
        <div class='col-md-3'>
            <div class='submenu'>
                <input type="submit" name="opslaan" value="Opslaan" class="btn btn-primary"/>
                <input type="submit" name="overzicht" value="Terug naar overzicht" class="btn btn-default"/>
                <br />* = optioneel
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>
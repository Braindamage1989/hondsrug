<?php
    session_start();

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $query_problemen = "SELECT * FROM problemen WHERE id=".$_GET['id']."";
    $result_problemen = mysqli_query($db, $query_problemen);
    $record = mysqli_fetch_assoc($result_problemen);
    
    $query_alle_incidenten = "SELECT inc_id FROM incidenten_probleem";
    $result_alle_incidenten = mysqli_query($db, $query_alle_incidenten);
    
    $query_incidenten = "SELECT inc_id FROM incidenten_probleem WHERE pro_id=".$_GET['id']."";
    $result_incidenten = mysqli_query($db, $query_incidenten);
    
    $qry_dropdown_gebruikers = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_gebruikers = mysqli_query($db, $qry_dropdown_gebruikers);
    
    while($gebruikers = mysqli_fetch_assoc($dropdown_gebruikers)):
        $array_gebruikers[$gebruikers['id']] .= $gebruikers['voornaam']." ".$gebruikers['achternaam'];
    endwhile;
    
    while($incidenten = mysqli_fetch_assoc($result_incidenten)):
        $incidentnummers[] .= $incidenten['inc_id'];
    endwhile;
    
    while($alle_incidenten = mysqli_fetch_assoc($result_alle_incidenten)):
        $alle_incidentnummers[] .= $alle_incidenten['inc_id'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
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
        <h1>Problemen</h1>
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
                        <td><input type="text" name="known_error" value="<?php echo $record['known_error']; ?>" /></td>
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
                        <td><input type="text" name="status" value="<?php echo $record['status']; ?>"/></td>
                        <td><select name="incidenten" multiple>
                            <?php
                                foreach($alle_incidentnummers as $key => $value) :
                                    if($value == $incidentnummers[$value]) :
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
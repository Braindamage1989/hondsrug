<?php
    session_start();
    
    error_reporting(0);
    
    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $melding = "";
    $teller = 0;
    
    $query_alle_incidenten = "SELECT id FROM incidenten";
    $result_alle_incidenten = mysqli_query($db, $query_alle_incidenten);
    
    $query_incidenten = "SELECT id, inc_id FROM incidenten_probleem WHERE pro_id=".$_GET['id']."";
    $result_incidenten = mysqli_query($db, $query_incidenten);
    
    $qry_dropdown_gebruikers = "SELECT id, voornaam, achternaam FROM gebruikers WHERE functie ='Medewerker IT'";
    $dropdown_gebruikers = mysqli_query($db, $qry_dropdown_gebruikers);
    
    
    while($gebruikers = mysqli_fetch_assoc($dropdown_gebruikers)):
        $array_gebruikers[$gebruikers['id']] .= $gebruikers['voornaam']." ".$gebruikers['achternaam'];
    endwhile;
    
    while($alle_incidenten = mysqli_fetch_assoc($result_alle_incidenten)):
        $alle_incidentnummers[$alle_incidenten['id']] .= $alle_incidenten['id'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
        if(empty($_POST['omschrijving'])) :
            $melding .= "<font color=\"red\"><b>Omschrijving mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['db_incidenten'])) :
            $melding .= "<font color=\"red\"><b>Er zijn geen incidentnummer geselecteerd</b></font><br/>";
            $teller++;
        endif;
        if($teller == 0) :
            $update = "UPDATE problemen SET omschrijving='".$_POST['omschrijving']."',known_error='".$_POST['known_error']."',"
                . "toegekend_aan='".$_POST['toegekend_aan']."',workaround='".$_POST['workaround']."',status='".$_POST['status']."' "
                . "WHERE id=".$_GET['id']."";
            mysqli_query($db, $update);

            foreach($_POST['db_incidenten'] as $key => $value):
                $update_inc = "UPDATE incidenten_probleem SET inc_id='".$value."' WHERE pro_id=".$_GET['id']."";
                mysqli_query($db, $update_inc);
                echo $update_inc;
            endforeach;
            header('Location: problemen.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: problemen.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Probleem toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-9">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>Omschrijving</b></td>
                        <td><b>Known Error</b></td>
                        <td><b>Toegekend aan</b></td>
                        <td><b>Workaround</b></td>
                        <td><b>Status</b></td>
                        <td><b>Incidentnummers</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="omschrijving" /></td>
                        <td><select name="known_error">
                            <option value="0">Nee</option>
                            <option value="1">Ja</option>
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
                        <td><input type="text" name="workaround" /></td>
                        <td>
                            <select name="status">
                                <option value="1">Open</option>
                                <option value="3">In behandeling</option>
                                <option value="5">Afgesloten</option>
                            </select>
                        </td>
                        <td><select name="db_incidenten[]" multiple>
                            <?php
                                foreach($alle_incidentnummers as $key => $value) :
                                    echo "<option value=\"".$value."\">".$value."</option>\n";
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
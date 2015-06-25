<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }

    require_once 'includes/connectdb.php';
    require_once 'includes/header.php';
    
    $melding = "";
    $teller = 0;
    
    $qry_dropdown_toegekend_aan = "SELECT id, voornaam, achternaam FROM gebruikers WHERE functie ='Medewerker IT'";
    $dropdown_toegekend_aan = mysqli_query($db, $qry_dropdown_toegekend_aan);
    
    $qry_dropdown_melder = "SELECT id, voornaam, achternaam FROM gebruikers WHERE functie='Docent' OR functie='Leerling'";
    $dropdown_melder = mysqli_query($db, $qry_dropdown_melder);
    
    $qry_dropdown_hw_id = "SELECT hw_id FROM hardware";
    $dropdown_hw_id = mysqli_query($db, $qry_dropdown_hw_id);
    
    $qry_dropdown_sw_id = "SELECT sw_id FROM software";
    $dropdown_sw_id = mysqli_query($db, $qry_dropdown_sw_id);
    
    if(isset($_POST['opslaan'])):
        if(empty($_POST['omschrijving'])) :
            $melding .= "<font color=\"red\"><b>Omschrijving mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['datum'])) :
            $melding .= "<font color=\"red\"><b>Datum mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['starttijd'])) :
            $melding .= "<font color=\"red\"><b>Starttijd mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['soort'])) :
            $melding .= "<font color=\"red\"><b>Soort mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if($teller == 0) :
            $insert = "INSERT INTO incidenten (omschrijving,soort,workaround,datum,starttijd,eindtijd,hw_id,sw_id,urgentie,impact,status,toegekend_aan,melder) "
                . "VALUES ('".$_POST['omschrijving']."','Melding', '".$_POST['workaround']."','".$_POST['datum']."','".$_POST['starttijd']."','".$_POST['eindtijd']."','".$_POST['hw_id']."','".$_POST['sw_id']."','".$_POST['urgentie']."','".$_POST['impact']."','1','".$_POST['toegekend_aan']."','".$_POST['melder']."')";
            mysqli_query($db, $insert);
            header('Location: incidenten.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: incidenten.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Incident toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>Omschrijving</b></td>
                        <td><b>Workaround *</b></td>
                        <td><b>Datum</b></td>
                        <td><b>Starttijd</b></td>
                        <td><b>Eindtijd *</b></td>
                        <td><b>Hardware ID</b></td>
                        <td><b>Software ID *</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="omschrijving" /></td>
                        <td><input type="text" name="workaround" /></td>
                        <td><input type="text" name="datum" readonly="readonly" value="<?php echo date('d-m-Y') ?>" /></td>
                        <td><input type="text" name="starttijd" readonly="readonly" value="<?php echo date('H:i:s') ?>" /></td>
                        <td><input type="text" placeholder="invoeren als xx:xx:xx" name="eindtijd" /></td>
                        <td><select name="hw_id">
                            <?php
                                while($hw_id = mysqli_fetch_assoc($dropdown_hw_id)):
                                    echo "<option value=\"".$hw_id['hw_id']."\">".$hw_id['hw_id']."</option>\n";
                                endwhile;
                            ?>
                        </select></td>
                        <td><select name="sw_id">
                            <?php
                                echo "<option value=\"\" ></option>";
                                while($sw_id = mysqli_fetch_assoc($dropdown_sw_id)):
                                    echo "<option value=\"".$sw_id['sw_id']."\">".$sw_id['sw_id']."</option>\n";
                                endwhile;
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><b>Urgentie</b></td>
                        <td><b>Impact</b></td>
                        <td><b>Soort</b></td>
                        <td><b>Toegekend aan</b></td>
                        <td><b>Melder</b></td>
                    </tr>
                    <tr>
                        <td>
                            <select name="urgentie">
                                <option value="1">Laag</option>
                                <option value="2">Gemiddeld</option>
                                <option value="3">Hoog</option>
                            </select>
                        </td>
                        <td>
                            <select name="impact">
                                <option value="1">Laag</option>
                                <option value="2">Gemiddeld</option>
                                <option value="3">Hoog</option>
                            </select>
                        </td>
                        <td><input type="text" name="soort" readonly="readonly" value="Melding"/></td>
                        <td><select name="toegekend_aan">
                            <?php
                                while($medewerker = mysqli_fetch_assoc($dropdown_toegekend_aan)):
                                    echo "<option value=\"".$medewerker['id']."\">".$medewerker['voornaam']." ".$medewerker['achternaam']."</option>\n";
                                endwhile;
                            ?>
                        </select></td>
                        <td><select name="melder">
                            <?php
                                while($melder = mysqli_fetch_assoc($dropdown_melder)):
                                    echo "<option value=\"".$melder['id']."\">".$melder['voornaam']." ".$melder['achternaam']."</option>\n";
                                endwhile;
                            ?>
                        </select></td>
                    </tr>

                </table>
        </div>
        <div class='col-md-2'
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
    require_once 'includes/footer.html'; 
?>
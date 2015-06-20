<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $qry_dropdown_toegekend_aan = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_toegekend_aan = mysqli_query($db, $qry_dropdown_toegekend_aan);
    
    $qry_dropdown_melder = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_melder = mysqli_query($db, $qry_dropdown_melder);
    
    $qry_dropdown_hw_id = "SELECT hw_id FROM hardware";
    $dropdown_hw_id = mysqli_query($db, $qry_dropdown_hw_id);
    
    $qry_dropdown_sw_id = "SELECT sw_id FROM software";
    $dropdown_sw_id = mysqli_query($db, $qry_dropdown_sw_id);
    
    if(isset($_POST['opslaan'])):
        $insert = "INSERT INTO incidenten (omschrijving,workaround,datum,starttijd,eindtijd,hw_id,sw_id,urgentie,impact,status,soort,toegekend_aan,melder) "
            . "VALUES ('".$_POST['omschrijving']."','".$_POST['workaround']."','".$_POST['datum']."','".$_POST['starttijd']."','".$_POST['eindtijd']."','".$_POST['hw_id']."','".$_POST['sw_id']."','".$_POST['urgentie']."','".$_POST['impact']."','".$_POST['status']."','".$_POST['soort']."','".$_POST['toegekend_aan']."','".$_POST['melder']."')";
        mysqli_query($db, $insert);
        header('Location: incidenten.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: incidenten.php');
        exit;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td><b>Omschrijving</b></td>
                <td><b>Workaround(optioneel)</b></td>
                <td><b>Datum</b></td>
                <td><b>Starttijd</b></td>
                <td><b>Eindtijd</b></td>
                <td><b>Hardware ID</b></td>
                <td><b>Software ID(optioneel)</b></td>
            </tr>
            <tr>
                <td><input type="text" name="omschrijving" /></td>
                <td><input type="text" name="workaround" /></td>
                <td><input type="text" name="datum" readonly="readonly" value="<?php echo date('d-m-Y') ?>" /></td>
                <td><input type="text" name="starttijd" readonly="readonly" value="<?php echo date('H:i:s') ?>" /></td>
                <td><input type="text" name="eindtijd" /></td>
                <td><select name="hw_id">
                    <?php
                        while($hw_id = mysqli_fetch_assoc($dropdown_hw_id)):
                            echo "<option value=\"".$hw_id['hw_id']."\">".$hw_id['hw_id']."</option>\n";
                        endwhile;
                    ?>
                </select></td>
                <td><select name="sw_id">
                    <?php
                        while($sw_id = mysqli_fetch_assoc($dropdown_sw_id)):
                            echo "<option value=\"".$sw_id['sw_id']."\">".$sw_id['sw_id']."</option>\n";
                        endwhile;
                    ?>
                </select></td>
            </tr>
            <tr>
                <td><b>Urgentie</b></td>
                <td><b>Impact</b></td>
                <td><b>Status</b></td>
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
                <td><input type="text" name="status" /></td>
                <td><input type="text" name="soort" /></td>
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
        <input type="submit" name="opslaan" value="Opslaan" />
        <input type="submit" name="overzicht" value="Terug naar overzicht" /> 
    </form>
</body>
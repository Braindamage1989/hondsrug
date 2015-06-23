<?php
    session_start();
    require_once 'includes/connectdb.php';
    
    $query_detail = "SELECT * FROM incidenten WHERE id=".$_GET['id']."";
    $result_detail = mysqli_query($db, $query_detail);
    $record = mysqli_fetch_assoc($result_detail);
    
    $qry_dropdown_gebruikers = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_gebruikers = mysqli_query($db, $qry_dropdown_gebruikers);
    
    $qry_dropdown_hw_id = "SELECT hw_id FROM hardware";
    $dropdown_hw_id = mysqli_query($db, $qry_dropdown_hw_id);
    
    $qry_dropdown_sw_id = "SELECT sw_id FROM software";
    $dropdown_sw_id = mysqli_query($db, $qry_dropdown_sw_id);
    
    $qry_dropdown_status = "SELECT status FROM incidenten WHERE id=".$_GET['id']."";
    $dropdown_status = mysqli_query($db, $qry_dropdown_status);
    
    $qry_dropdown_prioriteit = "SELECT impact, urgentie FROM incidenten WHERE id=".$_GET['id']."";
    $dropdown_prioriteit = mysqli_query($db, $qry_dropdown_prioriteit);
    
    while($hw_id = mysqli_fetch_assoc($dropdown_hw_id)):
        $array_hw_id[] .= $hw_id['hw_id'];
    endwhile;
    
    while($sw_id = mysqli_fetch_assoc($dropdown_sw_id)):
        $array_sw_id[] .= $sw_id['sw_id'];
    endwhile;
    
    while($status = mysqli_fetch_assoc($dropdown_status)):
        $array_status[] .= $status['status'];
    endwhile;
    
    while($gebruikers = mysqli_fetch_assoc($dropdown_gebruikers)):
        $array_gebruikers[$gebruikers['id']] .= $gebruikers['voornaam']." ".$gebruikers['achternaam'];
    endwhile;
    
    while($prioriteit = mysqli_fetch_assoc($dropdown_prioriteit)):
        $array_urgentie[] .= $prioriteit['urgentie'];
        $array_impact[] .= $prioriteit['impact'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
        $update = "UPDATE incidenten SET omschrijving='".$_POST['omschrijving']."',workaround='".$_POST['workaround']."',"
            . "datum='".$_POST['datum']."',starttijd='".$_POST['starttijd']."',eindtijd='".$_POST['eindtijd']."',hw_id='".$_POST['hw_id']."',"
            . "sw_id='".$_POST['sw_id']."',urgentie='".$_POST['urgentie']."',impact='".$_POST['impact']."',status='".$_POST['status']."',"
            . "soort='".$_POST['soort']."',toegekend_aan='".$_POST['toegekend_aan']."',melder='".$_POST['melder']."' WHERE id=".$_GET['id']."";
        mysqli_query($db, $update);
        echo $update;
        header('Location: incidenten.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: incidenten.php');
        exit;
    endif;
    
    print_r($record);
    echo "<br /> <br />";
    print_r($array_impact)
?>
<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td><b>Omschrijving</b></td>
                <td><b>Workaround *</b></td>
                <td><b>Datum</b></td>
                <td><b>Starttijd</b></td>
                <td><b>Eindtijd</b></td>
                <td><b>Hardware ID</b></td>
                <td><b>Software ID *</b></td>
            </tr>
            <tr>
                <td><input type="text" name="omschrijving" value="<?php echo $record['omschrijving']; ?>"/></td>
                <td><input type="text" name="workaround" value="<?php echo $record['workaround']; ?>"/></td>
                <td><input type="text" name="datum" readonly="readonly" value="<?php //echo date('d-m-Y') ?>" /></td>
                <td><input type="text" name="starttijd" readonly="readonly" value="<?php //echo date('H:i:s') ?>" /></td>
                <td><input type="text" name="eindtijd" value="<?php echo $record['eindtijd']; ?>"/></td>
                <td><select name="hw_id">
                    <?php
                    foreach($array_hw_id as $key => $value) :
                        if($record['hw_id'] == $value) :
                            echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                        else:
                            echo "<option value=\"".$value."\">".$value."</option>\n";
                        endif;
                    endforeach;
                    ?>
                </select></td>
                <td><select name="sw_id">
                    <?php
                        echo "<option value=\"\"></option>";
                        foreach($array_sw_id as $key => $value) :
                            if($record['sw_id'] == $value) :
                                echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                            else:
                                echo "<option value=\"".$value."\">".$value."</option>\n";
                            endif;
                        endforeach;
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
                        <?php
                        foreach($array_urgentie as $key => $value) :
                            if($value == $record['urgentie']) :
                                if($record['urgentie'] == 1) :
                                    echo "<option value=\"1\" selected>Laag</option>";
                                else:
                                    echo "<option value=\"1\">Laag</option>";
                                endif;
                                if($record['urgentie'] == 2) :
                                    echo "<option value=\"2\" selected>Gemiddeld</option>";
                                else:
                                    echo "<option value=\"2\">Gemiddeld</option>";
                                endif;
                                if($record['urgentie'] == 3) :
                                    echo "<option value=\"3\" selected>Hoog</option>";
                                else:
                                    echo "<option value=\"3\">Hoog</option>";
                                endif;
                            endif;
                        endforeach;
                        ?>
                    </select>
                </td>
                <td>
                    <select name="impact">
                        <?php
                        foreach($array_impact as $key => $value) :
                            if($value == $record['impact']) :
                                if($record['impact'] == 1) :
                                    echo "<option value=\"1\" selected>Laag</option>";
                                else:
                                    echo "<option value=\"1\">Laag</option>";
                                endif;
                                if($record['impact'] == 2) :
                                    echo "<option value=\"2\" selected>Gemiddeld</option>";
                                else:
                                    echo "<option value=\"2\">Gemiddeld</option>";
                                endif;
                                if($record['impact'] == 3) :
                                    echo "<option value=\"3\" selected>Hoog</option>";
                                else:
                                    echo "<option value=\"3\">Hoog</option>";
                                endif;
                            endif;
                        endforeach;
                        ?>
                    </select>
                </td>
                <td>
                    <select name="status">
                        <?php
                        foreach($array_status as $key => $value) :
                            if($value == $record['status']) :
                                if($record['status'] == 1) :
                                    echo "<option value=\"1\" selected>Open</option>";
                                else:
                                    echo "<option value=\"1\">Laag</option>";
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
                <td><input type="text" name="soort" /></td>
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
                <td><select name="melder">
                    <?php
                        foreach($array_gebruikers as $key => $value) :
                            if($record['melder'] == $key) :
                                echo "<option value=\"".$key."\" selected>".$value."</option>\n";
                            else:
                                echo "<option value=\"".$key."\">".$value."</option>\n";
                            endif;
                        endforeach;
                    ?>
                </select></td>
            </tr>
            
        </table>
        <input type="submit" name="opslaan" value="Opslaan" />
        <input type="submit" name="overzicht" value="Terug naar overzicht" />
        <br />* = optioneel
    </form>
</body>
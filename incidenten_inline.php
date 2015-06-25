<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    error_reporting(0);

    require_once 'includes/connectdb.php';
    require_once 'includes/header.php';
    
    $melding = "";
    $teller = 0;
    
    $ids = implode(' OR id = ', $_SESSION['ids']);
    
    $query_all = "SELECT id, omschrijving, urgentie, impact, hw_id, sw_id, toegekend_aan, melder FROM incidenten WHERE id = $ids";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT id, omschrijving, urgentie, impact, hw_id, sw_id, toegekend_aan, melder FROM incidenten LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    $qry_dropdown_medewerkers = "SELECT id, voornaam, achternaam FROM gebruikers WHERE functie ='Medewerker IT'";
    $dropdown_medewerkers = mysqli_query($db, $qry_dropdown_medewerkers);
    
    $qry_dropdown_gebruikers = "SELECT id, voornaam, achternaam FROM gebruikers WHERE functie='Docent' OR functie='Leerling'";
    $dropdown_gebruikers = mysqli_query($db, $qry_dropdown_gebruikers);
    
    $qry_dropdown_hw_id = "SELECT hw_id FROM hardware";
    $dropdown_hw_id = mysqli_query($db, $qry_dropdown_hw_id);
    
    $qry_dropdown_sw_id = "SELECT sw_id FROM software";
    $dropdown_sw_id = mysqli_query($db, $qry_dropdown_sw_id);
    
    $qry_dropdown_impact = "SELECT id, impact FROM incidenten";
    $dropdown_impact = mysqli_query($db, $qry_dropdown_impact);
    
    $qry_dropdown_urgentie = "SELECT id, urgentie FROM incidenten";
    $dropdown_urgentie = mysqli_query($db, $qry_dropdown_urgentie);
    
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
            foreach ($_SESSION['ids'] as $id):
                $update = "UPDATE incidenten SET id='".$_POST[$id][0]."',"
                . "omschrijving='".$_POST[$id][1]."', "
                . "urgentie='".$_POST[$id][2]."', "
                . "impact='".$_POST[$id][3]."', "
                . "hw_id='".$_POST[$id][4]."', "
                . "sw_id='".$_POST[$id][5]."', "
                . "toegekend_aan='".$_POST[$id][6]."', "
                . "melder='".$_POST[$id][7]."' "
                . "WHERE id='".$id."'";
                mysqli_query($db, $update);
                echo $update;
                echo "<br/>";
            endforeach;
            empty($SESSION['ids']);
            header('Location: incidenten.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: incidenten.php');
        exit;
    endif;
    
    while($sw_id = mysqli_fetch_assoc($dropdown_sw_id)):
        $array_sw_id[] .= $sw_id['sw_id'];
    endwhile;
    
    while($hw_id = mysqli_fetch_assoc($dropdown_hw_id)):
        $array_hw_id[] .= $hw_id['hw_id'];
    endwhile;
    
    while($hw_id = mysqli_fetch_assoc($dropdown_hw_id)):
        $array_hw_id[] .= $hw_id['hw_id'];
    endwhile;
    
    while($impact = mysqli_fetch_assoc($dropdown_impact)):
        $array_impact[$impact['id']] .= $impact['impact'];
    endwhile;
    
    while($urgentie = mysqli_fetch_assoc($dropdown_urgentie)):
        $array_urgentie[$urgentie['id']] .= $urgentie['urgentie'];
    endwhile;
    
    while($gebruikers = mysqli_fetch_assoc($dropdown_gebruikers)):
        $array_gebruikers[$gebruikers['id']] .= $gebruikers['voornaam']." ".$gebruikers['achternaam'];
    endwhile;
    
    while($medewerkers = mysqli_fetch_assoc($dropdown_medewerkers)):
        $array_medewerkers[$medewerkers['id']] .= $medewerkers['voornaam']." ".$medewerkers['achternaam'];
    endwhile;
?>
<div class="titel2">
    <div class="container">
        <h1>Incidenten bewerken</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Omschrijving</b></td>
                        <td><b>Urgentie</b></td>
                        <td><b>Impact</b></td>
                        <td><b>Hardware ID</b></td>
                        <td><b>Software ID</b></td>
                        <td><b>Toegekend aan</b></td>
                        <td><b>Melder</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result_all)):
                    ?>
                        <tr>
                    <?php
                        foreach($row as $k => $v):
                            if($k == 'id') :
                                echo "<td><input type=\"text\" readonly=\"readonly\" name=\"".$row["id"]."[]\" value=\"$v\"/></td>\n";
                            elseif($k == 'toegekend_aan') :
                                echo"<td><select name=\"".$row["id"]."[]\">";
                                foreach($array_medewerkers as $key => $value) :
                                    if($v == $key) :
                                        echo "<option value=\"".$key."\" selected>".$value."</option>\n";
                                    else:
                                        echo "<option value=\"".$key."\">".$value."</option>\n";
                                    endif;
                                endforeach;
                                echo"</select></td>";
                            elseif($k == 'melder') :
                                echo"<td><select name=\"".$row["id"]."[]\">";
                                foreach($array_gebruikers as $key => $value) :
                                    if($v == $key) :
                                        echo "<option value=\"".$key."\" selected>".$value."</option>\n";
                                    else:
                                        echo "<option value=\"".$key."\">".$value."</option>\n";
                                    endif;
                                endforeach;
                                echo"</select></td>";  
                            elseif($k == 'hw_id') :
                                echo"<td><select name=\"".$row["id"]."[]\">";
                                foreach($array_hw_id as $key => $value) :
                                    if($v == $value) :
                                        echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                                    else:
                                        echo "<option value=\"".$value."\">".$value."</option>\n";
                                    endif;
                                endforeach;
                                echo"</select></td>";
                            elseif($k == 'urgentie') :
                                echo"<td><select name=\"".$row["id"]."[]\">";
                                foreach($array_urgentie as $key => $value) :
                                    if($key == $row['id']) :
                                        if($v == 1) :
                                            echo "<option value=\"1\" selected>Laag</option>";
                                        else:
                                            echo "<option value=\"1\">Laag</option>";
                                        endif;
                                        if($v == 2) :
                                            echo "<option value=\"2\" selected>Gemiddeld</option>";
                                        else:
                                            echo "<option value=\"2\">Gemiddeld</option>";
                                        endif;
                                        if($v == 3) :
                                            echo "<option value=\"3\" selected>Hoog</option>";
                                        else:
                                            echo "<option value=\"3\">Hoog</option>";
                                        endif;
                                    endif;
                                endforeach;
                                echo"</select></td>";
                            elseif($k == 'impact') :
                                echo"<td><select name=\"".$row["id"]."[]\">";
                                foreach($array_impact as $key => $value) :
                                    if($key == $row['id']) :
                                        if($v == 1) :
                                            echo "<option value=\"1\" selected>Laag</option>";
                                        else:
                                            echo "<option value=\"1\">Laag</option>";
                                        endif;
                                        if($v == 2) :
                                            echo "<option value=\"2\" selected>Gemiddeld</option>";
                                        else:
                                            echo "<option value=\"2\">Gemiddeld</option>";
                                        endif;
                                        if($v == 3) :
                                            echo "<option value=\"3\" selected>Hoog</option>";
                                        else:
                                            echo "<option value=\"3\">Hoog</option>";
                                        endif;
                                    endif;
                                endforeach;
                                echo"</select></td>";
                            elseif($k == 'sw_id') :
                                echo"<td><select name=\"".$row["id"]."[]\">";
                                foreach($array_sw_id as $key => $value) :
                                    if($v == $value) :
                                        echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                                    else:
                                        echo "<option value=\"".$value."\">".$value."</option>\n";
                                    endif;
                                endforeach;
                                echo"</select></td>";
                            else:
                                echo "<td><input type=\"text\" name=\"".$row["id"]."[]\" value=\"$v\"/></td>\n";
                            endif;
                        endforeach;
                    ?>
                        </tr>
                    <?php
                        endwhile;
                    ?>

                </table>
        </div>
        <div class='col-md-2'>
            <div class='submenu'>
                <input type="submit" name="opslaan" value="Opslaan" class="btn btn-primary"/>
                <input type="submit" name="overzicht" value="Terug naar overzicht" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>
<?php
    session_start();

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $ids = implode(' OR id = ', $_SESSION['ids']);
    
    $query_all = "SELECT id, omschrijving, datum, starttijd, hw_id, sw_id, toegekend_aan, melder FROM incidenten WHERE id = $ids";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT id, omschrijving, datum, starttijd, hw_id, sw_id, toegekend_aan, melder FROM incidenten LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    $qry_dropdown_toegekend_aan = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_toegekend_aan = mysqli_query($db, $qry_dropdown_toegekend_aan);
    
    $qry_dropdown_hw_id = "SELECT hw_id FROM hardware";
    $dropdown_hw_id = mysqli_query($db, $qry_dropdown_hw_id);
    
    $qry_dropdown_sw_id = "SELECT sw_id FROM software";
    $dropdown_sw_id = mysqli_query($db, $qry_dropdown_sw_id);
    
    print_r($_POST);
    echo "<br />";
    echo "<br />";
    
    if(isset($_POST['opslaan'])):
        foreach ($_SESSION['ids'] as $id):
            $update = "UPDATE incidenten SET id='".$_POST[$id][0]."',"
            . "omschrijving='".$_POST[$id][1]."', "
            . "datum='".$_POST[$id][2]."', "
            . "starttijd='".$_POST[$id][3]."', "
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
    
    if(isset($_POST['overzicht'])):
        header('Location: incidenten.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Incidenten bewerken</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <form action="" method="POST">
                <table>
                    <tr>
                        <?php
                            foreach($titles as $k => $v):
                                echo "<td><b>$k</b></td>\n";
                            endforeach;
                        ?>
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
                                    while($medewerker = mysqli_fetch_assoc($dropdown_toegekend_aan)):
                                        if($v == $medewerker['id']) :
                                            echo "<option value=\"".$medewerker['id']."\" selected>".$medewerker['voornaam']." ".$medewerker['achternaam']."</option>\n";
                                        else:
                                            echo "<option value=\"".$medewerker['id']."\">".$medewerker['voornaam']." ".$medewerker['achternaam']."</option>\n";
                                        endif;
                                    endwhile;
                                    echo"</select></td>";
                                elseif($k == 'hw_id') :
                                    echo"<td><select name=\"".$row["id"]."[]\">";
                                    while($hw_id = mysqli_fetch_assoc($dropdown_hw_id)):
                                        if($v == $hw_id['hw_id']) :
                                            echo "<option value=\"".$hw_id['hw_id']."\" selected>".$hw_id['hw_id']."</option>\n";
                                        else:
                                            echo "<option value=\"".$hw_id['hw_id']."\">".$hw_id['hw_id']."</option>\n";
                                        endif;
                                    endwhile;
                                    echo"</select></td>";
                                elseif($k == 'sw_id') :
                                    echo"<td><select name=\"".$row["id"]."[]\">";
                                    while($sw_id = mysqli_fetch_assoc($dropdown_sw_id)):
                                        if($v == $sw_id['sw_id']) :
                                            echo "<option value=\"".$sw_id['sw_id']."\" selected>".$sw_id['sw_id']."</option>\n";
                                        else:
                                            echo "<option value=\"".$sw_id['sw_id']."\">".$sw_id['sw_id']."</option>\n";
                                        endif;
                                    endwhile;
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
            </form>
</body>
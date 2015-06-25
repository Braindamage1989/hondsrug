<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    require_once 'includes/header.php';
    require_once 'includes/connectdb.php';
    
    $melding = "";
    $teller = 0;
    
    $ids = implode('" OR hw_id = "', $_SESSION['ids']);
    
    $query_all = "SELECT * FROM hardware WHERE hw_id = \"$ids\"";
    $result_all = mysqli_query($db, $query_all);
    
    $qry_dropdown_connected_hw = "SELECT hw_id FROM hardware";
    $dropdown_connected_hw = mysqli_query($db, $qry_dropdown_connected_hw);
    
    while($connected = mysqli_fetch_assoc($dropdown_connected_hw)):
        $array_connected[] .= $connected['hw_id'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
        if(empty($_POST['hw_id'])) :
            $melding .= "<font color=\"red\"><b>Hardware ID mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['locatie'])) :
            $melding .= "<font color=\"red\"><b>Locatie mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['merk'])) :
            $melding .= "<font color=\"red\"><b>Merk mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['leverancier'])) :
            $melding .= "<font color=\"red\"><b>Leverancier mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['aanschafjaar'])) :
            $melding .= "<font color=\"red\"><b>Aanschafjaar mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if($teller == 0) :
            foreach ($_SESSION['ids'] as $id):
                $update = "UPDATE hardware SET soort_hw='".$_POST[$id][1]."', "
                . "locatie='".$_POST[$id][2]."', "
                . "OS='".$_POST[$id][3]."', "
                . "merk='".$_POST[$id][4]."', "
                . "leverancier='".$_POST[$id][5]."', "
                . "aanschafjaar='".$_POST[$id][6]."', "
                . "connected_hw='".$_POST[$id][7]."' "
                . "WHERE hw_id='".$id."'";
                mysqli_query($db, $update);
            endforeach;
            empty($SESSION['ids']);
            header('Location: hardware.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: hardware.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Hardware bewerken</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>Hardware ID</b></td>
                        <td><b>Soort Hardware</b></td>
                        <td><b>Locatie</b></td>
                        <td><b>OS</b></td>
                        <td><b>Merk</b></td>
                        <td><b>Leverancier</b></td>
                        <td><b>Aanschafjaar</b></td>
                        <td><b>Verbonden met</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result_all)):
                    ?>
                        <tr>
                    <?php
                            foreach($row as $k => $v):
                                if($k == 'hw_id') :
                                    echo "<td><input type=\"text\" readonly=\"readonly\" name=\"".$row["hw_id"]."[]\" value=\"$v\"/></td>\n";
                                elseif ($k == 'aanschafjaar'):
                                    echo "<td><input type=\"number\" name=\"aanschafjaar\" value=\"$v\"/></td>";
                                elseif($k == 'connected_hw') :
                                    echo"<td><select name=\"".$row["hw_id"]."[]\">";
                                    foreach($array_connected as $key => $value) :
                                        if($value == $row['hw_id']) :
                                            echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                                        else:
                                            echo "<option value=\"".$value."\">".$value."</option>\n";
                                        endif;
                                    endforeach;
                                elseif ($k == 'status') :
                                    // doe maar niks
                                else:
                                    echo "<td><input type=\"text\" name=\"".$row["hw_id"]."[]\" value=\"$v\"/></td>\n";
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
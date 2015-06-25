<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    $melding = "";
    $teller = 0;
    
    require_once 'includes/connectdb.php';
    require_once 'includes/header-tool.php';
    
    $melding = "";
    $teller = 0;
    
    $ids = implode(' OR id = ', $_SESSION['ids']);
    
    $query = "SELECT * FROM gebruikers WHERE id = $ids";
    $result = mysqli_query($db, $query);
    
    
    if(isset($_POST['opslaan'])):
            foreach ($_SESSION['ids'] as $id):
                if(empty($_POST[$id][1])) :
                    $melding .= "<font color=\"red\"><b>Voornaam mag niet leeg zijn</b></font><br/>";
                    $teller++;
                endif;
                if(empty($_POST[$id][2])) :
                    $melding .= "<font color=\"red\"><b>Achternaam mag niet leeg zijn</b></font><br/>";
                    $teller++;
                endif;
                if(empty($_POST[$id][3])) :
                    $melding .= "<font color=\"red\"><b>E-mail mag niet leeg zijn</b></font><br/>";
                    $teller++;
                endif;
                if(empty($_POST[$id][4])) :
                    $melding .= "<font color=\"red\"><b>Wachtwoord mag niet leeg zijn</b></font><br/>";
                    $teller++;
                endif;
                if($teller == 0) :
                    $update = "UPDATE gebruikers SET voornaam='".$_POST[$id][1]."', "
                    . "achternaam='".$_POST[$id][2]."', "
                    . "email='".$_POST[$id][3]."', "
                    . "wachtwoord='".$_POST[$id][4]."', "
                    . "functie='".$_POST[$id][5]."'"
                    . " WHERE id='".$_POST[$id][0]."'";
                    mysqli_query($db, $update);
                endif;
            endforeach;
            if($teller == 0) :
                empty($SESSION['ids']);
                header('Location: gebruikers.php');
                exit;
            endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: gebruikers.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Gebruiker bewerken</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-8">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Voornaam</b></td>
                        <td><b>Achternaam</b></td>
                        <td><b>E-mail</b></td>
                        <td><b>Wachtwoord</b></td>
                        <td><b>Functie</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result)):
                    ?>
                        <tr>
                    <?php
                            foreach($row as $key => $value) :
                                if ($key == "functie") :
                                    ?>
                                    <td>
                                        <select name="<?php echo $row["id"] ?>[]">
                                            <option value="Medewerker IT">Medewerker IT</option>
                                            <option value="Leerling">Leerling</option>
                                            <option value="Docent">Docent</option>
                                        </select>
                                    </td>
                                    <?php
                                elseif ($key == "id") :
                                    echo "<td><input type=\"text\" name=\"".$row["id"]."[]\" value=\"$value\" readonly=\"readonly\"/></td>\n";
                                elseif ($key == 'status') :
                                    //doe niks
                                else:
                                    echo "<td><input type=\"text\" name=\"".$row["id"]."[]\" value=\"$value\"/></td>\n";
                                endif;
                            endforeach;
                    ?>
                        </tr>
                    <?php
                        endwhile;
                    ?>

                </table>
        </div>
        <div class='col-md-4'>
            <div class='submenu'>
                <input type="submit" name="opslaan" value="Opslaan" class="btn btn-primary"/>
                <input type="submit" name="overzicht" value="Terug naar overzicht" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
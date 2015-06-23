<?php
    session_start();
    
    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $ids = implode(' OR id = ', $_SESSION['ids']);
    
    $query = "SELECT * FROM gebruikers WHERE id = $ids";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['opslaan'])):
        foreach ($_SESSION['ids'] as $id):
            $update = "UPDATE gebruikers SET voornaam='".$_POST[$id][1]."', "
            . "achternaam='".$_POST[$id][2]."', "
            . "email='".$_POST[$id][3]."', "
            . "wachtwoord='".$_POST[$id][4]."', "
            . "functie='".$_POST[$id][5]."', "
            . "status='".$_POST[$id][6]."'"
            . " WHERE id='".$_POST[$id][0]."'";
            mysqli_query($db, $update);
            echo $update;
            echo "<br/>";
        endforeach;
        empty($SESSION['ids']);
        //header('Location: gebruikers.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: gebruikers.php');
        exit;
    endif;
?>
?>
<div class="titel2">
    <div class="container">
        <h1>Gebruiker toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-8">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Voornaam</b></td>
                        <td><b>Achternaam</b></td>
                        <td><b>E-mail</b></td>
                        <td><b>Wachtwoord</b></td>
                        <td><b>Functie</b></td>
                        <td><b>Status</b></td>
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
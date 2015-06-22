<?php
    session_start();
    require_once 'includes/connectdb.php';
    
    $query = "SELECT voornaam, achternaam, email, wachtwoord, functie FROM gebruikers LIMIT 1";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['opslaan'])):
        $insert = "INSERT INTO gebruikers (voornaam,achternaam,email,wachtwoord,functie,status) "
            . "VALUES ('".$_POST['voornaam']."','".$_POST['achternaam']."','".$_POST['email']."','".$_POST['wachtwoord']."','".$_POST['functie']."','1')";
        mysqli_query($db, $insert);
        echo $insert;
        //header('Location: gebruikers.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: gebruikers.php');
        exit;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
            <tr>
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
                                <select name="functie">
                                    <option value="Medewerker IT">Medewerker IT</option>
                                    <option value="Leerling">Leerling</option>
                                    <option value="Docent">Docent</option>
                                </select>
                            </td>
                            <?php
                        elseif ($key == "id") :
                            // doe niks
                        else:
                            echo "<td><input type=\"text\" name=\"$key\"/></td>\n";
                        endif;
                    endforeach;
            ?>
                </tr>
            <?php
                endwhile;
            ?>
            
        </table>
        <input type="submit" name="opslaan" value="Opslaan" />
        <input type="submit" name="overzicht" value="Terug naar overzicht" /> 
    </form>
</body>
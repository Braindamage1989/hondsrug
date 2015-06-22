<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $query = "SELECT id, voornaam, achternaam, email, wachtwoord, functie FROM gebruikers WHERE status != '9'";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['inline'])):
        $_SESSION['ids'] = $_POST['id'];
        header('Location: gebruikers_inline.php');
        exit;
    endif;
    
    if(isset($_POST['toevoegen'])):
        header('Location: gebruiker_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        foreach($_POST['id'] as $k => $v) :
            $update = "UPDATE gebruikers SET status='9' WHERE id='$v'";
            mysqli_query($db, $update);
        endforeach;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td></td>
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
                    foreach($row as $k => $v):
                        if($k == 'id'):
                            echo "<td><input type=\"checkbox\" name=\"id[]\" value=\"$v\"></td>\n";
                        elseif ($k == 'omschrijving') :
                            echo "<td><a href=\"incident_detail.php?id=".$row['id']."\">$v</a>";
                        else:
                            echo "<td>$v</td>\n";
                        endif;
                    endforeach;
            ?>
                </tr>
            <?php
                endwhile;
            ?>
            
        </table>
        <input type="submit" name="toevoegen" value="Toevoegen" />
        <input type="submit" name="inline" value="Bewerk" />
        <input type="submit" name="verwijderen" value="Verwijderen" />
        <br />Klik op omschrijving om details van incident te tonen/bewerken
    </form>
</body>
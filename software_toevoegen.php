<?php
    session_start();

    require_once 'includes/connectdb.php';
   
    $query = "SELECT * FROM software LIMIT 1";
    $result = mysqli_query($db, $query);
    $titles = mysqli_fetch_assoc($result);
    
    if(isset($_POST['opslaan'])):
        if(!empty($_POST['sw_id']) && !empty($_POST['uitgebreidde_naam']) && !empty($_POST['soort']) && !empty($_POST['producent']) && !empty($_POST['leverancier']) && !empty($_POST['aantal_licenties']) && !empty($_POST['serverlicentie'])):
            if(is_numeric($_POST['aantal_licenties'])):
                if(is_numeric($_POST['serverlicentie'])):
                    if(empty($_POST['aantal_gebruikers'])):
                        $_POST['aantal_gebruikers'] = 0;
                    endif;
                    if(is_numeric($_POST['aantal_gebruikers'])):
                        $insert = "INSERT INTO software (sw_id,uitgebreidde_naam,soort,producent,leverancier,aantal_licenties,serverlicentie,aantal_gebruikers) "
                            . "VALUES ('".$_POST['sw_id']."','".$_POST['uitgebreidde_naam']."','".$_POST['soort']."','".$_POST['producent']."','".$_POST['leverancier']."','".$_POST['aantal_licenties']."','".$_POST['serverlicentie']."','".$_POST['aantal_gebruikers']."')";
                        mysqli_query($db, $insert);
                        header('Location: software.php');
                        exit;
                    else:
                        echo "Aantal gebruikers dient een getal te zijn.";
                    endif;
                else:
                    echo "Serverlicentie dient een getal te zijn.";
                endif;
            else:
                echo "Aantal licenties dient een getal te zijn.";
            endif;
        else:
            echo "U heeft nog niet alle verplichte velden ingevoerd.";
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: software.php');
        exit;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
            <tr>
                <?php
                    foreach($titles as $k => $v):
                        echo "<td><b>$k</b></td>\n";
                    endforeach;
                ?>
            </tr>
            <tr>
                <td><input type="text" name="sw_id" /></td>
                <td><input type="text" name="uitgebreidde_naam" /></td>
                <td><input type="text" name="soort" /></td>
                <td><input type="text" name="producent" /></td>
                <td><input type="text" name="leverancier" /></td>
                <td><input type="text" name="aantal_licenties" /></td>
                <td><input type="text" name="serverlicentie" /></td>
                <td><input type="text" name="aantal_gebruikers" /></td>
            </tr>
        </table>
        <input type="submit" name="opslaan" value="Opslaan" />
        <input type="submit" name="overzicht" value="Terug naar overzicht" /> 
    </form>
</body>
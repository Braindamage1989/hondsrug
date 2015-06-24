<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $melding = "";
    $teller = 0;
    
    $query = "SELECT voornaam, achternaam, email, wachtwoord, functie FROM gebruikers LIMIT 1";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['opslaan'])):
        if(empty($_POST['voornaam'])) :
            $melding .= "<font color=\"red\"><b>Voornaam mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['achternaam'])) :
            $melding .= "<font color=\"red\"><b>Achternaam mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['email'])) :
            $melding .= "<font color=\"red\"><b>E-mail mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['wachtwoord'])) :
            $melding .= "<font color=\"red\"><b>Wachtwoord mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if($teller == 0) :
            $insert = "INSERT INTO gebruikers (voornaam,achternaam,email,wachtwoord,functie,status) "
                . "VALUES ('".$_POST['voornaam']."','".$_POST['achternaam']."','".$_POST['email']."','".$_POST['wachtwoord']."','".$_POST['functie']."','1')";
            mysqli_query($db, $insert);
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
        <h1>Gebruiker toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-10">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class="table">
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
    require_once 'includes/header.html'; 
?>
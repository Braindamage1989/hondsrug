<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    require_once 'includes/header-tool.php';
    require_once 'includes/connectdb.php';
    
    $melding = "";
    
    $query = "SELECT id, voornaam, achternaam, email, wachtwoord, functie FROM gebruikers WHERE status != '9'";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['inline'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            $_SESSION['ids'] = $_POST['id'];
            header('Location: gebruikers_inline.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['toevoegen'])):
        header('Location: gebruiker_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            foreach($_POST['id'] as $k => $v) :
                $update = "UPDATE gebruikers SET status='9' WHERE id='$v'";
                mysqli_query($db, $update);
                header('Location: gebruikers.php');
                exit;
            endforeach;
        endif;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Gebruikers</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class="table table-striped table-bordered table-hover table-condensed">
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
                </div>
        <div class='col-md-1'>
            <div class='submenu'>
                <input type="submit" name="toevoegen" value="Toevoegen" class="btn btn-primary"/>
                <input type="submit" name="inline" value="Bewerk" class="btn btn-default"/>
                <input type="submit" name="verwijderen" value="Verwijderen" class="btn btn-default"/>
                <br />Klik op omschrijving om details van incident te tonen/bewerken
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>
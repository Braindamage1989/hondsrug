<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    require_once 'includes/header-tool.php';
    require_once 'includes/connectdb.php';
    
    $melding = "";
    $teller = 0;
   
    $query = "SELECT sw_id, uitgebreidde_naam, soort, producent, leverancier, aantal_licenties, serverlicentie, aantal_gebruikers FROM software LIMIT 1";
    $result = mysqli_query($db, $query);
    $titles = mysqli_fetch_assoc($result);
    
    if(isset($_POST['opslaan'])):
        if(empty($_POST['sw_id'])) :
            $melding .= "<font color=\"red\"><b>Software ID mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['uitgebreidde_naam'])) :
            $melding .= "<font color=\"red\"><b>Uitgebreide naam mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['soort'])) :
            $melding .= "<font color=\"red\"><b>Soort mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['producent'])) :
            $melding .= "<font color=\"red\"><b>Producent mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['leverancier'])) :
            $melding .= "<font color=\"red\"><b>Leverancier mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if($teller == 0) :
            $insert = "INSERT INTO software (sw_id,uitgebreidde_naam,soort,producent,leverancier,aantal_licenties,serverlicentie,aantal_gebruikers,status) "
                . "VALUES ('".$_POST['sw_id']."','".$_POST['uitgebreidde_naam']."','".$_POST['soort']."','".$_POST['producent']."','".$_POST['leverancier']."','".$_POST['aantal_licenties']."','".$_POST['serverlicentie']."','".$_POST['aantal_gebruikers']."',1)";
            mysqli_query($db, $insert);
            header('Location: software.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: software.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Software toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>Software ID</b></td>
                        <td><b>Uitgebreide naam</b></td>
                        <td><b>Soort</b></td>
                        <td><b>Producent</b></td>
                        <td><b>Leverancier</b></td>
                        <td><b>Aantal Licenties</b></td>
                        <td><b>Serverlicenties</b></td>
                        <td><b>Aantal gebruikers</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="sw_id" /></td>
                        <td><input type="text" name="uitgebreidde_naam" /></td>
                        <td><input type="text" name="soort" /></td>
                        <td><input type="text" name="producent" /></td>
                        <td><input type="text" name="leverancier" /></td>
                        <td><input type="number" min="0" name="aantal_licenties" /></td>
                        <td><input type="number" min="0" name="serverlicentie" /></td>
                        <td><input type="number" min="0" name="aantal_gebruikers" /></td>
                    </tr>
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
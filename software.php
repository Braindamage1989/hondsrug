<?php
    session_start();

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $melding ="";
    
    $query_all = "SELECT sw_id, uitgebreidde_naam, soort, producent, leverancier, aantal_licenties, serverlicentie, aantal_gebruikers FROM software WHERE status !=9";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT * FROM software LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    if(isset($_POST['inline'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            $_SESSION['ids'] = $_POST['id'];
            header('Location: software_inline.php');
            exit;
        endif;
    endif;
        
    if(isset($_POST['toevoegen'])):
        header('Location: software_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            foreach($_POST['id'] as $k => $v) :
                $update = "UPDATE software SET status='9' WHERE sw_id='$v'";
                mysqli_query($db, $update);
            endforeach;
        endif;
    endif;
?>
 <div class="titel2">
    <div class="container">
        <h1>Software</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-11">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class='table'>
                    <tr>
                        <td></td>
                        <td><b>Software ID</b></td>
                        <td><b>Uitgebreide naam</b></td>
                        <td><b>Soort</b></td>
                        <td><b>Producent</b></td>
                        <td><b>Leverancier</b></td>
                        <td><b>Aantal Licenties</b></td>
                        <td><b>Serverlicenties</b></td>
                        <td><b>Aantal gebruikers</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result_all)):
                    ?>
                        <tr>
                    <?php
                            foreach($row as $k => $v):
                                if($k == 'sw_id'):
                                    echo "<td><input type=\"checkbox\" name=\"id[]\" value=\"$v\"></td>\n";
                                endif;
                                echo "<td>$v</td>\n";
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
                </div>
            </div>
        </form>
    </div>
</div>
<?php
    require_once 'includes/header.html'; 
?>
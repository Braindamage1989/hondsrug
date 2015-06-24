<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $melding = "";
    
    $query = "SELECT hw_id, sw_id FROM geinstalleerde_software WHERE status != '9'";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['toevoegen'])):
        header('Location: geinstalleerde_software_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            $aantal = 0;
            foreach($_POST['id'] as $k => $v) :
                $key = explode("_", $_POST['id'][$aantal]);
                $aantal++;
                $update = "UPDATE geinstalleerde_software SET status='9' WHERE hw_id='$key[0]' AND sw_id='$key[1]'";
                mysqli_query($db, $update);
            endforeach;
        endif;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Geinstalleerde software</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class="table">
                    <tr>
                        <td></td>
                        <td><b>Hardware ID</b></td>
                        <td><b>Software ID</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result)):
                    ?>
                        <tr>
                    <?php
                            echo "<td><input type=\"checkbox\" name=\"id[]\" value=\"".$row['hw_id']."_".$row['sw_id']."\"></td>\n";

                            foreach($row as $k => $v):
                                echo "<td>$v</td>";
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
                <input type="submit" name="verwijderen" value="Verwijderen" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>
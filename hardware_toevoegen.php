<?php
    session_start();
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $melding = "";
    $teller = 0;
   
    $query = "SELECT * FROM hardware LIMIT 1";
    $result = mysqli_query($db, $query);
    $titles = mysqli_fetch_assoc($result);
    
    $qry_dropdown_connected_hw = "SELECT hw_id FROM hardware";
    $dropdown_connected_hw = mysqli_query($db, $qry_dropdown_connected_hw);
    
    if(isset($_POST['opslaan'])):
        if(empty($_POST['hw_id'])) :
            $melding .= "<font color=\"red\"><b>Hardware ID mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['locatie'])) :
            $melding .= "<font color=\"red\"><b>Locatie mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['merk'])) :
            $melding .= "<font color=\"red\"><b>Merk mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['leverancier'])) :
            $melding .= "<font color=\"red\"><b>Leverancier mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if(empty($_POST['aanschafjaar'])) :
            $melding .= "<font color=\"red\"><b>Aanschafjaar mag niet leeg zijn</b></font><br/>";
            $teller++;
        endif;
        if($teller == 0) :
            $insert = "INSERT INTO hardware (hw_id,soort_hw,locatie,OS,merk,leverancier,aanschafjaar,connected_hw,status) "
                . "VALUES ('".$_POST['hw_id']."','".$_POST['soort_hw']."','".$_POST['locatie']."','".$_POST['OS']."','".$_POST['merk']."','".$_POST['leverancier']."','".$_POST['aanschafjaar']."','".$_POST['connected_hw']."',1)";
            mysqli_query($db, $insert);
            header('Location: hardware.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: hardware.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Hardware toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>Hardware ID</b></td>
                        <td><b>Soort Hardware</b></td>
                        <td><b>Locatie</b></td>
                        <td><b>OS</b></td>
                        <td><b>Merk</b></td>
                        <td><b>Leverancier</b></td>
                        <td><b>Aanschafjaar</b></td>
                        <td><b>Verbonden met</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="hw_id" /></td>
                        <td><input type="text" name="soort_hw" /></td>
                        <td><input type="text" name="locatie" /></td>
                        <td><input type="text" name="OS" /></td>
                        <td><input type="text" name="merk" /></td>
                        <td><input type="text" name="leverancier" /></td>
                        <td><input type="number" name="aanschafjaar" value="2015"/></td>
                        <td><select name="connected_hw">
                        <?php
                            while($hw_id = mysqli_fetch_assoc($dropdown_connected_hw)):
                                echo "<option value=\"".$hw_id['hw_id']."\">".$hw_id['hw_id']."</option>\n";
                            endwhile;
                        ?>
                        </select></td>
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
    require_once 'includes/header.html'; 
?>
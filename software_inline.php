<?php
    session_start();
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $ids = implode('" OR sw_id = "', $_SESSION['ids']);
    
    $query_all = "SELECT * FROM software WHERE sw_id = \"$ids\"";
    $result_all = mysqli_query($db, $query_all);
    
    
    $query_one = "SELECT * FROM software LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    if(isset($_POST['opslaan'])):
        foreach ($_SESSION['ids'] as $id):
            $update = "UPDATE software SET sw_id='".$_POST[$id][0]."',"
            . "uitgebreidde_naam='".$_POST[$id][1]."', "
            . "soort='".$_POST[$id][2]."', "
            . "producent='".$_POST[$id][3]."', "
            . "leverancier='".$_POST[$id][4]."', "
            . "aantal_licenties='".$_POST[$id][5]."', "
            . "serverlicentie='".$_POST[$id][6]."', "
            . "aantal_gebruikers='".$_POST[$id][7]."' "
            . "WHERE sw_id='".$id."'";
            mysqli_query($db, $update);
        endforeach;
        empty($SESSION['ids']);
        header('Location: software.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: software.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Software bewerken</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
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
                    <?php
                        while($row = mysqli_fetch_assoc($result_all)):
                    ?>
                        <tr>
                    <?php
                            foreach($row as $k => $v):
                                if($k == 'sw_id') :
                                    echo "<td><input type=\"text\" readonly=\"readonly\" name=\"".$row["sw_id"]."[]\" value=\"$v\"/></td>\n";
                                elseif($k == 'aantal_licenties') :
                                    echo "<td><input type=\"number\" min=\"0\" name=\"".$row["sw_id"]."[]\" value=\"$v\"/></td>\n";
                                elseif($k == 'serverlicentie') :
                                    echo "<td><input type=\"number\" min=\"0\" name=\"".$row["sw_id"]."[]\" value=\"$v\"/></td>\n";
                                elseif($k == 'aantal_gebruikers') :
                                    echo "<td><input type=\"number\" min=\"0\" name=\"".$row["sw_id"]."[]\" value=\"$v\"/></td>\n";
                                elseif($k == 'status') :
                                    // doe niks
                                else:
                                    echo "<td><input type=\"text\" name=\"".$row["sw_id"]."[]\" value=\"$v\"/></td>\n";
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
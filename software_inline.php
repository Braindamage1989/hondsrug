<?php
    session_start();

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
            echo $update;
            echo "<br/>";
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
            <?php
                while($row = mysqli_fetch_assoc($result_all)):
            ?>
                <tr>
            <?php
                    foreach($row as $k => $v):
                        if($k == 'sw_id') :
                            echo "<td><input type=\"text\" readonly=\"readonly\" name=\"".$row["sw_id"]."[]\" value=\"$v\"/></td>\n";
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
        <input type="submit" name="opslaan" value="Opslaan" />
        <input type="submit" name="overzicht" value="Terug naar overzicht" /> 
    </form>
</body>
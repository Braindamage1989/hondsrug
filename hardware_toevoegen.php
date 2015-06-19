<?php
    session_start();

    require_once 'includes/connectdb.php';
   
    $query = "SELECT * FROM hardware LIMIT 1";
    $result = mysqli_query($db, $query);
    $titles = mysqli_fetch_assoc($result);
    
    $qry_dropdown_connected_hw = "SELECT hw_id FROM hardware";
    $dropdown_connected_hw = mysqli_query($db, $qry_dropdown_connected_hw);
    
    if(isset($_POST['opslaan'])):
        $insert = "INSERT INTO hardware (hw_id,soort_hw,locatie,OS,merk,leverancier,aanschafjaar,connected_hw) "
            . "VALUES ('".$_POST['hw_id']."','".$_POST['soort_hw']."','".$_POST['locatie']."','".$_POST['OS']."','".$_POST['merk']."','".$_POST['leverancier']."','".$_POST['aanschafjaar']."','".$_POST['connected_hw']."')";
        mysqli_query($db, $insert);
        header('Location: hardware.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: hardware.php');
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
                <td><input type="text" name="hw_id" /></td>
                <td><input type="text" name="soort_hw" /></td>
                <td><input type="text" name="locatie" /></td>
                <td><input type="text" name="OS" /></td>
                <td><input type="text" name="merk" /></td>
                <td><input type="text" name="leverancier" /></td>
                <td><input type="text" name="aanschafjaar" /></td>
                <td><select name="connected_hw">
                <?php
                    while($hw_id = mysqli_fetch_assoc($dropdown_connected_hw)):
                        echo "<option value=\"".$hw_id['hw_id']."\">".$hw_id['hw_id']."</option>\n";
                    endwhile;
                ?>
                </select></td>
            </tr>
        </table>
        <input type="submit" name="opslaan" value="Opslaan" />
        <input type="submit" name="overzicht" value="Terug naar overzicht" /> 
    </form>
</body>
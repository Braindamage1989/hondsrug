<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $query = "SELECT hw_id, sw_id FROM geinstalleerde_software WHERE status != '9'";
    $result = mysqli_query($db, $query);
    
    if(isset($_POST['toevoegen'])):
        header('Location: incident_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        foreach($_POST['id'] as $k => $v) :
            $update = "UPDATE incidenten SET status='9' WHERE id='$v'";
            mysqli_query($db, $update);
        endforeach;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
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
        <input type="submit" name="toevoegen" value="Toevoegen" />
        <input type="submit" name="verwijderen" value="Verwijderen" />
    </form>
</body>
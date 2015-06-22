<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $query_all = "SELECT sw_id, uitgebreidde_naam, soort, producent, leverancier, aantal_licenties, serverlicentie, aantal_gebruikers FROM software WHERE status !=9";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT * FROM software LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    if(isset($_POST['inline'])):
        $_SESSION['ids'] = $_POST['id'];
        print_r($_SESSION['ids']);
        header('Location: software_inline.php');
        exit;
    endif;
        
    if(isset($_POST['toevoegen'])):
        header('Location: software_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        foreach($_POST['id'] as $k => $v) :
            $update = "UPDATE software SET status='9' WHERE sw_id='$v'";
            mysqli_query($db, $update);
        endforeach;
    endif;
?>
<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td></td>
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
        <input type="submit" name="toevoegen" value="Toevoegen" />
        <input type="submit" name="inline" value="Bewerk" />
        <input type="submit" name="verwijderen" value="Verwijderen" />
    </form>
</body>
<?php
    session_start();

    require_once 'includes/connectdb.php';
    
    $query_all = "SELECT * FROM software";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT * FROM software LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    //print_r($_POST);
    
    if(isset($_POST['inline'])):
        $_SESSION['ids'] = $_POST['id'];
        print_r($_SESSION['ids']);
        header('Location: software_inline.php');
        exit;
        
    if(isset($_POST['toevoegen'])):
        header('Location: software_toevoegen.php');
        exit;
    endif;
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
    </form>
</body>
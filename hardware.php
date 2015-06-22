<?php
    session_start();
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $query_all = "SELECT * FROM hardware";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT * FROM hardware LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    
    if(isset($_POST['inline'])):
        $_SESSION['ids'] = $_POST['id'];
        header('Location: hardware_inline.php');
        exit;
    endif;
    
    if(isset($_POST['toevoegen'])):
        header('Location: hardware_toevoegen.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Hardware</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        
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
                            if($k == 'hw_id'):
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
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>
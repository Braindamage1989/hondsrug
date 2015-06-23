<?php
    session_start();
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $query_all = "SELECT hw_id, soort_hw, locatie, OS, merk, leverancier, aanschafjaar, connected_hw FROM hardware WHERE status !=9";
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
    
    if(isset($_POST['verwijderen'])):
        foreach($_POST['id'] as $k => $v) :
            $update = "UPDATE hardware SET status='9' WHERE hw_id='$v'";
            mysqli_query($db, $update);
        endforeach;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Hardware</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <form action="" method="POST">
                <table class='table'>
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
        </div>
        <div class='col-md-1'>
                <div class='submenu'>
                    <input type="submit" name="toevoegen" value="Toevoegen" class="btn btn-primary"/>
                    <input type="submit" name="inline" value="Bewerk" class="btn btn-default"/>
                    <input type="submit" name="verwijderen" value="Verwijderen" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>
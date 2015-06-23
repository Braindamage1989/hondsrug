<?php
    session_start();

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $query_all = "SELECT id, omschrijving, datum, starttijd, hw_id, sw_id, toegekend_aan, melder FROM incidenten";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT id, omschrijving, datum, starttijd, hw_id, sw_id, toegekend_aan, melder FROM incidenten LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    //print_r($_POST);
    
    if(isset($_POST['inline'])):
        $_SESSION['ids'] = $_POST['id'];
        print_r($_SESSION['ids']);
        header('Location: incidenten_inline.php');
        exit;
    endif;
?>
 <div class="titel2">
    <div class="container">
        <h1>Incidenten</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <form action="" method="POST">
                <table class="table">
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
                                if($k == 'id'):
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
                <input type="submit" name="inline" value="Bewerk" class="btn btn-primary"/>
                <input type="submit" name="detail" value="Toon details" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>
<?php
    session_start();
    
    error_reporting(0);

    require_once 'includes/connectdb.php';
    require_once 'includes/header.html';
    
    $query_hardware = "SELECT hw_id FROM hardware";
    $result_hardware = mysqli_query($db, $query_hardware);
    
    $query_software = "SELECT sw_id FROM software";
    $result_software = mysqli_query($db, $query_software);
    
    while($ids = mysqli_fetch_assoc($result_hardware)):
        $array_hw_id[] .= $ids['hw_id'];
    endwhile;
    
    while($ids = mysqli_fetch_assoc($result_software)):
        $array_sw_id[] .= $ids['sw_id'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
        
        print_r($_POST);
        $insert = "INSERT INTO geinstalleerde_software (hw_id, sw_id, status) "
            . "VALUES ('".$_POST['hw_id']."','".$_POST['sw_id']."','1')";
        mysqli_query($db, $insert);
        header('Location: geinstalleerde_software.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: geinstalleerde_software.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Geinstalleerde software toevoegen</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-7">
            <form action="" method="POST">
                <table class='table'>
                    <tr>
                        <td><b>Hardware ID</b></td>
                        <td><b>Software ID</b></td>
                    </tr>
                        <tr>
                            <td>
                                <select name="hw_id">
                    <?php
                        foreach($array_hw_id as $key => $value) :
                            if($record['hw_id'] == $value) :
                                echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                            else:
                                echo "<option value=\"".$value."\">".$value."</option>\n";
                            endif;
                        endforeach;
                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="sw_id">
                    <?php
                        foreach($array_sw_id as $key => $value) :
                            if($record['sw_id'] == $value) :
                                echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                            else:
                                echo "<option value=\"".$value."\">".$value."</option>\n";
                            endif;
                        endforeach;
                    ?>
                                </select>
                            </td>
                        </tr>
                </table>
        </div>
        <div class='col-md-5'>
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
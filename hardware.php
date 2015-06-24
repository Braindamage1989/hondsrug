<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $query_all = "SELECT hw_id, soort_hw, locatie, OS, merk, leverancier, aanschafjaar, connected_hw FROM hardware WHERE status !=9";
    $result_all = mysqli_query($db, $query_all);
    
    $query_one = "SELECT * FROM hardware LIMIT 1";
    $result_one = mysqli_query($db, $query_one);
    $titles = mysqli_fetch_assoc($result_one);
    
    $melding = "";
    
    
    if(isset($_POST['inline'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            $_SESSION['ids'] = $_POST['id'];
            header('Location: hardware_inline.php');
            exit;
        endif;
    endif;
    
    if(isset($_POST['toevoegen'])):
        header('Location: hardware_toevoegen.php');
        exit;
    endif;
    
    if(isset($_POST['verwijderen'])):
        if(empty($_POST['id'])) :
            $melding .= "<font color=\"red\"><b>Er is geen record geselecteerd</b></font><br/>";
        else:
            foreach($_POST['id'] as $k => $v) :
                $update = "UPDATE hardware SET status='9' WHERE hw_id='$v'";
                mysqli_query($db, $update);
            endforeach;
        endif;
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
            <?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <tr>
                        <td></td>
                        <td><b>Hardware ID</b></td>
                        <td><b>Soort Hardware</b></td>
                        <td><b>Locatie</b></td>
                        <td><b>OS</b></td>
                        <td><b>Merk</b></td>
                        <td><b>Leverancier</b></td>
                        <td><b>Aanschafjaar</b></td>
                        <td><b>Verbonden met</b></td>
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
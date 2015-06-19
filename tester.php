<?php
require_once 'includes/connectdb.php';
    
    $qry_dropdown_toegekend_aan = "SELECT id, voornaam, achternaam FROM gebruikers";
    $dropdown_toegekend_aan = mysqli_query($db, $qry_dropdown_toegekend_aan);
    
?>
<select name="toegekend_aan">
    <?php
    while($row = mysqli_fetch_assoc($result)):
        echo "<option value=\"".$row['id']."\">".$row['voornaam']." ".$row['achternaam']."</option>";
    endwhile;
    ?>
</select>
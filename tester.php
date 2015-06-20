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

<select name="impact">
    <option value="1">Laag</option>
    <option value="2">Gemiddeld</option>
    <option value="3">Hoog</option>
</select>

<select name="urgentie">
    <option value="1">Laag</option>
    <option value="2">Gemiddeld</option>
    <option value="3">Hoog</option>
</select>
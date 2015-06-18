<?php
    require_once 'includes/connectdb.php';
    
    $query = "SELECT * FROM incidenten";
    $test = mysqli_query($db, $query);
    $result = mysqli_fetch_assoc($test);
    
    foreach($result as $k => $v):
        echo "$k -> $v <br />";
    endforeach;
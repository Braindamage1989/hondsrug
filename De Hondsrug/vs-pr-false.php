<?php 
    session_start();
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>

<div class="titel2">
    <div class="container">
        <h1>Vragenscript</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        Incident = printer is kapo of printerserver probleem...</br></br>
        <pre>
        <?php print_r($_SESSION); ?>
        </pre>
        </div>
    </div>
<?php 
    require_once 'includes/footer.html'; 
?>

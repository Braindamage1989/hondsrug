<?php
    session_start();
    
    //error_reporting(0);

    require_once 'includes/connectdb.php';
    require_once 'includes/header.php';
?>
<div class="titel2">
    <div class="container">
        <h1>F.A.Q.</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <table>
            <tr>
                <td colspan='2'>De vraag hier</td>
            </tr>
            <tr>
                <td length='100'>|             -</td>
                <td>het antwoord hier</td>
            </tr>

            <tr>
                <td colspan='2'>De vraag hier</td>
            </tr>
            <tr>
                <td length='100'>|             -</td>
                <td>het antwoord hier</td>
            </tr>

            <tr>
                <td colspan='2'>De vraag hier</td>
            </tr>
            <tr>
                <td length='100'>|             -</td>
                <td>het antwoord hier</td>
            </tr>

            <tr>
                <td colspan='2'>De vraag hier</td>
            </tr>
            <tr>
                <td length='100'>|             -</td>
                <td>het antwoord hier</td>
            </tr>
        </table>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>

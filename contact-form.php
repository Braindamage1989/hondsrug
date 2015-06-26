<?php
    session_start();
    
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>
<?php 
    if (isset($_GET["send"])&&$_GET["send"]=="true") {
        
        $to      = 'd.bor@st.hanze.nl';
        $subject = $_POST["subject"];
        $message = $_POST["email"]."//".$_POST["name"];
        $headers = 'From: ' . $_POST["mail"] . "\r\n" .
            'Reply-To: ' . $_POST["mail"];
        
        echo 'U kunt helaas geen mail sturen van af localhost.<br />Dit is wel mogelijk van af een normale server.<br />'; //mail($to, $subject, $message, $headers);
        echo $to."<br />".$subject."<br />".$message."<br />".$headers;
    }
    
?>


<div class="titel2">
    <div class="container">
        <h1>Contact</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <?php 
            if (isset($_GET["send"])&&$_GET["send"]=="true") {
        ?>
        Uw bericht is verzonden.<br />
        Als u een reactie verwacht aan de hand van deze mail, kunt u deze spoedig verwachten.<br />
        <br />
        <?php
            }
        ?>
        <table>
            <form action="contact-form.php?send=true" name="mailform" method="post">
                Naam:<br>
                <input type="text" name="name" value="" placeholder="Uw naam"><br>
                E-mail:<br>
                <input type="text" name="mail" value="" placeholder="Uw email"><br>
                Onderwerp:<br>
                <input type="text" name="subject" value="" placeholder="Het onderwerp"><br>
                Bericht:<br>
                <textarea name="email" value="" placeholder='Uw bericht'></textarea><br><br>
                <input type="submit" value="Send">
                <input type="reset" value="Reset">
            </form>
        </table>
    </div>
</div>
        
<?php 
    require_once 'includes/footer.html'; 
?>
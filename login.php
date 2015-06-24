<?php
    session_start();
    
    //error_reporting(0);

    require_once 'includes/connectdb.php';
    require_once 'includes/header.php';
    
    if(isset($_POST['login'])):
        $email=$_POST['email'];
        $wachtwoord=$_POST['wachtwoord'];

        $sql="SELECT voornaam, email, wachtwoord, functie FROM gebruikers WHERE email='$email' AND wachtwoord='$wachtwoord' AND functie='Medewerker IT'";
        $result= mysqli_query($db, $sql);
        
        $count=mysqli_num_rows($result);

        if($count==1){
            while ($rij = mysqli_fetch_assoc($result)) :
                $_SESSION['voornaam'] = $rij['voornaam'];
            endwhile;
            $_SESSION['ingelogd'] = true;
            header("location:index.php");
        }
        else {
            $melding = "Email en wachtwoord komen niet overeen.";
        }
    endif;
?>

<div class="titel2">
    <div class="container">
        <h1>Log in</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div class="col-md-11">
            <td><?php if(isset($melding)) : echo $melding; endif; ?>
            <form action="" method="POST">
                <table class="table">
                    <tr>
                        <td><b>E-mail</b></td>
                        <td>
                            <input type="text" name="email">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Wachtwoord</b></td>
                        <td>
                            <input type="text" name="wachtwoord">
                        </td>
                    </tr>
                </table>
                </div>
        <div class='col-md-1'>
            <div class='submenu'>
                <input type="submit" name="login" value="Login" class="btn btn-primary"/>
            </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>


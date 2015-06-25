<?php 
    session_start();
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
    
    if(isset($_GET["error"])&&$_GET["error"]=="noinput") {
        $error="U heeft geen optie geselecteerd</br>
            Selecteer een optie:</br></br>";
    }
    elseif (isset($_GET["error"])&&$_GET["error"]=="wronginput") {
        $error="U heeft een ongeldige optie geselecteerd</br>
            Selecteer een geldige optie:</br></br>";
    }
    
    $_SESSION=[];

    $query="SELECT hw_id FROM hardware WHERE soort_hw='werkstation'";
    $result=  mysqli_query($db, $query);

    if (!$result)   {
        echo $result;
        die("Database query failed.");
    }
?>

<div class="titel2">
    <div class="container">
        <h1>Vragenscript</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        <div>
            <form action="redirect0.php" name="form" method="post">
                Op welke locatie bevind u zich?
                </br>
                <select name="locatie">
                    <option value="Anloo">Anloo</option>
                    <option value="Borger">Borger</option>
                    <option value="Gasselte">Gasselte</option>
                    <option value="Gieten">Gieten</option>
                    <option value="Gieterveen">Gieterveen</option>
                    <option value="Grolloo">Grolloo</option>
                    <option value="Hoofkantoor">Hoofdkantoor</option>
                    <option value="Anders">Anders</option>
                </select>
        </div>
        </br>
        <div>
                <div class='vragenscript'>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                    <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;" class="btn btn-default"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/footer.html'; 
?>



                    
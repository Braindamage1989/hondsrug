<?php
    session_start();
    
    require_once 'includes/header.php';
?>

<div class="titel1">
  <div class="container">
      <?php
        if(isset($_SESSION['ingelogd'])) {
            $voornaam = $_SESSION['voornaam'];
            echo "<h1>Welkom, $voornaam.</h1>"
                    . "<p>U kunt nu gebruik maken van de tool.</p>"
                    . "<a href=\"logout.php\">Of log out</a>";
        }
        else {
            echo "<h1>Welkom op de beheertool van De Hondsrug.</h1>"
            . "<p>Om de tool te gebruiken moet u eerst inloggen</p>"
                    . "<a href=\"login.php\">Log in</a>";
        }
      ?>
    
  </div>
</div> 

<div class="learn-more">
      <div class="container">
            <div class="row">
          <div class="col-md-4">
                    <h3>Incidenten</h3>
                    <p>Toont alle binnengekomen incidenten. Ook kunt u incidenten toevoegen of bewerken.</p>
                    <p><a href="incidenten.php">Ga naar incidenten</a></p>
          </div>
              <div class="col-md-4">
                    <h3>Problemen</h3>
                    <p>Bekijk alle bekende problemen of voeg nieuwe problemen toe.</p>
                    <p><a href="problemen.php">Ga naar problemen</a></p>
              </div>
              <div class="col-md-4">
                    <h3>Gebruikers</h3>
                    <p>Toont alle gebruikers van de beheertool. Ook kunnen er nieuwe gebruikers toegevoegd of bewerkt worden.</p>
                    <p><a href="gebruikers.php">Ga naar gebruikers</a></p>
              </div>
              <div class="col-md-4">
                    <h3>Hardware</h3>
                    <p>Geeft een lijst weer van alle hardware in de CMDB. Ook kan er hardware toegevoegd of gewijzigd worden.</p>
                    <p><a href="hardware.php">Ga naar hardware</a></p>
              </div>
              <div class="col-md-4">
                    <h3>Software</h3>
                    <p>Geeft een lijst weer van alle software in de CMDB. Ook kan er software toegevoegd of gewijzigd worden.</p>
                    <p><a href="software.php">Ga naar software</a></p>
              </div>
              <div class="col-md-4">
                    <h3>Geïnstalleerde software</h3>
                    <p>Toont alle geïnstalleerde software. Ook kunt u nieuwe geïnstalleerde software toevoegen.</p>
                    <p><a href="geinstalleerde_software.php">Ga naar geïnstalleerde software</a></p>
              </div>
        </div>
    </div>
</div>

<?php
    require_once 'includes/footer.html';
?>
<?php
    require_once 'includes/header.html';
?>

<div class="titel1">
  <div class="container">
    <h1>Welkom op de beheertool van De Hondsrug.</h1>
    <p>Om de tool te gebruiken moet u eerst inloggen</p>
    <a href="#">Log in</a>
  </div>
</div> 

<div class="learn-more">
      <div class="container">
            <div class="row">
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
                    <h3>Incidenten</h3>
                    <p>Toont alle binnengekomen incidenten. Deze incidenten kunnen eventueel worden ge-escaleerd naar een probleem</p>
                    <p><a href="incidenten.php">Ga naar incidenten</a></p>
              </div>
        </div>
    </div>
</div>

<?php
    require_once 'includes/footer.html';
?>
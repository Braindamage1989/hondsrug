<!DOCTYPE html>
<html>

  <head>
    <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
    
  </head>

  <body>
    <div class="nav">
      <div class="container">
        <ul class="pull-left">
          <li><a href="index.php">Home</a></li>
          
          <li><a href="incidenten.php">Incidenten</a></li>
          <li><a href="problemen.php">Problemen</a></li>
          <li><a href="gebruikers.php">Gebruikers</a></li>
          <li><a href="hardware.php">Hardware</a></li>
          <li><a href="software.php">Software</a></li>
          <li><a href="geinstalleerde_software.php">Geinstalleerde software</a></li>
        </ul>
        <ul class="pull-right">
            <?php
                if(isset($_SESSION['ingelogd'])) {
                    echo "<li><a href=\"logout.php\">Log Out</a></li>";
                }else {
                    echo "<li><a href=\"login.php\">Log In</a></li>";
                }
            ?>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>

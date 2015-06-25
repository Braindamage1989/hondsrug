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
          
          <li><a href="vragenscript.php">Vragen</a></li>
          <li><a href="tool.php">Beheertool</a></li>
          <li><a href="FAQ.php">F.A.Q.</a></li>
        </ul>
        <ul class="pull-right">
            <?php
                if(isset($_SESSION['ingelogd'])) {
                    echo "<li><a href=\"logout.php\">Log Out</a></li>";
                }else {
                    echo "<li><a href=\"login.php\">Log In</a></li>";
                }
            ?>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>
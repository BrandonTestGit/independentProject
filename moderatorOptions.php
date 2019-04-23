<?php
  require "header.php";
  require 'includes/dbh.inc.php';
  if (!isset($_SESSION['userUid'])) {
    header("Location: index.php?error=notloggedin");

    exit();
  }
  $username = $_SESSION['userUid'];

  if ($_SESSION['moderator']==0) {
    echo "<p>You do not have moderator permissions.<br>Press 'Request' to request moderator permissions...<br></p>";
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "usertaken") {
        echo '<p>Already requested</p>';
      }
    }
    echo "<form action='includes/modrequests.inc.php' method='post' >
      <p></p>
      <input type='hidden' name='uid' value=$username>
      <button type='submit' name='modrequestt'>Request</button>
    </form>";

  }
?>

<?php
  if ($_SESSION['moderator']==1){
    require 'includes/dbh.inc.php';
    echo ("Welcome, moderator. Here you have control over the snake color! Ouuuu");
    echo ("<h1><b>Moderator Permissions</b></h1>");
    echo "<h2>Snake Color</h2>
    <p>Click on box to pick a new color, then press 'Change' to change the color...</p>
    <form action='game.php' method='post'>
      <p></p>

      <input type='color' name='favcolor'>
      <button type='submit' name='snakeColor'>Change</button>
    </form>";
  }
?>

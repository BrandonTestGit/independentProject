<?php
  require "header.php";
  require 'includes/dbh.inc.php';

  if (!isset($_SESSION['userUid'])) {
    header("Location: index.php?error=notloggedin");

    exit();
  }
  elseif ($_SESSION['admin']==0) {
    echo "<script type='text/javascript'>alert('You do not have administrator access.');</script>";
    echo "<p>You do not have administrator access.</p>";
    exit();
  }
  elseif ($_SESSION['admin']==1){
    require 'includes/dbh.inc.php';

    echo('Welcome, Admin! Here you can approve requests for users to become moderators.<br>You can also change the color of the snake in the game!<br>(only admin and moderators can do this!)');

    mysqli_select_db($conn, "modrequests");
    $query2="SELECT modrequests.* FROM modrequests WHERE modrequests.uidUsers IN ( SELECT users.uidUsers FROM users WHERE modUsers = 0 )";
    $result=$conn->query($query2);
    $num=$result->num_rows;
    $conn->close();
    echo "<b>
    <h1>Moderator User Requests</h1>
    </b>
    <br>
    <br>";


    if ($num > 0) {
          while($row = $result->fetch_assoc()) {
              $uidUsers = $row['uidUsers'];

              echo "<b>
              $uidUsers</b>
              <br>

              <br>";

          }
      }

  }
?>

<form action="includes/approvemods.inc.php" method="post">
  <input class="left" type="text" name="uid" placeholder="Username">
  <p></p>
  <button type="submit" name="modrequestt">Approve</button>
</form>
<br>
<h1>Snake Color</h1>
<p>Click on box to pick a new color, then press 'Change' to change the color...</p>
<form action='game.php' method='post'>
  <p></p>

  <input type='color' name='favcolor'>
  <button type='submit' name='snakeColor'>Change</button>
</form>

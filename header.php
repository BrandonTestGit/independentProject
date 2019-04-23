<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta name="description" content="Shtuff">
    <meta name=viewport content="width = device-width, initial-scale=1">
    <title>Game Site</title>
    <link rel="stylesheet" href="style.css">
</head>
  <body>
    <header>
      <nav>
        <ul class="left">
          <li><a href='index.php'>Home</a></li>
          <li><a href='game.php'>Game</a></li>
          <li><a href='rules.php'>Rules</a></li>
          <li><a href='leaderboard.php'>Leaderboard</a></li>
          <li><a href='adminOptions.php'>Admin</a></li>
          <li><a href='moderatorOptions.php'>Moderators</a></li>
          <li style='display: block;
              color: #000;
              padding: 100% 16px;
              text-decoration: none;' </li>
        </ul>
        <div class="right">
          <?php
            if (isset($_SESSION['userId'])) {
              echo '<form action="includes/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Log Out</button>
              </form>';

            }
            else {
              echo '<form action="includes/login.inc.php" method="post">
                <input type="text" name="mailuid" placeholder="Email">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
              </form>
              <p></p>
              <a href="signup.php">Sign up</a>';
            }
          ?>


        </div>
      </nav>
    </header>

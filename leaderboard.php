<?php
  require "header.php";
  require 'includes/dbh.inc.php';


  mysqli_select_db($conn, "scores");
  $query2="SELECT * FROM scores ORDER BY scoresUsers DESC";
  $result=$conn->query($query2);
  $num=$result->num_rows;
  $conn->close();
  echo "<b>
  <h1>Leaderboard</h1>
  </b>
  <p>Top 10</p>
  <br>";

  echo "<u><b>Username</b><b style='float:right;margin-right:75%'><u>Score</u></b><br></u><br>";

  if ($num > 0) {
        $count = 0;
        while($row = $result->fetch_assoc()) {
            $uidUsers = $row['uidUsers'];
            $scoresUsers = $row ['scoresUsers'];
            echo "<b> $uidUsers </b><b style='float:right;margin-right:75%'> $scoresUsers</b>
            <br>

            <br>";
            $count = $count + 1;
            if($count > 9){
              exit();
            }

        }
    }

  ?>

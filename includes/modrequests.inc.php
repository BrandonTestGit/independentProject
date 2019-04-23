<?php
if (isset($_POST['modrequestt'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];


  $sql = "SELECT uidUsers FROM modrequests WHERE uidUsers=?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../moderatorOptions.php?error=sqlerror");
    exit();
  }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $results = mysqli_stmt_num_rows($stmt);

    if ($results > 0) {
      header("Location: ../moderatorOptions.php?error=usertaken");
      exit();
    }
    else {
      $sql = "INSERT INTO modrequests (uidUsers) VALUES (?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_execute($stmt);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../moderatorOptions.php?error=sqlerror2");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);



      header("Location: ../moderatorOptions.php?request=success");
      exit();

      }

      mysqli_stmt_close($stmt);

      mysqli_close($conn);
      }





else {
  header("Location: ../moderatorOptions.php");
  exit();
}

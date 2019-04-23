<?php
if (isset($_POST['modrequestt'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];


  $sql = "SELECT modUsers FROM users WHERE uidUsers=?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../adminOptions.php?error=sqlerror");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
  $results = mysqli_stmt_num_rows($stmt);

  if ($results == 0) {
    header("Location: ../adminOptions.php?error=usernameNotFound");
    exit();
  }
  else {
    $sql = "UPDATE users SET modUsers = 1 WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../adminOptions.php?error=sqlerror2");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);



    header("Location: ../adminOptions.php?approval=success");
    exit();

    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
  }






else {
  header("Location: ../adminOptions.php");
  exit();
}

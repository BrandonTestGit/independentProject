<?php
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';
  require_once '../../../phpMyAdmin/vendor/autoload.php';
  require("../../../../Users/Brandon Morales/vendor/phpmailer/phpmailer/src/PHPMailer.php");
  require("../../../../Users/Brandon Morales/vendor/phpmailer/phpmailer/src/SMTP.php");

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $password2 = $_POST['pwd-2'];

  if (empty($username)||(empty($email))||empty($password)||empty($password2)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invalidmailuid=");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  elseif ($password !== $password2) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  else {

    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    $sql2 = "SELECT emailUsers FROM users WHERE emailUsers=?";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $results = mysqli_stmt_num_rows($stmt);

      if ($results > 0) {
        header("Location: ../signup.php?error=usertaken&mail=",$email);
        exit();
      }
      mysqli_stmt_bind_param($stmt2, "s", $email);
      mysqli_stmt_execute($stmt2);
      mysqli_stmt_store_result($stmt2);
      $results2 = mysqli_stmt_num_rows($stmt2);
      if ($results2 > 0) {
        header("Location: ../signup.php?error=emailtaken&uid=",$username);
        exit();
      } else {
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {
          $pwdHash = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $pwdHash);
          mysqli_stmt_execute($stmt);

          //PHPMailer Object
          $mail = new PHPMailer\PHPmailer\PHPMailer();
          $mail->IsSMTP(); // enable SMTP

          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
          $mail->SMTPAuth = true; // authentication enabled
          $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 465; // or 587
          $mail->IsHTML(true);
          $mail->Username = "brandonmoralestestemail@gmail.com";
          $mail->Password = "testPassword1";
          $mail->SetFrom("brandonmoralestestemail@gmail.com","Brandon Morales");
          $mail->Subject = "Success";
          $mail->Body = "You have signed up successfully! Your password is: ".$password." <br>Enjoy!";
          $mail->AddAddress($email);

          if(!$mail->send())
          {
              echo "Mailer Error: " . $mail->ErrorInfo;
          }
          else
          {
              echo "<p>Message has been sent successfully</p>";
          }
          header("Location: ../index.php?signup=success");

          exit();

        }
      }
    }
  }
  mysqli_stmt_close($stmt);

  mysqli_close($conn);


  }

else {
  header("Location: ../signup.php");
  exit();
}

<?php
  require "header.php";
?>

  <main>
    <div class>
      <section>
        <h1>Signup</h1>
        <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<p class="signuperror">Fill in all of the fields</p>';
            }
            elseif ($_GET['error'] == "invaliduidmail") {
              echo '<p class="signuperror">Invalid Username and Email</p>';
            }
            elseif ($_GET['error'] == "invaliduid") {
              echo '<p class="signuperror">Invalid Username</p>';
            }
            elseif ($_GET['error'] == "passwordcheck") {
              echo '<p class="signuperror">Make sure passwords match</p>';
            }
            elseif ($_GET['error'] == "usertaken") {
              echo '<p class="signuperror">Username taken</p>';
            }
            elseif ($_GET['error'] == "emailtaken") {
              echo '<p class="signuperror">Email already in use</p>';
            }
            elseif ($_GET['error'] == "invalidmail") {
              echo '<p class="signuperror">Invalid Email</p>';
            }
          }



        ?>
        <form class="sidenav" action="includes/signup.inc.php" method="post">
          <input class="left" type="text" name="uid" placeholder="Username">
          <input type="text" name="mail" placeholder="Email">
          <p></p>
          <input class="left" type="password" name="pwd" placeholder="Password">
          <input type="password" name="pwd-2" placeholder="Repeat Password">
          <p></p>
          <button type="submit" name="signup-submit">Sign Up</button>
        </form>
      </section>
    </div>
  </main>

<?php
  require "footer.php";
?>

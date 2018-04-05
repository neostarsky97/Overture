<?php
  include_once('C:\xampp\htdocs\Overture\classes\Account.php');
  include_once('C:\xampp\htdocs\Overture\classes\Constants.php');
  include_once('C:\xampp\htdocs\Overture\includes\config.php');

  //$PDO connection in config.php

  $accountObj = new Account($con);


  include_once('C:\xampp\htdocs\Overture\includes\handlers\register-handler.php');
  include_once('C:\xampp\htdocs\Overture\includes\handlers\login-handler.php');

  function getInputValue($input) {
    if (isset($_POST[$input])) {
      echo $_POST[$input];
    }
  }

  function getInputRadio($input, $value) {
    if (isset($_POST[$input]) && $_POST[$input] == $value) {
      echo "checked";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Overture</title>
    <link rel="stylesheet" type="text/css" href="assets\css\register.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/register.js"></script>
  </head>
  <body>

    <?php
      if(isset($_POST['registerButton'])) {
        echo '<script type="text/javascript">
          $(document).ready(function() {
            $("#registerForm").show();
            $("#loginForm").hide();
          });
        </script>';
      } else {
        echo '<script type="text/javascript">
          $(document).ready(function() {
            $("#registerForm").hide();
            $("#loginForm").show();
          });
        </script>';
      }
    ?>

    <div id="background">
      <div id="loginContainer">
        <div id="inputContainer">

          <form id="loginForm" action="register.php" method="post">
            <h2>Welcome to Overture</h2>
            <p>
              <?php echo $accountObj->getError(Constants::$error_loginUnsuccessful); ?>
              <label for="loginName">Username</label>
              <input type="text" id="loginName" name="loginName" value="<?php getInputValue('loginName'); ?>" placeholder="username123" required>
            </p>
            <p>
              <label for="loginPassword">Password</label>
              <input type="password" id="loginPassword" name="loginPassword" value="" placeholder="password123" required>
            </p>
            <p>
              <button type="submit" name="submitButton">LOG IN</button>
            </p>

            <div class="hasAccountText">
              <span id="hideLogin">Don't have an account yet? Signup here</span>
            </div>
          </form>

          <form id="registerForm" action="register.php" method="post">
            <h2>Create your free account</h2>
            <p>
              <?php echo $accountObj->getError(Constants::$error_usernameCharacters); ?>
              <?php echo $accountObj->getError(Constants::$error_usernameExists) ?>
              <label for="registerUsername">Username</label>
              <input type="text" id="registerUsername" name="username" value="<?php getInputValue('username'); ?>" required>
            </p>

            <p>
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" value="<?php getInputValue('firstName'); ?>" required>
            </p>

            <p>
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" value="<?php getInputValue('lastName'); ?>" required>
            </p>

            <p>
              <label for="radioButtonMale">Male</label>
              <input type="radio" id="radioButtonMale" name="gender" value="Male" <?php getInputRadio('gender', 'Male'); ?> required>
              <label for="radioButtonFemale">Female</label>
              <input type="radio" id="radioButtonFemale" name="gender" value="Female" <?php getInputRadio('gender', 'Female'); ?> required>
            </p>
            <p>
              <?php echo $accountObj->getError(Constants::$error_dateNotValid); ?>
              <label for="dateOfBirth">Date Of Birth</label>
              <input type="date" name="dateOfBirth" value="<?php getInputValue('dateOfBirth'); ?>" required>
            </p>

            <p>
              <?php echo $accountObj->getError( Constants::$error_emailNotValid); ?>
              <?php echo $accountObj->getError( Constants::$error_emailExists) ?>
              <label for="email">E-mail Id</label>
              <input type="email" id="email" name="email" value="<?php getInputValue('email'); ?>" required>
            </p>

            <p>
              <?php echo $accountObj->getError(Constants::$error_passwordsDoNotMatch); ?>
              <?php echo $accountObj->getError(Constants::$error_passwordsOnlyAlpha); ?>
              <?php echo $accountObj->getError(Constants::$error_passwordTooWeak); ?>
              <label for="registerPassword">Password</label>
              <input type="password" id="registerPassword" name="registerPassword" required>
            </p>

            <p>
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" id="confirmPassword" name="confirmPassword" required>
            </p>

            <p>
              <button type="submit" name="registerButton">SIGN IN</button>
            </p>

            <div class="hasAccountText">
              <span id="hideRegister">Already have an existing account? Login here.</span>
            </div>


          </form>

      </div>
    </div>
  </body>
</html>

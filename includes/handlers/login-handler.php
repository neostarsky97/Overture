<?php
  if (isset($_POST['submitButton'])) {
    //Login button is pressed
    $username = $_POST['loginName'];
    $password = $_POST['loginPassword'];
    $loginSuccess = $accountObj->login($username, $password);

    if ($loginSuccess) {
      $_SESSION['userLoggedIn'] = $username;
      header("Location: \Overture\index.php");
    }
  }
?>

<?php
  include('../../config.php');

  if (!isset($_POST['username'])) {
    echo "ERROR: username could not be found";
  }

  if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {
    echo "Not all passwords have been set";
    exit();
  }

  if ($_POST['oldPassword'] == "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {
    echo "Fill in all fields";
    exit();
  }

  $username = $_POST['username'];
  $oldPassword = $_POST['oldPassword'];
  $newPassword1 = $_POST['newPassword1'];
  $newPassword2 = $_POST['newPassword2'];

  $oldPassmd5 = md5($oldPassword);
  //echo $oldPassmd5;
  $passwordCheck = $con->query("SELECT * FROM users WHERE username = '$username' AND password='$oldPassmd5'");

  // echo $passwordCheck->rowCount();
  if ($passwordCheck->rowCount() != 1) {
    echo "Password is incorrect";
    exit();
  }

  if ($newPassword1 != $newPassword2) {
    echo "Passwords do not match";
    exit();
  }
  if (preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
    echo "Your password must contain only letters and numbers";
    exit();
  }
  if (strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
    echo "Your password must be between 5 and 30 characters in length";
    exit();
  }
  $newPassmd5 = md5($newPassword1);
  $updatePasswordQuery = $con->query("UPDATE users SET password = '$newPassmd5' WHERE username = '$username'");
  echo "Update successful";
?>

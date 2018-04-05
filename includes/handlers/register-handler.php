<?php

  function cleanFormUsername($inputText) {
    $username = strip_tags($inputText);
    $username = str_replace(" ", "", $username);
    return $username;
  }

  function cleanFormString ($inputText) {
    $string = strip_tags($inputText);
    $string = str_replace(" ", "", $string);
    $string = ucfirst(strtolower($string));
    return $string;
  }

  function cleanFormPassword ($password) {
    $password = strip_tags($password);
    return $password;
  }

  function cleanFormEmail ($inputText) {
    $email = strip_tags($inputText);
    return $email;
  }



  if (isset($_POST['registerButton'])) {
    $username = cleanFormUsername($_POST['username']);
    $firstname = cleanFormString($_POST['firstName']);
    $lastname = cleanFormString($_POST['lastName']);
    $email = cleanFormEmail($_POST['email']);
    $password = cleanFormPassword($_POST['registerPassword']);
    $confirmpassword = cleanFormPassword($_POST['confirmPassword']);
    $date = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];

    $wasSuccesful = $accountObj->register($username, $firstname, $lastname, $gender, $date, $email, $password,
    $confirmpassword);

    if ($wasSuccesful) {
      $_SESSION['userLoggedIn'] = $username;
      header("Location: \Overture\index.php");
      // echo "Last table insert: ".$con->lastInsertId();
    }
  }
?>
